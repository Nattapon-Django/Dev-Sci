<?php include('header.php'); ?>
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
            <section class="content-header">
                <h1>
                    <b>Page Header</b>
                    <small>Optional description</small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content container-fluid">
                <div class="row">
                    <div class="col-md-6">
                    
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