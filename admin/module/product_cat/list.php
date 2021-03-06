<?php
    //A : phân trang 
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }

    // số tin mún tồn tại trong 1 trang là bao nhiu (tự đặt)
    $sotincanlay = 6;

    // lấy tổng danh sách
    $sql_count = mysqli_query($conn , "SELECT * FROM `cat_product`");
    $row_count = mysqli_num_rows($sql_count);

    // tổng số trang và làm tròn lên
    $total = ceil($row_count/$sotincanlay);
    // echo $total;

    $start = ($page-1) * $sotincanlay;
    // echo $start;



    // tổng danh sách 
    $sql_total = mysqli_query($conn , "SELECT id_cat FROM `cat_product` WHERE  `is_delete` = 0 ");
    $total = mysqli_num_rows($sql_total);

    // tổng danh sách 
    $sql_total_soft_delete = mysqli_query($conn , "SELECT id_cat FROM `cat_product` WHERE  `is_delete` = 1 ");
    $total_soft_delete = mysqli_num_rows($sql_total_soft_delete);


    // B : tiềm kiếm theo tên 
    if(isset($_POST['btn-submit-search'])){
        $keyword = $_POST['keyword'];
        if($keyword != ''){
            $sql = mysqli_query($conn , "SELECT * FROM `cat_product` , `user` 
            WHERE `cat_product`.`id_user` = `user`.`id_user` and `name`  LIKE '%{$keyword}%' and `is_delete` = 0
            ");
            $data = [];
            while($items = mysqli_fetch_array($sql)){
                $data[] = $items;
            }
            // show_data($data);
        }
        else{
            $sql = mysqli_query($conn , "SELECT * FROM `cat_product` , `user` WHERE `cat_product`.`id_user` = `user`.`id_user` and `is_delete` = 0 LIMIT $start , $sotincanlay ");
            $data = [];
            while($items = mysqli_fetch_array($sql)){
                $data[] = $items;
            }
            // show_data($data);
        }
    }
    // 
    else{
        $sql = mysqli_query($conn , "SELECT * FROM `cat_product` , `user` WHERE `cat_product`.`id_user` = `user`.`id_user` and `is_delete` = 0 LIMIT $start , $sotincanlay ");
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
        $apply = $_POST['check_list'];
        if($act == 'delete'){
            for($i = 0 ; $i < count($apply) ; $i++){
                // echo "$i";
                $del_id = $apply[$i];
                // echo "$del_id";
                $sql = mysqli_query($conn , "UPDATE `cat_product` SET `is_delete` = 1 WHERE `id_cat` = '{$del_id}' ");
                header('location:?module=product_cat&act=list');
            }
        }
        else{
            echo "không tạm thời không thành công";
        }
        // show_data($apply);
        
    }



?>

<?php
    get_header();
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h1 class="m-0 ">Danh Mục Sản Phẩm</h1>
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
                <a href="?module=product_cat&act=list" class="text-primary">Hoạt động<span class="text-muted"> (<?php echo $total ?>)</span></a>
            
                <a href="?module=product_cat&act=list_soft_delete" class="text-primary">Không hoạt động<span class="text-muted"> (<?php echo $total_soft_delete ?>)</span></a>
            </div>
            <form action="" method="POST">
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="act" id="">
                        <option>Chọn</option>
                        <option value="delete">Xóa tạm thời</option>
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
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>

                    <tbody class="count-index" data-deleteDefault="<?php echo $row_count ?>">
                        
                        <?php
                            if(!empty($data)){
                                $stt = 0;
                                foreach($data as $item){
                                $stt ++;
                        ?>
                            <tr >
                                <td>
                                    <input type="checkbox" name="check_list[]" value="<?php echo $item['id_cat'] ?>">
                                </td> 
                                <th scope="row"><?php echo $stt ?></th>
                                <td><?php echo $item['name'] ?></td>    
                                <td><?php echo $item['user_name'] ?></td>
                                <td><?php echo $item['created_at'] ?></td>
                                <td><?php echo $item['updated_at'] ?></td>
                                <td>
                                    <a href="?module=product_cat&act=delete&id_product_cat=<?php echo $item['id_cat'] ?>" class="btn-delete btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit">xóa</i></a>
                                    <a href="?module=product_cat&act=update&id_product_cat=<?php echo $item['id_cat'] ?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="update"><i class="fa fa-trash">update</i></a>
                                    <a href="?module=product_cat&act=add" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="update"><i class="fa fa-trash">add</i></a>
                                </td>
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
<!-- end  -->
<!-- <div class="modal__notification active_notification">
    <div class="modal__notification--main">
        <h3 class="modal__notification--main-title">thông báo</h3>
        <p class="modal__notification--main-text">Đã xóa thành công</p>
    </div>
</div> -->



<?php
    get_footer();
?>