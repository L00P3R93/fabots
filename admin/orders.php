<?php include 'controllers/base/head.php' ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php include 'controllers/base/nav.php'?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Orders</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title flex-w flex-sb-m">
                                    <span class="mtext-103 cl2">
                                        Orders
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="list-group">
                                    <?php
                                    if($DB::num_rows('orders',"uid>0") > 0){
                                        $orders = $DB::getQ('orders',"uid>0");
                                        while($o = mysqli_fetch_assoc($orders)){ ?>
                                            <button class="list-group-item list-group-item-action" onclick="get_order('<?php echo $o['uid']; ?>')">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1"><?php echo $o['order_no']; ?></h5>
                                                    <small class="text-muted">
                                                        <?php
                                                        try {echo $UT::time_elapsed_string($o['added_date']);}
                                                        catch (Exception $e) {echo $e;} ?>
                                                    </small>
                                                </div>
                                                <p class="mb-1">$. <?php echo number_format($o['total'],2) ?></p>
                                                <small class="text-muted"><?php echo $DB::get_value('bots',"uid='$o[bot_id]'","bot_name"); ?>.</small>
                                            </button>
                                        <?php   }
                                    }else{ ?>
                                        <button class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">No Orders Yet</h5>
                                                <small></small>
                                            </div>
                                            <p class="mb-1">Create Orders -> <a target="_blank" href="../">Main</a></p>
                                            <small></small>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title flex-w flex-sb-m">
                                    <span class="mtext-103 cl2">
                                        Order Details
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="processing_area"></div>
                                <div class="feedback_area">Click On Order To View</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://fabots.snatks.me">FABOTS</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
</div>
<!-- ./wrapper -->
<?php include 'controllers/base/js.php' ?>
</body>
</html>
