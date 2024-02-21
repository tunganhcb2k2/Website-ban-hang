<?php
function construct()
{
    load_model('index');
}
function indexAction()
{
    //TRẠNG THÁI CỦA BÀI VIẾT
    if (isset($_POST['btn_action'])) {
        if (isset($_POST['checkItem'])) {
            $list_slider_id = implode(",", $_POST['checkItem']);
        }
        // echo $post_id;
        // die();
        $action = $_POST['action'];
        if ($action == 'public') {
            $slider_public = 'public';
            $data_status = array(
                'status' => $slider_public
            );
            update_status($data_status, $list_slider_id);
        }
        if ($action == 'pending') {
            $slider_pending = 'pending';
            $data_status = array(
                'status' => $slider_pending
            );
            update_status($data_status, $list_slider_id);
        }
    }
    $total_row = get_number_slider();
    $list_slider = get_list_slider();
    $status_public = get_status('tbl_slider', 'public');
    $status_pending = get_status('tbl_slider', 'pending');
    $data = array(
        'total_row' => $total_row,
        'list_slider' => $list_slider,
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
        if (empty($_POST['slider_name'])) {
            $error['slider_name'] = "Bạn chưa nhập tên slider";
        } else {
            if (check_name_slider_exists($_POST['slider_name'])) {
                $error['slider_name'] = "Tên slider đã tồn tại";
            } else {
                $slider_name = $_POST['slider_name'];
            }
        }
        if (empty($_POST['friendly_url'])) {
            $error['friendly_url'] = "Bạn chưa nhập link thân thiện";
        } else {
            if (slug_url_exists(create_slug($_POST['friendly_url']))) {
                $error['friendly_url'] = "Link thân thiện đã tồn tại trong hệ thống";
            } else {
                $slider_link = create_slug($_POST['friendly_url']);
            }
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
        if (empty($_POST['number_order'])) {
            $error['number_order'] = "Bạn chưa chọn số thứ tự";
        } else {
            if (check_number_order($_POST['number_order'])) {
                $error['number_order'] = "Số thứ tự đã tồn tại trước đó";
            } else {
                $number_order = $_POST['number_order'];
            }
        }
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }
        if (empty($error)) {
            $fullname = get_fullname_by_username(user_login());
            $slider_thumb = upload_image("public/uploads/slider/", $type);
            $data = array(
                'slider_name' => $slider_name,
                'slider_link' => $slider_link,
                'status' => $status,
                'number_order' => $number_order,
                'slider_thumb' => $slider_thumb,
                'creator' => $fullname,
                'created_at' => time(),
            );
            add_slider($data);
            $success['slider'] = "Thêm slider thành công";
        }
    }
    load_view('add');
}
function updateAction()
{
    $slider_id = (int)$_GET['slider_id'];
    $info_slider = get_info_slider_by_id($slider_id);
    global $error, $success;
    if (isset($_POST['btn_update'])) {
        $error = array();
        $success = array();
        if (empty($_POST['slider_name'])) {
            $error['slider_name'] = "Bạn chưa nhập tên slider";
        } else {
            $slider_name = $_POST['slider_name'];
        }
        if (empty($_POST['friendly_url'])) {
            $error['friendly_url'] = "Bạn chưa nhập link thân thiện";
        } else {
            $slider_link = create_slug($_POST['friendly_url']);
        }
        // kiểm tra upload_image
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = $info_slider['slider_thumb'];
                if (!empty($old_thumb)) {
                    delete_image($old_thumb);
                    $slider_thumb = upload_image('public/uploads/slider/', $type);
                } else {
                    $slider_thumb = upload_image('public/uploads/slider/', $type);
                }
            }
        } else {
            $slider_thumb = $info_slider['slider_thumb'];
        }
        if (empty($_POST['number_order'])) {
            $error['number_order'] = "Bạn chưa chọn số thứ tự";
        } else {
            $number_order = $_POST['number_order'];
        }
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }
        if (empty($error)) {
            $fullname = get_fullname_by_username(user_login());
            $data_update = array(
                'slider_name' => $slider_name,
                'slider_link' => $slider_link,
                'status' => $status,
                'number_order' => $number_order,
                'slider_thumb' => $slider_thumb,
                'updated_user' => $fullname,
                'updated_at' => time(),
            );
            update_slider_by_id($slider_id, $data_update);
            $success['slider'] = "Cập nhật thông tin slider thành công";
            $info_slider = $data_update;
        }
    }
    $data = array(
        'info_slider' => $info_slider,
    );
    load_view('update', $data);
}
//xoá slider
function deleteAction()
{
    $slider_id = (int)$_GET['slider_id'];
    delete_slider_by_id($slider_id);

    redirect("?mod=slider");
}
