<?php
include_once('header.php');
$obj_dbcon = new dbcon;

if (isset($_GET['action']) == 'del') {
    $del_id = $_GET['u_id'];
    $opr_del = $obj_dbcon->del_user($del_id);

    if (!$opr_del) {
        echo "<script>alert('ผิดพลาดไอควาย')</script>";
        echo "<script>window.history.back()</script>";
    } else {
        echo "<script>alert('ลบสำเร็จ !!')</script>";
        echo "<script>window.location.href='user_show.php'</script>";
    }
}
?>
<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
<title>User List</title>
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
                                <h3 class="box-title">User List</h3>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
                                    <thead class="thead bg-primary text-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">Tel</th>
                                            <th scope="col">Type</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $obj_dbcon = new dbcon;
                                        $get_user = $obj_dbcon->fetch_user();
                                        while ($row_user = $get_user->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row_user['u_id'];?></td>
                                                <td><?php echo $row_user['u_user']; ?></td>
                                                <td><?php echo $row_user['u_email']; ?></td>
                                                <td><?php echo $row_user['u_tel']; ?></td>
                                                <td><?php echo $row_user['u_type']; ?></td>
                                                <td>
                                                    <a href="user_edit.php?u_id=<?php echo $row_user['u_id']; ?>"><button class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                                    <a href="?action=del&u_id=<?php echo $row_user['u_id']; ?>" onclick="return confirm('ยืนยันการลบ?');"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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

    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

</body>

</html>