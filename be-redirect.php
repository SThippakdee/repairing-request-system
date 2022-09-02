<?php
    if(!isset($_SESSION)) session_start();
    if(isset($_SESSION["userID"]) && isset($_SESSION["userLevel"])){
        $level = $_SESSION["userLevel"];
        if($level == '1'){
            header('Location: dashboard.php');
        }
    }else{
        header('Location: index.php');
    }
    exit();
?>