<?php
/**
 * WPSAdminNotice class file.
 *
 * This file contains WPSAdminNotice class that will register a custom admin notification.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\AdminNotices;

use Codestartechnologies\WordpressPluginStarter\Abstracts\AdminNotices;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPSAdminNotice' ) ) {
    /**
     * Class WPSAdminNotice
     *
     * This class registers a custom admin notification.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class WPSAdminNotice extends AdminNotices {
        /**
         * WPSAdminNotice constructor
         */
        public function __construct()
        {
            $this->type = 'info';
        }

        /**
         * The notification message
         *
         * @return array
         */
        public function get_message() : string
        {
            return esc_html__( 'Thanks for using WordPress Plugin Starter!', 'wps' );
        }
    }
}