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
                    Thêm sản phẩm
                </div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data" method="POST">
                        <?php
                        echo form_success('product');
                        ?>
                        <div class="form-group">
                            <label for="product_name">Tiêu đề bài viết</label>
                            <input class="form-control" type="text" name="product_name" id="product_name">
                            <?php echo form_error('product_name'); ?>
                        </div>
                        <div class="form-group">
                            <label for="friendly_url">Link thân thiện</label>
                            <input class="form-control" type="text" name="friendly_url" id="friendly_url">
                            <?php echo form_error('friendly_url'); ?>
                        </div>
                        <div class="form-group">
                            <label for="product_code">Mã sản phẩm</label>
                            <input class="form-control" type="text" name="product_code" id="product_code">
                            <?php echo form_error('product_code'); ?>
                        </div>
                        <div class="form-group">
                            <label for="original_price">Giá sản phẩm</label>
                            <input class="form-control" type="text" name="original_price" id="original_price">
                            <?php echo form_error('original_price'); ?>
                        </div>
                        <div class="form-group">
                            <label for="price_sale">Giá đang sale</label>
                            <input class="form-control" type="text" name="price_sale" id="price_sale">
                            <?php echo form_error('price_sale'); ?>
                        </div>
                        <div class="form-group">
                            <label for="product_desc">Mô tả ngắn</label>
                            <textarea name="product_desc" class="form-control" id="product_desc" cols="30" rows="5"></textarea>
                            <?php echo form_error('product_desc'); ?>
                        </div>
                        <div class="form-group">
                            <label for="product_detail">Nội dung bài viết</label>
                            <textarea name="product_detail" class="form-control ckeditor" id="product_detail" cols="30" rows="5"></textarea>
                            <?php echo form_error('product_detail'); ?>
                        </div>
                        <div class="form-group">
                            <label class="d-block">
                                <h6> Ảnh đại diện</h6>
                            </label>
                            <img class="form-input w-25 d-block" src="public/uploads/product/<?php if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
                                                                                    echo $_FILES['file']['name'];
                                                                                } ?>">
                            <input type="file" name="file">
                            <?php echo form_error('upload_image'); ?>
                        </div>
                        <div class="form-group">
                            <label class="d-block">
                                <h6>Hình ảnh của sản phẩm</h6>
                            </label>
                            <input type="file" name="files[]" multiple="multiple">
                            <?php echo form_error('upload_image'); ?>
                        </div>
                        <div class="form-group">
                            <label for="cat_id">Danh mục</label>
                            <select class="form-control w-25" id="cat_id" name="cat_id">
                                <option>Chọn danh mục</option>
                                <?php
                                if (!empty($list_category)) {
                                    foreach ($list_category as $item) {

                                ?>
                                        <option value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_title']; ?></option>
                                <?php
                                    }
                                }

                                ?>
                            </select>
                            <?php echo form_error('cat_id'); ?>
                        </div>
                        <div class="form-group">
                            <label for="qty_product">Số lượng sản phẩm</label>
                            <input class="form-control w-25" type="number" min=1 max=500 name="qty_product" id="qty_product">
                            <?php echo form_error('qty_product'); ?>
                        </div>
                        <div class="form-group">
                            <input class="" type="checkbox" name="outstanding_product" id="outstanding_product">
                            <label for="outstanding_product">Sản phẩm nổi bật</label>
                        </div>
                        <div class="form-group">
                            <input class="" type="checkbox" name="product_selling" id="product_selling">
                            <label for="product_selling">Sản phẩm bán chạy</label>
                        </div>
                        <div class="form-group">
                            <label for="status">Trạng Thái</label>
                            <select class="form-control w-25" id="status" name="status">
                                <option>Chọn trạng thái</option>
                                <option value="public">Công khai</option>
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
<script>
    CKEDITOR.replace('product_detail', {
        filebrowserBrowseUrl: 'public/js/plugins/ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
</script>
<?php
get_footer();
?>