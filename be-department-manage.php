<?php
    if(isset($_POST['dataAction'])){
        require_once("database/connect.php");
        $id = $_POST["dataID"];
        $name = $_POST["dataName"];
        $action = $_POST["dataAction"];

        //Add new record
        if($action == "add"){
            $sql = "INSERT INTO user_dep (dep_name) VALUES(?);";
            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('s', $name);
            if($stmt->execute()){
                echo "success";
            }else{
                die("alert|ไม่สามารถเพิ่มรายการได้ :". $repairDB->error);
            }
        }

        //Update record
        if($action == "edit"){
            $sql = "UPDATE user_dep SET dep_name = ? WHERE dep_id = ?;";
            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('si', $name, $id);
            if($stmt->execute()){
                echo "success";
            }else{
                die("alert|ไม่สามารถแก้ไขรายการได้ :". $repairDB->error);
            }
        }

        //Delete record
        if($action == "delete"){
            $sql = "DELETE FROM user_dep WHERE dep_id = ?;";
            $stmt =  $repairDB->stmt_init(); 
            $stmt->prepare($sql);
            $stmt->bind_param('i', $id);
            if($stmt->execute()){
                echo "success";
            }else{
                die("alert|ไม่สามารถลบรายการได้ :". $repairDB->error);
            }
        }
    }
    $repairDB->close();
    exit();
?>