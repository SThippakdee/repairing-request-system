<?php
    $dbserver="localhost";
    $username="root";
    $password="";
    $dbname="repair_db";

    //mysqli("เซิร์ฟเวอร์ database", "username", "password", "ชื่อ database");
    $repairDB = new mysqli($dbserver, $username, $password, $dbname);
    if($repairDB->connect_error) die("|ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้ : ".$repairDB->connect_error);
    $repairDB->query("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
    mysqli_query($repairDB, "SET NAMES UTF8");
    mysqli_query($repairDB, "SET character_set_results=utf8");
    mysqli_query($repairDB, "SET character_set_client=utf8");    
    mysqli_query($repairDB, "SET character_set_connection=utf8");
    date_default_timezone_set("Asia/Bangkok");
?>