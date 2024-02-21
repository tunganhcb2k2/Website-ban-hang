<?php
// Lấy danh sách danh mục 
function get_list_category()
{
    return db_fetch_array("select *, IF( EXISTS(
        SELECT *
        FROM `tbl_category` `B`
        WHERE `B`.`parent_id` = `A`.`cat_id` ), 1, 0) is_child from `tbl_category` `A`;");
}

//Lấy danh sách sản phẩm thuộc danh mục của id
function get_list_product_by_cat_id($id)
{
    return db_fetch_array("
    select * from `tbl_product` join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `tbl_product` .`status`='public' AND `tbl_category`.`cat_id` =  {$id} OR `tbl_category`.`parent_id` = {$id}");
}

//lấy số lượng sản phẩm trong product
function get_number_product()
{
    $number = db_num_rows("select * from `tbl_product` where `status`='public'");
    if ($number > 0)
        return $number;
    return 0;
}
//lấy số lượng sản phẩm trong product trong từng danh mục
function get_number_product_in_category($cat_id)
{
    $number = db_num_rows("select * from `tbl_product` where `cat_id` = {$cat_id} AND `status` ='public'");
    if ($number > 0)
        return $number;
    return 0;
}
// Lấy thông tin tên danh mục theo cat_id
function get_info_category_by_cat_id($cat_id)
{
    return db_fetch_row("select `cat_title` from `tbl_category` where `cat_id` = {$cat_id}");
}
// Lấy thông tin sản phẩm theo id
function get_info_product_by_id($product_id)
{
    return db_fetch_row("select * from `tbl_product` join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `product_id` = {$product_id}");
}
// Lấy danh sách ảnh chi tiết sản phẩm theo id
function get_list_image_product_by_id($product_id)
{
    return db_fetch_array("select * from `tbl_product_image` where `product_id` = {$product_id}");
}

// Lấy danh sách sản phẩm
function get_list_product()
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category` on `tbl_product`.`cat_id` = `tbl_category`.`cat_id` where `status`='public'");
}

// Lấy danh sách sản phẩm theo keyword cần tìm kiếm
function get_list_product_by_key_word($q)
{
    return db_fetch_array("select * from `tbl_product` where `product_name` like '%{$q}%' and `status`='public'");
}

//lọc sản phẩm
function get_list_product_filter_product_name_az($cat_id)
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `tbl_category`.`cat_id` =  {$cat_id} OR `tbl_category`.`parent_id` = {$cat_id} order by `product_name`");
}
function get_list_product_filter_product_name_za($cat_id)
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `tbl_category`.`cat_id` =  {$cat_id} OR `tbl_category`.`parent_id` = {$cat_id} order by `product_name` desc");
}
function get_list_product_filter_price_asc($cat_id)
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `tbl_category`.`cat_id` =  {$cat_id} OR `tbl_category`.`parent_id` = {$cat_id} order by `original_price`");
}
function get_list_product_filter_price_desc($cat_id)
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `tbl_category`.`cat_id` =  {$cat_id} OR `tbl_category`.`parent_id` = {$cat_id} order by `original_price` desc");
}
function get_list_ads_by_status()
{
    $result = db_fetch_array("select * from `tbl_ads` where `status`='public'");
    return $result;
}
