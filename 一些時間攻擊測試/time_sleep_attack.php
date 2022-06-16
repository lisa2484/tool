<?php
// include './pushdata.php';
// $pr = new pr6post('http://zjd.2277zjd.com/req.sys.php', 'hongbao_html');
// $pr->setApp('frontend');
// $pr->setFunc('get_envelope');
// $data = ['username' => 'taiwintest'];
time_sleep_until(strtotime(date('Y-m-d H:i:00', time() + 60)));
// var_dump($pr->post($data, 'data'), time());

// $b = new mysqli('127.0.0.1', 'root', '', 'test');
// $b->query("UPDATE test SET `blob` = 1 WHERE `blob` = 2 LIMIT 1");
// $b->query("UPDATE tast_count SET `count` = `count` + 1,`success` = `success` + '" . $b->affected_rows . "' WHERE `id` = 1;");
include '../curl.php';
$cu = new Curl;
echo $cu->host('127.0.0.1')->path('api/test')->get();
