<?php
    if(session_status()==PHP_SESSION_NONE) session_start();
    if(isset($_POST["report_start"]) && isset($_POST["report_end"])){
        $_SESSION["RWeb-start"] = $_POST['report_start'];
        $_SESSION["RWeb-end"] = $_POST['report_end'];
        $_SESSION["RWeb-limit"] = $_POST['report_limit'];
        $_SESSION["RWeb-color"] = $_POST['report_color'];
    }
    exit();
?>