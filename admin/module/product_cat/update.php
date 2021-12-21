<?php
    $id_update_product_cat = $_GET['id_product_cat'];
    // echo $id_update_product_cat;

    $sql = mysqli_query($conn , "SELECT * FROM `cat_product` WHERE `id_cat` = '{$id_update_product_cat}' ");
    $row = mysqli_fetch_assoc($sql);
    // show_data($row);

    // c2 : lấy dữ liệu theo câu điều kiện mysqli_fetc_all
        // a . lấy dữ liệu 
            // $row = mysqli_fetc_all($sql);
        // b . xuất dự liệu lên html
                // echo $value[1]

    if(isset($_POST['btn-update'])){
        $error = array();
        if(empty($_POST['cat_name'])){
            $error['cat_name'] = 'Vui lòng nhập thông đầy đủ';
        }
        else{
            $cat_name = $_POST['cat_name'];
        }
        if(empty($_POST['user_option'])){
            $error['user_option'] = 'Vui lòng nhập thông đầy đủ';
        }
        else{
            $user_option = $_POST['user_option'];
        }
        // kiểm tra 
        if(empty($error)){
            $update = mysqli_query($conn , "UPDATE `cat_product` SET `name` = '{$cat_name}' , `id_user` = '{$user_option}'
            WHERE `id_cat` = '{$id_update_product_cat}' ");
            if($update > 0){
                echo "đã cập nhật thành công";
            }
            else{
                echo "update không thành công";
            }
            header('location:?module=product_cat&act=list');
        }
    }
?>
    


<?php
    get_header();
?>
    <div class="form-add ml-4 mr-4">
        <h1>Cập Nhật Danh Mục Sản Phẩm</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="cat_name">Tên danh mục sản phẩm</label>
                <input type="text" name="cat_name" class="form-control" value="<?php echo $row['name'] ?>">
            </div>
            <div class="form-group">
                <label for="user_option">Người tạo</label>

                <?php
                    $sql_user = mysqli_query($conn , "SELECT id_user , user_name FROM `user`");
                ?>

                <select name="user_option" class="form-control" id="user_option">
                    <?php
                        while($value = mysqli_fetch_array($sql_user)){
                            if($value['id_user'] == $row['id_user']){           
                    ?>
                         <option selected="selected" value="<?php echo $value['id_user'] ?>"><?php echo $value['user_name']?></option>
                    <?php
                            }else{
                    ?>
                        <!-- xuất đanh sách  -->
                        <option value="<?php echo $value['id_user'] ?>"><?php echo $value['user_name']?></option>
                    <?php
                            }
                       }
                    ?>
                         
                   
                </select>
            </div>
            <button type="submit" name="btn-update"  class="btn btn-primary">UPDATE</button>
        </form>
    </div>
   