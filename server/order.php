<?php
$userID = $_GET["userid"];

require("linksql.php");
    $sql = "
    select *
    FROM orderList
    where userID = '$userID'
    ORDER BY `orderList`.`comp` ASC;
    ";
    $revalue = mysqli_query($link, $sql);
    mysqli_close($link);
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
  <div class="container" style="margin-top:80px">
        <h2>訂單查看</h2>
        <div id="accordion">
            <?php while($row = mysqli_fetch_assoc($revalue)){ $orderID = $row["orderID"] ;?>
            <div class="card">
                <div class="card-header">
                    <a class="collapsed card-link btn-block" data-toggle="collapse" href="#d<?= $row["orderID"] ?>">
                    訂單編號：<?= $row["orderID"] ?>
                    </a>
                </div>
                <div id="d<?= $row["orderID"] ?>" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <?= $row["time"] ?><br>
                        地址：<?= $row["address"]  ?>
                        <?php 
                            require("linksql.php");
                            $sql = "
                            SELECT shopPicture, `buyID`, `orderID`, `userID`, b.`shopName`, b.`shopID`, b.`price`, `number`, `count` 
                            FROM `buyList` b
                            join shopList s on s.shopID = b.shopID
                            WHERE orderID = $orderID;
                            ";
                            $buylist = mysqli_query($link, $sql);
                            mysqli_close($link);
                            $sum = 0;
                        ?>
                        <table class="table table-hover">
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
                                <td><img src="http://localhost/PID_Assignment/client/image/<?php if($buy["shopPicture"]) {echo $buy["shopPicture"];} else{echo "1_II52xSQJ4RKcLwVMLKjgog.png";} ?>" alt="NULL" width="50" height="50">   </td>
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
                            <?php if($row["comp"] == '0') {
                                    echo "<h4>訂單狀態：未完成</h4>";
                                    echo "<a href='comp.php?orderID=$orderID' class = 'btn-outline-success btn'>完成訂單</a>";
                                }else{
                                    echo "<h4>訂單狀態：已完成</h4>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    
  <div class="container text-center">
    <br><hr>
    <a href="usecontrol.php" class = "btn-outline-info btn ">返回首頁</a>
  </div>
</body>
</html>