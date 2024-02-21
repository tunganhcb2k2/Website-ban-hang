<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    if (isset($_GET['btn_search'])) {
        $key = $_GET['search'];
        $list_product = get_list_product_by_key_word($key);
    }
    $list_category = get_list_category();
    $list_product = get_list_product();
    $list_slider = get_list_slider_by_status();
    $list_ads = get_list_ads_by_status();
    $data = array(
        'list_category' => $list_category,
        'list_product' => $list_product,
        'list_slider' => $list_slider,
        'list_ads' => $list_ads,
    );
    load_view('index', $data);
}
