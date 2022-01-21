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
                        <h1 class="m-0">Gallery</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Gallery</li>
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
                                <h3 class="card-title">
                                    Gallery Management
                                    <button class="btn btn-sm bg-gradient-navy" data-toggle="modal" data-target="#gallery_modal">
                                        <i class="fas fa-plus-circle"></i>
                                        &nbsp;New Gallery
                                    </button>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php
                                    $limit = $offset = 8;
                                    $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page']: 1;
                                    $start =  ($page - 1) * $limit;

                                    $gallery_count = $DB::num_rows('gallery',"uid>0");

                                    $total_pages = ceil($gallery_count/$limit);
                                    $prev = $page - 1;
                                    $next = $page + 1;

                                    if($gallery_count > 0){ ?>
                                        <div class="row">
                                            <?php
                                            $gallery = $DB::getQ('gallery',"uid>0",'*',null,"uid", 'ASC',"$start, $offset");
                                            while($g = mysqli_fetch_assoc($gallery)){
                                                $title = $g['title'];
                                                $social_url = $g['url'];
                                                $image_1 = $g['gallery_image_1'];
                                                $image_2 = $g['gallery_image_2'];
                                                $image_3 = $g['gallery_image_3'];
                                                $added_by = $g['added_by']; $added_date = ['added_date'];
                                                ?>
                                                <div class="col-md-3">
                                                    <div class="card mb-3">
                                                        <div class="card-img-top" id="image-gallery">
                                                            <div class="tile-container">
                                                                <div class="tile tile-cover" <?php echo $UT::gallery_image($image_1) ?>></div>
                                                                <div class="tile-rows">
                                                                    <div class="tile-row">
                                                                        <div class="tile top right" <?php echo $UT::gallery_image($image_2) ?>></div>
                                                                    </div>
                                                                    <div class="tile-row">
                                                                        <div class="tile bottom right" <?php echo $UT::gallery_image($image_3) ?>></div>
                                                                    </div>
                                                                </div>
                                                                <a class="click-target" href="#" tabindex="-1" role="heading" aria-level="3"></a>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title"><a href="#"><?php echo $title ?></a></h5>
                                                            <!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
                                                            <p class="card-text"><small class="text-muted"><?php echo $UT::not($image_1)+$UT::not($image_2)+$UT::not($image_3) ?> items</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <li class="page-item <?php if($page <= 1){echo 'disabled';} ?>">
                                                    <a class="page-link" href="<?php echo ($page <= 1)?'':'?page='.$prev; ?>">Previous</a>
                                                </li>
                                                <?php for($i=1; $i<=$total_pages; $i++){ ?>
                                                    <li class="page-item <?php echo ($page == $i)? 'active':''; ?>">
                                                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                                    </li>
                                                <?php } ?>
                                                <li class="page-item <?php echo ($page >= $total_pages)?'disabled':''; ?>">
                                                    <a class="page-link" href="<?php echo ($page >= $total_pages)?'#':'?page='.$next; ?>">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                <?php }else{ ?>
                                        <div class="text-center">
                                            <h3>No Gallery Found!</h3>
                                            <p class="text-black-50">Create a gallery with maximum of 3 images</p>
                                            <button class="btn bg-gradient-navy" data-toggle="modal" data-target="#gallery_modal">
                                                <i class="far fa-images"></i> New Gallery
                                            </button>
                                        </div>
                                <?php } ?>

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
    <div class="modal fade" id="gallery_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient-navy">
                    <h4 class="modal-title">New Gallery</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                    </button>
                </div>
                <form onsubmit="return save_gallery(this);">
                    <input type="hidden" id="gallery_id" name="gallery_id" value="0" />
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="gallery_title">Gallery Title</label>
                                <input type="text" class="form-control" id="gallery_title" name="gallery_title" placeholder="Gallery Title">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="url">Social Media URL</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="Social Media URL">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gallery_status">Gallery Status</label>
                            <select class="js-select form-control" id="gallery_status" name="gallery_status">
                                <option> -- Select Gallery Status -- </option>
                                <option value="1"> Active </option>
                                <option value="2"> Inactive </option>
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="gallery_image_1">Gallery Image #1</label>
                                <input accept="image/*" type="file" class="form-control bg-gradient-navy text-white" id="gallery_image_1" name="gallery_image_1" onchange="img_preview(this, 'gallery_image_1')">
                                <div id="preview">
                                    <div class="pr-image" id="gallery_image_1_pr">
                                        <img id="gallery_image_1_preview" src="#" alt="GALLERY_IMG_1_PREVIEW" />
                                    </div>
                                    <div class="pr-details">
                                        <div class="pr-size">
                                            <span class="gallery_image_1_size"></span>
                                        </div>
                                        <div class="pr-filename">
                                            <span class="galery_image_1_name"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gallery_image_2">Gallery Image #2</label>
                                <input accept="image/*" type="file" class="form-control bg-gradient-navy text-white" id="gallery_image_2" name="gallery_image_2" onchange="img_preview(this, 'gallery_image_2')">
                                <div id="preview">
                                    <div class="pr-image" id="gallery_image_2_pr">
                                        <img id="gallery_image_2_preview" src="#" alt="GALLERY_IMG_2_PREVIEW" />
                                    </div>
                                    <div class="pr-details">
                                        <div class="pr-size">
                                            <span class="gallery_image_2_size"></span>
                                        </div>
                                        <div class="pr-filename">
                                            <span class="gallery_image_2_name"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gallery_image_3">Gallery Image #3</label>
                                <input accept="image/*" type="file" class="form-control bg-gradient-navy text-white" id="gallery_image_3" name="gallery_image_3" onchange="img_preview(this, 'gallery_image_3')">
                                <div id="preview">
                                    <div class="pr-image" id="gallery_image_3_pr">
                                        <img id="gallery_image_3_preview" src="#" alt="GALLERY_IMG_3_PREVIEW" />
                                    </div>
                                    <div class="pr-details">
                                        <div class="pr-size">
                                            <span class="gallery_image_3_size"></span>
                                        </div>
                                        <div class="pr-filename">
                                            <span class="gallery_image_3_name"></span>
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
</body>
</html>
