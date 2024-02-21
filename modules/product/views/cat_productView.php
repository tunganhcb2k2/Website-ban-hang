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
                    <li>
                        <a href="" title=""><?php echo $info_category['cat_title']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left"><?php echo $info_category['cat_title']; ?></h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <?php echo $total_row; ?> sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="filter">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="4">Giá thấp lên cao</option>
                                </select>
                                <input type="submit" value="Lọc" name="btn_filter">
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                if (!empty($list_product)) {
                ?>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php
                            foreach ($list_product as $item) {
                            ?>
                                <li style="text-align: center">
                                    <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="thumb" style="display: inline-block; width: 125px; height: 125px">
                                        <img src="admin/<?php echo $item['product_thumb'] ?>">
                                    </a>
                                    <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="product-name"><?php echo $item['product_name'] ?></a>
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
                                        <a href="?mod=cart&action=add&product_id=<?php echo $item['product_id']; ?>.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <?php get_sidebar('product');  ?>
    </div>
</div>
<?php
get_footer();
?>