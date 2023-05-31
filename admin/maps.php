<?php include('header.php'); ?>
<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
</head>

<body class="skin-blue" onload="init();">

  <div class="wrapper">

    <!-- Main Header -->
    <?php include('navbar.php') ?>

    <!-- Left side column. contains the logo and sidebar -->
    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <b><i class="fa fa-map-marker" aria-hidden="true"></i> Maps</b>
          <!-- <small>Optional description</small> -->
        </h1>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Location of all devices</h3>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">


                <script type="text/javascript" src="https://api.longdo.com/map/?key=0c0aaa7222430d95e44fcf93a7fe68b5"></script>
                <script>
                  <?php
                  $obj = new dbcon;
                  $result = $obj->fetch_device();
                  $countRow = $result->num_rows;
                  $countMk = 1;
                  while ($fetch = $result->fetch_array()) { ?>
                    var marker<?= $countMk; ?> = new longdo.Marker({
                      lon: <?= $fetch['dv_lon'] ?>,
                      lat: <?= $fetch['dv_lat'] ?>
                    }, {
                      title: "<?= $fetch['dv_name'] ?>",
                      detail: "<?= $fetch['dv_detail'] ?>"
                    });

                  <?php
                    if ($countMk == 1) {
                      $dv_lat_1 = $fetch['dv_lat'];
                      $dv_lon_1 = $fetch['dv_lon'];
                    }
                    $countMk++;
                  }
                  ?>

                  function init() {
                    var map = new longdo.Map({
                      placeholder: document.getElementById('map'),
                      zoom: 15,
                      lastView: false,
                      location: {
                        lat: <?= $dv_lat_1; ?>,
                        lon: <?= $dv_lon_1; ?>
                      }

                    });
                    map.Layers.setBase(longdo.Layers.GRAY);
                    <?php
                    for ($ii = 1; $ii <= $countRow; $ii++) {
                    ?>
                      map.Overlays.add(marker<?= $ii; ?>);
                    <?php } ?>

                  }
                </script>
                <div id="map" style="height:680px;"></div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">

              </div>
              <!-- box-footer -->
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