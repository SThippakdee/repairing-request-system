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
	<title>บัญชีผู้ใช้</title>

	<!-- Include fonts/css/js -->
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	
	<link href="asset/vendors/datatable/datatables.min.css" rel="stylesheet">
	<link href="asset/vendors/datatable/buttons.dataTables.min.css" rel="stylesheet">
	<link href="asset/css/app.css" rel="stylesheet">
	<link href="asset/vendors/fontawesome-6.1.2/css/all.min.css" rel="stylesheet">
	
	<script src="asset/js/app.js"></script>
	<script src="asset/vendors/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="asset/vendors/sweetalert2/sweetalert2.all.min.js"></script>
	<script src="asset/vendors/datatable/datatables.min.js"></script>
	<script src="asset/vendors/datatable/dataTables.buttons.min.js"></script>
	

	<!-- Page Style -->
	<STYLE type="text/css">
		body {
			font-family: "Kanit"; 
		}
		.clickable {
			cursor: pointer;
		}
		.dataTables_filter {
			display: none;
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
					<h3 id="pageName" class="fw-bold mb-3">บัญชีผู้ใช้</h3>

					<div class="row row-cols-1 g-4">
						<div class="col">
							<div class="card h-100 shadow-lg">
							<div class="card-body">
								
								<div class="row g-3 px-2 mb-3">
									<div class="col-12 col-lg-6">
										<div class="row g-2">
											<div class="col-6">
												<a class="btn btn-lg btn-primary w-100"><i class="fa-solid fa-lg fa-file-circle-plus me-2"></i>เพิ่มรายการ</a>
											</div>
											<div class="col-6">
												<a id="print" class="btn btn-lg btn-primary w-100"><i class="fa-solid fa-print fa-lg me-2"></i>พิมพ์รายการ</a>
											</div>
										</div>
									</div>
									<div class="col-12 col-lg-6">
										<input id="searchWord" class="form-control form-control-lg" type="text" placeholder="ค้นหา..." autofocus autocomplete="off">
									</div>
									<hr>
								</div>

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
												<span class="badge bg-info py-1">
													ผู้ใช้ระบบ
													<span class="badge bg-light text-dark ms-2 p-1">
														200
													</span>
												</span>
												<span class="badge bg-primary py-1">
													ช่างซ่อมบำรุง
													<span class="badge bg-light text-dark ms-2 p-1">
														200
													</span>
												</span>
											</th>
										</tr>
										<tr>
											<th width="80"></th>
											<th width="200">ชื่อ สกุล</th>
											<th width="180">บัญชีผู้ใช้</th>
											<th width="107">โทรศัพท์</th>
											<th width="200">หน่วยงาน/แผนก</th>
											<th width="140">สิทธิการใช้งาน</th>
										</tr>
									</thead>
									<tbody>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
											</td>
										</tr>
										<tr class="clickable">
											<td class="text-center">
												<img src="img/avatars/avatar-3.jpg" class="avatar rounded-circle"/>
											</td>
											<td>
												นพดล หมื่นศรี
											</td>
											<td>
												noppadol@user
											</td>
											<td>
												0888888888
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิเทศติดตามงานสุขภาพจิตในเขตสุขภาพ
												</span>
											</td>
											<td>
												<span class="badge bg-info w-100 py-1">ผู้ใช้ระบบ</span>
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
	<script src="app/script/table.js"></script>
</body>
</html>