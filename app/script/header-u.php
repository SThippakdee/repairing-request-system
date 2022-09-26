<?php
    //Check login session & userlevel
    if(session_status()==PHP_SESSION_NONE) session_start();
    if(!isset($_SESSION["RWeb-userID"]) or !isset($_SESSION["RWeb-userLevel"])){
        header("Location: index.php");
        exit();
    }
    if($_SESSION["RWeb-userLevel"] != "3"){
        header("Location: index.php");
        exit();
	}
	
	require_once("database/connect.php");
	$sql = sprintf("SELECT user_name, user_lastname, user_profile FROM user WHERE user_id = '%s'", $_SESSION['RWeb-userID']);
    $result=$repairDB->query($sql);
	if($result->num_rows==0){
        header("Location: index.php");
        exit;
    }
	$row=$result->fetch_assoc();
?>