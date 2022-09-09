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
	
	<link href="asset/vendors/datatable/datatables.min.css" rel="stylesheet">
	<link href="asset/css/app.css" rel="stylesheet">
	<link href="asset/vendors/fontawesome-6.1.2/css/all.min.css" rel="stylesheet">
	
	<script src="asset/js/app.js"></script>
	<script src="asset/vendors/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="asset/vendors/sweetalert2/sweetalert2.all.min.js"></script>
	<script src="asset/vendors/datatable/datatables.min.js"></script>

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
								<a class="btn btn-lg btn-primary mt-2 mb-4"><i class="fa-solid fa-lg fa-file-circle-plus me-2"></i>เพิ่มรายการใหม่</a>
								
									<table id="table" class="table table-hover table-striped mt-2 display nowrap" style="width:100%">
										<thead>
											<tr>
												<th colspan="6" class="h5 px-0">
													<span class="badge bg-secondary py-1">
														รายการทั้งหมด
														<span class="badge bg-light text-dark ms-2 p-1">
															200
														</span>
													</span>
													<span class="badge bg-warning py-1">
														รอดำเนินการ
														<span class="badge bg-light text-dark ms-2 p-1">
															200
														</span>
													</span>
													<span class="badge bg-primary py-1">
														กำลังดำเนินการ
														<span class="badge bg-light text-dark ms-2 p-1">
															200
														</span>
													</span>
													<span class="badge bg-success py-1">
														ดำเนินการเสร็จสิ้น
														<span class="badge bg-light text-dark ms-2 p-1">
															200
														</span>
													</span>
													<span class="badge bg-danger py-1">
														ยกเลิกรายการ
														<span class="badge bg-light text-dark ms-2 p-1">
															200
														</span>
													</span>
												</th>
											</tr>
											<tr>
												<th width="83">วันที่แจ้ง</th>
												<th width="100">รหัส</th>
												<th width="200">ชื่อผู้แจ้ง</th>
												<th width="200">เรื่องที่ขอบริการ</th>
												<th width="124">สถานะ</th>
												<th width="200">ผู้ดำเนินการ</th>
											</tr>
										</thead>
										<tbody>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>
													01/01/2021
												</td>
												<td>
														REQ-100001
												</td>
												<td>
													นพดล หมื่นศรี
													<br> 
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td>
													เครื่องคอมพิวเตอร์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
														ปัญหาเกี่ยวกับการใช้ระบบเครือข่าย
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td>
													สุชาติ แก้วประดิษฐ์
													<br>
													<span class="small d-inline-block text-truncate" style="max-width: 200px;">
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
					<!--End Content-->
					
				</div>
			</main>
			<!--Footer-->
			<?php require_once("app/components/footer.php");?>
			
		</div>
	</div>

	<script src="app/script/sidebar.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#table').DataTable({
				scrollX: true,
				lengthChange: false
			});
		});
	</script>
</body>
</html>