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
    $sql_count = mysqli_query($conn , "SELECT * FROM `cat_product`");
    $row_count = mysqli_num_rows($sql_count);

    // tổng số trang và làm tròn lên
    $total = ceil($row_count/$sotincanlay);
    // echo $total;

    $start = ($page-1) * $sotincanlay;
    // echo $start;




    // B : tiềm kiếm theo tên 
    if(isset($_POST['btn-submit-search'])){
        $keyword = $_POST['keyword'];
        if($keyword != ''){
            $sql = mysqli_query($conn , "SELECT * FROM `cat_product` , `user` 
            WHERE `cat_product`.`id_user` = `user`.`id_user` and `name`  LIKE '%{$keyword}%' and `is_delete` = 1
            ");
            $data = [];
            while($items = mysqli_fetch_array($sql)){
                $data[] = $items;
            }
            // show_data($data);
        }
        else{
            $sql = mysqli_query($conn , "SELECT * FROM `cat_product` , `user` WHERE `cat_product`.`id_user` = `user`.`id_user` and `is_delete` = 1 LIMIT $start , $sotincanlay ");
            $data = [];
            while($items = mysqli_fetch_array($sql)){
                $data[] = $items;
            }
            // show_data($data);
        }
    }
    // 
    else{
        $sql = mysqli_query($conn , "SELECT * FROM `cat_product` , `user` WHERE `cat_product`.`id_user` = `user`.`id_user` and `is_delete` = 1 LIMIT $start , $sotincanlay ");
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
                    $sql = mysqli_query($conn , "UPDATE `cat_product` SET `is_delete` = 0 WHERE `id_cat` = '{$restore_id}' ");
                    header('location:?module=product_cat&act=list');
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
                    $sql = mysqli_query($conn , "DELETE FROM `cat_product`  WHERE `id_cat` = '{$foce_id}' ");
                    header('location:?module=product_cat&act=list');
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
            <h1 class="m-0 ">Danh Mục Sản Phẩm Đã Xóa</h1>
            <div class="form-search form-inline">
                <form action="" method="POST">
                    <input type="text" class="form-control form-search" name="keyword" placeholder="Tìm kiếm" value="<?php
                    if(!empty($keyword)){
                        echo $keyword ;
                    }
                    ?>">
                    <input type="submit" name="btn-submit-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="?module=product_cat&act=list" class="text-primary"> Quay lại<span class="text-muted"></span></a>
            </div>
            <form action="" method="POST">
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="act" id="">
                        <option>Chọn</option>
                        <option value="restore">Khôi phục</option>
                        <option value="foce_delete">Xóa vĩnh viễn</option>
                    </select>
                    <input type="submit" name="btn_apply" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>

                            <th scope="col" colspan ="2">#</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Ngày cập nhật</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        <?php
                            if(!empty($data)){
                                $stt = 0;
                                foreach($data as $item){
                                $stt ++;
                        ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="check_list[]" value="<?php echo $item['id_cat'] ?>">
                                </td> 
                                <th scope="row"><?php echo $stt ?></th>
                                <td><?php echo $item['name'] ?></td>    
                                <td><?php echo $item['user_name'] ?></td>
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
            <?php
                // không tồn tại keywword thì xuất phân trang , tồn tại keyword thì không xuất
                if(empty($keyword)){
            ?>
                <nav aria-label="Page navigation example">
                    <?php
                    echo padding($page , $total , $base='?module=product_cat&act=list');
                    ?>
                </nav>
            <?php
                }
            ?>
        </div>
    </div>
</div>




<?php
    get_footer();
?>