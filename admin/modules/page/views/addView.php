<?php
get_header();

?>
<div id="page-body" class="d-flex">
    <?php
    get_sidebar();
    ?>
    <div id="wp-content">
        <div class="container-fluid py-5">
            <div class="card">
                <div class="card-header font-weight-bold ">
                    <h3>Thêm trang</h3>
                </div>
                <div class="card-body">
                    <?php echo form_success('page'); ?>
                    <form method="POST">
                        <div class="form-group">
                            <label for="page_title" class="font-weight-bold">Tiêu đề trang</label>
                            <input class="form-control" type="text" name="page_title" id="page_title">
                            <?php echo form_error('page_title'); ?>
                        </div>
                        <div class="form-group">
                            <label for="friendly_url" class="font-weight-bold">Link thân thiện</label>
                            <input class="form-control" type="text" name="friendly_url" id="friendly_url">
                            <?php echo form_error('friendly_url'); ?>
                        </div>
                        <div class="form-group">
                            <label for="page_content" class="font-weight-bold">Mô tả</label>
                            <textarea name="page_content" class="form-control ckeditor" id="page_content" cols="30" rows="5"></textarea>
                            <?php echo form_error('page_content'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary" name="btn_add">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>