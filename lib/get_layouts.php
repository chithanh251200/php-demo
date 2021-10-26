<?php

    function get_header(){
        $path_header = 'layout/header/header.php';
        if(file_exists($path_header)){
            require $path_header;
        }
        else{
            echo "trang header không tồn tại";
        } 
    }
    function get_footer(){
        $path_footer = 'layout/footer/footer.php';
        if(file_exists($path_footer)){
            require $path_footer;
        }
        else{
            echo "trang footer không tồn tại";
        }
    }
?>