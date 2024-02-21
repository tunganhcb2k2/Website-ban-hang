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
                    Sửa sản phẩm
                </div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data" method="POST">
                        <?php
                        echo form_success('product');
                        ?>
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="product_name" id="product_name" value="<?php echo $info_product['product_name']; ?>">
                            <?php echo form_error('product_name'); ?>
                        </div>
                        <div class="form-group">
                            <label for="friendly_url">Link thân thiện</label>
                            <input class="form-control" type="text" name="friendly_url" id="friendly_url" value="<?php echo $info_product['product_link']; ?>">
                            <?php echo form_error('friendly_url'); ?>
                        </div>
                        <div class="form-group">
                            <label for="product_code">Mã sản phẩm</label>
                            <input class="form-control" type="text" name="product_code" id="product_code" value="<?php echo $info_product['product_code']; ?>">
                            <?php echo form_error('product_code'); ?>
                        </div>
                        <div class="form-group">
                            <label for="original_price">Giá sản phẩm</label>
                            <input class="form-control" type="text" name="original_price" id="original_price" value="<?php echo $info_product['original_price']; ?>">
                            <?php echo form_error('original_price'); ?>
                        </div>
                        <div class="form-group">
                            <label for="price_sale">Giá đang sale</label>
                            <input class="form-control" type="text" name="price_sale" id="price_sale" value="<?php echo $info_product['price_sale']; ?>">
                            <?php echo form_error('price_sale'); ?>
                        </div>
                        <div class="form-group">
                            <label for="product_desc">Mô tả ngắn</label>
                            <textarea name="product_desc" class="form-control" id="product_desc" cols="30" rows="5"><?php echo $info_product['product_desc']; ?></textarea>
                            <?php echo form_error('product_desc'); ?>
                        </div>
                        <div class="form-group">
                            <label for="product_detail">Nội dung bài viết</label>
                            <textarea name="product_detail" class="form-control ckeditor" id="product_detail" cols="30" rows="5" value=""><?php echo $info_product['product_detail']; ?></textarea>
                            <?php echo form_error('product_detail'); ?>
                        </div>
                        <div class="form-group">
                            <label class="d-block">
                                <h6> Ảnh đại diện</h6>
                            </label>
                            <img class="w-25 d-block" src="<?php echo $info_product['product_thumb']; ?>" alt="">
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
                            <?php
                            foreach ($list_image_product as $value) {
                            ?>
                                <a href="#">
                                    <img class="w-25" src="public/uploads/product/<?php echo $value['link_image']; ?>" alt="">
                                </a>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="form-group w-25">
                            <label for="cat_id">Danh mục</label>
                            <select class="form-control " id="cat_id" name="cat_id">
                                <option>Chọn danh mục</option>
                                <?php
                                foreach ($list_category as $item) {
                                ?>
                                    <option <?php if ($info_product['cat_id'] == $item['cat_id']) echo "selected='selected'"; ?> value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_title'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty_product">Số lượng sản phẩm</label>
                            <input class="form-control w-25" type="number" min=1 max=500 name="qty_product" id="qty_product" value="<?php echo $info_product['qty_product']; ?>">
                            <?php echo form_error('qty_product'); ?>
                        </div>
                        <div class="form-group">
                            <input class="" type="checkbox" name="outstanding_product" id="outstanding_product" <?php if ($info_product['outstanding_product'] == 1) echo "checked='checked'" ?>>
                            <label for="outstanding_product">Sản phẩm nổi bật</label>
                        </div>
                        <div class="form-group">
                            <input class="" type="checkbox" name="product_selling" id="product_selling" <?php if ($info_product['product_selling'] == 1) echo "checked='checked'" ?>>
                            <label for="product_selling">Sản phẩm bán chạy</label>
                        </div>
                        <div class="form-group">
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

<script>
    CKEDITOR.replace('product_detail', {
        filebrowserBrowseUrl: 'public/js/plugins/ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
</script>
<?php
get_footer();
?>