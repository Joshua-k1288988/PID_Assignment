<?php

if(!isset($_GET["userid"])){
    die ("id not found");
}
$userID = $_GET["userid"];
$whiORbla = $_GET["WB"];
if((int)$whiORbla == 0){
    $sql = <<<multi
UPDATE `userList` SET `whiteORblack`=1 WHERE userID = '$userID'
multi;
}else{
    $sql = <<<multi
UPDATE `userList` SET `whiteORblack`=0 WHERE userID = '$userID'
multi;
}

// echo $sql;
 require("linksql.php");
 mysqli_query($link,$sql);
 header("location: member.php");
?>