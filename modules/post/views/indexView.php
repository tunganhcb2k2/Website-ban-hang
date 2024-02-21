<?php get_header() ?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="mod=post" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        foreach ($list_post as $item) {
                        ?>
                            <li class="clearfix">
                                <a href="?mod=post&action=detail&post_id=<?php echo $item['post_id']; ?>" title="" class="thumb fl-left">
                                    <img src="admin/<?php echo $item['post_thumb'] ?>" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?mod=post&action=detail&post_id=<?php echo $item['post_id']; ?>" title="" class="title"><?php echo $item['post_title'] ?></a>
                                    <span class="create-date"><?php if (!empty($item['update_at'])) {
                                                                    echo date('d/m/Y', $item['update_at']);
                                                                } else
                                                                    echo date('d/m/Y', $item['created_at']); ?></span>
                                    <span class="creator"><?php echo $item['creator'] ?></span>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <?php echo get_pagging($num_page, $page, "?mod=post") ?>

                </div>
            </div>
        </div>
        <?php get_sidebar('blog') ?>
    </div>
</div>
<?php get_footer() ?>