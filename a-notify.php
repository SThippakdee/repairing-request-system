<?php
    require_once("app/script/header-a.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ตั้งค่าการแจ้งเตือน</title>

	<!-- Include fonts/css/js -->
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	
	<link href="asset/css/accordion.css" rel="stylesheet">
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
		.mini-profile {
			overflow: hidden;
			object-fit: cover;
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
		.btn-outline-success:hover{
			color: white;
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
					<h3 id="pageName" class="fw-bold mb-3">ตั้งค่าการแจ้งเตือน</h3>
					<div class="row">
						<div class="col-12">
							<div class="card shadow-lg">
								<div class="card-body">
									<form id="mainForm" method="post" action="be-notify.php">

										<?php
											$sql = "SELECT * FROM notify_setting WHERE noti_id = 1;";
											$notiResult=$repairDB->query($sql);
											$noti = $notiResult->fetch_assoc();
										?>

										<div class="row justify-content-center">
											<div class="col-12 col-md-8 mb-2">
												LINE Access Token
												<div class="input-group">
													<input id="line_token" type="text" name="noti_token" class="form-control form-control-lg" autocomplete="off" placeholder="Access Token..."
													value="<?php echo $noti["noti_token"];?>" readonly/>
													<a class="btn btn-outline-success p-2" id="settoken">
														<i class="fa-brands fa-line fa-lg me-2"></i>ตั้งค่า Token
													</a>
												</div>
												<input type="hidden" name="old_token" value="<?php echo $noti["noti_token"];?>">
												<input type="hidden" name="noti_id" value="<?php echo $noti["noti_id"];?>">
											</div>
										</div>
										<div class="row justify-content-center">
											<div class="col-12 col-md-8 mb-2">
												การแจ้งเตือนผ่าน LINE Group
												<div class="row g-2">
													<div class="col-12 col-md-6">
														<div class="btn-group w-100" role="group">
															<input type="hidden" id="noti_active" name="noti_active" value="<?php echo $noti["noti_active"];?>">
															<input id="on" type="radio" class="btn-check" <?php if($noti["noti_active"]=="on") echo "checked";?> name="options" id="on" autocomplete="off">
															<label class="btn btn-outline-primary h-100" for="on">ON</label>
															<input type="radio" class="btn-check" <?php if($noti["noti_active"]=="off") echo "checked";?> name="options" id="off" autocomplete="off">
															<label id="off" class="btn btn-outline-primary h-100" for="off">OFF</label>
														</div>
													</div>
													<div class="col-12 col-md-6">
														<button class="btn btn-primary w-100" type="submit"><i class="fa-solid fa-gear me-2"></i>บันทึก</button>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-0">
						<div class="col-12">
							<div class="card shadow-lg">
								<div class="card-body">
									<div class="row">
										<div class="col mt-2">
											<div class="accordion shadow-lg" id="accordion">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header shadow-lg" id="heading">
														<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-controls="collapseTwo">
															<i class="fa-brands fa-line text-success fa-xl me-2"></i>การออก LINE Access Token 
														</button>
                                                    </h2>
                                                <div id="collapse" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordion">
													<div class="accordion-body">
														<div class="row justify-content-center">
															<div class="col-12 col-xxl-9">
																<h4 class="fw-bold mt-3 mb-4">ขั้นตอนการออก การออก LINE Access Token เพื่อรับบริการแจ้งเตือนผ่าน LINE Group</h4>
																1. ไปที่ <a href="https://notify-bot.line.me/th/" target="_blank">https://notify-bot.line.me/th/</a> แล้วทำการเข้าสู่ระบบ
																<div class="text-center mt-2 mb-5"><img src="img/pics/generate-token/token-01.jpg" class="img-fluid rounded shadow-lg"></div>

																2. เลือกเมนู "หน้าของฉัน" จากแถบเมนู
																<div class="text-center mt-2 mb-5"><img src="img/pics/generate-token/token-02.jpg" class="img-fluid rounded shadow-lg"></div>
															
																3. เลื่อนลงมาภายใต้หัวข้อ ออก Access Token (สำหรับผู้พัฒนา)ให้คลิกที่ปุ่ม "ออก Token"
																<div class="text-center mt-2 mb-5"><img src="img/pics/generate-token/token-03.jpg" class="img-fluid rounded shadow-lg border"></div>
															
																4. ระบุชื่อที่ต้องการแสดงเมื่อส่งข้อความแจ้งเตือน เลือก Group Chat ที่ต้องการให้ส่งข้อความ จากนั้นกดปุ่ม "ออก Token"
																<div class="text-center mt-2 mb-5"><img src="img/pics/generate-token/token-04.jpg" class="img-fluid rounded shadow-lg border"></div>

																5. คัดลอก Token ที่ได้ เพื่อนำมาตั้งค่า LINE Access Token
																<div class="text-center mt-2 mb-5"><img src="img/pics/generate-token/token-05.jpg" class="img-fluid rounded shadow-lg border"></div>

																6. เพิ่มบัญชีทางการ LINE Notify เข้าไปยัง Group Chat ที่ได้เลือกไว้ขณะที่ออก Token 
																<div class="text-center mt-2 mb-5"><img src="img/pics/generate-token/token-06.jpg" class="img-fluid rounded shadow-lg border"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
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
	<script src="app/script/notify-manage.js"></script>
</body>
</html>
<?php $repairDB->close(); ?>