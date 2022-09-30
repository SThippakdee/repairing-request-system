<?php
    if(session_status()==PHP_SESSION_NONE) session_start();
    require_once("database/connect.php");
    if(isset($_POST["action"])){
        $action = $_POST["action"];

        //View Request
        if($action == "viewRequest"){
            $_SESSION["RWeb-paramID"] = $_POST['req_id'];
            exit();
        }

        //Update Request
        if($action == "updateRequest"){
            $req_id = $_POST["req_id"];
            $req_status = $_POST["req_status"];

            $solv_id = $_POST["solv_id"];
            $solv_detail = $_POST["solv_detail"];
            $solv_note = $_POST["solv_note"];
            $solv_date = date('Y-m-d');

            $sql = "UPDATE request SET req_status = ? WHERE req_id = ?;";

            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('ss', $req_status, $req_id);
            
            if($stmt->execute()){
                $sql = "UPDATE request_solving SET solv_detail = ?, solv_note = ?, solv_date = ? WHERE solv_id = ?;";

                $stmt =  $repairDB->stmt_init(); 
                $stmt->prepare($sql);
                $stmt->bind_param('sssi', $solv_detail, $solv_note, $solv_date, $solv_id);
                if($stmt->execute()){
                    $_SESSION["RWeb-paramID"] = $req_id;
                    echo "success";
                }else{
                    die("alert|ไม่สามารถอัพเดทรายการได้ :". $repairDB->error);
                }
            }else{
                die("alert|ไม่สามารถอัพเดทรายการได้ :". $repairDB->error);
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