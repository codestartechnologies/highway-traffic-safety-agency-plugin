<?php
/**
 * WPSDatabaseUpgradeNotice class file.
 *
 * This file contains WPSDatabaseUpgradeNotice class that will add an admin notification for database upgrade.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
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

if ( ! class_exists( 'WPSDatabaseUpgradeNotice' ) ) {
    /**
     * Class WPSDatabaseUpgradeNotice
     *
     * This class registers add an admin notification for database upgrade.
     *
     * @package WordpressPluginStarter
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class WPSDatabaseUpgradeNotice extends AdminNotices {
        protected int $database_version;
        protected int $last_database_version;

        /**
         * WPSDatabaseUpgradeNotice constructor
         *
         * @since 1.0.0
         */
        public function __construct()
        {
            $this->type = 'warning';
            $this->dismissible = false;
            $this->database_version = intval( wps_config( 'database.db_version' ) );
            $this->last_database_version = intval( get_option( wps_config( 'database.last_db_version_name' ) ) );
        }

        /**
         * The notification message
         *
         * @return array
         * @since 1.0.0
         */
        public function get_message() : string
        {
            $link = add_query_arg( '_wpnonce', wp_create_nonce( 'handle_db_upgrade' ), admin_url( '?wps_database_upgrade=1' ) );
            return sprintf(
                __( 'New database version of <b>%1$s</b> detected! Previous version <b>%2$s</b> <a href="%3$s">Upgrade now!</a>', 'wps' ),
                $this->database_version,
                $this->last_database_version,
                $link
            );
        }

        /**
         * Check before the admin notice is printed
         *
         * @access protected
         * @return boolean
         * @since 1.0.0
         */
        protected function can_show_notice() : bool
        {
            return ( $this->database_version > $this->last_database_version );
        }
    }
}