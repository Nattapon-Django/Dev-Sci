<?php include('header.php'); ?>
<?php

$monthList = [
  '1' => 'January',
  '2' => 'February',
  '3' => 'March',
  '4' => 'April',
  '5' => 'May',
  '6' => 'June',
  '7' => 'July',
  '2' => 'August',
  '9' => 'September',
  '0' => 'October',
  '11' => 'November',
  '12' => 'December'
];

?>
<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
</head>

<body class="skin-yellow">

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
          <div class="col-md-8">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Report Alert</h3>
                <div class="box-tools pull-right">
                  <span class="label label-success"><a href="device_show.php?dv_id=<?= $_GET['dv_id']; ?>" class="btn-success">Back</a></span>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="alert alert-success">
                      <strong>Result: </strong> <?php echo $monthList[$_GET['month']].' '.$_GET['year']; ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <?php
                    $obj = new dbcon;
                    $result = $obj->QueryAlertReportAlertPageDetail($_GET['dv_id'], $_GET['month'], $_GET['year']);
                    if ($result->num_rows <= 0) {
                      echo "
                        <div class='jumbotron'>
                          <h2 class='display-4 text-center'>Not found data</h2>
                        </div>
                        ";
                    } else {
                    ?>
                      <table class="table table-hover" id="example">
                      <thead>
                          <tr class="info">
                            <th>Data</th>
                            <th>Value Temp</th>
                            <th>Type</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          while ($row = $result->fetch_array()) {
                          ?>
                            <tr>
                              <td><?= $row['alert_date'] . ' ' . $row['alert_time']; ?></td>
                              <td>
                                <?php if ($row['alert_temptype'] == 'min') {
                                  echo "<span class='text-primary'>is below set</span>";
                                } else {
                                  echo "<span class='text-danger'>is over set</span>";
                                }

                                echo ' ' . $row['alert_data'] . '°C';
                                ?>
                              </td>
                              <!-- <td><?= $row['alert_tempname']; ?></td> -->
                              <td>
                                <?php if ($row['alert_tempname'] == 'Shelf Temp') {
                                  echo "<span class='text-primary'>Temperature</span>";
                                } else {
                                  echo "<span class='text-danger'>Humidity</span>";
                                }

                                // echo ' ' . $row['alert_data'] . '°C';
                                ?>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    <?php } ?>
                  </div>
                </div>
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