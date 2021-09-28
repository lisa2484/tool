<?php
// $c = mysqli_connect('127.0.0.1', 'root', '', 'sign');
// $t = "通常有一些方式可以測試網站是否有正確處理特殊字元：

// ><script>alert(document.cookie)</script>
// ='><script>alert(document.cookie)</script>
// \"><script>alert(document.cookie)</script>
// <script>alert(document.cookie)</script>
// <script>alert (vulnerable)</script>
// %3Cscript%3Ealert('XSS')%3C/script%3E
// <script>alert('XSS')</script>
// <img src=\"javascript:alert('XSS')\">
// <img src=\"http://888.888.com/999.png\" onerror=\"alert('XSS')\">
// <div style=\"height:expression(alert('XSS'),1)\"></div>（這個僅於IE7(含)之前有效）";
// // var_dump(mysqli_real_escape_string($c,htmlentities($t)));
// $t = htmlentities($t);
// echo $t;
// var_dump(mysqli_query($c, "SELECT * FROM `order2` WHERE `status2` = 1"));
// var_dump(PHP_VERSION);
// class aa
// {
//     const a = 'bbb';
// }
// function bb(aa $a)
// {
//     echo $a['a'];
// }
// $a = new aa;
// bb($a);
class bench
{
    public function a()
    {
        return 1;
    }
    public static function b()
    {
        return 1;
    }
}
// 動態宣告物件
$s = microtime(1);
$obj = new bench();
for ($i = 0; $i < 1000000; $i++) $obj->a();
$e = microtime(1);
echo "Dynamic Method: " . ($e - $s) . "<br>";   //

// 使用靜態方法使用未宣告為static的方法
// $s = microtime(1);
// for ($i = 0; $i < 100000; $i++) bench::a();
// $e = microtime(1);
// echo "Dynamic Static Method: ".($e - $s)."\n";

// 使用靜態方法使用static方法
$s = microtime(1);
for ($i = 0; $i < 1000000; $i++) bench::b();
$e = microtime(1);
echo "Declared Static Method: " . ($e - $s) . "<br>";
