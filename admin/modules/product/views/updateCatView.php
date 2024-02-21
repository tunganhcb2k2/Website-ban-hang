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
                                    <label for="cat_title">Link thân thiện</label>
                                    <input class="form-control" type="text" name="friendly_url" id="friendly_url" value="<?php if (isset($friendly_url)) echo $category_info['friendly_url']; ?>">
                                    <?php echo form_error('friendly_url'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="parent_cat">Danh mục</label>
                                    <select class="form-control" id="parent_cat" name="parent_cat">
                                        <option>Chọn danh mục cha</option>
                                        <?php
                                        if (!empty($list_category)) {
                                            foreach ($list_category as $item) {

                                        ?>
                                                <option <?php if ($item['cat_id'] == $category_info['parent_id']) echo "selected='selected'" ?> value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_title'] ?></option>
                                        <?php
                                            }
                                        }

                                        ?>
                                    </select>
                                    <?php echo form_error('parent_cat'); ?>
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