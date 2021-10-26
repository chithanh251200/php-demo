

<?php

    //A : phân trang 
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }

    // số tin mún tồn tại trong 1 trang là bao nhiu (tự đặt)
    $sotincanlay = 20;

    // lấy tổng danh sách
    $sql_count = mysqli_query($conn , "SELECT * FROM `product`");
    $row_count = mysqli_num_rows($sql_count);

    // tổng số trang và làm tròn lên
    $total = ceil($row_count/$sotincanlay);
    // echo $total;

    $start = ($page-1) * $sotincanlay;
    // echo $start;


    
    if(isset($_GET['id_cat'])){
        $id_cat = (int)$_GET['id_cat'];
    }
    // echo $id_cat;

    // lấy tên danh mục 
    $sql = "SELECT * FROM `cat_product` WHERE `id_cat` = '$id_cat' LIMIT 1 ";
    $query_cat = mysqli_query($conn , $sql);
    $row_title = mysqli_fetch_assoc($query_cat);
    // gán id_cat = row_title để đưa vào phân trang  
    $id_cat = $row_title['id_cat'];



    // danh sách sản phẩm 
    $sql = "SELECT * FROM `product` WHERE `id_cat` = '$id_cat' LIMIT $start , $sotincanlay ";
    $query_product = mysqli_query($conn , $sql);

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
                        <a href="" title=""><?php echo $row_title['name'] ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left"><?php echo $row_title['name'] ?></h3>
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
                       
                            while($row_product = mysqli_fetch_array($query_product)){
                        ?>
                        
                            <li>
                            <a href="?module=detail&act=main&id_sp=<?php echo $row_product['id_product'] ?>" title="" class="thumb">
                                <img src="admin/<?php echo $row_product['thumbnail'] ?>">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name"><?php echo $row_product['name'] ?></a>
                            <div class="price">
                                <span class="new"><?php echo number_format($row_product['price'],0,'.','.') ?>đ</span>
                                <span class="old">10.790.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?module=cart&act=add&id_sp=<?php echo $row_product['id_product'] ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        
                        <?php
                                }
                        ?>


                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                            echo padding($page , $total , $base='?module=product&act=category-main&id_cat='.$id_cat);
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
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