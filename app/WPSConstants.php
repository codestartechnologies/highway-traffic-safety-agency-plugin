<?php
/**
 * WPSConstants class file.
 *
 * This file contains WPSConstants class which defines needed constants that will be used in your plugin development.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @since      1.0.0
 */

namespace WPS_Plugin\App;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPSConstants' ) ) {
    /**
     * Class WPSConstants
     *
     * This class defines needed constants that will be used in your plugin development.
     *
     * @package WordpressPluginStarter
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class WPSConstants {
        /**
         * Define core constants.
         *
         * This methods defines custom constants that you will need to develop your plugin.
         *
         * @return void
         */
        public static function define_constants() : void
        {
            /**
             * Plugin name
             */
            if ( ! defined( 'HTSA_PLUGIN_NAME' ) ) {
                define( 'HTSA_PLUGIN_NAME', 'Highway Traffic Security Agency Plugin' );
            }

            /**
             * Plugin version
             */
            if ( ! defined( 'HTSA_PLUGIN_VERSION' ) ) {
                define( 'HTSA_PLUGIN_VERSION', '0.1.0' );
            }

            /**
             * Featured Post Meta Key ID
             */
            if ( ! defined( 'HTSA_FEATURED_META_KEY' ) ) {
                define( 'HTSA_FEATURED_META_KEY', 'htsa_post_featured' );
            }

            /**
             * Profile Position Held Meta Key ID
             */
            if ( ! defined( 'HTSA_PROFILE_POSITION_HELD_META_KEY' ) ) {
                define( 'HTSA_PROFILE_POSITION_HELD_META_KEY', 'htsa_position_held' );
            }

            /**
             * Profile Social Handles Meta Key ID
             */
            if ( ! defined( 'HTSA_PROFILE_SOCIAL_HANDLES_META_KEY' ) ) {
                define( 'HTSA_PROFILE_SOCIAL_HANDLES_META_KEY', 'htsa_profile_social_handles' );
            }

            /**
             * Officer Contact Meta Key ID
             */
            if ( ! defined( 'HTSA_OFFICER_CONTACT_META_KEY' ) ) {
                define( 'HTSA_OFFICER_CONTACT_META_KEY', 'htsa_officer_contact' );
            }

            /**
             * Officer Zone Meta Key ID
             */
            if ( ! defined( 'HTSA_OFFICER_ZONE_META_KEY' ) ) {
                define( 'HTSA_OFFICER_ZONE_META_KEY', 'htsa_officer_zone' );
            }

            /**
             * Branch Location Meta Key ID
             */
            if ( ! defined( 'HTSA_BRANCH_LOCATION_META_KEY' ) ) {
                define( 'HTSA_BRANCH_LOCATION_META_KEY', 'htsa_branch_location' );
            }

            /**
             * Branch Direction Meta Key ID
             */
            if ( ! defined( 'HTSA_BRANCH_DIRECTION_META_KEY' ) ) {
                define( 'HTSA_BRANCH_DIRECTION_META_KEY', 'htsa_branch_direction' );
            }

            /**
             * Branch Direction Meta Key ID
             */
            if ( ! defined( 'HTSA_PENALTY_VEHICLE_CATRGORIES_META_KEY' ) ) {
                define( 'HTSA_PENALTY_VEHICLE_CATRGORIES_META_KEY', 'htsa_penalty_vehicle_categories' );
            }

            /**
             * Profiles Post Type ID
             */
            if ( ! defined( 'HTSA_PROFILE_POST_TYPE' ) ) {
                define( 'HTSA_PROFILE_POST_TYPE', 'htsa_profile' );
            }

            /**
             * Officers Post Type ID
             */
            if ( ! defined( 'HTSA_OFFICERS_POST_TYPE' ) ) {
                define( 'HTSA_OFFICERS_POST_TYPE', 'htsa_officers' );
            }

            /**
             * Branches Post Type ID
             */
            if ( ! defined( 'HTSA_BRANCHES_POST_TYPE' ) ) {
                define( 'HTSA_BRANCHES_POST_TYPE', 'htsa_branch' );
            }

            /**
             * Penalties Post Type ID
             */
            if ( ! defined( 'HTSA_PENALTIES_POST_TYPE' ) ) {
                define( 'HTSA_PENALTIES_POST_TYPE', 'htsa_penalty' );
            }

            /**
             * Theme directory uri
             */
            if ( ! defined( 'WTS_THEME_URI' ) ) {
                define( 'WTS_THEME_URI', trailingslashit( get_theme_file_uri() ) );
            }

            /**
             * Contact Form Shortcode Tag
             */
            if ( ! defined( 'HTSA_CONTACT_FORM_SHORTCODE' ) ) {
                define( 'HTSA_CONTACT_FORM_SHORTCODE', 'htsa_contact_form' );
            }

        }
    }
}


