<?php

if(!isset($_GET["shopid"])){
    die ("id not found");
}
$shopid = $_GET["shopid"];
if(! is_numeric($shopid)){
    die ("id not a number.");
}

require("linksql.php");

  
  $sql = "select * from shopList where shopID = $shopid";
  $resule =  mysqli_query($link,$sql);
  $row = mysqli_fetch_assoc($resule);
  // var_dump($row);
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改商品</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
</head>
<body>
<br>
<div class="container">
  <form action = "" method = "post" enctype="multipart/form-data">
    <div class="form-group row">
      <label for="shopName" class="col-4 col-form-label text-center">*商品名稱</label> 
      <div class="col-8">
        <input id="shopName" name="shopName" type="text" class="form-control" value = "<?= $row["shopName"] ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="price" class="col-4 col-form-label text-center">*價錢</label> 
      <div class="col-8">
        <input id="price" name="price" type="text" class="form-control" pattern="[0-9]{1,}" value = "<?= $row["price"] ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="lab" class="col-4 col-form-label text-center">介紹</label> 
      <div class="col-8">
        <textarea id="lab" name="lab" row = "5" class="form-control" ><?= $row["shopLab"] ?></textarea>
      </div>
    </div>
    <br>
    <div class="form-group row">
      <label for="lab" class="col-4 col-form-label text-center">選擇檔案:</label> 
      <div class="col-8">
        <input type="file" accept = "image/*" name="file" id="file" />
      </div>
    </div>
    
    <!-- <input type="submit" name="submit" value="上傳檔案" /> -->
    <br>
    <div class="form-group row" >
      <div class="offset-4 col-8">
        <button name="okbtn" type="submit" class="btn btn-primary">確定</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>

<?php
if(isset($_POST["okbtn"])){
  $shopName = $_POST["shopName"];
  $price = $_POST["price"];
  $lab = $_POST["lab"];
  if($shopName == "" || $price == ""){
    echo "<script> alert('警告：* 為必填欄位');</script>";
    exit();
  }

  if($_FILES["file"]["error"] > 0){
    $fileName = "";
    require("linksql.php");
    $sql = "update shopList set 
    shopName = '$shopName',
    price = $price,
    shopLab = '$lab',
    shopPicture = '$fileName'
    where shopID = $shopid;";
    $revalue = mysqli_query($link,$sql);
    if($revalue == false){
      echo "<script> alert('警告：修改失敗');</script>";
      exit();
    }else{
      echo "<script> alert('修改成功'); location.href ='shopLab.php';</script>";
      exit();
    }

    echo "Error:" . $fileName;
  }else{
    $fileName = $_FILES["file"]["name"];
    require("linksql.php");
    $sql = "update shopList set 
    shopName = '$shopName',
    price = $price,
    shopLab = '$lab',
    shopPicture = '$fileName'
    where shopID = $shopid;";
    $revalue = mysqli_query($link,$sql);
    if($revalue == false){
      echo "<script> alert('警告：修改失敗');</script>";
      exit();
    }else{
      echo "<script> alert('修改成功'); location.href ='shopLab.php';</script>";
      move_uploaded_file($_FILES["file"]["tmp_name"], "/Applications/XAMPP/xamppfiles/htdocs/PID_Assignment/client/image/" . $_FILES["file"]["name"]);
      exit();
    }
  }
}

?>