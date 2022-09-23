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
					<h3 id="pageName" class="fw-bold mb-3">เพิ่มรายการแจ้งซ่อม</h3>

					<div class="row">
						<div class="col">
							<div class="card h-100">
						        <div class="card-body">
                                        
                                    <h4 class="text-center mt-4 mb-3 fw-bold"> แบบบันทึกการขอใช้บริการงานซ่อม </h4>

                                    <?php
                                        $sql = sprintf("SELECT user_id, user_name, user_lastname, user_tel, dep_name FROM user U LEFT JOIN user_dep D 
                                        ON U.dep_id = D.dep_id WHERE user_id = '%s'", $_SESSION['RWeb-userID']);
                                        $userResult=$repairDB->query($sql);
                                        $user=$userResult->fetch_assoc();
                                    ?>

                                    <div class="row p-2 g-3 justify-content-center">

                                        <div class="col-12 col-xxl-10 mb-0">
                                            <h5 class="text-center text-md-end">
                                                รหัสรายการแจ้งซ่อม REQ-xxxxxxxxxxxxx
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
                                                            <?php echo date('d/m/Y'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            ชื่อผู้ขอรับบริการ
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $user["user_name"].' '.$user["user_lastname"];?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            หน่วยงาน/แผนก
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $user["dep_name"];?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col border border-secondary py-2 fw-bold" style="background-color: #E5E5E5;">
                                                            โทรศัพท์
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8 col-xxl-9 border border-secondary py-2">
                                                            <?php echo $user["user_tel"];?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-xxl-10 mt-0">
                                        <form id="addRequestForm" action="be-request-manage.php" method="POST">

                                            <div class="card shadow-lg border border-2">
                                                <div class="card-body p-4">
                                                    <h5 class="card-title">ส่วนของรายละเอียดการขอบริการ</h5>
                                                    <div class="mb-2 mt-4">
                                                        <div class="row">
                                                            <div class="col-12 mb-2">

                                                                <?php
                                                                    $sql = sprintf("SELECT * FROM service ORDER BY service_name;");
                                                                    $serviceResult=$repairDB->query($sql);
                                                                ?>

                                                                <input type="hidden" name="action" value="addNewRequest">
                                                                <input type="hidden" name="user_id" value="<?php echo $user["user_id"];?>">

                                                                เรื่องที่ขอบริการ
                                                                <select id="service" name="service_id" class="form-select" required>
                                                                    <option value="" disabled selected>-- เลือกเรื่องที่ขอบริการ --</option>

                                                                    <?php
                                                                        while ($service = $serviceResult->fetch_assoc()){
                                                                    ?>

                                                                    <option value="<?php echo $service['service_id'];?>"><?php echo $service['service_name'];?></option>
                                                                            
                                                                    <?php
                                                                            }
                                                                    ?>

                                                                </select>
                                                            </div>
                                                            <div class="col-12 mb-2">

                                                                <?php
                                                                    $sql = sprintf("SELECT * FROM device_type ORDER BY type_name;");
                                                                    $typeResult=$repairDB->query($sql);
                                                                ?>

                                                                ประเภทครุภัณฑ์
                                                                <select id="deviceType" name="type_id" class="form-select" required>
                                                                    <option value="" disabled selected>-- เลือกประเภทครุภัณฑ์ --</option>

                                                                    <?php
                                                                        while ($type = $typeResult->fetch_assoc()){
                                                                    ?>

                                                                    <option value="<?php echo $type['type_id'];?>"><?php echo $type['type_name'];?></option>

                                                                    <?php
                                                                        }
                                                                    ?>

                                                                </select>
                                                            </div>
                                                            <div class="col-12 mb-2">
                                                                หมายเลขครุภัณฑ์ (ถ้ามี)
                                                                <input type="text" name="dev_serial" class="form-control form-control-lg" autocomplete="off" placeholder="ระบุหมายเลขครุภัณฑ์"/>
                                                            </div>
                                                            <div class="col-12">
                                                                รายละเอียดปัญหาที่พบ
                                                                <textarea name="req_detail" class="form-control" placeholder="ระบุรายละเอียดของปัญหาที่พบ" style="height: 100px" required></textarea>  
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
                                                <div class="col-12 col-md-3 col-lg-12 col-xl-3">
                                                    <button type="submit" class="btn btn-lg btn-primary w-100 text-nowrap">
                                                        <i class="fa-regular fa-floppy-disk fa-lg me-2"></i>
                                                        เพิ่มรายการ
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
    <script>
		$(document).ready(function() {
			$('#deviceType').select2();
            $('#service').select2();
		});
	</script>
</body>
</html>
<?php $repairDB->close(); ?>