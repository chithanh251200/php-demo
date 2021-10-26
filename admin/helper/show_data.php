<?php
    function show_data($data){
        if(is_array($data)){
            echo"<pre>";
            print_r($data);
            echo"</pre>";
        }else{
            echo "không tồn dữ liệu";
        }
    }
?>