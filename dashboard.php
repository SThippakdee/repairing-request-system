
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard</title>
            
        <!-- Include fonts/css/js -->
        <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Fredoka One" rel="stylesheet">
        
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/app.css">

        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendors/jquery3.6.0/jquery-3.6.0.min.js"></script>
        <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
        <script src="assets/vendors/chartJS/chart.min.js"></script>
        <script src="assets/vendors/fontawesome6.1.2/all.min.js"></script>
        
        
        <!-- Page Style -->
        <style type="text/css">
            body {
                font-family: "Kanit" !important;
                background-color: #222e3c;
            }
        </style>
    </head>
    <body>
    <div id="app">
        <?php include_once("app/component/sidebar-admin.php");?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-content">
                content
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>footer</p>
                        <a onclick="logout()" class="btn btn-primary p-2"><i class="fa fa-power-off me-2"></i>Log out</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!--Page Script-->
    <script src="app/script/sidebar.js"></script>
    
    </body>
</html>