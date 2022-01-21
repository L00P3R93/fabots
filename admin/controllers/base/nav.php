<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="../" target="_blank" class="nav-link">Main</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <div class="">
                    <img src="<?php echo $UT::get_gravatar($user_email, 256, 'wavatar', 'r') ?>" class="avatar img-circle elevation-2 m-b-5 m-r-5" alt="User Image">
                    <?php echo $user_names ?>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">User Menu</span>
                <div class="dropdown-divider"></div>
                <a href="profile" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="controllers/logout.php" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary bg-gradient-navy elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
        <img src="../assets/images/bots/logo-2.png" height="35" alt="" loading="lazy" />
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dashboard" class="nav-link <?php echo $UT::selector($page, ['dashboard'], 'active') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>&nbsp;Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="bots" class="nav-link <?php echo $UT::selector($page, ['bots'], 'active') ?>">
                        <i class="nav-icon fas fa-robot"></i>
                        <p>&nbsp;Bots</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="orders" class="nav-link <?php echo $UT::selector($page, ['orders'], 'active') ?>">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>&nbsp;Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="gallery" class="nav-link <?php echo $UT::selector($page, ['gallery'], 'active') ?>">
                        <i class="nav-icon far fa-images"></i>
                        <p>&nbsp;Gallery</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="users" class="nav-link <?php echo $UT::selector($page, ['users'], 'active') ?>">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>&nbsp;Users</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>