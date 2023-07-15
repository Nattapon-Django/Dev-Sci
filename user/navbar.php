<header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="font-size: 18px;">ระบบบริหารอุปกรณ์ไอโอที</span>
    </a>
    
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" style="font-size:20px; padding:0px; margin:0px;" aria-hidden="true"></i> <?php echo $_SESSION['sess_u_user']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" id="navbar-dropdown">
                        <li><a href="profile_edit.php">Edit Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="../logout.php" id="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>