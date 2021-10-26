<?php
    $id_product = $_GET['id_product'];
    
    if(!empty($id_product)){
        $sql = mysqli_query($conn , "UPDATE `product` SET `is_delete` = 1 WHERE `id_cat` = '{$id_product}' ");
        header('location:?module=product&act=list');
    }
?>