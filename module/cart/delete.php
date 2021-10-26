<?php

    if(isset($_GET['id_cart'])){
        $id_cart = (int)$_GET['id_cart'];
    }

    delete_cart($id_cart);

    echo $id_cart;

    header('location:?module=cart&act=show');

?>