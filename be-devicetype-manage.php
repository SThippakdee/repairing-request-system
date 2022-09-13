<?php
    if(isset($_POST['dataAction'])){
        require_once("database/connect.php");
        $id = $_POST["dataID"];
        $name = $_POST["dataName"];
        $action = $_POST["dataAction"];

        //Add new record
        if($action == "add"){
            $sql = "INSERT INTO device_type (type_name) VALUES(?);";
            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('s', $name);
            if($stmt->execute()){
                echo "success";
            }else{
                die("alert|ไม่สามารถเพิ่มรายการได้ :". $conn->error);
            }
        }

        //Update record
        if($action == "edit"){
            $sql = "UPDATE device_type SET type_name = ? WHERE type_id = ?;";
            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('si', $name, $id);
            if($stmt->execute()){
                echo "success";
            }else{
                die("alert|ไม่สามารถแก้ไขรายการได้ :". $conn->error);
            }
        }

        //Delete record
        if($action == "delete"){
            $sql = "DELETE FROM device_type WHERE type_id = ?;";
            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('i', $id);
            if($stmt->execute()){
                echo "success";
            }else{
                die("alert|ไม่สามารถลบรายการได้ :". $conn->error);
            }
        }
    }
    $repairDB->close();
    exit();
?>