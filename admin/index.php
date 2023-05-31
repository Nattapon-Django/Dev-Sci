<?php include('header.php'); ?>
<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">

<title>Home</title>
</head>
<?php
$obj_dbcon = new dbcon;
$get_device = $obj_dbcon->fetch_device();

?>

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
                </div>
                <div class="row">
                    <?php
                    $check_status = new dbcon;
                    $check_status = $check_status->countDevice_status_admin();
                    ?>
                    <div class="col-md-4">
                        <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-blue"><i class="fa fa-desktop"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">All Device</span>
                                <span class="info-box-number"><?php echo $get_device_total = $get_device->num_rows; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-green"><i class="fa fa-power-off"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Online</span>
                                <span class="info-box-number"><?php echo $check_status[1] ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box">
                            <!-- Apply any bg-* class to to the icon to color it -->
                            <span class="info-box-icon bg-red"><i class="fa fa-power-off"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Offline</span>
                                <span class="info-box-number"><?php echo $check_status[0] ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <a href="device_add.php"><button class="btn btn-success mb-2"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Device</button></a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="show_device" width="100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" colspan="8" class="text-center" style="background-color:#6c757d;color:white;"><b style="font-size:18px;">Device list</b></th>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="align-self-center" width="1%">#</th>
                                                <th scope="col" width="15%">Device Name</th>
                                                <th scope="col">Detail</th>
                                                <th scope="col" width="1%">Edit</th>
                                                <th scope="col" width="1%">Status</th>
                                                <th scope="col" width="1%">VIEW</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($fetch_device = $get_device->fetch_array()) {
                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $fetch_device['dv_id']; ?></th>
                                                    <td><?php echo $fetch_device['dv_name']; ?></td>
                                                    <td style="text-align:left;"><?php echo $fetch_device['dv_detail']; ?></td>
                                                    <td><a href="device_edit.php?dv_id=<?php echo $fetch_device['dv_id']; ?>"><button class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a></td>
                                                    <td><?php echo $check_status_device = $obj_dbcon->check_status_device($fetch_device['dv_id']); ?></td>
                                                    <td><a href="device_show.php?dv_id=<?php echo $fetch_device['dv_id']; ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> INFO</button></a></td>
                                                </tr>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
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