<?php
    if(session_status()==PHP_SESSION_NONE) session_start();
    if(isset($_SESSION["RWeb-userID"]) && isset($_SESSION["RWeb-userLevel"])){
        $level = $_SESSION["RWeb-userLevel"];
        if($level == '1'){
            header('Location: a-dashboard.php');
        }
    }else{
        header('Location: index.php');
    }
    exit();
?>