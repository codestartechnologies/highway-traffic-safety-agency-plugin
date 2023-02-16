( function ( $ ) {
    // process request
    $.fn.process_post_request = function ( constant_id, validation_cb, options ) {
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
                constant_id.ajax_url,
                {
                    _ajax_nonce: constant_id.nonce,
                    action: constant_id.action,
                    data: this.serialize()
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
} ( jQuery ) ) ;