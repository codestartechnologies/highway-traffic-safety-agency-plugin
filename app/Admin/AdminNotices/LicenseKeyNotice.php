<?php
/**
 * LicenseKeyNotice class file.
 *
 * This file contains LicenseKeyNotice class for adding admin notification for the plugin license key status.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
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

if ( ! class_exists( 'LicenseKeyNotice' ) ) {
    /**
     * Class LicenseKeyNotice
     *
     * This class registers a custom admin notification.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class LicenseKeyNotice extends AdminNotices {
        /**
         * LicenseKeyNotice constructor
         */
        public function __construct()
        {
            $this->type = 'error';
            $this->dismissible = false;
        }

        /**
         * The notification message
         *
         * @return string
         */
        public function get_message() : string
        {
            return sprintf(
                __( '<b>%1$s</b>: Your license key is invalid/expired. <a href="%2$s">Update your license key settings</a> to enable updates for this plugin.', 'htsa-plugin' ),
                HTSA_PLUGIN_NAME, admin_url( 'options-general.php?page=htsa-plugin-license-setting' )
            );
        }

        /**
         * Pre check before printing notification
         *
         * @return boolean
         */
        protected function can_show_notice() : bool
        {
            return ( '0' === get_option( 'htsa_plugin_license_valid' ) );
        }
    }
}