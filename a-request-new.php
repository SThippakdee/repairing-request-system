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
	
	<link href="asset/css/app.css" rel="stylesheet">
	<link href="asset/vendors/fontawesome-6.1.2/css/all.min.css" rel="stylesheet">
	
	<script src="asset/js/app.js"></script>
	<script src="asset/vendors/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="asset/vendors/sweetalert2/sweetalert2.all.min.js"></script>
	
	<!-- Page Style -->
	<STYLE type="text/css">
		body {
			font-family: "Kanit"; 
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
                                        
                                        <h4 class="text-center mt-5 mb-4 fw-bold"> แบบบันทึกการขอใช้บริการงานซ่อม <h4>
                                        <form action="be-request-new.php" method="POST">
                                            <div class="row p-2">
                                                <div class="col-12 mb-4">
                                                    <div class="rounded p-3 border border-2 shadow-lg">
                                                        ส่วนของผู้ใช้บริการ
                                                        <div class="mb-2 mt-4">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6 mb-2">
                                                                    <span class="h5">วันที่ขอรับบริการ</span>
                                                                    <input type="date" name="req_date" class="form-control form-control-lg"
                                                                            value="<?php echo date('Y-m-d');?>" readonly/>
                                                                </div>
                                                                <div class="col-12 col-md-6 mb-2">
                                                                    <span class="h5">หน่วยงาน/แผนก</span>
                                                                    <input type="text" class="form-control form-control-lg" autocomplete="off" placeholder="ระบุชื่อหน่วยงาน/แผนก"
                                                                            value="" readonly/>
                                                                </div>
                                                                <div class="col-12 col-md-6 mb-2">
                                                                    <span class="h5">ชื่อผู้ขอรับบริการ</span>
                                                                    <input type="hidden" name="user_id" value="">
                                                                    <input type="text" class="form-control form-control-lg" autocomplete="off" placeholder="ระบุชื่อ  นามสกุล"
                                                                            value="" readonly/>
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <span class="h5">โทรศัพท์ผู้ขอรับบริการ</span>
                                                                    <input type="text" class="form-control form-control-lg" autocomplete="off" placeholder="ระบุหมายเลขโทรศัพท์"
                                                                            value="" readonly/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="rounded p-3 border border-2 shadow-lg">
                                                        ส่วนของรายละเอียดการขอบริการ
                                                        <div class="mb-2 mt-4">
                                                            <div class="row">
                                                                <div class="col-12 mb-2">
                                                                    <span class="h5">เรื่องที่ขอบริการ</span>
                                                                    <select id="service" name="service_id" class="form-select form-control-lg">
                                                                        <option selected disabled>-- เลือกบริการ --</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12 col-md-6 mb-2">
                                                                    <span class="h5">ประเภทครุภัณฑ์</span>
                                                                    <select id="deviceType" name="type_id" class="form-select form-control-lg">
                                                                        <option selected disabled>-- เลือกประเภทครุภัณฑ์ --</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12 col-md-6 mb-2">
                                                                    <span class="h5">หมายเลขครุภัณฑ์(ถ้ามี)</span>
                                                                    <input type="text" name="tel" class="form-control form-control-lg" autocomplete="off" placeholder="ระบุหมายเลขครุภัณฑ์"/>
                                                                </div>
                                                                <div class="col-12">
                                                                    <span class="h5">รายละเอียดปัญหาที่พบ</span>
                                                                    <textarea class="form-control" placeholder="ระบุรายละเอียดของปัญหาที่พบ" style="height: 100px"></textarea>  
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
</body>
</html>