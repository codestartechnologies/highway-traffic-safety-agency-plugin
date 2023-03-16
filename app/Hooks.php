<?php
/**
 * Hooks class file.
 *
 * This file contains Hooks class which registers hooks that will run at the fornt-end and adminarea.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Interfaces\FilterHook;
use HTSA_Plugin\WPS_Plugin\App\HTSA\Newsletter;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Hooks
 *
 * This class registers hooks that will run at the fornt-end and admin area.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
class Hooks implements ActionHook, FilterHook
{
    /**
     * Register add_action() and remove_action().
     *
     * @return void
     * @since 1.0.0
     */
    public function register_add_action() : void
    {
        add_action( 'init', array( $this, 'action_init' ) );
        add_action( 'pre_get_posts', array( $this, 'action_pre_get_posts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'action_wp_enqueue_scripts' ) );
        add_action( 'transition_post_status', array( $this, 'action_transition_post_status' ), 10, 3 );
    }

    /**
     * Register add_filter() and remove_filter().
     *
     * @return void
     * @since 1.0.0
     */
    public function register_add_filter() : void
    {
        add_filter( 'show_admin_bar', array( $this, 'filter_show_admin_bar' ) );
        // add_filter( 'the_content', array( $this, 'filter_the_content' ) );
    }

    /**
     * Fires after WordPress has finished loading but before any headers are sent.
     *
     * @return void
     * @since 1.0.0
     */
    public function action_init() : void {
        $path = dirname( plugin_basename( WPS_FILE ) ) . '/languages/';
        load_plugin_textdomain( 'wps', false, $path );
    }

    /**
     * "pre_get_posts" action hook callback
     *
     * Fires after the query variable object is created, but before the actual query is run.
     *
     * @param \WP_Query $query The WP_Query instance (passed by reference).
     * @return void
     * @since 1.0.0
     */
    public function action_pre_get_posts( \WP_Query $query ) : void
    {
        if ( ! is_admin() && $query->is_main_query() ) {

            if ( is_search() ) {
                $query->set( 'posts_per_page', 10 );
            }

            if ( is_post_type_archive( array( HTSA_PENALTIES_POST_TYPE, HTSA_OFFICERS_POST_TYPE ) ) ) {
                $query->set( 'posts_per_page', 15 );
            }

            if ( is_search() || is_post_type_archive( array( HTSA_PENALTIES_POST_TYPE, HTSA_BRANCHES_POST_TYPE ) ) ) {
                $query->set( 'order', 'ASC' );
            }

            if ( is_post_type_archive( 'wps_post' ) ) {

                $tax_array = array();

                $tax_array['relation'] = 'AND';

                if ( isset( $_GET['category'] ) && ! empty( $_GET['category'] ) ) {
                    $tax_array[] = array(
                        'taxonomy'  => 'wps_post_category',
                        'field'     => 'slug',
                        'terms'     => sanitize_text_field( $_GET['category'] ),
                    );
                }

                $query->set( 'tax_query', $tax_array );

                $author = $_GET['author'] ?? null;

                if ( ! empty( $author ) ) {
                    $query->set( 'meta_key', 'wps_post_author_name' );
                    $query->set( 'meta_value', sanitize_text_field( $author ) );
                    $query->set( 'meta_compare', '=' );
                }

            }

        }
    }

    /**
     * "wp_enqueue_scripts" action hook callback
     *
     * Fires when scripts and styles are enqueued.
     *
     * @return void
     * @since 1.0.0
     */
    public function action_wp_enqueue_scripts() : void
    {
        wp_set_script_translations( 'wps_public_ajax_js', 'htsa-plugin' );
        wp_set_script_translations( 'htsa_contact_form', 'htsa-plugin' );
        wp_set_script_translations( 'htsa_newsletter_form', 'htsa-plugin' );
        wp_enqueue_script( 'htsa_helpers', WPS_JS_BASE_URL . 'helpers.js', array( 'jquery' ), HTSA_PLUGIN_VERSION, true );
    }

    /**
     * Fires when a post is transitioned from one status to another.
     *
     * @param string   $new_status New post status.
     * @param string   $old_status Old post status.
     * @param \WP_Post $post       Post object.
     * @return void
     * @since 1.0.0
     */
    public function action_transition_post_status( string $new_status, string $old_status, \WP_Post $post ) : void
    {
        if (
            ( ! wps_save_post_action_check( $post->ID ) ) ||
            ( 'publish' !== $new_status ) ||
            ( ! in_array( $old_status, array( 'auto-draft', 'draft', 'pending', ), true ) )
        ) {
            return;
        }

        // send email
        $newsletters = new Newsletter();
        $newsletters->send_newsletters( $post );
    }

    /**
     * "show_admin_bar" filter hook callback
     *
     * Filters whether to show the admin bar.
     *
     * @param bool $show_admin_bar Whether the admin bar should be shown. Default false.
     * @return bool Whether the admin bar should be shown. Default false.
     * @since 1.0.0
     */
    public function filter_show_admin_bar( bool $show_admin_bar ) : bool
    {
        $check = ( current_user_can( 'manage_options' ) || current_user_can( 'administrator' ) );
        return ( $check ) ? $show_admin_bar : false;
    }

    /**
     * "the_content" filter hook callback
     *
     * Filters the post content.
     *
     * @param string $content Content of the current post.
     * @return string Content of the current post.
     * @since 1.0.0
     */
    public function filter_the_content( string $content ) : string {
        $ajax_button = __( '<p><br /><button data-id="wps_public_ajax_btn" style="padding: 9px;background-color: teal;color: #fff;cursor: pointer;border: 0;">Click to make an AJAX request!</button><b>You must be logged out to test this functionality</b></p><br />', 'wps' );
        $content .= $ajax_button;
        return $content;
    }

}