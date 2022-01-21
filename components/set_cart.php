<?php 
require '../admin/config.php';

if($_POST){
    switch ($_POST['action']){
        case "add":
            $cart->add_to_cart();
            break;
        case "minus":
            $cart->minus_from_cart();
            break;
        case "add_customer":
            $cart->add_customer_to_cart();
            break;
        case "remove":
            $cart->remove_from_cart();
            break;
        case "remove_customer":
            $cart->remove_customer_from_cart();
            break;
        case "empty":
            $cart->empty_cart();
            break;
    }
}
?>

<div class="header-cart-content flex-w js-pscroll">

    <?php
        if(isset($_SESSION["cart_item"])){ ?>
        <ul class="header-cart-wrapitem w-full">
    <?php
            foreach($_SESSION["cart_item"] as $it){ ?>
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img" onclick="cart_action('remove', '<?php echo $it['bot_id'] ?>')">
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
                        No Items In Cart !
                    </a>
                </li>
            </ul>
    <?php
        } ?>

</div>