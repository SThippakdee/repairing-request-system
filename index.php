<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Log in</title>
        
        <!-- Include fonts/css/js -->
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredoka One" rel="stylesheet">
	
	<link href="asset/css/app.css" rel="stylesheet">
    <link href="asset/css/login.min.css" rel="stylesheet">
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

    <body style="background-color: #222e3c;">
        <main class="d-flex w-100">
            <div class="container d-flex flex-column">
                <div class="row vh-100">
                    <div class="col-xl-10 col-lg-12 col-md-9 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">
                            
                            <div class="card o-hidden border-0 shadow-lg mb-0">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-lg-6 d-none d-lg-block p-0">
                                            <div class="d-table h-100">
                                                <div class="d-table-cell align-middle">
                                                    <img class="img-fluid h-100" src="img/pics/login-cover-pic.jpg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="p-4 my-5">
                                                <div class="text-center mb-5">
                                                    <a class="h1 text-gray-900 text-decoration-none" style="font-family:Fredoka One">
                                                        Reparing Request
                                                    </a>
                                                </div>
                                                <br>
                                                <form class="user" action="be-checkLogin.php" method="POST">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-user" name="username"
                                                        required autofocus autocomplete="off" placeholder="Username">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control form-control-user" name="password" 
                                                        required placeholder="Password">
                                                    </div>

                                                    <div class="form-group ms-2">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="form-check-input" name="remember">
                                                            <label class="form-check-label small ms-1" for="remember">จดจำบัญชีผู้ใช้</label>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-user btn-block shadow mb-2 mt-4">
                                                        <span class="h6 text-light">เข้าสู่ระบบ</span>
                                                        <i class="fa-solid fa-lg fa-arrow-right-to-bracket ms-2"></i>
                                                    </button>
                                                </form>

                                                <div class="text-center mt-4">
                                                    <a class="small" href="#"><i class="fa-solid fa-key me-2"></i>ลืมรหัสผ่าน? รีเซ็ตรหัสผ่านปัจจุบัน</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>

<script type="text/javascript">
    //login action alert
    $('form').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var actionUrl = form.attr('action');
        $.ajax({
            type:'post',
            url:actionUrl,
            data:form.serialize(),
            success:function(data) {
                if(data == "success"){
                    Swal.fire({
                        icon: 'success',
                        showConfirmButton: false,
                        title: 'เข้าสู่ระบบสำเร็จ',
                        timer: 2000,
                        timerProgressBar: true
                    }).then((result) => {
                        if (result.dismiss) {
                            window.location.href="be-redirect.php";
                        }
                    })  
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        title: 'เข้าสู่ระบบล้มเหลว',
                        text: data,
                        showConfirmButton: false
                    })
                }
            }
        });
    });
</script>