<?php 
    if(session_status()==PHP_SESSION_NONE) session_start();
    if(isset($_POST)){
        require_once("database/connect.php");
        require_once("be-sendnotify.php");
        
        $noti_id = $_POST["noti_id"];
        $noti_token = $_POST["noti_token"];
        $old_token = $_POST["old_token"];
        $noti_active = $_POST["noti_active"];
        
        //Check token
        if($noti_token != $old_token){
            if($noti_token != ""){
                $message = "\nระบบแจ้งเตือนพร้อมใช้งาน";
                $test_result = sendNotify($noti_token, $message);
                if($test_result != ""){
                    echo $test_result;
                    exit();
                }
            }
            else{
                $message = "\nยกเลิกการใช้งานระบบแจ้งเตือนแล้ว";
                $test_result = sendNotify($old_token, $message);
                if($test_result != ""){
                    echo $test_result;
                    exit();
                }
            }
        }

        $sql = "UPDATE notify_setting SET noti_token = ?, noti_active = ? WHERE noti_id = ?;";
        $stmt =  $repairDB->stmt_init(); 
        $stmt->prepare($sql);
        $stmt->bind_param('ssi', $noti_token, $noti_active, $noti_id);
        if($stmt->execute()){
            echo "success";
        }else{
            die("alert|ไม่สามารถบันทึกการตั้งค่าได้] :". $repairDB->error);
        }
    }
    $repairDB->close();
    exit();
?>