<?php
/**
 * HooksService class file.
 *
 * This file contains HooksService class which contains methods that will be used inside HTSA_Plugin\WPS_Plugin\App\Hooks::class.
 *
 * @package    HighwayTrafficSecurityAgencyPlugin
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since      1.0.2
 */

namespace HTSA_Plugin\WPS_Plugin\App\HTSA;

// Prevent direct access to this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * HooksService class
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HooksService
{
    /**
     * Newsletter class
     *
     * @access protected
     * @var Newsletter
     * @since 1.0.2
     */
    protected Newsletter $newsletter;

    /**
     * HooksService constructor
     *
     * @return void
     * @since 1.0.2
     */
    public function __construct()
    {
        $this->newsletter = new Newsletter();
    }

    /**
     * Checks if a post is published.
     *
     * @param string $new_status
     * @param string $old_status
     * @param \WP_Post $post
     * @return boolean
     * @since 1.0.2
     */
    public function newsletters_post_status_failed( string $new_status, string $old_status, \WP_Post $post ) : bool
    {
        return (
            ( ! wps_save_post_action_check( $post->ID ) ) ||
            ( 'publish' !== $new_status ) ||
            ( ! in_array( $old_status, array( 'auto-draft', 'draft', 'pending', ), true ) )
        );
    }

    /**
     * Send newsletters for posts.
     *
     * @param \WP_Post $post
     * @return void
     * @since 1.0.2
     */
    public function send_posts_newsletters( \WP_Post $post ) : void
    {
        $this->newsletter->send_newsletters( $post, $post->post_title, $post->post_content );
    }
}