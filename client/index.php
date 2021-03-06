<?php
  session_start();
  
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
  select shopName, shopID, price, shopLab, shopPicture
  FROM shopList
  ";
  $revalue = mysqli_query($link, $sql);
  mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>購物網</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <a class="navbar-brand" href="">回首頁</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
  <ul class="nav navbar-nav mr-auto">
    <!-- <li class="nav-item">
      <a class="nav-link " href="#">購物車</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="#">Link 3</a>
    </li> -->
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
      <a class="nav-link " href="orders.php">查看訂單</a>
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


<div class="container-fluid" style="margin-top:80px">
  <div class="container  card-columns">
    <?php while($row = mysqli_fetch_assoc($revalue)){  ?>
      <div class="card" style="  width:300px">
        <img class="card-img-top" src="image/<?php if($row["shopPicture"]){echo $row["shopPicture"];}else{ echo "/noimage/1_II52xSQJ4RKcLwVMLKjgog.png"; }  ?>" alt="Card image" style="width:100%">
        <div class="card-body">
          <h5 class="card-title"><?= $row["shopName"] ?></h5>
          <p class="card-text">$<?= $row["price"] ?></p>
          <a href="shoplook.php?shopID=<?= $row["shopID"] ?>" class="btn btn-primary">查看詳情</a>
        </div>
      </div>
    <?php } ?>



  </div>
</div>

</body>
</html>
