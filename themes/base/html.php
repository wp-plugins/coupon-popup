<?php
wp_enqueue_style('google-font-oxygen', 'http://fonts.googleapis.com/css?family=Oxygen');
ob_start();
?>
<div class="<?=CouponPopup::$classPrefix;?>content <?= $coupon['image'] ? 'image' : '' ?>">
    <?php if ($coupon['image']): ?>
        <div class="<?=CouponPopup::$classPrefix;?>image" style="background: #fff url('<?= $coupon['image']; ?>') no-repeat center center"></div>
    <?php endif;?>
    <h2><?= $coupon['title'] ?></h2>
    <?= $coupon['description'] ?>
</div>
<div class="<?=CouponPopup::$classPrefix;?>footer">
    <div class="<?=CouponPopup::$classPrefix;?>reveal">
        <?php if (isset($coupon['button'])): ?>
            <button
                type="button"
                class="<?= CouponPopup::$linkClass; ?> coupon-popup-button"
                title="<?= $coupon['title']; ?>" <?= $html_data_attributes ?>>
                <?= $coupon['button']; ?>
            </button>
        <?php endif; ?>
    </div>
    <div class="<?=CouponPopup::$classPrefix;?>revealed">
        <?php if (isset($coupon['button'])): ?>
            <a href="<?= $coupon['url'] ?>" title="<?= $coupon['title']; ?>" target="_blank" class="coupon-popup-button" rel="nofollow">Get Deal</a>
        <?php endif; ?>
        <div class="<?= CouponPopup::$codeClass; ?>"><?= $coupon['code'] ?></div>
    </div>
</div>
<?php
$html = ob_get_contents();
ob_end_clean();
?>
<div class="<?= $container_class ?>">
    <?= $html ?>
</div>
<div class="<?= $popup_class ?>">
    <?= $html ?>
</div>