<?php include_once('header.php'); ?>
<?php
$obj_dbcon = new dbcon;

$your_id = $obj_dbcon->fetch_user_id($_SESSION['sess_u_id']);
$fetch_your_id = $your_id->fetch_array();

if (isset($_POST['submit'])) {

    $u_id = $_SESSION['sess_u_id'];
    $u_pass = $_POST['txt_pass'];
    $u_pass_check = $_POST['txt_pass_check'];
    $u_email = $_POST['txt_email'];
    $u_tel = $_POST['txt_tel'];

    if ($u_pass != $u_pass_check) {
        echo "<script>alert('รหัสผ่านไม่ตรงกัน')</script>";
        echo "<script>window.location.href='profile_edit.php'</script>";
        exit();
    }


    $opr_update = $obj_dbcon->update_profile($u_id, $u_pass, $u_email, $u_tel);
    if (!$opr_update) {
        echo "<script>alert('ผิดพลาด')</script>";
        echo "<script>window.history.back()</script>";
    } else {
        echo "<script>alert('แก้ไขสำเร็จ !!')</script>";
        echo "<script>window.location.href='profile_edit.php'</script>";
    }
}

?>

<title>Edit Profile</title>
</head>

<body class="skin-blue">

    <div class="wrapper">

        <!-- Main Header -->
        <?php include('navbar.php') ?>

        <!-- Left side column. contains the logo and sidebar -->
        <?php include('sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- <section class="content-header">
                <h1>
                    <b>Page Header</b>
                    <small>Optional description</small>
                </h1>
            </section> -->

            <!-- Main content -->
            <section class="content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</h3>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="card">
                                    <div class="card-header bg-warning text-dark">
                                        
                                    </div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-group row">
                                                <label for="txt_user" class="col-sm-2 col-form-label text-sm-right">Username</label>
                                                <div class="col-sm-10">
                                                    <input name="txt_user" readonly type="text" class="form-control" id="txt_user" value="<?php echo $fetch_your_id['u_user']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="txt_pass" class="col-sm-2 col-form-label text-sm-right">Password</label>
                                                <div class="col-sm-10">
                                                    <input name="txt_pass" type="password" class="form-control" id="txt_pass" value="<?php echo $fetch_your_id['u_pass']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="txt_pass" class="col-sm-2 col-form-label text-sm-right">Confirm Password</label>
                                                <div class="col-sm-10">
                                                    <input name="txt_pass_check" type="password" class="form-control" id="txt_pass" value="<?php echo $fetch_your_id['u_pass']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="txt_email" class="col-sm-2 col-form-label text-sm-right">E-mail</label>
                                                <div class="col-sm-10">
                                                    <input name="txt_email" type="email" class="form-control" id="txt_email" value="<?php echo $fetch_your_id['u_email']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="txt_tel" class="col-sm-2 col-form-label text-sm-right">Tel</label>
                                                <div class="col-sm-10">
                                                    <input name="txt_tel" type="text" class="form-control" id="txt_tel" maxlength="10" value="<?php echo $fetch_your_id['u_tel']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-2 col-form-label text-sm-right"></label>
                                                <div class="col-sm-10">
                                                    <input type="submit" name="submit" class="btn btn-warning" value="Save">
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php include("footer.php"); ?>
    </div>
    <!-- ./wrapper -->

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/adminlte.min.js"></script>


</body>

</html>