<?php

require '../../../config/db.php';

// thêm comment 
if(isset($_POST['inputText'])){
    $text = $_POST['inputText'];
    $idproduct = $_POST['idproduct'];

    $sql = mysqli_query($conn , "INSERT INTO `comment` (`parent_id_comment` , `text` , `id_kh_ac_send_text` , `id_product`) 
            VALUES ('0' , '$text' , '1' , '$idproduct')
    ");

}


if(isset($_POST['idProduct_load_comment'])){
    $idProduct_load_comment = $_POST['idProduct_load_comment'];

    $sql = mysqli_query($conn , " SELECT * FROM  `comment` LEFT JOIN `product` on `comment`.`id_product` = `product`.`id_product` WHERE `product`.`id_product` = '$idProduct_load_comment' ");
    $output = '';

    // if(mysqli_num_rows($sql) > 0){
        while ($row = mysqli_fetch_array($sql)) {
            $output .= '<div class="list-comment">';
                $output .= '<div class="list-comment-head">';
                        $output .= '<div class="list-comment-head__user">';
                            $output .= '<img src="asset/public/images/banner.png" alt="" class="list-comment-head__user-thumbnail">';
                            $output .= '<div class="list-comment-head__user-info">';
                                $output .= '<p class="">Chí thành</p>';
                                $output .= '<p class="">Đã tham gia 1 năm</p>';
                            $output .= '</div>';
                        $output .= '</div>';
                            $output .= '<div class="list-comment-head__user-body">';
                                $output .= '<p>Đã viết:<span class="list-comment-head-text"> 6 đánh giá</span> </p>';
                                $output .= '<p>Lượt thích: <span class="list-comment-head-text">0 like</span> </p>';
                            $output .= '</div>';
                $output .= '</div>';
                        $output .= '<div class="list-comment-body">';
                            $output .= '<p>Hài lòng</p>';
                            $output .= '<p class="color-green"><i class="fas fa-check-circle"></i> Đã mua sản phẩm</p>';
                            $output .= '<p>Nội dung bình luận : <span class="color-red">'.$row['text'].'</span> </p>';
                            $output .= '<p>Tên sản phẩm : <span class="color-red name_product">'.$row['name'].'</span></p>';
                            $output .= '<p>Màu : <span class="color-red name_product">Đen</span></p>';
                            $output .= '<p>Đánh giá vào thời gian : <span class="color-red date-comment">'.date("d-m-Y", strtotime($row['date'])).'</span></p>';
                            $output .= '<div class="list-comment-body__button">';
                                $output .= '<div class="list-comment-body__button-like">';
                                    $output .= '<button type="submit">Like</button>';
                                $output .= '</div>';
                                $output .= '<div class="list-comment-body__button-reply">';
                                    $output .= '<button type="submit">Trả lời</button>';
                                $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';

        }
    // }    

    echo $output;

}



                 
                      
                            
                         
                            
                            
                           
                       
                     
                     
                
                
                     
                   
                     
                    
                     
                     
                          
                              
                          
                        
                             
                          
                      
                  
             



?>