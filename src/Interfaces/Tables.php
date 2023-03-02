<?php
/**
 * Tables interface file.
 *
 * This file contains Tables interface. Classes that creates database tables need to implement this interface.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 * @since       1.0.0
 */

namespace HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Interfaces;

use wpdb;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Interface Tables
 *
 * Classes that creates database tables need to implement this interface.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
interface Tables
{
    /**
     * Setter for wpdb class
     *
     * @param wpdb $wpdb
     * @return void
     * @since 1.0.0
     */
    public function set_wpdb( wpdb $wpdb ) : void;

    /**
     * Check if table exists
     *
     * @return boolean
     * @since 1.0.0
     */
    public function exists() : bool;

    /**
     * Add the table
     *
     * @return boolean
     * @since 1.0.0
     */
    public function create() : bool;

    /**
     * Remove the table
     *
     * @return boolean
     * @since 1.0.0
     */
    public function destroy() : bool;
}