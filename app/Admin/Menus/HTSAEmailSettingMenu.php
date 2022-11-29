<?php
/**
 * HTSAEmailSettingMenu class file.
 *
 * This file contains HTSAEmailSettingMenu class that will register a custom admin setting menu page.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\Menus;

use Codestartechnologies\WordpressPluginStarter\Abstracts\OptionsMenus;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'HTSAEmailSettingMenu' ) ) {
    /**
     * HTSAEmailSettingMenu Class
     *
     * This class registers a custom admin setting menu page.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAEmailSettingMenu extends OptionsMenus {
        /**
         * HTSAEmailSettingMenu Constructor
         */
        public function __construct()
        {
            $this->page_title   = esc_html__( 'Email Credentials Settings', 'htsa' );
            $this->menu_title   = esc_html__( 'Email Settings', 'htsa' );
            $this->capability   = 'manage_options';
            $this->menu_slug    = 'htsa-email-setting';
            $this->view         = 'admin-menu-pages.email-settings';
        }

        /**
         * Check before adding the menu page
         *
         * @return boolean
         */
        public function can_add_menupage() : bool
        {
            return true;
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
            return array(
                'page'  => $this->menu_slug,
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
            return esc_html__( 'Highway Traffic Security Agency WordPress Plugin', 'htsa' );
        }
    }
}