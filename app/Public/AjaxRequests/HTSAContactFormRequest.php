<?php
/**
 * HTSAContactFormRequest class file.
 *
 * This file contains HTSAContactFormRequest class that will register a custom public ajax request.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Public\AjaxRequests;

use Codestartechnologies\WordpressPluginStarter\Abstracts\PublicAjax;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'HTSAContactFormRequest' ) ) {
    /**
     * Class HTSAContactFormRequest
     *
     * This class registers a custom admin public request.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAContactFormRequest extends PublicAjax {
        /**
         * HTSAContactFormRequest Class Constructor
         *
         */
        public function __construct()
        {
            $this->ajax_action          = 'wps_public_ajax_request';
            $this->nonce_action         = 'wps_public_ajax_request_nonce';
            $this->script_handle        = 'wps_public_ajax_js';
            $this->script_src           = WPS_JS_BASE_URL . 'public-ajax.js';
            $this->script_dependencies  = array( 'jquery' );
            $this->script_version       = false;
            $this->script_in_footer     = true;
        }

        /**
         * Method for handling the ajax request after ajax nonce action have been validated
         *
         * @return void
         */
        public function handle_request(): void
        {
            $data = $_POST['data'] ?? null;
            $post_arr = array();
            parse_str( $data, $post_arr );

            $name = $post_arr['name'] ?? null;
            $email = $post_arr['email'] ?? null;
            $message = $post_arr['message'] ?? null;

            $response_msg = esc_html__( 'We are yet to start processing contact requests, retry in a week time. Thank you!');
            wp_send_json_success( array(
                'msg'  => $response_msg,
            ) );
        }
    }
}