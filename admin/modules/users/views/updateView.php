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
                    Sửa thông tin Admin
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <?php echo form_success('account'); ?>
                        <?php echo form_error('account'); ?>
                        <div class="form-group">
                            <label for="fullname">Họ và tên</label>
                            <input class="form-control" type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname'); ?>" placeholder="Họ và Tên">
                            <?php echo form_error('fullname'); ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" placeholder="Tên tài khoản">
                            <?php echo form_error('username'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" placeholder="Email">
                            <?php echo form_error('email'); ?>
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