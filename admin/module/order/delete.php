<?php
    $id_order = (int)$_GET['id_order'];
    
    if(!empty($id_order)){
        $sql = mysqli_query($conn , "UPDATE `order` SET `is_delete` = 1 WHERE `id_order` = '{$id_order}' ");
        header('location:?module=order&act=list');
    }
?>