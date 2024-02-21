<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
    <title>Đặt mật khẩu mới</title>
</head>

<body>
    <div id="wp-form-login">
        <h1>Đặt mật khẩu mới</h1>
        <form action="" method="POST" id="form-login">
            <input type="password" name="password" id="password" value="" placeholder="Mật khẩu mới">
            <input type="password" name="confirm_pass" id="password" value="" placeholder="Xác nhận mật khẩu mới">
            <input type="submit" id="btn_reset" name="btn_newPass" value="Lấy lại mật khẩu">
            <?php echo form_error('account'); ?>
        </form>
    </div>
</body>

</html>