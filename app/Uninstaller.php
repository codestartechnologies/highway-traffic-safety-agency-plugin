<?php
/**
 * Uninstaller class file.
 *
 * This file contains Uninstaller class which handles functionalities that run when plugin is deleted.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Uninstaller' ) ) {
    /**
     * Class Uninstaller
     *
     * This class handles functionalities that run when plugin is deleted.
     *
     * @package WordpressPluginStarter
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class Uninstaller {
        /**
         * Method that will run when plugin is deleted.
         *
         * @static
         * @return void
         * @since 1.0.0
         */
        public static function run() : void
        {
            // 
        }
    }
}