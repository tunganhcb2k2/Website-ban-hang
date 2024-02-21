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
                    <h5 class="m-0 ">Danh sách sản phẩm</h5>
                    <div class="form-search form-inline">
                        <form method="POST" action="?mod=product&action=search">
                            <input type="" class="form-control form-search" name="search" placeholder="Tìm kiếm sản phẩm">
                            <input type="submit" name="btn_search" value="Tìm kiếm" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="analytic">
                        <a href="" class="text-primary">Công khai<span class="text-muted">(<?php echo $status_public ?>)</span></a>
                        <a href="" class="text-primary">Chờ duyệt<span class="text-muted">(<?php echo $status_pending ?>)</span></a>
                    </div>
                    <form class="" method="POST">
                        <div class="form-action form-inline py-3">
                            <select class="form-control mr-1" id="" name="action">
                                <option value="">Chọn</option>
                                <option value="public">Công Khai</option>
                                <option value="pending">Chờ duyệt</option>
                            </select>
                            <input type="submit" name="btn_action" value="Áp dụng" class="btn btn-primary">
                        </div>
                        <p class="text-success">Có <?php echo $total_row ?> sản phẩm trong hệ thống</p>
                        <table class="table table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input name="checkall" type="checkbox">
                                    </th>
                                    <th scope="col">STT</th>
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
                            if (!empty($list_product)) {
                                $temp = $start;
                                foreach ($list_product as $item) {
                                    $temp++;
                            ?>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="checkItem[<?php echo $item['product_id']; ?>]" value="<?php echo $item['product_id']; ?>">
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
                            <?php }
                            } ?>
                        </table>
                    </form>
                    <nav aria-label="Page navigation example">
                        <?php
                        echo get_pagging($num_page, $page, "?mod=product");
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