<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require 'config.php';
    include 'components/session-check.php';
    include 'controllers/base/meta.php'
    ?>
    <title> <?php echo $UT::uni_name(isset($page)?$page:"Home"); ?>  | Admin - FABOTS</title>
    <?php include 'controllers/base/css.php' ?>
</head>