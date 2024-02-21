<?php
get_header();
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=cart" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <?php
            if (!empty($list_buy_cart)) { ?>
                <div class="section-detail table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list_buy_cart as $item) {
                            ?>
                                <tr>
                                    <td><?php echo $item['product_code'] ?></td>
                                    <td>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="thumb">
                                            <img src="admin/<?php echo $item['product_thumb']; ?>" alt="" style="width:300px">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="name-product"><?php echo $item['product_name']; ?></a>
                                    </td>
                                    <td><?php echo currency_format($item['original_price']); ?></td>
                                    <td>
                                    <input type="number" name="num-order" class="num-order num-order-<?php echo $item['product_id'] ?>" min="1" max="20" data-id="<?php echo $item['product_id'] ?>" value="<?php echo $item['qty']; ?>">
                                    </td>
                                    <td class="sub_total_<?php echo $item['product_id']; ?>"><?php echo currency_format($item['sub_total']) ?></td>
                                    <td>
                                        <a href="<?php echo $item['url_delete_cart'] ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span class="total"><?php echo currency_format($total_cart) ?></span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <a href="?mod=checkout" title="" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <a href="?" title="" id="buy-more">Mua tiếp</a><br />
                <a href="?mod=cart&action=deleteAll" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        <?php
            } else {
        ?>
            <div class="notification-cart">
                <span class="thumb-img">
                    <img src="public/images/cart.jpg" alt="">
                </span>
                <p>Không có sản phẩm nào trong giỏ hàng của bạn.</p>
                <a href="?">Tiếp tục mua sắp</a>
            </div>
        <?php      } ?>
        </div>
    </div>

</div>

<?php get_footer(); ?>