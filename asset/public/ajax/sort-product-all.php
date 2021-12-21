<?php
  require '../../../config/db.php';

    // echo "thành công";

    if(isset($_POST['sort'])){
        $sort = $_POST['sort'];

        $output = '';
        $output .= '<ul class="list-item clearfix">';

        if($sort == 'DESC'){
            $sql = mysqli_query($conn , "SELECT * FROM `product` ORDER BY `id_product` DESC ");
            // duyệt mảng xuất dữ liệu lên
            while ($row = mysqli_fetch_array($sql)) {
                    $output .= '<li>';
                        $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="thumb">';
                             $output .= '<img src="admin/'.$row['thumbnail'].'">';
                        $output .= '</a>';
                        $output .= '<a href="?page=detail_product" title="" class="product-name">'.$row['name'].'</a>';
                        $output .= '<div class="price">';
                            $output .= '<span class="new">'.number_format($row['price'],0,'.','.').'đ</span>';
                            $output .= '<span class="old">10.790.000đ</span>';
                        $output .= '</div>';
                        $output .= '<div class="action clearfix">';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>';
                        $output .= '</div>';
                    $output .= '</li>';
            }
        }
        else if($sort == 'ASC'){
            $sql = mysqli_query($conn , "SELECT * FROM `product` ORDER BY `id_product` ASC ");
            // duyệt mảng xuất dữ liệu lên
            while ($row = mysqli_fetch_array($sql)) {
                    $output .= '<li>';
                        $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="thumb">';
                            $output .= '<img src="admin/'.$row['thumbnail'].'">';
                        $output .= '</a>';
                    $output .= '<a href="?page=detail_product" title="" class="product-name">'.$row['name'].'</a>';
                       $output .= '<div class="price">';
                            $output .= '<span class="new">'.number_format($row['price'],0,'.','.').'đ</span>';
                            $output .= '<span class="old">10.790.000đ</span>';
                        $output .= '</div>';
                    $output .= '<div class="action clearfix">';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>';
                        $output .= '</div>';
                    $output .= '</li>';
              
            }
        }
        else if($sort == 'PRICE-DOWN'){
            $sql = mysqli_query($conn , "SELECT * FROM `product` ORDER BY `price` DESC ");
            // duyệt mảng xuất dữ liệu lên
            while ($row = mysqli_fetch_array($sql)) {
                    $output .= '<li>';
                        $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="thumb">';
                             $output .= '<img src="admin/'.$row['thumbnail'].'">';
                        $output .= '</a>';
                        $output .= '<a href="?page=detail_product" title="" class="product-name">'.$row['name'].'</a>';
                        $output .= '<div class="price">';
                            $output .= '<span class="new">'.number_format($row['price'],0,'.','.').'đ</span>';
                            $output .= '<span class="old">10.790.000đ</span>';
                        $output .= '</div>';
                        $output .= '<div class="action clearfix">';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>';
                        $output .= '</div>';
                    $output .= '</li>';
            }
        }
        else if($sort == 'PRICE-UP'){
            $sql = mysqli_query($conn , "SELECT * FROM `product` ORDER BY `price` ASC ");
            // duyệt mảng xuất dữ liệu lên
            while ($row = mysqli_fetch_array($sql)) {
                
                    $output .= '<li>';
                        $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="thumb">';
                            $output .= '<img src="admin/'.$row['thumbnail'].'">';
                        $output .= '</a>';
                    $output .= '<a href="?page=detail_product" title="" class="product-name">'.$row['name'].'</a>';
                        $output .= '<div class="price">';
                            $output .= '<span class="new">'.number_format($row['price'],0,'.','.').'đ</span>';
                            $output .= '<span class="old">10.790.000đ</span>';
                        $output .= '</div>';
                    $output .= '<div class="action clearfix">';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>';
                        $output .= '</div>';
                    $output .= '</li>';
            }
        }
        else{
            echo "không tồn tại sản phẩm nào cả !";
        }
        $output .= '</ul>';

        echo $output;

    }


    if(isset($_POST['price'])){
        $price = $_POST['price'];

        $output = '';
        $output .= '<ul class="list-item clearfix">';

        if($price == '0.5T'){
            $sql = mysqli_query($conn , "SELECT * FROM `product` WHERE `price` < '500000' ");
            // duyệt mảng xuất dữ liệu lên

            if(mysqli_num_rows($sql) > 0){
                while ($row = mysqli_fetch_array($sql)) {
                    $output .= '<li>';
                        $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="thumb">';
                             $output .= '<img src="admin/'.$row['thumbnail'].'">';
                        $output .= '</a>';
                        $output .= '<a href="?page=detail_product" title="" class="product-name">'.$row['name'].'</a>';
                        $output .= '<div class="price">';
                            $output .= '<span class="new">'.number_format($row['price'],0,'.','.').'đ</span>';
                            $output .= '<span class="old">10.790.000đ</span>';
                        $output .= '</div>';
                        $output .= '<div class="action clearfix">';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>';
                        $output .= '</div>';
                    $output .= '</li>';
                }
            }
            else{
                $output .= '<div>';
                    $output .= '<p class="no-product">Không tồn tại sản phẩm nào !</p>';
                $output .= '</div>';
            }
        }
        else if($price == '0.5-1T' ){
            $sql = mysqli_query($conn , "SELECT * FROM `product` WHERE `price` >= '500000' and `price` <= '1000000' ");
            // duyệt mảng xuất dữ liệu lên
            if(mysqli_num_rows($sql) > 0){
                while ($row = mysqli_fetch_array($sql)) {
                    $output .= '<li>';
                        $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="thumb">';
                             $output .= '<img src="admin/'.$row['thumbnail'].'">';
                        $output .= '</a>';
                        $output .= '<a href="?page=detail_product" title="" class="product-name">'.$row['name'].'</a>';
                        $output .= '<div class="price">';
                            $output .= '<span class="new">'.number_format($row['price'],0,'.','.').'đ</span>';
                            $output .= '<span class="old">10.790.000đ</span>';
                        $output .= '</div>';
                        $output .= '<div class="action clearfix">';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>';
                        $output .= '</div>';
                    $output .= '</li>';
                }
            }
            else{
                $output .= '<div>';
                    $output .= '<p class="no-product">Không tồn tại sản phẩm nào !</p>';
                $output .= '</div>';
            }
        }
        else if($price == '1-5T' ){
            $sql = mysqli_query($conn , "SELECT * FROM `product` WHERE `price` >= '500000' and `price` <= '1000000' ");
            // duyệt mảng xuất dữ liệu lên
            if(mysqli_num_rows($sql) > 0){
                while ($row = mysqli_fetch_array($sql)) {
                    $output .= '<li>';
                        $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="thumb">';
                             $output .= '<img src="admin/'.$row['thumbnail'].'">';
                        $output .= '</a>';
                        $output .= '<a href="?page=detail_product" title="" class="product-name">'.$row['name'].'</a>';
                        $output .= '<div class="price">';
                            $output .= '<span class="new">'.number_format($row['price'],0,'.','.').'đ</span>';
                            $output .= '<span class="old">10.790.000đ</span>';
                        $output .= '</div>';
                        $output .= '<div class="action clearfix">';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>';
                        $output .= '</div>';
                    $output .= '</li>';
                }
            }
            else{
                $output .= '<div>';
                    $output .= '<p class="no-product">Không tồn tại sản phẩm nào !</p>';
                $output .= '</div>';
            }
        }
        else if($price == '5-10T' ){
            $sql = mysqli_query($conn , "SELECT * FROM `product` WHERE `price` >= '5000000' and `price` <= '10000000' ");
            // duyệt mảng xuất dữ liệu lên
            if(mysqli_num_rows($sql) > 0){
                while ($row = mysqli_fetch_array($sql)) {
                    $output .= '<li>';
                        $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="thumb">';
                             $output .= '<img src="admin/'.$row['thumbnail'].'">';
                        $output .= '</a>';
                        $output .= '<a href="?page=detail_product" title="" class="product-name">'.$row['name'].'</a>';
                        $output .= '<div class="price">';
                            $output .= '<span class="new">'.number_format($row['price'],0,'.','.').'đ</span>';
                            $output .= '<span class="old">10.790.000đ</span>';
                        $output .= '</div>';
                        $output .= '<div class="action clearfix">';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>';
                        $output .= '</div>';
                    $output .= '</li>';
                }
            }
            else{
                $output .= '<div>';
                    $output .= '<p class="no-product">Không tồn tại sản phẩm nào !</p>';
                $output .= '</div>';
            }
        }
        else if($price == 'big-10T' ){
            $sql = mysqli_query($conn ,"SELECT * FROM `product` WHERE `price` > '10000000' ");
            // duyệt mảng xuất dữ liệu lên
            if(mysqli_num_rows($sql) > 0){
                while ($row = mysqli_fetch_array($sql)) {
                    $output .= '<li>';
                        $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="thumb">';
                             $output .= '<img src="admin/'.$row['thumbnail'].'">';
                        $output .= '</a>';
                        $output .= '<a href="?page=detail_product" title="" class="product-name">'.$row['name'].'</a>';
                        $output .= '<div class="price">';
                            $output .= '<span class="new">'.number_format($row['price'],0,'.','.').'đ</span>';
                            $output .= '<span class="old">10.790.000đ</span>';
                        $output .= '</div>';
                        $output .= '<div class="action clearfix">';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>';
                            $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>';
                        $output .= '</div>';
                    $output .= '</li>';
                }
            }
            else{
                $output .= '<div>';
                    $output .= '<p class="no-product">Không tồn tại sản phẩm nào !</p>';
                $output .= '</div>';
            }
        }
        else{
          echo "không tồn tại sản phẩm nào !";
        }
        $output .= '</ul>';

        echo $output;

    }




    // xử lý scroll load sản phẩm 
    if(isset($_POST['limit'] , $_POST['start'])){
        $start = $_POST['start'];
        $limit = $_POST['limit'];

        $output = '';
        $output .= '<ul class="list-item clearfix">';

        $sql_scroll = mysqli_query($conn , "SELECT * FROM `product` ORDER BY `id_product` DESC LIMIT $start , $limit ");

        if(mysqli_num_rows($sql_scroll) > 0){
            while ($row = mysqli_fetch_array($sql_scroll)) {
                $output .= '<li>';
                    $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="thumb">';
                         $output .= '<img src="admin/'.$row['thumbnail'].'">';
                    $output .= '</a>';
                    $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="product-name">'.$row['name'].'</a>';
                    $output .= '<div class="price">';
                        $output .= '<span class="new">'.number_format($row['price'],0,'.','.').'đ</span>';
                        $output .= '<span class="old">10.790.000đ</span>';
                    $output .= '</div>';
                    $output .= '<div class="action clearfix">';
                        $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>';
                        $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>';
                    $output .= '</div>';
                $output .= '</li>';
            }
        }
        $output .= '</ul>';

        echo $output;

    }



    // xử lý slider load sản phẩm 
    if(isset($_POST['range1'] , $_POST['range2'] )){
        $min = $_POST['range1'];
        $max = $_POST['range2'];

        $output = '';
        $output .= '<ul class="list-item clearfix">';

        $sql_scroll = mysqli_query($conn , "SELECT * FROM `product` WHERE `price` BETWEEN '{$min}' AND '{$max}' ");

        if(mysqli_num_rows($sql_scroll) > 0){
            while ($row = mysqli_fetch_array($sql_scroll)) {
                $output .= '<li>';
                    $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="thumb">';
                         $output .= '<img src="admin/'.$row['thumbnail'].'">';
                    $output .= '</a>';
                    $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="product-name">'.$row['name'].'</a>';
                    $output .= '<div class="price">';
                        $output .= '<span class="new">'.number_format($row['price'],0,'.','.').'đ</span>';
                        $output .= '<span class="old">10.790.000đ</span>';
                    $output .= '</div>';
                    $output .= '<div class="action clearfix">';
                        $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>';
                        $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>';
                    $output .= '</div>';
                $output .= '</li>';
            }
        }
        else{
            $output .= '<div>';
                $output .= '<p class="no-product">Không tồn tại sản phẩm nào !</p>';
            $output .= '</div>';
        }
        $output .= '</ul>';

        echo $output;

    }




    // xử lý tìm kiếm giá từ đâu đến đâu 
    if(isset($_POST['from'] , $_POST['to'] )){
        $min = $_POST['from'];
        $max = $_POST['to'];

        $output = '';
        $output .= '<ul class="list-item clearfix">';

        $sql_scroll = mysqli_query($conn , "SELECT * FROM `product` WHERE `price` BETWEEN '{$min}' AND '{$max}' ");

        if(mysqli_num_rows($sql_scroll) > 0){
            while ($row = mysqli_fetch_array($sql_scroll)) {
                $output .= '<li>';
                    $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="thumb">';
                         $output .= '<img src="admin/'.$row['thumbnail'].'">';
                    $output .= '</a>';
                    $output .= '<a href="?module=detail&act=main&id_sp='.$row['id_product'].'" title="" class="product-name">'.$row['name'].'</a>';
                    $output .= '<div class="price">';
                        $output .= '<span class="new">'.number_format($row['price'],0,'.','.').'đ</span>';
                        $output .= '<span class="old">10.790.000đ</span>';
                    $output .= '</div>';
                    $output .= '<div class="action clearfix">';
                        $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>';
                        $output .= '<a href="?module=cart&act=add&id_sp='.$row['id_product'].'" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>';
                    $output .= '</div>';
                $output .= '</li>';
            }
        }
        else{
            $output .= '<div>';
                $output .= '<p class="no-product">Không tồn tại sản phẩm nào !</p>';
            $output .= '</div>';
        }
        $output .= '</ul>';

        echo $output;

    }




?>
