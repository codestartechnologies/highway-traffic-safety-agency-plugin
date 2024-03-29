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

} ) ;
