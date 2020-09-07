<?php
    session_start();
    $_SESSION = array();
    echo "<script>alert('退出成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
    // header("Location: index.php");
?>
