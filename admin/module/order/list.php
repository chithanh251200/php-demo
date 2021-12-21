<?php
    //A : phân trang 
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }

    // số tin mún tồn tại trong 1 trang là bao nhiu (tự đặt)
    $sotincanlay = 3;

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


    // B : tiềm kiếm theo tên (cách tiềm kiếm php thuần)
    // if(isset($_POST['btn-submit-search'])){
    //     $keyword = $_POST['keyword'];
    //     $sql = mysqli_query($conn , "SELECT * FROM `order` , `customer`
    //         WHERE  `order`.`id_customer` = `customer`.`id_customer` and `code_sp` LIKE '%{$keyword}%' and `is_delete` = 0
    //     ");


    //     show_data($sql);

    //     $data = [];
    //     while($items = mysqli_fetch_array($sql)){
    //         $data[] = $items;
    //     }
    //     // show_data($data);
    // }
    

    $sql = mysqli_query($conn , "SELECT * FROM `order` , `customer` WHERE `order`.`id_customer` = `customer`.`id_customer` and `is_delete` = 0 LIMIT $start , $sotincanlay ");
    $data = [];
    while($items = mysqli_fetch_array($sql)){
        $data[] = $items;
    }
    // show_data($data);

// C : xóa nhìu dữ liệu checkbox ->  xóa theo soft delete -> xóa tạm thời ( theo php thuần )
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
                $sql = mysqli_query($conn , "UPDATE `order` SET `is_delete` = 1 WHERE `id_order` = '{$del_id}' ");
                header('location:?module=order&act=list');
            }
        }
        else{
            echo "xóa tạm thời không thành công";
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
            <h1 class="m-0 ">Danh Sách Đơn Hàng</h1>
            <div class="form-search form-inline">
                <form action="" method="POST" id="form-search">
                    <input type="text" class="form-control form-search" id="text-search" name="keyword" placeholder="Tìm kiếm sản phẩm">
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
                    <select class="form-control mr-1" name="act" id="selectDelete">
                        <option value="">Chọn</option>
                        <option value="delete">Xóa tạm thời</option>
                    </select>
                    <input type="submit" name="btn_apply" value="Áp dụng" class="btn btn-primary" id="btn_apply">
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
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>

                    <tbody id="load-search" class="count-index">
                        
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
                                <td>
                                    <a href="?module=order&act=delete&id_order=<?php echo $item['id_order'] ?>" data-delete="<?php echo $item['id_order']?>" class="btn-delete btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit">xóa</i></a>
                                    <a href="?module=order&act=update&id_order=<?php echo $item['id_order'] ?>" data-update="<?php echo $item['id_order']?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="update"><i class="fa fa-trash">update</i></a>
                                </td>
                            </tr>
                        <?php
                                }
                            }
                        ?>
                    
                    </tbody>
                </table>
               
            </form>

            <nav id="paginate" aria-label="Page navigation example">
                <?php
                   echo padding($page , $total , $base='?module=order&act=list');
                ?>
            </nav>
        </div>
    </div>
</div>
<!-- end  -->
<!-- <div id="modal__notification">
    <div id="modal__notification--main" class="modal__notification--main">
        <h3 class="modal__notification--main-title">thông báo</h3>
        <p id="modal__notification--main-text" class="modal__notification--main-text">Đã xóa thành công</p>
    </div>
</div> -->

</div>


<script>
    $(document).ready(function(){
        // xử lý tác vụ 
        // $('#btn_apply').click(function(e){
        //     e.preventDefault();
         
        //     // lấy tác vụ delete
        //     var option = $('#selectDelete').val();

        //     var listCheck = [];

        //     // kiểm tra tác vụ 
        //     if(option == 'delete'){
        //         // lấy tất cả checkbox được chọn 
        //         $(':checkbox:checked').each(function(key , index){
        //             listCheck[key] = $(this).val();
        //         });

        //         // kiểm tra listCheck
        //         if(listCheck.length == 0){
        //             console.log('không tồn tại thần nào !');
        //         }
        //         else{
        //             if(confirm('Bạn chắc chắn chưa')){
        //                 $.ajax({
        //                     url : "asset/public/ajax/admin-main.php",
        //                     method : "POST",
        //                     data : {listCheck : listCheck},
        //                     success : function(data){
        //                         if(data == 1){
        //                             $('#modal__notification').css('z-index' , '1');
        //                             $('#modal__notification--main').css('height' , '81px');
        //                             setTimeout(() => {
        //                                 $('#modal__notification').css('z-index' , '-1');
        //                                 $('#modal__notification--main').css('height' , '0');
        //                             }, 2000);
        //                         }
        //                         else{
        //                             $('#modal__notification').css('z-index' , '1');
        //                             $('#modal__notification--main').css('height' , '81px');
        //                             $('#modal__notification--main-text').text('Xóa không thành công');
                                
        //                             setTimeout(() => {
        //                                 $('#modal__notification').css('z-index' , '-1');
        //                                 $('#modal__notification--main').css('height' , '0');
        //                             }, 2000);
        //                         }
        //                     }
        //                 });
        //             }
        //         }
        //     }else{
        //        alert('vui lòng chọn tác vụ để thực thi ! không được để trống');
        //     }

        

        // })

        // xử lý tìm kiếm 
        $('#text-search').on('keyup', function(){

            var input = $(this).val();
            // console.log(input)

            $.ajax({
                url : "asset/public/ajax/admin-main.php",
                method : "POST",
                dataType : "text",
                data : {input : input},
                success : function(data){
                    // console.log('thành công')
                    $('#paginate').css('display','none');
                    $('#load-search').html(data);
                }
            });
        })



        // xóa theo id 
        // $('.btn-delete').each(function(key , index){
        //     // console.log(index)
        //     $(index).click(function(e){
        //     //console.log(123)
        //        e.preventDefault();

        //        var idDelete = $(this).data('delete');
        //     //console.log(idDelete);

        //         $.ajax({
        //             url : "asset/public/ajax/admin-main.php",
        //             method : "POST",
        //             dataType : "text",
        //             data : {idDelete : idDelete},
        //             success : function(data){
        //                 // load danh sách  
        //                 loadList();
        //                 // $('#modal__notification').css('z-index' , '1');
        //                 // $('#modal__notification--main').css('height' , '81px');
        //                 // setTimeout(() => {
        //                 //     $('#modal__notification').css('z-index' , '-1');
        //                 //     $('#modal__notification--main').css('height' , '0');
        //                 // }, 2000);
        //             }
        //         });

        //     })
        // });

        // load danh sách sản phẩm 
        function loadList(){
            $.ajax({
                url : "asset/public/ajax/admin-main.php",
                method : "POST",
                dataType : "text",
                data : {load : 'load'},
                success : function(data){
                    if(data == 1){
                        console.log('load thành công')
                    }
                }
            });
        };


    });
</script>



<?php
    get_footer();
?>


