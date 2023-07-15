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
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
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

                                                    <div class="form-group col-md-2">
                                                        <label for="date">Type </label>
                                                        <select class="form-control" aria-label="Default select example" name="type">
                                                            <option value="all" <?php if (isset($_GET['type']) && $_GET['type'] == 'all') echo 'selected'; ?>>-- All --</option>
                                                            <option value="Temp" <?php if (isset($_GET['type']) && $_GET['type'] == 'Temp') echo 'selected'; ?>>Temp</option>
                                                            <option value="COD" <?php if (isset($_GET['type']) && $_GET['type'] == 'COD') echo 'selected'; ?>>COD</option>
                                                            <option value="TOC" <?php if (isset($_GET['type']) && $_GET['type'] == 'TOC') echo 'selected'; ?>>TOC</option>
                                                            <option value="SAC" <?php if (isset($_GET['type']) && $_GET['type'] == 'SAC') echo 'selected'; ?>>SAC</option>
                                                            <option value="BOD" <?php if (isset($_GET['type']) && $_GET['type'] == 'BOD') echo 'selected'; ?>>BOD</option>
                                                            <option value="Trans" <?php if (isset($_GET['type']) && $_GET['type'] == 'Trans') echo 'selected'; ?>>Trans</option>
                                                            <option value="Turbid" <?php if (isset($_GET['type']) && $_GET['type'] == 'Turbid') echo 'selected'; ?>>Turbid</option>
                                                            <option value="Humi" <?php if (isset($_GET['type']) && $_GET['type'] == 'Humi') echo 'selected'; ?>>Humi</option>
                                                            <option value="FlowRate" <?php if (isset($_GET['type']) && $_GET['type'] == 'FlowRate') echo 'selected'; ?>>FlowRate</option>
                                                            <option value="bcsVolt" <?php if (isset($_GET['type']) && $_GET['type'] == 'bcsVolt') echo 'selected'; ?>>bcsVolt</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="date">Date</label>
                                                        <input name="search_date_start" type="date" class="form-control" id="date" <?php if (!empty($_GET['search_date_start'])) {
                                                                                                                                        echo 'value=' . $_GET['search_date_start'];
                                                                                                                                    } ?> required>
                                                    </div>



                                                    <div class="form-group col-md-2">
                                                        <label for="Start">Time Start</label>
                                                        <input name="time_start_search" type="time" class="form-control" id="Start" <?php if (!empty($_GET['time_start_search'])) {
                                                                                                                                        echo 'value=' . $_GET['time_start_search'];
                                                                                                                                    } else {
                                                                                                                                        echo 'value=00:00';
                                                                                                                                    } ?> required>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="End">Time End</label>
                                                        <input name="time_end_search" type="time" class="form-control" id="End" <?php if (!empty($_GET['time_end_search'])) {
                                                                                                                                    echo 'value=' . $_GET['time_end_search'];
                                                                                                                                } else {
                                                                                                                                    echo 'value=23:59';
                                                                                                                                } ?> required>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label for="">&nbsp;</label>
                                                        <button name="search" value="ok" type="submit" class="form-control btn btn-info"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                                    </div>

                                                </div>
                                            </form>

                                        </div> 
                                    </div>
                                </div>

                                <?php
                                if (isset($_GET['search']) == 'ok') {
                                    $date_search_start = convertDateQueryToSQL($_GET['search_date_start']);

                                    $get_graph_all = $obj_dbcon->get_graph_all($_GET['dv_id'], $date_search_start, $_GET['time_start_search'], $_GET['time_end_search']);
                                    $typeLists = ['Temp', 'COD', 'TOC', 'SAC', 'BOD', 'Trans', 'Turbid', 'Humi', 'FlowRate', 'bcsVolt'];
                                    $types = [];

                                    while ($dataSet = $get_graph_all->fetch_array()) {
                                        foreach ($typeLists as $typeList) {
                                            if (isset($dataSet[$typeList])) {
                                                $types[$typeList][] = [
                                                    'date' => $dataSet['Date'],
                                                    'time' => $dataSet['Time'],
                                                    'value' => $dataSet[$typeList]
                                                ];
                                            }
                                        }
                                    }

                                    foreach ($types as $type => $data) {
                                        $values = [];
                                        foreach ($data as $entry) {
                                            $values[] = $entry['value'];
                                        }
                                        $minMaxAvg[$type]['min'] = min($values);
                                        $minMaxAvg[$type]['max'] = max($values);
                                        $minMaxAvg[$type]['avg'] = array_sum($values) / count($values);
                                    }

                                    $chartData = [];
                                    foreach ($types as $type => $data) {
                                        $timeData = [];
                                        $valueData = [];
                                        foreach ($data as $entry) {
                                            $timeData[] = $entry['time'];
                                            $valueData[] = $entry['value'];
                                        }
                                        $chartData[$type] = [
                                            'time' => $timeData,
                                            'value' => $valueData
                                        ];
                                    }
                                ?>
                                    <?php if ($_GET['type'] == "all") { ?>
                                        <?php if (empty($chartData)) { ?>
                                            <div class="col-12">
                                                <div class="alert alert-danger" role="alert">
                                                    <b>Results</b> from <?= $_GET['search_date_start'] ?> time <?= $_GET['time_start_search'] ?> to <?= $_GET['time_end_search'] ?>
                                                </div>
                                                <div class="jumbotron jumbotron-fluid">
                                                    <div class="container">
                                                        <h5 class="display-9 text-center">No data found</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php exit; } ?>
                                        <div class="alert alert-success" role="alert">
                                            <b>Results</b> from <?= $_GET['search_date_start'] ?> time <?= $_GET['time_start_search'] ?> to <?= $_GET['time_end_search'] ?>
                                        </div>
                                        <?php foreach ($typeLists as $typeList) { ?>
                                            <div class="col-md-6">
                                                <canvas id="myChart_<?php echo $typeList; ?>"></canvas>
                                                <br>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col"><b>Minimum value</b></span></th>
                                                                    <th scope="col"><b>Maximum value</b></span></th>
                                                                    <th scope="col"><b>Average</b></span></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="info"><?php echo $minMaxAvg[$typeList]['min']; ?></td>
                                                                    <td class="danger"><?php echo $minMaxAvg[$typeList]['max']; ?></td>
                                                                    <td class="warning"><?php echo number_format($minMaxAvg[$typeList]['avg'], 2); ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                var ctx = document.getElementById("myChart_<?php echo $typeList; ?>").getContext('2d');
                                                var myChart = new Chart(ctx, {
                                                    type: 'line',
                                                    data: {
                                                        labels: <?php echo json_encode($chartData[$typeList]['time']); ?>,
                                                        datasets: [{
                                                            label: '<?php echo $typeList; ?>',
                                                            data: <?php echo json_encode($chartData[$typeList]['value']); ?>,
                                                            backgroundColor: ['rgba(0, 0, 0, 0)'],
                                                            borderColor: ['rgba(0,191,255,1)'],
                                                            borderWidth: 1,
                                                        }]
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
                                        <?php } ?>
                                        <?php } else {

                                        $selectedType = $_GET['type'];
                                        if (isset($chartData[$selectedType])) {
                                            $timeData = $chartData[$selectedType]['time'];
                                            $valueData = $chartData[$selectedType]['value'];
                                            $minValue = $minMaxAvg[$selectedType]['min'];
                                            $maxValue = $minMaxAvg[$selectedType]['max'];
                                            $avgValue = $minMaxAvg[$selectedType]['avg'];
                                        ?>

                                            <div class="col-md-12">
                                                <div class="alert alert-success" role="alert">
                                                    <b>Results</b> from <?= $_GET['search_date_start'] ?> time <?= $_GET['time_start_search'] ?> to <?= $_GET['time_end_search'] ?>
                                                </div>
                                                <p class="mt-3">Total <?= $get_graph_all->num_rows; ?> items</p>
                                                <div class="col-md-12">
                                                    <canvas id="myChart"></canvas><br>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col"><b>Minimum value</b></th>
                                                                        <th scope="col"><b>Maximum value</b></th>
                                                                        <th scope="col"><b>Average</b></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="info"><?php echo $minValue; ?></td>
                                                                        <td class="danger"><?php echo $maxValue; ?></td>
                                                                        <td class="warning"><?php echo number_format($avgValue, 2); ?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    var ctx = document.getElementById("myChart").getContext('2d');
                                                    var myChart = new Chart(ctx, {
                                                        type: 'line',
                                                        data: {
                                                            labels: <?php echo json_encode($timeData); ?>,
                                                            datasets: [{
                                                                label: '<?php echo $selectedType; ?>',
                                                                data: <?php echo json_encode($valueData); ?>,
                                                                backgroundColor: ['rgba(0, 0, 0, 0)'],
                                                                borderColor: ['rgba(0,191,255,1)'],
                                                                borderWidth: 2,
                                                            }]
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
                                        <?php } else { ?>
                                            <div class="col-12">
                                                <div class="alert alert-danger" role="alert">
                                                    <b>Results</b> from <?= $_GET['search_date_start'] ?> time <?= $_GET['time_start_search'] ?> to <?= $_GET['time_end_search'] ?>
                                                </div>
                                                <div class="jumbotron jumbotron-fluid">
                                                    <div class="container">
                                                        <h5 class="display-9 text-center">No data found</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } //close else 
                                        ?>
                                    <?php }  //close if all 
                                    ?>
                                <?php } //close if check search = ok 
                                ?>

                            </div> <!-- close box boydy -->

                        </div>
                    </div>
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
            $('#example').dataTable({
                "order": [
                    [0, 'desc']
                ]
            });
        });
    </script>

</body>

</html>