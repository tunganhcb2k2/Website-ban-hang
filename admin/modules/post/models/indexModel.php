<?php

// Thêm bài viết vào database
function add_post($data)
{
    db_insert("tbl_post", $data);
}
// Lấy số lượng user trong hệ thống
function get_number_post()
{
    $number = db_num_rows("select * from `tbl_post`");
    if ($number > 0) {
        return $number;
    }
    return 0;
}
// Lấy danh sách bài viết
function get_list_post($start = 1, $num_per_page = 5)
{
    return db_fetch_array("select `tbl_post`.*,`tbl_category`.`cat_title` from `tbl_post` inner join `tbl_category` on `tbl_post`.`cat_id` =  `tbl_category`.`cat_id` LIMIT {$start},{$num_per_page}");
}
//Lấy thông tin bài biết by id
function get_info_post_by_id($post_id)
{
    return db_fetch_row("select * from `tbl_post` where `post_id` = {$post_id}");
}

//Lấy thông tin bài biết by id
function get_info_post($field, $post_id)
{
    $info_post_id = db_fetch_row("select `$field` from `tbl_post` where `post_id` = '{$post_id}'");
    return  $info_post_id[$field];
}
// Cập nhật bài viết theo id
function update_post($post_id, $data)
{
    db_update('tbl_post', $data, "`post_id`= {$post_id}");
}

// Xóa bài viết theo id
function delete_post_by_id($post_id)
{
    db_delete("tbl_post", "`post_id` = {$post_id}");
}
//kiểm tra xem slug có tồn tại trước đó kh
function slug_url_exists($slug_url)
{
    $check = db_num_rows("select * from `tbl_post` where `post_url` = '{$slug_url}'");
    if ($check > 0) return true;
    return false;
}
//kiểm tra xem title có tồn tại trước đó kh
function check_name_post_exists($post_title)
{
    $check = db_num_rows("select * from `tbl_post` where `post_title` = '{$post_title}'");
    if ($check > 0) return true;
    return false;
}
function get_status($table, $field)
{

    $item = db_num_rows("select * from `{$table}` where `status` = '{$field}'");
    return $item;
}
///tìm kiếm bài viết
function searchPost($key)
{
    return db_fetch_array("select `tbl_post`.*,`tbl_category`.`cat_title` from `tbl_post` inner join `tbl_category` on `tbl_post`.`cat_id` =  `tbl_category`.`cat_id` WHERE `post_title` LIKE '%$key%'");
}

//số lượng bài viết khi tìm được
function get_number_post_search($key)
{
    $number = db_num_rows("SELECT `tbl_post`.*,`tbl_category`.`cat_title` FROM `tbl_post` inner join `tbl_category` on `tbl_post`.`cat_id` =  `tbl_category`.`cat_id` WHERE `post_title` LIKE '%$key%'");
    if ($number > 0) {
        return $number;
    }
    return 0;
}
// Lấy danh sách bài viết tìm kiếm cộng với phân trang
function get_list_post_search($key, $start = 1, $num_per_page = 2)
{
    return db_fetch_array("select `tbl_post`.*,`tbl_category`.`cat_title` from `tbl_post` inner join `tbl_category` on `tbl_post`.`cat_id` =  `tbl_category`.`cat_id` WHERE `post_title` LIKE '%$key%' LIMIT {$start},{$num_per_page}");
}
//cập nhật status cho trang bài viết
function update_status($data_status, $list_post_id)
{

    return db_update("tbl_post", $data_status, "`post_id` IN ({$list_post_id})");
}
