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
                  <span class="label label-success"><a href="device_show.php?dv_id=<?=$_GET['dv_id'];?>" class="btn-success">Back</a></span>
                </div>
              </div>
              <div class="box-body">
                <div class="row text-center" style="margin: 10px 0;">
                  <form action="">
                    <!-- <div class="col-md-2"></div> -->
                    <div class="col-md-4">
                      <select name="input_year" class="form-control" required>
                        <option value="">-- Select Year --</option>
                        <?php
                        $yearNow = date("Y");
                        $yearPlus = date("Y") + 3;
                        $yearLUB = date("Y") - 10;
                        for ($i = $yearPlus; $i >= $yearLUB; $i--) {
                        ?>
                          <option value="<?= $i ?>" <?php if ($i == $_GET['input_year']) {
                                                      echo "selected";
                                                    } ?>><?= $i ?></option>
                        <?php } ?>
                      </select>
                      <input type="hidden" name="dv_id" value="<?php echo $_GET['dv_id'] ?>">
                    </div>
                    <div class="col-md-2">
                      <input type="submit" name="action" value="Search" class="form-control btn btn-success">
                    </div>

                  </form>
                </div>
                <?php if (isset($_GET['action']) && $_GET['action'] == 'Search') { ?>
                  <br><br>
                  <div class="row">
                    <div class="col-md-12">
                      <?php
                      $obj = new dbcon;
                      $result = $obj->QueryAlertReportAlertPage($_GET['dv_id'], $_GET['input_year']);
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
                              <th>Date</th>
                              <th>Temperature</th>
                              <th>Humidity</th>
                              <th>Total</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            while ($row = $result->fetch_array()) {
                            ?>
                              <tr>
                                <td scope="row"><?php echo $row['year'] . ' ' . $monthList[$row['month']]; ?></td>
                                <td><?= $row['Shelf']; ?></td>
                                <td><?= $row['Freezer']; ?></td>
                                <td><?= $row['dataTotal']; ?></td>
                                <td><a href="report_alert_detail.php?dv_id=<?= $row['alert_dvid']; ?>&month=<?=$row['month'];?>&year=<?=$_GET['input_year'];?>" class="btn btn-sm btn-warning">View</a></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      <?php } ?>
                    </div>
                  </div>
                <?php } ?>
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
      $('#example').DataTable();
    });
  </script>

</body>

</html>