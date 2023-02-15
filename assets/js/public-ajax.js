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
        evt.stopPropagation();

        let form, fields, btn;
        form = $( this );
        fields = form.find( 'input, textarea' );
        btn = form.find( 'button[type="submit"]' );

        process_request(
            form,
            function () {
                if ( fields.val() === '' ) {
                    alert( __( 'All fields are required', 'htsa-plugin' ) );
                    return false;
                }

                return true;
            },
            {
                req_start: function() {
                    btn.hide().next().show();
                },
                req_success: function( msg ) {
                    alert( msg );
                },
                req_complete: function() {
                    fields.val( '' );
                },
                req_failed: function() {
                    alert( __( 'Contact form request could not be sent!', 'htsa-plugin' ) );
                },
                req_always: function() {
                    btn.show().next().hide();
                },
            }
        )
    } );

    // process request
    function process_request( form, validation_cb, options ) {
        let settings = $.extend( {
            req_start: () => null,
            req_success: ( msg ) => null,
            req_complete: () => null,
            req_failed: () => null,
            req_always: () => null,
        }, options );

        if ( validation_cb() ) {
            settings.req_start();
            $.post(
                WPS_PUBLIC_AJAX_REQUEST.ajax_url,
                {
                    _ajax_nonce: WPS_PUBLIC_AJAX_REQUEST.nonce,
                    action: WPS_PUBLIC_AJAX_REQUEST.action,
                    data: form.serialize()
                },
                function ( resp ) {
                    if ( resp.success ) {
                        settings.req_success( resp.data.msg );
                    }
                }
            )
            .done( function () {
                settings.req_complete();
            } )
            .fail( function () {
                settings.req_failed();
            } )
            .always( function () {
                settings.req_always();
            } );
        }
    }

} ) ;
