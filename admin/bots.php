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
                        <h1 class="m-0">Bots</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Bots</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Bots Management</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="bots_table" class="table table-hover table-striped table-bordered">
                                    <thead class="bg-gradient-navy">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Added.By</th>
                                        <th>Date.Added</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=0;
                                    $bots = $DB::getQ('bots',"bot_status='1'","*",null,"uid","ASC",null);
                                    while($b = mysqli_fetch_assoc($bots)){ ?>
                                        <tr>
                                            <td><?php echo ++$i; ?></td>
                                            <td>
                                                <?php $bot_name = str_replace([' ', '#'],['_',''], $b['bot_name']); ?>
                                                <?php if($UT::not_empty($b['bot_image_1'])){ ?>
                                                    <a href="uploads/bots/<?php echo $b['bot_image_1'] ?>" data-lightbox="<?php echo $bot_name."_set"?>" data-title="<?php echo $bot_name." Image 1 "; ?>"><img class="avatar img-circle elevation-2 m-b-5 m-r-5" src="uploads/bots/<?php echo $b['bot_image_1'] ?>" alt="<?php echo $bot_name."_IMG" ?>"></a>
                                                <?php } ?>
                                                <?php if($UT::not_empty($b['bot_image_1'])){ ?>
                                                    <a href="uploads/bots/<?php echo $b['bot_image_2'] ?>" data-lightbox="<?php echo $bot_name."_set"?>" data-title="<?php echo $bot_name." Image 1 "; ?>"><img class="avatar img-circle elevation-2 m-b-5 m-r-5" src="uploads/bots/<?php echo $b['bot_image_2'] ?>" alt="<?php echo $bot_name."_IMG" ?>"></a>
                                                <?php } ?>
                                                <?php if($UT::not_empty($b['bot_image_1'])){ ?>
                                                    <a href="uploads/bots/<?php echo $b['bot_image_3'] ?>" data-lightbox="<?php echo $bot_name."_set"?>" data-title="<?php echo $bot_name." Image 1 "; ?>"><img class="avatar img-circle elevation-2 m-b-5 m-r-5" src="uploads/bots/<?php echo $b['bot_image_3'] ?>" alt="<?php echo $bot_name."_IMG" ?>"></a>
                                                <?php } ?>
                                                <?php echo $b['bot_name'] ?>
                                            </td>
                                            <td><?php echo number_format($b['bot_price'],2) ?></td>
                                            <td><?php echo substr($b['bot_descr'], 0, 60) ?> ...</td>
                                            <td><?php echo $P->get_product_status($b['uid']) ?></td>
                                            <td><?php echo $U->get_username($b['added_by']) ?></td>
                                            <td><?php echo $b['added_date'] ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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
    <div class="modal fade" id="bots_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h4 class="modal-title">Create Bot</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                    </button>
                </div>
                <form onsubmit="return save_bot(this);">
                    <input type="hidden" id="bot_id" name="bot_id" value="0" />
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="bot_name">Bot Name</label>
                                <input type="text" class="form-control" id="bot_name" name="bot_name" placeholder="Bot Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bot_price">Price</label>
                                <input type="text" class="form-control" id="bot_price" name="bot_price" placeholder="Bot Price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bot_status">Bot Status</label>
                            <select class="js-select form-control" id="bot_status" name="bot_status">
                                <option> -- Select Bot Status -- </option>
                                <option value="1"> Active </option>
                                <option value="2"> Inactive </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bot_descr">Bot Description</label>
                            <textarea class="form-control" rows="3" name="bot_descr" id="bot_descr" placeholder="Bot Description"></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="bot_image_1">Bot Image #1</label>
                                <input accept="image/*" type="file" class="form-control bg-gradient-navy text-white" id="bot_image_1" name="bot_image_1" onchange="img_preview(this, 'bot_image_1')">
                                <div id="preview">
                                    <div class="pr-image" id="bot_image_1_pr">
                                        <img id="bot_image_1_preview" src="#" alt="BOT_IMG_1_PREVIEW" />
                                    </div>
                                    <div class="pr-details">
                                        <div class="pr-size">
                                            <span class="bot_image_1_size"></span>
                                        </div>
                                        <div class="pr-filename">
                                            <span class="bot_image_1_name"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bot_image_2">Bot Image #2</label>
                                <input accept="image/*" type="file" class="form-control bg-gradient-navy text-white" id="bot_image_2" name="bot_image_2" onchange="img_preview(this, 'bot_image_2')">
                                <div id="preview">
                                    <div class="pr-image" id="bot_image_2_pr">
                                        <img id="bot_image_2_preview" src="#" alt="BOT_IMG_2_PREVIEW" />
                                    </div>
                                    <div class="pr-details">
                                        <div class="pr-size">
                                            <span class="bot_image_2_size"></span>
                                        </div>
                                        <div class="pr-filename">
                                            <span class="bot_image_2_name"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bot_image_3">Bot Image #3</label>
                                <input accept="image/*" type="file" class="form-control bg-gradient-navy text-white" id="bot_image_3" name="bot_image_3" onchange="img_preview(this, 'bot_image_3')">
                                <div id="preview">
                                    <div class="pr-image" id="bot_image_3_pr">
                                        <img id="bot_image_3_preview" src="#" alt="BOT_IMG_3_PREVIEW" />
                                    </div>
                                    <div class="pr-details">
                                        <div class="pr-size">
                                            <span class="bot_image_3_size"></span>
                                        </div>
                                        <div class="pr-filename">
                                            <span class="bot_image_3_name"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-tb-10">
                            <div class="processing"></div>
                            <div class="feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-navy" id="submit-all">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
<!-- ./wrapper -->
<?php include 'controllers/base/js.php' ?>
<script>
    $('#bots_table').DataTable({
        dom: 'Bfrtip',
        responsive: true,/*processing: true, serverSide: true, responsive: true, lengthChange: false, autoWidth: false,
        ajax: {url: "controllers/ajax/patients_table.php", type: "POST"},*/
        buttons: [
            /*{text: '<i class=\'fas fa-sync\'></i> Refresh', className: 'btn btn-sm btn-info', action: function ( e, dt, node, config ) {dt.ajax.reload();}},*/
            {text: '<i class=\'fas fa-plus-circle\'></i> New Bot', className: 'btn btn-sm bg-gradient-navy', action: function () {$("#bots_modal").modal('toggle')}},
            {extend: 'copy', className: 'btn btn-primary'},
            {extend: 'excel', className: 'btn btn-secondary', footer: true},
        ],
    })
</script>
</body>
</html>
