<?php
//trả về true nếu đã login
function is_login()
{
    if (isset($_SESSION['is_login']))
        return true;
    return false;
}
//trả về username của người login
function user_login()
{
    if (!empty($_SESSION['user_login']))
        return $_SESSION['user_login'];
    return false;
}
function info_user($field = "username")
{
    if (is_login()) {
        $user = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$_SESSION['user_login']}' ");
        if ($user > 0) {
            $user_item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$_SESSION['user_login']}'");
            if (array_key_exists($field, $user_item)) {
                return $user_item[$field];
            }
        }
    }
}
// Lấy họ và tên bởi username đăng nhập 
function get_fullname_by_username($username){
    $item = db_fetch_row("select * from `tbl_users` where `username` = '{$username}'");
    return $item['fullname'];
}