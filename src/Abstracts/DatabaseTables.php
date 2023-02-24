<?php
/**
 * DatabaseTables class file.
 *
 * This file contains DatabaseTables abstract class which will be inherited by classes that will create database tables.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @since      1.0.0
 */

namespace HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Interfaces\Tables;
use wpdb;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'DatabaseTables' ) ) {
    /**
     * DatabaseTables Class
     *
     * @package WordpressPluginStarter
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    abstract class DatabaseTables implements Tables
    {
        /**
         * The name for the table
         *
         * @access protected
         * @var string
         * @since 1.0.0
         */
        protected string $table_name;

        /**
         * wpdb class
         *
         * @access protected
         * @var wpdb
         * @since 1.0.0
         */
        protected wpdb $wpdb;

        /**
         * Setter for wpdb class
         *
         * @param wpdb $wpdb - instantiation of the wpdb class
         * @return void
         */
        public function set_wpdb( wpdb $wpdb ) : void
        {
            $this->wpdb = $wpdb;
        }

        /**
         * Check if the table exists in the database
         *
         * @return boolean
         * @since 1.0.0
         */
        public function exists() : bool
        {
            return \wps_db_table_exists( $this->table_name );
        }

        /**
         * Create the table
         *
         * @return boolean
         * @since 1.0.0
         */
        public function create() : bool
        {
            return $this->wpdb->query( $this->get_create_table_query_string() . ' ' . $this->wpdb->get_charset_collate() );
        }

        /**
         * Remove the table
         *
         * @return boolean
         * @since 1.0.0
         */
        public function destroy() : bool
        {
            return ( $this->exists() ) ? $this->wpdb->query( "DROP TABLE `{$this->table_name}`" ) : false;
        }

        /**
         * SQL query string for creating the table.
         *
         * @access protected
         * @abstract
         * @return string
         * @since 1.0.0
         */
        protected abstract function get_create_table_query_string() : string;
    }
}
