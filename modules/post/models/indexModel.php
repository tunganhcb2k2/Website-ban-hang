<?php

// Lấy danh sách sản phẩm cho phần sidebar
function get_list_product()
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category`
        on `tbl_product`.`cat_id` = `tbl_category`.`cat_id` where `status`='public'");
}

// Lấy danh sách bài viết
function get_list_post($start, $num_per_page)
{
    return db_fetch_array("select * from `tbl_post` where `status`='public' LIMIT {$start},{$num_per_page}");
}
// Lấy số lượng bài viết trong hệ thống để làm phân trang
function get_number_post()
{
    $number = db_num_rows("select * from `tbl_post` where `status` ='public'");
    if ($number > 0) {
        return $number;
    }
    return 0;
}

// Lấy thông tin bài viết theo id
function get_info_post_by_id($post_id)
{
    return db_fetch_row("select * from `tbl_post` where `post_id` = {$post_id}");
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