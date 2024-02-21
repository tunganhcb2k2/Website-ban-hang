<div id="footer-wp">
    <div id="foot-body">
        <div class="wp-inner clearfix">
            <div class="block" id="info-company">
                <h3 class="title">ISMART</h3>
                <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                <div id="payment">
                    <div class="thumb">
                        <img src="public/images/img-foot.png" alt="">
                    </div>
                </div>
            </div>
            <div class="block menu-ft" id="info-shop">
                <h3 class="title">Thông tin cửa hàng</h3>
                <ul class="list-item">
                    <li>
                        <p>Đống Đa - Hà Nội</p>
                    </li>
                    <li>
                        <p>094.818.2323</p>
                    </li>
                    <li>
                        <p>tunganhcb2k2@gmail.com</p>
                    </li>
                </ul>
            </div>
            <div class="block menu-ft policy" id="info-shop">
                <h3 class="title">Chính sách mua hàng</h3>
                <ul class="list-item">
                    <li>
                        <a href="" title="">Quy định - chính sách</a>
                    </li>
                    <li>
                        <a href="" title="">Chính sách bảo hành - đổi trả</a>
                    </li>
                    <li>
                        <a href="" title="">Chính sách hội viện</a>
                    </li>
                    <li>
                        <a href="" title="">Giao hàng - lắp đặt</a>
                    </li>
                </ul>
            </div>
            <div class="block" id="newfeed">
                <h3 class="title">Bảng tin</h3>
                <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                <div id="form-reg">
                    <form method="POST" action="">
                        <input type="email" name="email" id="email" placeholder="Nhập email tại đây">
                        <button type="submit" id="sm-reg">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="foot-bot">
        <div class="wp-inner">
            <p id="copyright">© Bản quyền thuộc về Tùng Anh | Tùng Anh </p>
        </div>
    </div>
</div>
</div>
<div id="menu-respon">
    <a href="?page=home" title="" class="logo">Ismart</a>
    <div id="menu-respon-wp">
        <ul class="" id="main-menu-respon">
            <li>
                <a href="?" title>Trang chủ</a>
            </li>
            <?php
                    foreach ($list_category as $item) {
                        if ($item['parent_id'] == 0) {
                    ?>
                <li>
                    <a href="?mod=product&action=cat_product&cat_id=<?php echo $item['cat_id'] ?>" title=""><?php echo $item['cat_title'] ?></a>
                    <?php
                    if ($item['is_child'] == 1) {
                    ?>
                        <ul class="sub-menu">
                            <?php
                            foreach ($list_category as $item2) {
                                if ($item2['parent_id'] == $item['cat_id']) {
                            ?>
                                    <li>
                                        <a href="?mod=product&action=cat_product&cat_id=<?php echo $item2['cat_id']; ?>" title=""><?php echo $item2['cat_title'] ?></a>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    <?php
                    }
                    ?>
                </li>
            <?php
            }
        }
            ?>
            
            <li>
                <a href="?mod=post" title>Blog</a>
            </li>
            <li>
                <a href="?mod=page&page_id=1" title>Giới thiệu</a>
            </li>
            <li>
                <a href="?mod=page&page_id=4" title>Liên hệ</a>
            </li>
        </ul>
    </div>
</div>
<div id="btn-top"><img src="public/images/icon-to-top.png" alt="" /></div>
<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "141073229093751");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v18.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
</body>

</html>