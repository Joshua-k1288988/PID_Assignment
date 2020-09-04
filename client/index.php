<?php
  session_start();
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
    <a class="navbar-brand" href="#">回首頁</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
  <ul class="nav navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link " href="#">Link 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="#">Link 3</a>
    </li>
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
        <a class="nav-link ">您好，ＸＸＸ</a>
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
<br><br>
<br>


<div class="container-fluid" style="margin-top:80px">
  <h3>Basic Navbar Example</h3>
  <p>A navigation bar is a navigation header that is placed at the top of the page.</p>
  <p>The navbar-expand-xl|lg|md|sm class determines when the navbar should stack vertically (on extra large, large, medium or small screens).</p>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

</body>
</html>
