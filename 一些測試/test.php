<?php
// $f = fopen(__DIR__ . '/../passthrough/upload/ph_1605252074.csv', 'r');
// while ($c = fgetcsv($f, 2) !== FALSE) {
//     echo $c[0];
// }
// foreach ($c as $a) {
//     echo $a;
// }
// $f = file(__DIR__ . '/../passthrough/upload/ph_1605252074.csv', FILE_IGNORE_NEW_LINES);
// foreach ($f as $d) {
//     // $a = explode(',',$d);
//     $a = str_getcsv($d);
//     echo $a[1] . PHP_EOL;
// }
// echo $f[0];
// fclose($f);
//get 3 commands from user
// $line = [];
// error_reporting(E_ERROR);
// $success = true;
// do {
//     $db_act = readline("Database Account: ");
//     $db_pad = readline("Database Password: ");
//     $con = mysqli_connect("127.0.0.1", $db_act, $db_pad);
//     if (mysqli_connect_errno()) {
//         echo "connect fail, message:" . mysqli_connect_error() . PHP_EOL;
//     } else {
//         echo "Database connect" . PHP_EOL;
//         $success = false;
//     }
// } while ($success);
// var_dump(readline_info());
//dump history
// var_dump($db_act);

//dump variables
// var_dump(readline_info());


// function checkDateTime(string $datetime)
// {
//     $d = strtotime($datetime);
//     if (!strtotime($datetime)) return false;
//     return true;
// }
// var_dump(checkDateTime('2020-21-00212'));
// var_dump(checkDateTime('2020-01-01'));
// var_dump(checkDateTime('2020-03-02 12:00:11'));
// var_dump(checkDateTime('12:00:11'));
// do {
//     echo time();
//     sleep(1);
// } while (true);
// $number = '0121SDA-#_F';
// var_dump(preg_match('/^[\w-]+$/', $number) === 1);
// $post = $_POST;
// unset($post['att']);
// var_dump($post, $_POST);
// $sql = "INSERT INTO `lottery_record` (`username`, `gift_name`, `gift_amount`, `pick_up_time`, `payout_status`, `lottery_way`, `gift_class`, `creator`, `creator_id`, `createtime`)
//         VALUES ";
// $time = time();
// $zone = date("O");
// $date = date("Y-m-d");
// $datetime = date("Y-m-d H:i:s");
// $member = [
//     'xiaohan007',
//     's3s3',
//     'sha12',
//     'wkt641844157',
//     'llz1968'
// ];
// do {
//     $sqlArr[] = "('" . $member[random_int(0, 4)] . "','1','1','" . $time . "','" . random_int(0, 3) . "','backend_create','gift','test','0','" . $time . "')";
// } while (count($sqlArr) < 1000);
// echo $sql . implode("," . PHP_EOL, $sqlArr) . ';';
// $title = ["資料ID" => 'id', 'ip' => 'ip'];
// $titleArr = [];
// foreach ($title as $k => $d) {
//     $titleArr[] = '\'["\',\'' . $k . '\',\'","\',' . $d . ',\'"]\'';
// }
// $titleStr = "'['," . implode(',\',\',', $titleArr) . ",']'";
// var_dump(json_decode('[["資料ID","2"],["ip","127.0.0.1"]]'), true);
// function checkDataTimeFormat(string $dateStr, string $format = 'Y-m-d H:i:s')
// {
//     try {
//         $datetime = new DateTime($dateStr, new DateTimeZone('+0800'));
//     } catch (Throwable $e) {
//         return false;
//     }
//     return $dateStr == $datetime->format($format);
// }
// var_dump(checkDataTimeFormat('08,00:0', 'H:i:s'));

// $mconn = new mysqli('127.0.0.1', 'root', '', 'betslip');

// $mconn->begin_transaction();
// $r = true;
// if (!$mconn->query("INSERT INTO `member_tmp` (`group`,`member`) VALUE (''s','test')")) $r = false;
// if (!$mconn->query("INSERT INTO `member_tmp` (`group`,`member`) VALUE ('1','test2')")) $r = false;
// $r ? $mconn->commit() : $mconn->rollback();
// // echo $test;
// if (!$mconn->query("INSERT INTO `member_tmp` (`group`,`member`) VALUE ('1','test2')")) $r = false;
// var_dump($argv);
// $arr = ['aa', 'aaa', 'bb', 'aa'];
// $arra = ['ss'];
// do {
//     $arra[] = $arr[count($arra) % 4];
// } while (count($arra) < 10000);
// $s = microtime(1);
// $r = array_unique($arra);
// $a = array_diff_assoc($arra, $r);
// $e = microtime(1);
// var_dump($r);
// var_dump($a);

// echo "Dynamic Method: " . ($e - $s) . PHP_EOL;
// $array1 = array("green", "brown", "blue", "red");
// $array2 = array("green", "yellow", "red");
// $result = array_diff_assoc($array1, $array2);
// print_r($result);
// function s($a)
// {
//     return explode(',', $a);
// }
// var_dump(array_map('s', ['1,2,3', '4,5,6']));

// $input = array("a", "b", "c", "d", "e");

// $output = array_slice($input, 2);      // returns "c", "d", and "e"
// $output = array_slice($input, -2, 1);  // returns "d"
// print_r(array_slice($input, 0, 3));   // returns "a", "b", and "c"

// function getName()
// {
//     $s = "";
//     $x = random_int(4, 8);
//     for ($i = 0; $i < $x; $i++) {
//         $s .= chr(random_int(97, 122));
//     }
//     return $s . getNumber(random_int(4, 8));
// }

// function getNumber(int $max)
// {
//     $s = "";
//     for ($i = 0; $i < $max; $i++) {
//         $s .= random_int(0, 9);
//     }
//     return $s;
// }
// $f = fopen("testB10w.csv", 'w');
// $x = 100000;

// for ($i = 0; $i < $x; $i++) {
//     $name = getName();
//     fputcsv($f, [$name, random_int(1, 5)]);
//     if (empty(random_int(0, 9)))
//         fputcsv($f, [$name, random_int(1, 5)]);
// }
// fclose($f);
// class a
// {
//     function a()
//     {
//         echo 'a';
//     }
// }
// class b extends a
// {
//     function b()
//     {
//         $this->a();
//     }
// }
// var_dump(ip2long('0.0.0.256'));
// $b = new b;
// $m = addslashes(json_encode(['我']));

// $c = new mysqli('127.0.0.1', 'root', '', 'chatroom');
// $arr = $c->query("SELECT * FROM `messages_main` WHERE `status` > 1")->fetch_all(MYSQLI_ASSOC);
// var_dump($a = unpack('H*', gzencode(json_encode($arr))));
// var_dump(gzdecode(pack('H*', $a[1])));
// $fp = fopen("bigfile.txt.gz", "w");
// fwrite($fp, $gzdata);
// fclose($fp);
// $f = file_get_contents("bigfile.txt.gz");
// var_dump($txt = gzdecode($f));
// $fp = fopen("bigfile.txt", "w");
// fwrite($fp, $txt);
// fclose($fp);

// $c->query("INSERT INTO `test` (`text`) VALUE ('" . $m . "')");
// var_dump($m);

// $e = '<div>
//     <iframe src="https://www.youtube.com/embed/QzdsaXemBWM?autoplay=1&disablekb=1&loop=1&controls=0&origin=http://127.0.0.1/">
//     </iframe>
// </div>';
// deletefile(__DIR__.'/path');

// function deletefile($dirpath)
// {
//     $od = scandir($dirpath);

//     foreach ($od as $file) {
//         if ($file != '.' && $file != '..') {
//             if (!is_dir($dirpath . '\\' . $file)) {
//                 unlink($dirpath . '\\' . $file);
//             } else {
//                 deletefile($dirpath . '\\' . $file);
//             }
//         }
//     }
//     rmdir($dirpath);
// }
// var_dump(dirname(__DIR__) . '/../../../sys/inc/tool_bkd.php');
// $f = file_get_contents('1bXL3G5.gif');
// echo 'data:image/gif;base64,' . base64_encode($f);
// var_dump(getUniqId());
// function getUniqId($lenght = 20)
// {
//     // uniqid gives 20 chars, but you could adjust it to your needs.
//     if (function_exists("random_bytes")) {
//         $bytes = random_bytes(ceil($lenght / 2));
//     } elseif (function_exists("openssl_random_pseudo_bytes")) {
//         $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
//     } else {
//         throw new Exception("no cryptographically secure random function available");
//     }

//     return substr(bin2hex($bytes), 0, $lenght);
// }
// $t = true;
// try {
//     apache_get_version();
// } catch (Throwable $e) {
//     $t = false;
// }
// var_dump($t);
// var_dump(unpack('H*', '你我你我你我我'));
// var_dump($a = gzcompress('e4bda0e68891e4bda0e68891e4bda0e68891e68891'));
// var_dump(unpack('H*', $a));
// var_dump(pack('H*', 'e4bda0e68891e4bda0e68891e4bda0e68891e68891'));
// var_dump(json_encode('你'));
// var_dump((int)'');
// var_dump(preg_replace('/(\$|_)/i', '\\\\$1', '_'));
// var_dump(filesize(__DIR__.'/vvv/aaa/'));
// $a = [];
// for ($i = 0; $i < 5000000; $i++) {
//     $a[] = ['a' => 1, 'b' => 2, 'c' => 3];
// }
// $tx = microtime(true);
// echo 'foreach start' . PHP_EOL;
// $t = 0;
// foreach ($a as $d) {
//     $t += $d['a'];
// }
// echo 'time:' . bcsub(microtime(true), $tx, 4) . ',foreach end' . PHP_EOL;

// $tx = microtime(true);
// echo 'class start' . PHP_EOL;
// $i = 0;
// $ta = 0;
// while (!empty($a)) {
//     $ta += $a[$i]['a'];
//     unset($a[$i]);
//     $i++;
// }
// echo 'time:' . bcsub(microtime(true), $tx, 4) . ',class end' . PHP_EOL;
// exec('php test2.php');
// sleep(30);

// var_dump(addslashes('1"'));
// var_dump(ftok(__FILE__, (string)random_int(0, 99)));
// class a
// {
//     static $a = 0;
//     function int(int $i)
//     {
//         self::$a += $i;
//         return self::$a < 1000;
//     }
// }

// function test(int $i = 1)
// {
//     $a = new a;
//     if ($a->int($i)) {
//         echo $i . ' ';
//         usleep(50000);
//         return test($i);
//     } else {
//         return a::$a;
//     }
// }
// echo test();
// class a
// {
//     public $a = '';
//     private function __construct()
//     {
//         $this->a = 'a';
//     }
// }
// class b extends a
// {
// }
// echo (new b)->a;
// abstract class a
// {
//     public $message;
//     abstract protected function aa(): string;
//     function __construct()
//     {
//         $this->message = $this->aa();
//     }
// }

// class b extends a
// {
//     function aa(): string
//     {
//         return 'a';
//     }
// }

// $b = new b;
// echo $b->message;
// var_dump(getmygid());
// sleep(3);
// class a
// {
//     function __destruct()
//     {
//         echo 'a';
//     }

//     protected function as()
//     {
//         echo 'c';
//     }
// }

// class b extends a
// {
//     private $b = 'c';
//     function __construct($a)
//     {
//         $this->b = $a;
//     }
//     function ef()
//     {
//         echo 'b';
//         exit;
//     }
//     function ex()
//     {
//         $this->as();
//     }

//     function bb()
//     {
//         echo $this->b;
//     }
// }
// $b = new b('a');
// // $b->bb();
// var_dump($c = serialize($b));
// $d = unserialize($c);
// $d->bb();
// $b = new b;
// // $b->ef();
// // $b->ex();
// $c = new b;
// $c->ex();
// date('')
// $d = new DateTime('now', new DateTimeZone('+0800'));
// $d->setTimestamp(1614234828);
// var_dump($d->format('Y-m-d H:i:sO'));
// $wtString = '2020/07/21 05:22:00 -0400';
// $wagersArr = explode(' ', $wtString);
// echo $wagersTime = (new DateTime($wagersArr[0] . ' ' . $wagersArr[1], new DateTimeZone($wagersArr[2])))->getTimestamp();
// echo PHP_EOL;
// echo date('Ymd HisO', $wagersTime);
// var_dump($_SERVER['HTTP_HOST']);
// var_dump((int)'');
// $v = json_decode('{"BB\u89c6\u8baf":[["BB\u89c6\u8baf","3"]],"BB\u5c0f\u8d39":[["BB\u5c0f\u8d39","99"]],"\u8d4c\u795e\u5385":[["\u8d4c\u795e\u5385","35"]],"AG\u89c6\u8baf":[["AG\u89c6\u8baf","19"]],"\u6b27\u535a\u89c6\u8baf":[["\u6b27\u535a\u89c6\u8baf","22"]],"BG\u89c6\u8baf":[["BG\u89c6\u8baf","36"]],"EVO\u89c6\u8baf":[["EVO\u89c6\u8baf","47"]],"eBET\u89c6\u8baf":[["eBET\u89c6\u8baf","54"]],"MG\u89c6\u8baf":[["MG\u89c6\u8baf","72"]],"XBB\u89c6\u8baf":[["XBB\u89c6\u8baf","75"]],"NBB\u533a\u5757\u94fe":[["NBB\u533a\u5757\u94fe","93"]],"BC\u89c6\u8baf":[["BC\u89c6\u8baf","96"]],"SSG\u89c6\u8baf":[["SSG\u89c6\u8baf","98"]],"N2\u89c6\u8baf":[["N2\u89c6\u8baf","104"]],"AE\u89c6\u8baf":[["AE\u89c6\u8baf","105"]],"BB\u7535\u5b50":[["BB\u7535\u5b50","5"]],"BB\u6355\u9c7c\u5927\u5e08":[["BB\u6355\u9c7c\u5927\u5e08","38"]],"BB\u6355\u9c7c\u8fbe\u4eba":[["BB\u6355\u9c7c\u8fbe\u4eba","30"]],"PT\u7535\u5b50":[["PT\u7535\u5b50","20"]],"GNS\u7535\u5b50":[["GNS\u7535\u5b50","28"]],"ISB\u7535\u5b50":[["ISB\u7535\u5b50","29"]],"HB\u7535\u5b50":[["HB\u7535\u5b50","32"]],"PP\u7535\u5b50":[["PP\u7535\u5b50","37"]],"JDB\u7535\u5b50":[["JDB\u7535\u5b50","39"]],"AG\u7535\u5b50":[["AG\u7535\u5b50","40"]],"\u5927\u6ee1\u8d2f\u7535\u5b50":[["\u5927\u6ee1\u8d2f\u7535\u5b50","41"]],"SG\u7535\u5b50":[["SG\u7535\u5b50","44"]],"SW\u7535\u5b50":[["SW\u7535\u5b50","46"]],"WM\u7535\u5b50":[["WM\u7535\u5b50","50"]],"CQ9\u7535\u5b50":[["CQ9\u7535\u5b50","52"]],"KA\u7535\u5b50":[["KA\u7535\u5b50","53"]],"PG\u7535\u5b50":[["PG\u7535\u5b50","58"]],"FG\u7535\u5b50":[["FG\u7535\u5b50","59"]],"MT\u7535\u5b50":[["MT\u7535\u5b50","71"]],"XBB\u7535\u5b50":[["XBB\u7535\u5b50","76"]],"PS\u7535\u5b50":[["PS\u7535\u5b50","79"]],"MG\u7535\u5b50":[["MG\u7535\u5b50","82"]],"DF\u7535\u5b50":[["DF\u7535\u5b50","85"]],"BNG\u7535\u5b50":[["BNG\u7535\u5b50","95"]],"BBP\u7535\u5b50":[["BBP\u7535\u5b50","107"]],"FC\u7535\u5b50":[["FC\u7535\u5b50","114"]],"\u963f\u7c73\u5df4\u7535\u5b50":[["\u963f\u7c73\u5df4\u7535\u5b50","117"]],"RSG\u7535\u5b50":[["RSG\u7535\u5b50","118"]],"Hi\u7535\u5b50":[["Hi\u7535\u5b50","119"]],"BB\u4f53\u80b2":[["BB\u4f53\u80b2","1"]],"New BB\u4f53\u80b2":[["New BB\u4f53\u80b2","31"]],"\u6ce2\u97f3\u4f53\u80b2":[["\u6ce2\u97f3\u4f53\u80b2","55"]],"\u7687\u51a0\u4f53\u80b2":[["\u7687\u51a0\u4f53\u80b2","65"]],"BR\u865a\u62df":[["BR\u865a\u62df","84"]],"MG\u865a\u62df":[["MG\u865a\u62df","102"]],"\u6c99\u5df4\u4f53\u80b2":[["\u6c99\u5df4\u4f53\u80b2","106"]],"IM\u7535\u7ade":[["IM\u7535\u7ade","108"]],"XBB\u4f53\u80b2":[["XBB\u4f53\u80b2","109"]],"Asia365":[["Asia365","113"]],"BB\u5f69\u7968":[["BB\u5f69\u7968","12"]],"VR\u5f69\u7968":[["VR\u5f69\u7968","45"]],"XBB\u5f69\u7968":[["XBB\u5f69\u7968","73"]],"\u5f00\u5143\u68cb\u724c":[["\u5f00\u5143\u68cb\u724c","49"]],"\u6613\u6e38\u68cb\u724c":[["\u6613\u6e38\u68cb\u724c","62"]],"MT\u68cb\u724c":[["MT\u68cb\u724c","64"]],"BB\u68cb\u724c":[["BB\u68cb\u724c","66"]],"JDB\u68cb\u724c":[["JDB\u68cb\u724c","68"]],"FG\u68cb\u724c":[["FG\u68cb\u724c","69"]],"ACE\u68cb\u724c":[["ACE\u68cb\u724c","77"]],"\u5e78\u8fd0\u68cb\u724c":[["\u5e78\u8fd0\u68cb\u724c","81"]],"\u4e50\u6e38\u68cb\u724c":[["\u4e50\u6e38\u68cb\u724c","83"]],"\u5929\u6e38\u68cb\u724c":[["\u5929\u6e38\u68cb\u724c","111"]],"BBP\u68cb\u724c":[["BBP\u68cb\u724c","112"]],"\u6b22\u4e50\u68cb\u724c":[["\u6b22\u4e50\u68cb\u724c","115"]]}', true);
// $res = \json_decode($mconn->query("SELECT * FROM `web_set` WHERE `set_key` = 'game_set_json'")->fetch_all(MYSQLI_ASSOC)[0]['value'], true);
// // var_dump(array_column(array_values($res), 1, 0));
// $list = false;
// foreach ($res as $d) {
//     if (in_array('', array_column($d, 0))) $list = true;
// }
// var_dump($list);
// $json = json_encode($output);
// $json = 'gVrx4YxvgQQaFmwjxVSezev5+geJlAHyNx2OwMYGatSV3cnSMDZpy9Y0HWPDbSnx8fJusY7u6DCiM97+RC9xpPRWHxR7uebpDb0Ml\/ue4XTPRyIYJsK6BqxxGh3Pls+oyL14QYHS4hAKVHtXrtRLWsmbmrh02HzBtW\/HrYeWYNdoB5TRTvEhJYTfvdlM\/DjOOSK+jOpCTPHF7m+8jnNNyFZScDbmoh60g0IQ5RWpA9Ni3sB7tMt3iD+urKZ0epx8myUa7GcoMBz715zwe+O9tTBXu5k1tjgrJaiqdjHhVHu\/rK4gL281\/SJ8AzlQKK+YE36Br8VnMv1rrvdgv8nejzoQ3\/8656gvMLrYpG1rK7TS5TmKbTFWEcA1CHGXjcBighwt9uW0JgN25PFhr0VpydLc5nFKzoZ4l7LI9BEdiqLd917Kc+7TpvBCi+Tg5UQefnGuMypwOLA\/kg5AXRlZCyBJPmDk62QTwKP22dpJhhxQirkR7L+jnQQRhTlN5CrBavVZbGtlGG7ivpRQf19xyHZF6FciJQ4jjQn0q1t4HA1mkqOe0GeIrnZUlB+0yBTfi2MCQ303LwD2j86YRB0JzpmNr+OM9DDN9J+rjWgOQZ8ZikwQQn2wTfmnFYzZUgnjwxBk+DXJ82qBsznmtPQ5\/lShm7ztBlBUAUsgqZm+oUc=';
// $key = hash('md5', 1234);
// $deBase = base64_decode($json);
// $decrypt_msg = openssl_decrypt($deBase, 'AES-256-CBC', $key, 1, substr($key, 0, 16));
// var_dump($decrypt_msg);
// $f = file_get_contents('C:\Users\Usr\Downloads\300install321\300install321\data\main\controllers\robot_con.php');
// $x = unpack('H',$f);
// var_dump($x);
// $d = new DateTime('now', new DateTimeZone('+0800'));
// $d->setTimestamp(1620809179);
// echo $d->format('YmdHis');
// echo getmypid();
// sleep(2);
// echo exec('tasklist /FI "pid eq 15592"');
// $data = json_decode('{"sidebar":[{"group_name":"\u7f51\u7ad9\u914d\u7f6e","english_name":"web_config","children":[{"name":"\u7f51\u7ad9\u8bbe\u7f6e","english_name":"websetting","url":"websetting"},{"name":"\u6d3b\u52a8\u914d\u7f6e","english_name":"eventsetting","url":"eventsetting"},{"name":"\u524d\u53f0\u5185\u5bb9\u914d\u7f6e","english_name":"frontcontent","url":"frontcontent"},{"name":"\u8baf\u606f\u8bbe\u7f6e","english_name":"messages","url":"messages"}]},{"group_name":"\u6570\u636e\u7ba1\u7406","english_name":"data_manage","children":[{"name":"\u6c47\u5165\u6570\u636e","english_name":"importdata","url":"importdata"},{"name":"\u5468\u671f\u7edf\u8ba1","english_name":"weekstatistics","url":"weekstatistics"}]},{"group_name":"\u8ba2\u5355\u7ba1\u7406","english_name":"order_manage","children":[{"name":"\u7b49\u5f85\u5ba1\u6838","english_name":"orderpending","url":"orderpending"},{"name":"\u5ba1\u6838\u901a\u8fc7","english_name":"orderreviewed","url":"orderreviewed"},{"name":"\u5ba1\u6838\u9a73\u56de","english_name":"orderrejected","url":"orderrejected"},{"name":"\u5145\u503c\u6210\u529f","english_name":"orderremittance","url":"orderremittance"},{"name":"\u5145\u503c\u5931\u8d25","english_name":"orderremittancefail","url":"orderremittancefail"},{"name":"\u5386\u53f2\u7eaa\u5f55","english_name":"orderhistorical","url":"orderhistorical"}]}]}', true);
// print_r($data);
// $arr[] = $data['sidebar'][1]['children'][0];
// $arr[] = $data['sidebar'][1]['children'][2];
// // unset($data['sidebar'][1]['children'][1]);
// $data['sidebar'][1]['children'] = $arr;
// echo json_encode($data);
// echo strtotime('2021-06-01 12:00:00');
// var_dump(str_split(md5(time() + random_int(PHP_INT_MIN, PHP_INT_MAX)), 20));
// echo disk_free_space('/') / 1024 / 1024 / 1024;
// echo log(3,81);
// $arr = ['a', 'b', 'c'];
// var_dump($arr);
// array_slice($arr, 1);
// var_dump($arr);
$date = new DateTime('now', new DateTimeZone('-0400'));
$date->setTimestamp(1631860286);
echo $date->format('Y-m-d H:i:s');
