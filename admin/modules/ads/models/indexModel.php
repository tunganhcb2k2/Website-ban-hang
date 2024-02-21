<?php
//thêm ads 
function add_ads($data)
{
    $result = db_insert("`tbl_ads`", $data);
    return $result;
}
//kiểm tra xem ads có tồn tại trước đó kh
function check_name_ads_exists($ads_name)
{
    $check = db_num_rows("select * from `tbl_ads` where `ads_name` = '{$ads_name}'");
    if ($check > 0) return true;
    return false;
}

//lấy danh sách ads
function get_list_ads()
{
    $result = db_fetch_array("select * from `tbl_ads`");
    return $result;
}
//lấy số lượnng ads
function get_number_ads()
{
    $number = db_num_rows("select * from `tbl_ads`");
    if ($number > 0)
        return $number;
    return 0;
}
//lấy trạng thái status
function get_status($table, $field)
{

    $item = db_num_rows("select * from `{$table}` where `status` = '{$field}'");
    return $item;
}
//lấy thông tin ads theo id
function get_info_ads_by_id($ads_id)
{
    return db_fetch_row("select * from `tbl_ads` where `ads_id` = '{$ads_id}'");
}
//cập nhật ads theo id
function  update_ads_by_id($ads_id, $data_update)
{
    $result = db_update("tbl_ads", $data_update, "`ads_id`='{$ads_id}'");
    return $result;
}
//xoá theo ads_id
function delete_ads_by_id($ads_id)
{
    $result = db_delete("tbl_ads", "`ads_id` = '{$ads_id}'");
    return $result;
}

//cập nhật nhiều item ads
function update_status($data_status, $list_ads_id)
{
    return db_update("tbl_ads", $data_status, "`ads_id` IN({$list_ads_id})");
}
