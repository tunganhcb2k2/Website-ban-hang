<?php
get_header();
?>

<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php
                    foreach ($list_slider as $item) {
                    ?>
                        <div class="item">
                            <img src="admin/<?php echo $item['slider_thumb']; ?>" alt="">
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <?php
                if (!empty($list_product)) {
                ?>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php
                            foreach ($list_product as $item) {
                                if ($item['outstanding_product'] == 1) {
                            ?>
                                    <li>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="thumb">
                                            <img src="admin/<?php echo $item['product_thumb']; ?>">
                                        </a>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                        <div class="price">
                                            <span>
                                                <?php if (empty($item['price_sale'])) {
                                                    echo currency_format($item['original_price']);
                                                } else {
                                                    echo currency_format($item['price_sale']);
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="?mod=cart&action=add&product_id=<?php echo $item['product_id']; ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại</h3>
                </div>
                <?php
                if (!empty($list_product)) {
                ?>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_product as $item) {
                                if ($item['cat_id'] == 1 || $item['parent_id'] == 1) {
                            ?>
                                    <li>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="thumb">
                                            <img style="max-height:auto" src="admin/<?php echo $item['product_thumb']; ?>">
                                        </a>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                        <div class="price">
                                            <span class="new">
                                                <?php if (empty($item['price_sale'])) {
                                                    echo currency_format($item['original_price']);
                                                } else {
                                                    echo currency_format($item['price_sale']);
                                                }
                                                ?>
                                            </span>
                                            <span class="old"><?php echo currency_format($item['original_price']); ?></span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="?mod=cart&action=add&product_id=<?php echo $item['product_id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                <?php  } ?>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Máy tính</h3>
                </div>
                <?php if (!empty($list_product)) { ?>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_product as $item) {
                                if ($item['cat_id'] == 20 || $item['parent_id'] == 3) {
                            ?>
                                    <li>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="thumb">
                                            <img style="max-height:auto" src="admin/<?php echo $item['product_thumb']; ?>">
                                        </a>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                        <div class="price">
                                            <span class="new">
                                                <?php if (empty($item['price_sale'])) {
                                                    echo currency_format($item['original_price']);
                                                } else {
                                                    echo currency_format($item['price_sale']);
                                                }
                                                ?>
                                            </span>
                                            <span class="old"><?php echo currency_format($item['original_price']); ?></span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="?mod=cart&action=add&product_id=<?php echo $item['product_id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Đồng hồ</h3>
                </div>
                <?php if (!empty($list_product)) { ?>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_product as $item) {
                                if ($item['cat_id'] == 12) {
                            ?>
                                    <li>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="thumb">
                                            <img style="max-height:auto" src="admin/<?php echo $item['product_thumb']; ?>">
                                        </a>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                        <div class="price">
                                            <span class="new">
                                                <?php if (empty($item['price_sale'])) {
                                                    echo currency_format($item['original_price']);
                                                } else {
                                                    echo currency_format($item['price_sale']);
                                                }
                                                ?>
                                            </span>
                                            <span class="old"><?php echo currency_format($item['original_price']); ?></span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="?mod=cart&action=add&product_id=<?php echo $item['product_id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Tai nghe</h3>
                </div>
                <?php if (!empty($list_product)) { ?>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_product as $item) {
                                if ($item['cat_id'] == 15 || $item['parent_id'] == 14) {
                            ?>
                                    <li>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="thumb">
                                            <img style="max-height:auto" src="admin/<?php echo $item['product_thumb']; ?>">
                                        </a>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                                        <div class="price">
                                            <span class="new">
                                                <?php if (empty($item['price_sale'])) {
                                                    echo currency_format($item['original_price']);
                                                } else {
                                                    echo currency_format($item['price_sale']);
                                                }
                                                ?>
                                            </span>
                                            <span class="old"><?php echo currency_format($item['original_price']); ?></span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="?mod=cart&action=add&product_id=<?php echo $item['product_id']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php get_sidebar() ?>
    </div>
</div>
<?php
get_footer();
?>
 
