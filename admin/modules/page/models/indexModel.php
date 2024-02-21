<?php

// Lấy thông tin danh sách trang từ database
function get_list_page()
{
    $list_page = db_fetch_array("select * from `tbl_pages`");
    return $list_page;
}
// Thêm trang mới vào database
function add_page($data)
{
    db_insert("tbl_pages", $data);
}
// Lấy thông tin trang bằng id
function get_page_by_id($id)
{
    $page = db_fetch_row("select * from `tbl_pages` where `page_id` = {$id}");
    return $page;
}
function slug_url_exists($slug_url)
{
    $check = db_num_rows("SELECT * FROM `tbl_pages` WHERE `page_url` = '{$slug_url}'");
    if ($check > 0) return true;
    return false;
}

// Cập nhật dữ liệu trang theo id
function update_page_by_id($id, $data)
{
    db_update("tbl_pages", $data, "`page_id` = {$id}");
}
//xoá page bằng theo id
function delete_page_by_id($page_id)
{
    db_delete('tbl_pages', "`page_id` = {$page_id}");
}
