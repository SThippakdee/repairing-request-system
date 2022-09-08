<?php
    //Check login session & userlevel
    if(session_status()==PHP_SESSION_NONE) session_start();
    if(!isset($_SESSION["RWeb-userID"]) or !isset($_SESSION["RWeb-userLevel"])){
        header("Location: index.php");
        exit();
    }
    if($_SESSION["RWeb-userLevel"] != "1"){
        header("Location: index.php");
        exit();
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>จัดการบัญชีผู้ใช้</title>

	<!-- Include fonts/css/js -->
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	
	<link href="asset/css/app.css" rel="stylesheet">
	<link href="asset/vendors/fontawesome-6.1.2/css/all.min.css" rel="stylesheet">
	
	<script src="asset/js/app.js"></script>
	<script src="asset/vendors/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="asset/vendors/sweetalert2/sweetalert2.all.min.js"></script>
	<script src="asset/vendors/chartjs/Chart.min.js"></script>
	

	<!-- Page Style -->
	<STYLE type="text/css">
		body {
			font-family: "Kanit"; 
		}
		.clickable {
			cursor: pointer;
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
					<h3 id="pageName" class="fw-bold mb-3">จัดการบัญชีผู้ใช้</h3>

					<div class="row row-cols-1 g-4">
						<div class="col">
							<div class="card h-100 shadow-lg">
							<div class="card-body">
								<a class="btn btn-lg btn-primary mt-2"><i class="fa-solid fa-lg fa-file-circle-plus me-2"></i>เพิ่มรายการใหม่</a>
								<div class="table-responsive">
									<table class="table table-hover my-0 mt-4">
										<thead>
											<tr>
												<th></th>
												<th>ชื่อ สกุล</th>
												<th>บัญชีผู้ใช้</th>
												<th>โทรศัพท์</th>
												<th>หน่วยงาน</th>
												<th>สิทธิการใช้งาน</th>
											</tr>
										</thead>
										<tbody>
											<tr class="clickable">
												<td class="text-center">
													<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														นพดล หมื่นศรี
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														noppadol@user
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														0888888888
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 220px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													<span class="badge bg-info w-100 p-1">ผู้ใช้ระบบ</span>
												</td>
											</tr>
											<tr class="clickable">
												<td class="text-center">
													<img src="img/avatars/avatar-5.jpg" class="avatar rounded-circle"/>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														จักกฤต  สุขสมบูรณ์
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														chakkrit@admin
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														0888888888
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 220px;">
														-
													</span>
												</td>
												<td>
													<span class="badge bg-primary w-100 p-1">ช่างซ่อมบำรุง</span>
												</td>
											</tr>
											<tr class="clickable">
												<td class="text-center">
													<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														นพดล หมื่นศรี
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														noppadol@user
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														0888888888
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 220px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													<span class="badge bg-info w-100 p-1">ผู้ใช้ระบบ</span>
												</td>
											</tr>
											<tr class="clickable">
												<td class="text-center">
													<img src="img/avatars/avatar-5.jpg" class="avatar rounded-circle"/>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														จักกฤต  สุขสมบูรณ์
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														chakkrit@admin
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														0888888888
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 220px;">
														-
													</span>
												</td>
												<td>
													<span class="badge bg-primary w-100 p-1">ช่างซ่อมบำรุง</span>
												</td>
											</tr>
											<tr class="clickable">
												<td class="text-center">
													<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														นพดล หมื่นศรี
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														noppadol@user
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														0888888888
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 220px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													<span class="badge bg-info w-100 p-1">ผู้ใช้ระบบ</span>
												</td>
											</tr>
											<tr class="clickable">
												<td class="text-center">
													<img src="img/avatars/avatar-5.jpg" class="avatar rounded-circle"/>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														จักกฤต  สุขสมบูรณ์
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														chakkrit@admin
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														0888888888
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 220px;">
														-
													</span>
												</td>
												<td>
													<span class="badge bg-primary w-100 p-1">ช่างซ่อมบำรุง</span>
												</td>
											</tr>
											<tr class="clickable">
												<td class="text-center">
													<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														นพดล หมื่นศรี
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														noppadol@user
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														0888888888
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 220px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													<span class="badge bg-info w-100 p-1">ผู้ใช้ระบบ</span>
												</td>
											</tr>
											<tr class="clickable">
												<td class="text-center">
													<img src="img/avatars/avatar-5.jpg" class="avatar rounded-circle"/>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														จักกฤต  สุขสมบูรณ์
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														chakkrit@admin
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														0888888888
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 220px;">
														-
													</span>
												</td>
												<td>
													<span class="badge bg-primary w-100 p-1">ช่างซ่อมบำรุง</span>
												</td>
											</tr>
										</tbody>
									</table>
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
</body>
</html>