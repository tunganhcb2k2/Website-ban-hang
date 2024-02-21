<?php
function construct()
{
    load_model('index');
}
function indexAction()
{
    //cập nhậ trạng thái của ads
    if (isset($_POST['btn_action'])) {
        if (isset($_POST['checkItem'])) {
            $list_ads_id = implode(",", $_POST['checkItem']);
        }
        $action = $_POST['action'];
        if ($action == 'public') {
            $status_public = 'public';
            $data_status = array(
                'status' => $status_public,
            );
            update_status($data_status, $list_ads_id);
        }
        if ($action == 'pending') {
            $status_pending = 'pending';
            $data_status = array(
                'status' => $status_pending,
            );
            update_status($data_status, $list_ads_id);
        }
    }
    //
    $total_row = get_number_ads();
    $list_ads = get_list_ads();
    $status_public = get_status('tbl_ads', 'public');
    $status_pending = get_status('tbl_ads', 'pending');
    $data = array(
        'total_row' => $total_row,
        'list_ads' => $list_ads,
        'status_public' => $status_public,
        'status_pending' => $status_pending,
    );
    load_view('index', $data);
}
function addAction()
{
    global $error, $success;
    if (isset($_POST['btn_add'])) {
        $error = array();
        $success = array();
        if (empty($_POST['ads_name'])) {
            $error['ads_name'] = "Bạn chưa nhập tên ads";
        } else {
            if (check_name_ads_exists($_POST['ads_name'])) {
                $error['ads_name'] = "Tên ads đã tồn tại";
            } else {
                $ads_name = $_POST['ads_name'];
            }
        }
        if (empty($_POST['ads_link'])) {
            $error['ads_link'] = "Bạn chưa nhập link ads";
        } else {
            $ads_link = ($_POST['ads_link']);
        }
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            }
        } else {
            $error['upload_image'] = "Bạn chưa upload tệp";
        }
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }
        if (empty($error)) {
            $fullname = get_fullname_by_username(user_login());
            $ads_thumb = upload_image("public/uploads/slider/ads", $type);
            $data = array(
                'ads_name' => $ads_name,
                'ads_link' => $ads_link,
                'status' => $status,
                'ads_thumb' => $ads_thumb,
                'creator' => $fullname,
                'created_at' => time(),
            );
            add_ads($data);
            $success['ads'] = "Thêm ads thành công";
        }
    }
    load_view('add');
}
function updateAction()
{
    $ads_id = (int)$_GET['ads_id'];
    $info_ads = get_info_ads_by_id($ads_id);
    global $error, $success;
    if (isset($_POST['btn_update'])) {
        $error = array();
        $success = array();
        if (empty($_POST['ads_name'])) {
            $error['ads_name'] = "Bạn chưa nhập tên ads";
        } else {
            $ads_name = $_POST['ads_name'];
        }
        if (empty($_POST['ads_link'])) {
            $error['ads_link'] = "Bạn chưa nhập ads";
        } else {
            $ads_link = $_POST['ads_link'];
        }
        // kiểm tra upload_image
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = $info_ads['ads_thumb'];
                if (!empty($old_thumb)) {
                    delete_image($old_thumb);
                    $ads_thumb = upload_image('public/uploads/slider/ads/', $type);
                } else {
                    $ads_thumb = upload_image('public/uploads/slider/ads/', $type);
                }
            }
        } else {
            $ads_thumb = $info_ads['ads_thumb'];
        }
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }
        if (empty($error)) {
            $fullname = get_fullname_by_username(user_login());
            $data_update = array(
                'ads_name' => $ads_name,
                'ads_link' => $ads_link,
                'status' => $status,
                'ads_thumb' => $ads_thumb,
                'updated_user' => $fullname,
                'updated_at' => time(),
            );
            update_ads_by_id($ads_id, $data_update);
            $success['ads'] = "Cập nhật thông tin ads thành công";
            $info_ads = $data_update;
        }
    }
    $data = array(
        'info_ads' => $info_ads,
    );
    load_view('update', $data);
}
//xoá ads
function deleteAction()
{
    $ads_id = (int)$_GET['ads_id'];
    delete_ads_by_id($ads_id);
    redirect("?mod=ads");
}
