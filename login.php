<?php
session_start();
require_once('functions.php');

$_SESSION['sess_u_type'] = isset($_SESSION['sess_u_type']) ? $_SESSION['sess_u_type'] : "";
check_already_login($_SESSION['sess_u_type']);

$obj_dbcon = new dbcon;
if (isset($_POST['submit-login'])) {
    if (!empty($_POST['txt_user']) and !empty($_POST['txt_pass'])) {
        $u_user = $_POST['txt_user'];
        $u_pass = $_POST['txt_pass'];

        $signin = $obj_dbcon->signin($u_user, $u_pass);
        $num_fet_signin = $signin->num_rows;

        $show_status = null;

        if ($num_fet_signin == 0) {
            $show_status = "<small style='color:red;'>Login error, try again.</small>";
        } else {
            $fetch_u = $signin->fetch_array();
            $_SESSION['sess_u_id'] = $fetch_u['u_id'];
            $_SESSION['sess_u_user'] = $fetch_u['u_user'];
            $_SESSION['sess_u_type'] = $fetch_u['u_type'];
            if ($_SESSION['sess_u_type'] == 'admin') {
                header('Location: admin/index.php');
            } else if ($_SESSION['sess_u_type'] == 'user') {
                header('Location: user/index.php');
            } else {
                echo "NO User";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Solar Cell Lamp</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="solar_lamp.png">
</head>

<body style="background-color: #fefefe;">
    <div class="login-box-style" style="padding: 30px 30px;">
        <div class="login-logo">
            <div class="row" style="margin: 10px 0px 20px 0px;">
                <div class="col-md-12">
                    <!-- <b>Solar Cell </b> <span style="color: #00c569;">Lamp</span> -->
                    <img src="Logo.png" alt="" style="height: 300px;">
                </div>
            </div>

        </div>
        <!-- /.login-logo -->
        <div class="login-box-body" id="login">
            <!-- <p class="login-box-msg">Sign in to start your session</p> -->

            <form action="login.php" method="post">
                <div class="form-group has-feedback">
                    <input name="txt_user" type="text" class="form-control" id="login-input" placeholder="Username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="txt_pass" type="password" class="form-control" id="login-input" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <?php if (!empty($show_status)) {
                            echo $show_status;
                        } ?>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button name="submit-login" type="submit" class="btn btn-block" id="login-btn-purple">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>