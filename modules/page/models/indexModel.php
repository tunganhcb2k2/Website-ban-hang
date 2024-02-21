<?php

// Lấy danh sách sản phẩm
function get_list_product()
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category`
        on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`");
}
//lấy page
function get_list_page()
{
    $list_page = db_fetch_array("select * from `tbl_pages`");
    return $list_page;
}
// Lấy thông tin trang theo id
function get_info_page_by_id($page_id)
{
    return db_fetch_row("select * from `tbl_pages` where `page_id` = {$page_id}");
}
function get_list_ads_by_status()
{
    $result = db_fetch_array("select * from `tbl_ads` where `status`='public'");
    return $result;
}
// Lấy danh sách danh mục 
function get_list_category()
{
    return db_fetch_array("select *, IF( EXISTS(
        SELECT *
        FROM `tbl_category` `B`
        WHERE `B`.`parent_id` = `A`.`cat_id` ), 1, 0) is_child from `tbl_category` `A`;");
}