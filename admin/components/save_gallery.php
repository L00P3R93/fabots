<?php
require '../config.php';

if($_POST){
    //var_dump($_POST);
    $gallery_id = $_POST['gallery_id'];
    $gallery_title = $UT::input_available($_POST['gallery_title'])? $_POST['gallery_title']: die($UT::error("Invalid Gallery Title"));
    /*$url = ($UT::input_available($_POST['url']) and $UT::is_url($_POST['url']))? $_POST['url']: die($UT::error("Invalid URL"));*/
    $url = $_POST['url'];
    $gallery_status = ($_POST['gallery_status'] > 0)? $_POST['gallery_status']: die($UT::error("Invalid Gallery Status"));

    //var_dump($_FILES);
    $imgs = count($_FILES); $uploaded = 0; $images = "";
    $allowed_formats = ['jpg','jpeg','png'];

    for($i=1;$i<=$imgs;$i++){
        ${'image_name_'.$i} = $UT::file_type($_FILES["gallery_image_$i"]["name"], $allowed_formats)? $_FILES["gallery_image_$i"]["name"]: die($UT::error("Invalid File Format:".$_FILES["gallery_image_$i"]["name"].".[Allowed Formats: jpg,jpeg,png]"));
        ${'image_size_'.$i} = $_FILES["gallery_image_$i"]["size"];
        ${'image_tmp_'.$i} = $_FILES["gallery_image_$i"]["tmp_name"];

        $upload = $UT::upload_file(${'image_name_'.$i}, ${'image_tmp_'.$i}, "../uploads/gallery/", $gallery_title);
        //echo $upload;
        if($upload === 0){echo die($UT::error("Error: Uploading ".${'image_name_'.$i}));}
        else{
            $uploaded += 1;
            $images .= "$upload,";
        }
    }

    $image = explode(',',$images);
    if($gallery_id > 0){
        //Updating Existing Gallery
    }else{
        //Creating New Gallery
        $fields = ['title','url','gallery_image_1','gallery_image_2','gallery_image_3','status','added_by','added_date'];
        $values = [$gallery_title, $url, $image[0], $image[1], $image[2], $gallery_status, $user_id, FULL_DATE];

        $insert = $DB::insert('gallery', $fields, $values);
        if($insert){$proceed = 1;echo $UT::success("Success! Gallery Created");}
        else{echo $UT::error("Error! Gallery Not Created");}
    }
}
?>

<script>
    "<?php echo $proceed ?>" === "1"? setTimeout(()=>{reload()}, 1500): "";
</script>
