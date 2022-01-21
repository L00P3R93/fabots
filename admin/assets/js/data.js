let processing_message = 'Working ...';
let processing_area = '.processing';
let processing_area_ = '.processing_';
let ico = `<img src="assets/img/loader.gif" title="${processing_message}" height="22px" alt="IMG_LOADER" />`

let redirect = (url) => window.location = url

let reload = () => location.reload()

let formatBytes = (bytes, decimals = 2) =>{
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

let load_page = (action_page, params, feedback_area = '.preview', processing_area = '.processing') => {
    $.ajax({
        method: 'GET',
        url: action_page,
        data: params,
        beforeSend: function () {
            $(processing_area).html(ico + processing_message);
            $(processing_area).show();
        },
        complete: function () {
            $('#processing').hide();
            $(processing_area).hide();
        },
        success: function (feedback) {
            $(feedback_area).html(feedback);
            $(processing_area).hide();
        }
    });
}

let _post = (action_page, params, feedback = '.feedback', processing = '.processing') => {
    $.ajax({
        method: "POST",
        url: action_page,
        data:params,
        cache: false,
        beforeSend:  () => {
            $(processing).html(ico + processing_message);
            $(processing).show();
        },
        success:  (response) => {
            $(feedback).html(response)
            $(processing).show()
        },
        complete: () => {$(processing).hide();},
        error: () => {
            $(feedback).html('Oops! Something went wrong...');
            $(processing).show();
        }
    })
}

let post_it = (action_page, params, feedback_area='.feedback', processing_area = '.processing', processing_message=' Processing') => {
    $.ajax({
        method: 'POST',
        url: action_page,
        data: params,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend:  () => {
            $(processing_area).html(ico + processing_message);
            $(processing_area).show();
        },
        success:  (response) => {
            $(feedback_area).html(response)
            $(processing_area).show()
        },
        complete: () => {$(processing_area).hide();},
        error: () => {
            $(feedback_area).html('Oops! Something went wrong...');
            $(processing_area).show();
        }
    })
}


let cart_post = (action_page, params, feedback_area='#cart_items') => {
    $.ajax({
        method: 'POST',
        url: action_page,
        data: params,
        success:  (response) => {$(feedback_area).html(response); swal("Bot", "added to cart !", "success"); $('.js-modal1').removeClass('show-modal1');},
        error: () => {$(feedback_area).html('Oops! Something went wrong...');}
    })
}

let cart_action = (action, product_id) => {
    let params = "";
    if(action !== ""){
        switch(action){
            case "add":
                params = `action=${action}&product_id=${product_id}&quantity=1`;
                break;
            case "minus":
                params = `action=${action}&product_id=${product_id}&quantity=1`;
                break;
            case "add_customer":
                params = `action=${action}&customer_id=${product_id}`;
                break;
            case "remove":
                params = `action=${action}&product_id=${product_id}`;
                break;
            case "remove_customer":
                params = `action=${action}&customer_id=${product_id}`;
                break;
            case "empty":
                params = `action=${action}`;
                break;
        }
    }
    console.log(params);
    cart_post('components/set_cart.php',params,"#cart-items");
}


let overlay_show = (div_id, params, resource) => {
    $(div_id).modal('toggle');
    load_page(resource, params,div_id + 'in', );
}

let save_bot = (form) => {
    let form_data = new FormData(form)
    console.log(form_data);
    post_it('components/save_bot.php', form_data)
    return false;
}

let save_gallery = (form) => {
    let form_data = new FormData(form)
    post_it('components/save_gallery.php', form_data)
    return false;
}

let get_order = (order_id) => {
    post_it('components/get_order.php', `order_id=${order_id}`)
}

