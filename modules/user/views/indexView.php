<?php get_header() ?>
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="?mod=checkout" title="">Đăng nhập / Đăng ký</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
                <div class="section" id="customer-info-wp">
                    <div class="section-head">
                        <h1 class="section-title">Đăng nhập</h1>
                    </div>
                    <div class="section-detail">
                        <form method="POST" action="?mod=user&action=login">
                            <?php if (isset($data['empty_user'])) : ?>
                            <h2 class="empty-user">Thông tin tài khoản không tồn tại</h2>
                            <?php endif; ?>
                            <div class="form-row clearfix">
                                <div class=" form-col fl-right">
                                    <label for="email">Mật khẩu</label>
                                    <input type="password" name="password" id="password" value="">
                                    <?php if (isset($data['errors']) && isset($data['errors']['password'])) : ?>
                                        <span class="text-errors"> <?= $data['errors']['password'] ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-col fl-right">
                                    <label for="username">Tên đăng nhập</label>
                                    <input type="text" name="username" id="username" value="">
                                    <?php if (isset($data['errors']) && isset($data['errors']['username'])) : ?>
                                        <span class="text-errors"> <?= $data['errors']['username'] ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class=" form-col fl-right">
                                <button type="submit" class="btn btn-primary" style="margin-right: 32px">Đăng nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="section" id="customer-info-wp">
                    <div class="section-head">
                        <h1 class="section-title">Đăng ký</h1>
                    </div>
                    <div class="section-detail">
                        <form method="POST" action="?mod=user&action=register">
                            <div class="form-row clearfix">
                                <div class="form-col fl-left">
                                    <label for="fullname">Họ tên</label>
                                    <input type="text" name="fullname" id="fullname" value="<?= isset($data['value']['fullname']) ? $data['value']['fullname'] : '' ?>">
                                    <?php if (isset($data['error_register']) && isset($data['error_register']['fullname'])) : ?>
                                        <span class="text-errors"> <?= $data['error_register']['fullname'] ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-col fl-right">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" value="<?= isset($data['value']['email']) ? $data['value']['email'] : '' ?>">
                                    <?php if (isset($data['error_register']) && isset($data['error_register']['email'])) : ?>
                                        <span class="text-errors"> <?= $data['error_register']['email'] ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-row clearfix">
                                <div class="form-col fl-left">
                                    <label for="username">Tên đăng nhập</label>
                                    <input type="text" name="username" id="username" value="<?= isset($data['value']['username']) ? $data['value']['username'] : '' ?>" />
                                    <?php if (isset($data['error_register']) && isset($data['error_register']['username'])) : ?>
                                        <span class="text-errors"> <?= $data['error_register']['username'] ?></span>
                                    <?php endif; ?>
                                </div
                                <div class="form-col fl-right">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" name="password" id="password" value="" style="width: 45%;padding: 6px 12px;border: 1px solid #cccccc;">
                                    <?php if (isset($data['error_register']) && isset($data['error_register']['password'])) : ?>
                                        <br>
                                        <span class="text-errors"> <?= $data['error_register']['password'] ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-row clearfix">
                                <div class="form-col fl-left">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" name="address" id="address" value="<?= isset($data['value']['address']) ? $data['value']['address'] : '' ?>">
                                    <?php if (isset($data['error_register']) && isset($data['error_register']['address'])) : ?>
                                        <span class="text-errors"> <?= $data['error_register']['address'] ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-col fl-right">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="tel" name="phone" id="phone" value="<?= isset($data['value']['phone']) ? $data['value']['phone'] : '' ?>">
                                    <?php if (isset($data['error_register']) && isset($data['error_register']['phone'])) : ?>
                                        <span class="text-errors"> <?= $data['error_register']['phone'] ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class=" form-col fl-right">
                                <button type="submit" class="btn btn-primary" style="margin-right: 32px">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>

        </div>
    </div>
<?php get_footer() ?>