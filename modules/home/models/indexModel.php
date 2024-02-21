<?php
// Lấy danh sách sản phẩm theo trạng thái
function get_list_product()
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category` on `tbl_product`.`cat_id` = `tbl_category`.`cat_id` where `status`='public'");
}
// Lấy danh sách danh mục 
function get_list_category()
{
    return db_fetch_array("select *, IF( EXISTS(
        SELECT *
        FROM `tbl_category` `B`
        WHERE `B`.`parent_id` = `A`.`cat_id` ), 1, 0) is_child from `tbl_category` `A`;");
}

//lấy silider theo trạng thái
function get_list_slider_by_status()
{
    $result = db_fetch_array("select * from `tbl_slider` where `status`='public' order by `number_order` asc ");
    return $result;
}
// lấy danh sách ads theo trạng thái
function get_list_ads_by_status()
{
    $result = db_fetch_array("select * from `tbl_ads` where `status`='public'");
    return $result;
}
// Lấy danh sách sản phẩm theo keyword cần tìm kiếm
function get_list_product_by_key_word($key)
{
    return db_fetch_array("select * from `tbl_product` where `product_name` like '%{$key}%'");
}
