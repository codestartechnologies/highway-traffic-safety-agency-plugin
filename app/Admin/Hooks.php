<?php
/**
 * Hooks class file.
 *
 * This file contains Hooks class which which registers hooks that will run in admin area.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Admin;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Interfaces\FilterHook;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Hooks
 *
 * This class registers hooks that will run in admin area.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class Hooks implements ActionHook, FilterHook
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
        add_action( 'admin_init', array( $this, 'action_admin_init' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'action_admin_enqueue_scripts' ) );
    }

    /**
     * Register add_filter() and remove_filter().
     *
     * @return void
     * @since 1.0.0
     */
    public function register_add_filter() : void
    {
        add_filter( "manage_posts_columns", array( $this, 'filter_manage_posts_columns' ), 10, 2 );
    }

    /**
     * "init" action hook callback
     *
     * Fires after WordPress has finished loading but before any headers are sent.
     *
     * @return void
     * @since 1.0.0
     */
    public function action_init() : void
    {
        add_post_type_support( 'wps_post', 'page-attributes' );
        remove_post_type_support( 'page', 'thumbnail' );
        remove_post_type_support( 'page', 'comments' );
    }

    /**
     * Fires as an admin screen or script is being initialized.
     *
     * @return void
     * @since 1.0.0
     */
    public function action_admin_init() : void
    {
        $this->delete_depreciated_meta_keys();
    }

    /**
     * Deletes depreciated meta keys.
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function delete_depreciated_meta_keys() : void
    {
        if ( wp_doing_ajax() ) {
            return;
        }

        global $wpdb;

        $check = $wpdb->get_results( $wpdb->prepare(
            "SELECT * FROM `{$wpdb->postmeta}` WHERE `meta_key` IN (%s,%s,%s);",
            array( 'htsa_officer_zone', 'htsa_branch_location', 'htsa_penalty_currency_symbol', )
        ) );

        if ( $wpdb->num_rows > 0 ) {
            delete_post_meta_by_key( 'htsa_officer_zone' );
            delete_post_meta_by_key( 'htsa_branch_location' );
            delete_post_meta_by_key( 'htsa_penalty_currency_symbol' );
        }
    }

    /**
     * "admin_enqueue_scripts" action hook callback
     *
     * Enqueue scripts for all admin pages.
     *
     * @param string $hook_suffix
     * @return void
     * @since 1.0.0
     */
    public function action_admin_enqueue_scripts( string $hook_suffix ) : void
    {
        $screen = get_current_screen();

        // var_dump( $hook_suffix, $screen );

        /* if ( $screen->post_type === 'wps_post' && $screen->taxonomy === 'wps_post_category' && $screen->base === 'edit-tags' ) {

            wp_register_style( 'css-handle', 'path-to-css', array(), false, 'all' );

            wp_register_script( 'js-handle', 'path-to-js', array(), false, true );

            wp_set_script_translations( 'js-handle', 'wps' );

            wp_enqueue_style( 'css-handle' );

            wp_enqueue_script( 'js-handle' );

            wp_enqueue_editor();

            wp_enqueue_media();

            $data = 'jQuery( function ( $ ) { $.each( jQuery( ".wps-textarea" ), function ( index, editor ) { wp.editor.initialize( jQuery( editor ).attr( "id" ), { tinymce: true } ); } ); } );';
            wp_add_inline_script( 'editor', $data );

        } */

        $post_types_with_editor_arr = array(
            HTSA_BRANCHES_POST_TYPE,
            HTSA_REVIEWS_POST_TYPE,
        );

        if ( in_array( $screen->post_type, $post_types_with_editor_arr, true )  && $screen->base === 'post' ) {
            wp_enqueue_editor();
            $data = 'jQuery( function ( $ ) { $.each( jQuery( ".htsa-textarea" ), function ( index, editor ) { wp.editor.initialize( jQuery( editor ).attr( "id" ), { tinymce: true } ); } ); } );';
            wp_add_inline_script( 'editor', $data );
        }

        if ( $hook_suffix === 'toplevel_page_htsa-plugin-menu' ) {
            wp_enqueue_style( 'htsa-plugin-htsa-menu', HTSA_PLUGIN_HTSA_MENU_CSS, array(), HTSA_PLUGIN_VERSION );
        }
    }

    /**
     * Filters the columns displayed in the Posts list table.
     *
     * @param string[] $post_columns An associative array of column headings.
     * @param string   $post_type    The post type slug.
     * @return string[] An associative array of column headings.
     * @since 1.0.0
     */
    public function filter_manage_posts_columns( array $post_columns, string $post_type ) : array
    {
        $screen = get_current_screen();

        if ( $screen->post_type === HTSA_REVIEWS_POST_TYPE ) {
            unset( $post_columns['title'] );
        }

        return $post_columns;
    }

}