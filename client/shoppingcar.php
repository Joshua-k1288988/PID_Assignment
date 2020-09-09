<?php 
  if(isset($_POST["btnOK"])){
    $_SESSION["address"] = $_POST["address"];
    header("Location: buyshop.php");
    exit();
  }  
?>
<?php
    session_start();
    if(! $_SESSION["userID"]){
      header("Location: index.php");
      exit();
    }
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
    SELECT * FROM `shoppingcar` WHERE userID = '$userID';
    ";
    $revalue = mysqli_query($link, $sql);
    mysqli_close($link);
    $sum = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購物車</title>
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
    <div class="container" style="margin-top:80px">
    <h2>購物車清單</h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>圖片</th>
        <th>商品名稱</th>
        <th>商品代號</th>
        <th>價錢</th>
        <th>數量</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($revalue)) { ?>
      <tr>
        <td><img src="http://localhost/PID_Assignment/client/image/<?php if($row["shopPicture"]) {echo $row["shopPicture"];} else{echo "noimage/1_II52xSQJ4RKcLwVMLKjgog.png";} ?>" alt="NULL" width="50" height="50">   </td>
        <td><?php echo $row["shopName"] ?></td>
        <td><?php echo $row["shopID"] ?></td>
        <td><?php echo $row["price"] ?></td>
        <td><?php echo $row["number"] ?></td>
        <td>
            <span class = "float-right">
                <a href="./deleteshopcar.php?shoppingid=<?php echo $row["shoppingID"] ?>" class = "btn-outline-danger btn-sm">刪除</a>
            </span>
        </td>
      </tr>
    <?php $sum = $sum + $row["count"];  } ?>
    </tbody>
  </table>
  <hr class = "border-dark">
</div>

<?php 
  require("linksql.php");
  $sql = "
    SELECT address FROM `userList` WHERE userID = '$userID';
    ";
  $address = mysqli_fetch_assoc(mysqli_query($link, $sql)); 
  mysqli_close($link);

  $_SESSION["sum"] = $sum;
?>
<form  method = "post">
  <div class="container text-right">
      <h4>總共：＄<?= $sum ?> 元</h4>
      <div class="form-group row">
              <label for="address" class="col-4 col-form-label">地址</label> 
              <div class="col-8">
              <input name="address" type="text" class="form-control" value = "<?= $address["address"] ?>">
              </div>
      </div>
      <button id = "btnOK" name = "btnOK" type = "submit" class = "btn-outline-info btn ">購買</buttom>
      
  </div>
</form>

</body>
</html>