<?php
    $sql = mysqli_query($conn , "SELECT * FROM `user` ");
    $data = [];
    // c1 : lấy dữ liệu theo vòng lập while  
        while($rows = mysqli_fetch_array($sql)){
            $data[] = $rows;
        }
        // show_data($data);


    // c2 : lấy dữ liệu theo câu điều kiện mysqli_fetc_all
        // a . lấy dữ liệu 
            // $row = mysqli_fetc_all($sql);
        // b . xuất dự liệu lên html
                // echo $value[1]
?>

<?php
    $sql = mysqli_query($conn , "SELECT * FROM `cat_product` ");
    $data_cat = [];
    // c1 : lấy dữ liệu theo vòng lập while  
        while($rows = mysqli_fetch_array($sql)){
            $data_cat[] = $rows;
        }
        // show_data($data_cat);


    // c2 : lấy dữ liệu theo câu điều kiện mysqli_fetc_all
        // a . lấy dữ liệu 
            // $row = mysqli_fetc_all($sql);
        // b . xuất dự liệu lên html
                // echo $value[1]
?>

<?php
    if(isset($_POST['btn-submit'])){
        

        if(isset($_FILES['file'])){
            // chú ý cực kì quan trọng khi sử lý upload file cần xem đường dẫn upload 
            $file_name = $_FILES['file']['name'];
            $path = "asset/public/uploads/";
            $upldoa_file = $path.$file_name;
            move_uploaded_file($_FILES["file"]["tmp_name"],$upldoa_file);

          
            $name = $_POST['name'];
            $price = $_POST['price'];
            $id_cat = $_POST['cat_option'];
            $id_user = $_POST['user_option'];

            $add = mysqli_query($conn , "INSERT INTO `product` (`name`,`price`,`thumbnail`,`id_cat`,`id_user`)
                VALUES ('{$name}','{$price}','{$upldoa_file}','{$id_cat}','{$id_user}')
            ");

            if($add > 0){
                echo "thanh công";
            }else{
                echo "không thành công ";
            }

            header('location:?module=product&act=list');
        }

        
    }
?>
    


<?php
    get_header();
?>
    <div class="form-add ml-4 mr-4">
        <h1>Thêm Danh Sách Sản Phẩm</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="cat_name">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <!-- end  -->
            <div class="form-group">
                <label for="price">Gía Sản phẩm</label>
                <input type="text" name="price" class="form-control">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <!-- end  -->
            <div class="form-group">
                <label for="file">Hình ảnh</label>
                <input type="file" name="file" class="form-control">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <!-- end  -->
            <div class="form-group">
                <label for="cat_option">Danh Mục Sản Phẩm</label>
                <select name="cat_option" class="form-control" id="cat_option">
                    <option value="">--chọn--</option>
                    <?php
                        foreach($data_cat as $value){
                    ?>
                          <option value="<?php echo $value['id_cat_product'] ?>"><?php echo $value['name']?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <!-- end   -->
            <div class="form-group">
                <label for="user_option">Danh Mục Sản Phẩm</label>
                <select name="user_option" class="form-control" id="user_option">
                    <option value="">--chọn--</option>
                    <?php
                        foreach($data as $item){
                    ?>
                          <option value="<?php echo $item['id_user'] ?>"><?php echo $item['user_name']?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <!-- end  -->
            <button type="submit" name="btn-submit"  class="btn btn-primary">Submit</button>
        </form>
    </div>
   