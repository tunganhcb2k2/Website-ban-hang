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
                    <h5 class="m-0 ">Danh sách bài viết</h5>
                </div>
                <div class="card-body">
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="">
                            <option>Chọn</option>
                            <option>Tác vụ 1</option>
                            <option>Tác vụ 2</option>
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <?php
                    if (!empty($list_page)) {
                    ?>
                        <table class="table table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input name="checkall" type="checkbox">
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">Tiêu đề</th>
                                    <th scope="col">Người tạo</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $temp = 0;
                                foreach ($list_page as $item) {
                                    $temp++;
                                ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox">
                                        </td>
                                        <td scope="row"><?php echo $temp ?></td>
                                        <td><a href=""><?php echo $item['page_title']; ?></a></td>
                                        <td><?php echo $item['creator']; ?></td>
                                        <td>
                                            <?php if (!empty($item['updated_at'])) {
                                                echo date('d/m/Y', $item['updated_at']);
                                            } else
                                                echo date('d/m/Y', $item['created_date']); ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo "?mod=page&action=update&page_id={$item['page_id']}"; ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo "?mod=page&action=delete&page_id={$item['page_id']}"; ?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php } ?>
                        </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>