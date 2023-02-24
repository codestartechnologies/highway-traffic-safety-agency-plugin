/**
 * newsletter-form.js
 * https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 *
 * Copyright 2022 Codestar Technologies
 * Released under AGPL-3.0-or-later
 * https://www.gnu.org/licenses/agpl-3.0.en.html
 */

jQuery( function ($) {

    const { __ } = wp.i18n;

    // process newsletter form request
    jQuery( document ).on( 'submit', 'form[data-htsa-id="newsletterForm"]', function ( evt ) {
        evt.preventDefault();
        evt.stopPropagation();

        let form, fields, btn, btn_content;
        form = $( this );
        fields = form.find( 'input, textarea' );
        btn = form.find( 'button[type="submit"]' );
        btn_content = btn.html();

        form.process_post_request(
            HTSA_NEWSLETTER_FORM_REQUEST,
            function () {
                if ( fields.val() === '' ) {
                    alert( __( 'All fields are required', 'htsa-plugin' ) );
                    return false;
                }

                return true;
            },
            {
                req_start: function() {
                    btn.html( __( 'Please wait...', 'htsa-plugin' ) ).attr( 'disabled', true );
                },
                req_success: function( msg ) {
                    alert( msg );
                },
                req_complete: function() {
                    fields.val( '' );
                },
                req_failed: function() {
                    alert( __( 'Newsletter form request could not be sent!', 'htsa-plugin' ) );
                },
                req_always: function() {
                    btn.html( btn_content ).removeAttr( 'disabled' );
                },
            }
        )
    } );

} ) ;
