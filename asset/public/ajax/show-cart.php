<?php
    ob_start();
    session_start();

    require '../../../lib/get_cart.php';
?>

<?php
    $result = array();
    $id = $_POST['id'];
    $new_qty = $_POST['num_order_new'];
    $price = $_POST['price'];

    if(isset($_SESSION['cart']) && array_key_exists($id , $_SESSION['cart']['buy'])){


        // gán lại = qty mới trong giỏ hàng
        $_SESSION['cart']['buy'][$id]['qty_cart'] = $new_qty;
        // thay đổi thành tiền mới
        $current_new = $new_qty * $price ;

        // gán lại = thành tiền trong giỏ hàng
        $_SESSION['cart']['buy'][$id]['current_cart'] = $current_new;
      
        // cập nhật toàn bộ lại giỏ hàng
        update();

        // lấy tổng tiền ra và gán lại biến total_new
        $total_new = get_total_cart();

        // rồi đưa giá trị vào mảng 
        $result[] = array(
            'current_new' => number_format($current_new, 0 ,'.','.')."đ",
            'total_new' =>number_format($total_new, 0 ,'.','.')."đ",
        );


        // echo $current_new;
        echo json_encode($result);

    };
    

?>