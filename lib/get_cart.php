<?php

    // chú ý cực kì quan trong : dùng đến SESSION ( cho login hay giỏ hàng thì chú ý) => phải thêm session_start() ngoài index 


    function add($id_sp){
        // gọi kết nối vào 
        global $conn;

        $sql = mysqli_query($conn , "SELECT * FROM `product` WHERE `id_product` = '{$id_sp}'");
        $row = mysqli_fetch_assoc($sql);
        // show_data($row);

        // tạo số lượng mặc định  = 1 
        $qty = 1 ;

        // nếu giỏ hàng tồn tại . sản phẩm đã tồn tại thì cộng số lượng lên 1 
        if(isset($_SESSION['cart']) && array_key_exists($id_sp,$_SESSION['cart']['buy'])){
            $qty = $_SESSION['cart']['buy'][$id_sp]['qty_cart'] + 1;
        };


        // Bắt đầu tạo SESSION giỏ hàng 
        $_SESSION['cart']['buy'][$id_sp] = array(
            'id_cart' => $row['id_product'],
            'name_cart' => $row['name'],
            'price_cart' => $row['price'],
            'code_cart' => $row['code'],
            'qty_cart' => $qty,
            'thumbnail_cart' => $row['thumbnail'],
            // thành tiền 
            'currency_cart' => $row['price'] * $qty,
        );

        // cập nhật lại giỏ hàng
        update();

    }



    function update(){
        $num_row = 0;
        $total = 0;

        // duyệt mảng session để tìm ra qty và thành tiền 
        foreach($_SESSION['cart']['buy'] as $item){
            $num_row += $item['qty_cart'];
            $total += $item['currency_cart'];
        }

        // tạo mảng session tổng số lượng và tổng all tiền 
        $_SESSION['cart']['all'] = array(
            'num_row' => $num_row,
            'total' => $total,
        );
    }


    // lấy danh sách sp trong giỏ hàng 
    function get_cart(){
        if(isset($_SESSION['cart'])){
            return $_SESSION['cart']['buy'];
        }
        return false;
    }


    // lấy tổng tiền 
    function get_num_row(){
        if(isset($_SESSION['cart'])){
            return $_SESSION['cart']['all']['num_row'];
        }
    }


    // lấy tổng tiền 
    function get_total_cart(){
        if(isset($_SESSION['cart'])){
            return $_SESSION['cart']['all']['total'];
        }
    }


    // xóa sản phẩm 
    function delete_cart($id_cart){
        if(isset($_SESSION['cart'])){
            if(!empty($id_cart)){
                unset($_SESSION['cart']['buy'][$id_cart]);
                update();
            }else{
                unset($_SESSION['cart']);
            }
        }
    }



    // cập nhật số lượng giỏ hàng 
    function update_qty($qty){
      
            foreach($qty as $key => $new_qty){

                $_SESSION['cart']['buy'][$key]['qty_cart'] = $new_qty;
                
                // thay đổi lại tổng tiền
                $_SESSION['cart']['buy'][$key]['currency_cart'] = $new_qty * $_SESSION['cart']['buy'][$key]['price_cart'] ;

            }
            // cập nhật lại giỏ hàng 
            update();
        

    }
    




?>