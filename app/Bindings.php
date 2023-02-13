<?php
/**
 * Bindings class file.
 *
 * This file contains Bindings class which returns classes that will be registered with the plugin.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @since      1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App;

use HTSA_Plugin\WPS_Plugin\App\Admin\AdminNotices\LicenseKeyNotice;
use HTSA_Plugin\WPS_Plugin\App\Admin\AdminNotices\URLStructureNotice;
use HTSA_Plugin\WPS_Plugin\App\Admin\AdminNotices\WPSAdminNotice;
use HTSA_Plugin\WPS_Plugin\App\Admin\AjaxRequests\WPSAdminAjaxRequest;
use HTSA_Plugin\WPS_Plugin\App\Admin\Menus\HTSAEmailSettingMenu;
use HTSA_Plugin\WPS_Plugin\App\Admin\Menus\HTSAMenu;
use HTSA_Plugin\WPS_Plugin\App\Admin\Menus\LicenseSettingMenu;
use HTSA_Plugin\WPS_Plugin\App\Admin\Menus\WPSMenu;
use HTSA_Plugin\WPS_Plugin\App\Admin\Menus\WPSPluginMenu;
use HTSA_Plugin\WPS_Plugin\App\Admin\Menus\WPSSettingMenu;
use HTSA_Plugin\WPS_Plugin\App\Admin\Menus\WPSSubMenu;
use HTSA_Plugin\WPS_Plugin\App\Admin\NavMenuMetaboxes\WPSNavMenuMetabox;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostColumns\HTSAFeaturedPostColumn;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostColumns\HTSAOfficerThumbnailColumn;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostColumns\HTSAProfilePositionHeldColumn;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostColumns\HTSAProfileThumbnailColumn;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostColumns\HTSAReviewNameColumn;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostColumns\HTSAReviewRatingColumn;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostColumns\WPSPostColumn;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostMetaboxes\HTSABranchDirectionMetabox;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostMetaboxes\HTSAFeaturedMetabox;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostMetaboxes\HTSAOfficerContactMetabox;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostMetaboxes\HTSAPenaltyVehicleCategoriesMetabox;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostMetaboxes\HTSAProfilePositionHeldMetabox;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostMetaboxes\HTSAProfileSocialHandlesMetabox;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostMetaboxes\HTSAReviewContentMetabox;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostMetaboxes\HTSAReviewNameMetabox;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostMetaboxes\HTSAReviewRatingMetabox;
use HTSA_Plugin\WPS_Plugin\App\Admin\PostMetaboxes\WPSPostMetabox;
use HTSA_Plugin\WPS_Plugin\App\Admin\Settings\HTSAEmailSetting;
use HTSA_Plugin\WPS_Plugin\App\Admin\Settings\LicenseSetting;
use HTSA_Plugin\WPS_Plugin\App\Admin\Settings\WPSSetting;
use HTSA_Plugin\WPS_Plugin\App\Admin\TaxonomyFormFields\WPSTaxonomyFormField;
use HTSA_Plugin\WPS_Plugin\App\Public\AjaxRequests\HTSAContactFormRequest;
use HTSA_Plugin\WPS_Plugin\App\Public\AjaxRequests\WPSPublicAjaxRequest;
use HTSA_Plugin\WPS_Plugin\App\Public\PostTypes\HTSABranch;
use HTSA_Plugin\WPS_Plugin\App\Public\PostTypes\HTSAOfficers;
use HTSA_Plugin\WPS_Plugin\App\Public\PostTypes\HTSAPenalty;
use HTSA_Plugin\WPS_Plugin\App\Public\PostTypes\HTSAProfile;
use HTSA_Plugin\WPS_Plugin\App\Public\PostTypes\HTSAReview;
use HTSA_Plugin\WPS_Plugin\App\Public\PostTypes\WPSPostType;
use HTSA_Plugin\WPS_Plugin\App\Public\Shortcodes\HTSAContactFormShortcode;
use HTSA_Plugin\WPS_Plugin\App\Public\Shortcodes\HTSANewsletterFormShortcode;
use HTSA_Plugin\WPS_Plugin\App\Public\Shortcodes\WPSShortcode;
use HTSA_Plugin\WPS_Plugin\App\Public\Taxonomies\HTSADepartment;
use HTSA_Plugin\WPS_Plugin\App\Public\Taxonomies\HTSALocation;
use HTSA_Plugin\WPS_Plugin\App\Public\Taxonomies\WPSTaxonomy;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Bindings' ) ) {
    /**
     * Class Bindings
     *
     * This class returns classes that will be registered with the plugin.
     *
     * @package WordpressPluginStarter
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class Bindings {
        /**
         * Bindings for classes that register admin menus
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $menus = array(
            // WPSMenu::class,
            HTSAMenu::class,
        );

        /**
         * Bindings for classes that register submenus
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $sub_menus = array(
            // WPSSubMenu::class,
        );

        /**
         * Bindings for classes that register setting menus
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $setting_menus = array(
            // WPSSettingMenu::class,
            HTSAEmailSettingMenu::class,
            LicenseSettingMenu::class,
        );

        /**
         * Bindings for classes that register plugin menus
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $plugin_menus = array(
            // WPSPluginMenu::class,
        );

        /**
         * Bindings for classes that register post types
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $post_types = array(
            // WPSPostType::class,
            HTSAProfile::class,
            HTSAOfficers::class,
            HTSABranch::class,
            HTSAPenalty::class,
            HTSAReview::class,
        );

        /**
         * Bindings for classes that register taxonomies
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $taxonomies = array(
            // WPSTaxonomy::class,
            HTSADepartment::class,
            HTSALocation::class,
        );

        /**
         * Bindings for classes that register shortcodes
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $shortcodes = array(
            // WPSShortcode::class,
            HTSAContactFormShortcode::class,
            HTSANewsletterFormShortcode::class,
        );

        /**
         * Bindings for classes that register post metaboxes
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $post_metaboxes = array(
            // WPSPostMetabox::class,
            HTSAFeaturedMetabox::class,
            HTSAProfilePositionHeldMetabox::class,
            HTSAProfileSocialHandlesMetabox::class,
            HTSAOfficerContactMetabox::class,
            HTSABranchDirectionMetabox::class,
            HTSAPenaltyVehicleCategoriesMetabox::class,
            HTSAReviewNameMetabox::class,
            HTSAReviewRatingMetabox::class,
            HTSAReviewContentMetabox::class,
        );

        /**
         * Bindings for classes that register nav menu metaboxes
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $nav_menu_metaboxes = array(
            // WPSNavMenuMetabox::class,
        );

        /**
         * Bindings for classes that register settings
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $settings = array(
            // WPSSetting::class,
            HTSAEmailSetting::class,
            LicenseSetting::class,
        );

        /**
         * Bindings for classes that create admin notices
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $admin_notices = array(
            // WPSAdminNotice::class,
            LicenseKeyNotice::class,
            URLStructureNotice::class,
        );

        /**
         * Bindings for classes that create admin ajax requests
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $admin_ajax_requests = array(
            // WPSAdminAjaxRequest::class,
        );

        /**
         * Bindings for classes that create public ajax requests
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $public_ajax_requests = array(
            // WPSPublicAjaxRequest::class,
            HTSAContactFormRequest::class,
        );

        /**
         * Bindings for classes that create post columns
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $post_columns = array(
            // WPSPostColumn::class,
            HTSAFeaturedPostColumn::class,
            HTSAProfilePositionHeldColumn::class,
            HTSAProfileThumbnailColumn::class,
            HTSAOfficerThumbnailColumn::class,
            HTSAReviewNameColumn::class,
            HTSAReviewRatingColumn::class,
        );

        /**
         * Bindings for classes that create taxonomy fields
         *
         * @static
         * @access public
         * @var array
         * @since 1.0.0
         */
        public static array $taxonomy_fields = array(
            // WPSTaxonomyFormField::class,
        );
    }
}
