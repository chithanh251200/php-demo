<?php
    get_header();
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h1 class="m-0 ">Danh sách đơn hàng</h1>
            <div class="form-search form-inline">
                <form action="" method="POST">
                    <input type="" class="form-control form-search" name="keyword" placeholder="Tìm kiếm">
                    <input type="submit" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="" class="text-primary">Tổng sản phẩm <span class="text-muted"> ()</span></a>
            </div>
            <form action="" method="POST">
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="act" id="">
                        <option>Chọn</option>
                        <option value="delete">Xóa</option>
                        <option value="update">cập nhật</option>
                    </select>
                    <input type="submit" name="btn_apply" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Code</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Gía sản phẩm</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Trạng thái </th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Ngày cập nhật</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" name="check_list[]" value="12">
                            </td>
                            <th scope="row">1</th>
                            <td>nguyễn chí thành</td>
                            <td>+84896797678</td>
                            <td>áhda</td>
                            <td>hay hay hay</td>
                            <td>2</td>
                            <td>12.312đ</td>
                            <td>25.855đ</td>
                            <td>ATM</td>
                            <td>chưa xử lý</td>
                            <td>26/05/2021 17:48:57</td>
                            <td>01/01/1970 08:00:00</td>
                            <td>
                                <a href="?module=order&act=delete&id_order=12" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit">xóa</i></a>
                                <a href="?module=order&act=update&id_order=12" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="update"><i class="fa fa-trash">update</i></a>
                                <a href="?module=product_cat&act=add" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="update"><i class="fa fa-trash">add</i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <nav aria-label="Page navigation example"></nav>
        </div>
    </div>
</div>




<?php
    get_footer();
?>