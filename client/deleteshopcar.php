<?php

if(!isset($_GET["shoppingid"])){
    die ("id not found");
}
$shoppingid = $_GET["shoppingid"];
if(! is_numeric($shoppingid)){
    die ("id not a number.");
}
$sql = <<<multi
delete from shoppingcar where shoppingID = $shoppingid
multi;
// echo $sql;
 require("linksql.php");
 mysqli_query($link,$sql);
 mysqli_close($link);
 header("location: shoppingcar.php");
?>