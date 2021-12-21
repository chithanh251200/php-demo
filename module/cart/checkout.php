<?php
     $get_sp_cart = get_cart();
    //  show_data($_SESSION['cart']);

     // thêm sản phẩm 
if(isset($_POST['btn-check'])){


    $error = array();
    // fulname
    if (empty($_POST['fullname'])) {
        $error['fullname'] = 'Vui lòng nhập đầy đủ họ và tên';
    } else {
        $fullname = $_POST['fullname'];
    }

    // fulname
    if (empty($_POST['phone'])) {
        $error['phone'] = 'Vui lòng nhập đầy đủ số điện thoại';
    } else {
        $phone = $_POST['phone'];
    }


    // fulname
    if (empty($_POST['email'])) {
        $error['email'] = 'Vui lòng nhập đầy email';
    } else {
        $email = $_POST['email'];
    }

    // provinces
    if (empty($_POST['provinces'])) {
        $error['provinces'] = 'Vui lòng nhập tỉnh thành';
    } else {
        $provinces = $_POST['provinces'];
    }

    // districts
    if (empty($_POST['districts'])) {
        $error['districts'] = 'Vui lòng nhập quận / huyện ';
    } else {
        $districts = $_POST['districts'];
    }


    // commune
    if (empty($_POST['commune'])) {
        $error['commune'] = 'Vui lòng nhập phường / xã';
    } else {
        $commune = $_POST['commune'];
    }
    

    // payment-method
    if (empty($_POST['payment-method'])) {
        $error['payment-method'] = 'Vui lòng chọn hình thức thanh toán';
    } else {
        $paymentMethod = $_POST['payment-method'];
    }


    // fulname
    if (empty($_POST['note'])) {
        $error['note'] = 'Vui lòng nhập thông tin ghi chú';
    } else {
        $note = $_POST['note'];
    }

    if(empty($error)){

        // lấy id tài khoản đăng nhập 
        $customer_account = get_customer_acount($_SESSION['is_username']);
        $id_account = $customer_account['id_account'];
        // echo $id_account;

        // thêm thông tin khách order 
        $sql_kh_order =  mysqli_query($conn ,"INSERT INTO `customer`(`fullname`, `phone`, `email` , `note` , `pay` , `id_provinces` ,`id_districts` , `id_commune` , `id_account`) 
        VALUES ('$fullname' , '$phone' , '$email' , '$note' , '$paymentMethod' , '$provinces' ,'$districts' ,'$commune' , '$id_account')");


        // thêm thành công 
        if($sql_kh_order){

            // lấy khác hàng mới nhất
            $sql = mysqli_query($conn, "SELECT id_customer FROM `customer` ORDER BY `id_customer` DESC LIMIT 1 ");
            $row = mysqli_fetch_array($sql);
            $id_kh_order = $row['id_customer'];
            
            // tổng tiền
            $total_sp = $_POST['total_sp'];

    // chú ý cực kì quan trọng < tong $i nếu sơ xuất để <= thì sẽ sinh ra lỗi
    // => giải thích <= : khi duyệt nó sẽ duyệt ( vd = 4 lần ) trong khi đó sản phẩm trong giỏ hàng chỉ có (vd 3 sản phầm ) nên nó duyệt dư 1 trường hợp 
    // sinh ra lỗi này : Notice: Undefined offset: 2 in C:\xampp\htdocs\chithanh\php\do_an_php_1_9_2021\module\cart\checkout.php on line 74 

            for($i = 0 ; $i < count($_POST['id_sp']) ;  ++$i ){
                $id_sp = $_POST['id_sp'][$i];
                $code_sp = $_POST['code_sp'][$i];
                $name_sp = $_POST['name_sp'][$i];
                $qty_sp = $_POST['qty_sp'][$i];
                $price_sp = $_POST['price_sp'][$i];


                // thêm đơn hàng mà khách hàng vừa mua
                $order = mysqli_query(
                    $conn,
                    "INSERT INTO `order` (`id_sp`,`code_sp`,`name_sp`,`price_sp`,`qty_sp`,`total_sp`,`id_customer`)
                    VALUES ('$id_sp','$code_sp','$name_sp','$price_sp','$qty_sp','$total_sp','$id_kh_order') "
                );

                
            }
        }

        //  xóa toàn bộ giỏ hàng 
        // unset($_SESSION['cart']);

    }


    

}

?>
<?php
    get_header();
?>

    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form action="" method="POST" id="form-submit">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname">
                            <p style="color:red;"><?php echo form_error('fullname') ?></p>  
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                            <p style="color:red;"><?php echo form_error('email') ?></p>  
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone">
                            <p style="color:red;"><?php echo form_error('phone') ?></p>  
                        </div>
                        <div class="form-col fl-right" >
                            <label for="provinces">Tỉnh thành</label>
                            <div  id="select-provinces"></div>
                            <p style="color:red;"><?php echo form_error('provinces') ?></p>  
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left" >
                            <label for="districts">Chọn Huyện</label>
                            <div id="select-districts">
                                <select name="districts" id="districts" style="width: 100%; padding: 9px 12px; border: 1px solid #cccccc;">
                                    <option value="">Chọn huyện</option>
                                </select>
                            </div>
                            <p style="color:red;"><?php echo form_error('districts') ?></p>  
                        </div>
                        <div class="form-col fl-right" >
                            <label for="commune">Chọn Xã</label>
                            <div  id="select-commune">
                                <select name="commune" id="commune" style="width: 100%; padding: 9px 12px; border: 1px solid #cccccc;">
                                    <option value="">Chọn xã</option>
                                </select>
                            </div>
                            <p style="color:red;"><?php echo form_error('commune') ?></p>  
                        </div>
                    </div>
                  
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note"></textarea>
                            <p style="color:red;"><?php echo form_error('note') ?></p>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($get_sp_cart)){
                                    foreach($get_sp_cart as $value){
                            ?>
                                <tr>
                                    <input type="hidden" name="id_sp[]" value="<?php echo $value['id_cart'] ?>">
                                    <input type="hidden" name="code_sp[]" value="<?php echo $value['code_cart'] ?>">
                                    <input type="hidden" name="name_sp[]" value="<?php echo $value['name_cart'] ?>">
                                    <input type="hidden" name="price_sp[]" value="<?php echo $value['price_cart'] ?>">
                                    <input type="hidden" name="qty_sp[]" value="<?php echo $value['qty_cart'] ?>">
                                    <input type="hidden" name="total_sp" value="<?php echo get_total_cart() ?>">
                                </tr>

                                <tr class="cart-item" style="color:red;">
                                    <td class="product-name"><?php echo $value['name_cart'] ?><strong class="product-quantity">x <?php echo $value['qty_cart'] ?></strong></td>
                                    <td class="product-total"><?php echo number_format($value['price_cart'] , 0 , '.' ,'.' )?>đ</td>
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price"></strong> 
                                <?php
                                    if(get_total_cart() != null){
                                        echo number_format(get_total_cart() , 0 ,'.','.');
                                    }
                                    else{
                                        return 0;
                                    }
                                ?>
                                đ</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment-method" value="thanh toán qua ATM">
                                <label for="direct-payment">Thanh toán qua ATM</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment-method" value="thanh toán tại nhà">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                            <p style="color:red;"><?php echo form_error('payment-method') ?></p>  
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" name="btn-check" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </form>
    </div>


    <script>
        $(document).ready(function(){
            function loadTinh(){
                var tinh = 'tinh';
                $.ajax({
                    url : "asset/public/ajax/address-checkout.php",
                    method : "POST",
                    dataType : "text",
                    data : {tinh : tinh},
                    success : function(data){
                        // console.log('thành công');
                        if(tinh == 'tinh'){
                            $('#select-provinces').html(data);
                        }
                    }
                })
             }
             loadTinh();


            //  xử lý check box tỉnh
            $(document).on('change','#provinces',function(){
                // console.log(123)
                var id_provinces = $(this).val();
                // console.log(id_provinces)

                $.ajax({
                    url : "asset/public/ajax/address-checkout.php",
                    method : "POST",
                    dataType : "text",
                    data : {id_provinces : id_provinces},
                    success : function(data){
                        console.log('thành công');
                        $('#select-districts').html(data);
                    }
                })

            });



            //  xử lý check box huyện 
            $(document).on('change','#districts',function(){
                // console.log(123)
                var id_districts  = $(this).val();
                // console.log(id_districts)

                $.ajax({
                    url : "asset/public/ajax/address-checkout.php",
                    method : "POST",
                    dataType : "text",
                    data : {id_districts : id_districts},
                    success : function(data){
                        console.log('thành công');
                        $('#select-commune').html(data);
                    }
                })
            });



           



        });
    </script>


<?php
    get_footer();
?>