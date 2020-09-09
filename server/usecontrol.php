<?php 
    session_start();
    if(@$_SESSION["rootID"] == ""){
        echo "<h2>違法操作，請重新登入</h2>";
        echo "<a href='index.php'>回首頁</a>";
        exit();
    }else{
        $userID = $_SESSION["rootID"];
    }
    require("linksql.php");
        $sql = "select userName, userID, password
        FROM rootList 
        where userID = '$userID'";
    $revalue = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($revalue);
    mysqli_close($link);
    if(isset($_POST["loginout"])){
        $_SESSION["rootID"] = "";
        echo "<script> alert('登出成功'); location.href ='index.php';</script>";
        exit();
    }
    if(isset($_POST["member"])){
        header("Location: member.php");
        exit();
    }

    if(isset($_POST["shop"])){
        header("Location: shopLab.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>管理者操作介面</title>
</head>
<body>
    <h2 class="text-primary text-center">歡迎回來 !</h2>
    <h2 class="text-primary text-center">管理者[ <?= $row["userName"] ?> ]</h2>

    <form action="" method = "post">
        <div class="container-fluid">
            <button name = "member" class="btn btn-lg btn-primary btn-block">會員管理</button>
            <button name = "shop" class="btn btn-lg btn-info btn-block">商品管理</button>
            <button name = "loginout" class="btn btn-lg btn-danger btn-block">登出</button>
        </div>
    </form>
    <?php
    ?>
</body>
</html>