<?php
    require_once("app/script/header-a.php");
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

						<?php
							$sql="SELECT 	(select count(*) FROM user WHERE user_level <> 1) as count_user,
											(select count(*) FROM request_servey) as count_servey,
											(select count(*) FROM request) as count_request,
											(select avg(ser_average) FROM request_servey) as avg_servey";
							$result=$repairDB->query($sql);
							$row=$result->fetch_assoc();
						?>

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
													<span class="text-primary"><?php echo $row["count_user"];?></span> บัญชี
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
															<i class="fa-solid fa-lg fa-file-circle-check align-middle"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-4">
													<span class="text-primary"><?php echo $row["count_servey"];?></span> รายการ
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
													<span class="text-primary"><?php echo $row["count_request"];?></span> รายการ
												</h1>
												<hr class="mt-4 mb-2 text-center text-primary" style="height: 4px;">
											</div>
										</div>
										<div class="card shadow-lg">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">คะแนนประเมินเฉลี่ย</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="fa-solid fa-lg fa-star-half-stroke align-middle"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-4">
													<span class="text-primary"><?php echo $row["count_user"]!="" ? number_format($row["count_user"], 2) : "ยังไม่มีคะแนน" ;?></span>
													<i class="fa-solid fa-star text-warning"></i>
												</h1>
												<hr class="mt-4 mb-2 text-center text-primary" style="height: 4px;">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php
							$thisYear = date('Y');
							$sql = "SELECT 	YEAR(`req_date`) AS `year`,
											COUNT(IF(MONTH(`req_date`)=1,`req_id`,NULL)) AS `Jan`,
											COUNT(IF(MONTH(`req_date`)=2,`req_id`,NULL)) AS `Feb`,
											COUNT(IF(MONTH(`req_date`)=3,`req_id`,NULL)) AS `Mar`, 
											COUNT(IF(MONTH(`req_date`)=4,`req_id`,NULL)) AS `Apr`, 
											COUNT(IF(MONTH(`req_date`)=5,`req_id`,NULL)) AS `May`, 
											COUNT(IF(MONTH(`req_date`)=6,`req_id`,NULL)) AS `Jun`, 
											COUNT(IF(MONTH(`req_date`)=7,`req_id`,NULL)) AS `Jul`, 
											COUNT(IF(MONTH(`req_date`)=8,`req_id`,NULL)) AS `Aug`, 
											COUNT(IF(MONTH(`req_date`)=9,`req_id`,NULL)) AS `Sep`, 
											COUNT(IF(MONTH(`req_date`)=10,`req_id`,NULL)) AS `Oct`, 
											COUNT(IF(MONTH(`req_date`)=11,`req_id`,NULL)) AS `Nov`, 
											COUNT(IF(MONTH(`req_date`)=12,`req_id`,NULL)) AS `Dec` 
									FROM request
									WHERE YEAR(`req_date`) = '$thisYear';";
							$result=$repairDB->query($sql);
							$line=$result->fetch_assoc();
						?>

						<div class="col-xl-6 col-xxl-7">
							<div class="card flex-fill w-100 shadow-lg">
								<div class="card-header">
									<h5 class="card-title mb-0">สถิติการยื่นคำร้องขอแจ้งซ่อม ปี <?php echo $thisYear;?></h5>
								</div>
								<div class="card-body py-3">
									<div class="chart chart-sm">
										<canvas id="chart-requestLine"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>

					<?php
						$sql = 'SELECT 	(select count(*) FROM request WHERE req_status ="รอดำเนินการ" ) as waiting, 
										(select count(*) FROM request WHERE req_status ="กำลังดำเนินการ" ) as inprogress,
										(select count(*) FROM request WHERE req_status ="ดำเนินการเสร็จสิ้น" ) as done, 
										(select count(*) FROM request WHERE req_status ="ยกเลิกรายการ" ) as cancelled;';
						$result=$repairDB->query($sql);
						$pie=$result->fetch_assoc();
					?>

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
														<td class="text-end text-warning fw-bold h4"><?php echo $pie["waiting"];?></td>
													</tr>
													<tr>
														<td>กำลังดำเนินการ</td>
														<td class="text-end text-primary fw-bold h4"><?php echo $pie["inprogress"];?></td>
													</tr>
													<tr>
														<td>ดำเนินการเสร็จสิ้น</td>
														<td class="text-end text-success fw-bold h4"><?php echo $pie["done"];?></td>
													</tr>
													<tr>
														<td>ยกเลิกรายการ</td>
														<td class="text-end text-danger fw-bold h4"><?php echo $pie["cancelled"];?></td>
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
									<div class="table-responsive">
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

											<?php
												$sql="	SELECT 	req_date, RQ.req_id, user_name, user_lastname, dep_name, service_name, req_status, officer_id, 
																(select CONCAT(user_name, ' ', user_lastname) FROM user WHERE user_id = officer_id)as officer_name 
														FROM 	request RQ 
														LEFT JOIN user US ON RQ.user_id = US.user_id
														LEFT JOIN user_dep DP ON US.dep_id = DP.dep_id 
														LEFT JOIN service SV ON RQ.service_id = SV.service_id 
														LEFT JOIN device_type DT ON RQ.type_id = DT.type_id 
														LEFT JOIN request_solving RS ON RQ.req_id = RS.req_id
														ORDER BY req_id DESC LIMIT 7;";
												$requestData=$repairDB->query($sql);

												if($requestData-> num_rows >0){
													while($request = $requestData->fetch_assoc()){
														$recordID = $request["req_id"];
											?>

											<tr class="clickable" onclick='showDetail("<?php echo $recordID;?>")'>
												<td>
													<?php echo date('d/m/Y',strtotime($request["req_date"]));?>
												</td>
												<td>
													<?php echo $request["user_name"]."  ".$request["user_lastname"];?> <br>
													<span class="small text-secondary d-inline-block text-truncate" style="max-width: 180px;">
														<?php echo $request["dep_name"] != "" ? $request["dep_name"] : "ไม่มีแผนก/หน่วยงาน";?>
													</span>
												</td>

												<?php
														$color = "";
														if($request["req_status"] == "รอดำเนินการ") $color = "bg-warning";
														else if($request["req_status"] == "กำลังดำเนินการ") $color = "bg-primary";
														else if($request["req_status"] == "ดำเนินการเสร็จสิ้น") $color = "bg-success";
														else if($request["req_status"] == "ยกเลิกรายการ") $color = "bg-danger";
												?>

												<td><span class="badge <?php echo $color;?> w-100 py-1"><?php echo $request["req_status"];?></span></td>
												<td class="d-none d-md-table-cell">
													<?php echo $request["officer_name"] != "" ? $request["officer_name"] : "ยังไม่มีผู้ดำเนินการ";?><br>
												</td>
											</tr>

											<?php 
													} 
												}else{
													echo '<tr height=60px><td colspan="5" class="text-center">--- No record found ---</td></tr>';
												}
											?>

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
	<script src="app/script/request-manage.js"></script>
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
						data: [	<?php echo $line["Jan"];?>,
								<?php echo $line["Feb"];?>,
								<?php echo $line["Mar"];?>,
								<?php echo $line["Apr"];?>,
								<?php echo $line["May"];?>,
								<?php echo $line["Jun"];?>,
								<?php echo $line["Jul"];?>,
								<?php echo $line["Aug"];?>,
								<?php echo $line["Sep"];?>,
								<?php echo $line["Oct"];?>,
								<?php echo $line["Nov"];?>,
								<?php echo $line["Dec"];?>]
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
						data: [<?php echo $pie["waiting"];?>, <?php echo $pie["inprogress"];?>, <?php echo $pie["done"];?>, <?php echo $pie["cancelled"];?>],
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
<?php $repairDB->close(); ?>