<?php
    $orderID = $_GET["orderID"];
    echo $orderID;
    require("linksql.php");
    $sql = "
    UPDATE `orderList` SET comp = '1'
    WHERE orderID = $orderID;
    ";
    $revalue = mysqli_query($link, $sql);
    mysqli_close($link);
    if($revalue){
        echo "<script> alert('完成訂單'); location.href ='".$_SERVER["HTTP_REFERER"]."';</script>";
        exit();
    }else{
        echo "<script> alert('發生錯誤'); location.href ='".$_SERVER["HTTP_REFERER"]."';</script>";
        exit();
    }
    
?>