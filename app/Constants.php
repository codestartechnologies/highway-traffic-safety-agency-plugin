<?php
/**
 * Constants class file.
 *
 * This file contains Constants class which defines needed constants that will be used in your plugin development.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @since      1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Constants
 *
 * This class defines needed constants that will be used in your plugin development.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class Constants
{
    /**
     * Define core constants.
     *
     * This methods defines custom constants that you will need to develop your plugin.
     *
     * @return void
     * @since 1.0.0
     */
    public static function define_constants() : void
    {
        /**
         * Plugin name
         */
        if ( ! defined( 'HTSA_PLUGIN_NAME' ) ) {
            define( 'HTSA_PLUGIN_NAME', 'Highway Traffic Safety Agency Plugin' );
        }

        /**
         * Plugin short name
         */
        if ( ! defined( 'HTSA_PLUGIN_SNAME' ) ) {
            define( 'HTSA_PLUGIN_SNAME', 'HTSA Plugin' );
        }

        /**
         * Plugin version
         */
        if ( ! defined( 'HTSA_PLUGIN_VERSION' ) ) {
            define( 'HTSA_PLUGIN_VERSION', '1.0.2' );
        }

        /**
         * Plugin support url
         */
        if ( ! defined( 'HTSA_PLUGIN_SUPPORT_URL' ) ) {
            define( 'HTSA_PLUGIN_SUPPORT_URL', 'https://codestar.com.ng/support-plans' );
        }

        /**
         * Plugin recommended theme url
         */
        if ( ! defined( 'HTSA_PLUGIN_RECOMMENDED_THEME_URL' ) ) {
            define( 'HTSA_PLUGIN_RECOMMENDED_THEME_URL', 'https://codestar.com.ng/shop/highway-traffic-security-agency' );
        }

        /**
         * Plugin recommended theme name
         */
        if ( ! defined( 'HTSA_PLUGIN_RECOMMENDED_THEME_NAME' ) ) {
            define( 'HTSA_PLUGIN_RECOMMENDED_THEME_NAME', 'Highway Traffic Safety Agency' );
        }

        /**
         * Plugin environment
         */
        if ( ! defined( 'HTSA_PLUGIN_ENV' ) ) {
            define( 'HTSA_PLUGIN_ENV', $_ENV['HTSA_PLUGIN_ENV'] ?? 'production' );
        }

        /**
         * Plugin product slug identifier
         */
        if ( ! defined( 'HTSA_PLUGIN_API_PRODUCT_ID' ) ) {
            define( 'HTSA_PLUGIN_API_PRODUCT_ID', $_ENV['HTSA_PLUGIN_API_PRODUCT_ID'] ?? 'highway-traffic-security-agency-plugin' );
        }

        /**
         * Plugin api development endpoint
         */
        if ( ! defined( 'HTSA_PLUGIN_API_ENDPOINT_DEV' ) ) {
            define( 'HTSA_PLUGIN_API_ENDPOINT_DEV', $_ENV['HTSA_PLUGIN_API_ENDPOINT_DEV'] ?? '' );
        }

        /**
         * Plugin api production endpoint
         */
        if ( ! defined( 'HTSA_PLUGIN_API_ENDPOINT_PROD' ) ) {
            define( 'HTSA_PLUGIN_API_ENDPOINT_PROD', $_ENV['HTSA_PLUGIN_API_ENDPOINT_PROD'] ?? 'https://codestar.com.ng/api/product-licenses/v1/' );
        }

        /**
         * Plugin author name
         */
        if ( ! defined( 'HTSA_PLUGIN_AUTHOR' ) ) {
            define( 'HTSA_PLUGIN_AUTHOR', $_ENV['HTSA_PLUGIN_AUTHOR'] ?? 'Codestar Technologies' );
        }

        /**
         * Plugin author uri
         */
        if ( ! defined( 'HTSA_PLUGIN_AUTHOR_URI' ) ) {
            define( 'HTSA_PLUGIN_AUTHOR_URI', $_ENV['HTSA_PLUGIN_AUTHOR_URI'] ?? 'https://codestar.com.ng' );
        }

        /**
         * Plugin SMTP encryption mode
         */
        if ( ! defined( 'HTSA_PLUGIN_SMTP_ENCRYPTION_MODE' ) ) {
            define( 'HTSA_PLUGIN_SMTP_ENCRYPTION_MODE', $_ENV['HTSA_PLUGIN_SMTP_ENCRYPTION_MODE'] ?? 'ssl' );
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
         * Branch Direction Meta Key ID
         */
        if ( ! defined( 'HTSA_BRANCH_DIRECTION_META_KEY' ) ) {
            define( 'HTSA_BRANCH_DIRECTION_META_KEY', 'htsa_branch_direction' );
        }

        /**
         * Vehicle Category Meta Key ID
         */
        if ( ! defined( 'HTSA_PENALTY_VEHICLE_CATEGORIES_META_KEY' ) ) {
            define( 'HTSA_PENALTY_VEHICLE_CATEGORIES_META_KEY', 'htsa_penalty_vehicle_categories' );
        }

        /**
         * Review Name Meta Key ID
         */
        if ( ! defined( 'HTSA_REVIEW_NAME_META_KEY' ) ) {
            define( 'HTSA_REVIEW_NAME_META_KEY', 'htsa_review_name' );
        }

        /**
         * Review Rating Meta Key ID
         */
        if ( ! defined( 'HTSA_REVIEW_RATING_META_KEY' ) ) {
            define( 'HTSA_REVIEW_RATING_META_KEY', 'htsa_review_rating' );
        }

        /**
         * Review Content Meta Key ID
         */
        if ( ! defined( 'HTSA_REVIEW_CONTENT_META_KEY' ) ) {
            define( 'HTSA_REVIEW_CONTENT_META_KEY', 'htsa_review_content' );
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
         * Reviews Post Type ID
         */
        if ( ! defined( 'HTSA_REVIEWS_POST_TYPE' ) ) {
            define( 'HTSA_REVIEWS_POST_TYPE', 'htsa_reviews' );
        }

        /**
         * Department Taxonomy ID
         */
        if ( ! defined( 'HTSA_DEPARTMENT_TAXONOMY' ) ) {
            define( 'HTSA_DEPARTMENT_TAXONOMY', 'htsa_department' );
        }

        /**
         * Location Taxonomy ID
         */
        if ( ! defined( 'HTSA_LOCATION_TAXONOMY' ) ) {
            define( 'HTSA_LOCATION_TAXONOMY', 'htsa_location' );
        }

        /**
         * Theme directory uri
         */
        if ( ! defined( 'HTSA_PLUGIN_ACTIVE_THEME_URI' ) ) {
            define( 'HTSA_PLUGIN_ACTIVE_THEME_URI', trailingslashit( get_theme_file_uri() ) );
        }

        /**
         * Contact Form Shortcode Tag
         */
        if ( ! defined( 'HTSA_CONTACT_FORM_SHORTCODE' ) ) {
            define( 'HTSA_CONTACT_FORM_SHORTCODE', 'htsa_contact_form' );
        }

        /**
         * Newsletter Form Shortcode Tag
         */
        if ( ! defined( 'HTSA_NEWSLETTER_FORM_SHORTCODE' ) ) {
            define( 'HTSA_NEWSLETTER_FORM_SHORTCODE', 'htsa_newsletter_form' );
        }

        /**
         * Define path to htsa-menu.css
         */
        if ( ! defined( 'HTSA_PLUGIN_HTSA_MENU_CSS' ) ) {
            define( 'HTSA_PLUGIN_HTSA_MENU_CSS', WPS_CSS_BASE_URL . 'htsa-menu.css' );
        }

        /**
         * Database table prefix
         */
        if ( ! defined( 'HTSA_PLUGIN_DB_TABLE_PREFIX' ) ) {
            define( 'HTSA_PLUGIN_DB_TABLE_PREFIX', 'htsa_' );
        }

        /**
         * Database version
         */
        if ( ! defined( 'HTSA_PLUGIN_DB_VERSION' ) ) {
            define( 'HTSA_PLUGIN_DB_VERSION', 1 );
        }

    }
}