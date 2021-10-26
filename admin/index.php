<?php
    require '../config/db.php';
    require 'lib/get_layouts.php';
    require 'helper/show_data.php';
    require 'lib/padding.php';
?>
<?php
    ob_start();
    session_start();

     // nếu không tồn tại $_SESSION -> is_login thì mặc định vào thì là trang login
     if(empty($_SESSION['is_login'])){
        header('location:login.php');
    }
?>

<?php

    $module = !empty($_GET['module']) ? $_GET['module'] : 'order';
    $act = !empty($_GET['act']) ? $_GET['act'] : 'list';

    $path = "module/{$module}/{$act}.php";

    if(file_exists($path)){
        require $path;
    }

   


?>

