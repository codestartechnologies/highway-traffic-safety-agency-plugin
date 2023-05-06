<?php
/*
Plugin Name:        Highway Traffic Safety Agency Plugin
Plugin URI:         https://codestar.com.ng/shop/highway-traffic-security-agency-plugin
Description:        WordPress plugin for developing websites relating to a highway/road traffic safety agency. It comes with custom post types, taxonomies, shortcodes, email sending feature, and custom route endpoints. It can be used along side <a href="https://codestar.com.ng/shop/highway-traffic-security-agency">Highway Traffic Safety Agency WordPress Theme</a>.
Version:            1.0.2
Requires at least:  5.6
Requires PHP:       8.0
Author:             Codestar Technologies
Author URI:         https://codestar.com.ng
License:            AGPLv3
License URI:        https://www.gnu.org/licenses/agpl-3.0.en.html
Text Domain:        htsa-plugin
Domain Path:        /languages
*/

/*
Highway Traffic Safety Agency Plugin is a WordPress plugin for developing websites relating
to a road traffic safety organisation.
Copyright (C) 2022 Codestar Technologies

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see https://www.gnu.org/licenses/agpl-3.0.en.html.
*/

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\WPSPlugin;

// Main plugin file
if ( ! defined( 'WPS_FILE' ) ) {
    define( 'WPS_FILE', __FILE__ );
}

// Require plugin main class file
require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'wps.php';

// Initialize plugin main class
$wps_plugin = WPSPlugin::get_instance();

// Run the plugin
$wps_plugin->run();
