<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <?php
        if (!empty($list_category)) {
        ?>
            <div class="secion-detail">
                <ul class="list-item">
                    <?php
                    foreach ($list_category as $item) {
                        if ($item['parent_id'] == 0) {
                    ?>
                            <li>
                                <a href="?mod=product&action=cat_product&cat_id=<?php echo $item['cat_id'] ?>" title=""><?php echo $item['cat_title'] ?></a>
                                <?php
                                if ($item['is_child'] == 1) {
                                ?>
                                    <ul class="sub-menu">
                                        <?php
                                        foreach ($list_category as $item2) {
                                            //nếu paret_id == với cat_id thì show ra menu con
                                            if ($item2['parent_id'] == $item['cat_id']) {
                                        ?>
                                                <li>
                                                    <a href="?mod=product&action=cat_product&cat_id=<?php echo $item2['cat_id']; ?>" title=""><?php echo $item2['cat_title'] ?></a>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                <?php
                                }
                                ?>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        <?php
        }
        ?>
    </div>
    <?php get_template_part('ads'); ?>
</div>