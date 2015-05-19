jQuery(function (){
    window.__popupData = function(){
        return clickedLink;
    };
    var clickedLink,
        popupLink;

    try {
        if (window.opener) {
            popupLink = window.opener.__popupData();

            var $container = popupLink.parents('.coupon-popup-container');
            var $popup = $container.next('.coupon-popup-popup');

            var theme = popupLink.data('theme');
            var style = popupLink.data('style');
            var themeClass = theme + ' ' + style;
            var cssClasses = popupLink.data('classes');

            // Don't create buttons
            vex.dialog.buttonsToDOM = function() { return "" }

            vex.dialog.alert({
                message: $popup.html(),
                className: 'coupon-popup coupon-popup-override coupon-popup-vex ' + themeClass,
                showCloseButton: true,
                afterOpen: function($vexContent) {
                    $vexContent.addClass('coupon-popup-container popup ' + cssClasses);

                    // Show and hide reveal divs
                    jQuery('.coupon-popup-container').addClass('revealed');
                }
            });

            window.opener.location.href = popupLink.data('url');
        }
    } catch(err) {
    }

    jQuery('body').on('click', '.' + settings.linkClass, function(e){
        var el = jQuery(this),
            openedWindow, openedDocument, remoteContainer;
        if (el.data('pop')) {
            clickedLink = el;
            window.open(window.location.href);
        } else {
            window.open(el.data('url'));
        }
        e.preventDefault();
    });

    jQuery('body').on('click', '.' + settings.popupLinkClass, function(e){
        var el = jQuery(this);
        dialog.dialog('close');
        window.open(el.data('url'));
    });

    function fillDialog(dialogContainer, el){
        var dialogWrapper = dialogContainer.find('.'+settings.classPrefix+'dialog-wrapper'),
            dialogCode = dialogContainer.find('h4'),
            dialogImage = dialogContainer.find('img'),
            dialogDescription = dialogContainer.find('.popup_content'),
            dialogFoot = dialogContainer.find('.'+settings.classPrefix+'dialog-foot');

        dialogWrapper.addClass(el.data('type'));
        dialogCode.text(el.data('code'));
        dialogImage.attr('src', el.data('image'));
        dialogDescription.text(el.data('description'));
        dialogFoot.empty();
        dialogFoot.append(constructLink(el));
    }
    function constructLink(el)
    {
        return [
            '<button href="" class="btn btn-primary btn-lg btn-block ',
            settings.popupLinkClass,
            '" data-url="',
            el.data('url'),
            '">',
            el.attr('title'),
            '</button>'
        ].join('');
    }
});