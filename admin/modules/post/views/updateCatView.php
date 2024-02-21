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
                <div class="col-4">
                    <div class="card">
                        <div class="card-header font-weight-bold">
                            Thêm danh mục
                        </div>
                        <div class="card-body">
                            <?php
                            echo form_success('cat');
                            ?>
                            <form method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Tên danh mục</label>
                                    <input class="form-control" type="text" name="cat_title" id="cat_title" value="<?php if (isset($category_info)) echo $category_info['cat_title']; ?>">
                                    <?php echo form_error('cat_title'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="friendly_url">Link thân thiện</label>
                                    <input class="form-control" type="text" name="friendly_url" id="friendly_url">
                                    <?php echo form_error('friendly_url'); ?>
                                </div>
                                <button type="submit" class="btn btn-primary" name="btn_update">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>