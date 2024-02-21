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
                                    <input class="form-control" type="text" name="cat_title" id="cat_title">
                                    <?php echo form_error('cat_title'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="friendly_url">Link thân thiện</label>
                                    <input class="form-control" type="text" name="friendly_url" id="friendly_url">
                                    <?php echo form_error('friendly_url'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="parent_cat">Danh mục cha</label>
                                    <select class="form-control" id="parent_cat" name="parent_cat">
                                        <option>Chọn danh mục</option>
                                        <?php
                                        if (!empty($list_category)) {
                                            foreach ($list_category as $item) {
                                                if ($item['parent_id'] == 0) {
                                        ?>
                                                    <option value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_title'] ?></option>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="btn_add">Thêm mới</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('post_content', {
        filebrowserBrowseUrl: 'public/plugins/ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'public/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
</script>
<?php
get_footer();
?>