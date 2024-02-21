<?php
// Lấy ra danh sách các đơn hàng kết với bảng guest
function get_list_orders($start, $num_per_page)
{
    return db_fetch_array("select * from `tbl_orders`,`tbl_guest` where `tbl_orders`.`guest_id` = `tbl_guest`.`guest_id` LIMIT {$start},{$num_per_page}");
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
// Lấy ra danh sách đơn hàng theo keyword tìm kiếm kết với bảng guest
function get_list_order_by_keyword($keyword)
{
    return db_fetch_array("
    select * from `tbl_orders` 
    inner join `tbl_guest`  on `tbl_orders`.`guest_id` = `tbl_guest`.`guest_id` 
    where `tbl_guest`.`fullname` LIKE '%{$keyword}%' 
    OR CAST(`tbl_orders`.`order_id` AS varchar(50)) like '%{$keyword}%'");
}
function get_status($table, $field)
{
    $item = db_num_rows("select * from `{$table}` where `status` = '{$field}'");
    return $item;
}


// Lấy ra danh sách các đơn hàng kết với bảng tbl_orders_detail
function get_info_order_detail()
{
    return db_fetch_array("select * from `tbl_orders_detail`,`tbl_product` where `tbl_orders_detail`.`product_id` = `tbl_product`.`product_id`");
}

// Lấy thông tin khách hàng theo guest_id
function get_info_guest_by_guest_id($guest_id)
{
    return db_fetch_row("select * from `tbl_guest` where `guest_id` = {$guest_id}");
}
// Lấy thông tin đơn hàng theo id
function get_info_order_by_order_id($order_id)
{
    return db_fetch_row("select * from `tbl_orders` inner join `tbl_guest` 
    on `tbl_orders`.`guest_id`=`tbl_guest`.`guest_id` 
    where `order_id` = {$order_id}");
}

// Lấy danh sách các chi tiết hóa đơn theo order_id kết với bảng product
function get_order_detail_by_order_id($order_id)
{
    return db_fetch_array("select `tbl_orders_detail`.*,`tbl_product`.`product_thumb`,`tbl_product`.`product_name`
     from `tbl_orders_detail`, `tbl_product` where `order_id` = {$order_id} and `tbl_orders_detail`.`product_id` = `tbl_product`.`product_id`");
}

function update_status($order_id, $data_status)
{
    return db_update("tbl_orders", $data_status, "`order_id`= '{$order_id}'");
}
function delete_checkout($order_id)
{
    return db_delete("tbl_orders", $order_id);
}
