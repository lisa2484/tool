
<?php
error_reporting(E_ALL);

/* Allow the script to hang around waiting for connections. */
set_time_limit(0);

/* Turn on implicit output flushing so we see what we're getting
 * as it comes in. */
ob_implicit_flush();

$address = '127.0.0.1';
$port = 65522;

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
    return $sock;
}
$sock = socketBuild($address, $port);
// socket_set_nonblock($sock);
echo "server start\n";
// echo var_dump($sock) . "\n";
$outmsg = '';
do {
    if (($msgsock = socket_accept($sock)) === false) {
        echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
        continue;
    }
    do {
        if (false === ($buf = socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
            echo "socket_read() failed: reason: " . socket_strerror(socket_last_error($msgsock)) . "\n";
            break;
        }
        if (!$buf = trim($buf)) {
            if (!empty($outmsg)) {
                echo $outmsg;
                socket_write($msgsock, $outmsg, strlen($outmsg));
                $outmsg = '';
            }
            continue;
        }
        echo "$buf\n";
        if ($buf == 'quit') {
            break;
        }
        if ($buf == 'Hello Server') {
            $outmsg = 'Hello Client' . PHP_EOL . PHP_EOL;
            echo $outmsg;
            continue;
        }
        if (($swk = explode(':', $buf))[0] == 'Sec-WebSocket-Key') {
            // $swk[1] = base64_decode(trim($swk[1]));
            $msg = trim($swk[1]) . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11';
            $msg = base64_encode(sha1($msg, true));
            // header('HTTP/1.1 101 Switching Protocols');
            // header('Upgrade: websocket');
            // header('Connection: Upgrade');
            // header('Sec-WebSocket-Accept:' . $msg);
            // header('Sec-WebSocket-Protocol: chat');
            $outmsg = 'HTTP/1.1 101 Switching Protocols' . PHP_EOL;
            $outmsg .= 'Upgrade: websocket' . PHP_EOL;
            $outmsg .= 'Connection: Upgrade' . PHP_EOL;
            $outmsg .= 'Sec-WebSocket-Accept: ' . $msg . PHP_EOL . PHP_EOL;
            // $outmsg .= 'Sec-WebSocket-Protocol: chat' . PHP_EOL . PHP_EOL;
            continue;
        }
        if ($buf == 'shutdown') {
            socket_close($msgsock);
            break 2;
        }
        // $talkback = "PHP: You said '$buf'.\n";
        // socket_write($msgsock, $talkback, strlen($talkback));
    } while (true);
    socket_close($msgsock);
} while (true);
socket_close($sock);
echo 'server close';
