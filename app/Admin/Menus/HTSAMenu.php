<?php
/**
 * HTSAMenu class file.
 *
 * This file contains HTSAMenu class that will register a custom admin menu page.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Admin\Menus;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\Menus;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * HTSAMenu Class
 *
 * This class registers a custom admin menu page.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSAMenu extends Menus
{
    /**
     * HTSAMenu constructor
     *
     */
    public function __construct()
    {
        $this->page_title   = sprintf( esc_html__( '%s By Codestar Technologies', 'htsa-plugin' ), HTSA_PLUGIN_NAME );
        $this->menu_title   = HTSA_PLUGIN_NAME;
        $this->capability   = 'manage_options';
        $this->menu_slug    = 'htsa-plugin-menu';
        $this->icon_url     = 'dashicons-car';
        $this->position     = 66;
        $this->view         = 'admin-menu-pages.htsa-menu';
    }

    /**
     * Fires before a particular screen is loaded. Example can be to handle POST or GET request sent to the menu page
     *
     * @return void
     */
    public function load_page() : void
    {
        //
    }

    /**
     * Arguements to pass to the menu page view
     *
     * @return array
     */
    public function menu_page_view_args() : array
    {
        return array();
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
            HTSA_PLUGIN_NAME, HTSA_PLUGIN_AUTHOR_URI, HTSA_PLUGIN_AUTHOR
        );

        return $text;
    }
}