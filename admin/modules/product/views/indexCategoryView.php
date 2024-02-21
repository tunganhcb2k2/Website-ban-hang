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
                <div class="card-header font-weight-bold">
                    <h3>Danh sách danh mục</h3>
                </div>
                <div class="card-body">
                    <?php
                    if (!empty($list_category)) {
                    ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tiêu đề</th>
                                    <th scope="col">Người tạo</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                <?php
                                $temp = 0;
                                foreach ($list_category as $item) {
                                    $temp++;
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $temp; ?></th>
                                        <td><?php echo $item['cat_title']; ?></td>
                                        <td><?php echo $item['creator']; ?></td>
                                        <td><?php if (!empty($item['created_at'])) echo date('d/m/Y', $item['created_at']); ?></td>
                                        <td>
                                            <a href="<?php echo "?mod=product&controller=indexCategory&action=update&cat_id={$item['cat_id']}"; ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo "?mod=product&controller=indexCategory&action=delete&cat_id={$item['cat_id']}"; ?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php
                                }

                        ?>
                        </table>
                    <?php
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php
get_footer();
?>