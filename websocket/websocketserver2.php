<?php
error_reporting(E_ERROR);

/* Allow the script to hang around waiting for connections. */
set_time_limit(0);

/* Turn on implicit output flushing so we see what we're getting
 * as it comes in. */
ob_implicit_flush();

$address = '192.168.100.6';
$port = 65520;

function socketBuild($address, $port)
{
    if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
        die("socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n");
    }

    if (socket_bind($sock, $address, $port) === false) {
        die("socket_bind() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n");
    }

    if (socket_listen($sock) === false) {
        die("socket_listen() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n");
    }
    echo "server start " . PHP_EOL;
    return $sock;
}
$sock = socketBuild($address, $port);
//clients array
$clients = array();

do {
    $read = array();
    $read[] = $sock;

    $read = array_merge($read, $clients);

    // Set up a blocking call to socket_select
    if (socket_select($read, $write = NULL, $except = NULL, $tv_sec = 5) < 1) {
        //    SocketServer::debug("Problem blocking socket_select?");
        continue;
    }

    if (in_array($sock, $read)) {

        if (($msgsock = socket_accept($sock)) === false) {
            echo "socket_read() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
            break;
        }
        $clients[] = $msgsock;
        echo count($clients) . PHP_EOL;
        // $r = [$sock, $msgsock];
        $buf = socket_read($msgsock, 1024);
        // socket_write($msgsock, 1, strlen(1));
        // $a = strlen($buf);
        // var_dump($buf);
        // if ($a == 0) break;
        // var_dump(socket_select($r, $write = NULL, $except = NULL, $tv_sec = 5)) . PHP_EOL;
        // echo $write . PHP_EOL;
        if (($swk = explode(':', strstr(strstr($buf, 'Sec-WebSocket-Key'), PHP_EOL, true)))[0] == 'Sec-WebSocket-Key') {
            $msg = trim($swk[1]) . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11';
            $msg = base64_encode(sha1($msg, true));
            $outmsg = 'HTTP/1.1 101 Switching Protocols' . PHP_EOL;
            $outmsg .= 'Upgrade: websocket' . PHP_EOL;
            $outmsg .= 'Connection: Upgrade' . PHP_EOL;
            $outmsg .= 'Content-Encoding: gzip' . PHP_EOL;
            $outmsg .= 'Accept-Patch: text/html;charset=utf-8' . PHP_EOL;
            $outmsg .= 'Accept-Ranges: bytes' . PHP_EOL;
            $outmsg .= 'Sec-WebSocket-Accept: ' . $msg . PHP_EOL . PHP_EOL;
            socket_write($msgsock, $outmsg, strlen($outmsg));
            continue;
        }
    }

    $tmpclients = $clients;
    foreach ($tmpclients as $key => $client) {
        if (in_array($client, $read)) {
            if (false === ($buf = socket_read($client, 65535))) {
                echo "socket_read() failed: reason: " . socket_strerror(socket_last_error($client)) . "\n";
                socket_shutdown($client);
                socket_close($client);
                unset($clients[$key]);
                $clients = array_values($clients);
                continue;
            }
            if (!($buf = trim($buf))) {
                continue;
            }
            if ($buf == 'quit') {
                socket_close($client);
                continue;
            }
            if ($buf == 'shutdown') {
                socket_close($sock);
                die('server shutdown');
            }
            // $talkback = "Cliente {$key}: Usted dijo '$buf'.\n";
            // socket_write($client, $talkback, strlen($talkback));
            // if (!empty($but)) {
            //     $outmsg = 'Hello Client' . PHP_EOL . PHP_EOL;
            //     socket_write($client, $outmsg, strlen($outmsg));
            // }
            // $str = base64_encode('hello') . PHP_EOL;
            // socket_write($client, $buf, strlen($buf));
            // echo mb_language() . PHP_EOL;。
            // echo "original:" . $buf . PHP_EOL;
            // $buf = base64_decode($buf);
            // echo "decode:" .  bindec($buf) . PHP_EOL;
            $bin = unpack("C*", $buf);
            // var_dump($bin);
            $binarr = [];
            $payload_len = 0;
            $MASK = [];
            $MASK_S = 0;
            foreach ($bin as $k => $b) {
                $bb = (string)base_convert($b, 10, 2);
                while (strlen($bb) < 8) {
                    $bb = '0' . $bb;
                }
                if ($k == 1) echo 'data start' . PHP_EOL;
                if ($k < 14) {
                    echo '[' . $k . ']' . $bb . PHP_EOL;
                }
                switch ($k) {
                    case 1:
                        break;
                    case 2:
                        $payload_len = base_convert(substr($bb, 1, strlen($bb)), 2, 10);
                        break;
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                        if ($payload_len < 126) {
                            $MASK[] = $bb;
                            break;
                        }
                        if ($payload_len == 126) {
                            $MASK[] = $bb;
                            break;
                        }
                    case 7:
                    case 8:
                    case 9:
                    case 10:
                    case 11:
                    case 12:
                        if ($payload_len == 127) {
                            break;
                        }
                    case 13:
                    case 14:
                        if ($payload_len == 127) {
                            $MASK[] = $bb;
                            break;
                        }
                    default:
                        // echo '[' . $k . ']' . $b . PHP_EOL;
                        $binarr[] = $bb;
                        // echo $bb . PHP_EOL;
                }
            }


            // echo var_dump(gzdecode($buf)) . PHP_EOL;
        }
    }
} while (true);
socket_close($sock);
echo 'server close';
