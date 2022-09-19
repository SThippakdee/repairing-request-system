<?php
    if(isset($_POST)){
        require_once("database/connect.php");
        $req_id = $_POST["req_id"];
        $ser_date = date('Y-m-d');
        $ser_feedback = $_POST["ser_feedback"];

        //Add servey record
        $sql = "INSERT INTO  request_servey(req_id, ser_date, ser_feedback) VALUES (?, ?, ?);";
        $stmt =  $repairDB->stmt_init(); 
        $stmt->prepare($sql);
        $stmt->bind_param('sss', $req_id, $ser_date, $ser_feedback);
        if($stmt->execute()){
            //Add each servey list to servey record
            $ser_id = $repairDB->insert_id;
            $topic = $_POST["topic"];
            $sql = "";

            foreach($topic as $top_id => $list_rate) {
                $sql = " INSERT INTO servey_list(ser_id, top_id, list_rate) VALUES ($ser_id, $top_id, $list_rate);";
                $repairDB->query($sql);
            }
            
            
            //Get Average rating score from servey record
            $sql="SELECT AVG(list_rate) AS averagePoint FROM servey_list WHERE ser_id = $ser_id;";
            $avgResult=$repairDB->query($sql);
            $avg = $avgResult->fetch_assoc();
            $avg = $avg['averagePoint'];

            //Update Average rating score to servey record
            $sql="UPDATE request_servey SET ser_average = $avg WHERE ser_id = $ser_id;";
            if($repairDB->query($sql)){
                echo "success";
            }else{
                die("alert|ไม่สามารถบันทึกการประเมินได้ :". $repairDB->error);
            }
        }else{
            die("alert|ไม่สามารถบันทึกการประเมินได้ :". $repairDB->error);
        }  
    }
    $repairDB->close();
    exit();
?>