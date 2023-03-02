<?php
/**
 * HTSANewsletterFormRequest class file.
 *
 * This file contains HTSANewsletterFormRequest class that will register an ajax request for subscribing to newsletters.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Public\AjaxRequests;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\PublicAjax;
use HTSA_Plugin\WPS_Plugin\App\HTSA\Mailer;
use stdClass;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class HTSANewsletterFormRequest
 *
 * This class registers a custom admin public request.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSANewsletterFormRequest extends PublicAjax
{
    /**
     * Table Name
     *
     * @access private
     * @var string
     * @since 1.0.0
     */
    private string $table_name;

    /**
     * Mailer class
     *
     * @access private
     * @var Mailer
     * @since 1.0.0
     */
    private Mailer $mailer;

    /**
     * HTSANewsletterFormRequest Constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->ajax_action          = 'htsa_newsletter_form_request';
        $this->nonce_action         = 'htsa_newsletter_form_request_nonce';
        $this->script_handle        = 'htsa_newsletter_form';
        $this->script_src           = WPS_JS_BASE_URL . 'newsletter-form.js';
        $this->script_dependencies  = array( 'jquery', 'htsa_helpers' );
        $this->script_version       = HTSA_PLUGIN_VERSION;
        $this->script_in_footer     = true;
        $this->constant_identifier  = 'HTSA_NEWSLETTER_FORM_REQUEST';
        $this->table_name           = HTSA_PLUGIN_DB_TABLE_PREFIX . 'newsletters';
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
        $token = bin2hex( random_bytes( 20 ) );

        $response_msg = esc_html__( 'An error prevented your email from being subscribed. Please refresh the page and try again.', 'htsa-plugin' );

        if ( wps_db_table_exists( $this->table_name ) ) {
            $email_query = $this->email_exists( $email );

            if ( is_null( $email_query ) && ( false !== $this->add_subscription( $name, $email, $token ) ) ) {
                $response_msg = esc_html__( 'Your subscription has been added! Wait for a verification link in your inbox.', 'htsa-plugin' );

                if ( $this->send_email( $name, $email, $token ) ) {
                    $response_msg = esc_html__( 'Your subscription has been added! Please verify your email address.', 'htsa-plugin' );
                }
            } else {
                $response_msg = esc_html__( 'This email has already been taken. Choose another email', 'htsa-plugin' );
            }
        }

        wp_send_json_success( array( 'msg'  => $response_msg, ) );
    }

    /**
     * Check for existing email address
     *
     * @access private
     * @param string $email
     * @return null|stdClass
     * @since 1.0.0
     */
    private function email_exists( string $email ) : null|stdClass
    {
        global $wpdb;

        // Check if email exists in database
        $check = $wpdb->get_row( $wpdb->prepare(
            "SELECT email, valid FROM `{$this->table_name}` WHERE email=%s",
            array( $email )
        ) );

        return $check;
    }

    /**
     * Add user subscription details to database
     *
     * @access private
     * @param string $name
     * @param string $email
     * @param [type] $token
     * @return integer|false
     * @since 1.0.0
     */
    private function add_subscription( string $name, string $email, $token ) : int|false
    {
        global $wpdb;

        // Insert records in database
        $result = $wpdb->insert(
            $this->table_name,
            array(
                'name'  => $name,
                'email' => $email,
                'token' => $token,
            ),
            array( '%s', '%s', '%s' )
        );

        return $result;
    }

    /**
     * Send a verification link to user email address
     *
     * @access private
     * @param string $name
     * @param string $email
     * @param string $token
     * @return boolean
     * @since 1.0.0
     */
    private function send_email( string $name, string $email, string $token ) : bool
    {
        $site_name = get_bloginfo( 'name' );
        $confirm_link = site_url( sprintf( 'email-confirmation?email=%1$s&token=%2$s', $email, $token ) );
        $message = sprintf( __(
            '
                <h3>Hello %1$s! Thanks for subscribing to %2$s newsletter.</h3>
                <p>In order to verify that this email belongs to you, please click on the confirm email link below.</p>
                <br />
                <a href="%3$s">Confirm Email</a>
            ',
            'htsa-plugin'
        ), $name, $site_name, $confirm_link );

        $db_receipents = \get_option( 'htsa_smtp_receipents' );
        $sender = $db_receipents['htsa_email_sender'] ?? '';

        // $this->mailer->debug_mode         = 'dev_client_server';
        $this->mailer->encryption_mode    = $_ENV['HTSA_PLUGIN_SMTP_ENCRYPTION_MODE'];
        $this->mailer->is_html            = true;
        $this->mailer->subject            = sprintf( esc_html__( 'Confirm Your Email Address! - %s'), $site_name );
        $this->mailer->body               = $message;
        $this->mailer->alt_body           = esc_html( $message );

        return $this->mailer->from( $sender, $site_name )->to( $email )->send();
    }
}