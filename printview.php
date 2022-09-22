<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>.</title>

	<!-- Include fonts/css/js -->
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	
	<link href="asset/css/app.css" rel="stylesheet">
	<link href="asset/vendors/fontawesome-6.1.2/css/all.min.css" rel="stylesheet">
	
	<script src="asset/js/app.js"></script>
	<script src="asset/vendors/jquery-3.6.0/jquery-3.6.0.min.js"></script>
	
	<!-- Page Style -->
	<STYLE type="text/css">
		body {
			font-family: "Kanit"; 
		}
        td, tr, th{
            height: 6px;
        }
	</STYLE>
</head>
<body>
    <?php
        require_once("database/connect.php");
        $sql = sprintf(" SELECT  req_id, req_date, SV.service_id, service_name, DT.type_id, type_name, dev_serial, req_detail, req_status,
                                        RQ.user_id, user_name, user_lastname, dep_name, user_tel 
                                FROM    request RQ 
                                LEFT JOIN user US ON RQ.user_id = US.user_id 
                                LEFT JOIN user_dep DP ON US.dep_id = DP.dep_id
                                LEFT JOIN service SV ON RQ.service_id = SV.service_id
                                LEFT JOIN device_type DT ON DT.type_id = RQ.type_id
                                WHERE req_id = '%s';", $_GET["req_id"]);
                                                                
        $reqResult=$repairDB->query($sql);
                                                                    
        if($reqResult->num_rows==0){
            ?>
                <script>window.close()</script>
            <?php
        }

        $req=$reqResult->fetch_assoc();
    ?>

    <div class="row">
        <div class="col text-center mt-3 h4">
            แบบบันทึกการขอใช้บริการงานซ่อม
        </div>
    </div>
    <div class="row">
        <div class="col text-start h5 mt-4 h4">
            รหัสรายการแจ้งซ่อม : <?php echo $req["req_id"];?>
        </div>
    </div>
    ___________________________________________________________________________________________________________<br>
        <u>ส่วนของผู้ใช้บริการ</u>
        <div class="row mt-3">
            <div class="col-4">วันที่ขอรับบริการ</div>
            <div class="col"><?php echo date('d/m/Y', strtotime($req['req_date'])); ?></div>
        </div>
        <div class="row mt-1">
            <div class="col-4">ชื่อผู้ขอรับบริการ</div>
            <div class="col"><?php echo $req["user_name"].' '.$req["user_lastname"];?></div>
        </div>
        <div class="row mt-1">
            <div class="col-4">หน่วยงาน/แผนก</div>
            <div class="col"><?php echo $req["dep_name"];?></div>
        </div>
        <div class="row mt-1">
            <div class="col-4">โทรศัพท์</div>
            <div class="col"><?php echo $req["user_tel"];?></div>
        </div>
    ___________________________________________________________________________________________________________<br>
        <u>ส่วนของรายละเอียดการขอบริการ</u>
        <div class="row mt-3">
            <div class="col-4">เรื่องที่ขอบริการ</div>
            <div class="col"><?php echo $req['service_name'] != ''? $req['service_name']: 'บริการนี้ถูกนำออกแล้ว';?></div>
        </div>
        <div class="row mt-1">
            <div class="col-4">ประเภทครุภัณฑ์</div>
            <div class="col"><?php echo $req['type_name'] != ''? $req['type_name']: 'ประเภทครุภัณฑ์นี้ถูกนำออกแล้ว';?></div>
        </div>
        <div class="row mt-1">
            <div class="col-4">หมายเลขครุภัณฑ์(ถ้ามี)</div>
            <div class="col"><?php echo $req['dev_serial'];?></div>
        </div>
        <div class="row mt-1">
            <div class="col-4">รายละเอียดของปัญหาที่พบ</div>
            <div class="col"><?php echo $req['req_detail'];?></div>
        </div>
        <div class="row mt-1">
            <div class="col-4">สถานะรายการแจ้งซ่อม</div>
            <div class="col"><?php echo $req['req_status']; ?></div>
        </div>
    ___________________________________________________________________________________________________________<br>
    
    <?php
        $sql = sprintf("SELECT  solv_id, solv_date, req_id, solv_detail, solv_note, officer_id, 
                                (select CONCAT(user_name, ' ', user_lastname) FROM user WHERE user_id = officer_id)as officer_name  
                        FROM request_solving RS
                        LEFT JOIN user US ON RS.officer_id = US.user_id
                        WHERE req_id = '%s';", $req['req_id']);           
                                                        
        $solvResult=$repairDB->query($sql);
        $record = $solvResult->num_rows;
        if($record > 0){
            $solv=$solvResult->fetch_assoc();
        }   
    ?>
        
        <u>ส่วนของผู้ดำเนินการ</u>
        <div class="row mt-3">
            <div class="col-4">วันที่บันทึก</div>
            <div class="col"><?php if($record > 0) echo date('d/m/Y', strtotime($solv['solv_date']));?></div>
        </div>
        <div class="row mt-1">
            <div class="col-4">รายละเอียดการให้บริการ</div>
            <div class="col"><?php if($record > 0) echo $solv['solv_detail'];?></div>
        </div>
        <div class="row mt-1">
            <div class="col-4">หมายเหตุ(การติดตามผล)</div>
            <div class="col"><?php if($record > 0) echo $solv['solv_note'];?></div>
        </div>
        <div class="row mt-1">
            <div class="col-4">ผู้ตรวจสอบ/ผู้ประเมิน</div>
            <div class="col"><?php if($record > 0) echo $solv['officer_name'];?></div>
        </div>
    ___________________________________________________________________________________________________________<br>
    
    <?php
        $req_id = $req['req_id'];
        $sql = "SELECT ser_id, ser_date, ser_feedback FROM request_servey WHERE req_id = '$req_id'";
        $serveyResult=$repairDB->query($sql);
        $record = $serveyResult->num_rows;
        if($record > 0){
            $servey=$serveyResult->fetch_assoc();
        }
    ?>

    <u>การประเมินความพึงพอใจหลังรับบริการ</u>

    <table class="table w-100 mt-3 p-0 border border-dark">
        <thead>
            <tr>
                <th rowspan="3" class="text-center border border-dark align-middle">หัวข้อการประเมินความพึงพอใจ</th>
                <th colspan="5" class="text-center border border-dark">ระดับความพึงพอใจ</th>
            </tr>
            <tr>
                <th width="11%;" class="text-center small fw-bold border border-dark">ควรปรับปรุง</th>
                <th width="11%;" class="text-center small fw-bold border border-dark">พอใช้</th>
                <th width="11%;" class="text-center small fw-bold border border-dark">ปานกลาง</th>
                <th width="11%;" class="text-center small fw-bold border border-dark">ดี</th>
                <th width="11%;" class="text-center small fw-bold border border-dark">ดีมาก</th>
            </tr>
        </thead>
        <tbody>
        
            <?php
                if($record > 0){
                    $ser_id = $servey["ser_id"];
                    $sql = "SELECT      ST.top_id, ST.top_name, SL.top_id, SL.list_rate 
                            FROM        servey_list SL
                            LEFT JOIN   servey_topic ST ON ST.top_id = SL.top_id
                            WHERE       SL.ser_id = '$ser_id'";
                    $rowResult=$repairDB->query($sql);
                    while ($list = $rowResult->fetch_assoc()){
            ?>

            <tr>
                <td class="border border-dark"><?php echo $list['top_name'];?></td>
                <td width="11%;" class="text-center border border-dark"><?php if($list['list_rate']==1) echo "&check;";?></td>
                <td width="11%;" class="text-center border border-dark"><?php if($list['list_rate']==2) echo "&check;";?></td>
                <td width="11%;" class="text-center border border-dark"><?php if($list['list_rate']==3) echo "&check;";?></td>
                <td width="11%;" class="text-center border border-dark"><?php if($list['list_rate']==4) echo "&check;";?></td>
                <td width="11%;" class="text-center border border-dark"><?php if($list['list_rate']==5) echo "&check;";?></td>
            </tr>
            
            <?php
                    }
                }else{
                    $sql = "SELECT * FROM servey_topic";
                    $rowResult=$repairDB->query($sql);
                    while ($list = $rowResult->fetch_assoc()){
            ?>

            <tr>
                <td class="border border-dark"><?php echo $list['top_name'];?></td>
                <td width="11%;" class="text-center border border-dark"></td>
                <td width="11%;" class="text-center border border-dark"></td>
                <td width="11%;" class="text-center border border-dark"></td>
                <td width="11%;" class="text-center border border-dark"></td>
                <td width="11%;" class="text-center border border-dark"></td>
            </tr>
            
            <?php
                    }
                }
            ?>

        </tbody>
    </table>

    <div class="row mt-3">
        <div class="col-12">ข้อเสนอแนะจากผู้รับบริการ</div>
        <div class="col"><?php if($record != 0) echo $servey['ser_feedback'];?></div>
    </div>

    <?php $repairDB->close(); ?>

    <script type="text/javascript">
        $('document').ready(function () {
            window.focus();
            window.print();
            window.close();
        });
    </script>
</body>