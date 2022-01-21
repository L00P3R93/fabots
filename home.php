<?php require 'controllers/base/head.php' ?>
<body class="animsition">

<?php require 'controllers/base/nav.php' ?>

<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <a class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04" onclick="cart_action('empty')">
                <i class="zmdi zmdi-delete"></i>
            </a>
					
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        <div id="cart-items">
        <div class="header-cart-content flex-w js-pscroll">
                <?php
                    if(isset($_SESSION["cart_item"])){ ?>
                <ul class="header-cart-wrapitem w-full">
                <?php
                    foreach($_SESSION["cart_item"] as $it){ ?>
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="admin/uploads/bots/<?php echo $it["bot_image_1"] ?>" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    <?php echo $it["bot_name"] ?>
                                </a>

                                <span class="header-cart-item-info">
                                    <?php echo $it["quantity"] ?> x <?php echo $it["bot_price"]; ?>
                                    <button onclick="cart_action('add', '<?php echo $it['bot_id'] ?>')"><i class="zmdi zmdi-plus-box fs-25 m-l-40"></i></button>
                                    <button onclick="cart_action('minus', '<?php echo $it['bot_id'] ?>')"><i class="zmdi zmdi-minus-square fs-25 m-l-20"></i></button>
                                    <button onclick="cart_action('remove', '<?php echo $it['bot_id'] ?>')"><i class="zmdi zmdi-delete fs-25 m-l-20"></i></button>
                                </span>
                            </div>
                        </li>
                <?php   } ?>
                </ul>
                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40">
                        Total: <?php echo "Kes. ".number_format($cart->cart_total, 2); ?>
                    </div>

                    <div class="header-cart-buttons flex-w w-full">
                        <a href="checkout" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Check Out
                        </a>
                    </div>
                </div>
                <?php
                    }
                    else{ ?>
                    <ul class="header-cart-wrapitem w-full">
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <a class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                <?php //echo $order->counter; ?>
                                No Items In Cart !
                            </a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
        
    </div>
</div>

<!-- Product -->
<section class="bg0 p-t-90 p-b-130">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Bots Overview
            </h3>
        </div>

        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    All Bots
                </button>

            </div>

            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Search
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <div class="bor8 dis-flex p-l-15">
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
                </div>
            </div>
        </div>

        <div class="row isotope-grid">
            <?php
                $limit = $offset = 8;
                $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page']: 1;
                $start =  ($page - 1) * $limit;

                $bot_count = $DB::num_rows('bots',"uid>0");

                $total_pages = ceil($bot_count/$limit);
                $prev = $page - 1;
                $next = $page + 1;

                if($bot_count > 0) {
                    $bots = $DB::getQ('bots',"bot_status='1'",'*',null,'uid','ASC',"$start, $offset");
                    while($b = mysqli_fetch_assoc($bots)){ ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item watches">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="admin/uploads/bots/<?php echo $b['bot_image_1'] ?>" class="bot-pic" alt="IMG-PRODUCT">

                                    <a value='<?php echo $b['uid'] ?>' class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                        Quick View
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a value='<?php echo $b['uid'] ?>' class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 js-show-modal1">
                                            <?php echo $b['bot_name'] ?>
                                        </a>

                                        <span class="stext-105 cl3">$<?php echo number_format($b['bot_price'],2) ?></span>
                                    </div>
                                    <div class="block2-txt-child2 flex-r p-t-3">
                                    <a class=" dis-block pos-relative" onclick="cart_action('add', '<?php echo $b['uid']; ?>')">
                                        <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-2x"></i>
                                    </a>
							</div>
                                </div>
                            </div>
                        </div>
            <?php   }
                }
            ?>

        </div>
        <nav aria-label="Bots Pagination">
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
    </div>
</section>
<!-- Gallery -->
<section class="bg0 p-t-60 p-b-90" id="gallery-section">
    <div class="container">
        <div class="p-b-66">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Previous Bot Runs
            </h3>
        </div>
        <?php
        $gallery_count = $DB::num_rows('gallery',"uid>0");
        if($gallery_count > 0){ ?>
            <div class="owl-carousel owl-all">
                <?php
                $gallery = $DB::getQ('gallery',"uid>0",'*',null,"uid", 'ASC',/*"$start, $offset"*/ null);
                while($g = mysqli_fetch_assoc($gallery)){
                    $title = $g['title'];
                    $social_url = $g['url'];
                    $image_1 = $g['gallery_image_1'];
                    $image_2 = $g['gallery_image_2'];
                    $image_3 = $g['gallery_image_3'];
                    $added_by = $g['added_by']; $added_date = $g['added_date'];
                    ?>
                    <div class="p-b-40">
                        <div class="blog-item">
                            <div class="card mb-3">
                                <div class="card-img-top" id="image-gallery">
                                    <div class="tile-container">
                                        <div class="tile tile-cover" <?php echo $UT::gallery_image_front($image_1) ?>></div>
                                        <div class="tile-rows">
                                            <div class="tile-row">
                                                <div class="tile top right" <?php echo $UT::gallery_image_front($image_2) ?>></div>
                                            </div>
                                            <div class="tile-row">
                                                <div class="tile bottom right" <?php echo $UT::gallery_image_front($image_3) ?>></div>
                                            </div>
                                        </div>
                                        <!--<a class="click-target" href="#" tabindex="-1" role="heading" aria-level="3"></a>-->
                                        <a class="click-target" href="admin/uploads/gallery/<?php echo $image_1 ?>" data-lightbox="gallery_<?php //echo $title ?>" data-title="<?php echo "$title <br> By Sammy on ".date('F d, Y', strtotime($added_date)) ?>" tabindex="-1" role="heading" aria-level="3"></a>
                                        <a class="click-target" href="admin/uploads/gallery/<?php echo $image_2 ?>" data-lightbox="gallery_<?php //echo $title ?>" data-title="<?php echo "$title <br> By Sammy on ".date('F d, Y', strtotime($added_date)) ?>" tabindex="-1" role="heading" aria-level="3"></a>
                                        <a class="click-target" href="admin/uploads/gallery/<?php echo $image_3 ?>" data-lightbox="gallery_<?php //echo $title ?>" data-title="<?php echo "$title <br> By Sammy on ".date('F d, Y', strtotime($added_date)) ?>" tabindex="-1" role="heading" aria-level="3"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><a href="#"><?php echo $title ?></a></h5>
                                    <p class="card-text">
                                        <span class="m-r-3">
                                            <span class="cl5">By</span>
                                            <a href="#" target="_blank">Sammy</a>
								        </span>

                                        <span>
                                            <span class="cl5"> on <?php echo date('F d, Y', strtotime($added_date)) ?></span>
								        </span>
                                    </p>
                                    <p class="card-text"><small class="text-muted"><?php echo $UT::not($image_1)+$UT::not($image_2)+$UT::not($image_3) ?> items</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php }else{ ?>
            <div class="text-center">
                <h3>No Previous Runs Found!</h3>
            </div>
        <?php } ?>
    </div>
</section>

<?php require 'controllers/base/footer.php' ?>
