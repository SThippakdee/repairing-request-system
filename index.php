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
		.mini-profile {
			overflow: hidden;
			object-fit: cover;
		}
	</STYLE>
    </head>

    <body style="background-color: #222e3c;">
        <main class="d-flex w-100">
            <div class="container d-flex flex-column">
                <div class="row vh-100 p-0">
                    <div class="col-xl-10 col-lg-12 col-md-9 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">
                            
                            <div class="card o-hidden border-0 shadow-lg mb-0">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-lg-6 d-none d-lg-block p-0 h-100">
                                            <div class="d-table h-100">
                                                <div class="d-table-cell align-middle">
                                                    <img class="img-fluid" src="img/pics/body/login-cover-pic.jpg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 h-100">
                                            <div class="p-4 my-4">
                                                <div class="text-center mb-4 mt-3">
                                                    <a class="h1 text-gray-900 text-decoration-none" style="font-family:Fredoka One">
                                                        Reparing Request
                                                    </a>
                                                </div>
                                                <br>
                                                <br>
                                                <form class="user" action="be-checkLogin.php" method="POST">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-user" name="username"
                                                        required autofocus autocomplete="off" placeholder="Username"
                                                        value="<?php if(isset($_COOKIE["RWeb-userName"])) echo $_COOKIE["RWeb-userName"];?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control form-control-user" name="password" 
                                                        required autocomplete="off" placeholder="Password"
                                                        value="<?php if(isset($_COOKIE["RWeb-token"])) echo $_COOKIE["RWeb-token"];?>">
                                                    </div>
                                                    <div class="form-group ms-2 mb-5">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="form-check-input" name="remember"
                                                            <?php if(isset($_COOKIE["RWeb-userName"])) echo "checked";?>>
                                                            <label class="form-check-label small ms-1" for="remember">?????????????????????????????????????????????</label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary btn-user btn-block shadow mb-2">
                                                        <span class="h6 text-light">?????????????????????????????????</span>
                                                        <i class="fa-solid fa-lg fa-arrow-right-to-bracket ms-2"></i>
                                                    </button>
                                                </form>
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
                        title: '???????????????????????????????????????????????????',
                        timer: 2000,
                        timerProgressBar: true
                    }).then((result) => {
                        if (result.dismiss) {
                            window.location.href="be-redirect.php";
                        }
                    })  
                }
                else{
                    var msg = data.split("|");
                    Swal.fire({
                        icon: 'error',
                        title: '??????????????????????????????????????????????????????',
                        text: msg[1],
                        showConfirmButton: false
                    })
                }
            }
        });
    });
</script>