<?php
	if(session_status()==PHP_SESSION_NONE) session_start();
	if(isset($_SESSION["RWeb-userLevel"]) && $_SESSION["RWeb-userLevel"] == "1"){
		require_once("app/script/header-a.php");
	}
	else if(isset($_SESSION["RWeb-userLevel"]) && $_SESSION["RWeb-userLevel"] == "2"){
		require_once("app/script/header-o.php");
	}
	else if(isset($_SESSION["RWeb-userLevel"]) && $_SESSION["RWeb-userLevel"] == "3"){
		require_once("app/script/header-u.php");
	}
	else{
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
	<title>Profile</title>

	<!-- Include fonts/css/js -->
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

	<link href="asset/vendors/select2/select2.min.css" rel="stylesheet">
	<link href="asset/css/app.css" rel="stylesheet">
	<link href="asset/vendors/fontawesome-6.1.2/css/all.min.css" rel="stylesheet">
	
	<script src="asset/js/app.js"></script>
	<script src="asset/vendors/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="asset/vendors/sweetalert2/sweetalert2.all.min.js"></script>
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
			width: 10rem;
			height: 10rem;
			margin-top: -6.3rem;
			margin-bottom: 1rem;
			border: 4px solid #fff;
			border-radius: 100%;
			box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);
			z-index: 2;
		}
		.card-profile .card-header {
			height: 9rem;
			background-position: center center;
			background-size: cover;
		}
		#profilePic{
			transition: transform .2s;
			overflow: hidden;
			object-fit: cover;
		}
		#profilePic:hover{
			border: 8px solid #2f64b1;
			cursor: pointer;
			transform: scale(1.1);
		}
		.text-muted {
 			 color: #6c757d !important;
		}
    </STYLE>
</head>

<body>
	<div class="wrapper">
		<!--Sidebar-->
		<?php
			if($_SESSION["RWeb-userLevel"] == "1"){
				require_once("app/components/sidebar-admin.php");
			}
			else if($_SESSION["RWeb-userLevel"] == "2"){
				require_once("app/components/sidebar-officer.php");
			}
			else if($_SESSION["RWeb-userLevel"] == "3"){
				require_once("app/components/sidebar-user.php");
			}
		?>

		<div class="main">
			<!--Topbar-->
			<?php require_once("app/components/topbar.php");?>

			<main class="content" style="background-color: #EBEBEB;">
				<div class="container-fluid p-0 h-100">
					<!--Start Content-->
					<?php
						$sql = sprintf("SELECT * FROM user U LEFT JOIN user_level L ON U.user_level = L.level_id WHERE user_id = '%s'", $_SESSION['RWeb-userID']);
						$result=$repairDB->query($sql);
						$row=$result->fetch_assoc();
					?>

						<div class="row g-3 h-100">
							<div class="col-xl-4">
								<div class="card card-profile shadow-lg h-100 mb-0">
									<div class="card-header" style="background-image: url(img/pics/body/profile-bg.jpg);"> </div>
									
									<div class="card-body text-center">
										
										<img id="profilePic" class="card-profile-img" src="<?php echo("img/avatars/".$row["user_profile"]);?>">
											
										<div style="border: 4px solid #222e3c; border-radius: 20px; box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);">
											<h3 class="mt-2"><?php echo($row["user_name"]." ".$row["user_lastname"]);?></h3>
											<h4>Username: <?php echo $row["user_username"];?></h4>
											<h4 class="text-muted">( <?php echo $row["level_name"];?> )</h4>
										</div>
									</div>

									<div class="card-footer">
										<div class="row g-2 justify-content-center">
											<div class="col-12 col-sm-6 col-xl-12">
												<?php $user_id = $row["user_id"];?>
												<a class="btn btn-lg btn-primary w-100" onclick="resetPass('<?php echo $user_id;?>')">
													<i class="fa-solid fa-key fa-lg me-2"></i>
													??????????????????????????????????????????
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-8">
								<form id="mainForm" action="be-profile-manage.php" method="POST" enctype="multipart/form-data" class="card card-profile overflow-hidden shadow-lg h-100 mb-0">
									<div class="card-header text-center d-table" style="background-image: url(img/pics/body/profile-bg.jpg);">
										<div class="d-table-cell align-middle p-0">
											<h1 class="text-white fw-bold">
												Repairing Request
												<i class="fa-solid fa-wrench ms-2"></i>
											</h1>
										</div>
									</div>
									<div class="card-body">
										<div class="card card-profile shadow-lg mb-0 border border-2">
											<div class="card-body">
												<h5 class="card-title">???????????????????????????????????????</h5>
												<div class="row mt-4">

													<input type="hidden" name="action" value="updateData"/>
													<input type="hidden" name="user_id" value="<?php echo $row["user_id"];?>"/>
													<input id="avatarUpload" name="user_profile" class="d-none" type="file" accept="image/*" onchange="previewFile(this);"/>
													<input type="hidden" name="old_profile" value="<?php echo $row["user_profile"];?>"/>

													<div class="col-12 col-sm-6 mb-2">
														??????????????????????????????
														<input type="text" name="user_name"class="form-control form-control-lg" autocomplete="off" placeholder="??????????????????????????????"
														value="<?php echo $row["user_name"];?>" required/>
													</div>
													<div class="col-12 col-sm-6 mb-2">
														?????????????????????
														<input type="text" name="user_lastname" class="form-control form-control-lg" autocomplete="off" placeholder="?????????????????????"
														value="<?php echo $row["user_lastname"];?>" required/>
													</div>
												</div>
												<div class="row">
													<div class="col-12 col-sm-6 mb-2">
														Username
														<input type="text" name="user_username" class="form-control form-control-lg" autocomplete="off" placeholder="Username"
														value="<?php echo $row["user_username"];?>" required/>
													</div>
													<div class="col-12 col-sm-6 mb-2">
														????????????????????????
														<input type="text" name="user_tel" class="form-control form-control-lg" autocomplete="off" placeholder="????????????????????????"
														value="<?php echo $row["user_tel"];?>" required/>
													</div>
												</div>

												<?php
													$sql = sprintf("SELECT * FROM user_dep ORDER BY dep_name;");
													$depResult=$repairDB->query($sql);
												?>

												<div class="row">
													<div class="col">
														????????????????????????/????????????
														<select id="dep_id" name="dep_id" class="form-select" required>
															<option disabled selected>-- ???????????????????????????????????????/???????????? --</option>
															<option <?php if($row["dep_id"]=="") echo "selected";?> value= ''>???????????????????????????????????????</option>

															<?php
															while ($dep = $depResult->fetch_assoc()){
															?>

															<option value="<?php echo $dep['dep_id']?>" <?php if($row["dep_id"]==$dep["dep_id"]) echo "selected";?> >
																<?php echo $dep['dep_name']?>
															</option>
															
															<?php
															}
															?>

														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer">
										<div class="row g-2 mb-0 justify-content-end">
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <a class="btn btn-lg btn-secondary w-100" onclick="history.back()">
                                                    <i class="fa-solid fa-circle-chevron-left fa-lg me-2"></i>
                                                    ????????????????????????
                                                </a>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <button type="submit" class="btn btn-lg btn-primary w-100">
                                                    <i class="fa-regular fa-floppy-disk fa-lg me-2"></i>
                                                    ??????????????????
                                                </button>
                                            </div>
                                        </div>
									</div>
								</form>
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
	<script src="app/script/profile-manage.js"></script>
	<script>
		$(document).ready(function() {
			$('#dep_id').select2();
		});
	</script>
</body>
</html>
<?php $repairDB->close(); ?>