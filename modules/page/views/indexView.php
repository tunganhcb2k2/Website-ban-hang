<?php
get_header();
?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Trang</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $info_page['page_title']; ?></h3>
                </div>
                <div class="section-detail">
                    <span class="create-date">
                        <?php if (!empty($info_page['updated_at'])) {
                            echo date('d/m/Y', $info_page['updated_at']);
                        } else
                            echo date('d/m/Y', $info_page['created_date']); ?>
                    </span>
                    <span class="creator"><?php echo $info_page['creator'] ?></span>
                    <div class="detail">
                        <?php echo $info_page['content'] ?>
                    </div>
                </div>
            </div>
        </div>

        <?php get_sidebar('blog'); ?>
    </div>
</div>
<?php
get_footer();
?>