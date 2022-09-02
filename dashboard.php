<?php
    //Check login session & userlevel
    if(!isset($_SESSION)) session_start();
    if(!isset($_SESSION["userID"]) or !isset($_SESSION["userLevel"])){
        header("Location: index.php");
        exit();
    }
    if($_SESSION["userLevel"] != "1"){
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
	
	<script src="asset/js/app.js"></script>
	<script src="asset/libraries/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="asset/libraries/sweetalert2/sweetalert2.all.min.js"></script>
	<script src="asset/libraries/fontawesome-6.1.2/js/all.min.js"></script>
	<script src="asset/libraries/chartJS/chart.min.js"></script>
	

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
					<h3 id="pageName"><strong>Dashboard</strong></h3>

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
														<h5 class="card-title">สรุปผลการประเมิน</h5>
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
										<canvas id="chartjs-line"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row row-cols-1 row-cols-xl-2 g-4 mb-4">
						<div class="col-xl-4">
							<div class="card h-100">
							<div class="card-body">
								<h5 class="card-title">รายการแจ้งซ่อม จัดกลุ่มตามสถานะ</h5>
								<div class="chart chart-sm mt-4">
									<canvas id="chartjs-doughnut"></canvas>
								</div>
								<table class="table mb-0 mt-2">
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
						<div class="col-xl-8">
							<div class="card h-100">
							<div class="card-body">
								<h5 class="card-title">รายการแจ้งซ่อมล่าสุด</h5>
									<table class="table table-hover my-0">
										<thead>
											<tr>
												<th>ชื่อผู้แจ้ง</th>
												<th>วันที่แจ้ง</th>
												<th>สถานะ</th>
												<th class="d-none d-md-table-cell">ผู้ดำเนินการ</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>นพดล หมื่นศรี</td>
												<td>01/01/2021</td>
												<td><span class="badge bg-warning w-75 p-1">รอดำเนินการ</span></td>
												<td class="d-none d-md-table-cell">สุชาติ แก้วประดิษฐ์</td>
											</tr>
											<tr>
												<td>นพดล หมื่นศรี</td>
												<td>01/01/2021</td>
												<td><span class="badge bg-danger w-75 p-1">ยกเลิกรายการ</span></td>
												<td class="d-none d-md-table-cell">สุชาติ แก้วประดิษฐ์</td>
											</tr>
											<tr>
												<td>นพดล หมื่นศรี</td>
												<td>01/01/2021</td>
												<td><span class="badge bg-danger w-75 p-1">ยกเลิกรายการ</span></td>
												<td class="d-none d-md-table-cell">สุชาติ แก้วประดิษฐ์</td>
											</tr>
											<tr>
												<td>นพดล หมื่นศรี</td>
												<td>01/01/2021</td>
												<td><span class="badge bg-success w-75 p-1">ดำเนินการเสร็จสิ้น</span></td>
												<td class="d-none d-md-table-cell">สุชาติ แก้วประดิษฐ์</td>
											</tr>
											<tr>
												<td>นพดล หมื่นศรี</td>
												<td>01/01/2021</td>
												<td><span class="badge bg-primary w-75 p-1">กำลังดำเนินการ</span></td>
												<td class="d-none d-md-table-cell">สุชาติ แก้วประดิษฐ์</td>
											</tr>
											<tr>
												<td>นพดล หมื่นศรี</td>
												<td>01/01/2021</td>
												<td><span class="badge bg-success w-75 p-1">ดำเนินการเสร็จสิ้น</span></td>
												<td class="d-none d-md-table-cell">สุชาติ แก้วประดิษฐ์</td>
											</tr>
											<tr>
												<td>นพดล หมื่นศรี</td>
												<td>01/01/2021</td>
												<td><span class="badge bg-success w-75 p-1">ดำเนินการเสร็จสิ้น</span></td>
												<td class="d-none d-md-table-cell">สุชาติ แก้วประดิษฐ์</td>
											</tr>
											<tr>
												<td>นพดล หมื่นศรี</td>
												<td>01/01/2021</td>
												<td><span class="badge bg-success w-75 p-1">ดำเนินการเสร็จสิ้น</span></td>
												<td class="d-none d-md-table-cell">สุชาติ แก้วประดิษฐ์</td>
											</tr>
											<tr>
												<td>นพดล หมื่นศรี</td>
												<td>01/01/2021</td>
												<td><span class="badge bg-warning w-75 p-1">รอดำเนินการ</span></td>
												<td class="d-none d-md-table-cell">สุชาติ แก้วประดิษฐ์</td>
											</tr>
											<tr>
												<td>นพดล หมื่นศรี</td>
												<td>01/01/2021</td>
												<td><span class="badge bg-primary w-75 p-1">กำลังดำเนินการ</span></td>
												<td class="d-none d-md-table-cell">สุชาติ แก้วประดิษฐ์</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<!-- <div class="row row-cols-1 row-cols-xl-2 g-4">
						<div class="col-xl-6">
							<div class="card h-100">
							<div class="card-body">
								<h5 class="card-title">ผลการประเมินความพึงพอใจ</h5>
								
							</div>
							</div>
						</div>
						<div class="col-xl-5">
							<div class="card h-100">
							<div class="card-body">
								<h5 class="card-title">คะแนนความพึงพอใจ แยกตามรายการ</h5>
								
							</div>
							</div>
						</div>
					</div> -->
					<!--End Content-->
					
				</div>
			</main>
			<!--Footer-->
			<?php require_once("app/components/footer.php");?>
			
		</div>
	</div>

	<script src="app/script/sidebar.js"></script>
	<script>
		// Line chart
		document.addEventListener("DOMContentLoaded", function() {
			new Chart(document.getElementById("chartjs-line"), {
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

		// Doughnut chart
		document.addEventListener("DOMContentLoaded", function() {
			new Chart(document.getElementById("chartjs-doughnut"), {
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