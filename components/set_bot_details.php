<?php
require '../admin/config.php';
if($_POST){  
    $bot_id = $_POST['bot_id'];
    $b = $DB::get('bots',"uid='$bot_id'");
    //var_dump($bot);
?>
<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
    <button class="how-pos3 hov3 trans-04 js-hide-modal1">
        <img src="assets/images/icons/icon-close.png" alt="CLOSE">
    </button>
    
    <div class="row">
        <div class="col-md-6 col-lg-7 p-b-30">
            <div class="p-l-25 p-r-30 p-lr-0-lg">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="wrap-slick3-dots"></div>
                    <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                    <div class="slick3 gallery-lb">
                        <div class="item-slick3" data-thumb="admin/uploads/bots/<?php echo $b['bot_image_1'] ?>">
                            <div class="wrap-pic-w pos-relative">
                                <img src="admin/uploads/bots/<?php echo $b['bot_image_1'] ?>" alt="IMG-PRODUCT">

                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="admin/uploads/bots/<?php echo $b['bot_image_1'] ?>">
                                    <i class="fa fa-expand"></i>
                                </a>
                            </div>
                        </div>

                        <div class="item-slick3" data-thumb="admin/uploads/bots/<?php echo $b['bot_image_2'] ?>">
                            <div class="wrap-pic-w pos-relative">
                                <img src="admin/uploads/bots/<?php echo $b['bot_image_2'] ?>" alt="IMG-PRODUCT">

                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="admin/uploads/bots/<?php echo $b['bot_image_2'] ?>">
                                    <i class="fa fa-expand"></i>
                                </a>
                            </div>
                        </div>

                        <div class="item-slick3" data-thumb="admin/uploads/bots/<?php echo $b['bot_image_3'] ?>">
                            <div class="wrap-pic-w pos-relative">
                                <img src="admin/uploads/bots/<?php echo $b['bot_image_3'] ?>" alt="IMG-PRODUCT">

                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="admin/uploads/bots/<?php echo $b['bot_image_3'] ?>">
                                    <i class="fa fa-expand"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5 p-b-30">
            <div class="p-r-50 p-t-5 p-lr-0-lg">
                <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                    <?php echo $b['bot_name'] ?>
                </h4>

                <span class="mtext-106 cl2">
                        $<?php echo number_format($b['bot_price'], 2) ?>
                    </span>

                <p class="stext-102 cl3 p-t-23">
                    <?php echo $b['bot_descr'] ?>
                </p>

                <!--  -->
                <div class="p-t-33">
                    <div class="flex-w flex-r-m p-b-10">
                        <div class="size-204 flex-w flex-m respon6-next">
                            <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" onclick="cart_action('add', '<?php echo $b['uid']; ?>')">
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>

                <!--  -->
                <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                    
                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Instagram">
                        <i class="fa fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>
<script src="assets/vendor/slick/slick.min.js"></script>
<script src="assets/js/slick-custom.js"></script>
<script src="assets/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled:true
            },
            mainClass: 'mfp-fade'
        });
    });

    $('.js-hide-modal1').on('click',function(){
        $('.js-modal1').removeClass('show-modal1');
    });

</script>
