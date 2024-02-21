<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load('lib', 'pagging');
    //TRẠNG THÁI CỦA của sản phẩm
    if (isset($_POST['btn_action'])) {
        if (isset($_POST['checkItem'])) {
            $list_product_id = implode(",", $_POST['checkItem']);
        }
        $action = $_POST['action'];
        if ($action == 'public') {
            $product_public = 'public';
            $data_status = array(
                'status' => $product_public
            );
            update_status($data_status, $list_product_id);
        }
        if ($action == 'pending') {
            $product_pending = 'pending';
            $data_status = array(
                'status' => $product_pending
            );
            update_status($data_status, $list_product_id);
        }
    }
    $num_per_page = 10;
    $total_row = get_number_product();
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    $list_product = get_list_product($start, $num_per_page);
    $status_public = get_status('tbl_product', 'public');
    $status_pending = get_status('tbl_product', 'pending');
    $data = array(
        'list_product' => $list_product,
        'start' => $start,
        'num_page' => $num_page,
        'page' => $page,
        'total_row' => $total_row,
        'status_public' => $status_public,
        'status_pending' => $status_pending
    );
    load_view('index', $data);
}
function addAction()
{
    global $error, $success;
    //Kiểm tra submit ảnh chi tiết sản phẩm
    if (isset($_FILES['files'])) {
        $total = count($_FILES['files']['name']);
        //Loop through each file
        for ($i = 0; $i < $total; $i++) {
            $error = array();
            $upload_dir = "public/uploads/product/";
            $upload_file = $upload_dir . $_FILES['files']['name'][$i];
            $type_allow = array('png', 'gif', 'jpeg', 'jpg');
            $type = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
            if (!in_array(strtolower($type), $type_allow)) {
                $error['file_type'] = 'Upload không đúng file ảnh';
            } else {
                $file_size = $_FILES['files']['size'][$i];
                if ($file_size > 29000000) {
                    $error['file_size'] = 'Kích thước upload ảnh phải dưới 20MB';
                }

                if (file_exists($upload_file)) {
                    $file_name = pathinfo($_FILES['files']['name'][$i], PATHINFO_FILENAME);
                    $new_file_name = $file_name . ' - Copy.';
                    $new_upload_file = $upload_dir . $new_file_name . $type;
                    $k = 1;
                    while (file_exists($new_upload_file)) {
                        $new_file_name = $file_name . " - Copy({$k}).";
                        $k++;
                        $new_upload_file = $upload_dir . $new_file_name . $type;
                    }
                    $upload_file = $new_upload_file;
                }
            }
            if (empty($error)) {
                move_uploaded_file($_FILES['files']['tmp_name'][$i], $upload_file);
            }
        }
    }
    if (isset($_POST['btn_add'])) {
        $error = array();
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không được để trống trường tên sản phẩm";
        } else {
            if (check_name_product_exists($_POST['product_name'])) {
                $error['product_name'] = "Tên sản phẩm đã có trong hệ thống";
            }
            $product_name = $_POST['product_name'];
        }
        if (empty($_POST['friendly_url'])) {
            $error['friendly_url'] = "Không được để trống trường link thân thiện";
        } else {
            if (check_name_product_link(create_slug($_POST['friendly_url']))) {
                $error['friendly_url'] = "Đường dẫn này đã tồn tại trước đó";
            } else {
                $product_link = create_slug($_POST['friendly_url']);
            }
        }
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "Không được để trống mã sản phẩm";
        } else {
            if (check_code_product_exists($_POST['product_code'])) {
                $error['product_code'] = "Mã sản phẩm đã tồn tại trong hệ thống";
            }
            $product_code = $_POST['product_code'];
        }
        if (empty($_POST['original_price'])) {
            $error['original_price'] = "Không được để trống giá gốc sản phẩm";
        } else {
            $original_price = $_POST['original_price'];
        }
        $price_sale = $_POST['price_sale'];

        if (empty($_POST['qty_product'])) {
            $error['qty_product'] = "Không được để trống số lượng sản phẩm";
        } else {
            $qty_product = $_POST['qty_product'];
        }
        if (empty($_POST['qty_product'])) {
            $error['qty_product'] = "Không được để trống số lượng sản phẩm";
        } else {
            $qty_product = $_POST['qty_product'];
        }
        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Không được để trống số lượng sản phẩm";
        } else {
            $product_desc = $_POST['product_desc'];
        }
        if (empty($_POST['product_detail'])) {
            $error['product_detail'] = "Không được để trống mô tả sản phẩm";
        } else {
            $product_detail = $_POST['product_detail'];
        }
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }
        if (empty($_POST['cat_id'])) {
            $error['cat_id'] = "Vui lòng chọn danh mục của bài viết";
        } else {
            $cat_id = (int)$_POST['cat_id'];
        }
        if (isset($_POST['outstanding_product'])) {
            $outstanding_product = 1;
        } else {
            $outstanding_product = 0;
        }
        if (isset($_POST['product_selling'])) {
            $product_selling = 1;
        } else {
            $product_selling = 0;
        }
        //kiểm ảnh đại diện
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            }
        } else {
            $error['upload_image'] = "Bạn chưa chọn ảnh";
        }

        if (empty($error)) {
            $creator = get_fullname_by_username(user_login());
            $product_thumb = upload_image('public/uploads/product/', $type);
            $data_product = array(
                'product_name' => $product_name,
                'product_link' => $product_link,
                'product_code' => $product_code,
                'original_price' => $original_price,
                'price_sale' => $price_sale,
                'product_desc' => $product_desc,
                'product_detail' => $product_detail,
                'product_thumb' => $product_thumb,
                'cat_id' => $cat_id,
                'product_selling' => $product_selling,
                'outstanding_product' => $outstanding_product,
                'status' => $status,
                'qty_product' => $qty_product,
                'creator' => $creator,
                'created_at' => time()
            );
            $product_id = add_product($data_product);
            // Thêm ảnh chi tiết sản phẩm
            $list_file_name = $_FILES['files']['name'];
            foreach ($list_file_name as $item) {
                $data_product_image = array(
                    'product_id' => $product_id,
                    'link_image' => $item
                );
                insert_image_product($data_product_image);
            }
            $success['product'] = "Thêm sản phẩm sản phẩm thành công";
        }
    }
    $list_category = get_list_category();
    $data = array(
        'list_category' => $list_category
    );
    load_view('add', $data);
}
function updateAction()
{
    global $error, $success;
    $product_id = (int)$_GET['product_id'];
    $info_product = get_info_product_by_product_id($product_id);
    $list_image_product = get_list_image_product_by_id($product_id);
    if (isset($_FILES['files'])  && ($_FILES['files']['size'] > 0)) {
        $total = count($_FILES['files']['name']);
        //Loop through each file
        for ($i = 0; $i < $total; $i++) {
            $upload_dir = "public/uploads/product/";
            $upload_file = $upload_dir . $_FILES['files']['name'][$i];
            $error = array();
            $type_allow = array('png', 'gif', 'jpeg', 'jpg');
            $type = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
            if (!in_array(strtolower($type), $type_allow)) {
                $error['file_type'] = 'Upload không đúng file ảnh';
            } else {
                $file_size = $_FILES['files']['size'][$i];
                if ($file_size > 29000000) {
                    $error['file_size'] = 'Kích thước upload ảnh phải dưới 20MB';
                }
                if (file_exists($upload_file)) {
                    $file_name = pathinfo($_FILES['files']['name'][$i], PATHINFO_FILENAME);
                    $new_file_name = $file_name . ' - Copy.';
                    $new_upload_file = $upload_dir . $new_file_name . $type;
                    $k = 1;
                    while (file_exists($new_upload_file)) {
                        $new_file_name = $file_name . " - Copy({$k}).";
                        $k++;
                        $new_upload_file = $upload_dir . $new_file_name . $type;
                    }
                    $upload_file = $new_upload_file;
                }
            }
            if (empty($error)) {
                move_uploaded_file($_FILES['file']['tmp_name'], $upload_file);
            }
        }
    }
    if (isset($_POST['btn_update'])) {
        $error = array();
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không được để trống trường tên sản phẩm";
        } else {
            $product_name = $_POST['product_name'];
        }
        if (empty($_POST['friendly_url'])) {
            $error['friendly_url'] = "Không được để trống trường link thân thiện";
        } else {
            $product_link = create_slug($_POST['friendly_url']);
        }
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "Không được để trống mã sản phẩm";
        } else {
            $product_code = $_POST['product_code'];
        }
        if (empty($_POST['original_price'])) {
            $error['original_price'] = "Không được để trống giá gốc sản phẩm";
        } else {
            $original_price = $_POST['original_price'];
        }
        $price_sale = $_POST['price_sale'];

        if (empty($_POST['qty_product'])) {
            $error['qty_product'] = "Không được để trống số lượng sản phẩm";
        } else {
            $qty_product = $_POST['qty_product'];
        }
        if (empty($_POST['qty_product'])) {
            $error['qty_product'] = "Không được để trống số lượng sản phẩm";
        } else {
            $qty_product = $_POST['qty_product'];
        }
        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Không được để trống mô tả của sản phẩm";
        } else {
            $product_desc = $_POST['product_desc'];
        }
        if (empty($_POST['product_detail'])) {
            $error['product_detail'] = "Không được để trống chi tiết sản phẩm";
        } else {
            $product_detail = $_POST['product_detail'];
        }
        if (empty($_POST['status'])) {
            $status = "pending";
        } else {
            $status = $_POST['status'];
        }
        if (empty($_POST['cat_id'])) {
            $error['cat_id'] = "Vui lòng chọn danh mục của bài viết";
        } else {
            $cat_id = (int)$_POST['cat_id'];
        }
        if (isset($_POST['outstanding_product'])) {
            $outstanding_product = 1;
        } else {
            $outstanding_product = 0;
        }
        if (isset($_POST['product_selling'])) {
            $product_selling = 1;
        } else {
            $product_selling = 0;
        }
        //kiểm ảnh đại diện
        // check upload file
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = $info_product['product_thumb'];
                if (!empty($old_thumb)) {
                    delete_image($old_thumb);
                    $product_thumb = upload_image('public/uploads/product/', $type);
                } else {
                    $product_thumb = upload_image('public/uploads/product/', $type);
                }
            }
        } else {
            $product_thumb = $info_product['product_thumb'];
        }
        //Kiểm tra submit ảnh chi tiết sản phẩm
        if (empty($error)) {
            $fullname = get_fullname_by_username(user_login());
            $data_product = array(
                'product_name' => $product_name,
                'product_link' => $product_link,
                'product_code' => $product_code,
                'original_price' => $original_price,
                'price_sale' => $price_sale,
                'product_desc' => $product_desc,
                'product_detail' => $product_detail,
                'product_thumb' => $product_thumb,
                'cat_id' => $cat_id,
                'product_selling' => $product_selling,
                'outstanding_product' => $outstanding_product,
                'status' => $status,
                'qty_product' => $qty_product,
                'updated_user' => $fullname,
                'updated_at' => time()
            );
            update_product_by_id($product_id, $data_product);
            // Thêm ảnh chi tiết sản phẩm
            $list_file_name = $_FILES['files']['name'];
            if (isset($_FILES['files'])  && $_FILES['files']['size'][0] > 0 && !empty($_FILES['files']['name'][0])) {
                delete_list_image_product_by_id($product_id);
                foreach ($list_file_name as $item) {
                    $data_product_image = array(
                        'product_id' => $product_id,
                        'link_image' => $item
                    );
                    insert_image_product($data_product_image);
                }
            }
            $success['product'] = "Cập nhật sản phẩm thành công";
            $info_product = $data_product;
        }
    }
    $list_category = get_list_category();
    $data = array(
        'list_category' => $list_category,
        'info_product' => $info_product,
        'list_image_product' => $list_image_product
    );
    load_view('update', $data);
}
// Xóa sản phẩm
function deleteAction()
{
    $product_id = (int)$_GET['product_id'];
    delete_product_by_id($product_id);
    delete_list_image_product_by_id($product_id);
    redirect("?mod=product");
}
function searchAction()
{
    load('lib', 'pagging');
    global $key;
    if (isset($_POST['btn_search'])) {
        if (empty($_POST['search'])) {
            redirect("?mod=product&action=search");
        } else {
            $key = $_POST['search'];
        }
    }
    $total_row_search = get_number_product_search($key);
    $num_per_page = 5;
    $num_page = ceil($total_row_search  / $num_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    $list_product = get_list_product_search($key, $start, $num_per_page);
    $data = array(
        'list_product' => $list_product,
        'start' => $start,
        'num_page' => $num_page,
        'page' => $page,
        'total_row_search' =>  $total_row_search,
        'key' => $key
    );

    load_view('search', $data);
}
