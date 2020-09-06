<?php

if(!isset($_GET["shopid"])){
    die ("id not found");
}
$shopid = $_GET["shopid"];
$shopPicture = $_GET["pict"];
if(! is_numeric($shopid)){
    die ("id not a number.");
}
$sql = <<<multi
delete from shopList where shopID = $shopid
multi;
// echo $sql;
 require("linksql.php");
 mysqli_query($link,$sql);
 mysqli_close($link);

 if($shopPicture != "1_II52xSQJ4RKcLwVMLKjgog.png"){
    unlink("/Applications/XAMPP/xamppfiles/htdocs/PID_Assignment/client/image/".$shopPicture);
 }
 header("location: shopLab.php");
?>