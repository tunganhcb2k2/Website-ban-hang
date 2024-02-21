<?php
function check_email($email)
{
    $check = db_num_rows("select * from `tbl_users` where `email` = '{$email}'");
    if ($check > 0) 
        return true;
    return false;
}


// Kiểm tra đăng nhập
function check_login($username, $password)
{
    $num = db_num_rows("select * from `tbl_users` where `username` = '{$username}' and `password` = '{$password}'");
    if ($num > 0) 
        return true;
    return false;
}
// tìm kiếm thành Viên
function searchMember($key)
{
    return db_fetch_array("select * from `tbl_users` WHERE `user_id` LIKE '%$key%' OR `fullname` LIKE '%$key%' OR `email` LIKE '%$key%' OR `username` LIKE '%$key%'");
}
// Lấy username bằng user_id
function get_username_by_user_id($user_id)
{
    $item = db_fetch_row("select * from `tbl_users` where `user_id` = {$user_id}");
    return $item['username'];
}

// Lấy thông tin user
function get_user_by_username($username)
{
    $item = db_fetch_row("select * from `tbl_users` where `username` = '{$username}'");
    return $item;
}

// Lấy thông tin user bằng user_id
function get_user_by_userid($user_id)
{
    $item = db_fetch_row("select * from `tbl_users`where `user_id` = {$user_id}");
    return $item;
}

// Cập nhập thông tin tài khoản với username đang đăng nhập
function update_info_user($username, $data)
{
    db_update("tbl_users", $data, "`username` = '{$username}'");
}

// Xóa user với user_id
function delete_user_by_id($user_id)
{
    db_delete('tbl_users', "`user_id` = {$user_id}");
}

// Kiểm tra mật khẩu có trùng với mật khẩu trong database
function check_password($username, $old_pass)
{
    $check = db_num_rows("select * from `tbl_users` where `password`= '{$old_pass}' and `username` = '{$username}'");
    if ($check > 0)
        return true;
    return false;
}

// Cập nhập mật khẩu mới
function update_new_password($username, $data)
{
    db_update("tbl_users", $data, "`username` = '{$username}'");
}

// Lấy danh sách user
function get_list_user($start = 1, $num_per_page = 5)
{
    $list_user = db_fetch_array("select * from `tbl_users` LIMIT {$start},{$num_per_page}");
    return $list_user;
}
// Thêm user vào database
function add_user($data)
{
    db_insert('tbl_users', $data);
}

// Kiểm tra user đã tồn tại trong hệ thống hay chưa
function check_exists_user($username, $email)
{
    $check_user = db_num_rows("select * from `tbl_users` where `username` = '{$username}' or `email` = '{$email}' ");
    if ($check_user > 0) {
        return true;
    }
    return false;
}

// Lấy số lượng user trong hệ thống
function get_number_user()
{
    $number = db_num_rows("select * from `tbl_users`");
    if ($number > 0) {
        return $number;
    }
    return 0;
}
//cập nhật mã resetpass cho user cần khôi phục
function update_reset_token($data, $email)
{
    db_update('tbl_users', $data, "`email`='{$email}'");
}
//kiểm tra xem reset_token đã tòn tại trong database hay chưa
function check_reset_token($reset_token)
{
    $check = db_num_rows("SELECT * FROM tbl_users WHERE `reset_token` = '{$reset_token}'");
    if ($check > 0)
        return true;
    return false;
}
//cập nhật mật khẩu mới
function update_pass($data, $reset_token)
{
    db_update('tbl_users', $data, "`reset_token`='{$reset_token}'");
}