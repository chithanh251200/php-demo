<?php

    if(isset($_POST['btn-update'])){
        
        if(isset($_POST['qty'])){
            $qty = $_POST['qty'];
        }

        update_qty($qty);

        // show_data($qty);

        header('location:?module=cart&act=show');
    }


?>