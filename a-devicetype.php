<?php
    require_once("app/script/a-header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>จัดการข้อมูลระบบ</title>

	<!-- Include fonts/css/js -->
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	
	<link href="asset/css/app.css" rel="stylesheet">
	<link href="asset/vendors/fontawesome-6.1.2/css/all.min.css" rel="stylesheet">
	
	<script src="asset/js/app.js"></script>
	<script src="asset/vendors/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="asset/vendors/sweetalert2/sweetalert2.all.min.js"></script>
	
	<!-- Page Style -->
	<STYLE type="text/css">
		body {
			font-family: "Kanit"; 
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
					<h3 id="pageName" class="fw-bold mb-3">ข้อมูลประเภทครุภัณฑ์</h3>

					<div class="row row-cols-1 g-4">
						<div class="col">
							<div class="card h-100 shadow-lg">
							<div class="card-body">

								<a class="btn btn-lg btn-primary mt-2" onclick="add()">
									<i class="fa-solid fa-lg fa-file-circle-plus me-2"></i>
									เพิ่มรายการใหม่
								</a>
								<table class="table table-hover mt-4 mb-0">
									<thead>
										<tr>
											<th>ชื่อประเภทครุภัณฑ์</th>
											<th class="d-none d-md-table-cell" width="200">จำนวนรายการแจ้งซ่อม</th>
											<th width="135"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT *, (select count(*) from request WHERE type_id = device_type.type_id) as request_count
												FROM device_type 
												ORDER BY type_name;";
										$result=$repairDB->query($sql);
										if ($result->num_rows == 0){
											echo('<tr height=60px><td colspan="3" class="text-center">--- No record found ---</td></tr>');
										}else{
											while($row = $result->fetch_assoc()){
										?>
										<tr>
											<td>
												<?php echo $row['type_name'];?>
											</td>
											<td class="d-none d-md-table-cell">
												<?php echo $row['request_count'];?> รายการ
											</td>
											<td class="text-end">
												<div class="row g-1 p-0">
													<div class="col">
														<button type="button" class="btn btn-primary w-100" 
															onclick="edit(<?php printf('%d, \'%s\'', $row['type_id'], $row['type_name']);?>)">
															<i class="fa-solid fa-pen-to-square"></i>
														</button>
													</div>
													<div class="col">
														<button type="button" class="btn btn-warning w-100"
															onclick="del(<?php echo $row['type_id'];?>)">
															<i class="fa-solid fa-lg fa-trash-can"></i>
														</button>
													</div>
												</div>
											</td>
										</tr>	
										<?php
											}
										}
										?>
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
	<script src="app/script/devicetype-manage.js"></script>
</body>
</html>
<?php $repairDB->close(); ?>