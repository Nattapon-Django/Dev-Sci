<?php
include_once('header.php');

if (isset($_GET['search'])) {
    if (!empty($_GET['start_search']) && !empty($_GET['end_search'])) {

        $get_start = explode('-', $_GET['start_search']);
        $s_month = $get_start[1];
        $s_day = $get_start[2];
        $s_year = $get_start[0];
        $start_search = $s_month . '/' . $s_day . '/' . $s_year;

        $get_start = explode('-', $_GET['end_search']);
        $e_month = $get_start[1];
        $e_day = $get_start[2];
        $e_year = $get_start[0];
        $end_search = $e_month . '/' . $e_day . '/' . $e_year;

        $objdbcon =  new dbcon;
        $fetch = $objdbcon->getID_show_device_search($_GET['dv_id'], $start_search, $end_search);
    }
} else {
    $objdbcon =  new dbcon;
    $fetch = $objdbcon->getID_show_device($_GET['dv_id']);
}
?>

<script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-database.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<title>Show Device</title>
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
                        <!-- <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Realtime</h3>
                           
                            </div>
                         
                            <div class="box-body">
                                <div class="col-md-3">
                                    <div class="info-box">
                                       
                                        <span class="info-box-icon bg-orange"><i class="fa fa-calendar"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Date</span>
                                            <span id="date" class="info-box-number"></span>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                      
                                        <span class="info-box-icon bg-blue"><i class="fa fa-clock-o"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Time</span>
                                            <span id="time" class="info-box-number"></span>
                                        </div>
                                   
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                       
                                        <span class="info-box-icon bg-green"><i class="fa fa-thermometer"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Temperature</span>
                                            <span id="temperature" class="info-box-number"></span>
                                        </div>
                                   
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                    
                                        <span class="info-box-icon bg-red"><i class="fa fa-thermometer"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Humidity</span>
                                            <span id="temperature_ds18b20" class="info-box-number"></span>
                                        </div>
                                  
                                    </div>
                                </div>
                            </div>
                         
                          
                        </div> -->
                        <!-- /.box -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="box">
                            <div class="box-header with-border">
                                <button class="btn btn-warning mr-2" id="btn_search"><i class="fa fa-search" aria-hidden="true"></i> Advanced Search</button>

                                <div class="dropdown mr-3" style="display:inline;">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dashboard
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="http://localhost:1880/ui/#!/<?php echo $_GET['dv_id']; ?>?socketid=v_aDPnuiD_2zjDrzAAAF" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i> Realtime</a></li>
                                        </li>
                                        <li><a class="dropdown-item" href="report.php?dv_id=<?php echo $_GET['dv_id']; ?>"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
                                    </ul>
                                </div>
<!-- 
                                <button class="btn btn-danger"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
                                    <?php $dateNow = date("Y"); ?>
                                    <a href="report_alert.php?dv_id=<?=$_GET['dv_id'];?>&input_year=<?=$dateNow;?>&action=Search" style="color:white;text-decoration:none;">Report Alert</a>
                                </button> -->

                                <!-- <button class="btn btn-success"><i class="fa fa-download"></i>
                                    <a href="http://localhost/fridge/csv/device<?php echo $_GET['dv_id']; ?>.csv" style="color:white;text-decoration:none;">Export csv</a>
                                </button> -->

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="show_search" style="display:none;">

                                            <form action="" method="GET">
                                                <input type="hidden" name="dv_id" value="<?php echo $_GET['dv_id']; ?>">
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="Start">Start</label>
                                                        <input name="start_search" type="date" class="form-control" id="Start" required>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="End">End</label>
                                                        <input name="end_search" type="date" class="form-control" id="End" required>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="">&nbsp;</label>
                                                        <button name="search" value="ok" type="submit" class="form-control btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2>DeviceID: <?php echo $_GET['dv_id']; ?></h2>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        if (isset($_GET['search']) == 'ok') {
                                            echo "<p style='color:green'>Search results at $start_search to $end_search <a style='color:blue;text-decoration: underline;cursor: pointer;' onclick='history.back()'>Back to previous</a></p>";
                                        }
                                        ?>
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                        <th scope="col">Temperature</th>
                                                        <th scope="col">COD</th>
                                                        <th scope="col">TOC</th>
                                                        <th scope="col">SAC</th>
                                                        <th scope="col">BOD</th>
                                                        <th scope="col">Teans</th>
                                                        <th scope="col">Turbid</th>
                                                        <th scope="col">Humidity</th>
                                                        <th scope="col">bcsVolt</th>
                                                        <th scope="col">flowRate</th>
                                                        <th scope="col">Volt</th>
                                                        <th scope="col">Amp</th>
                                                        <th scope="col">Watt</th>
                                                        <th scope="col">kWh</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($row = $fetch->fetch_array()) {
                                                    ?>
                                                        <tr>
                                                            <th><?php echo $row['Date']; ?></th>
                                                            <th><?php echo $row['Time']; ?></th>
                                                            <td><?php echo $row['Temp']; ?></td>
                                                            <td><?php echo $row['COD']; ?></td>
                                                            <td><?php echo $row['TOC']; ?></td>
                                                            <td><?php echo $row['SAC']; ?></td>
                                                            <td><?php echo $row['BOD']; ?></td>
                                                            <td><?php echo $row['Trans']; ?></td>
                                                            <td><?php echo $row['Tubid']; ?></td>
                                                            <td><?php echo $row['Humi']; ?></td>
                                                            <td><?php echo $row['BcsVolt']; ?></td>
                                                            <td><?php echo $row['FlowRate']; ?></td>
                                                            <td><?php echo $row['Volt']; ?></td>
                                                            <td><?php echo $row['Amp']; ?></td>
                                                            <td><?php echo $row['Watt']; ?></td>
                                                            <td><?php echo $row['kWh']; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Location</h3>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php
                                    $obj_location = new dbcon;
                                    $Query_location = $obj_location->fetch_device_id($_GET['dv_id']);
                                    $fetch_location = $Query_location->fetch_array();
                                ?>
                                <script type="text/javascript" src="https://api.longdo.com/map/?key=0c0aaa7222430d95e44fcf93a7fe68b5"></script>
                                <script>
                                    var marker = new longdo.Marker({
                                        lon: <?=$fetch_location['dv_lon']?>,
                                        lat: <?=$fetch_location['dv_lat']?>
                                    }, {
                                        title: "<?=$fetch_location['dv_name']?>",
                                        detail: "<?=$fetch_location['dv_detail']?>"
                                    });

                                    function init() {
                                        var map = new longdo.Map({
                                            placeholder: document.getElementById('map'),
                                            zoom: 15,
                                            lastView: false,
                                            location: {
                                                lat: <?=$fetch_location['dv_lat']?>,
                                                lon: <?=$fetch_location['dv_lon']?>
                                            }

                                        });
                                        map.Layers.setBase(longdo.Layers.GRAY);
                                        map.Overlays.add(marker);
                                        map.Overlays.add(marker2);
                                    }
                                </script>
                                <div id="map" style="height:595px;"></div>
                            </div>
                            <!-- /.box-body -->
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
    
    <script src="assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script src="assets/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="assets/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="assets/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
    <script src="assets/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>

    <script>
           $(document).ready(function() {
            var table = $('#example').DataTable({
                
                buttons: ['print', 'excel', 'pdf'],
                dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
                "iDisplayLength": 10,
                "order": [
                    [0, 'desc']
                ]
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-5:eq(0)');
        });
    </script>

    <script>
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyDpwOyZxrCPETU6qiQxtSVn8D2vqhYIYAo",
            authDomain: "fridge-cute2020.firebaseapp.com",
            databaseURL: "https://fridge-cute2020.firebaseio.com",
            projectId: "fridge-cute2020",
            storageBucket: "fridge-cute2020.appspot.com",
            messagingSenderId: "744176408706",
            appId: "1:744176408706:web:753d61ccb00286ca98fc9b",
            measurementId: "G-0W8XKPHJ1Q"

        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
    </script>

    <script>
        try {
            var date_text = document.getElementById("date");
            var time_text = document.getElementById("time");
            var temperature = document.getElementById("temperature");
            var temperature_ds18b20 = document.getElementById("temperature_ds18b20");
            var options_date = {
                year: "numeric",
                month: "2-digit",
                day: "2-digit"
            }
            var export_btn = document.getElementById('export_btn');
            var export_text = document.getElementById('export_text');
            var loading_text = document.getElementById('loading_text');

            //read data from firebase and show on web page
            var reference = firebase.database().ref().child("device<?php echo $_GET['dv_id']; ?>").limitToLast(1);
            reference.on('child_added', function(snapshot2) {
                var data = snapshot2.val();
                date_text.innerHTML = new Date(data.date).toLocaleDateString('th-TH', options_date);
                time_text.innerHTML = data.time;
                temperature.innerHTML = data.temperature;
                temperature_ds18b20.innerHTML = data.temperature_ds18b20;
            });

            // var five_latest_val = firebase.database().ref().child("log_data").limitToLast(30);
            // five_latest_val.on('child_added', function(snapshot){
            //   var data_val = snapshot.val();
            //   console.log(data_val.time+" around temp is "+data_val.temperature);
            // });
        } catch (err) {
            console.log(err.message);
        }

        function export_data() {
            export_btn.disabled = true;
            export_text.style.display = 'none';
            loading_text.style.display = 'block';
            console.log('export csv file')
            // create tag <a> for open link to download file
            var link = document.createElement("a");
            link.href = 'https://us-central1-fridge-cute2020.cloudfunctions.net/exportCSV_system';
            //set the visibility hidden so it will not effect on your web-layout
            link.style = "visibility:hidden";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            export_btn.disabled = false;
            export_text.style.display = 'block';
            loading_text.style.display = 'none';
        }
    </script>

    <!-- หุบๆโผล่ๆ Advanced Search -->
    <script>
        $(document).ready(function() {
            $("#btn_search").click(function() {
                $("#show_search").toggle();
            });
        });
    </script>



</body>

</html>