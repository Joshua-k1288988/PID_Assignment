<?php
$userID = $_GET["userid"];
require("linksql.php");
$sqlsetconnect = <<<multi
    select shopName, b.shopID, b.price, number, count, time, sta
    from buyList b
    join shopList s on s.shopID = b.shopID
    where userID = '$userID';
multi;
$resulut = mysqli_query($link , $sqlsetconnect);
mysqli_close($link);
// var_dump($resulut);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>訂單清單</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<br><br>
<div class="container">
  <h2>會員訂單</h2>
  <h4>會員：<?= $userID; ?></h4>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>商品名稱</th>
        <th>商品代號</th>
        <th>價錢</th>
        <th>數量</th>
        <th>總共</th>
        <th>訂單成立時間</th>
        <th>進度</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($resulut)) { ?>
      <tr>
        <td><?php echo $row["shopName"] ?></td>
        <td><?php echo $row["shopID"] ?></td>
        <td><?php echo $row["price"] ?></td>
        <td><?php echo $row["number"] ?></td>
        <td><?php echo $row["count"] ?></td>
        <td><?php echo $row["time"] ?></td>
        <td><?php echo $row["sta"] ?></td>
        <td>
            <span class = "float-right">
                <a href="./order.php?userid=<?php echo $row["userID"] ?>" class = "btn-outline-success btn-sm">完成訂單</a>
            </span>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>