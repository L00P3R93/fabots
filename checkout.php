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
                        <button class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10 js-show-modal1">
                            Check Out
                        </button>
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

<!-- Shoping Cart -->
<section class="bg0 p-t-100 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <?php
                        if(isset($_SESSION["cart_item"])){ ?>
                        <div class="row cart">
                    <?php
                        foreach($_SESSION["cart_item"] as $it){ ?>
                            <div class="card mb-3 col-md-12">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img class="final_cart_img" src="admin/uploads/bots/<?php echo $it["bot_image_1"] ?>" alt="IMG">   
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $it["bot_name"] ?></h5>
                                            <p class="card-text"><?php echo $it["quantity"] ?> x $ <?php echo number_format($it["bot_price"],2); ?></p>
                                            <p class="card-text">
                                                $ <?php echo number_format($it["quantity"]*$it["bot_price"],2); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php   } ?>
                        </div>
                    <?php
                        }
                        else{ ?>
                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                <a class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    <?php //echo $order->counter; ?>
                                    No Items In Cart !
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                <?php echo "$ ".number_format($cart->cart_total, 2); ?>
                            </span>
                        </div>
                    </div>

                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'controllers/base/footer.php' ?>
