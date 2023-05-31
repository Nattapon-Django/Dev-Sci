<?php
include_once('header.php');

$obj_dbcon = new dbcon;


if (isset($_POST['submit'])) {

    $fetch_max_dv_id = $obj_dbcon->device_get_max();
    $fetch_max_dv_id += 1;

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


    $opr_update = $obj_dbcon->add_device($fetch_max_dv_id, $dv_name, $dv_detail, $dv_t_min, $dv_t_max, $dv_s_min, $dv_s_max,$dv_b_min, $dv_b_max, $dv_lat, $dv_lon, $dv_line_tk);
    if (!$opr_update) {
        echo "<script>alert('ผิดพลาด')</script>";
        echo "<script>window.history.back()</script>";
    } else {
        echo "<script>alert('เพิ่มสำเร็จ !!')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}

?>
<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
<title>Add Device</title>
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
                                <h1 class="box-title"><b>Add Device</b></h1>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form method="POST">
                                    <!-- <div class="form-group row">
                        <label for="txt_id" class="col-sm-2 col-form-label text-sm-right">Number</label>
                        <div class="col-sm-10">
                            <input name="txt_id" readonly type="text" class="form-control" id="txt_id" value="<?php echo $fetch_your_id['dv_id']; ?>">
                        </div>
                    </div> -->
                                    <div class="form-group row">
                                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right"><b style="color:red;">*</b> Device</label>
                                        <div class="col-sm-10">
                                            <input name="txt_name" type="text" class="form-control" id="txt_name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="txt_detail" class="col-sm-2 col-form-label text-sm-right"><b style="color:red;">*</b> Detail</label> <!-- heeyai -->
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <textarea name="txt_detail" class="form-control" id="txt_detail"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 style="margin-left: 11.5rem;"><b class="text-danger">Set Alert</b></h4>
                                    <div class="form-group row">
                                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Temperature</label>
                                        <div class="col-sm-2">
                                            <input name="txt_t_min" type="number" class="form-control" id="txt_t_min" placeholder="min">
                                        </div>
                                        <div class="col-sm-2">
                                            <input name="txt_t_max" type="number" class="form-control" id="txt_t_max" placeholder="max">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Humidity</label>
                                        <div class="col-sm-2">
                                            <input name="txt_s_min" type="number" class="form-control" id="txt_s_min" placeholder="min">
                                        </div>
                                        <div class="col-sm-2">
                                            <input name="txt_s_max" type="number" class="form-control" id="txt_s_max" placeholder="max">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Battery</label>
                                        <div class="col-sm-2">
                                            <input name="txt_b_min" type="number" class="form-control" id="txt_b_min" placeholder="min">
                                        </div>
                                        <div class="col-sm-2">
                                            <input name="txt_b_max" type="number" class="form-control" id="txt_b_max" placeholder="max">
                                        </div>
                                    </div>

                                    <h4 style="margin-left: 11.5rem;"><b class="text-danger">Set Location</b></h4>
                                    <div class="form-group row">
                                        <label for="txt_lat" class="col-sm-2 col-form-label text-sm-right">Latitude</label>
                                        <div class="col-sm-4">
                                            <input name="txt_lat" type="text" class="form-control" id="txt_lat">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="txt_lon" class="col-sm-2 col-form-label text-sm-right">Longitude</label>
                                        <div class="col-sm-4">
                                            <input name="txt_lon" type="text" class="form-control" id="txt_lon">
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
                                        </div>
                                        <script>
                                            var x = document.getElementById("DisplayLocation");
                                            var lat = document.getElementById("txt_lat");
                                            var lon = document.getElementById("txt_lon");

                                            function getLocation() {
                                                if (navigator.geolocation) {
                                                    navigator.geolocation.getCurrentPosition(showPosition);
                                                } else {
                                       
                                                }
                                            }

                                            function showPosition(position) {
                                                lat.value = position.coords.latitude;
                                                lon.value = position.coords.longitude;
                                              
                                            }
                                        </script>

                                    </div>


                                    <br>
                                    <div class="form-group row">
                                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Line Token</label>
                                        <div class="col-sm-10">
                                            <input name="txt_line_tk" type="text" class="form-control" id="txt_line_tk">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label text-right"></label>
                                        <div class="col-sm-10">
                                            <input type="submit" name="submit" class="btn btn-success" value="Add">
                                        </div>
                                    </div>

                                </form>
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


</body>

</html>