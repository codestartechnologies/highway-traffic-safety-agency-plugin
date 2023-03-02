<?php
/**
 * WPSUsersTable class file.
 *
 * This file contains WPSUsersTable class which creates a table in the database.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @since      1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Admin\DatabaseTables;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\DatabaseTables;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPSUsersTable Class
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSUsersTable extends DatabaseTables
{
    /**
     * WPSUsersTable constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $prefix = 'wps_';
        $this->table_name = $prefix . 'users';
    }

    /**
     * SQL query string for creating the table.
     *
     * @return string
     * @since 1.0.0
     */
    protected function get_create_table_query_string() : string
    {
        return "
            CREATE TABLE IF NOT EXISTS `{$this->table_name}` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `admin_name` VARCHAR(50) NOT NULL,
                `admin_email` VARCHAR(50) NOT NULL,
                `admin_password` VARCHAR(50) NOT NULL,
                PRIMARY KEY (`id`)
            )
        ";
    }
}
