<?php
/**
 * HTSAContactFormRequest class file.
 *
 * This file contains HTSAContactFormRequest class that will register an ajax request for contact form.
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
         * Mailer class
         *
         * @access private
         * @var Mailer
         * @since 1.0.0
         */
        private Mailer $mailer;

        /**
         * HTSAContactFormRequest Class Constructor
         *
         * @since 1.0.0
         */
        public function __construct()
        {
            $this->ajax_action          = 'htsa_contact_form_request';
            $this->nonce_action         = 'htsa_contact_form_request_nonce';
            $this->script_handle        = 'htsa_contact_form';
            $this->script_src           = WPS_JS_BASE_URL . 'contact-form.js';
            $this->script_dependencies  = array( 'jquery', 'htsa_helpers' );
            $this->script_version       = HTSA_PLUGIN_VERSION;
            $this->script_in_footer     = true;
            $this->constant_identifier  = 'HTSA_CONTACT_FORM_REQUEST';
            $this->mailer               = new Mailer();
        }

        /**
         * Method for handling the ajax request after ajax nonce action have been validated
         *
         * @return void
         * @since 1.0.0
         */
        public function handle_request() : void
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

            if ( $this->send_email_to_admins( $name, $message, $sender, $receiver, $email ) ) {
                $response_msg = esc_html__( 'We have received your message, and will get back to you shortly.', 'htsa-plugin' );
                $this->send_email_to_user( $sender, $email );
            } else {
                $response_msg = esc_html__( 'An error prevented your message from being sent. Please refresh the page and try again.', 'htsa-plugin' );
            }

            wp_send_json_success( array( 'msg'  => $response_msg, ) );
        }

        /**
         * Send email notification for contact request to site admins
         *
         * @access private
         * @param string $name
         * @param string $message
         * @param string $sender
         * @param string $receiver
         * @param string $email
         * @return boolean
         * @since 1.0.0
         */
        private function send_email_to_admins( string $name, string $message, string $sender, string $receiver, string $email ) : bool
        {
            // $this->mailer->debug_mode         = 'dev_client_server';
            $this->mailer->encryption_mode    = $_ENV['HTSA_PLUGIN_SMTP_ENCRYPTION_MODE'];
            $this->mailer->is_html            = false;
            $this->mailer->subject            = sprintf( esc_html__( 'New Contact Request From %s', 'htsa-plugin' ), $name );
            $this->mailer->body               = $message;
            $this->mailer->alt_body           = esc_html( $message );
            return $this->mailer->from( $sender, get_bloginfo( 'name' ) )->to( $receiver )->reply_to( $email, $name )->send();
        }

        /**
         * Send email notification to user
         *
         * @access private
         * @param string $sender
         * @param string $email
         * @return boolean
         * @since 1.0.0
         */
        private function send_email_to_user( string $sender, string $email ) : bool
        {
            $message = esc_html__( 'We have received your message, and will get back to you shortly.', 'htsa-plugin' );
            // $this->mailer->debug_mode         = 'dev_client_server';
            $this->mailer->encryption_mode    = $_ENV['HTSA_PLUGIN_SMTP_ENCRYPTION_MODE'];
            $this->mailer->is_html            = false;
            $this->mailer->subject            = esc_html__( 'We have received your message!', 'htsa-plugin' );
            $this->mailer->body               = $message;
            $this->mailer->alt_body           = esc_html( $message );
            return $this->mailer->from( $sender, get_bloginfo( 'name' ) )->to( $email )->send();
        }
    }
}