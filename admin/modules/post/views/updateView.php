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
                <div class="card-header font-weight-bold">
                    Sửa bài viết
                </div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data" method="POST">
                        <?php
                        echo form_success('post');
                        ?>
                        <div class="form-group">
                            <label for="post_title">Tiêu đề bài viết</label>
                            <input class="form-control" type="text" name="post_title" id="post_title" value="<?php echo $info_post['post_title']; ?>">
                            <?php echo form_error('post_title'); ?>
                        </div>
                        <div class="form-group">
                            <label for="friendly_url">Link thân thiện</label>
                            <input class="form-control" type="text" name="friendly_url" id="friendly_url" value="<?php echo $info_post['post_url']; ?>">
                            <?php echo form_error('friendly_url'); ?>
                        </div>
                        <div class="form-group">
                            <label for="post_content">Nội dung bài viết</label>
                            <textarea name="post_content" class="form-control ckeditor" id="post_content" cols="30" rows="5"><?php echo $info_post['post_content']; ?></textarea>
                            <?php echo form_error('post_content'); ?>
                        </div>
                        <div class="form-group">
                            <label>
                                <h6> Ảnh đại diện</h6>
                            </label>
                            <p>
                                <img class="form-input" src="<?php echo $info_post['post_thumb']; ?>" width="220" height="320" alt="">
                            </p>
                            <input type="file" name="file" onchange="show_upload_image()">
                            <?php echo form_error('upload_image'); ?>
                        </div>
                        <div class="form-group">
                            <label for="parent_cat">Danh mục</label>
                            <select class="form-control w-25" id="parent_cat" name="parent_cat">
                                <option>Chọn danh mục</option>
                                <?php
                                if (!empty($list_category)) {
                                    foreach ($list_category as $item) {
                                        if ($item['parent_id'] == 0) {
                                ?>
                                            <option <?php if ($item['cat_id'] == $info_post['cat_id']) echo "selected='selected'"; ?> value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_title']; ?></option>
                                <?php
                                        }
                                    }
                                }

                                ?>
                            </select>
                            <?php echo form_error('parent_cat'); ?>
                        </div>
                        <div class="form-group">
                            <label for="status">Trạng Thái</label>
                            <select class="form-control w-25" id="status" name="status">
                                <option>Chọn trạng thái</option>
                                <option value="public" selected='selected'>Công khai</option>
                                <option value="pending">Chờ duyệt</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="btn_update">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('post_content', {
        filebrowserBrowseUrl: 'public/js/plugins/ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
</script>
<?php
get_footer();
?>