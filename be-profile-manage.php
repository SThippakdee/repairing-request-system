<?php
    if(isset($_POST['action'])){
        require_once("database/connect.php");
        $action = $_POST["action"];

        //Update Data
        if($action == "updateData"){
            $user_id = $_POST["user_id"];
            $user_name = $_POST["user_name"];
            $user_lastname = $_POST["user_lastname"];
            $user_tel = $_POST["user_tel"];
            $dep_id = $_POST["dep_id"];
            if($dep_id =="") $dep_id = null;
            $user_username = $_POST["user_username"];

            //Check duplicate username
            $sql = "SELECT user_id FROM user WHERE user_username = ? AND user_id <> ?;";
            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('ss', $user_username, $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows>0){
                echo "alert|Username นี้ถูกใช้โดยบัญชีอื่นแล้ว";
            }else{
                $sql = "UPDATE user SET user_name = ?, user_lastname = ?, user_tel = ?, dep_id = ?, user_username = ? WHERE user_id = ?;";
                $stmt =  $repairDB->stmt_init(); 
                $stmt->prepare($sql);
                $stmt->bind_param('sssiss', $user_name, $user_lastname, $user_tel, $dep_id, $user_username, $user_id);
                if($stmt->execute()){
                    echo "success";
                }else{
                    die("alert|ไม่สามารถอัพเดทข้อมูลได้ :". $repairDB->error);
                }
            }
        }

        //Reset Password
        if($action == "resetPassword"){
            $user_id = $_POST["user_id"];
            $user_password = $_POST["user_password"];

            $user_password = password_hash("$user_password", PASSWORD_DEFAULT);
            if(isset($_COOKIE["RWeb-token"])) {
                setcookie ("RWeb-token","");
            }

            $sql = "UPDATE user SET user_password = ?, user_token = null WHERE user_id = ?;";
            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('ss', $user_password, $user_id);
            if($stmt->execute()){
                echo "success";
            }else{
                die("alert|ไม่สามารถรีเซ็ตรหัสผ่านได้ :". $repairDB->error);
            } 
        }

        //Update Profile Img
        if($action == "updateImg"){
            if(!empty($_FILES['user_profile']['tmp_name'])){
                $user_id = $_POST['user_id']; 
                $old_profile = $_POST['old_profile'];
                
                if($user_id == ""){
                    $user_id = $_SESSION["RWeb-paramID"];
                }

                $uploaddir = 'img/avatars/';
                $user_profile = "default-avatar.png";
                
                //Upload Img
                list($name, $extension) = explode(".", $_FILES['user_profile']['name']);
                $name = uniqid("IMG-");
                $file=sprintf("%s.%s", $name, $extension);                                
                $uploadfile = $uploaddir . $file;
                if (copy($_FILES['user_profile']['tmp_name'], $uploadfile)) {
                    $user_profile = $file;

                    //Delete old avatar img
                    if($old_profile != "default-avatar.png"){
                        $old_profile = sprintf("img/avatars/%s", $old_profile);
                        unlink($old_profile);
                    }

                    $sql = "UPDATE user SET user_profile = ? WHERE user_id = ?;";
                    $stmt =  $repairDB->stmt_init(); 
                    $stmt->prepare($sql);
                    $stmt->bind_param('ss', $user_profile, $user_id);
                    if($stmt->execute()){
                        header("location:javascript://history.go(-1)");
                    }else{
                        die("alert|ไม่สามารถเปลี่ยนรูปโปรไฟล์ได้ :". $repairDB->error);
                    }               
                }   
            }else{
                header("location:javascript://history.go(-1)");
            }
        }
    }

    $repairDB->close();
    exit();
?>