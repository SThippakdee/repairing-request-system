        
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand">
					<span class="align-middle">Repairing Request
					<i class="fa-solid fa-wrench ms-2"></i></span>
				</a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						<h5 class="text-light">Menu<h5>
					</li>
					<li class="sidebar-item" data-title="Dashboard">
						<a class="sidebar-link" href="a-dashboard.php#">
              				<i class="fa-solid fa-lg fa-gauge-high me-3"></i>
							<span class="align-middle">Dashboard</span>
            			</a>
					</li>
					<li class="sidebar-item" data-title="บัญชีผู้ใช้">
						<a class="sidebar-link" href="a-user.php">
							<i class="fa-solid fa-lg fa-user-group"></i>
							<span class="align-middle">บัญชีผู้ใช้</span>
            			</a>
					</li>
					<li class="sidebar-item" data-title="รายการแจ้งซ่อม"> 
						<a class="sidebar-link" href="a-request.php">
							<i class="fa-solid fa-lg fa-screwdriver-wrench me-3"></i>
							<span class="align-middle">รายการแจ้งซ่อม</span>
            			</a>
					</li>
					<li class="sidebar-item" data-title="จัดการข้อมูลระบบ">
						<a class="sidebar-link" data-bs-toggle="collapse" href="#submenu1">
							<i class="fa-solid fa-lg fa-rectangle-list"></i>
							<span class="align-middle">จัดการข้อมูลระบบ</span>
							<i class="fa-solid fa-chevron-down float-end"></i>
            			</a>
					</li>
					<ul class="sidebar-nav collapse" id="submenu1">
						<li class="sidebar-link">
							<a class="sidebar-link" href="a-department.php" data-page="ข้อมูลหน่วยงาน/แผนก">
								<span class="align-middle ms-2">ข้อมูลหน่วยงาน/แผนก</span>
							</a>
							<a class="sidebar-link" href="a-devicetype.php" data-page="ข้อมูลประเภทครุภัณฑ์">
								<span class="align-middle ms-2">ข้อมูลประเภทครุภัณฑ์</span>
							</a>
							<a class="sidebar-link" href="a-service.php" data-page="ข้อมูลบริการ">
								<span class="align-middle ms-2">ข้อมูลบริการ</span>
							</a>
							<a class="sidebar-link" href="a-serveyTopic.php" data-page="ข้อมูลการประเมินบริการ">
								<span class="align-middle ms-2">ข้อมูลการประเมินบริการ</span>
							</a>
						</li>
					</ul>
					<li class="sidebar-item" data-title="รายงานการแจ้งซ่อม">
						<a class="sidebar-link" data-bs-toggle="collapse" href="#submenu2">
							<i class="fa-solid fa-lg fa-chart-pie"></i>
							<span class="align-middle">รายงานการแจ้งซ่อม</span>
							<i class="fa-solid fa-chevron-down float-end"></i>
            			</a>
					</li>
					<ul class="sidebar-nav collapse" id="submenu2">
						<li class="sidebar-link">
							<a class="sidebar-link" href="#" data-page="#">
								<span class="align-middle ms-2">รายงาน1</span>
							</a>
							<a class="sidebar-link" href="#" data-page="#">
								<span class="align-middle ms-2">รายงาน2</span>
							</a>
							<a class="sidebar-link" href="#" data-page="#">
								<span class="align-middle ms-2">รายงาน3</span>
							</a>
						</li>
					</ul>
					<li class="sidebar-item"> 
						<a class="sidebar-link" href="#" onclick="logout()">
							<i class="fa fa-lg fa-power-off me-3"></i>
							ออกจากระบบ
            			</a>
					</li>
				</ul>
			</div>
		</nav>
		