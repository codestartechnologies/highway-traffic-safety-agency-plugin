<?php
/**
 * This file contains general helper functions for your plugin
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 */

if ( ! function_exists( 'wps_is_theme_installed' ) ) {
    /**
     * Check if a theme is installed
     *
     * @param string $theme_dir_name    The directory name of the theme
     * @return boolean
     */
    function wps_is_theme_installed( string $theme_dir_name ) : bool
    {
        return wp_get_theme( $theme_dir_name )->exists();
    }
}

if ( ! function_exists( 'wps_is_theme_active' ) ) {
    /**
     * Check if a theme is active
     *
     * @param string $theme_name    The theme name
     * @return boolean
     */
    function wps_is_theme_active( string $theme_name ) : bool
    {
        $active_theme = get_option( 'current_theme' );
        return ( $active_theme === $theme_name );
    }
}

if ( ! function_exists( 'wps_is_plugin_active' ) ) {
    /**
     * Checks if a plugin is installed and activated
     *
     * @param string $dir_name      The plugin directory name
     * @param string $file_name     The plugin file name
     * @return boolean
     * @since 1.0.0
     */
    function wps_is_plugin_active( string $plugin_dir_name, string $plugin_file_name ) : bool
    {
        $path = trailingslashit( $plugin_dir_name ) . $plugin_file_name;
        return in_array( $path, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
    }
}

if ( ! function_exists( 'wps_config' ) ) {
    /**
     * Gets a configuration setting
     *
     * @param string $name  The name of the config file concatenated by the config key
     * @return mixed
     * @since 1.0.0
     */
    function wps_config( string $name ) : mixed
    {
        $name_arr = explode( '.', $name );
        $file_name = $name_arr[0] ?? null;
        $file_path = WPS_CONFIGS_PATH . $file_name . '.php';

        if ( is_file( $file_path ) ) {
            $config_arr = require $file_path;
            $config_key = $name_arr[1] ?? null;

            if ( array_key_exists( $config_key, $config_arr ) ) {
                return $config_arr[ $config_key ];
            }
        }

        return null;
    }
}

if ( ! function_exists( 'wps_get_date' ) ) {
    /**
     * Returns a date in custom format
     *
     * @param string $format    Date Format. E.g d/m/Y
     * @param string $date      Date string. E.g 0000-00-00
     * @return string|null
     * @since 1.0.0
     */
    function wps_get_date( string $format = 'd m Y', string $date = 'now' ) : string|null
    {
        return date( $format, strtotime( $date ) );
    }
}

if ( ! function_exists( 'wps_db_table_exists' ) ) {
    /**
     * Checks if a table exists in the database
     *
     * @param string $table_name Database table name to check for
     * @return boolean
     * @since 1.0.0
     */
    function wps_db_table_exists( string $table_name ) : bool
    {
        global $wpdb;
        $database_name = DB_NAME ?? null;
        $query = "SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA = '{$database_name}' AND TABLE_NAME = '{$table_name}'";
        return ( intval( $wpdb->get_var( $query ) ) > 0 );
    }
}

if ( ! function_exists( 'wps_save_post_action_check' ) ) {
    /**
     * Validates actions performed inside "save_post" action hook.
     *
     * @param int $post_ID Post ID.
     * @return boolean
     * @since 1.0.0
     */
    function wps_save_post_action_check( int $post_ID ) : bool
    {
        return (
            current_user_can( 'manage_options' ) &&
            ! wp_is_post_autosave( $post_ID ) &&
            ! wp_is_post_revision( $post_ID ) &&
            ! ( is_multisite() && ms_is_switched() )
        );
    }
}

if ( ! function_exists( 'wps_log' ) ) {
    /**
     * Function for logging message to a file.
     *
     * @param string $log_message   Log Message.
     * @param string $path          Path to the log file.
     * @return void
     * @since 1.0.0
     */
    function wps_log( string $log_message, string $path ) : void
    {
        if ( ! error_log( $log_message . PHP_EOL, 3, $path ) ) {
            $resource = fopen( $path, 'a' );
            fwrite( $resource, $log_message );
            fclose( $resource );
        }
    }
}
