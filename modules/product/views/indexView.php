<?php
get_header();
?>

<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Điện thoại</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <?php echo $total_row ?> sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3"> Giá thấp lên cao</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php if (!empty($list_product)) { ?>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_product as $item) {
                                if ($item['cat_id'] == 5 || $item['parent_id'] == 1) {
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
        <?php get_sidebar('product'); ?>
    </div>
</div>
<?php
get_footer();
?>