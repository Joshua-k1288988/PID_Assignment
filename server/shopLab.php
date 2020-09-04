<?php
require("linksql.php");
$sqlsetconnect = <<<multi
    select shopName, shopID, price, shopLab, shopPicture
    from shopList ;
multi;
$resulut = mysqli_query($link , $sqlsetconnect);
// var_dump($resulut);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>會員清單</title>
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
  <h2>會員清單<a href="newshop.php" class = "btn btn-outline-info btn-md float-right">新增</a>
  </h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>圖片</th>
        <th>商品名稱</th>
        <th>商品代號</th>
        <th>價錢</th>
        <th>介紹</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($resulut)) { ?>
      <tr>
        <td><?php echo $row["shopPicture"] ?></td>
        <td><?php echo $row["shopName"] ?></td>
        <td><?php echo $row["shopID"] ?></td>
        <td><?php echo $row["price"] ?></td>
        <td><?php echo $row["shopLab"] ?></td>
        <td>
            <span class = "float-right">
                <a href="./order.php?userid=<?php echo $row["userID"] ?>" class = "btn-outline-success btn-sm">修改</a>
                |
                <a href="./daletetable.php?userid=<?php echo $row["userID"] ?>" class = "btn-outline-danger btn-sm">刪除</a>
            </span>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>