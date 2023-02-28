<?php
/**
 * NewsletterSubscriptions class file.
 *
 * This file contains NewsletterSubscriptions class that will add an admin menu page for displaying newsletter subscriptions.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Admin\Menus;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\Menus;
use HTSA_Plugin\WPS_Plugin\App\HTSA\ListTables\NewslettersListTable;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * NewsletterSubscriptions Class
 *
 * This class will add an admin menu page for displaying newsletter subscriptions.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class NewsletterSubscriptions extends Menus {
    /**
     * NewslettersListTable class
     *
     * @var NewslettersListTable
     * @since 1.0.0
     */
    protected NewslettersListTable $newsletters_list_table;

    /**
     * NewsletterSubscriptions constructor
     *
     */
    public function __construct()
    {
        $this->page_title   = esc_html__( 'Newsletter Subscriptions', 'htsa-plugin' );
        $this->menu_title   = esc_html__( 'Newsletter Subscriptions', 'htsa-plugin' );
        $this->capability   = 'manage_options';
        $this->menu_slug    = 'htsa-newsletter-subscriptions';
        $this->icon_url     = 'dashicons-email';
        $this->position     = 9;
        $this->view         = 'admin-menu-pages.newsletter-subscriptions';

        if ( ! class_exists( 'WP_List_Table' ) ) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
        }
    }

    /**
     * Fires before a particular screen is loaded. Example can be to handle POST or GET request sent to the menu page
     *
     * @return void
     */
    public function load_page() : void
    {
        //
        $this->newsletters_list_table = new NewslettersListTable();
        $this->newsletters_list_table->prepare_items();
    }

    /**
     * Arguements to pass to the menu page view
     *
     * @return array
     */
    public function menu_page_view_args() : array
    {
        return array(
            'newsletters_table' => $this->newsletters_list_table,
        );
    }

    /**
     * The content to display in the footer of the admin menu page
     *
     * @param string $text
     * @return string
     */
    public function get_footer_content( string $text ) : string
    {
        $text = sprintf(
            __( '%1$s developed by <a href="%2$s" target="_blank">%3$s</a>', 'htsa-plugin' ),
            HTSA_PLUGIN_NAME, $_ENV['HTSA_PLUGIN_AUTHOR_URI'], $_ENV['HTSA_PLUGIN_AUTHOR']
        );

        return $text;
    }
}
