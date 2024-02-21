<?php

function construct()
{
    load_model('index');
    load_model('indexCategory');
}
//danh sách bài viết
function indexAction()
{

    load('lib', 'pagging');
    //TRẠNG THÁI CỦA BÀI VIẾT
    if (isset($_POST['btn_action'])) {
        if (isset($_POST['checkItem'])) {
            $list_post_id = implode(",", $_POST['checkItem']);
        }
        // echo $post_id;
        // die();
        $action = $_POST['action'];
        if ($action == 'public') {
            $post_public = 'public';
            $data_status = array(
                'status' => $post_public
            );
            update_status($data_status, $list_post_id);
        }
        if ($action == 'pending') {
            $post_pending = 'pending';
            $data_status = array(
                'status' => $post_pending
            );
            update_status($data_status, $list_post_id);
        }
    }
    //PHÂN TRANG
    $num_per_page = 10;
    $total_row = get_number_post();
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    $list_post = get_list_post($start, $num_per_page);
    $status_public = get_status('tbl_post', 'public');
    $status_pending = get_status('tbl_post', 'pending');
    
    $data = array(
        'list_post' => $list_post,
        'start' => $start,
        'num_page' => $num_page,
        'page' => $page,
        'total_row' => $total_row,
        'status_public' => $status_public,
        'status_pending' => $status_pending,
    );
    load_view('index', $data);
}
function addAction()
{
    global $error, $post_title, $success, $parent_id, $friendly_url;
    // Kiểm tra submit
    if (isset($_POST['btn_add'])) {
        $error = array();
        if (empty($_POST['post_title'])) {
            $error['post_title'] = "Không được để trống trường tiêu đề";
        } else {
            if (check_name_post_exists($_POST['post_title'])) {
                $error['post_title'] = "Tiêu đề đã được tồn tại trước đó";
            } else {
                $post_title = $_POST['post_title'];
            }
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
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "Không được để trống trường nội dung bài viết";
        } else {
            $post_content = $_POST['post_content'];
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
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "Vui lòng chọn danh mục của bài viết";
        } else {
            $parent_id = $_POST['parent_cat'];
        }
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }
        if (empty($error)) {
            $fullname = get_fullname_by_username(user_login());
            $post_thumb = upload_image("public/uploads/post/", $type);
            $data = array(
                'post_title' => $post_title,
                'post_url'     => $friendly_url,
                'post_content' => $post_content,
                'created_at' => time(),
                'creator' => $fullname,
                'status' => $status,
                'post_thumb' => $post_thumb,
                'cat_id' => $parent_id
            );
            add_post($data);
            $success['post'] = "Thêm bài viết mới thành công";
        }
    }
    // Lấy danh sách category
    $list_category = get_list_category();

    $data = array(
        'list_category' => $list_category
    );
    load_view('add', $data);
}
// Cập nhật bài viết
function updateAction()
{
    $post_id = (int)$_GET['post_id'];
    $info_post = get_info_post_by_id($post_id);
    $list_category = get_list_category();
    global $error, $post_title, $success, $parent_id, $friendly_url, $post_thumb, $type, $size;

    if (isset($_POST['btn_update'])) {
        $error = array();
        if (empty($_POST['post_title'])) {
            $error['post_title'] = "Không được để trống trường tiêu đề";
        } else {
            $post_title = $_POST['post_title'];
        }
        if (empty($_POST['friendly_url'])) {
            $error['friendly_url'] = "Bạn chưa nhập link thân thiện";
        } else {
            $friendly_url = create_slug($_POST['friendly_url']);
        }
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "Không được để trống trường nội dung bài viết";
        } else {
            $post_content = $_POST['post_content'];
        }
        // check upload file
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = $info_post['post_thumb'];
                if (!empty($old_thumb)) {
                    delete_image($old_thumb);
                    $post_thumb = upload_image('public/uploads/post/', $type);
                } else {
                    $post_thumb = upload_image('public/uploads/post/', $type);
                }
            }
        } else {
            $post_thumb = $info_post['post_thumb'];
        }
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "Vui lòng chọn danh mục của bài viết";
        } else {
            $parent_id = $_POST['parent_cat'];
        }
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }
        if (empty($error)) {
            $fullname = get_fullname_by_username(user_login());
            $data_update = array(
                'post_title' => $post_title,
                'post_url' => $friendly_url,
                'updated_user' => $fullname,
                'update_at' => time(),
                'post_content' => $post_content,
                'status' => $status,
                'post_thumb' => $post_thumb,
                'cat_id' => $parent_id
            );
            update_post($post_id, $data_update);
            $info_post = $data_update;
            $success['post'] = "Cập nhật bài viết mới thành công";
        }
    }
    $data = array(
        'list_category' => $list_category,
        'info_post' => $info_post
    );
    load_view('update', $data);
}

function searchAction()
{
    load('lib', 'pagging');
    global $key;
    if (isset($_POST['btn_search'])) {
        if (empty($_POST['search'])) {
            redirect("?mod=post&action=search");
        } else {
            $key = $_POST['search'];
            $list_post = searchPost($key);
            $total_row = get_number_post_search($key);
        }
    }
    $total_row_search =  $total_row;
    $num_per_page = 2;
    $num_page = ceil($total_row_search  / $num_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    $list_post = get_list_post_search($key, $start, $num_per_page);
    $data = array(
        'list_post' => $list_post,
        'start' => $start,
        'num_page' => $num_page,
        'page' => $page,
        'total_row_search' =>  $total_row_search,
        'key' => $key
    );

    load_view('search', $data);
}
function deleteAction()
{
    $post_id = (int)$_GET['post_id'];
    delete_post_by_id($post_id);
    redirect("?mod=post");
}
