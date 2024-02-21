<?php
get_header();

?>
<div id="page-body" class="d-flex">
    <?php
    get_sidebar();
    ?>
    <div id="wp-content">
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col">
                    <div class="card text-white bg-primary mb-3" style="max-width: 16rem;">
                        <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $status_success ?></h5>
                            <p class="card-text">Đơn hàng giao dịch thành công</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-danger mb-3" style="max-width: 16rem;">
                        <div class="card-header">ĐANG XỬ LÝ</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $status_loading; ?></h5>
                            <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-warning mb-3" style="max-width: 16rem;">
                        <div class="card-header">ĐANG VẬN CHUYỂN</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $status_loading_send; ?></h5>
                            <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-dark mb-3" style="max-width: 16rem;">
                        <div class="card-header">ĐƠN HÀNG HỦY</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $status_fail ?></h5>
                            <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">DOANH SỐ</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo currency_format($total_checkout) ?></h5>
                            <p class="card-text">Doanh số hệ thống</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end analytic  -->
            <div class="card">
                <div class="card-header font-weight-bold">
                    ĐƠN HÀNG MỚI
                </div>
                <div class="card-body">
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
                    </table>
                    <nav aria-label="Page navigation example">
                        <?php echo get_pagging($num_page, $page, "?"); ?>
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