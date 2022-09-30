<?php
    require_once("app/script/header-a.php");
	if(session_status()==PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>รายงาน</title>

	<!-- Include fonts/css/js -->
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	
	<link href="asset/css/app.css" rel="stylesheet">
	<link href="asset/vendors/fontawesome-6.1.2/css/all.min.css" rel="stylesheet">
	
	<script src="asset/js/app.js"></script>
	<script src="asset/vendors/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="asset/vendors/sweetalert2/sweetalert2.all.min.js"></script>
	<script src="asset/vendors/chartjs/Chart.min.js"></script>
	<script src="asset/vendors/chart-export/FileSaver.min.js"></script>
	<script src="asset/vendors/chart-export/canvas-to-blob.min.js"></script>

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
					<h3 id="pageName" class="fw-bold mb-3">รายงาน รายการแจ้งซ่อม</h3>

					<div class="row">
						<div class="col-12">
							<div class="card shadow-lg">
								<div class="card-body">
									<div class="row">
										<div class="col mt-2">

											<?php 
												$start = isset($_SESSION["RWeb-start"]) ? $_SESSION["RWeb-start"] : "2022-01-01";
												$end = isset($_SESSION["RWeb-end"]) ? $_SESSION["RWeb-end"] : date('Y-m-d');
												$barcolor = isset($_SESSION["RWeb-color"]) ? $_SESSION["RWeb-color"] : "#0c5eac";
												$limit = isset($_SESSION["RWeb-limit"]) ? $_SESSION["RWeb-limit"] : 5;
											?>

											<form method = "post" action="be-report.php">
												<div class="row g-2 mb-3">
													<div class="col-12 col-md-6 col-xxl-3">
														วันที่เริ่มต้น
														<input id="start" type="date" name="report_start" class="form-control form-control-lg"
														value="<?php echo $start;?>" 
														min="2022-01-01" max="<?php echo date('Y-m-d');?>">
													</div>
													<div class="col-12 col-md-6 col-xxl-3">
														วันที่สิ้นสุด
														<input id="end" type="date" name="report_end" class="form-control form-control-lg"
														value="<?php echo $end;?>" 
														min="<?php echo $start;?>"
														max="<?php echo date('Y-m-d');?>">
													</div>
													<div class="col-12 col-md-6 col-xxl-3">
														จำกัดการแสดงผล
														<select class="form-select form-control-lg" name="report_limit">
															<option <?php echo $limit== 5 ? "selected" : "";?> value="5">5 รายการ</option>
															<option <?php echo $limit== 7 ? "selected" : "";?> value="7">7 รายการ</option>
															<option <?php echo $limit== 10 ? "selected" : "";?> value="10">10 รายการ</option>
														</select>
													</div>
													<div class="col-12 col-md-6 col-xxl-3">
														กำหนดสีรายงาน
														<div class="row g-1">
															<div class="col-6">
																<input type="color" name="report_color" class="form-control form-control-color w-100 form-control-lg"
														 		id="exampleColorInput" value="<?php echo $barcolor;?>">
															</div>
															<div class="col-6">
																<button type="submit" class="btn btn-primary w-100 h-100"><i class="me-2 fa-solid fa-arrow-rotate-right"></i>Refresh</button>
															</div>
														</div>
													</div>
												</div>
											</form>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-xxl-6">
							<div class="card shadow-lg">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title">จำนวนรายการแจ้งซ่อม แยกตามบริการ</h5>
										</div>
										<div class="col-3">
											<a class="btn btn-outline-primary float-end" onclick="saveCanvas('#chartjs-groupByService')">
												<i class="fa-solid fa-cloud-arrow-down"></i><span class="ms-2 d-none d-md-inline">save</span>
											</a>
										</div>
									</div>
									<div class="row">
										<canvas id="chartjs-groupByService" class="mt-3"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-xxl-6">
							<div class="card shadow-lg">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title">จำนวนรายการแจ้งซ่อม แยกตามหน่วยงาน</h5>
										</div>
										<div class="col-3">
											<a class="btn btn-outline-primary float-end" onclick="saveCanvas('#chartjs-groupByDep')">
												<i class="fa-solid fa-cloud-arrow-down"></i><span class="ms-2 d-none d-md-inline">save</span>
											</a>
										</div>
									</div>
									<div class="row">
										<canvas id="chartjs-groupByDep" class="mt-3"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-xxl-6">
							<div class="card shadow-lg">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title">จำนวนรายการแจ้งซ่อม แยกตามประเภท</h5>
										</div>
										<div class="col-3">
											<a class="btn btn-outline-primary float-end" onclick="saveCanvas('#chartjs-groupByType')">
												<i class="fa-solid fa-cloud-arrow-down"></i><span class="ms-2 d-none d-md-inline">save</span>
											</a>
										</div>
									</div>
									<div class="row">
										<canvas id="chartjs-groupByType" class="mt-3"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-xxl-6">
							<div class="card shadow-lg">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title">จำนวนรายการแจ้งซ่อม แยกตามสถานะ</h5>
										</div>
										<div class="col-3">
											<a class="btn btn-outline-primary float-end" onclick="saveCanvas('#chartjs-groupByStatus')">
												<i class="fa-solid fa-cloud-arrow-down"></i><span class="ms-2 d-none d-md-inline">save</span>
											</a>
										</div>
									</div>
									<div class="row">
										<canvas id="chartjs-groupByStatus" class="mt-3"></canvas>
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
	<script>
		//Date picker min/max
		$("#start").change(function(){
			min = document.getElementById("start").value
			document.getElementById("end").setAttribute("min", min);
			document.getElementById("end").value = document.getElementById("end").max;
		});

		//Ajax report
		$('form').submit(function(e){
			e.preventDefault();
			var form = $(this);
			var actionUrl = form.attr('action');
			$.ajax({
				type:'post',
				url:actionUrl,
				data:form.serialize(),
				success:function() {
					window.location.reload();
				}
			})
		});

		//Save chart
		function saveCanvas(target){
			$(target).get(0).toBlob(function(blob){
				saveAs(blob, "chart-save.png")
			});
		}

		//Chart
		document.addEventListener("DOMContentLoaded", function() {
			const config = {
								maintainAspectRatio: false,
								plugins: {
									legend: {display: false}
								},
								responsive: true,
								scales: {
									yAxes: [{gridLines: {display: false}, stacked: false}],
									xAxes: [{stacked: false, gridLines: {color: "transparent"}}]
								}
							};

			// Group by service
			<?php
				$sql = "	SELECT service_name, count(*) as req_count 
							FROM request R LEFT JOIN service S ON R.service_id = S.service_id
						 	WHERE req_date BETWEEN '$start' AND '$end' 
							GROUP BY service_name
							ORDER BY req_count DESC
							Limit $limit;";
				$chartResult1 = $repairDB->query($sql);
				
				while($chart1=$chartResult1->fetch_assoc()){
					$req_label1[] = ($chart1["service_name"]!="") ? $chart1["service_name"] : "บริการถูกนำออกแล้ว";
                    $req_count1[] = $chart1["req_count"];
					$color1[] = $barcolor;
				}
				
				if(empty($req_label1)) $req_label1[] = "";
				if(empty($req_count1)) $req_count1[] = "";
				if(empty($color1)) $color1[] = "";
			?>

			new Chart(document.getElementById("chartjs-groupByService"), {
				type: "bar",
				data: {
					labels: <?php echo json_encode($req_label1, JSON_UNESCAPED_UNICODE);?>,
					datasets: [{
						label: "จำนวนรายการแจ้งซ่อม",
						data: <?php echo json_encode($req_count1, JSON_UNESCAPED_UNICODE);?>,
						backgroundColor: <?php echo json_encode($color1, JSON_UNESCAPED_UNICODE);?>,
						barPercentage: .75,
						categoryPercentage: .3
					}]
				},
				options: config
			});

			// Group by department
			<?php
				$sql = "	SELECT dep_name, count(*) as req_count 
							FROM request R LEFT JOIN user U ON R.user_id = U.user_id LEFT JOIN user_dep D ON U.dep_id = D.dep_id
						 	WHERE req_date BETWEEN '$start' AND '$end' 
							GROUP BY dep_name
							ORDER BY req_count DESC
							Limit $limit;";
				$chartResult2 = $repairDB->query($sql);
				
				while($chart2=$chartResult2->fetch_assoc()){
					$req_label2[] = ($chart2["dep_name"]!="") ? $chart2["dep_name"] : "ไม่มีหน่วยงาน";
                    $req_count2[] = $chart2["req_count"];
					$color2[] = $barcolor;
				}
				
				if(empty($req_label2)) $req_label2[] = "";
				if(empty($req_count2)) $req_count2[] = "";
				if(empty($color2)) $color2[] = "";
			?>

			new Chart(document.getElementById("chartjs-groupByDep"), {
				type: "bar",
				data: {
					labels: <?php echo json_encode($req_label2, JSON_UNESCAPED_UNICODE);?>,
					datasets: [{
						label: "จำนวนรายการแจ้งซ่อม",
						data: <?php echo json_encode($req_count2, JSON_UNESCAPED_UNICODE);?>,
						backgroundColor: <?php echo json_encode($color2, JSON_UNESCAPED_UNICODE);?>,
						barPercentage: .75,
						categoryPercentage: .3
					}]
				},
				options: config
			});

			// Group by device type
			<?php
				$sql = "	SELECT type_name, count(*) as req_count 
							FROM request R LEFT JOIN device_type D ON R.type_id = D.type_id
						 	WHERE req_date BETWEEN '$start' AND '$end' 
							GROUP BY type_name
							ORDER BY req_count DESC
							Limit $limit;";
				$chartResult3 = $repairDB->query($sql);
				
				while($chart3=$chartResult3->fetch_assoc()){
					$req_label3[] = ($chart3["type_name"]!="") ? $chart3["type_name"] : "หน่วยงานถูกนำออกแล้ว";
                    $req_count3[] = $chart3["req_count"];
					$color3[] = $barcolor;
				}
				
				if(empty($req_label3)) $req_label3[] = "";
				if(empty($req_count3)) $req_count3[] = "";
				if(empty($color3)) $color3[] = "";
			?>

			new Chart(document.getElementById("chartjs-groupByType"), {
				type: "bar",
				data: {
					labels: <?php echo json_encode($req_label3, JSON_UNESCAPED_UNICODE);?>,
					datasets: [{
						label: "จำนวนรายการแจ้งซ่อม",
						data: <?php echo json_encode($req_count3, JSON_UNESCAPED_UNICODE);?>,
						backgroundColor: <?php echo json_encode($color3, JSON_UNESCAPED_UNICODE);?>,
						barPercentage: .75,
						categoryPercentage: .3
					}]
				},
				options: config
			});

			// Group by status
			<?php
				$sql = "	SELECT req_status, count(*) as req_count 
							FROM request 
							WHERE req_date BETWEEN '$start' AND '$end' 
							GROUP BY req_status
							ORDER BY req_count DESC
							Limit $limit;";
				$chartResult4 = $repairDB->query($sql);
				
				while($chart4=$chartResult4->fetch_assoc()){
					$req_label4[] = $chart4["req_status"];
                    $req_count4[] = $chart4["req_count"];
					$color4[] = $barcolor;
				}
				
				if(empty($req_label4)) $req_label4[] = "";
				if(empty($req_count4)) $req_count4[] = "";
				if(empty($color4)) $color4[] = "";
			?>

			new Chart(document.getElementById("chartjs-groupByStatus"), {
				type: "bar",
				data: {
					labels: <?php echo json_encode($req_label4, JSON_UNESCAPED_UNICODE);?>,
					datasets: [{
						label: "จำนวนรายการแจ้งซ่อม",
						data: <?php echo json_encode($req_count4, JSON_UNESCAPED_UNICODE);?>,
						backgroundColor: <?php echo json_encode($color4, JSON_UNESCAPED_UNICODE);?>,
						barPercentage: .75,
						categoryPercentage: .3
					}]
				},
				options: config
			});
		});
	</script>
</body>
</html>
<?php $repairDB->close(); ?>