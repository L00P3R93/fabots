<?php
require '../config.php';

if($_POST){
    //var_dump($_POST);
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if($DB::num_rows('users',"email='$user_name' OR user_name = '$user_name'") > 0){
        $user = $DB::get('users',"email='$user_name' OR user_name = '$user_name'");
        $db_password = $user['password'];
        $user_id = $user['uid'];
        if(password_verify($password, $db_password)){
            $_SESSION['bots_'] = $UT::encurl($user_id);
            $proceed = 1;
            echo $UT::success("Sign In Successful!");
        }else{
            echo $UT::error("Invalid Details!");
        }
    }else{
        echo $UT::error("Email Address/Username Not Found");
    }
}
?>

<script>
    "<?php echo $proceed ?>" === "1" ? setTimeout(()=>{redirect('dashboard')}, 1000):"";
</script>
