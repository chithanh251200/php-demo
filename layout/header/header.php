
<!DOCTYPE html>
<html>
    <head>
        <title>Shop Điện Thoại</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="asset/public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="asset/public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="asset/public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="asset/public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="asset/public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="asset/public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="asset/public/style.css" rel="stylesheet" type="text/css"/>
        <link href="asset/public/responsive.css" rel="stylesheet" type="text/css"/>

        <script src="asset/public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="asset/public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
        <script src="asset/public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="asset/public/js/carousel/owl.carousel.js" type="text/javascript"></script>
        <script src="asset/public/js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                            <div id="main-menu-wp" class="fl-right">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="?module=home&act=home" title="">Trang chủ</a>
                                    </li>
                                    <li>
                                        <a href="?module=product&act=all-main" title="">Sản phẩm</a>
                                    </li>
                                    <li>
                                        <a href="?page=blog" title="">Blog</a>
                                    </li>
                                    <li>
                                        <a href="?page=detail_blog" title="">Giới thiệu</a>
                                    </li>
                                    <li>
                                        <a href="?page=detail_blog" title="">Liên hệ</a>
                                    </li>

                                    <?php
                                        if(!empty($_SESSION['is_username'])){
                                    ?>
                                        <li>
                                            <a href="login.php" title="" style="color:#ace492;"> <span>TK : </span><?php echo $_SESSION['is_username'] ?></a>
                                        </li>
                                        <li>
                                            <a href="logout.php" title="">Đăng xuất</a>
                                        </li>
                                    <?php
                                        }else{
                                    ?>
                                        <li>
                                            <a href="login.php" title="">Đăng nhập</a>
                                        </li>
                                        <li>
                                            <a href="registion.php" title="">Đăng ký</a>
                                        </li>
                                    <?php
                                        }
                                    ?>

                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="?module=home&act=home" title="" id="logo" class="fl-left"><img src="asset/public/images/logo.png"/></a>
                            <div id="search-wp" class="fl-left">
                                <form method="POST" action="">
                                    <input type="text" name="s" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                    <button type="submit" id="sm-s">Tìm kiếm</button>
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">Tư vấn</span>
                                    <span class="phone">0987.654.321</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num">2</span>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <div id="btn-cart">
                                        <a href="?module=cart&act=show" style="color:#fff">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            <?php
                                                if(get_num_row() > 0){
                                            ?>
                                                 <span id="num">
                                                    <?php echo get_num_row() ?>
                                                 </span>
                                            <?php
                                                }
                                            ?> 
                                           
                                        </a>
                                    </div>
                                    <div id="dropdown">
                                        <p class="desc">Có <span>2 sản phẩm</span> trong giỏ hàng</p>
                                        <ul class="list-cart">
                                            <?php
                                                if(!empty($_SESSION['cart']['buy'])){
                                                    foreach($_SESSION['cart']['buy'] as $value){
                                            ?>
                                                 <li class="clearfix">
                                                    <a href="" title="" class="thumb fl-left">
                                                        <img src="admin/<?php echo $value['thumbnail_cart'] ?>" alt="">
                                                    </a>
                                                    <div class="info fl-right">
                                                        <a href="" title="" class="product-name"><?php echo $value['name_cart'] ?></a>
                                                        <p class="price"><?php echo number_format($value['price_cart'],0,'.','.')?>đ</p>
                                                        <p class="qty">Số lượng: <span><?php echo $value['qty_cart'] ?></span></p>
                                                    </div>
                                                </li>
                                            <?php   
                                                    }
                                                }
                                            ?>
                                        </ul>
                                        <div class="total-price clearfix">
                                            <p class="title fl-left">Tổng:</p>
                                            <p class="price fl-right"><?php echo  number_format(get_total_cart(),0,'.','.') ?>đ</p>
                                        </div>
                                        <dic class="action-cart clearfix">
                                            <a href="?page=cart" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="?page=checkout" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </dic>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><div id="main-content-wp" class="home-page clearfix">