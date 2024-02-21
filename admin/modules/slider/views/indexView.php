<?php
get_header();
?>
<div id="page-body" class="d-flex">
    <?php
    get_sidebar();
    ?>
    <div id="wp-content">
        <div class="container-fluid py-5">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h5 class="m-0 ">Danh sách slider</h5>
                </div>
                <div class="card-body">
                    <div class="analytic">

                        <a href="" class="text-primary">Công khai<span class="text-muted">(<?php echo $status_public ?>)</span></a>
                        <a href="" class="text-primary">Chờ duyệt<span class="text-muted">(<?php echo $status_pending ?>)</span></a>
                    </div>
                    <form method="POST" action="">
                        <div class="form-action form-inline py-3">
                            <select class="form-control mr-1" id="" name="action">
                                <option value="">Chọn</option>
                                <option value="pending">Ẩn hết</option>
                                <option value="public">Công khai hết</option>
                            </select>
                            <input type="submit" name="btn_action" value="Áp dụng" class="btn btn-primary">
                        </div>
                        <p class="text-success">Có <?php echo $total_row ?> slider trong hệ thống</p>

                        <table class="table table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input name="checkall" type="checkbox">
                                    </th>
                                    <th scope="col">STT</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tiêu đề</th>
                                    <th scope="col">Người tạo</th>
                                    <th scope="col">Số thự tự</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <?php
                            if (!empty($list_slider)) {
                                $temp = 0;
                                foreach ($list_slider as $item) {
                                    $temp++;
                            ?>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="checkItem[<?php echo $item['slider_id'] ?>]" value="<?php echo $item['slider_id'] ?>">
                                            </td>
                                            <td scope="row"><?php echo $temp ?></td>
                                            <td>
                                                <img class="img-fluid" src="<?php if (!empty($item['slider_thumb'])) {
                                                                                echo $item['slider_thumb'];
                                                                            } else {
                                                                                echo 'http://via.placeholder.com/80X80';
                                                                            } ?>" width="80" height="80" alt="">
                                            </td>
                                            <td><a href="<?php echo "?mod=slider&action=update&slider_id={$item['slider_id']}"; ?>"><?php echo $item['slider_name'] ?></a></td>
                                            <td><?php echo $item['creator'] ?></td>
                                            <td><?php echo $item['number_order'] ?></td>
                                            <td><?php echo $item['status']; ?></td>
                                            <td><?php if (!empty($item['updated_at'])) {
                                                    echo date('d/m/Y', $item['updated_at']);
                                                } else
                                                    echo date('d/m/Y', $item['created_at']); ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo "?mod=slider&action=update&slider_id={$item['slider_id']}"; ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="<?php echo "?mod=slider&action=delete&slider_id={$item['slider_id']}"; ?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>