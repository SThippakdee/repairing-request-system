<?php
    require_once("app/script/a-header.php");
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
		<?php require_once("app/components/sidebar-admin.php");?>

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
                                        
                                        <h4 class="text-center mt-5 mb-4 fw-bold"> แบบบันทึกการขอใช้บริการงานซ่อม </h4>
                                        <form action="be-request-new.php" method="POST">
                                            <div class="row p-2">
                                                <div class="col-12 mb-4">
                                                    <div class="card h-100 shadow-lg border border-2">
                                                        <div class="card-body">
                                                            <h5 class="card-title">ส่วนของผู้ใช้บริการ</h5>
                                                            <?php
                                                                $sql = sprintf("SELECT user_id, user_name, user_lastname, user_tel, dep_name FROM user U LEFT JOIN user_dep D 
                                                                                ON U.dep_id = D.dep_id WHERE user_id = '%s'", $_SESSION['RWeb-userID']);
                                                                $result=$repairDB->query($sql);
                                                                $row=$result->fetch_assoc();
                                                            ?>
                                                            <div class="mb-2 mt-4">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-6 mb-2">
                                                                        วันที่ขอรับบริการ
                                                                        <input type="date" name="req_date" class="form-control form-control-lg"
                                                                                value="<?php echo date('Y-m-d');?>" readonly/>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 mb-2">
                                                                        หน่วยงาน/แผนก
                                                                        <input type="text" class="form-control form-control-lg" autocomplete="off"
                                                                                value="<?php echo $row["dep_name"];?>" placeholder="" readonly/>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 mb-2">
                                                                        ชื่อผู้ขอรับบริการ
                                                                        <input type="hidden" name="user_id" value="<?php echo $row["user_id"];?>">
                                                                        <input type="text" class="form-control form-control-lg" autocomplete="off" placeholder="ระบุชื่อ  นามสกุล"
                                                                                value="<?php echo $row["user_name"].' '.$row["user_lastname"];?>" readonly/>
                                                                    </div>
                                                                    <div class="col-12 col-md-6">
                                                                        โทรศัพท์ผู้ขอรับบริการ
                                                                        <input type="text" class="form-control form-control-lg" autocomplete="off" placeholder="ระบุหมายเลขโทรศัพท์"
                                                                                value="<?php echo $row["user_tel"];?>" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="card h-100 shadow-lg border border-2">
                                                        <div class="card-body">
                                                            <h5 class="card-title">ส่วนของรายละเอียดการขอบริการ</h5>
                                                            <div class="mb-2 mt-4">
                                                                <div class="row">
                                                                    <div class="col-12 mb-2">

                                                                        <?php
                                                                            $sql = sprintf("SELECT * FROM service ORDER BY service_name;");
                                                                            $serviceResult=$repairDB->query($sql);
                                                                        ?>

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
                                                                    <div class="col-12 col-md-6 mb-2">

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
                                                                    <div class="col-12 col-md-6 mb-2">
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
                                                </div>
                                            </div>
                                            <div class="row g-2 p-2 mt-2 mb-0 justify-content-end">
                                                <div class="col-12 col-md-6 col-xl-3">
                                                    <a class="btn btn-lg btn-secondary w-100" href="a-request.php">
                                                        <i class="fa-solid fa-circle-chevron-left fa-lg me-2"></i>
                                                        ย้อนกลับ
                                                    </a>
                                                </div>
                                                <div class="col-12 col-md-6 col-xl-3">
                                                    <button type="submit" class="btn btn-lg btn-primary w-100">
                                                        <i class="fa-regular fa-floppy-disk fa-lg me-2"></i>
                                                        บันทึกรายการ
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

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
    <script type="text/javascript">
        //add record action alert
        $('form').submit(function(e){
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');
            $.ajax({
                type:'post',
                url:actionUrl,
                data:form.serialize(),
                success:function(data) {
                    if(data == "success"){
                        Swal.fire({
                            icon: 'success',
                            showConfirmButton: false,
                            title: 'เพิ่มรายการสำเร็จ',
                            timer: 2000,
                            timerProgressBar: true
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href="a-request.php";
                            }
                        })  
                    }
                    else{
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาดในการเพิ่มรายการ',
                            text: data,
                            showConfirmButton: false
                        })
                    }
                }
            });
        });
    </script>
    <script>
		$(document).ready(function() {
			$('#deviceType').select2();
            $('#service').select2();
		});
	</script>
</body>
</html>
<?php $repairDB->close(); ?>