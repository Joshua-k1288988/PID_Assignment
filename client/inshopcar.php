<?php
    session_start();
    if(! $_SESSION["userID"]) { header("Location: login.php"); exit(); }
    $shpID = $_GET["shopID"];
    require("linksql.php");
    $sql = "
    select *
    FROM shopList
    where shopID = $shpID
    ";
    $revalue = mysqli_query($link, $sql);
    mysqli_close($link);
    $row = mysqli_fetch_assoc($revalue);

    $userID = $_SESSION["userID"];
    $shopName = $row["shopName"];
    $shopID = $row["shopID"];
    $shopPicture = $row["shopPicture"];
    $price = $row["price"];
    $number = $_GET["number"];
    $count = (int)$price * (int)$number;
    echo $count;

    require("linksql.php");
    $sql = "
    INSERT INTO `shoppingcar`(`userID`, `shopName`, `shopID`, `shopPicture`, `price`, `number`, `count`) 
    VALUES ('$userID', '$shopName', $shopID, '$shopPicture', $price, $number, $count);
    ";
    $revalue = mysqli_query($link, $sql);
    mysqli_close($link);
    if($revalue){
        echo "<script> alert('成功放入購物車'); location.href ='".$_SERVER["HTTP_REFERER"]."';</script>";
        exit();
    }
    else{
        echo "<script> alert('操作失敗'); location.href ='".$_SERVER["HTTP_REFERER"]."';</script>";
        exit();
    }
    mysqli_close($link);
?>