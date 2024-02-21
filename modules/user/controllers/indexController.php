<?php

use GuzzleHttp\Promise\Is;

function construct()
{
    load_model('index');
}

function indexAction()
{
    load('lib', 'pagging');
    if (isset($_SESSION['user'])) {
        redirect(base_url());
    }
    $data = array();
    load_view('index', $data);

}

function loginAction()
{
    $errors = [];

    if (empty($_POST['username']) || empty($_POST['password'])) {
        if (empty($_POST['username'])) {
            $errors['username'] = 'Vui lòng nhập tên đăng nhập';
        }
        if (empty($_POST['password'])) {
            $errors['password'] = 'Vui lòng nhập mật khẩu';
        }
        $data['errors'] = $errors;
        load_view('index', $data);
        return false;
    }

    if (empty($errors)) {
        $username = $_POST['username'];
        $password = $password = md5($_POST['password']);
        $user = userLogin($username, $password);
        if (empty($user)) {
            $data['empty_user'] = true;
            load_view('index', $data);
            return false;
        }
    }

    $_SESSION['user'] = $user;

    redirect(base_url());
}

function registerAction()
{
    $errors = array();
    $data = array();

    if(!empty($_POST['fullname'])) {
        $data['fullname'] = $_POST['fullname'];
    } else {
        $errors['fullname']= "Vui lòng nhập họ và tên";
    }

    if(isset($_POST['email'])&& filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
    {
        $data['email'] = $_POST['email'];
        $userEmail = getUserByEmail($data['email']);

        if ($userEmail) {
            $errors['email']= "Email đã tồn tại";
        }
    }
    else
    {
        $errors['email']= "Vui lòng nhập vào email";
    }

    if(!empty($_POST['username'])) {
        $data['username'] = $_POST['username'];
        $user = getUserByUserName($data['username']);
        if ($user) {
            $errors['isset_username']= "Tên đăng nhập đã tồn tại";
        }
    } else {
        $errors['username']= "Vui lòng nhập tên đăng nhập";
    }

    if(!empty($_POST['password'])) {
        $data['password'] = md5($_POST['password']);
    } else {
        $errors['password']= "Vui lòng nhập mật khẩu";
    }

    if(!empty($_POST['address'])) {
        $data['address'] = $_POST['address'];
    } else {
        $errors['address']= "Vui lòng nhập địa chỉ của bạn";
    }

    if(!empty($_POST['phone'])) {
        $data['phone'] = $_POST['phone'];
    } else {
        $errors['phone']= "Vui lòng nhập số điện thoại";
    }

    if (!empty($errors)) {
        $data['error_register'] = $errors;
        $data['value'] = $data;
        load_view('index', $data);
        return false;
    }
    $result = db_insert("`tbl_users`", $data);
    if ($result) {
        $user = getUserByUserName($data['username']);

        $_SESSION['user'] = $user;

        redirect(base_url());
        return true;
    } else {
        $errors['register_error'] = "Đã sảy ra lỗi không thể đăng ký tài khoản";
        $data['error_register'] = $errors;
        $data['value'] = [];
        load_view('index', $data);
        return false;
    }

}
function infoUserAction()
{
    $user = $_SESSION['user'];
}
function logoutAction()
{
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }
    redirect(base_url());
}