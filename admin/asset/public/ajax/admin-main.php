<?php

    require '../../../../config/db.php';
    
    if(isset($_POST['listCheck'])){
        $listCheck = $_POST['listCheck'];

       // tách mảng ra 
       $idCheckbox = implode($listCheck , ',');

       // echo $idCheckbox;

       // cập nhật lại giá trị ( nghĩa là xóa tạm thời )
       $sql = "UPDATE `order` SET `is_delete` = 1 WHERE `id_order` IN ({$idCheckbox}) ";

        if(mysqli_query($conn,$sql)){
            echo 1;
        }
        else{
            echo 0;
        }
    }


    // xử lý tìm kiếm 
    if(isset($_POST['input'])){ 
        $keywork = $_POST['input'];

        // echo $keywork;

        $sql = mysqli_query($conn , "SELECT * FROM `order` WHERE `code_sp` LIKE '%$keywork%' ORDER BY `id_order` DESC ");
        $output = '';
        $stt = 1;
        if(mysqli_num_rows($sql) > 0){
            while($row = mysqli_fetch_array($sql)){
                $output .= '<tr class="text-center">';
                $output .= '<td>';
                $output .= '<input type="checkbox" name="check_list[]" value="'.$row['id_order'].'">';
                $output .= ' </td> ';
                $output .= '<th scope="row">'.$stt++.'</th>';
                $output .= '<td>'.$row['code_sp'].'</td>';
                $output .= ' <td>'.$row['name_sp'].'</td>';
                $output .= ' <td>'.$row['price_sp'].'</td>';
                $output .= '<td>'.$row['qty_sp'].'</td>';
                $output .= ' <td>'.$row['total_sp'].'</td>';
                $output .= ' <td>'.$row['created_at'].'</td>';
                $output .= '<td>'.$row['updated_at'].'</td>';
                $output .= ' <td>';
                $output .= '<a href="?module=order&act=delete&id_order='.$row['id_order'].'" class="btn-delete btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit">xóa</i></a>';
                $output .= '<a href="?module=order&act=update&id_order='.$row['id_order'].'" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="update"><i class="fa fa-trash">update</i></a>';
                $output .= '   </td>';
                $output .= ' </tr>';
            }
        }   
        echo $output;
    }



    // xử lý xóa khi click button delete
    if(isset($_POST['idDelete'])){
        $idDelete = $_POST['idDelete'];
        $sql = mysqli_query($conn , "UPDATE `order` SET `is_delete` = 1 WHERE `id_order` = '{$idDelete}' ");
    }



    // xuất danh sách load 




?>