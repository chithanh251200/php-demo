<?php
    $get_sp_cart = get_cart();
    // show_data($get_sp_cart);
    // show_data($_SESSION['cart']);



?>

<?php
    get_header();
?>
  
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?module=home&act=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm làm đẹp da</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <!-- start  -->
        <?php
            if(!empty($get_sp_cart)){
        ?>
         <form action="?module=cart&act=update" method="POST">
            <div class="section" id="info-cart-wp">
                <div class="section-detail table-responsive">
                
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php
                                    foreach($get_sp_cart as $value){
                            ?>
                                <tr>
                                    <td><?php echo $value['code_cart'] ?></td>
                                    <td>
                                        <a href="?module=detail&act=main&id_sp=<?php echo $value['id_cart'] ?>" title="" class="thumb">
                                            <img src="admin/<?php echo $value['thumbnail_cart'] ?>" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" title="" class="name-product"><?php echo $value['name_cart'] ?>  </a>
                                    </td>
                                    <td><?php echo number_format($value['price_cart'],0,'.','.') ?>đ</td>
                                    <td>
                                        <input type="number" name="qty[<?php echo $value['id_cart'] ?>]" min="1" max="1000" value="<?php echo $value['qty_cart'] ?>" 
                                        data-id="<?php echo $value['id_cart'] ?>" data-price="<?php echo $value['price_cart'] ?>"  
                                        class="num-order" id="num-order">
                                    </td>
                                    <td class="current_cart"><?php echo number_format($value['current_cart'],0,'.','.') ?>đ</td>
                                    <td>
                                        <a href="?module=cart&act=delete&id_cart=<?php echo $value['id_cart'] ?>" title="xóa" class="del-product"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php
                            
                                }
                            ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span id="total_new">
                                        <?php
                                        if(get_total_cart() != null){
                                            echo number_format(get_total_cart() , 0 ,'.','.');
                                        }
                                        else{
                                            return 0;
                                        }
                                        ?>đ</span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <input type="submit" name="btn-update" id="update-cart" value="Cập nhật giỏ hàng">
                                            <a href="<?php echo !empty($_SESSION['is_username']) ? '?module=cart&act=checkout' : 'login.php' ?>" title="" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                    <a href="?module=home&act=home" title="" id="buy-more">Mua tiếp</a><br/>
                    <a href="?module=cart&act=deleteAll" title="" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>
        </form>
        <?php  
            }else{
        ?>
            <p style="text-align:center; color:red ; font-size: 24px; height: 334px ; line-height: 334px;">Không tồn tại sản phẩm nào trong giỏ hàng ! Quay lại 
                <span><a href="?module=home&act=home">Trang chủ</a> thêm sản phầm nào !</span>
            </p>

        <?php
            }
        ?>
        <!-- end  -->
    </div>

    <div id="modal-notification">
        <div id="notification"></div>
    </div>


    <script>

        

        $(document).ready(function(){
        // chú ý cực kì quan trọng nếu lấy theo id thì nó chỉ lấy đc thần đầu tiên thoi ,  còn lấy theo class thì danh sách 

            
            $(".num-order").each(function(key , index){
                $(index).click(function(e){
                    // console.log(key);

                    // lấy thành tiền 
                    var currentList = document.querySelectorAll('.current_cart');
                    // console.log(current_new);

                    // lấy id
                    var id = $(this).data('id');
                    console.log(id);

                   


                    // số lượng new
                    var num_order_new = $(this).val();
                    // console.log(num_order_new);

                    // price
                    var price = $(this).data('price');
                    // console.log(price+'=giá');

                    // current new
                    var currentNew = currentList[key];
                    // console.log(currentNew);

    
                    $.ajax({
                        url : "asset/public/ajax/show-cart.php",
                        method : "POST",
                        dataType : "json",
                        data : {id : id , num_order_new : num_order_new , price : price},
                        success : function(result){

                                $.each(result , function(key , index){
                                     // xuất currentnew
                                    $(currentNew).text(index.current_new);
                                    $('#total_new').text(index.total_new).css('color','red');

                                // xuất thông báo khi cập nhật thành công
                                    $('#notification').fadeIn();
                                    $('#notification').html('<p class="success-update"> Cập nhật thành công</p>');
                                    $('#modal-notification').css('z-index','1')
                                    setTimeout(() => {
                                        $('#notification').fadeOut();
                                        $('#modal-notification').css('z-index','-1');
                                    }, 2000);

                              });

                        }
                    });
                })
            })
            // end 


            // xuất thông báo đã thêm ( trừ ) số lượng thành công 
            // $(".num-order").each(function(key , index){
            //     $(index).click(function(e){
                        
            //     }
            // });

        });
    </script>


<?php
    get_footer();
?>