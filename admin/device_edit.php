<?php
include_once('header.php');

$obj_dbcon = new dbcon;

$your_id = $obj_dbcon->fetch_device_id($_GET['dv_id']);
$fetch_your_id = $your_id->fetch_array();

if (isset($_POST['submit'])) {

    $dv_id = $_POST['txt_id'];
    $dv_name = $_POST['txt_name'];
    $dv_detail = $_POST['txt_detail'];

    $dv_t_min = $_POST['txt_t_min'];
    $dv_t_max = $_POST['txt_t_max'];

    $dv_s_min = $_POST['txt_s_min'];
    $dv_s_max = $_POST['txt_s_max'];

    $dv_b_min = $_POST['txt_b_min'];
    $dv_b_max = $_POST['txt_b_max'];

    $dv_lat = $_POST['txt_lat'];
    $dv_lon = $_POST['txt_lon'];

    $dv_line_tk = $_POST['txt_line_tk'];


    $opr_update = $obj_dbcon->update_device($dv_id, $dv_name, $dv_detail, $dv_t_min, $dv_t_max, $dv_s_min, $dv_s_max,$dv_b_min, $dv_b_max, $dv_lat, $dv_lon, $dv_line_tk);
    if (!$opr_update) {
        echo "<script>alert('ผิดพลาด')</script>";  
        echo "<script>window.history.back()</script>";
    } else {
        echo "<script>alert('แก้ไขสำเร็จ !!')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}

if (isset($_GET["action"]) == "remove") {
    $dv_id = $_GET['dv_id'];
    $remove_device = $obj_dbcon->remove_device($dv_id);
    if (!$remove_device) {
        echo "<script>alert('ผิดพลาดไอควาย')</script>";
        echo "<script>window.history.back()</script>";
    } else {
        echo "<script>alert('ลบสำเร็จ !!')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}

?>

<title>Edit Device</title>
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
                                <h3 class="box-title">Edit Device</h3>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form method="POST">

                                    <input name="txt_id" readonly type="hidden" class="form-control" id="txt_id" value="<?php echo $fetch_your_id['dv_id']; ?>">

                                    <div class="form-group row">
                                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Device</label>
                                        <div class="col-sm-10">
                                            <input name="txt_name" type="text" class="form-control" id="txt_name" value="<?php echo $fetch_your_id['dv_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="txt_detail" class="col-sm-2 col-form-label text-sm-right">Detail</label> <!-- heeyai -->
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <textarea name="txt_detail" class="form-control" id="txt_detail"><?php echo $fetch_your_id['dv_detail']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <h4 style="margin-left: 11.5rem;"><b class="text-danger">Set Alert</b></h4>
                                    <div class="form-group row">
                                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Temperature</label>
                                        <div class="col-sm-2">
                                            <input name="txt_t_min" type="number" class="form-control" id="txt_t_min" placeholder="min" value="<?php echo $fetch_your_id['dv_t_min']; ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <input name="txt_t_max" type="number" class="form-control" id="txt_t_max" placeholder="max" value="<?php echo $fetch_your_id['dv_t_max']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Humidity</label>
                                        <div class="col-sm-2">
                                            <input name="txt_s_min" type="number" class="form-control" id="txt_s_min" placeholder="min" value="<?php echo $fetch_your_id['dv_s_min']; ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <input name="txt_s_max" type="number" class="form-control" id="txt_s_max" placeholder="max" value="<?php echo $fetch_your_id['dv_s_max']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Battery</label>
                                        <div class="col-sm-2">
                                            <input name="txt_b_min" type="number" class="form-control" id="txt_b_min" placeholder="min" value="<?php echo $fetch_your_id['dv_b_min']; ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <input name="txt_b_max" type="number" class="form-control" id="txt_b_max" placeholder="max" value="<?php echo $fetch_your_id['dv_b_max']; ?>">
                                        </div>
                                    </div> -->

                                    <h4 style="margin-left: 11.5rem;"><b class="text-danger">Set Location</b></h4>
                                    <div class="form-group row">
                                        <label for="txt_lat" class="col-sm-2 col-form-label text-sm-right">Latitude</label>
                                        <div class="col-sm-4">
                                            <input name="txt_lat" type="text" class="form-control" id="txt_lat" value="<?php echo $fetch_your_id['dv_lat']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="txt_lon" class="col-sm-2 col-form-label text-sm-right">Longitude</label>
                                        <div class="col-sm-4">
                                            <input name="txt_lon" type="text" class="form-control" id="txt_lon" value="<?php echo $fetch_your_id['dv_lon']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="getLocation()">Current location</button>
                                                    <!-- <span id="DisplayLocation"></span> -->
                                                </div>
                                            </div>
                                            <!-- <p style="color:red;font-weight:bold">(คำเตือน )</p> -->
                                        </div>
                                        <script>
                                            var x = document.getElementById("DisplayLocation");
                                            var lat = document.getElementById("txt_lat");
                                            var lon = document.getElementById("txt_lon");

                                            function getLocation() {
                                                if (navigator.geolocation) {
                                                    navigator.geolocation.getCurrentPosition(showPosition);
                                                } else {
                                                    x.innerHTML = "Geolocation is not supported by this browser.";
                                                }
                                            }

                                            function showPosition(position) {
                                                lat.value = position.coords.latitude;
                                                lon.value = position.coords.longitude;
                                                x.innerHTML = "<b>Latitude:</b> " + position.coords.latitude + "    <b>Longitude:</b> " + position.coords.longitude;
                                            }
                                        </script>

                                    </div>

                                    <!-- <div class="form-group row">
                                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Line Token</label>
                                        <div class="col-sm-10">
                                            <input name="txt_line_tk" type="text" class="form-control" id="txt_line_tk" value="<?php echo $fetch_your_id['dv_line_tk']; ?>">
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label text-right"></label>
                                        <div class="col-sm-10">
                                            <input type="submit" name="submit" class="btn btn-warning" value="Save">
                                            <a href="?dv_id=<?= $_GET['dv_id'] ?>&action=remove" class="btn btn-danger" onclick="return confirm('ยืนยันการลบ?');">Remove Deivce</a>
                                        </div>
                                    </div>

                                </form>
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