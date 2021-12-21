<?php
    //A : phân trang 
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }

    // số tin mún tồn tại trong 1 trang là bao nhiu (tự đặt)
    $sotincanlay = 15;

    // lấy tổng danh sách
    $sql_count = mysqli_query($conn , "SELECT * FROM `order`");
    $row_count = mysqli_num_rows($sql_count);

    // tổng số trang và làm tròn lên
    $total = ceil($row_count/$sotincanlay);
    // echo $total;

    $start = ($page-1) * $sotincanlay;
    // echo $start;



    // tổng danh sách chưa xóa tạm thời 
    $sql_total = mysqli_query($conn , "SELECT id_order FROM `order` WHERE  `is_delete` = 0 ");
    $total = mysqli_num_rows($sql_total);

    // tổng danh sách đã xóa tạm thời
    $sql_total_soft_delete = mysqli_query($conn , "SELECT id_order FROM `order` WHERE  `is_delete` = 1 ");
    $total_soft_delete = mysqli_num_rows($sql_total_soft_delete);


    // B : tiềm kiếm theo tên 
    if(isset($_POST['btn-submit-search'])){
        $keyword = $_POST['keyword'];
        $sql = mysqli_query($conn , "SELECT * FROM `order` , `customer`
            WHERE  `order`.`id_customer` = `customer`.`id_customer` and `code_sp` LIKE '%{$keyword}%' and `is_delete` = 1
        ");

        // show_data($sql);

        $data = [];
        while($items = mysqli_fetch_array($sql)){
            $data[] = $items;
        }
        // show_data($data);
    }
    // 
    else{
        $sql = mysqli_query($conn , "SELECT * FROM `order` , `customer` WHERE `order`.`id_customer` = `customer`.`id_customer` and `is_delete` = 1 LIMIT $start , $sotincanlay ");
        $data = [];
        while($items = mysqli_fetch_array($sql)){
            $data[] = $items;
        }
        // show_data($data);
    }

// C : xóa nhìu dữ liệu checkbox ->  xóa theo soft delete -> xóa tạm thời 
    // (is_delte = 0 là chưa xóa tạm thời )
    // (is_delte = 1 là đã xóa tạm thời rồi )
    if(isset($_POST['btn_apply'])){
        $act = $_POST['act'];
        $check_list = $_POST['check_list'];
        if(!empty($check_list)){
            if($act == 'restore'){
                for($i = 0 ; $i < count($check_list) ; $i++){
                    // echo "$i";
                    $restore_id = $check_list[$i];
                    // echo "$del_id";
                    $sql = mysqli_query($conn , "UPDATE `order` SET `is_delete` = 0 WHERE `id_order` = '{$restore_id}' ");
                    header('location:?module=order&act=list');
                }
            }
            else{
                echo "không tạm thời không thành công";
            }
            if($act == 'foce_delete'){
                for($i = 0 ; $i < count($check_list) ; $i++){
                    // echo "$i";
                    $foce_id = $check_list[$i];
                    // echo "$del_id";
                    $sql = mysqli_query($conn , "DELETE FROM `order`  WHERE `id_order` = '{$foce_id}' ");
                    header('location:?module=order&act=list');
                }
            }
            else{
                echo "Xóa vĩnh viễn không thành công";
            }
    
            // show_data($apply);
        }
        
    }




?>

<?php
    get_header();
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h1 class="m-0 ">Danh Sách Đơn Hàng</h1>
            <div class="form-search form-inline">
                <form action="" method="POST">
                    <input type="text" class="form-control form-search" name="keyword" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-submit-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="?module=order&act=list" class="text-primary">Hoạt động<span class="text-muted"> (<?php echo $total ?>)</span></a>
            
                <a href="?module=order&act=list_soft_delete" class="text-primary">Không hoạt động<span class="text-muted"> (<?php echo $total_soft_delete ?>)</span></a>
            </div>
            <form action="" method="POST">
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="act" id="">
                        <option>Chọn</option>
                        <option value="restore">Khôi phục</option>
                        <option value="delete">Xóa tạm thời</option>
                    </select>
                    <input type="submit" name="btn_apply" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" colspan ="2">#</th>
                            <th scope="col">Code</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Gía</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Ngày cập nhật</th>
                        </tr>
                    </thead>

                    <tbody class="count-index" data-deleteDefault="<?php echo $row_count ?>">
                        
                        <?php
                            if(!empty($data)){
                                $stt = 0;
                                foreach($data as $item){
                                $stt ++;
                        ?>
                            <tr class="text-center">
                                <td>
                                    <input type="checkbox" name="check_list[]" value="<?php echo $item['id_order'] ?>">
                                </td> 
                                <th scope="row"><?php echo $stt ?></th>
                                <td><?php echo $item['code_sp'] ?></td>
                                <td><?php echo $item['name_sp'] ?></td>   
                                <td><?php echo number_format($item['price_sp'] , 0 ,'.' , '.') ?>đ</td>
                                <td><?php echo $item['qty_sp'] ?></td>   
                                <td><?php echo  number_format($item['total_sp'], 0 ,'.' , '.') ?>đ</td>
                                <td><?php echo $item['created_at'] ?></td>
                                <td><?php echo $item['updated_at'] ?></td>
                            </tr>
                        <?php
                                }
                            }
                        ?>
                       
                    </tbody>
                </table>
            </form>
            <nav aria-label="Page navigation example"></nav>
            <nav aria-label="Page navigation example">
                <?php
                   echo padding($page , $total , $base='?module=order&act=list');
                ?>
            </nav>
        </div>
    </div>
</div>
<!-- end  -->
<!-- <div id="modal__notification">
    <div class="modal__notification--main">
        <h3 class="modal__notification--main-title">thông báo</h3>
        <p class="modal__notification--main-text">Đã xóa thành công</p>
    </div>
</div> -->



<?php
    get_footer();
?>