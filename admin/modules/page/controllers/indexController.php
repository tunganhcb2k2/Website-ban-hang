<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $list_page = get_list_page();
    $data = array(
        'list_page' => $list_page
    );
    load_view('index', $data);
}
function addAction()
{

    global $error, $success;
    if (isset($_POST['btn_add'])) {
        if (empty($_POST['page_title'])) {
            $error['page_title'] = "Không được để trống trường tiêu đề";
        } else {
            $page_title = $_POST['page_title'];
        }
        if (empty($_POST['friendly_url'])) {
            $error['friendly_url'] = "Bạn chưa nhập link thân thiện";
        } else {
            if (slug_url_exists(create_slug($_POST['friendly_url']))) {
                $error['friendly_url'] = "Đường dẫn này đã tồn tại trước đó";
            } else {
                $friendly_url = create_slug($_POST['friendly_url']);
            }
        }
        if (empty($_POST['page_content'])) {
            $error['page_content'] = "Bạn chưa nhập nội dung";
        } else {
            $page_content = $_POST['page_content'];
        }

        if (empty($error)) {
            $fullname = get_fullname_by_username(user_login());
            $data = array(
                'page_title' => $page_title,
                'content' => $page_content,
                'created_date' => time(),
                'creator' => $fullname,
                'page_url' => $friendly_url
            );
            add_page($data);
            $success['page'] = "Thêm trang mới thành công";
        }
    }
    load_view('add');
}
// Sửa thông tin trang
function updateAction()
{
    $page_id = (int) $_GET['page_id'];
    global $error, $success;
    if (isset($_POST['btn_update'])) {
        $error = array();
        if (empty($_POST['page_title'])) {
            $error['page_title'] = "Không được để trống trường tiêu đề";
        } else {
            $page_title = $_POST['page_title'];
        }
        if (empty($_POST['friendly_url'])) {
            $error['friendly_url'] = "Bạn chưa nhập link thân thiện";
        } else {

            $friendly_url = create_slug($_POST['friendly_url']);
        }
        if (empty($_POST['page_content'])) {
            $error['page_content'] = "Bạn chưa nhập nội dung";
        } else {
            $page_content = $_POST['page_content'];
        }
        if (empty($error)) {
            $fullname = get_fullname_by_username(user_login());
            $data = array(
                'page_title' => $page_title,
                'content' => $page_content,
                'updated_by' => $fullname,
                'page_url' => $friendly_url,
                'updated_at' => time()
            );
            update_page_by_id($page_id, $data);
            $success['page'] = "Cập nhật trang thành công";
        }
    }
    $page = get_page_by_id($page_id);
    $data = array(
        'page' => $page
    );
    load_view('update', $data);
}
function deleteAction()
{
    $page_id = (int) $_GET['page_id'];
    delete_page_by_id($page_id);
    redirect("?mod=page");
}
