<?php
     require '../../../config/db.php';

    if(!empty($_POST['text'])){

        $text = $_POST['text'];
        $sql = mysqli_query($conn , "SELECT * FROM `product` WHERE `name` LIKE '%$text%' ORDER BY `id_product` DESC ");

        $output = '';
        $output .= '<ul>';
        if(mysqli_num_rows($sql) > 0){
            while ($row = mysqli_fetch_array($sql)){
                $output .= '<li class="list-history-item">';
                    $output .= '<a href="#" class="list-history-item-link">'.$row['name'].'</a>';
                $output .= '</li>';
            }
        }
    
        else{
            $output .= '<li class="list-history-item">';
                $output .= '<a href="#" class="list-history-item-link text-center">Không tìm thấy kết quả nào !</a>';
            $output .= '</li>';
        }
        $output .= '</ul>';
        echo $output;

    }


?>