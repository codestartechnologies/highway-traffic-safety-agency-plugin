/**
 * public-ajax.js
 * https://github.com/codestartechnologies/wordpress-plugin-starter
 *
 * Copyright 2022 Codestar Technologies
 * Released under AGPL-3.0-or-later
 * https://www.gnu.org/licenses/agpl-3.0.en.html
 */

jQuery( function ($) {

    const { __ } = wp.i18n;

    // process wps ajax button
    jQuery( 'button[data-id="wps_public_ajax_btn"]' ).on( 'click', function ( evt ) {
        evt.preventDefault();
        evt.stopPropagation();
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
    jQuery( document ).on( 'submit', 'form[data-htsa-id="contactForm"]', function ( evt ) {
        evt.preventDefault();
        let fields, btn;
        fields = $( 'form[data-htsa-id="contactForm"] input, form[data-htsa-id="contactForm"] textarea' );
        btn = $( 'form[data-htsa-id="contactForm"] button[type="submit"]' );
        if ( fields.val() === '' ) {
            alert( __( 'All fields are required', 'htsa-plugin' ) );
        } else {
            btn.hide().next().show();
            $.post(
                WPS_PUBLIC_AJAX_REQUEST.ajax_url,
                {
                    _ajax_nonce: WPS_PUBLIC_AJAX_REQUEST.nonce,
                    action: WPS_PUBLIC_AJAX_REQUEST.action,
                    data: $( 'form[data-htsa-id="contactForm"]' ).serialize()
                },
                function ( resp ) {
                    if ( resp.success ) {
                        alert( resp.data.msg );
                    }
                }
            )
            .done( function () {
                fields.val( '' );
            } )
            .fail( function () {
                alert( __( 'Contact form request could not be sent!', 'htsa-plugin' ) );
            } )
            .always( function () {
                btn.show().next().hide();
            } );
        }
    } );

} ) ;
