<?php

// Thêm thông tin khách hàng vào database
function add_guest($data_guest){
    return db_insert("tbl_guest",$data_guest);
}

// Thêm thông tin hóa đơn
function add_order($data_order){
    return db_insert("tbl_orders",$data_order);
}

// Thêm thông tin chi tiết hóa đơn
function add_order_detail($data_order_detail){
    return db_insert("tbl_orders_detail", $data_order_detail);
}

?>