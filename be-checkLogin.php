<?php
    if(session_status()==PHP_SESSION_NONE) session_start();
    require_once("database/connect.php");

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT `user_id`, `user_password`, `user_token`, `user_level` FROM user WHERE user_username = ?;";
        $stmt =  $repairDB->stmt_init(); 
        $stmt->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            if(password_verify($password, $row['user_password']) or password_verify($password, $row['user_token'])){
                $_SESSION["RWeb-userID"] = $row["user_id"];
                $_SESSION["RWeb-userLevel"] = $row["user_level"];
                
                //สร้าง token มาใช้แทน password ในกรณีที่ผู้ใช้คลิก จดจำบัญชีผู้ใช้ (สร้างใหม่เมื่อ login)
                if(!empty($_POST["remember"])) {
                    $token = uniqid('TOKEN-');
                    $hashToken = password_hash("$token", PASSWORD_DEFAULT);
                    $sql = sprintf("UPDATE user SET `user_token` = '%s' WHERE `user_id` = '%s';", $hashToken, $row["user_id"]);
                    $repairDB->query($sql);

                    setcookie ("RWeb-userName", $username, time()+ (365 * 24 * 60 * 60));
                    setcookie ("RWeb-token", $token, time()+ (365 * 24 * 60 * 60));
                } else {
                    if(isset($_COOKIE["RWeb-userName"])) {
                        setcookie ("RWeb-userName","");
                    }
                    if(isset($_COOKIE["RWeb-token"])) {
                        setcookie ("RWeb-token","");
                    }
                    $sql = sprintf("UPDATE user SET `user_token` = '' WHERE `user_id` = '%s';", $row["user_id"]);
                    $repairDB->query($sql);
                }
                echo "success";
            }else{
                echo "alert|รหัสผ่านไม่ถูกต้อง โปรดตรวจสอบรหัสผ่าน";
            }
        }else{
            echo "alert|ไม่มีบัญชีผู้ใช้นี้ในระบบ โปรดตรวจสอบชื่อบัญชีผู้ใช้";
        }
    }else{
        header('Location: index.php');
    }

    $repairDB->close();
    exit();   
?>