<?php
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'cart');
    load('lib', 'email');
}
function indexAction()
{
    global $error, $fullname, $address, $phone;
    if (isset($_POST['btn_order'])) {
        $error = array();
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Nhập email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }
        $note = $_POST['note'];
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống trường Họ tên";
        } else {
            $fullname = $_POST['fullname'];
        }
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống trường Địa chỉ";
        } else {
            $address = $_POST['address'];
        }
        if (empty($_POST['phone'])) {
            $error['phone'] = "Không được để trống trường Số điện thoại";
        } else {
            if (!(is_phone_number($_POST['phone']))) {
                $error['phone'] = "Số điện thoại không đúng, vui lòng nhập lại";
            } else {
                $phone = $_POST['phone'];
            }
        }
        $payment_method = $_POST['payment_method'];
        $order_code = (rand(1, 1000));

        if (empty($error)) {
            //    $order_code = (rand(1, 1000));
            $data_guest = array(
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $phone,
                'address' => $address,
                'note' => $note
            );
            $guest_id = add_guest($data_guest);

            $data_order = array(
                'guest_id' => $guest_id,
                'num_order' => $_SESSION['cart']['info']['num_order'],
                'total_price' => $_SESSION['cart']['info']['total'],
                'created_at' => time(),
                'payment_method' => $payment_method,
                'order_code' => $order_code,
            );
            $order_id = add_order($data_order);
            foreach ($_SESSION['cart']['buy'] as $item) {
                $data_order_detail = array(
                    'order_id' => $order_id,
                    'product_id' => $item['product_id'],
                    'price' => $item['original_price'],
                    'qty_product' => $item['qty'],
                    'sub_total' => $item['sub_total']
                );
                $id = add_order_detail($data_order_detail);
            }

            // Gửi email cho khách hàng
            $subject = "[iSmart] Xác nhận đặt hàng";
            $content = "<div class='info-order' style='width: 680px; margin: 0 auto; background-color: #e1e1e1; padding: 20px; font-family: monospace; color: #333;'>
            <div class='top-info'>
                <h2 class='name-customer'>Kính chào Anh/Chị: {$fullname}</h2>
                <span class='sub-title'>Cảm ơn Anh/Chị đã tin tưởng lựa chọn iSmart</span>
            </div>
            <div class='content-info'>
                <h4 class='title'>Thông tin đơn hàng của quý khách</h4>
                <ul>
                    <li style='padding: 5px 0;'>
                        <span>Mã đơn hàng: </span>
                        <span>{$order_code}</span>
                    </li>
                    <li style='padding: 5px 0;'>
                        <span>Tổng sản phẩm: </span>
                        <span>{$_SESSION['cart']['info']['num_order']} sản phẩm</span>
                    </li>
                    <li style='padding: 5px 0;'>
                        <span>Tổng tiền: </span>
                        <span>{$item['sub_total']}</span>
                    </li>
                    <li style='padding: 5px 0;'>
                        <span>Ngày nhận dự kiến: 3 ngày kể từ ngày đặt</span>
                        <span>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận lại</span>
                    </li>
                    <li style='padding: 5px 0;'>
                        <span>Gửi phải hồi cho chúng tôi(email): </span>
                        <span>tunganhcb2k2@gmail.com hoặc sđt:094.818.2323</span>
                    </li>
                </ul>
            </div>
            <div class'footer-info'>
                <p>iSmart hẹn gặp lại quý khách !</p>
            </div>
        </div>";
            send_mail($email, $fullname, $subject, $content);
            // Xóa tất cả sản phẩm ra khỏi giỏ hàng sau khi khách hàng thanh toán thành công
            delete_cart('');
            // Chuyển đến trang đặt hàng thành công
            redirect("?mod=checkout&action=success");
        }
    }
    $data = [];
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $data['user'] = $user;
    }
    load_view('index', $data);
}
// Thông báo đặt hàng thành công
function successAction()
{
    load_view('success');
}
