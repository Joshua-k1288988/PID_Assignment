<?php
$userID = $_GET["userid"];
require("linksql.php");
$sqlsetconnect = <<<multi
    select userName, userID, whiteORblack
    from userList 
    where userID = '$userID';
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
  <h2>會員清單
  </h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>會員名字</th>
        <th>帳號</th>
        <th>狀態</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($resulut)) { ?>
      <tr>
        <td><?php echo $row["userName"] ?></td>
        <td><?php echo $row["userID"] ?></td>
        <td><?php if((int)$row["whiteORblack"] == 0){echo "正常";} else{echo "黑名單";}   ?></td>
        <td>
            <span class = "float-right">
                <a href="./order.php?userid=<?php echo $row["userID"] ?>" class = "btn-outline-success btn-sm">訂單查詢</a>
                |
                <a href="./daletetable.php?userid=<?php echo $row["userID"] ?>" class = "btn-outline-danger btn-sm">改變狀態</a>
            </span>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>