<?php
    //lấy danh mục sản phẩm 
    $sql = mysqli_query($conn ,"SELECT `id_cat` , `name` FROM `cat_product`");
    $data_Cat = [];
    while($row = mysqli_fetch_array($sql)){
        $data_Cat[] = $row;
    }
?>

<?php


    //A : phân trang 
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }

    // số tin mún tồn tại trong 1 trang là bao nhiu (tự đặt)
    $sotincanlay = 50;

    // lấy tổng danh sách
    $sql_count = mysqli_query($conn , "SELECT * FROM `product`");
    $row_count = mysqli_num_rows($sql_count);

    // tổng số trang và làm tròn lên
    $total = ceil($row_count/$sotincanlay);
    // echo $total;

    $start = ($page-1) * $sotincanlay;
    // echo $start;



    // danh sách sản phẩm 
    $sql = mysqli_query($conn ,"SELECT * FROM `product` WHERE id_product LIMIT $start , $sotincanlay ");
    $data_product = [];
    $total = '';
    while($row = mysqli_fetch_array($sql)){
        $data_product[] = $row;
    }
    // show_data($data_product);

   


?>

<?php
    get_header();
?>


    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Tất Cả Sản Phẩm</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <span style="color:red;"><?php echo $row_count ?></span> trên 50 sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select" id="Sorting">
                                    <option>Sắp xếp</option>
                                    <option value="ASC">Từ A-Z</option>
                                    <option value="DESC">Từ Z-A</option>
                                    <option value="PRICE-DOWN">Giá cao xuống thấp</option>
                                    <option value="PRICE-UP">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail" id="list-product-main">
                    <!--  XỬ LÝ SCROLL LOAD SẢN PHẨM AJAX -->
                    <div id="scroll-load"></div>
                    <div id="load-message"></div>
                </div>

                <!-- sắp xếp list ASC , DESC , PRICE-DOWN , PRICE-UP  -->
                <div class="section-detail" id="list-product-main-sort" ></div> 
            </div>
            
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                    <?php
                        if(!empty($data_Cat)){
                            foreach($data_Cat as $value_cat){
                        ?>
                            <li>
                                <a href="?module=product&act=category-main&id_cat=<?php echo $value_cat['id_cat']?>" title=""><?php echo $value_cat['name']?></a>      
                            </li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="POST" action="">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price" class="r-price" value="0.5T"></td>
                                    <td>Dưới 500.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" class="r-price" value="0.5-1T"></td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" class="r-price" value="1-5T"></td>
                                    <td>1.000.000đ - 5.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" class="r-price" value="5-10T"></td>
                                    <td>5.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" class="r-price" value="big-10T"></td>
                                    <td>Trên 10.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Hãng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Acer</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Apple</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Hp</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Lenovo</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Samsung</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Toshiba</td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Loại</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price"id="r-price"></td>
                                    <td>Điện thoại</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"id="r-price"></td>
                                    <td>Laptop</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Slider -->
                        <div>
                            <div>   
                                <span class="demoHeaders h3">Giá :</span>
                                <span id="age"></span>
                            </div>
                            <div id="slider-range"></div>
                        </div>  
                        <!-- end  -->
                        <div class="from-to">
                            <div>
                                <label for="from">Từ</label>
                                <input type="text" name="price-from" id="from">
                            </div>
                            <div>
                                <label for="to">Đến</label>
                                <input type="text" name="price-from" id="to">
                            </div>
                            <button id="submit-from-to">Tìm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

            // XỬ LÝ SẮP XẾP A-Z , Z-A , GIÁ CAO -> THẤP , GIÁ THẤP -> LÊN

            $('#Sorting').change(function(){
                // lấy giá trị sắp xếp 
                var sort = $(this).val();
                // console.log(sort);

                $.ajax({
                    url : "asset/public/ajax/sort-product-all.php",
                    method : "POST",
                    dataType : "text",
                    data : {sort : sort},
                    success : function(data){
                        console.log('thành công');
                        $('#list-product-main').css('display' , 'none')
                        $('#list-product-main-sort').html(data);
                    }
                });

            });

            // XỬ LÝ GIÁ 500 , 1K , 5K , 10K , BIG 10K
            $('.r-price').each(function(key , index){
               $(index).click(function(){
                  var price = $(this).val();
                //   console.log(price)

                  $.ajax({
                    url : "asset/public/ajax/sort-product-all.php",
                    method : "POST",
                    dataType : "text",
                    data : {price :price},
                    success : function(data){
                        // console.log('thành công');
                        $('#list-product-main').css('display' , 'none')
                        $('#list-product-main-sort').html(data);
                        // console.log(data)
                    }
                });

               })
            });
        });
        // end 


        $(document).ready(function(){
            // Xử lý scroll load sản phẩm 
            var limit = 8;
            var start = 0;
            var action = 'active';

            function scroll_load_product(limit , start){
                $.ajax({
                    url : "asset/public/ajax/sort-product-all.php",
                    method : "POST",
                    data : {limit :limit , start : start},
                    cache : false,
                    success : function(data){

                        // xuất sản phẩm
                        $('#scroll-load').append(data);
                        // console.log(data)

                        if(data !== ''){
                            // xuất dữ liệu sau ul
                            $('#load-message').html("<p>Đang tải sản phẩm ...</p>");
                            // hoạt động 
                            action = 'active';
                        }
                        else{
                            $('#load-message').html("<p>Hết sản phẩm</p>");
                            // nghĩa là không hoạt động 
                            action = 'closed';
                        }

                        // console.log(action)
                       
                     
                    }
                });
            }

            // load dữ liệu mặc định
            if(action == 'active'){
                // load sản phẩm lên 
                scroll_load_product(limit , start);
                // rồi gán hoạt động lại = tắt 
                action = 'closed';
               
            }

            // bước này cực kì quan trọng  kiểm tra thanh scroll ( để load ra dữ liệu)
            $(window).scroll(function(){
                if($(window).scrollTop() + $(window).height()  >  $("#scroll-load").height() && action == 'active' ){
                    action = 'closed';
                    // gán lại start ( vd : lúc đầu = 8 , lúc sau = 8)
                    start = start + limit;
                    // chạy 
                    setTimeout(function() {
                        scroll_load_product(limit , start);
                    }, 1000);
                }
            });


        })
        // end 


        $(document).ready(function(){
            var v1 = 3000000;
            var v2 = 7000000;
            $( function() {
                $( "#slider-range" ).slider({
                range: true,
                min: 500,
                max: 20000000,
                values: [ v1, v2 ],
                slide: function( event, ui ) {
                    $( "#age" ).html( ui.values[ 0 ] + 'đ' + " - " + ui.values[ 1 ] + 'đ' );
                    v1 = ui.values[0];  
                    v2 = ui.values[1];

                    // load sản phẩm theo slide 
                    loadRange(v1, v2);

                }
                });
                $( "#age" ).html($( "#slider-range" ).slider( "values", 0 ) + 'đ' +
                " - " + $( "#slider-range" ).slider( "values", 1 ) + 'đ'  );
            } );

            //hàm load sản phẩm 
            function loadRange(range1 , range2){
                $.ajax({
                    url : "asset/public/ajax/sort-product-all.php",
                    method : "POST",
                    dataType : 'text',
                    data : {range1 : range1 , range2 : range2},
                    success : function(data){
                        // console.log('thành công')
                        $('#list-product-main').css('display' , 'none')
                        $('#list-product-main-sort').html(data);
                    }
                });
            }
        })


        $(document).ready(function(){
            $('#submit-from-to').click(function(e){
                e.preventDefault();

                var from = $('#from').val();
                var to = $('#to').val();
                // console.log(from)
                // console.log(to)

                // kiểm tra  giá khởi điểm phải lun lớn hơn giá kết thúc 
                if(to > from && from != '' && to != ''){
                    $.ajax({
                        url : "asset/public/ajax/sort-product-all.php",
                        method : "POST",
                        dataType : 'text',
                        data : {from : from , to : to},
                        success : function(data){
                            // console.log('thành công')
                            $('#list-product-main').css('display' , 'none')
                            $('#list-product-main-sort').html(data);
                        }
                    });
                }else{
                    console.log('giá khởi điểm phải nhỏ hơn giá kết thúc');
                }


            })
        })

    
    </script>



<?php
    get_footer();
?>