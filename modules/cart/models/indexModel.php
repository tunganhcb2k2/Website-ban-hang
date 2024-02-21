<?php
// Lấy thông tin sản phẩm theo id
function get_info_product_by_id($product_id)
{
    return db_fetch_row("select * from `tbl_product` join `tbl_category` 
    on `tbl_product`.`cat_id` = `tbl_category`.`cat_id`
    where `product_id` = {$product_id}");
}
