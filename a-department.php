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
					<h3 id="pageName" class="fw-bold mb-3">ข้อมูลหน่วยงาน/แผนก</h3>

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
											<th class="h4">ชื่อหน่วยงาน/แผนก</th>
											<th width="135"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT * FROM user_dep ORDER BY dep_name;";
										$result=$repairDB->query($sql);

										if ($result->num_rows == 0){
											echo('<tr height=60px><td colspan="2" class="text-center">--- No record found ---</td></tr>');
										}else{
											while($row = $result->fetch_assoc()){
										?>
										<tr>
											<td>
												<?php echo $row['dep_name'];?>
											</td>
											<td class="text-end">
												<div class="row g-1 p-0">
													<div class="col">
														<button type="button" class="btn btn-primary w-100" 
															onclick="edit(<?php printf('%d, \'%s\'', $row['dep_id'], $row['dep_name']);?>)">
															<i class="fa-solid fa-pen-to-square"></i>
														</button>
													</div>
													<div class="col">
														<button type="button" class="btn btn-warning w-100"
															onclick="del(<?php echo $row['dep_id'];?>)">
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
	<script src="app/script/department-manage.js"></script>
</body>
</html>