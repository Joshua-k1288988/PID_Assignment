<?php
    session_start();
    $userID = $_SESSION["userID"];

    require("linksql.php");
    if($_SESSION["userID"]){
        $userID = $_SESSION["userID"];
        $sql = "
        select whiteORblack
        from userList
        where userID = '$userID';
        ";
        $worb = mysqli_fetch_assoc(mysqli_query($link, $sql));
        if($worb["whiteORblack"] == 1){
          echo "<script>alert('該帳號目前無法使用');location.href='index.php';</script>";
          $_SESSION = array();
          exit();
        }
    }

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>訂單查看</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
            <a class="navbar-brand" href="index.php">回首頁</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="nav navbar-nav mr-auto">
        </ul>

        <ul class="nav navbar-nav "> <!-- d-none -->
            <li class="nav-item <?php if(@$_SESSION["userID"] != ""){echo "d-none";} ?>">
            <a class="nav-link " href="login.php">登入</a>
            </li>
            <li class="nav-item <?php if(@$_SESSION["userID"] != ""){echo "d-none";} ?>">
            <a class="nav-link ">|</a>
            </li>
            <li class="nav-item <?php if(@$_SESSION["userID"] != ""){echo "d-none";} ?>">
            <a class="nav-link " href="signup.php">註冊</a>
            </li>

            <?php if(@$_SESSION["userID"] != ""){?>
            <li class="nav-item">
                <a class="nav-link ">您好，<?= $_SESSION["userName"] ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link ">|</a>
            </li>
        <li class="nav-item">
        <a class="nav-link " href="shoppingcar.php">購物車</a>
        </li>
        <li class="nav-item">
            <a class="nav-link ">|</a>
        </li>
            <li class="nav-item">
                <a class="nav-link " href="loginout.php">登出</a>
            </li>
            <?php } ?>
        </ul>
    </nav>
    
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
                            <?php if($row["comp"] == '0') {
                                    echo "<h4>訂單狀態：未完成</h4>";
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
</body>
</html>