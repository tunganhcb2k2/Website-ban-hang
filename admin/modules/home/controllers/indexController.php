<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load('lib', 'pagging');
    //phân trang
    $num_per_page = 5;
    $total_row = get_number_orders();
    $num_page = ceil($total_row / $num_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    $list_orders =  get_list_orders($start, $num_per_page);
    //lấy trạng thái
    $status_loading = get_status("tbl_orders", '0');
    $status_loading_send = get_status("tbl_orders", '1');
    $status_success = get_status("tbl_orders", '2');
    $status_fail = get_status("tbl_orders", '3');
    $total_checkout = get_total_checkout();
    $data = array(
        'list_orders' => $list_orders,
        'status_loading' => $status_loading,
        'status_loading_send' => $status_loading_send,
        'status_success' => $status_success,
        'status_fail' => $status_fail,
        'total_checkout' => $total_checkout,
        'start' => $start,
        'num_page' => $num_page,
        'page' => $page,
        'total_row' => $total_row,
    );
    load_view('index', $data);
}
