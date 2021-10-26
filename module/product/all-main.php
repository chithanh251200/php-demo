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
                        <p class="desc">Hiển thị 45 trên 50 sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="3">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        
                        <?php
                            if(!empty($data_product)){
                                foreach($data_product as $item){
                        ?>
                        
                            <li>
                            <a href="?module=detail&act=main&id_sp=<?php echo $item['id_product'] ?>" title="" class="thumb">
                                <img src="admin/<?php echo $item['thumbnail'] ?>">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name"><?php echo $item['name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo number_format($item['price'],0,'.','.') ?>đ</span>
                                <span class="old">10.790.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?module=cart&act=add&id_sp=<?php echo $item['id_product'] ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        
                        <?php
                                }
                            }
                        ?>


                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                            echo padding($page , $total , $base='?module=product&act=all-main');
                        ?>
                    </ul>
                </div>
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
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Dưới 500.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>1.000.000đ - 5.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>5.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
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
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Điện thoại</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Laptop</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
    get_footer();
?>