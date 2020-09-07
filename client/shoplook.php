<?php
  session_start();
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row["shopName"] ?></title>
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
        <div class="card col-12" style="  width:100%">
            <div class = "row">
                <div class = "col-4"><img class="card-img-top" src="image/<?= $row["shopPicture"] ?>" alt="Card image" style="width:250px"></div>
                <div class = "col-1"></div>
                <div class="card-body col-6">
                    <h4 class="card-title"><?= $row["shopName"] ?></h4>
                    <p class="card-text"><?= $row["shopLab"] ?></p>
                    <p class="card-text">$<?= $row["price"] ?></p>
                    <select id = "number" name="cars" class="custom-select mb-3">
                        <option selected>選擇購買數量</option>
                        <?php  for($i = 1 ; $i<=10 ; $i++){ echo "<option value='$i'>$i</option>"; } ?>
                    </select>

                    <script>
                    function lastone(){
                        location.href = "inshopcar.php?shopID=<?= $row["shopID"] ?>&number=" + document.getElementById("number").value;
                    }
                    </script>
                    
                    <a id = "btnOK"  class="btn btn-primary" onclick = "lastone();"> 放入購物車</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>