<?php
    $id_update_product = $_GET['id_product'];
    // echo $id_update_product;


    $sql = mysqli_query($conn , "SELECT * FROM `product` WHERE `id_product` = '{$id_update_product}' ");
    $row = mysqli_fetch_assoc($sql);
    // show_data($row);

    // c2 : lấy dữ liệu theo câu điều kiện mysqli_fetc_all
        // a . lấy dữ liệu 
            // $row = mysqli_fetc_all($sql);
        // b . xuất dự liệu lên html
                // echo $value[1]

    if(isset($_POST['btn-update'])){
        $error = array();
        if(empty($_POST['name'])){
            $error['name'] = 'Vui lòng nhập thông đầy đủ';
        }
        else{
            $name = $_POST['name'];
        }
        // end  

        if(empty($_POST['price'])){
            $error['price'] = 'Vui lòng nhập thông đầy đủ';
        }
        else{
            $price = $_POST['price'];
        }
        // end
        if(empty($_POST['code'])){
            $error['code'] = 'Vui lòng nhập thông đầy đủ';
        }
        else{
            $code = $_POST['code'];
        }
        // end 
        if(empty($_POST['qty'])){
            $error['qty'] = 'Vui lòng nhập thông đầy đủ';
        }
        else{
            $qty = $_POST['qty'];
        }
        // end 

        if(empty($_POST['cat_option'])){
            $error['cat_option'] = 'Vui lòng nhập thông đầy đủ';
        }
        else{
            $cat_option = $_POST['cat_option'];
        }
        // end 

        if(empty($_POST['user_option'])){
            $error['user_option'] = 'Vui lòng nhập thông đầy đủ';
        }
        else{
            $user_option = $_POST['user_option'];
        }
        // end 

        // kiểm tra 
        if(empty($error)){

            if(isset($_FILES['file'])){
                $file_name = $_FILES['file']['name'];
                $path = "asset/public/uploads/";
                $upldoa_file = $path.$file_name;
                move_uploaded_file($_FILES["file"]["tmp_name"],$upldoa_file);

                if($file_name){
                    $update = mysqli_query($conn , "UPDATE `product` SET `name` = '{$name}' , `price` = '{$price}' , `code` = '{$code}' ,`qty` = '{$qty}' , `thumbnail` = '{$upldoa_file}', `id_cat` = '{$cat_option}' ,  `id_user` = '{$user_option}'
                    WHERE `id_product` = '{$id_update_product}' ");
                    if($update > 0){
                        echo "đã cập nhật thành công";
                    }
                    else{
                        echo "update không thành công";
                    }
                    header('location:?module=product&act=list');
                }
                else{
                    $update = mysqli_query($conn , "UPDATE `product` SET `name` = '{$name}' , `price` = '{$price}' , `code` = '{$code}' ,`qty` = '{$qty}' , `id_cat` = '{$cat_option}' ,  `id_user` = '{$user_option}'
                    WHERE `id_product` = '{$id_update_product}' ");
                    if($update > 0){
                        echo "đã cập nhật thành công";
                    }
                    else{
                        echo "update không thành công";
                    }
                    header('location:?module=product&act=list');
                }
            }
        }
    }
?>
    


<?php
    get_header();
?>
    <div class="form-add ml-4 mr-4">
        <h1 style="display:inline-block">Cập Nhật Sách Sản Phẩm</h1>
        <span><a href="?module=product&act=list" class="comback">Trở lại</a></span>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <!-- end  -->
            <div class="form-group">
                <label for="price">Gía Sản phẩm</label>
                <input type="text" name="price" class="form-control" value="<?php echo $row['price']?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <!-- end  -->
            <div class="form-group">
                <label for="code">Mã Sản phẩm</label>
                <input type="text" name="code" class="form-control"  value="<?php echo $row['code']?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <!-- end  -->
            <div class="form-group">
                <label for="qty">Số lượng</label>
                <input type="text" name="qty" class="form-control"  value="<?php echo $row['qty']?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <!-- end  -->
            <div class="form-group">
                <label for="file">Hình ảnh</label><br>
                <img src="<?php echo $row['thumbnail'] ?>" alt="" style="width:90px ; height:90px" class="my-4">
                <input type="file" name="file" class="form-control">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <!-- end  -->
            <div class="form-group">
                <label for="cat_option">Người tạo</label>
                <?php
                    $sql_user = mysqli_query($conn , "SELECT `id_cat` , `name` FROM `cat_product`");
                ?>
                <select name="cat_option" class="form-control" id="cat_option">
                    <?php
                        while($value = mysqli_fetch_array($sql_user)){
                            if($value['id_cat'] == $row['id_cat']){           
                    ?>
                         <option selected="selected" value="<?php echo $value['id_cat'] ?>"><?php echo $value['name']?></option>
                    <?php
                            }else{
                    ?>
                        <!-- xuất đanh sách  -->
                        <option value="<?php echo $value['id_cat'] ?>"><?php echo $value['name']?></option>
                    <?php
                            }
                       }
                    ?>
                </select>
            </div>
            <!-- end  -->
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
            <!-- end   -->
            <button type="submit" name="btn-update"  class="btn btn-primary">Submit</button>
        </form>
    </div>
   