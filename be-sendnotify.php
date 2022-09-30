<?php
	function sendNotify($token, $message){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		date_default_timezone_set("Asia/Bangkok");
		
		$sToken = $token;
		$sMessage =	$message;
		
		$chOne = curl_init(); 
		curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
		curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
		curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt( $chOne, CURLOPT_POST, 1); 
		curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
		$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
		curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
		curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
		$result = curl_exec( $chOne ); 

		$return = "";
		//Result error 
		if(curl_error($chOne)) 
		{ 
			$return = "|ไม่สามารถเชื่อมต่อ API ได้ โปรดตรวจสอบการเชื่อมต่อเครือข่าย";
		} 
		else { 
			$result_ = json_decode($result, true); 
			if($result_['status']=="401") $return = "|Access Token ที่ระบุไม่ถูกต้อง";
		} 
		curl_close( $chOne );
		return $return;
	}   
?>