<?php

function add_cart($product_id, $info_product)
{
    $qty = 1;
    if (isset($_SESSION['cart']) && array_key_exists($product_id, $_SESSION['cart']['buy'])) {
        $qty = $_SESSION['cart']['buy'][$product_id]['qty'] + 1;
    }
    $_SESSION['cart']['buy'][$product_id] = array(
        'product_id' => $info_product['product_id'],
        'product_name' => $info_product['product_name'],
        'product_link' => $info_product['product_link'],
        'original_price' => $info_product['original_price'],
        'product_code' => $info_product['product_code'],
        'product_thumb' => $info_product['product_thumb'],
        'qty' => $qty,
        'sub_total' => $qty * $info_product['original_price']
    );
    // Cập nhật hóa đơn
    update_info_cart();
}

function update_info_cart()
{
    if (isset($_SESSION['cart'])) {
        $num_order = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_order += $item['qty'];
            $total += $item['sub_total'];
        }

        $_SESSION['cart']['info'] = array(
            'num_order' => $num_order,
            'total' => $total
        );
    }
}

function get_list_buy_cart()
{
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart']['buy'] as &$item) {
            $item['url_delete_cart'] = "?mod=cart&action=delete&product_id={$item['product_id']}";
        }
        return $_SESSION['cart']['buy'];
    }
    return false;
}

function get_num_order_cart()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['num_order'];
    }
    return false;
}

function get_total_cart()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total'];
    }
    return false;
}

function delete_cart($product_id)
{
    if (isset($_SESSION['cart'])) {
        if (!empty($product_id)) {
            unset($_SESSION['cart']['buy'][$product_id]);
            update_info_cart();
        } else {
            unset($_SESSION['cart']);
        }
    }
}

function update_cart($qty)
{
    foreach ($qty as $product_id => $new_qty) {
        $_SESSION['cart']['buy'][$product_id]['qty'] = $new_qty;
        $_SESSION['cart']['buy'][$product_id]['sub_total'] = $new_qty * $_SESSION['cart']['buy'][$product_id]['original_price'];
    }
    update_info_cart();
}
