			
			<nav class="navbar navbar-expand navbar-light navbar-bg shadow-lg">
				<a class="sidebar-toggle js-sidebar-toggle">
          			<i class="hamburger align-self-center"></i>
        		</a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-link" href="#" data-bs-toggle="dropdown">
                				<img src="<?php echo("img/avatars/".$row["user_profile"]);?>" class="avatar img-fluid rounded-circle me-1"/>
              				</a>
							<div class="dropdown-menu dropdown-menu-end p-0" style="width:250px;">
								<div class="card card-profile shadow-lg mb-0 mt-0">
									<div class="card-header text-center" style="background-image: url(img/pics/profile-bg.jpg);">
										<img class="rounded-circle mt-3 border border-2 border-light" src="<?php echo("img/avatars/".$row["user_profile"]);?>" style="width:80px;">
									</div>
									<div class="card-body text-center p-2">
										<h4 class="mb-3 mt-2"><?php echo($row["user_name"]."  ".$row["user_lastname"]);?></h4>
										<div class="row g-0 justify-content-center">
											<a href="profile.php" class="btn btn-primary w-100 h5">
												<i class="fa-solid fa-gear me-2 ms-1"></i>
												ตั้งค่าบัญชีผู้ใช้
											</a>
											<a class="btn btn-primary w-100 h5" onclick="logout()">
												<i class="fa-solid fa-power-off me-2"></i>
												ออกจากระบบ
											</a>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			