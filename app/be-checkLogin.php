<?php
    if(session_status()==PHP_SESSION_NONE) session_start();
    //require_once("resource/sql/alumniDB-con.php");

    if(isset($_POST['username']) && isset($_POST['password'])){
        // $sql = "SELECT `uID`, `password`, `level` FROM tbl_user WHERE username = ?";
        // $stmt =  $alumniDB->stmt_init(); 
        // $stmt->prepare($sql);
        // $stmt->bind_param('s', $_POST['username']);
        // $stmt->execute();
        // $result = $stmt->get_result();

        // if($result->num_rows>0){
        //     $row=$result->fetch_assoc();
        //     if(password_verify($_POST['password'], $row['password'])){
        //         $_SESSION["RWeb-userID"] = $row["uID"];
        //         $_SESSION["RWeb-userLevel"] = $row["level"];
                
        //         if(!empty($_POST["remember"])) {
        //             setcookie ("username",$_POST["username"],time()+ (365 * 24 * 60 * 60));
        //             setcookie ("password",$_POST["password"],time()+ (365 * 24 * 60 * 60));
        //         } else {
        //             if(isset($_COOKIE["username"])) {
        //                 setcookie ("username","");
        //             }
        //             if(isset($_COOKIE["password"])) {
        //                 setcookie ("password","");
        //             }
        //         }

        //         if($row['level'] == "ศิษย์เก่า"){
        //             echo ("success_alumni");
        //         }
        //         else if($row['level'] == "เจ้าหน้าที่"){
        //             echo ("success_officer");
        //         }
        //         else if($row['level'] == "ผู้ดูแลระบบ"){
        //             echo ("success_admin");
        //         }
        //     }else{
        //         echo ("err_wrongPassword");
        //     }
        // }else{
        //     echo ("err_noAccount");
        // }
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username == "admin"){
            if($password == "root"){
                // $userID = ""
                // $userLevel = ""

                $_SESSION["RWeb-userID"] = 10001;
                $_SESSION["RWeb-userLevel"] = 1;
                echo "success";
            }else{
                echo "รหัสผ่านไม่ถูกต้อง โปรดตรวจสอบรหัสผ่าน";
            }
        }else{
            echo "ไม่มีบัญชีผู้ใช้นี้ในระบบ โปรดตรวจสอบชื่อบัญชีผู้ใช้";
        }
        exit();

    }else{
        header('Location: index.php');
    }
    // $alumniDB = null;
    // exit();   
?>