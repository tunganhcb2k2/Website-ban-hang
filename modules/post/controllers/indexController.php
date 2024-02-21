<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load('lib', 'pagging');
    $num_per_page = 8;
    $total_row = get_number_post();
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    $list_post = get_list_post($start, $num_per_page);
    $list_product = get_list_product();
    $list_ads = get_list_ads_by_status();
    $list_category = get_list_category();
    $data = array(
        'list_category' => $list_category,
        'list_product' => $list_product,
        'list_ads' => $list_ads,
        'list_post' => $list_post,
        'start' => $start,
        'num_page' => $num_page,
        'page' => $page,
        'total_row' => $total_row,
    );
    load_view('index', $data);
}

function detailAction()
{
    $post_id = (int)$_GET['post_id'];
    $info_post = get_info_post_by_id($post_id);
    $list_product = get_list_product();
    
    $data = array(
        'list_product' => $list_product,
        'info_post' => $info_post
    );
    load_view('detail', $data);
}
