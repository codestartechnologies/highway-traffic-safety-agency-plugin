<?php
/**
 * ActionHook interface file.
 *
 * This file contains ActionHook interface. Classes that make use of add_action() and remove_action() need to implement this interface.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @since       1.0.0
 */

namespace HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Interfaces;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! interface_exists( 'ActionHook' ) ) {
    /**
     * Interface ActionHook
     *
     * Classes that make use of add_action() and remove_action() need to implement this interface.
     *
     * @package WordpressPluginStarter
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    interface ActionHook {
        /**
         * Register add_action() and remove_action().
         *
         * @access public
         * @return void
         * @since 1.0.0
         */
        public function register_add_action() : void;
    }
}