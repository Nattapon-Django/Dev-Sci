<?php

include_once('header.php');
$obj_dbcon = new dbcon;

//get info device
$fetch_device = $obj_dbcon->fetch_device_id($_GET['dv_id']);
$fetch_device = $fetch_device->fetch_array();

// end info device



?>
<title>Report</title>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
</head>

<body class="skin-blue">

    <div class="wrapper">

        <!-- Main Header -->
        <?php include('navbar.php') ?>

        <!-- Left side column. contains the logo and sidebar -->
        <?php include('sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <b>Report Page</b>
                    <!-- <small>Optional description</small> -->
                </h1>
            </section>

            <!-- Main content -->
            <section class="content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <!-- <div class="box-header with-border">
                                <h3 class="box-title">Default Box Example</h3>
                            </div> -->
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="callout callout-warning">
                                            <h4>Device ID: <?= $_GET['dv_id']; ?></h4>
                                            <h4>Device Name: <?= $fetch_device['dv_name']; ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div id="show_search">
                                            <form action="" method="GET">
                                                <input type="hidden" name="dv_id" value="<?php echo $_GET['dv_id']; ?>">
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="date">Date</label>
                                                        <input name="search_date" type="date" class="form-control" id="date" <?php if (!empty($_GET['search_date'])) {
                                                                                                                                    echo 'value=' . $_GET['search_date'];
                                                                                                                                } ?> required>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="Start">Time Start</label>
                                                        <input name="time_start_search" type="time" class="form-control" id="Start" <?php if (!empty($_GET['time_start_search'])) {
                                                                                                                                        echo 'value=' . $_GET['time_start_search'];
                                                                                                                                    } else {
                                                                                                                                        echo 'value=00:00';
                                                                                                                                    } ?> required>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="End">Time End</label>
                                                        <input name="time_end_search" type="time" class="form-control" id="End" <?php if (!empty($_GET['time_end_search'])) {
                                                                                                                                    echo 'value=' . $_GET['time_end_search'];
                                                                                                                                } else {
                                                                                                                                    echo 'value=23:59';
                                                                                                                                } ?> required>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="">&nbsp;</label>
                                                        <button name="search" value="ok" type="submit" class="form-control btn btn-success"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <?php if (isset($_GET['search'])) {
                                    $date_search = convertDateQueryToSQL($_GET['search_date']);

                                    $get_graph = $obj_dbcon->get_graph($_GET['dv_id'], $date_search, $_GET['time_start_search'], $_GET['time_end_search']);

                                    $date = array();
                                    $DHTtemp = array();
                                    $DHTtemp_value = array();
                                    $DS18temp = array();
                                    $DS19temp_value = array();
                                    while ($rs = $get_graph->fetch_array()) {
                                        $date[] = "\"" . $rs['Time'] . "\"";
                                        $DHTtemp[] = "\"" . $rs['DHTtemp'] . "\"";
                                        $DS18temp[] = "\"" . $rs['DS18Temp'] . "\"";

                                        $DHTtemp_value[] = $rs['DHTtemp'];
                                        $DS18temp_value[] = $rs['DS18Temp'];
                                    }
                                    $date = implode(",", $date);
                                    $DHTtemp = implode(",", $DHTtemp);
                                    $DS18temp = implode(",", $DS18temp);


                                    if (!empty($DHTtemp_value)) {
                                        //average
                                        $DHTtemp_value = array_filter($DHTtemp_value);
                                        $average_DHT = array_sum($DHTtemp_value) / count($DHTtemp_value);
                                        //
                                    }
                                    if (!empty($DS18temp_value)) {
                                        //average
                                        $DS18temp_value = array_filter($DS18temp_value);
                                        $average_DS18 = array_sum($DS18temp_value) / count($DS18temp_value);
                                        //
                                    }

                                ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            if (empty($DHTtemp)) { ?>
                                                <div class="col-12">
                                                    <div class="alert alert-danger" role="alert">
                                                        <b>Results</b> from <?= $_GET['search_date'] ?> time <?= $_GET['time_start_search'] ?> to <?= $_GET['time_end_search'] ?>
                                                    </div>
                                                    <div class="jumbotron jumbotron-fluid">
                                                        <div class="container">
                                                            <h5 class="display-9 text-center">No data found</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else {
                                            ?>
                                                <div class="col-12">
                                                    <div class="alert alert-success" role="alert">
                                                        <b>Results</b> from <?= $_GET['search_date'] ?> time <?= $_GET['time_start_search'] ?> to <?= $_GET['time_end_search'] ?>
                                                    </div>
                                                    <p class="mt-3">Total <?= $get_graph->num_rows; ?> items</p>
                                                    <canvas id="myChart" width="800px" height="300px"></canvas><br>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col"></th>
                                                                        <th scope="col"><b style="font-size:18px;">Minimum value</b></span></th>
                                                                        <th scope="col"><b style="font-size:18px;">Maximum value</b></span></th>
                                                                        <th scope="col"><b style="font-size:18px;">Average</b></span></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row" class="active">Temperature</th>
                                                                        <td class="info"><?php echo (min($DHTtemp_value));  ?></td>
                                                                        <td class="danger"><?php echo (max($DHTtemp_value));  ?></td>
                                                                        <td class="warning"><?php echo number_format($average_DHT, 2);  ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row" class="active">Humidity</th>
                                                                        <td class="info"><?php echo (min($DS18temp_value));  ?></td>
                                                                        <td class="danger"><?php echo (max($DS18temp_value));  ?></td>
                                                                        <td class="warning"><?php echo number_format($average_DS18, 2);  ?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                    <?php
                                                    $t_max = $fetch_device['dv_t_max'];
                                                    $t_min = $fetch_device['dv_t_min'];

                                                    $s_max = $fetch_device['dv_s_max'];
                                                    $s_min = $fetch_device['dv_s_min'];

                                                    for ($i = 1; $i <= $get_graph->num_rows; $i++) {
                                                        $t_max .= ',' . $fetch_device['dv_t_max'];
                                                        $t_min .= ',' . $fetch_device['dv_t_min'];

                                                        $s_max .= ',' . $fetch_device['dv_s_max'];
                                                        $s_min .= ',' . $fetch_device['dv_s_min'];
                                                    }

                                                    ?>
                                                    <script>
                                                        var ctx = document.getElementById("myChart").getContext('2d');
                                                        var myChart = new Chart(ctx, {
                                                            type: 'line',
                                                            data: {
                                                                labels: [<?php echo $date; ?>],
                                                                datasets: [{
                                                                        label: 'Temperature',
                                                                        data: [<?php echo $DHTtemp; ?>],
                                                                        backgroundColor: ['rgba(0, 0, 0, 0)'],
                                                                        borderColor: ['rgba(0,191,255,1)'],
                                                                        borderWidth: 2,
                                                                    },
                                                                    {
                                                                        label: 'Humidity',
                                                                        data: [<?php echo $DS18temp; ?>],
                                                                        backgroundColor: ['rgba(0, 0, 0, 0)'],
                                                                        borderColor: ['rgba(255, 159, 64, 1)'],
                                                                        borderWidth: 2
                                                                    },

                                                                    {
                                                                        label: 'Temperature_MAX',
                                                                        data: [<?php echo $t_max; ?>],
                                                                        backgroundColor: ['rgba(0, 0, 0, 0)'],
                                                                        borderColor: ['rgb(204, 41, 0)'],
                                                                        borderWidth: 2,
                                                                        pointRadius: 0
                                                                    },

                                                                    {
                                                                        label: 'Temperature_MIN',
                                                                        data: [<?php echo $t_min; ?>],
                                                                        backgroundColor: ['rgba(0, 0, 0, 0)'],
                                                                        borderColor: ['rgb(255, 51, 0)'],
                                                                        borderWidth: 2,
                                                                        pointRadius: 0
                                                                    },

                                                                    {
                                                                        label: 'Humidity_MAX',
                                                                        data: [<?php echo $s_max; ?>],
                                                                        backgroundColor: ['rgba(0, 0, 0, 0)'],
                                                                        borderColor: ['rgb(0, 82, 204)'],
                                                                        borderWidth: 2,
                                                                        pointRadius: 0
                                                                    },

                                                                    {
                                                                        label: 'Humidity_MIN',
                                                                        data: [<?php echo $s_min; ?>],
                                                                        backgroundColor: ['rgba(0, 0, 0, 0)'],
                                                                        borderColor: ['rgb(26, 117, 255)'],
                                                                        borderWidth: 2,
                                                                        pointRadius: 0
                                                                    }
                                                                ]
                                                            },

                                                            options: {
                                                                scales: {
                                                                    yAxes: [{
                                                                        ticks: {
                                                                            beginAtZero: true
                                                                        }
                                                                    }]
                                                                }
                                                            }
                                                        });
                                                    </script>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
                
            <?php } ?>
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
            $('#example').dataTable({
                "order": [
                    [0, 'desc']
                ]
            });
        });
    </script>

</body>

</html>