<?php
require '../config.php';

if($_POST){
    //var_dump($_POST);
    $bot_id = $_POST['bot_id'];
    $bot_name = $UT::input_available($_POST['bot_name'])? $_POST['bot_name']: die($UT::error("Invalid Bot Name"));
    $bot_price = ($UT::input_available($_POST['bot_price']) and $_POST['bot_price'] > 0)? $_POST['bot_price']: die($UT::error("Invalid Bot Price"));
    $bot_descr = $UT::input_available($_POST['bot_descr'])? $_POST['bot_descr'] : die($UT::error("Invalid Bot Description"));
    $bot_status = ($_POST['bot_status'] > 0)? $_POST['bot_status']: die($UT::error("Invalid Bot Status"));

    //var_dump($_FILES);
    $imgs = count($_FILES); $uploaded = 0; $images = "";
    $allowed_formats = ['jpg','jpeg','png'];

    for($i=1;$i<=$imgs;$i++){
        ${'image_name_'.$i} = $UT::file_type($_FILES["bot_image_$i"]["name"], $allowed_formats)? $_FILES["bot_image_$i"]["name"]: die($UT::error("Invalid File Format:".$_FILES["bot_image_$i"]["name"].".[Allowed Formats: jpg,jpeg,png]"));
        ${'image_size_'.$i} = $_FILES["bot_image_$i"]["size"];
        ${'image_tmp_'.$i} = $_FILES["bot_image_$i"]["tmp_name"];

        $upload = $UT::upload_file(${'image_name_'.$i}, ${'image_tmp_'.$i}, "../uploads/bots/", $bot_name);
        //echo $upload;
        if($upload === 0){echo die($UT::error("Error: Uploading ".${'image_name_'.$i}));}
        else{
            $uploaded += 1;
            $images .= "$upload,";
        }
    }

    $image = explode(',',$images);
    if($bot_id > 0){
        //Updating Existing Bot
    }else{
        //Creating New Bot
        $fields = ['bot_name','bot_price','bot_descr','bot_image_1','bot_image_2','bot_image_3','bot_status','added_by','added_date'];
        $values = [$bot_name, $bot_price, $bot_descr, $image[0], $image[1], $image[2], $bot_status, $user_id, FULL_DATE];

        $insert = $DB::insert('bots', $fields, $values);
        if($insert){$proceed = 1;echo $UT::success("Success! Bot Created");}
        else{echo $UT::error("Error! Bot Not Created");}
    }
}
?>

<script>
    "<?php echo $proceed ?>" === "1"? setTimeout(()=>{reload()}, 1500): "";
</script>
