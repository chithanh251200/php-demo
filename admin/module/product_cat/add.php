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
    if(isset($_POST['btn-submit'])){
        $id_user = $_POST['user_option'];
        $cat_name = $_POST['cat_name']; 
    
        $add = mysqli_query($conn , "INSERT INTO `cat_product` (`name`,`id_user`)
                VALUES ('{$cat_name}','{$id_user}')
        ");
        if($add > 0){
            echo "đã thêm thành công";
        }
        header('location:?module=product_cat&act=list');
    }
?>
    


<?php
    get_header();
?>
    <div class="form-add ml-4 mr-4">
        <h1>Thêm Danh Mục Sản Phẩm</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="cat_name">Tên danh mục sản phẩm</label>
                <input type="text" name="cat_name" class="form-control">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="user_option">Người tạo</label>
                <select name="user_option" class="form-control" id="user_option">
                    <option value="">--chọn--</option>
                    <?php
                        foreach($data as $value){
                    ?>
                          <option value="<?php echo $value['id_user'] ?>"><?php echo $value['user_name']?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <button type="submit" name="btn-submit"  class="btn btn-primary">Submit</button>
        </form>
    </div>
   