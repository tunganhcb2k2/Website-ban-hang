<?php
get_header();
$status_public = get_status('tbl_product', 'public');
$status_pending = get_status('tbl_product', 'pending');
?>
<div id="page-body" class="d-flex">
    <?php
    get_sidebar();
    ?>
    <div id="wp-content">
        <div class="container-fluid py-5">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h5 class="m-0 ">Danh sách sản phẩm tìm kiếm</h5>
                    <div class="form-search form-inline">
                        <form method="POST" action="">
                            <input type="" class="form-control form-search" name="search" placeholder="Tìm kiếm sản phẩm">
                            <input type="submit" name="btn_search" value="Tìm kiếm" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="">
                            <option>Chọn</option>
                            <option>Ẩn hết</option>
                            <option>Xoá hết</option>
                        </select>
                        <input type="submit" name="btn_deletel_all" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <p class="text-success">Tìm được <?php echo $total_row_search  ?> bài viết theo "<?php echo $key ?>" trong hệ thống</p>
                    <?php if (!empty($list_product)) {        ?>

                        <table class="table table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input name="checkall" type="checkbox">
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Giá đang sale</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <?php
                            $temp = $start;
                            foreach ($list_product as $item) {
                                $temp++;
                            ?>
                                <tbody>
                                    <tr class="">
                                        <td>
                                            <input type="checkbox">
                                        </td>
                                        <td><?php echo $temp; ?></td>
                                        <td>
                                            <img class="img-fluid" src="<?php if (!empty($item['product_thumb'])) {
                                                                            echo $item['product_thumb'];
                                                                        } else {
                                                                            echo 'http://via.placeholder.com/80X80';
                                                                        } ?>" width="80" height="80" alt="">
                                        </td>
                                        <td><a href=""><?php echo $item['product_name']; ?></a></td>
                                        <td><?php echo currency_format($item['original_price']); ?></td>
                                        <td><?php echo currency_format($item['price_sale']); ?></td>
                                        <td><?php echo $item['cat_title']; ?></td>
                                        <td><?php if (!empty($item['updated_at'])) {
                                                echo date('d/m/Y', $item['updated_at']);
                                            } else {
                                                echo date('d/m/Y', $item['created_at']);
                                            } ?></span></td>
                                        <td><?php echo $item['qty_product']; ?></span></td>
                                        <td><?php echo $item['status']; ?></td>
                                        <td>
                                            <a href="<?php echo "?mod=product&action=update&product_id={$item['product_id']}"; ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo "?mod=product&action=delete&product_id={$item['product_id']}"; ?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                </tbody>
                            <?php } ?>
                        </table>
                    <?php }
                    ?>
                    <nav aria-label="Page navigation example">
                        <?php
                        echo get_pagging($num_page, $page, "?mod=product&action=search");
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