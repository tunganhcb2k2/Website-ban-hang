<?php
// Lấy ra danh sách các đơn hàng kết với bảng guest
function get_list_orders($start, $num_per_page)
{
    return db_fetch_array("select * from `tbl_orders`,`tbl_guest` where `tbl_orders`.`guest_id` = `tbl_guest`.`guest_id` LIMIT {$start},{$num_per_page}");
}
//lấy trạng thái dơn hàng
function get_status($table, $field)
{
    $item = db_num_rows("select * from `{$table}` where `status` = '{$field}'");
    return $item;
}

//Lấy tổng doanh số
function get_total_checkout()
{
    $item = db_fetch_row("select sum(`total_price`) total_checkout from `tbl_orders`");
    return $item['total_checkout'];
}
// Lấy số lượng danh sách trong hệ thống
function get_number_orders()
{
    $number = db_num_rows("select * from `tbl_orders`");
    if ($number > 0) {
        return $number;
    }
    return 0;
}
