<?php
/**
 * HTSAContactFormRequest class file.
 *
 * This file contains HTSAContactFormRequest class that will register a custom public ajax request.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Public\AjaxRequests;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\PublicAjax;
use HTSA_Plugin\WPS_Plugin\App\HTSA\Mailer;

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
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
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

            $email = sanitize_email( $post_arr['email'] ?? '' );
            $name = sanitize_text_field( $post_arr['name'] ?? '' );
            $message = sanitize_textarea_field( $post_arr['message'] ?? '' );

            $db_receipents = \get_option( 'htsa_smtp_receipents' );
            $receiver = $db_receipents['htsa_email_receiver'] ?? '';
            $sender = $db_receipents['htsa_email_sender'] ?? '';

            $mailer                     = new Mailer();
            // $mailer->debug_mode         = 'dev_client_server';
            $mailer->encryption_mode    = 'ssl';
            $mailer->is_html            = false;
            $mailer->subject            = 'New Contact Request From ' . $name;
            $mailer->body               = $message;
            $mailer->alt_body           = esc_html( $message );

            $status = $mailer->from( $sender, get_bloginfo( 'name' ) )->to( $receiver )->reply_to( $email, $name )->send();

            if ( $status ) {
                $response_msg = esc_html__( 'We have received your message, and will get back to you shortly.', 'htsa' );

                $message = 'We have received your message, and will get back to you shortly.';

                $mailer                     = new Mailer();
                // $mailer->debug_mode         = 'dev_client_server';
                $mailer->encryption_mode    = 'ssl';
                $mailer->is_html            = false;
                $mailer->subject            = 'We have received your message!';
                $mailer->body               = $message;
                $mailer->alt_body           = esc_html( $message );

                $mailer->from( $sender, get_bloginfo( 'name' ) )->to( $email )->send();

            } else {
                $response_msg = esc_html__( 'An error prevented your message from being sent. Please refresh the page and try again.', 'htsa' );
            }

            wp_send_json_success( array( 'msg'  => $response_msg, ) );
        }
    }
}