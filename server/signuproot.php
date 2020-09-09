<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>註冊</title>
</head>
<body>

    <?php
            $user = "Rooter"; // 管理者名字
            $userID = "root02"; // 帳號
            $password = "1234"; // 密碼
            $hash = password_hash($password , PASSWORD_DEFAULT );

            require("linksql.php");
            $sql = "INSERT INTO rootList (`userName`, `UserID`, `password`) VALUES
            ('$user', '$userID', '$hash');";
            $revalue = mysqli_query($link, $sql);
            // var_dump($revalue);
            if($revalue == false){
                echo "<script> alert('警告：註冊失敗，帳號重複'); location.href ='index.php';</script>";
            }
            else{
                mysqli_close($link);
                echo "<script> alert('註冊成功'); location.href ='index.php';</script>";
                exit();
            }
    ?>
</body>
</html>