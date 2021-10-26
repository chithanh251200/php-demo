<?php
    $id_cat_product = $_GET['id_product_cat'];
    
    if(!empty($id_cat_product)){
        $sql = mysqli_query($conn , "UPDATE `cat_product` SET `is_delete` = 1 WHERE `id_cat` = '{$id_cat_product}' ");
        header('location:?module=product_cat&act=list');
    }
?>