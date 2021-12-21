<?php

require '../../../config/db.php';

// xuất danh sách tỉnh 
if(isset($_POST['tinh'])){
    $tinh = $_POST['tinh'];
    $sql_tinh = mysqli_query($conn , "SELECT * FROM `provinces`");
    $output = '';
   
    $output .= '<select name="provinces" id="provinces" style="width: 100%; padding: 9px 12px; border: 1px solid #cccccc;">';
    $output .= '<option>Chọn tỉnh </option>';

    if(mysqli_num_rows($sql_tinh) > 0){
        while ($row = mysqli_fetch_array($sql_tinh)){
            $output .= '<option value="'.$row['id_provinces'].'">'.$row['name'].'</option>';     
        }
    }
    $output .= '</select>';
    
    echo $output;
}




// chọn id_provinces load danh sách huyện 
if(isset($_POST['id_provinces'])){
    $id_provinces = $_POST['id_provinces'];

    $sql = mysqli_query($conn , "SELECT * FROM `districts` WHERE `id_provinces` = '$id_provinces' ");
    $output_huyen = '';
  
    $output_huyen .= '<select name="districts" id="districts" style="width: 100%; padding: 9px 12px; border: 1px solid #cccccc;">';
    $output_huyen .= '<option>Chọn huyện</option>';
    if(mysqli_num_rows($sql) > 0){
        while ($row = mysqli_fetch_array($sql)){
            $output_huyen .= '<option value="'.$row['id_districts'].'">'.$row['name'].'</option>';     
        }
    }
    $output_huyen .= '</select>';
    echo $output_huyen;

}


// chọn id_districts load danh sách xã 
if(isset($_POST['id_districts'])){
    $id_districts = $_POST['id_districts'];

    $sql = mysqli_query($conn , "SELECT * FROM `commune` WHERE `id_districts` = '$id_districts' ");
    $output_xa = '';
  
    $output_xa .= '<select name="commune" id="commune" style="width: 100%; padding: 9px 12px; border: 1px solid #cccccc;">';
    $output_xa .= '<option>Chọn xã</option>';
    if(mysqli_num_rows($sql) > 0){
        while ($row = mysqli_fetch_array($sql)){
            $output_xa .= '<option value="'.$row['id_commune'].'">'.$row['name'].'</option>';     
        }
    }
    $output_xa .= '</select>';
    echo $output_xa;

}








?>