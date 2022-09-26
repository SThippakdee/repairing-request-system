<?php
    if(session_status()==PHP_SESSION_NONE) session_start();
    require_once("database/connect.php");
    if(isset($_POST["action"])){
        $action = $_POST["action"];

        //Add new request
        if($action == "addNewRequest"){
            $req_id = uniqid("REQ-");
            $user_id = $_POST["user_id"];
            $service_id = $_POST["service_id"];
            $type_id = $_POST["type_id"];
            $dev_serial = $_POST["dev_serial"];
            $req_date = date('Y-m-d');
            $req_detail = $_POST["req_detail"];
            $req_status = "รอดำเนินการ";

            $sql = "INSERT INTO request (req_id, user_id, service_id, type_id, dev_serial, req_date, req_detail, req_status)
                                    VALUES(?,?,?,?,?,?,?,?);";
            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('ssiissss', $req_id, $user_id, $service_id, $type_id, $dev_serial, $req_date, $req_detail, $req_status);
            if($stmt->execute()){
                echo "success";
            }else{
                die("alert|ไม่สามารถเพิ่มรายการได้ :". $repairDB->error);
            }
        }

        //View Request
        if($action == "viewRequest"){
            $_SESSION["RWeb-paramID"] = $_POST['req_id'];
            exit();
        }

        //Update Request
        if($action == "updateRequest"){
            $req_id = $_POST["req_id"];
            $service_id = $_POST["service_id"]; if($service_id=="") $service_id = null;
            $type_id = $_POST["type_id"]; if($type_id=="") $type_id = null;
            $dev_serial = $_POST["dev_serial"];
            $req_detail = $_POST["req_detail"];

            $sql = "UPDATE request SET service_id = ?, type_id = ?, dev_serial = ?, req_detail = ?
                    WHERE req_id = ?;";

            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('iisss', $service_id, $type_id, $dev_serial, $req_detail, $req_id);
            if($stmt->execute()){
                echo "success";
            }else{
                die("alert|ไม่สามารถอัพเดทรายการได้ :". $repairDB->error);
            }
        }

        //Delete Request
        if($action == "deleteRequest"){
            $req_id = $_POST["req_id"];

            $sql = "DELETE FROM request WHERE req_id = ?;";

            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('s', $req_id);
            if($stmt->execute()){
                echo "success";
            }else{
                die("alert|ไม่สามารถลบรายการได้ :". $repairDB->error);
            }
        }

        //Approve Request
        if($action == "approveRequest"){
            $req_id = $_POST["req_id"];
            $officer_id = $_POST["officer_id"];
            $solv_date = date('Y-m-d');

            $sql = "INSERT INTO request_solving(req_id, officer_id, solv_date) VALUES(?, ?, ?);";
            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('sss', $req_id, $officer_id, $solv_date);
            if($stmt->execute()){
                $sql = "UPDATE request SET req_status = 'กำลังดำเนินการ' WHERE req_id = ?;";
                $stmt =  $repairDB->stmt_init(); 
                $stmt->prepare($sql);
                $stmt->bind_param('s', $req_id);
                if($stmt->execute()){
                    echo "success";
                }else{
                    die("alert|ไม่สามารถอัพเดทสถานะรายการแจ้งซ่อมได้ :". $repairDB->error);
                }
            }else{
                die("alert|ไม่สามารถรับคำร้องรายการแจ้งซ่อมได้ :". $repairDB->error);
            }
        }
    }

    $repairDB->close();
    exit();
?>