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
                    ĐƠN HÀNG MỚI
                </div>
                <div class="form-search form-inline">
                    <form action="" method="GET">
                        <input type="hidden" name="mod" value="checkout">
                        <input type="text" class="form-control form-search text-center" name="search" placeholder="Tìm kiếm đơn hàng">
                        <input type="submit" value="Tìm kiếm" class="btn btn-primary float-right" name="btn_search">
                    </form>
                </div>

                <div class="card-body">
                    <div class="analytic">
                        <a href="" class="text-primary">Đang xử lý<span class="text-muted">(<?php echo $status_loading ?>)</span></a>
                        <a href="" class="text-primary">Đang vận chuyển<span class="text-muted">(<?php echo $status_loading_send ?>)</span></a>
                        <a href="" class="text-primary">Thành công<span class="text-muted">(<?php echo $status_success ?>)</span></a>
                        <a href="" class="text-primary">Đã huỷ<span class="text-muted">(<?php echo $status_fail ?>)</span></a>
                    </div>
                    <p class="text-success">Có <?php echo $total_row ?> đơn hàng trong hệ thống</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Khách hàng</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá trị</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($list_orders)) {
                                $temp = 0;
                                foreach ($list_orders as $item) {
                                    $temp++;
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $temp ?></th>
                                        <td><?php echo $item['order_code'] ?></td>
                                        <td>
                                            <?php echo $item['fullname'] ?>
                                        </td>
                                        <td><?php echo '0' . $item['phone_number'] ?></td>
                                        <td><?php echo $item['num_order']; ?></td>
                                        <td><?php echo currency_format($item['total_price']); ?></td>
                                        <td>
                                            <?php if ($item['status'] == 0) {
                                                echo  "<span class='badge badge-warning'> Đang xử lý</span>"; ?>
                                            <?php } else if ($item['status'] == 1) {
                                                echo  "<span class='badge badge-warning'> Đang vận chuyển</span>"; ?>
                                            <?php } else if ($item['status'] == 2) {
                                                echo  "<span class='badge badge-success'> Thành công</span>"; ?>
                                            <?php } else
                                                echo  "<span class='badge badge-danger'> Đã huỷ</span>"; ?>
                                        <td><?php echo date('d/m/Y', $item['created_at']) ?></td>
                                        <td>
                                            <a href="?mod=checkout&action=detail&order_id=<?php echo $item['order_id']; ?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="detail"><i class="fa fa-edit"></i></a>
                                            <a href="?mod=checkout&action=delete&order_id=<?php echo $item['order_id']; ?>" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                        </tbody>
                <?php }
                            }
                ?>
                    </table>
                    <nav aria-label="Page navigation example">
                        <?php echo get_pagging($num_page, $page, "?mod=checkout"); ?>
                    </nav>
                    <p class="text-success float-right"> Số lượt truy cập hôm nay:
                        <?php
                        $CountFile = "index.log";
                        $CF = fopen($CountFile, "r");
                        $Views = fread($CF, filesize($CountFile));
                        fclose($CF);
                        $Views++;

                        $CF = fopen($CountFile, "w");
                        fwrite($CF, $Views);
                        fclose($CF);
                        echo ($Views);
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>