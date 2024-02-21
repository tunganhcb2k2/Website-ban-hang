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
                    Sửa slider
                </div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data" method="POST">
                        <?php
                        echo form_success('slider');
                        ?>
                        <div class="form-group">
                            <label for="post_title">Tên slider</label>
                            <input class="form-control" type="text" name="slider_name" id="slider_name" value="<?php echo $info_slider['slider_name'] ?>">
                            <?php echo form_error('slider_name'); ?>
                        </div>
                        <div class="form-group">
                            <label for="friendly_url">Link thân thiện</label>
                            <input class="form-control" type="text" name="friendly_url" id="friendly_url" value="<?php echo $info_slider['slider_link'] ?>">
                            <?php echo form_error('friendly_url'); ?>
                        </div>


                        <div class="form-group">
                            <label>
                                <h6> Ảnh đại slider</h6>
                            </label>
                            <p><img class="form-input w-25" src="<?php echo $info_slider['slider_thumb'] ?>"></p>
                            <input type="file" name="file">
                            <?php echo form_error('upload_image'); ?>
                        </div>
                        <div class="form-group w-25">
                            <label for="number_order">Số thứ tự mà bạn mà bạn muốn chiếu</label>
                            <input class="form-control" type="number" min="1" max="5" name="number_order" id="number_order" value="<?php echo $info_slider['number_order'] ?>">
                            <?php echo form_error('number_order'); ?>
                        </div>
                        <div class="form-group ">
                            <label for="status">Trạng Thái</label>
                            <select class="form-control w-25" id="status" name="status">
                                <option>Chọn trạng thái</option>
                                <option value="public" selected='selected'>Công khai</option>
                                <option value="pending">Chờ duyệt</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="btn_update">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>