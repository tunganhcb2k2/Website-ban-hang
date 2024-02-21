<?php
get_header();
?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo $info_product['cat_title']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom" style=" max-width: 350px; max-heigh: 800px" src="admin/<?php echo $info_product['product_thumb']; ?>" data-zoom-image="admin/<?php echo $info_product['product_thumb']; ?>" />
                        </a>
                        <div id="list-thumb">
                            <a href="" data-image="admin/<?php echo $info_product['product_thumb'] ?>" data-zoom-image="admin/<?php echo $info_product['product_thumb'] ?>    ">
                                <img style="width: 70px; height: 70px; max-width: 70px; min-width: 70px" id="zoom" src="admin/<?php echo $info_product['product_thumb'] ?>" />
                            </a>
                            <?php
                            foreach ($list_product_image as $item) {
                            ?>
                                <a href="" data-image="admin/public/uploads/product/<?php echo $item['link_image'] ?>" data-zoom-image="admin/public/uploads/product/<?php echo $item['link_image'] ?>">
                                    <img style="width: 70px; height: 70px; max-width: 70px; min-width: 70px" id="zoom" src="admin/public/uploads/product/<?php echo $item['link_image'] ?>" />
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="admin/<?php echo $info_product['product_thumb']; ?>" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $info_product['product_name']; ?></h3>
                        <div class="desc">
                            <?php echo $info_product['product_desc']; ?>
                        </div>
                        <div class="num-product">
                            <p class="status">Mã sản phẩm:<?php echo $info_product['product_code'] ?> </p>
                            <p> <strong> Sản phẩm còn <?php if ($info_product['qty_product'] > 0) {
                                                            echo $info_product['qty_product'];
                                                        } else {
                                                            echo "Hết hàng";
                                                        }
                                                        ?>
                                </strong>
                            </p>
                        </div>
                        <p class="price">
                            <?php if (empty($info_product['price_sale'])) {
                                echo currency_format($info_product['original_price']);
                            } else {
                                echo currency_format($info_product['price_sale']);
                            }
                            ?>

                        </p>
                        <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                        <a href="?mod=cart&action=add&product_id=<?php echo $info_product['product_id']; ?>" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <?php echo $info_product['product_detail']
                    ?>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">

                    <ul class="list-item">
                        <?php foreach ($list_category as $item1) { ?>
                            <?php foreach ($list_product as $item) {
                                if ($item['cat_id'] == $item1['cat_id']) {
                                }
                            ?>
                                <li>
                                    <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="thumb">
                                        <img src="admin/<?php echo $item['product_thumb']; ?>">
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
                                        <a href="?mod=cart&action=add&product_id=<?php echo $item['product_id']; ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=product&action=detail&product_id=<?php echo $item['product_id']; ?>" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                        <?php }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php get_sidebar('product'); ?>
    </div>
</div>
<?php
get_footer();
?>