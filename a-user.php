<?php
    require_once("app/script/header-a.php");
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
	
	<link href="asset/vendors/select2/select2.min.css" rel="stylesheet">
	<link href="asset/vendors/datatable/datatables.min.css" rel="stylesheet">
	<link href="asset/vendors/datatable/buttons.dataTables.min.css" rel="stylesheet">
	<link href="asset/css/app.css" rel="stylesheet">
	<link href="asset/vendors/fontawesome-6.1.2/css/all.min.css" rel="stylesheet">
	
	<script src="asset/js/app.js"></script>
	<script src="asset/vendors/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="asset/vendors/sweetalert2/sweetalert2.all.min.js"></script>
	<script src="asset/vendors/datatable/datatables.min.js"></script>
	<script src="asset/vendors/datatable/dataTables.buttons.min.js"></script>
	<script src="asset/vendors/select2/select2.min.js"></script>

	<!-- Page Style -->
	<STYLE type="text/css">
		body {
			font-family: "Kanit"; 
		}
		.mini-profile {
			overflow: hidden;
			object-fit: cover;
		}
		.select2 {
            width:100%!important;
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
		<?php require_once("app/components/sidebar-admin.php");?>

		<div class="main">
			<!--Topbar-->
			<?php require_once("app/components/topbar.php");?>

			<main class="content" style="background-color: #EBEBEB;">
				<div class="container-fluid p-0">
					<!--Start Content-->
					<h3 id="pageName" class="fw-bold mb-3">บัญชีผู้ใช้</h3>
					<div class="row">
						<div class="col-12">
							<div class="card shadow-lg">
								<div class="card-body">
									<div class="row">
										<div class="col mt-2">
											
												<div class="row g-2 mb-3">
													<div class="col-12 col-md-6">
														
														<?php
															$sql = sprintf("SELECT * FROM user_dep ORDER BY dep_name;");
															$depResult=$repairDB->query($sql);
														?>

														หน่วยงาน/แผนก
														<select id="dep_id" name="dep_id" class="form-select">
															<option selected value= ''>หน่วยงานทั้งหมด</option>
															<option value= 'ไม่มีหน่วยงาน'>ไม่มีหน่วยงาน</option>

															<?php
															while ($dep = $depResult->fetch_assoc()){
															?>

															<option value="<?php echo $dep['dep_name']?>" >
																<?php echo $dep['dep_name']?>
															</option>
															
															<?php
															}
															?>

														</select>
													</div>
													<div class="col-12 col-md-6">
														ค้นหาข้อมูล
														<input id="searchWord" class="form-control form-control-lg" type="text" placeholder="ค้นหาจากคำ..." autofocus autocomplete="off">
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
												<a class="btn btn-lg btn-primary w-100 text-nowrap" href="a-user-new.php">
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
										$sql = 'SELECT 	(select count(*) FROM user WHERE user_level <> 1) as total, 
														(select count(*) FROM user WHERE user_level = 2 ) as officerCount,
														(select count(*) FROM user WHERE user_level = 3 ) as userCount';
										$result=$repairDB->query($sql);
										$row=$result->fetch_assoc();
									?>

								<table id="table" class="table table-hover mt-2 display nowrap w-100">
									<thead>
										<tr>
											<th colspan="6" class="h5 px-0">
												<span class="active-badge my-badge ms-2 badge bg-secondary py-1 clickable" data-group="" onclick="searchCol(5, '')">
													รายการทั้งหมด
													<span class="badge my-badge bg-light text-dark ms-2 p-1">
														<?php echo $row["total"];?>
													</span>
												</span>
												<span class="badge my-badge bg-info py-1 clickable" data-group="ผู้ใช้ระบบ" onclick="searchCol(5, 'ผู้ใช้ระบบ')">
													ผู้ใช้ระบบ
													<span class="badge bg-light text-dark ms-2 p-1">
														<?php echo $row["userCount"];?>
													</span>
												</span>
												<span class="badge my-badge bg-primary py-1 clickable" data-group="ช่างซ่อมบำรุง" onclick="searchCol(5, 'ช่างซ่อมบำรุง')">
													ช่างซ่อมบำรุง
													<span class="badge bg-light text-dark ms-2 p-1">
														<?php echo $row["officerCount"];?>
													</span>
												</span>
											</th>
										</tr>
										<tr>
											<th width="80"></th>
											<th>ชื่อ สกุล</th>
											<th>บัญชีผู้ใช้</th>
											<th>โทรศัพท์</th>
											<th>หน่วยงาน/แผนก</th>
											<th>สิทธิการใช้งาน</th>
										</tr>
									</thead>
									<tbody>

										<?php
											$sql="	SELECT 	US.user_id, user_profile, user_name, user_lastname, user_username, user_tel, dep_name, US.user_level, level_name 
													FROM 	user US 
															LEFT JOIN user_dep DE ON US.dep_id = DE.dep_id 
															LEFT JOIN user_level LV ON US.user_level = LV.level_id
													WHERE	user_level <> 1
													ORDER BY user_name, user_lastname;";
											$userData=$repairDB->query($sql);

											while($user = $userData->fetch_assoc()){
												$recordID = $user["user_id"];
										?>

										<tr class="clickable" onclick='showDetail("<?php echo $recordID?>")' >
											<td class="text-center">
												<img src='img/avatars/<?php echo $user["user_profile"];?>' class="rounded-circle" width="45"/>
											</td>
											<td>
												<?php echo $user["user_name"]."  ".$user["user_lastname"];?>
											</td>
											<td>
												<?php echo $user["user_username"];?>
											</td>
											<td>
												<?php echo $user["user_tel"];?>
											</td>
											<td>
												<span class="d-inline-block text-truncate" style="max-width: 200px;">
													<?php echo $user["dep_name"] != '' ? $user["dep_name"] : "ไม่มีหน่วยงาน";?>
												</span>
											</td>
											<td>
												<?php
													$color = "";
													if($user["user_level"] == 2) $color = "bg-primary";
													else if($user["user_level"] == 3) $color = "bg-info";
												?>
												<span class="badge <?php echo $color;?> w-100 py-1">
													<?php echo $user["level_name"];?>
												</span>
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
	<script type="text/javascript">
		$(document).ready(function() {
			$('#dep_id').select2();
		});

		$('#dep_id').change(function(){
			var dep = $('#dep_id').val();
			table.columns( 4 ).search( dep ).draw();
		});

		function showDetail(id) {
			$.ajax({
				type:'post',
				url: "be-user-manage.php",
				data: {action: "viewRecord", user_id: id},
				success:function(data) {
					window.location.href="a-user-manage.php";
				}
			});
		}
	</script>
</body>
</html>
<?php $repairDB->close();?>