jQuery( function ($) {
    jQuery( 'button[data-id="wps_public_ajax_btn"]' ).on( 'click', function ( evt ) {
        evt.preventDefault();
        evt.stopPropagation();;
        let req_data = {
            _ajax_nonce: WPS_PUBLIC_AJAX_REQUEST.nonce,
            action: WPS_PUBLIC_AJAX_REQUEST.action,
            wps_data: 'Hello WPS!'
        };
        $.post( WPS_PUBLIC_AJAX_REQUEST.ajax_url, req_data, function ( resp ) {
            if ( resp.success ) {
                alert( resp.data.msg );
            }
        } );
    });

    // process contact form request
    jQuery( document ).on( 'submit', 'form[data-htsa-id="contactForm_"]', function ( evt ) {
        evt.preventDefault();
        let fields, btn;
        fields = $( 'form[data-htsa-id="contactForm_"] input, form[data-htsa-id="contactForm_"] textarea' );
        btn = $( 'form[data-htsa-id="contactForm_"] button[type="submit"]' );
        if ( fields.val() === '' ) {
            alert( 'All fields are required' );
        } else {
            btn.hide().next().show();
            $.post(
                WPS_PUBLIC_AJAX_REQUEST.ajax_url,
                {
                    _ajax_nonce: WPS_PUBLIC_AJAX_REQUEST.nonce,
                    action: WPS_PUBLIC_AJAX_REQUEST.action,
                    data: $( 'form[data-htsa-id="contactForm_"]' ).serialize()
                },
                function ( resp ) {
                    btn.show().next().hide();
                    if ( resp.success ) {
                        fields.val( '' );
                        alert( resp.data.msg );
                    }
                }
            );
        }
    } );
} ) ;
