<?php

function construct()
{
    load_model('index');
}
function indexAction()
{
    load('lib', 'pagging');
    // Phân trang
    $num_per_page = 2;
    $total_row = get_number_user();
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    $list_user = get_list_user($start, $num_per_page);
    $data = array(
        'list_user' => $list_user,
        'start' => $start,
        'num_page' => $num_page,
        'page' => $page,
        'total_row' => $total_row
    );
    load_view('indexTeam', $data);
}
//tìm kiếm người dùng
function searchMemberAction()
{

    $total_row = get_number_user();
    if (isset($_POST['btn_search'])) {
        if (empty($_POST['search'])) {
            redirect();
        } else {
            $key = $_POST['search'];
            $listMember = searchMember($key);
        }
    }
    $data = array(
        'listMember' => $listMember,
        'total_row' => $total_row
    );
    load_view('searchMember', $data);
}
// Thêm user
function addMemberAction()
{
    global $error, $success, $fullname, $username, $password, $email;
    if (isset($_POST['btn_add'])) {
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống fullname";
        } else {
            $fullname = $_POST['fullname'];
        }
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
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Nhập email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }
        if (empty($error)) {
            if (check_exists_user($username, $email)) {
                $error['account'] = "Tên đăng nhập hoặc email đã tồn tại trong hệ thống";
            } else {
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'permission' => 'admin',
                    'created_date' => time()
                );
                add_user($data);
                $success['account'] = "Thêm thành công";
            }
        }
    }

    load_view('add');
}

// sửa thông tin người dùng
function updateAction()
{
    $user_id = (int)$_GET['user_id'];
    global $error, $fullname, $success, $email, $username;
    if (isset($_POST['btn_update'])) {
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống fullname";
        } else {
            $fullname = $_POST['fullname'];
        }
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống username";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Nhập username không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Nhập email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }
        if (empty($error)) {
            $data = array(
                'fullname' => $fullname,
                'email' => $email,
                'username' => $username
            );
            $username = get_username_by_user_id($user_id);
            update_info_user($username, $data);
            $success['account'] = "Cập nhật tài khoản thành công";
        }
    }

    $info_user = get_user_by_userid($user_id);
    $data = array(
        'info_user' => $info_user,
        'user_id' => $user_id
    );
    load_view('update', $data);
}

// Xóa user
function deleteAction()
{
    $user_id = (int) $_GET['user_id'];
    delete_user_by_id($user_id);
    redirect("?mod=users&controller=team");
}
// Đổi mật khẩu trong danh sách người dùng
function resetAction()
{
    $user_id = (int)$_GET['user_id'];
    global $error, $password, $success, $username;
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
                $username = get_username_by_user_id($user_id);
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
