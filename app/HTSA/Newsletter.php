<?php
/**
 * Newsletter class file.
 *
 * This file contains Newsletter class which is used for sending email notification to subscribers about a new post.
 *
 * @package    HighwayTrafficSecurityAgencyPlugin
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since      1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\HTSA;

use stdClass;
use wpdb;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Newsletter Class
 *
 * This class is used for sending email notification to subscribers about a new post.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class Newsletter
{

    /**
     * Mailer class
     *
     * @access protected
     * @var Mailer
     * @since 1.0.0
     */
    protected Mailer $mailer;

    /**
     * wpdb class
     *
     * @var wpdb
     * @since 1.0.0
     */
    protected wpdb $wpdb;

    /**
     * Database table name
     *
     * @var string
     * @since 1.0.0
     */
    protected string $table_name;

    /**
     * Newsletter constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        global $wpdb;

        $this->mailer = new Mailer();
        $this->wpdb = $wpdb;
        $this->table_name = HTSA_PLUGIN_DB_TABLE_PREFIX . 'newsletters';
    }

    /**
     * Method for sending email notification to subscribers.
     *
     * @param \WP_Post $post
     * @param string $title
     * @param string $content
     * @return void
     * @since 1.0.0
     */
    public function send_newsletters( \WP_Post $post, string $title, string $content ) : void
    {
        $subscribers = $this->get_subscribers();

        if ( empty( $subscribers ) ) {
            return;
        }

        $site_name = get_bloginfo( 'name' );
        $db_receipents = get_option( 'htsa_smtp_receipents', array() );
        $secret_phrase = get_option( 'htsa_smtp_secret_phrase', array() );
        $sender = $db_receipents['htsa_email_sender'] ?? '';
        $secret_phrase = $secret_phrase['htsa_email_hash_phrase'] ?? '';
        $site_token = password_hash( $secret_phrase, PASSWORD_DEFAULT );

        $this->mailer->encryption_mode    = HTSA_PLUGIN_SMTP_ENCRYPTION_MODE;
        $this->mailer->is_html            = true;
        $this->mailer->subject            = $title . ' - ' . $site_name;
        $this->mailer->from( $sender, $site_name );

        foreach ( $subscribers as $subscriber ) {
            $token                      = urlencode( md5( $subscriber->id . $subscriber->created_at ) . '|' .  $site_token );
            $unsubscribe_url            = site_url( 'email-subscription?action=unsubscribe&email=' . $subscriber->email. '&token=' . $token );
            $message                    = $this->generate_email_content( $post, $content, $unsubscribe_url );
            $this->mailer->body         = $message;
            $this->mailer->alt_body     = wp_strip_all_tags( $message );
            $this->mailer->to( $subscriber->email );
            $this->mailer->send();
        }
    }

    /**
     * Retrieves all valid subscribers from database.
     *
     * @return null|stdClass|array
     * @since 1.0.0
     */
    private function get_subscribers() : null|stdClass|array
    {
        return $this->wpdb->get_results( $this->wpdb->prepare( "SELECT * FROM `{$this->table_name}` WHERE `valid`=%s", array( '1' ) ) );
    }

    /**
     * Generate content for the email.
     *
     * @param string $content
     * @param \WP_Post $post
     * @param string $unsubscribe_url
     * @return string
     * @since 1.0.0
     */
    private function generate_email_content( \WP_Post $post, string $content, string $unsubscribe_url ) : string
    {
        $site_name = get_bloginfo( 'name' );
        $site_logo_url = ( has_custom_logo() ) ? wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) : null;
        $post_thumbnail_url = get_the_post_thumbnail_url( $post->ID, 'large' );
        $post_content = wp_trim_words( wp_strip_all_tags( strip_shortcodes( $content ) ), 60 );
        $post_url = get_the_permalink( $post->ID );

        $template = '<div style="margin: auto;max-width: 600px;font-family: Arial, Helvetica, sans-serif;">';
        $template .= ( $site_logo_url ) ? '<img src="' . $site_logo_url . '" alt="" style="display: block;max-width: 90px;height: auto;margin: auto;" />' : '';
        $template .= '<p style="text-align: center;font-weight: 600;text-transform: capitalize;">' . $site_name . '</p>';
        $template .= '<h3 style="color: #1f1f1c;font-size: 25px;text-transform: uppercase;font-weight: 700;text-align: center;margin: auto;max-width: 500px;">'  . $post->post_title . '</h3> <br />';
        $template .= '<div style="background-color: #cfcf05;padding: 12px 17px;">';
        $template .= ( $post_thumbnail_url ) ? '<div style="padding: 10px 0;"><img src="' . $post_thumbnail_url . '" alt="" style="display: block;max-width: 100%;height: auto;margin: auto;border: 2px solid #1a1919;" /></div>' : '';
        $template .= '<div style="background-color: #fffaf3;color: #17011d;font-size: 16px;padding: 10px 9px 20px;">';
        $template .= '<p>' . $post_content . '</p>';
        $template .= '<br /> <a href="' . $post_url . '" style="text-decoration: none;display: inline-block;padding: 8px;border-radius: 5px;background-color: #0f0f13;color: #ffff00;cursor: pointer;font-size: 14px;">';
        $template .= esc_html__( 'Read full article', 'htsa-plugin' );
        $template .= '</a>';
        $template .= '</div>';
        $template .= '<div style="color: #fcf1e0;font-size: 15px;text-align: center;padding: 7px;background-color: #0f0f13;">';
        $template .= sprintf( __( 'Click <a href="%s" style="color: #ffff00;font-size: 14px;">here</a> to unsubscribe from this newsletter.', 'htsa-plugin' ), $unsubscribe_url );
        $template .= '</div></div></div>';
        return $template;
    }
}