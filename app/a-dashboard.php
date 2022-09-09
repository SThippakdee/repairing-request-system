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
	<title>Dashboard</title>

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
					<h3 id="pageName" class="fw-bold mb-3">Dashboard</h3>

					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card shadow-lg">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">บัญชีผู้ใช้งานระบบ</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="fa-solid fa-lg fa-user-group align-middle"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-4">
													<span class="text-primary">53</span> บัญชี
												</h1>
												<hr class="mt-4 mb-2 text-center text-primary" style="height: 4px;">
											</div>
										</div>
										<div class="card shadow-lg">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">ทะเบียนอุปกรณ์</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="fa-solid fa-lg fa-computer align-middle"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-4">
													<span class="text-primary">241</span> รายการ
												</h1>
												<hr class="mt-4 mb-2 text-center text-primary" style="height: 4px;">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card shadow-lg">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">รายการแจ้งซ่อม</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="fa-solid fa-lg fa-screwdriver-wrench align-middle"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-4">
													<span class="text-primary">152</span> รายการ
												</h1>
												<hr class="mt-4 mb-2 text-center text-primary" style="height: 4px;">
											</div>
										</div>
										<div class="card shadow-lg">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">ผลการประเมิน</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="fa-solid fa-lg fa-star-half-stroke align-middle"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-4">
													<span class="text-primary">4.26</span>
													<i class="fa-solid fa-star text-warning"></i>
												</h1>
												<hr class="mt-4 mb-2 text-center text-primary" style="height: 4px;">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-xxl-7">
							<div class="card flex-fill w-100 shadow-lg">
								<div class="card-header">

									<h5 class="card-title mb-0">สถิติการยื่นคำร้องขอแจ้งซ่อม</h5>
								</div>
								<div class="card-body py-3">
									<div class="chart chart-sm">
										<canvas id="chart-requestLine"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row g-4 mb-4">
						<div class="col-xl-12 col-xxl-4">
							<div class="card h-100 shadow-lg">
							<div class="card-body">
								<h5 class="card-title">รายการแจ้งซ่อมทั้งหมด จัดกลุ่มตามสถานะ</h5>

								<div class="row g-4">
									<div class="col-xl-6 col-xxl-12">
										<div class="chart chart-sm mt-4">
											<canvas id="chart-groupByStatus"></canvas>
										</div>
									</div>
									<div class="col-xl-5 col-xxl-12 d-table">
										<div class="d-table-cell align-middle">
											<table class="table table-borderless mb-0">
												<thead>
													<tr>
														<th></th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>รอดำเนินการ</td>
														<td class="text-end text-warning fw-bold h4">260</td>
													</tr>
													<tr>
														<td>กำลังดำเนินการ</td>
														<td class="text-end text-primary fw-bold h4">125</td>
													</tr>
													<tr>
														<td>ดำเนินการเสร็จสิ้น</td>
														<td class="text-end text-success fw-bold h4">246</td>
													</tr>
													<tr>
														<td>ยกเลิกรายการ</td>
														<td class="text-end text-danger fw-bold h4">54</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							</div>
						</div>
						<div class="col-xl-12 col-xxl-8">
							<div class="card h-100 shadow-lg">
							<div class="card-body">
								<h5 class="card-title">รายการแจ้งซ่อมล่าสุด</h5>
									<table class="table table-hover my-0 mt-4">
										<thead>
											<tr>
												<th>วันที่แจ้ง</th>
												<th>ชื่อผู้แจ้ง</th>
												<th>สถานะ</th>
												<th class="d-none d-md-table-cell">ผู้ดำเนินการ</th>
											</tr>
										</thead>
										<tbody>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													นพดล หมื่นศรี <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td class="d-none d-md-table-cell">
													สุชาติ แก้วประดิษฐ์ <br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													นพดล หมื่นศรี <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td><span class="badge bg-warning w-100 p-1">รอดำเนินการ</span></td>
												<td class="d-none d-md-table-cell">
													สุชาติ แก้วประดิษฐ์ <br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													นพดล หมื่นศรี <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td><span class="badge bg-danger w-100 p-1">ยกเลิกรายการ</span></td>
												<td class="d-none d-md-table-cell">
													สุชาติ แก้วประดิษฐ์ <br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													นพดล หมื่นศรี <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td><span class="badge bg-danger w-100 p-1">ยกเลิกรายการ</span></td>
												<td class="d-none d-md-table-cell">
													สุชาติ แก้วประดิษฐ์ <br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													นพดล หมื่นศรี <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td><span class="badge bg-success w-100 p-1">ดำเนินการเสร็จสิ้น</span></td>
												<td class="d-none d-md-table-cell">
													สุชาติ แก้วประดิษฐ์ <br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													นพดล หมื่นศรี <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td><span class="badge bg-primary w-100 p-1" style="max-width: 120px;">กำลังดำเนินการ</span></td>
												<td class="d-none d-md-table-cell">
													สุชาติ แก้วประดิษฐ์ <br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr class="clickable">
												<td>01/01/2021</td>
												<td>
													นพดล หมื่นศรี <br> 
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														กลุ่มงานพัฒนาศักยภาพเครือข่ายและนิทศติดตามงานสุขภาพจิตในเขตสุขภาพ
													</span>
												</td>
												<td><span class="badge bg-success w-100 p-1">ดำเนินการเสร็จสิ้น</span></td>
												<td class="d-none d-md-table-cell">
													สุชาติ แก้วประดิษฐ์ <br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														ช่างซ่อมบำรุง
													</span>
												</td>
											</tr>
											<tr onclick="window.location='a-request.php';" class="clickable">
												<td colspan="4" class="text-center">
													รายการเพิ่มเติม
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
	<script>
		// Request line chart
		document.addEventListener("DOMContentLoaded", function() {
			new Chart(document.getElementById("chart-requestLine"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "จำนวน (รายการ)",
						fill: true,
						backgroundColor: "transparent",
						borderColor: window.theme.primary,
						data: [2115, 1562, 1584, 1892, 1487, 2223, 2966, 2448, 2905, 3838, 2917, 3327]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.05)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 500
							},
							display: true,
							borderDash: [5, 5],
							gridLines: {
								color: "rgba(0,0,0,0)",
								fontColor: "#fff"
							}
						}]
					}
				}
			});
		});

		// RequestGroupByStatus chart
		document.addEventListener("DOMContentLoaded", function() {
			new Chart(document.getElementById("chart-groupByStatus"), {
				type: "doughnut",
				data: {
					labels: ["รอดำเนินการ", "กำลังดำเนินการ", "ดำเนินการเสร็จสิ้น", "ยกเลิกรายการ"],
					datasets: [{
						data: [260, 125, 146, 54],
						backgroundColor: [
							window.theme.warning,
							window.theme.primary,
							window.theme.success,
							window.theme.danger
						],
						borderColor: "transparent"
					}]
				},
				options: {
					responsive: true,
					plugins: {
						legend: {
							display: false
						}
					},
					maintainAspectRatio: false,
					cutoutPercentage: 65
				}
			});
		});
	</script>
</body>
</html>