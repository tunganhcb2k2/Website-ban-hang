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
                    Thêm ads
                </div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data" method="POST">
                        <?php
                        echo form_success('ads');
                        ?>
                        <div class="form-group">
                            <label for="post_title">Tên ads</label>
                            <input class="form-control" type="text" name="ads_name" id="ads_name">
                            <?php echo form_error('ads_name'); ?>
                        </div>
                        <div class="form-group">
                            <label for="friendly_url">Link Ads</label>
                            <input class="form-control" type="text" name="ads_link" id="ads_link">
                            <?php echo form_error('ads_link'); ?>
                        </div>


                        <div class="form-group">
                            <label>
                                <h6> Ảnh đại ads</h6>
                            </label>
                            <p><img class="form-input w-25" src="public/uploads/ads/<?php echo $_FILES['file']['name']; ?>"></p>
                            <input type="file" name="file">
                            <?php echo form_error('upload_image'); ?>
                        </div>
                        <div class="form-group ">
                            <label for="status">Trạng Thái</label>
                            <select class="form-control w-25" id="status" name="status">
                                <option>Chọn trạng thái</option>
                                <option value="public" selected='selected'>Công khai</option>
                                <option value="pending">Chờ duyệt</option>
                            </select>
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