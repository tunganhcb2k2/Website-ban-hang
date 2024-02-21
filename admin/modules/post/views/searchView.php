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
                    <div class="form-search form-inline">
                        <form action="" method="POST">
                            <input type="text" class="form-control form-search text-center" name="search" placeholder="Tìm kiếm bài viết" value="<?php echo $key ?>">
                            <input type="submit" value="Tìm kiếm" class="btn btn-primary" name="btn_search">
                        </form>
                    </div>
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
                    <p class="text-success">Tìm được <?php echo $total_row_search  ?> bài viết theo "<?php echo $key ?>" trong hệ thống</p>
                    <?php
                    if (!empty($list_post)) {
                    ?>
                        <table class="table table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input name="checkall" type="checkbox">
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tiêu đề</th>
                                    <th scope="col">Người tạo</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <?php
                            $temp = 0;
                            foreach ($list_post as $item) {
                                $temp++;
                            ?>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="checkbox">
                                        </td>
                                        <td scope="row"><?php echo $temp ?></td>
                                        <td>
                                            <img class="img-fluid" src="<?php if (!empty($item['post_thumb'])) {
                                                                            echo $item['post_thumb'];
                                                                        } else {
                                                                            echo 'http://via.placeholder.com/80X80';
                                                                        } ?>" width="80" height="80" alt="">
                                        </td>
                                        <td><a href=""><?php echo $item['post_title'] ?></a></td>
                                        <td><?php echo $item['creator'] ?></td>
                                        <td><?php echo $item['cat_title'] ?></td>
                                        <td>Hoạt động</td>
                                        <td><?php if (!empty($item['created_at'])) echo date('d/m/Y', $item['created_at']); ?></td>
                                        <td>
                                            <a href="<?php echo "?mod=post&action=update&post_id={$item['post_id']}"; ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo "?mod=post&action=delete&post_id={$item['post_id']}"; ?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
                    <nav aria-label="Page navigation example">
                        <?php
                        echo get_pagging($num_page, $page, "?mod=post&action=search");
                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>