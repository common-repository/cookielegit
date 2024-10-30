jQuery(function ($) {
    $('.notice-type-option').on('change', function(){
        const noticeType = $(this).val();
        $('.banner-position-options').addClass('hide');
        $(`.banner-position-options[data-notice-type="${noticeType}"]`).removeClass('hide');
        $(`.banner-position-options[data-notice-type="${noticeType}"]`).find('input').first().prop('checked', true);
    });

    $('#pixel-settings-consent-mode').on('change', function(){
        const active = $(this).is(':checked');

        if(active) {
            $('.row-pixel:not(.row-google_tag_manager)').addClass('hide')
        } else {
            $('.row-pixel:not(.row-google_tag_manager)').removeClass('hide')
        }

    });

    $(window).on('scroll', function(){
        const formHeader = $('.cl-form-header');
        const adminBar = $('#wpadminbar');
        
        if(formHeader.offset().top === (adminBar.offset().top + adminBar.height())) {
            formHeader.addClass('is-stuck');
        } else {
            formHeader.removeClass('is-stuck');
        }
    });
})