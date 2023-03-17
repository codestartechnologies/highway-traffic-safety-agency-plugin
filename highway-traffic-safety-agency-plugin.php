<?php
/*
Plugin Name: Highway Traffic Safety Agency Plugin
Plugin URI: https://codestar.com.ng/shop/highway-traffic-security-agency-plugin
Description: WordPress plugin for developing websites relating to a highway/road traffic safety agency. It comes with custom post types, taxonomies, shortcodes, email sending feature, and custom route endpoints. It can be used along side <a href="https://codestar.com.ng/shop/highway-traffic-security-agency">Highway Traffic Safety Agency WordPress Theme</a>.
Version: 0.3.0
Requires at least: 5.6
Requires PHP: 8.0
Author: Codestar Technologies
Author URI: https://codestar.com.ng
License: AGPLv3
License URI: https://www.gnu.org/licenses/agpl-3.0.en.html
Text Domain: htsa-plugin
Domain Path: /languages
*/

/*
Highway Traffic Safety Agency Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Highway Traffic Safety Agency Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Highway Traffic Security Agency Plugin. If not, see https://www.gnu.org/licenses/gpl-3.0.html.
*/

/**
 * The full-path and file name of the plugin file
 */

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\WPSPlugin;

if ( ! defined( 'WPS_FILE' ) ) {
    define( 'WPS_FILE', __FILE__ );
}

require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'wps.php';

$wps_plugin = WPSPlugin::get_instance();
$wps_plugin->run();
