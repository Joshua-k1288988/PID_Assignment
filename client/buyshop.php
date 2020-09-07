<?php  
    session_start();
    if(! $_SESSION["userID"]){
        header("Location: index.php");
        exit();
    }
    $userID = $_SESSION["userID"];

    $orderID = time();
    $time = date("Y年m月d日 H:i:s", $orderID );
    require("linksql.php");
    $sql = "
    INSERT INTO `orderList`(`orderID`, `userID`, `time`, `comp`) VALUES
    ($orderID, '$userID', '$time', '0');
    ";
    mysqli_query($link, $sql);


    $sql = "
    SELECT * FROM `shoppingcar` WHERE userID = '$userID';
    ";
    $revalue = mysqli_query($link, $sql);
    mysqli_close($link);
    $sum = 0;
    
    while($row = mysqli_fetch_assoc($revalue)){
        $shopName = $row["shopName"];
        $shopID = $row["shopID"];
        $price = $row["price"];
        $number = $row["number"];
        $count = $row["count"];

        $sum = $sum + (int)$count;

        require("linksql.php");
        $sql = "
        INSERT INTO `buyList`(`orderID`, `userID`, `shopName`, `shopID`, `price`, `number`, `count`) VALUES 
        ($orderID, '$userID', '$shopName', $shopID, $price, $number, $count);
        ";
        mysqli_query($link, $sql);
    }
    require("linksql.php");
        $sql = "
        UPDATE `orderList` SET
        `sum` = $sum
        WHERE orderID = $orderID;
        ";
        mysqli_query($link, $sql);
    mysqli_close($link);

?>