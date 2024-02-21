<?php
//thêm slider 
function add_slider($data)
{
    $result = db_insert("`tbl_slider`", $data);
    return $result;
}
//kiểm tra link thân thiện đã có hay chưua
function slug_url_exists($slug_url)
{
    $check = db_num_rows("select * from `tbl_slider` where `slider_link` = '{$slug_url}'");
    if ($check > 0) return true;
    return false;
}
//kiểm tra xem slider có tồn tại trước đó kh
function check_name_slider_exists($slider_name)
{
    $check = db_num_rows("select * from `tbl_slider` where `slider_name` = '{$slider_name}'");
    if ($check > 0) return true;
    return false;
}
//kiểm tra xem slider có tồn tại trước đó kh
function check_number_order($number_order)
{
    $check = db_num_rows("select * from `tbl_slider` where `number_order` = '{$number_order}'");
    if ($check > 0) return true;
    return false;
}
//lấy danh sách slider
function get_list_slider()
{
    $result = db_fetch_array("select * from `tbl_slider`");
    return $result;
}
//lấy số lượnng slider
function get_number_slider()
{
    $number = db_num_rows("select * from `tbl_slider`");
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
//lấy thông tin slider theo id
function get_info_slider_by_id($slider_id)
{
    return db_fetch_row("select * from `tbl_slider` where `slider_id` = '{$slider_id}'");
}
//cập nhật slider theo id
function update_slider_by_id($slider_id, $data_update)
{
    $result = db_update("tbl_slider", $data_update, "`slider_id`='{$slider_id}'");
    return $result;
}
//xoá theo slider_id
function delete_slider_by_id($slider_id)
{
    $result = db_delete("tbl_slider", "`slider_id` = '{$slider_id}'");
    return $result;
}
//cập nhật nhiều item slider
function update_status($data_status, $list_slider_id)
{
    return db_update("tbl_slider", $data_status, "`slider_id` IN({$list_slider_id})");
}
