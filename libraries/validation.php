<?php

function is_username($username)
{
    $parttern = "/^[A-Za-z0-9.\_]{6,32}$/";
    if (preg_match($parttern, $username, $match)) {
        return true;
    }
    return false;
}

function is_password($password)
{
    $parttern = "/^([\w\.!@#$%^&*()]+){6,32}$/";
    if (preg_match($parttern, $password, $match)) {
        return true;
    }
    return false;
}
function check_role($username)
{
    $result = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $result['role'];
}

function is_phone_number($number)
{
    $parttern = "/^(03|09|08|01[2|6|8|9])+([0-9]{8})$/";
    if (preg_match($parttern, $number, $matchs)) {
        return true;
    }
    return false;
}

function is_email($email)
{
    // $parttern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    // if(preg_match($parttern,$email,$match)){
    //     return true;
    // }
    // return false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

function form_error($label_field)
{
    global $error;
    if (!empty($error[$label_field])) {
        return "<p class='error'>{$error[$label_field]}</p>";
    }
}

function form_success($label_field)
{
    global $success;
    if (!empty($success[$label_field])) {
        return "<p class='text-success'>{$success[$label_field]}</p>";
    }
}

function set_value($label_field)
{
    global $$label_field;
    if (!empty($$label_field))
        return $$label_field;
}
function is_image($file_type, $file_size)
{

    $type_allow = array('png', 'jpg', 'gif', 'jpeg');

    if (!in_array(strtolower($file_type), $type_allow)) {
        return false;
    } else {
        if ($file_size > 21000000) {
            return false;
        }
    }
    return true;
}
