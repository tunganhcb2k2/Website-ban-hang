<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load_view('index');
}
//thông tin mod
function inforAction()
{
    $user =   user_login();
    $data['user'] = get_user_by_username($user);

    load_view('infor', $data);
}
// Đăng nhập 
function loginAction()
{
    global $username, $password, $error;
    if (isset($_POST['btn_login'])) {
        $error = array();
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống username";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Nhập username không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống password";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Nhập password không đúng định dạng";
            } else {
                $password = MD5($_POST['password']);
            }
        }
        if (empty($error)) {
            if (check_login($username, $password)) {
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                if (isset($_POST['remember_me'])) {
                    setcookie('is_login', true, time() + 36000);
                    setcookie('user_login', $username, time() + 36000);
                }
                //thông báo
                redirect('?');
            } else {
                $error['account'] = "Tài khoản hoặc mật khẩu không đúng";
            }
        }
    }
    load_view('login');
}


// Đăng xuất
function logoutAction()
{
    setcookie('is_login', true, time() - 3600);
    setcookie('user_login', $_COOKIE['user_login'], time() - 3600);
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}
//quên mật khẩu của admin ở trang login
function lostPassAction()
{
    load('lib', 'email');
    global $error, $fullname, $success, $email, $username;
    $reset_token = !empty($_GET['reset_token']) ? $_GET['reset_token'] : "";
    if (!empty($reset_token)) {
        if (check_reset_token($reset_token)) {
            if (isset($_POST['btn_newPass'])) {
                $error = array();
                if (empty($_POST['password'])) {
                    $error['password'] = "Bạn chưa nhập mật khẩu";
                } else {
                    if (!(is_password($_POST['password']))) {
                        $error['password'] = "Password không đúng định dạng";
                    } else
                        $password = md5($_POST['password']);
                }
                if (empty($_POST['confirm_pass'])) {
                    $error['confirm_pass'] = "Bạn chưa nhập mật khẩu";
                } else {
                    if (!(is_password($_POST['confirm_pass']))) {
                        $error['confirm_pass'] = "Password không đúng định dạng";
                    } else
                    if (md5($_POST['confirm_pass']) == $password) {
                        $confirm_pass = md5($_POST['confirm_pass']);
                    } else {
                        $error['confirm_pass'] = "Password không giống nhau";
                    }
                }
                if (empty($error)) {
                    $data = array(
                        'password' => $confirm_pass
                    );
                    update_pass($data, $reset_token);
                    redirect("?mod=users&action=login");
                }
            }
            load_view('newPass');
        } else {
            echo "yêu cầu lấy lại mật khẩu không hợp lệ";
        }
    } else {
        if (isset($_POST['lostPass'])) {
            $error = array();
            if (empty($_POST['email'])) {
                $error['email'] = "Bạn chưa nhập email";
            } else {
                if (!(is_email($_POST['email']))) {
                    $error['email'] = "email không đúng định dạng";
                } else {
                    $email = $_POST['email'];
                }
            }
            if (empty($error)) {
                if (check_email($email)) {
                    $reset_token = MD5($email . time());
                    $data = array(
                        'reset_token' => $reset_token,
                    );
                    //cập nhật mã resetpass cho user cần khôi phục
                    update_reset_token($data, $email);
                    //gửi link khôi phục
                    $link_reset = base_url("?mod=users&action=lostPass&reset_token={$reset_token}");
                    $content = "
                    <p>Chào Bạn</p>
                    <p>Bạn vui lòng click vào đường link này để lấy lại mật khẩu:{$link_reset} </p>
                    <p>Nếu không phải bạn yêu cầu,hãy bỏ qua email này</p>
                    <strong>Team support Apple</strong>";
                    send_mail($email, '', "Khôi phục mật khẩu", $content);
                } else {
                    $error['account'] = "email không tồn tại";
                }
            }
        }
        load_view('lostPass');
    }
}
function resetAction()
{
    global $error, $success, $username;
    if (isset($_POST['btn_update'])) {
        $error = array();
        $success = array();
        if (empty($_POST['old_pass'])) {
            $error['old_pass'] = "Không được để trống password";
        } else {
            if (!is_password($_POST['old_pass'])) {
                $error['old_pass'] = "Nhập password không đúng định dạng";
            } else {
                $old_pass = MD5($_POST['old_pass']);
                $username = $_SESSION['user_login'];
                if (!check_password($username, $old_pass)) {
                    $error['old_pass'] = "Mật khẩu không chính xác";
                }
            }
        }
        if (empty($_POST['pass_new'])) {
            $error['pass_new'] = "Không được để trống password";
        } else {
            if (!is_password($_POST['pass_new'])) {
                $error['pass_new'] = "Nhập password không đúng định dạng";
            } else {
                $pass_new = MD5($_POST['pass_new']);
            }
        }
        if (empty($_POST['confirm_pass'])) {
            $error['confirm_pass'] = "Không được để trống password";
        } else {
            if (!is_password($_POST['confirm_pass'])) {
                $error['confirm_pass'] = "Nhập password không đúng định dạng";
            } else {
                if (MD5($_POST['confirm_pass']) == $pass_new) {
                    $confirm_pass = MD5($_POST['confirm_pass']);
                } else {
                    $error['confirm_pass'] = "Mật khẩu không trùng nhau";
                }
            }
        }
        if (empty($error)) {
            $data = array(
                'password' => $confirm_pass
            );
            update_new_password($username, $data);
            $success['account'] = "Thay đổi mật khẩu thành công";
        }
    }

    load_view('reset');
}
