<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
    <title>Quên mật khẩu</title>
</head>

<body>
    <div id="wp-form-login">
        <h1>Đăng Nhập</h1>
        <form action="" method="POST" id="form-login">
        <input type="text" name="email" id="email" value="<?php echo set_value('email') ?>" placeholder="Email">
            <?php echo form_error('email'); ?>
            <input type="submit" id="btn_reset" name="lostPass" value="Lấy lại mật khẩu">
            <?php echo form_error('account'); ?>
        </form>
    </div>
</body>

</html>