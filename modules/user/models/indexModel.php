<?php

// Lấy danh sách sản phẩm cho phần sidebar
function get_list_product()
{
    return db_fetch_array("select * from `tbl_product` join `tbl_category`
        on `tbl_product`.`cat_id` = `tbl_category`.`cat_id` where `status`='public'");
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

function userLogin($username, $password) {

    $user = db_fetch_row("select * from `tbl_users` where `username` = '{$username}' and `password` = '{$password}'");
    return $user;
}

function getUserByUserName($username)
{
    $user = db_fetch_row("select * from `tbl_users` where `username` = '{$username}'");
    return $user;
}

function getUserByEmail($email)
{
    $user = db_fetch_row("select * from `tbl_users` where `email` = '{$email}'");
    return $user;
}