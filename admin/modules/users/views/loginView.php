<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
    <title>Trang đăng nhập</title>
</head>

<body>
    <div id="wp-form-login">
        <h1>Đăng Nhập</h1>
        <form action="" method="POST" id="form-login">
            <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" placeholder="Tên đăng nhập">
            <?php echo form_error('username'); ?>
            <input type="password" name="password" id="password" value="" placeholder="Mật khẩu">
            <?php echo form_error('password'); ?>
            <input type="checkbox" id="remember_me" name="remember_me"> <label for="remember_me">Ghi nhớ mật khẩu</label> <br>
            <input type="submit" id="btn_login" name="btn_login" value="Đăng Nhập">
            <a href="<?php echo base_url("?mod=users&action=lostPass") ?>" id="lost_pass">Quên mật khẩu?</a>
            <?php echo form_error('account'); ?>
        </form>
    </div>
</body>

</html>