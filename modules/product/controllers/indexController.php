<?php

use GuzzleHttp\Promise\Is;

function construct()
{
    load_model('index');
}

// Danh sách sản phẩm của tất cả danh mục
function indexAction()
{
    $total_row = get_number_product();
    $list_product = get_list_product();
    $list_category = get_list_category();
    $list_ads = get_list_ads_by_status();
    $data = array(
        'list_product' => $list_product,
        'list_ads' => $list_ads,
        'list_category' => $list_category,
        'total_row' => $total_row
    );
    load_view('index', $data);
}

// Danh sách sản phẩm của từng danh mục
function cat_productAction()
{

    $cat_id = (int)$_GET['cat_id'];
    $total_row = get_number_product_in_category($cat_id);
    $list_product = get_list_product_by_cat_id($cat_id);
    $list_category = get_list_category();
    $info_category = get_info_category_by_cat_id($cat_id);
    $list_ads = get_list_ads_by_status();

    if (isset($_POST['btn_filter'])) {
        $filter = $_POST['filter'];
        if ($filter == 1) {
            $list_product = get_list_product_filter_product_name_az($cat_id);
        } else if ($filter == 2) {
            $list_product = get_list_product_filter_product_name_za($cat_id);
        } else if ($filter == 3) {
            $list_product = get_list_product_filter_price_asc($cat_id);
        } else if ($filter == 4) {
            $list_product = get_list_product_filter_price_desc($cat_id);
        }
    }
    $data = array(
        'info_category' => $info_category,
        'list_category' => $list_category,
        'list_product' => $list_product,
        'total_row' => $total_row,
        'list_ads' => $list_ads,
    );
    load_view('cat_product', $data);
}

// Chi tiết sản phẩm
function detailAction()
{
    $product_id = (int)$_GET['product_id'];
    $list_category = get_list_category();
    $list_product = get_list_product();
    $info_product = get_info_product_by_id($product_id);
    $list_product_image = get_list_image_product_by_id($product_id);
    $list_ads = get_list_ads_by_status();
    $data = array(
        'list_category' => $list_category,
        'info_product' => $info_product,
        'list_product_image' => $list_product_image,
        'list_product' => $list_product,
        'list_ads' => $list_ads,
    );
    load_view('detail', $data);
}
// Tìm kiếm sản phẩm
function searchAction()
{
    if (isset($_GET['btn_search'])) {
        if (empty($_GET['q'])) {
            redirect("?");
        } else {
            $list_category = get_list_category();
            $q = $_GET['q'];
            $list_product = get_list_product_by_key_word($q);
        }
    }
    $list_ads = get_list_ads_by_status();
    $data = array(
        'list_product' => $list_product,
        'list_category' => $list_category,
        'list_ads'=>$list_ads
    );
    load_view('search', $data);
}
