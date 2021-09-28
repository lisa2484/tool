<?php
// error_reporting(E_ERROR);
class Ws
{
    private $socket = null;
    private $sockts = [];
    private $write = null;
    private $except = null;
    private $user = [];
    public function __construct($ip, $port)
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, true);
        socket_bind($this->socket, $ip, $port);
        socket_listen($this->socket);
        $this->sockts[] = $this->socket;
        while (true) {
            $tmp_sockets = $this->sockts;
            if (false == socket_select($tmp_sockets, $write, $except, null)) {
                echo "socket_select() failed, reason: " .
                    socket_strerror(socket_last_error()) . "\n";
            } else {
                foreach ($tmp_sockets as $sock) {
                    if ($sock == $this->socket) {
                        $conSock = socket_accept($this->socket);
                        $this->sockts[] = $conSock;
                        $this->user[] = ['socket' => $conSock, 'handshake' => false];
                    } else {
                        //1024
                        $request = socket_read($sock, 1024);
                        $k = $this->getUserIndex($sock);
                        if (strlen($request) == 0) {
                            $this->close($k);
                            continue;
                        }
                        if (!$this->user[$k]['handshake']) {
                            $response = $this->handleShake($request);
                            socket_write($sock, $response, strlen($response));
                            $this->user[$k]['handshake'] = true;
                        } else {
                            $msg = $this->decode($request);
                            $this->send($msg, $k);
                        }
                    }
                }
            }
        }
    }
    private function close($k)
    {
        socket_close($this->user[$k]['socket']);
        unset($this->user[$k]);
        $this->sockts = null;
        $this->sockts[] = $this->socket;
        foreach ($this->user as $v) {
            $this->sockts[] = $v['socket'];
        }
    }
    private function getUserName()
    {
        foreach ($this->user as $v) {
            $name[] = $v['name'];
        }
        return $name;
    }
    //缺資料格式
    private function send(string $msg, $key)
    {
        $res = '';
        // $arr = explode('===', $msg);
        // if ($arr[0] == 'login') {
        //     $this->user[$k]['name'] = $arr[1];
        //     $res['msg'] = $arr[1] . ':login success';
        //     $res['type'] = 'login';
        //     $names['name'] = $this->getUserName();
        //     $names['type'] = 'user';
        //     $names = $this->encode(json_encode($names));
        //     foreach ($this->user as $v) {
        //         socket_write($v['socket'], $names, strlen($names));
        //     }
        // }
        // if ($arr[0] == 'con') {
        //     $res['content'] = $arr[1];
        //     $res['name'] = $this->user[$k]['name'];
        //     $res['time'] = date('Y-m-d H:i:s', time());
        //     $res['type'] = 'con';
        // }
        $res = $this->encode(json_encode($msg));
        foreach ($this->user as $v) {
            socket_write($v['socket'], $res, strlen($res));
        }
    }
    private function getUserIndex($sock)
    {
        foreach ($this->user as $k => $v) {
            if ($v['socket'] == $sock) {
                return $k;
            }
        }
    }
    //缺資料大小限制(或資料續傳)及加密選擇
    private function encode($msg)
    {
        $frame = [];
        $frame[0] = '81';
        $len = strlen($msg);
        if ($len < 126) {
            $frame[1] = $len < 16 ? '0' . dechex($len) : dechex($len);
        } else if ($len < 65025) {
            $s = dechex($len);
            $frame[1] = '7e' . str_repeat('0', 4 - strlen($s)) . $s;
        } else {
            $s = dechex($len);
            $frame[1] = '7f' . str_repeat('0', 16 - strlen($s)) . $s;
        }
        $data = '';
        $l = strlen($msg);
        for ($i = 0; $i < $l; $i++) {
            $data .= dechex(ord($msg[$i]));
        }
        $frame[2] = $data;
        $data = implode('', $frame);
        return pack("H*", $data);
    }
    private function handleShake($request)
    {
        preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $request, $match);
        $key = $match[1];
        $new_key = base64_encode(sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
        $response = "HTTP/1.1 101 Switching Protocols" . PHP_EOL;
        $response .= "Upgrade: websocket" . PHP_EOL;
        $response .= "Connection: Upgrade" . PHP_EOL;
        $response .= "Sec-WebSocket-Accept: $new_key" . PHP_EOL . PHP_EOL;
        // $response .= "Sec-WebSocket-Protocol: chat\r\n\r\n";
        return $response;
    }
    //缺資料續傳判斷
    private function decode($buffer)
    {
        $decoded = '';
        $len = ord($buffer[1]) & 127;
        if ($len === 126) {
            $masks = substr($buffer, 4, 4);
            $data = substr($buffer, 8);
        } else if ($len === 127) {
            $masks = substr($buffer, 10, 4);
            $data = substr($buffer, 14);
        } else {
            $masks = substr($buffer, 2, 4);
            $data = substr($buffer, 6);
        }
        for ($index = 0; $index < strlen($data); $index++) {
            $decoded .= $data[$index] ^ $masks[$index % 4];
        }
        return $decoded;
    }
}
new Ws(0, 12345);
