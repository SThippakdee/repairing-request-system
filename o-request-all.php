<?php
    require_once("app/script/header-o.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>รายการแจ้งซ่อมทั้งหมด</title>

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
		.dataTables_filter {
			display: none;
		}
		.active-badge {
			margin-top: -0.5rem;
			box-shadow: 0 0.2rem 0.6rem rgb(0 0 0 / 60%);
		}
	</STYLE>
</head>

<body>
	<div class="wrapper">
		<!--Sidebar-->
		<?php require_once("app/components/sidebar-officer.php");?>

		<div class="main">
			<!--Topbar-->
			<?php require_once("app/components/topbar.php");?>

			<main class="content" style="background-color: #EBEBEB;">
				<div class="container-fluid p-0">
					<!--Start Content-->
					<h3 id="pageName" class="fw-bold mb-3">รายการแจ้งซ่อม</h3>
					<div class="row">
						<div class="col-12">
							<div class="card shadow-lg">
								<div class="card-body">
									<div class="row">
										<div class="col mt-2">

												<div class="row g-2 mb-3">
													<div class="col-12 col-md-3 col-xxl-3">
														วันที่เริ่มต้น
														<input id="start" type="date" name="report_start" class="form-control form-control-lg"
														value="2022-01-01" 
														min="2022-01-01" max="<?php echo date('Y-m-d');?>">
													</div>
													<div class="col-12 col-md-3 col-xxl-3">
														วันที่สิ้นสุด
														<input id="end" type="date" name="report_end" class="form-control form-control-lg"
														value="<?php echo date('Y-m-d');;?>" 
														min="2022-01-01"
														max="<?php echo date('Y-m-d');?>">
													</div>
													<div class="col-12 col-md-6">
														ค้นหาข้อมูล
														<div class="input-group">
															<input id="searchWord" class="form-control form-control-lg" type="text" placeholder="ค้นหาจากคำ..." autofocus autocomplete="off">
															<button class="btn btn-primary" onclick="window.location.reload()">Reset</button>
														</div>
													</div>
												</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row row-cols-1 g-4">
						<div class="col">
							<div class="card h-100 shadow-lg">
							<div class="card-body">
								<div class="row g-3 px-2 mb-3">
									<div class="col-12 col-lg-6">
										<div class="row g-2">
											<div class="col-6">
												<a class="btn btn-lg btn-primary w-100 text-nowrap" href="o-request-new.php">
													<i class="fa-solid fa-lg fa-file-circle-plus me-2"></i>
													เพิ่ม<span class="d-none d-md-inline">รายการ</span>
												</a>
											</div>
											<div class="col-6">
												<a id="print" class="btn btn-lg btn-primary w-100 text-nowrap">
													<i class="fa-solid fa-print fa-lg me-2"></i>
													พิมพ์<span class="d-none d-md-inline">รายการ</span>
												</a>
											</div>
										</div>
									</div>
									<hr>
								</div>

									<?php
										$sql = 'SELECT 	(select count(*) FROM request) as total, 
														(select count(*) FROM request WHERE req_status ="รอดำเนินการ" ) as waiting, 
														(select count(*) FROM request WHERE req_status ="กำลังดำเนินการ" ) as inprogress,
														(select count(*) FROM request WHERE req_status ="ดำเนินการเสร็จสิ้น" ) as done, 
														(select count(*) FROM request WHERE req_status ="ยกเลิกรายการ" ) as cancelled;';
										$result=$repairDB->query($sql);
										$row=$result->fetch_assoc();
									?>

									<table id="table" class="table table-hover mt-2 display nowrap w-100">
										<thead>
											<tr>
												<th colspan="6" class="h5 px-0">
													<span class="active-badge my-badge ms-2 badge bg-secondary p-1 clickable" data-group="" onclick="searchCol(4, '')">
														รายการทั้งหมด
														<span class="badge bg-light text-dark ms-2 p-1">
															<?php echo $row["total"];?>
														</span>
													</span>
													<span class="ms-2 my-badge badge bg-warning p-1 clickable" data-group="รอดำเนินการ" onclick="searchCol(4, 'รอดำเนินการ')">
														รอดำเนินการ
														<span class="badge bg-light text-light text-dark ms-2 p-1">
															<?php echo $row["waiting"];?>
														</span>
													</span>
													<span class="ms-2 my-badge badge bg-primary p-1 clickable" data-group="กำลังดำเนินการ" onclick="searchCol(4, 'กำลังดำเนินการ')">
														กำลังดำเนินการ
														<span class="badge bg-light text-dark ms-2 p-1 ">
															<?php echo $row["inprogress"];?>
														</span>
													</span>
													<span class="ms-2 my-badge badge bg-success p-1 clickable" data-group="ดำเนินการเสร็จสิ้น" onclick="searchCol(4, 'ดำเนินการเสร็จสิ้น')">
														ดำเนินการเสร็จสิ้น
														<span class="badge bg-light text-dark ms-2 p-1">
															<?php echo $row["done"];?>
														</span>
													</span>
													<span class="ms-2 my-badge badge bg-danger p-1 clickable" data-group="ยกเลิกรายการ" onclick="searchCol(4, 'ยกเลิกรายการ')">
														ยกเลิกรายการ
														<span class="badge bg-light text-dark ms-2 p-1">
															<?php echo $row["cancelled"];?>
														</span>
													</span>
												</th>
											</tr>
											<tr>
												<th>วันที่แจ้ง</th>
												<th>รหัสรายการแจ้งซ่อม</th>
												<th>ชื่อผู้แจ้ง</th>
												<th>เรื่องที่ขอบริการ</th>
												<th>สถานะ</th>
												<th>ผู้ดำเนินการ</th>
											</tr>
										</thead>
										<tbody>

											<?php
												$sql="	SELECT 	req_date, RQ.req_id, user_name, user_lastname, service_name, req_status, officer_id, 
																(select CONCAT(user_name, ' ', user_lastname) FROM user WHERE user_id = officer_id)as officer_name 
														FROM 	request RQ 
																LEFT JOIN user US ON RQ.user_id = US.user_id 
																LEFT JOIN service SV ON RQ.service_id = SV.service_id 
																LEFT JOIN device_type DT ON RQ.type_id = DT.type_id 
																LEFT JOIN request_solving RS ON RQ.req_id = RS.req_id
														ORDER BY req_date DESC;";
												$requestData=$repairDB->query($sql);

												while($request = $requestData->fetch_assoc()){
													$recordID = $request["req_id"];
											?>

											<tr class="clickable" onclick='showApprove("<?php echo $recordID?>")'>
												<td>
													<?php echo date('d/m/Y',strtotime($request["req_date"]));?>
												</td>
												<td>
													<?php echo $recordID;?>
												</td>
												<td>
													<?php echo $request["user_name"]."  ".$request["user_lastname"];?>
												</td>
												<td>
													<?php echo $request["service_name"];?>
												</td>
												<td>
													<?php
														$color = "";
														if($request["req_status"] == "รอดำเนินการ") $color = "bg-warning";
														else if($request["req_status"] == "กำลังดำเนินการ") $color = "bg-primary";
														else if($request["req_status"] == "ดำเนินการเสร็จสิ้น") $color = "bg-success";
														else if($request["req_status"] == "ยกเลิกรายการ") $color = "bg-danger";
													?>
													<span class="badge <?php echo $color;?> w-100 py-1">
														<?php echo $request["req_status"];?>
													</span>
												</td>
												<td>
													<?php
														if($request["officer_name"] != ""){
															echo $request["officer_name"];
														}else{
															echo "ยังไม่มีผู้ดำเนินการ";
														}
													?>
												</td>
											</tr>

											<?php } ?>

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
	<script src="app/script/request-manage-o.js"></script>
	<script type="text/javascript">
		$("#start").change(function(){
			min = document.getElementById("start").value
			document.getElementById("end").setAttribute("min", min);
			document.getElementById("end").value = document.getElementById("end").max;
		});

		//Filter date range
		$.fn.dataTable.ext.search.push(
			function( settings, data, dataIndex ) {
				var min = new Date($("#start").val());
				var max = new Date($("#end").val());
				var arrStrDate = (data[0]).split("/");
				var strDate = arrStrDate[2]+"-"+arrStrDate[1]+"-"+arrStrDate[0];
				var date = new Date(strDate);
				if ( min <= date && date <= max) {
					return true;
				}
				return false;
			}
		);

		$("#start, #end").change(function(){
        	table.draw();
    	});
	</script>
</body>
</html>
<?php $repairDB->close(); ?>