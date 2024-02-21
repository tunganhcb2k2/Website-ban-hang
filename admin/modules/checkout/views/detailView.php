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
                    Chi tiết đơn hàng
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Ảnh sản phẩm</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thông tin vân chuyển</th>
                            <th scope="col">Giá trị của sản phẩm</th>
                            <!-- <th scope="col">Trạng thái</th> -->
                            <th scope="col">Địa chỉ nhận hàng</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($order_detail)) {
                            $temp = 0;
                            foreach ($order_detail as $item) {
                                $temp++;
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $temp ?></th>
                                    <td><?php echo $order_info['order_code']; ?></td>
                                    <td>
                                        <img class="img-fluid" src="<?php echo $item['product_thumb']; ?>" width="80" height="80" alt="">
                                    </td>
                                    <td><?php echo $item['product_name']; ?></td>
                                    <td><?php echo $item['qty_product']; ?></td>
                                    <td>
                                        <?php
                                        if ($order_info['payment_method'] == 0) {
                                            echo "Thanh toán tại nhà";
                                        } else {
                                            echo "Thanh toán tại cửa hàng";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo currency_format($item['price']); ?></td>


                                    <td> <?php echo $order_info['address'] ?> </td>

                                    <td> <?php echo currency_format($item['sub_total']) ?></td>
                                </tr>
                    </tbody>
            <?php }
                        }
            ?>
                </table>
                <form method="POST" action="">
                    <h6 class="title">Tình trạng đơn hàng</h6>
                    <select name="action" class="form-control w-25">
                        <option <?php if ($order_info['status'] == 0) echo "selected='selected'" ?> value="0">Đang xử lý</option>
                        <option <?php if ($order_info['status'] == 1) echo "selected='selected'" ?> value="1">Đang vận chuyển</option>
                        <option <?php if ($order_info['status'] == 2) echo "selected='selected'" ?> value="2">Thành công</option>
                        <option <?php if ($order_info['status'] == 3) echo "selected='selected'" ?> value="3">Đã hủy</option>
                    </select>
                    <input type="submit" name="btn_action" value="Áp dụng" class="btn btn-primary">
                </form>
                <?php echo form_success('order'); ?>
                <?php if ($order_info['note']) { ?>
                    <p>Ghi chú của khách hàng: <strong> <?php echo $order_info['note'] ?> </Strong></h6>

                    <?php  } ?>
                    <div class="section">
                        <h5 class="section-title">Giá trị đơn hàng</h5>
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                <li class="page-item">
                                    <span class="total-fee">Tổng số lượng :</span>
                                    <span class=""><?php echo $order_info['num_order']; ?> sản phẩm</span>
                                </li>
                                <li class="page-item">

                                    <span class="total">Tổng đơn hàng :</span>
                                    <span class="text-danger"><?php echo currency_format($order_info['total_price']); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>

        </div>
    </div>
</div>
<?php
get_footer();
?>