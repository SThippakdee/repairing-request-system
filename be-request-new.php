<?php
    require_once("database/connect.php");
    if(isset($_POST)){
        $req_id = uniqid("REQ-");
        $user_id = $_POST["user_id"];
        $service_id = $_POST["service_id"];
        $type_id = $_POST["type_id"];
        $dev_serial = $_POST["dev_serial"];
        $req_date = $_POST["req_date"];
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
    $repairDB->close();
    exit();
?>