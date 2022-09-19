<?php
    if(session_status()==PHP_SESSION_NONE) session_start();
    if(isset($_SESSION["RWeb-userID"]) && isset($_SESSION["RWeb-userLevel"])){
        $level = $_SESSION["RWeb-userLevel"];
        if($level == '1'){
            header('Location: a-dashboard.php');
        }
        if($level == '2'){
            header('Location: o-request-all.php');
        }
        if($level == '3'){
            header('Location: u-request.php');
        }
    }else{
        header('Location: index.php');
    }
    exit();
?>