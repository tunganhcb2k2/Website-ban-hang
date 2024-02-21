<div class="section" id="banner-wp">
    <?php
    foreach ($list_ads as $item) {
    ?>
        <strong> <a href="<?php echo $item['ads_link'] ?>" target="_blank" class=""> <?php echo $item['ads_name'] ?> </a> </strong>
        <a href="<?php echo $item['ads_link'] ?>" target="_blank" class="thumb">
            <img src="admin/<?php echo $item['ads_thumb']; ?>" alt="">
        </a>
    <?php } ?>
</div>