<?php

// Thêm sản phẩm mới
function add_product($data)
{
    return db_insert("tbl_product", $data);
}
//check tên sản phầm trùng nhau
function check_name_product_exists($product_name)
{
    $name_exists = db_num_rows("SELECT * FROM `tbl_product` WHERE `product_name` = '{$product_name}' ");
    if ($name_exists > 0) return true;
    return false;
}
//check code sản phầm trùng nhau
function check_code_product_exists($product_code)
{
    $name_exists = db_num_rows("SELECT * FROM `tbl_product` WHERE `product_code` = '{$product_code}' ");
    if ($name_exists > 0) return true;
    return false;
}
function check_name_product_link($product_link)
{
    $name_exists = db_num_rows("SELECT * FROM `tbl_product` WHERE `product_link` = '{$product_link}' ");
    if ($name_exists > 0) return true;
    return false;
}
// Lấy danh sách danh mục bài viết
function get_list_category()
{
    return db_fetch_array("SELECT `cat_0`.`cat_id`, if(`cat_1`.`cat_title` is null, `cat_0`.`cat_title` ,concat(`cat_1`.`cat_title`,' --- ',`cat_0`.`cat_title`)) `cat_title`, `cat_0`.`parent_id`,`cat_0`.`creator` 
    from `tbl_category` cat_0 
    LEFT JOIN `tbl_category` cat_1
    ON `cat_0`.`parent_id` = `cat_1`.`cat_id`");
}

// Lấy danh sách sản phẩm kết với bản category
function get_list_product($start = 1, $num_per_page = 5)
{
    return db_fetch_array("
    SELECT `tbl_product`.*,`tbl_category`.* 
    from `tbl_product` 
    inner join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id` LIMIT {$start},{$num_per_page}");
}
//lấy số lượng sản phẩm trong product
function get_number_product()
{
    $number = db_num_rows("SELECT * from `tbl_product`");
    if ($number > 0)
        return $number;
    return 0;
}
// xóa sản phẩm theo mã sản phẩm
function delete_product_by_id($product_id)
{
    db_delete("tbl_product", "`product_id` = {$product_id}");
}

// Lấy thông tin sản phẩm by product code kết với bảng category
function get_info_product_by_product_id($product_id)
{
    return db_fetch_row("SELECT * from `tbl_product` where `product_id` = {$product_id}");
}

function update_product_by_id($product_id, $data)
{
    db_update("tbl_product", $data, "`product_id` = {$product_id}");
}

// Thêm ảnh chi tiết của sản phẩm
function insert_image_product($data)
{
    db_insert("tbl_product_image", $data);
}

// Lấy danh sách ảnh chi tiết sản phẩm theo id
function get_list_image_product_by_id($id)
{
    return db_fetch_array("SELECT * from `tbl_product_image` where `product_id` = {$id}");
}
//xoá ảnh theo id
function delete_list_image_product_by_id($id)
{
    db_delete("tbl_product_image", "`product_id` = {$id}");
}
//lấy trạng thái status
function get_status($table, $field)
{

    $item = db_num_rows("SELECT * FROM `{$table}` WHERE `status` = '{$field}'");
    return $item;
}
//Lấy thông tin bài biết by id
function get_info_product($field, $product_id)
{
    $info_product_id = db_fetch_row("SELECT `$field` FROM `tbl_product` WHERE `product_id` = '{$product_id}'");
    return  $info_product_id[$field];
}
//lấy số lương sản phẩm khi tìm được
function get_number_product_search($key)
{
    $number = db_num_rows("SELECT `tbl_product`.*,`tbl_category`.* 
    from `tbl_product` 
    inner join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `tbl_product`.`product_name` like '%$key%'");
    if ($number > 0)
        return $number;
    return 0;
}
//lấy danh sách sản phẩm khi tìm được cộng với phân trang
function get_list_product_search($key, $start = 1, $num_per_page = 2)
{
    return db_fetch_array("SELECT `tbl_product`.*,`tbl_category`.* 
    from `tbl_product` 
    inner join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `tbl_product`.`product_name` like '%$key%' LIMIT {$start},{$num_per_page}");
}
//cập nhật status cho trang sản phẩm
function update_status($data_status, $list_product_id)
{

    return db_update("tbl_product", $data_status, "`product_id` IN ({$list_product_id})");
}
