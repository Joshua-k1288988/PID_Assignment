<?php
    session_start();
    $userID = $_GET["userID"];
    $orderID = $_GET["orderID"];
    require("linksql.php");
    $sql = "
    select userName from userList where userID = '$userID';
    ";
    $user = mysqli_fetch_assoc(mysqli_query($link,$sql));
    $userName = $user["userName"];

    $sql = "
    select * from orderList where userID = '$userID' AND orderID = $orderID;
    ";
    $order = mysqli_fetch_assoc(mysqli_query($link,$sql));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>結算</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<br><h3 class = "container bg-primary text-light text-center">感謝購買</h3><br>
    <div class = "container card border border-dark">
        <br>
        <h5>名字：<?= $userName; ?></h5>
        <h5>地址：<?= $order["address"]; ?></h5>
        <h5>訂單編號：<?= $order["orderID"]; ?></h5>
        <h5>訂單成立時間：<?= $order["time"]; ?></h5>
        <?php 
            require("linksql.php");
            $sql = "
            SELECT shopPicture, `buyID`, `orderID`, `userID`, b.`shopName`, b.`shopID`, b.`price`, `number`, `count` 
            FROM `buyList` b
            join shopList s on s.shopID = b.shopID
            WHERE orderID = $orderID AND userID = '$userID';
            ";
            $buylist = mysqli_query($link, $sql);
            mysqli_close($link);
            $sum = 0;
        ?>
        <table class="table table-hover  card">
            <thead>
            <tr>
                <th>圖片</th>
                <th>商品名稱</th>
                <th>商品代號</th>
                <th>價錢</th>
                <th>數量</th>
                <th>總價</th>
            </tr>
            </thead>
            <tbody>
            <?php while($buy = mysqli_fetch_assoc($buylist)) { ?>
            <tr>
                <td><img src="http://localhost/PID_Assignment/client/image/<?php if($buy["shopPicture"]) {echo $buy["shopPicture"];} else{echo "noimage/1_II52xSQJ4RKcLwVMLKjgog.png";} ?>" alt="NULL" width="50" height="50">   </td>
                <td><?php echo $buy["shopName"] ?></td>
                <td><?php echo $buy["shopID"] ?></td>
                <td><?php echo $buy["price"] ?></td>
                <td><?php echo $buy["number"] ?></td>
                <td><?php echo $buy["count"] ?></td>
            </tr>
            <?php $sum = $sum + $buy["count"];  } ?>
            </tbody>
        </table>
        <hr class = "border-dark">
        <div class="container text-right">
            <h4>總共：＄<?= $sum ?> 元</h4>
        </div>
        
    </div>
    <br>
    <div class="container text-center">
        <a href="index.php" class = "btn-outline-info btn ">返回首頁</a>
    </div>
</body>
</html>