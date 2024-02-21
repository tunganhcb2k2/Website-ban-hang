<?php

function construct()
{
    load_model('indexCategory');
}

// Danh sách danh mục
function indexAction()
{
    $list_category = get_list_category();
    $data = array(
        'list_category' => $list_category,
    );
    load_view('indexCategory', $data);
}
// Thêm một danh mục
function addAction()
{
    global $error, $success, $cat_title;
    if (isset($_POST['btn_add'])) {
        $error = array();

        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "Không được để trống trường tiêu đề";
        } else {
            if (check_name_cat_exists($_POST['cat_title'])) {
                $error['cat_title'] = "Danh mục đã tồn tại trước đó";
            }
            $cat_title = $_POST['cat_title'];
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
        $parent_id = $_POST['parent_cat'];
        if (empty($error)) {
            $fullname = get_fullname_by_username(user_login());
            if ($parent_id == 0 || empty($parent_id)) {
                $level = 0;
            } else {
                $level = get_level_by_cat_id($parent_id) + 1;
            }
            $data = array(
                'cat_title' => $cat_title,
                'created_at' => time(),
                'creator' => $fullname,
                'parent_id' => $parent_id,
                'level' => $level,
                'cat_link' => $friendly_url
            );
            add_category($data);
            $success['cat'] = "Thêm mới thành công";
        }
    }
    $list_category = get_list_category();
    $data_category = array(
        'list_category' => $list_category
    );
    load_view('addCat', $data_category);
}

// Xóa một danh mục
function deleteAction()
{
    $cat_id = $_GET['cat_id'];
    delete_category_by_cat_id($cat_id);
    redirect("?mod=product&controller=indexCategory");
}

// Cập nhật danh mục
function updateAction()
{
    $cat_id = $_GET['cat_id'];
    global $error, $cat_title, $success,  $parent_id, $level;
    if (isset($_POST['btn_update'])) {
        $error = array();
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "Không được để trống trường tiêu đề";
        } else {
            $cat_title = $_POST['cat_title'];
        }
        if (empty($_POST['friendly_url'])) {
            $error['friendly_url'] = "Bạn chưa nhập link thân thiện";
        } else {
            $friendly_url = create_slug($_POST['friendly_url']);
        }
        $parent_id = $_POST['parent_cat'];
        if (empty($error)) {
            $fullname = get_fullname_by_username(user_login());
            if ($parent_id == 0 || empty($parent_id)) {
                $level = 0;
            } else {
                $level = get_level_by_cat_id($parent_id) + 1;
            }
            $data = array(
                'cat_title' => $cat_title,
                'updated_at' => time(),
                'parent_id' => $parent_id,
                'update_user' => $fullname,
                'level' => $level,
                'cat_link' => $friendly_url
            );
            update_category_by_cat_id($cat_id, $data);
            $success['cat'] = "Cập nhật dữ liệu thành công";
        }
    }
    $list_category = get_list_category();
    $category_info = get_info_category_by_cat_id($cat_id);

    $data_update = array(
        'category_info' => $category_info,
        'list_category' => $list_category
    );
    load_view('updateCat', $data_update);
}
