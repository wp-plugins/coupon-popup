<div class="<?= CouponPopup::$containerClass . ' ' . $coupon['type'] . ' ' . $coupon['theme'] . ' ' . $coupon['expiredClass']; ?>" data-id="<?= $coupon['id'] ?>">
    <?php if ($coupon['code']): ?>
        <h4 class="<?= CouponPopup::$codeClass; ?>"><?= $coupon['code'] ?></h4>
    <?php endif; ?>
    <?php if ($coupon['image']): ?>
        <div class="<?=CouponPopup::$classPrefix;?>col1">
            <img src="<?= $coupon['image']; ?>">
        </div>
    <?php endif; ?>
    <div class="<?=CouponPopup::$classPrefix;?>col2">
        <p class="<?=CouponPopup::$classPrefix;?>description"><?= $coupon['description']; ?></p>
        <button
            type="button"
            class="<?= CouponPopup::$linkClass; ?> btn btn-primary btn-lg btn-block"
            title="<?= $coupon['title']; ?>"
            data-description="<?= $coupon['description']; ?>"
            data-image="<?= $coupon['image']; ?>"
            data-url="<?= $coupon['url']; ?>"
            data-pop="<?= $coupon['pop']; ?>"
            data-code="<?= $coupon['code']; ?>"
            data-type="<?= $coupon['type']; ?>"
            data-popup_theme="<?=$coupon['popup_theme']?>"
            >
            <?= $coupon['title']; ?>
        </button>
    </div>
    <div class="<?=CouponPopup::$classPrefix; ?>clearfix"></div>
</div>
<div class="<?=$coupon['popup_theme'];?> <?= CouponPopup::$popupClass; ?>">
    <div class="<?=CouponPopup::$classPrefix;?>dialog-wrapper">
        <h4 class="<?= CouponPopup::$codeClass; ?>"></h4>
        <div class="<?=CouponPopup::$classPrefix;?>col1">
            <img src="">
        </div>
        <div class="<?=CouponPopup::$classPrefix;?>col2">
            <p class="popup_content"></p>
        </div>
        <div class="<?=CouponPopup::$classPrefix;?>clearfix"></div>
        <p class="<?=CouponPopup::$classPrefix;?>dialog-foot">

        </p>
    </div>
</div>