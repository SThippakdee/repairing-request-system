<?php
    require_once("app/script/header-u.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>รายการแจ้งซ่อม</title>

	<!-- Include fonts/css/js -->
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

	<link href="asset/vendors/select2/select2.min.css" rel="stylesheet">
    <link href="asset/css/accordion.css" rel="stylesheet">
	<link href="asset/css/app.css" rel="stylesheet">
	<link href="asset/vendors/fontawesome-6.1.2/css/all.min.css" rel="stylesheet">
	
	<script src="asset/js/app.js"></script>
	<script src="asset/vendors/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="asset/vendors/sweetalert2/sweetalert2.all.min.js"></script>
	<script src="asset/vendors/select2/select2.min.js"></script>
	
	<!-- Page Style -->
	<STYLE type="text/css">
		body {
			font-family: "Kanit"; 
		}
		.mini-profile {
			overflow: hidden;
			object-fit: cover;
		}
        .select2 {
            width:100%!important;
        }
		.card-profile-img {
			position: relative;
			width: 8rem;
			height: 8rem;
			margin-top: -6rem;
			margin-bottom: 1rem;
			border: 3px solid #fff;
			border-radius: 100%;
			box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);
			z-index: 2;
		}
		.card-profile .card-header {
			height: 9rem;
			background-position: center center;
			background-size: cover;
		}
	</STYLE>
</head>

<body>
	<div class="wrapper">
		<!--Sidebar-->
		<?php require_once("app/components/sidebar-user.php");?>

		<div class="main">
			<!--Topbar-->
			<?php require_once("app/components/topbar.php");?>

			<main class="content" style="background-color: #EBEBEB;">
				<div class="container-fluid p-0">
					<!--Start Content-->
					<div class="row">
						<div class="col">
							<div class="card h-100">
						        <div class="card-body">
                                    <h4 class="text-center mt-4 mb-3 fw-bold"> แบบบันทึกการขอใช้บริการงานซ่อม </h4>
                                    
                                    <?php
                                        $sql = $sql = sprintf(" SELECT  req_id, req_date, SV.service_id, service_name, DT.type_id, type_name, dev_serial, req_detail, req_status,
                                                                        user_name, user_lastname, dep_name, user_tel 
                                                                FROM    request RQ 
                                                                LEFT JOIN user US ON RQ.user_id = US.user_id 
                                                                LEFT JOIN user_dep DP ON US.dep_id = DP.dep_id
                                                                LEFT JOIN service SV ON RQ.service_id = SV.service_id
                                                                LEFT JOIN device_type DT ON DT.type_id = RQ.type_id
                                                                WHERE req_id = '%s';", $_SESSION["RWeb-paramID"]);
                                                                
                                        $reqResult=$repairDB->query($sql);
                                                                    
                                        if($reqResult->num_rows==0){
                                            ?>
                                                <script>history.back()</script>
                                            <?php
                                        }

                                        $req=$reqResult->fetch_assoc();
                                    ?>

                                    <div class="row p-2 g-3 justify-content-center">

                                        <div class="col-12 col-xxl-10 mb-0">
                                            <h5 class="text-center text-md-end">
                                                รหัสรายการแจ้งซ่อม <?php echo $req["req_id"];?>
                                            </h5>
                                        </div>

                                        <div class="col-12 col-xxl-10 mt-0">
                                            <div class="card shadow-lg border border-2">
                                                <div class="card-body p-4">
                                                    
                                                    <div class="row">
                                                        ส่วนของผู้ใช้บริการ
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            วันที่ขอรับบริการ
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo date('d/m/Y', strtotime($req['req_date'])); ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            ชื่อผู้ขอรับบริการ
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $req["user_name"].' '.$req["user_lastname"];?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            หน่วยงาน/แผนก
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $req["dep_name"];?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            โทรศัพท์
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $req["user_tel"];?>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        ส่วนของรายละเอียดการขอบริการ
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            เรื่องที่ขอบริการ
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $req['service_name'] != ''? $req['service_name']: 'บริการนี้ถูกนำออกแล้ว';?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            ประเภทครุภัณฑ์
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $req['type_name'] != ''? $req['type_name']: 'ประเภทครุภัณฑ์นี้ถูกนำออกแล้ว';?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            หมายเลขครุภัณฑ์
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $req['dev_serial'];?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            รายละเอียดปัญหาที่พบ
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $req['req_detail'];?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            สถานะรายการแจ้งซ่อม
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $req['req_status']; ?>
                                                        </div>
                                                    </div>

                                                    <?php
                                                        $sql = sprintf("SELECT  solv_id, solv_date, req_id, solv_detail, solv_note, officer_id, 
                                                                                (select CONCAT(user_name, ' ', user_lastname) FROM user WHERE user_id = officer_id)as officer_name  
                                                                                FROM request_solving RS
                                                                                LEFT JOIN user US ON RS.officer_id = US.user_id
                                                                                WHERE req_id = '%s';", $req['req_id']);           
                                                        
                                                        $solvResult=$repairDB->query($sql);
                                                        if($solvResult->num_rows > 0){
                                                            $solv=$solvResult->fetch_assoc();   
                                                    ?>

                                                    <div class="row mt-3">
                                                        ส่วนของผู้ดำเนินการ / ผู้ประเมิน
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            วันที่บันทึก
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                        <?php echo date('d/m/Y', strtotime($solv['solv_date']));?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            รายละเอียดการให้บริการ
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $solv['solv_detail'];?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            หมายเหตุ
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $solv['solv_note'];?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            ผู้ตรวจสอบ/ประเมิน
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $solv['officer_name'];?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php
                                                        }
                                                        
                                                        $req_id = $req['req_id'];
                                                        $sql = "SELECT ser_id, ser_date, ser_average, ser_feedback FROM request_servey WHERE req_id = '$req_id'";
                                                        $serveyResult=$repairDB->query($sql);
                                                        if($serveyResult-> num_rows > 0){
                                                            $servey=$serveyResult->fetch_assoc();
                                                    ?>

                                                    <div class="row mt-3">
                                                        ส่วนของการประเมินความพึงพอใจหลังการใช้บริการ
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            วันที่ประเมิน
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                        <?php echo date('d/m/Y', strtotime($servey['ser_date']));?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            คะแนนเฉลี่ย
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo number_format( $servey['ser_average'], 2 );?> คะแนน
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            ข้อเสนอแนะ
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $servey['ser_feedback'];?>
                                                        </div>
                                                    </div>

                                                    <?php } ?>

                                                </div>
                                            </div>  
                                        </div>
                                        
                                        <?php
                                            if($req["req_status"] == "ดำเนินการเสร็จสิ้น" OR $req["req_status"] == "ยกเลิกรายการ"){
                                                $sql = sprintf("SELECT ser_id FROM request_servey WHERE req_id = '%s';", $req["req_id"]);
                                                $serveyResult=$repairDB->query($sql);
                                                if($serveyResult->num_rows == 0){
                                        ?>

                                        <div class="col-12 col-xxl-10 mt-0 mb-4">
                                        <form id="serveyForm" action="be-servey-manage.php" method="POST">
                                            <div class="accordion" id="accordion">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="heading">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-controls="collapseTwo">
                                                        <i class="fa-solid fa-star fa-lg text-warning me-2"></i>แบบประเมินความพึงพอใจหลังการใช้บริการ 
                                                    </button>
                                                    </h2>
                                                    <div id="collapse" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordion">
                                                    <div class="accordion-body">
                                                        <input type="hidden" name="req_id" value="<?php echo $req['req_id'];?>">
                                                        รายการประเมิน
                                                        <?php
                                                            $sql = "SELECT * FROM servey_topic ORDER BY top_id;";
                                                            $topicResult=$repairDB->query($sql);
                                                            while ($top = $topicResult->fetch_assoc()){
                                                        ?>

                                                        <div class="row me-1 ms-1 border-top border-start border-end">
                                                            <div class="col mt-2">
                                                                <?php echo $top['top_name'];?>
                                                            </div>
                                                            <div class="col-12 col-lg-5">
                                                                <div class="rating h1 text-warning" data-topic="<?php echo $top['top_id'];?>"></div>
                                                                <input id="<?php echo $top['top_id'];?>" type="hidden" name="topic[<?php echo $top['top_id'];?>]" value="1">
                                                            </div>    
                                                        </div>

                                                        <?php } ?>
                                                        <div class="row me-1 ms-1 border-top"></div>
                                                        
                                                        <div class="row mt-3">
                                                            <div class="col-12">
                                                                ข้อเสนอแนะ (ถ้ามี)
                                                                <textarea name="ser_feedback" class="form-control" placeholder="ระบุข้อเสนอแนะเพื่อปรับปรุงการให้บริการ" style="height: 100px"></textarea>  
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-end mt-3">
                                                            <div class="col-12 col-md-3 col-lg-12 col-xl-3">
                                                                <button type="submit" class="btn btn-lg btn-primary w-100 text-nowrap">
                                                                    <i class="fa-solid fa-paper-plane fa-lg me-2"></i>
                                                                    ส่งแบบประเมิน
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        </div>

                                        <?php }}?>

                                        <div class="col-12 col-xxl-10 mt-0">
                                        <form id="updateRequestForm" action="be-request-manage.php" method="POST">
                                            <div class="card h-100 shadow-lg border border-2">
                                                <div class="card-body">
                                                    <h5 class="card-title">แก้ไขรายละเอียดการขอบริการ</h5>
                                                    <div class="mb-2 mt-4">
                                                        <div class="row">
                                                            <div class="col-12 mb-2">
                                                                <input type="hidden" name="action" value="updateRequest">
                                                                <input type="hidden" name="req_id" value="<?php echo $req['req_id'];?>">

                                                                <?php
                                                                    $sql = sprintf("SELECT * FROM service ORDER BY service_name;");
                                                                    $serviceResult=$repairDB->query($sql);
                                                                ?>

                                                                เรื่องที่ขอบริการ
                                                                <select id="service" name="service_id" class="form-select" required>
                                                                    <option value="" disabled>-- เลือกเรื่องที่ขอบริการ --</option>
                                                                    <option <?php if($req["service_id"]=="") echo "selected";?> value= ''>บริการนี้ถูกนำออกแล้ว</option>
                                                                    <?php
                                                                        while ($service = $serviceResult->fetch_assoc()){
                                                                    ?>

                                                                    <option value="<?php echo $service['service_id'];?>" <?php if($req["service_id"]==$service['service_id']) echo "selected";?>><?php echo $service['service_name'];?></option>
                                                                            
                                                                    <?php } ?>

                                                                </select>
                                                            </div>
                                                            <div class="col-12 mb-2">

                                                                <?php
                                                                    $sql = sprintf("SELECT * FROM device_type ORDER BY type_name;");
                                                                    $typeResult=$repairDB->query($sql);
                                                                ?>

                                                                ประเภทครุภัณฑ์
                                                                <select id="deviceType" name="type_id" class="form-select" required>
                                                                    <option value="" disabled>-- เลือกประเภทครุภัณฑ์ --</option>
                                                                    <option <?php if($req["type_id"]=="") echo "selected";?> value= ''>ประเภทครุภัณฑ์นี้ถูกนำออกแล้ว</option>
                                                                    <?php
                                                                        while ($type = $typeResult->fetch_assoc()){
                                                                    ?>

                                                                    <option value="<?php echo $type['type_id'];?>" <?php if($req["type_id"]==$type['type_id']) echo "selected";?>><?php echo $type['type_name'];?></option>

                                                                    <?php } ?>

                                                                </select>
                                                            </div>
                                                            <div class="col-12 mb-2">
                                                                หมายเลขครุภัณฑ์ (ถ้ามี)
                                                                <input id="dev_serial" type="text" name="dev_serial" class="form-control form-control-lg" autocomplete="off" placeholder="ระบุหมายเลขครุภัณฑ์"
                                                                value="<?php echo $req['dev_serial'];?>"/>
                                                            </div>
                                                            <div class="col-12">
                                                                รายละเอียดปัญหาที่พบ
                                                                <textarea id="req_detail" name="req_detail" class="form-control" placeholder="ระบุรายละเอียดของปัญหาที่พบ" style="height: 100px" required><?php echo $req['req_detail'];?></textarea>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row g-2 mt-1 mb-0 justify-content-end">
                                                <div class="col-12 col-md-3 col-lg-12 col-xl-3">
                                                    <a class="btn btn-lg btn-secondary w-100 text-nowrap" onclick="history.back()">
                                                        <i class="fa-solid fa-circle-chevron-left fa-lg me-2"></i>
                                                        ย้อนกลับ
                                                    </a>
                                                </div>
                                                <div id="delButton" class="col-12 col-md-3 col-lg-12 col-xl-3">
                                                    <?php $req_id = $req["req_id"];?>
                                                    <a class="btn btn-lg btn-warning w-100 text-nowrap" onclick="deleteReq('<?php echo $req_id;?>')">
                                                        <i class="fa-solid fa-lg fa-trash-can me-2"></i>
                                                        ลบรายการ
                                                    </a>
                                                </div>
                                                <div class="col-12 col-md-3 col-lg-12 col-xl-3">
                                                    <a class="btn btn-lg btn-info w-100 text-nowrap" target="blank" href="printview.php?req_id=<?php echo $req['req_id'];?>">
                                                        <i class="fa-solid fa-print fa-lg me-2"></i>
                                                        พิมพ์รายการ
                                                    </a>
                                                </div>
                                                <div id="updateButton" class="col-12 col-md-3 col-lg-12 col-xl-3">
                                                    <button type="submit" class="btn btn-lg btn-primary w-100 text-nowrap">
                                                        <i class="fa-regular fa-floppy-disk fa-lg me-2"></i>
                                                        อัพเดท
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
							    </div>
							</div>
						</div>
					</div>
					<!--End Content-->

				</div>
			</main>
			<!--Footer-->
			<?php require_once("app/components/footer.php");?>
			
		</div>
	</div>

	<script src="app/script/sidebar.js"></script>
    <script src="app/script/request-manage-u.js"></script>
    <script src="app/script/servey-manage.js"></script>
    <script src="asset/vendors/rater-js/rater-js.min.js"></script>
    <script>
		$(document).ready(function() {
            $(".rating").rate({
                max_value: 5,
                step_size: 1,
                initial_value: 1,
                selected_symbol_type: 'utf8_star',
                cursor: 'pointer',
                readonly: false,
                change_once: false
            });
			$('#deviceType').select2();
            $('#service').select2();
		});
        $(".rating").on("change", function(){
            var topicID = $(this).data("topic");
            var value = $(this).rate("getValue");
            $("#"+topicID.toString()).val(value.toString());
        });
	</script>
</body>
</html>
<?php $repairDB->close(); ?>