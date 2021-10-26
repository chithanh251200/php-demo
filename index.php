<?php
    session_start();
?>

<?php
    require 'config/db.php';
    require 'lib/get_layouts.php';
    require 'helper/show_data.php';

    // giỏ hàng 
    require 'lib/get_cart.php';
?>


<?php

    $module = !empty($_GET['module']) ? $_GET['module'] : 'home';
    $act = !empty($_GET['act']) ? $_GET['act'] : 'home';

    $path = "module/{$module}/{$act}.php";

    // kiểm tra đường dẫn có tồn tại không 
    if(file_exists($path)){
        require $path;
    }else{
        require 'layout/404.php';
    }



?>

