<?php
session_start();
if (isset($_SESSION['userid'])) {
    if ($_SESSION['userid'] != "") {
        echo "<script type='text/javascript'> document.location = 'app/dashboard.php'; </script>";
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Task Manager | Sign In</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico"/>
    <link rel="stylesheet" href="assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/remixicon/fonts/remixicon.css">

    <link rel="stylesheet" href="assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">
</head>
<body class=" ">
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->

<div class="wrapper">
    <section class="login-content">
        <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
                <div class="col-lg-8">
                    <div class="card auth-card">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center auth-content">
                                <div class="col-lg-6 bg-primary content-left">
                                    <div class="p-3">
                                        <h2 class="mb-2 text-white">Sign In</h2>
                                        <p>Login to stay connected.</p>
                                        <form id="loginForm" method="post" action="login.php">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="floating-label form-group">
                                                        <input class="floating-input form-control" type="email"
                                                               name="username" required
                                                               placeholder="">
                                                        <label>Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="floating-label form-group">
                                                        <input class="floating-input form-control" type="password"
                                                               name="password" required
                                                               placeholder="">
                                                        <label>Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="login" class="btn btn-white">Sign In</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 content-right">
                                    <img src="assets/images/login/01.png" class="img-fluid image-right" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Backend Bundle JavaScript -->
<script src="assets/js/backend-bundle.min.js"></script>

<!-- Table Treeview JavaScript -->
<script src="assets/js/table-treeview.js"></script>

<!-- Chart Custom JavaScript -->
<script src="assets/js/customizer.js"></script>

<!-- Chart Custom JavaScript -->
<script async src="assets/js/chart-custom.js"></script>
<!-- Chart Custom JavaScript -->
<script async src="assets/js/slider.js"></script>

<!-- app JavaScript -->
<script src="assets/js/app.js"></script>

<script src="assets/vendor/moment.min.js"></script>
</body>
</html>