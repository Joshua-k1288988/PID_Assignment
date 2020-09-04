<?php
$net = "localhost"; // 網址
$userName = "root"; // 使用者
$password = ""; // 密碼
$datebase = "shopDB"; //連接資料庫
$link = mysqli_connect($net, $userName, $password,  $datebase, 3306); 
if(!$link){
    die("連接失敗：" . mysqli_connect_error());
}
mysqli_query($link, "set names utf8");
?>