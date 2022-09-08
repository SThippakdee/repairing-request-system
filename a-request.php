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
	<title>จัดการรายการแจ้งซ่อม</title>

	<!-- Include fonts/css/js -->
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	
	<link href="asset/css/app.css" rel="stylesheet">
	<link href="asset/vendors/fontawesome-6.1.2/css/all.min.css" rel="stylesheet">
	
	<script src="asset/js/app.js"></script>
	<script src="asset/vendors/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="asset/vendors/sweetalert2/sweetalert2.all.min.js"></script>
	<script src="asset/vendors/chartjs/Chart.min.js"></script>

	<!--ลบนี่-->
	

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
					<h3 id="pageName" class="fw-bold mb-3">จัดการรายการแจ้งซ่อม</h3>

					<div class="row row-cols-1 g-4">
						<div class="col">
							<div class="card h-100 shadow-lg">
							<div class="card-body">
								<a class="btn btn-lg btn-primary mt-2"><i class="fa-solid fa-lg fa-file-circle-plus me-2"></i>เพิ่มรายการใหม่</a>
								<div class="table-responsive">
									<table class="table table-hover my-0 mt-4">
										<thead>
											<tr>
												<th>วันที่แจ้ง</th>
												<th>รหัส</th>
												<th>ชื่อผู้แจ้ง</th>
												<th>ครุภัณฑ์</th>
												<th>สถานะ</th>
												<th>ผู้ดำเนินการ</th>
											</tr>
										</thead>
										<tbody>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														REQ-100001
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														นพดล หมื่นศรี
													</span>
													 <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 220px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														เครื่องคอมพิวเตอร์
													</span>
													<br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														สุชาติ แก้วประดิษฐ์ 
													</span>
													<br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														REQ-100002
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														นพดล หมื่นศรี
													</span>
													 <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 220px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														เครื่องคอมพิวเตอร์
													</span>
													<br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														สุชาติ แก้วประดิษฐ์ 
													</span>
													<br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														REQ-100003
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														นพดล หมื่นศรี
													</span>
													 <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 220px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														เครื่องคอมพิวเตอร์
													</span>
													<br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														สุชาติ แก้วประดิษฐ์ 
													</span>
													<br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														REQ-100004
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														นพดล หมื่นศรี
													</span>
													 <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 220px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														เครื่องคอมพิวเตอร์
													</span>
													<br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														สุชาติ แก้วประดิษฐ์ 
													</span>
													<br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														REQ-100005
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														นพดล หมื่นศรี
													</span>
													 <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 220px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														เครื่องคอมพิวเตอร์
													</span>
													<br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														สุชาติ แก้วประดิษฐ์ 
													</span>
													<br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														REQ-100006
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														นพดล หมื่นศรี
													</span>
													 <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 220px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														เครื่องคอมพิวเตอร์
													</span>
													<br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													<span class="d-inline-block text-truncate" style="max-width: 150px;">
														สุชาติ แก้วประดิษฐ์ 
													</span>
													<br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
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