<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<br>
    <form class="container" method = "post">
    <div class="form-group row" >
        <label for="text1" class="col-4 col-form-label text-center">帳號</label> 
        <div class="col-8">
        <div class="input-group">
            <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fa fa-user"></i>
            </div>
            </div> 
            <input id="text1" name="userID" type="text" class="form-control">
        </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-4 col-form-label text-center" for="text">密碼</label> 
        <div class="col-8">
        <div class="input-group">
            <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fa fa-lock"></i>
            </div>
            </div> 
            <input id="text" name="userPassword" type="password" class="form-control">
        </div>
        </div>
    </div> 
    <div class="form-group row">
        <div class="offset-4 col-8">
        <button name="login" type="submit" class="btn btn-primary">登入</button>
        </div>
    </div>
    </form>
    <?php
        if(isset($_POST["login"])){
            if($_POST["userID"] == "" || $_POST["userPassword"] == ""){
                echo "<p class='text-danger text-center'>請輸入帳號和密碼</p>";
                exit();
            }
            $userID = $_POST["userID"];
            $password = $_POST["userPassword"];
            require("linksql.php");
            $sql = "select userName, userID, password
            FROM rootList 
            where userID = '$userID'";
            $revalue = mysqli_query($link, $sql);
            if($revalue == false){
                echo "<p class='text-danger text-center'>帳號或密碼錯誤</p>";
            }
            else{
                $row = mysqli_fetch_assoc($revalue); 
                if(password_verify($_POST["userPassword"], $row["password"])){
                    $_SESSION["userID"] = $row["userID"];
                    // echo $_SESSION["userID"];
                    header("Location: usecontrol.php");
                    exit();
                }
                else{
                    echo "<p class='text-danger text-center'>帳號或密碼錯誤</p>";
                }
            }
        }
    ?>
</body>
</html>