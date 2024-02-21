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
    //lấy số lượng trạng thái
    $status_loading = get_status("tbl_orders", '0');
    $status_loading_send = get_status("tbl_orders", '1');
    $status_success = get_status("tbl_orders", '2');
    $status_fail = get_status("tbl_orders", '3');
    if (isset($_GET['btn_search'])) {
        $keyword = $_GET['search'];
        $list_orders = get_list_order_by_keyword($keyword);
    }
    $data = array(
        'list_orders' => $list_orders,
        'status_loading' => $status_loading,
        'status_loading_send' => $status_loading_send,
        'status_success' => $status_success,
        'status_fail' => $status_fail,
        'start' => $start,
        'num_page' => $num_page,
        'page' => $page,
        'total_row' => $total_row,
    );
    load_view('index', $data);
}
function detailAction()
{
    global $success;
    $order_id = (int) $_GET['order_id'];
    if (isset($_POST['btn_action'])) {
        $status = $_POST['action'];
        $data_status = array(
            'status' => $status
        );
        update_status($order_id, $data_status);
        $success['order'] = "Cập nhật tình trạng đơn hàng thành công";
    }
    // show_array($_POST);
    // die();
    // Lấy thông tin đơn hàng kết nối với bảng khách hàng
    $order_info = get_info_order_by_order_id($order_id);
    //Lấy danh sách chi tiết hóa đơn theo order_id kết nối với bảng product
    $order_detail = get_order_detail_by_order_id($order_id);
    $data = array(
        'order_info' => $order_info,
        'order_detail' => $order_detail
    );
    load_view('detail', $data);
}
function deleteAction()
{
    $order_id = (int) $_GET['order_id'];
    delete_checkout($order_id);
    redirect("?mod=checkout");
}
