<?php
/**
 * Newsletters class file.
 *
 * This file contains Newsletters class which creates a table in the database.
 *
 * @package    HighwayTrafficSecurityAgencyPlugin
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since      1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Admin\DatabaseTables;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\DatabaseTables;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Traits\DatabaseTables as TraitsDatabaseTables;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Newsletters' ) ) {
    /**
     * Newsletters Class
     *
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class Newsletters extends DatabaseTables
    {
        use TraitsDatabaseTables;

        /**
         * Newsletters constructor
         *
         * @since 1.0.0
         */
        public function __construct()
        {
            $this->table_name = HTSA_PLUGIN_DB_TABLE_PREFIX . 'newsletters';
        }

        /**
         * SQL query string for creating the table.
         *
         * @access protected
         * @return string
         * @since 1.0.0
         */
        protected function get_create_table_query_string() : string
        {
            return "
                CREATE TABLE IF NOT EXISTS `{$this->table_name}` (
                    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    `name` VARCHAR(50) NOT NULL,
                    `email` VARCHAR(50) NOT NULL,
                    `valid` ENUM('0','1') NOT NULL DEFAULT '0',
                    `token` VARCHAR(250) NOT NULL,
                    PRIMARY KEY (`id`),
                    UNIQUE (`email`)
                )
            ";
        }

        /**
         * SQL query string for modifying the table column(s).
         *
         * @access protected
         * @return string
         * @since 1.0.0
         */
        protected function get_modify_column_query_string() : string
        {
            return "ALTER TABLE `{$this->table_name}` CHANGE `valid` `valid` TINYINT NOT NULL DEFAULT '0';";
        }
    }
}
