<?php
    if(isset($_GET['id_sp'])){
        $id_sp = (int)$_GET['id_sp'];
    }
    echo $id_sp;

    // thêm sản phẩm vào giỏ hàng
    add($id_sp);

    show_data($_SESSION['cart']);

    header('location:?module=cart&act=show');

?>