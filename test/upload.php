<?php
    if($_FILES["file"]["error"] > 0){
        echo "Error:" . $_FILES["file"]['error'];
    }else{
        echo "檔案名稱:" . $_FILES["file"]["name"] . "<br>";
        echo "檔案類型:" . $_FILES["file"]["type"] . "<br>";
        echo "檔案大小:" . ($_FILES["file"]["size"]/1024) . "Kb<br>";
        echo "暫存名稱:" . $_FILES["file"]["tmp_name"] . "<br>";
        
        move_uploaded_file($_FILES["file"]["tmp_name"], "image/" . $_FILES["file"]["name"]);
        var_dump(move_uploaded_file($_FILES["file"]["tmp_name"], "/Applications/XAMPP/xamppfiles/htdocs/PID_Assignment/server/image/" . $_FILES["file"]["name"]));
    }
?>