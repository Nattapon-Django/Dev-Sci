

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <!-- <img src="img/mawnam.jpg" class="img-circle" alt="User Image"> -->
                <i class="fa fa-user" style="font-size:50px; padding:0px; margin:0px; color: white" aria-hidden="true"></i>
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['sess_u_user']; ?></p>
                <!-- Status -->
                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
                <a href="#"><span class="label label-danger" style="font-size:12px;">Role: <?php echo $_SESSION['sess_u_type']; ?></span></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active1"><a href="index.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i> <span>User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="user_show.php"><i class="fa fa-circle-o"></i> User list</a></li>
                    <li><a href="user_add.php"><i class="fa fa-circle-o"></i> Add User</a></li>
                </ul>
            </li>
            <li><a href="maps.php"><i class="fa fa-map-marker" aria-hidden="true"></i> <span>Maps</span></a></li>
            <li><a href="profile_edit.php"><i class="fa fa-link"></i> <span>Settings</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->

    </section>
    <!-- /.sidebar -->

</aside>