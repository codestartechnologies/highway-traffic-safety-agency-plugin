<?php
/**
 * URLStructureNotice class file.
 *
 * This file contains URLStructureNotice class for adding admin notification for website url structure setting.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Admin\AdminNotices;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\AdminNotices;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'URLStructureNotice' ) ) {
    /**
     * Class URLStructureNotice
     *
     * This class registers a custom admin notification for website url structure setting.
     *
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class URLStructureNotice extends AdminNotices {
        /**
         * URLStructureNotice constructor
         */
        public function __construct()
        {
            $this->type = 'warning';
            $this->dismissible = true;
        }

        /**
         * The notification message
         *
         * @return string
         */
        public function get_message() : string
        {
            return sprintf(
                __( '<b>%1$s</b>: Your current site URL structure might cause some links to be invalid. <a href="%2$s">Change the setting</a> to <b>Post name</b>.', 'htsa-plugin' ),
                HTSA_PLUGIN_NAME, admin_url( 'options-permalink.php' )
            );
        }

        /**
         * Pre check before printing notification
         *
         * @return boolean
         */
        protected function can_show_notice() : bool
        {
            return ( "/%postname%/" !== get_option( 'permalink_structure' ) );
        }
    }
}