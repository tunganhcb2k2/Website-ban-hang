<?php
get_header();
?>
<div id="page-body" class="d-flex">
    <?php
    get_sidebar();
    ?>
    <div id="wp-content">
        <div id="content" class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Đổi mật khẩu
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <?php echo form_success('account'); ?>
                            <label for="old_pass">Mật khẩu cũ</label>
                            <input type="password" class="form-control" name="old_pass" id="old_pass">
                            <?php echo form_error('old_pass'); ?>
                        </div>
                        <div class="form-group">
                            <label for="pass-new">Mật khẩu mới</label>
                            <input type="password" class="form-control" name="pass_new" id="pass_new">
                            <?php echo form_error('pass_new'); ?>
                        </div>
                        <div class="form-group">
                            <label for="confirm_pass">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" name="confirm_pass" id="confirm_pass">
                            <?php echo form_error('confirm_pass'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary" name="btn_update">Thay đổi</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>