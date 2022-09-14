<?php
    require_once("app/script/a-header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Profile</title>

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
		.card-profile-img {
			position: relative;
			max-width: 8rem;
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
		.text-muted {
 			 color: #6c757d !important;
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
						<div class="row g-3">
							<div class="col-xl-4">
								<div class="card card-profile shadow-lg h-100 mb-0">
									<div class="card-header" style="background-image: url(img/pics/profile-bg.jpg);"> </div>
									<div class="card-body text-center"><img class="card-profile-img" src="img/avatars/default-avatar.png">
										<h3 class="mb-2 mt-3">สุรพัศ ทิพย์ภักดี</h3>
										<h4 class="mb-2 text-muted">ผู้ดูแลระบบ</h4>
									</div>
									<div class="card-footer">
										<div class="row g-2 justify-content-center">
											<div class="col-12 col-sm-6 col-xl-12">
												<a class="btn btn-lg btn-primary w-100">
													<i class="fa-solid fa-key fa-lg me-2"></i>
													รีเซ็ตรหัสผ่าน
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-8">
								<div class="card overflow-hidden shadow-lg h-100 mb-0">
									<form action="be-usermage.php" method="POST">
									<div class="card-body">

										<?php
											$sql = sprintf("SELECT * FROM user WHERE user_id = '%s'", $_SESSION['RWeb-userID']);
											$result=$repairDB->query($sql);
											if($result->num_rows==0){
												header("Location: index.php");
												exit;
											}
											$row=$result->fetch_assoc();
										?>

										<h5 class="card-title">ข้อมูลส่วนตัว</h5>
										<div class="row mb-3 mt-4">
											<div class="col-12 col-sm-6">
												ชื่อผู้ใช้
												<input type="text" name="user_name"class="form-control form-control-lg" autocomplete="off" placeholder="ชื่อผู้ใช้"
                                                value="<?php echo $row["user_name"];?>"/>
											</div>
											<div class="col-12 col-sm-6">
												นามสกุล
												<input type="text" name="user_lastname" class="form-control form-control-lg" autocomplete="off" placeholder="นามสกุล"
                                                value="<?php echo $row["user_lastname"];?>"/>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-12 col-sm-6">
												Username
												<input type="text" name="user_username" class="form-control form-control-lg" autocomplete="off" placeholder="Username"
                                                value="<?php echo $row["user_username"];?>"/>
											</div>
											<div class="col-12 col-sm-6">
												โทรศัพท์
												<input type="text" name="user_tel" class="form-control form-control-lg" autocomplete="off" placeholder="โทรศัพท์"
                                                value="<?php echo $row["user_tel"];?>"/>
											</div>
										</div>

										<?php
											$sql = sprintf("SELECT * FROM user_dep ORDER BY dep_name;");
											$depResult=$repairDB->query($sql);
										?>

										<div class="row">
											<div class="col">
												หน่วยงาน/แผนก
												<select id="dep_id" name="dep_id" class="form-select">
                                                    <option disabled selected>-- เลือกหน่วยงาน/แผนก --</option>
													<option <?php if($row["dep_id"]=="") echo "selected";?> value="">ไม่มีหน่วยงาน</option>

                                                    <?php
													while ($dep = $depResult->fetch_assoc()){
													?>

													<option value="<?php echo $dep['dep_id']?>" <?php if($row["dep_id"]==$dep["dep_id"]) echo "selected";?> >
														<?php echo $dep['dep_name']?>
													</option>
													
													<?php
													}
													?>

                                                </select>
											</div>
										</div>
									</div>
									<div class="card-footer">
										<div class="row g-2 mb-0 justify-content-end">
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <a class="btn btn-lg btn-secondary w-100" onclick="history.back()">
                                                    <i class="fa-solid fa-circle-chevron-left fa-lg me-2"></i>
                                                    ย้อนกลับ
                                                </a>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <button type="submit" class="btn btn-lg btn-primary w-100">
                                                    <i class="fa-regular fa-floppy-disk fa-lg me-2"></i>
                                                    อัพเดท
                                                </button>
                                            </div>
                                        </div>
									</div>
									</form>
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
	<script>
		$(document).ready(function() {
			$('#dep_id').select2();
		});
	</script>
</body>
</html>
<?php $repairDB->close(); ?>