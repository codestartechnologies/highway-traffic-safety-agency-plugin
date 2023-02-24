<?php

use Dotenv\Dotenv;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Core\Activator;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Core\Bootstrap;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Core\Constants;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Core\DatabaseUpgrade;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Core\Deactivator;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Core\Router;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Core\Uninstaller;
use HTSA_Plugin\WPS_Plugin\App\Admin\Hooks as AdminHooks;
use HTSA_Plugin\WPS_Plugin\App\Bindings;
use HTSA_Plugin\WPS_Plugin\App\Hooks;
use HTSA_Plugin\WPS_Plugin\App\Public\Hooks as PublicHooks;
use HTSA_Plugin\WPS_Plugin\App\Constants as AppConstants;
use HTSA_Plugin\WPS_Plugin\App\Activator as AppActivator;
use HTSA_Plugin\WPS_Plugin\App\Deactivator as AppDeactivator;
use HTSA_Plugin\WPS_Plugin\App\HTSA\PluginUpdate;
use HTSA_Plugin\WPS_Plugin\App\Uninstaller as AppUninstaller;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPSPlugin Class
 *
 * This class is used to create a WordPress plugin. It is the main file of your plugin.
 *
 * @package WordpressPluginStarter
 * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license GNU/AGPLv3
 * @since 0.1.0
 */
final class WPSPlugin {
    /**
     * The plugin instance
     *
     * @access private
     * @static
     * @var WPSPlugin
     * @since 1.0.0
     */
    private static WPSPlugin $instance;

    /**
     * Bootstrap Class
     *
     * Object that bootstrap the core functionalities of the plugin.
     *
     * @access private
     * @var Bootstrap
     * @since 1.0.0
     */
    private Bootstrap $bootstrap;

    /**
     * DatabaseUpgrade Class
     *
     * @access private
     * @var DatabaseUpgrade
     * @since 1.0.0
     */
    private DatabaseUpgrade $database_upgrade;

    /**
     * Post Types
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $post_types;

    /**
     * Taxonomies
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $taxonomies;

    /**
     * Database Tables
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $database_tables;

    /**
     * Settings
     *
     * @access private
     * @static
     * @var array
     * @since 1.0.0
     */
    private static array $settings;

    /**
     * Post Meta boxes
     *
     * @access private
     * @static
     * @var array
     * @since 1.0.0
     */
    private static array $post_metaboxes;

    /**
     * Admin Menu Pages
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $menus;

    /**
     * Admin Sub Menu Pages
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $sub_menus;

    /**
     * Settings Sub Menu Pages
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $setting_menus;

    /**
     * Plugins Sub Menu Pages
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $plugin_menus;

    /**
     * Shortcodes
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $shortcodes;

    /**
     * Nav Menu Meta Boxes
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $nav_menu_metaboxes;

    /**
     * Admin Notices
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $admin_notices;

    /**
     * Ajax Requests for admin area
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $admin_ajax_requests;

    /**
     * Ajax Requests for site front end
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $public_ajax_requests;

    /**
     * Post Columns
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $post_columns;

    /**
     * Taxonomy Form Fields
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $taxonomy_fields;

    /**
     * WPSPlugin constructor
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function __construct()
    {
        /**
         * Require autoloader files
         */
        require_once trailingslashit( plugin_dir_path( WPS_FILE ) ) . 'vendor/autoload.php';

        require_once trailingslashit( plugin_dir_path( WPS_FILE ) ) . 'autoload.php';

        /**
         * Load .env inside the application
         */
        $dotenv = Dotenv::createImmutable( __DIR__ );
        $dotenv->safeLoad();

        Constants::define_core_constants();

        AppConstants::define_constants();

        $this->setup();

        $this->database_upgrade = new DatabaseUpgrade( $this->database_tables );

        register_activation_hook( WPS_FILE, function () {
            $this->activate( new Activator( $this->database_upgrade ) );
            AppActivator::run();
        } );

        register_deactivation_hook( WPS_FILE, function () {
            $this->deactivate( new Deactivator() );
            AppDeactivator::run();
        } );

        register_uninstall_hook( WPS_FILE, array( __CLASS__, 'uninstall' ) );
    }

    /**
     * Sets up plugin dependencies
     *
     * @access private
     * @return void
     * @since 1.0.0
     */
    private function setup() : void
    {
        $this->post_types = self::boot( Bindings::$post_types );
        $this->taxonomies = self::boot( Bindings::$taxonomies );
        $this->database_tables = self::boot( Bindings::$database_tables );
        $this->settings = self::boot( Bindings::$settings );
        $this->post_metaboxes = self::boot( Bindings::$post_metaboxes );
        $this->menus = self::boot( Bindings::$menus );
        $this->sub_menus = self::boot( Bindings::$sub_menus );
        $this->setting_menus = self::boot( Bindings::$setting_menus );
        $this->plugin_menus = self::boot( Bindings::$plugin_menus );
        $this->shortcodes = self::boot( Bindings::$shortcodes );
        $this->nav_menu_metaboxes = self::boot( Bindings::$nav_menu_metaboxes );
        $this->admin_notices = self::boot( Bindings::$admin_notices );
        $this->admin_ajax_requests = self::boot( Bindings::$admin_ajax_requests );
        $this->public_ajax_requests = self::boot( Bindings::$public_ajax_requests );
        $this->post_columns = self::boot( Bindings::$post_columns );
        $this->taxonomy_fields = self::boot( Bindings::$taxonomy_fields );
    }

    /**
     * Returns an array containing class objects.
     *
     * @param array $classes
     * @return array
     */
    private static function boot( array $classes = array() ) : array
    {
        $objects_array = array();

        if ( ! empty( $classes ) ) {
            foreach ( $classes as $class ) {
                if ( class_exists( $class ) ) {
                    $objects_array[] = new $class();
                }
            }
        }

        return $objects_array;
    }

    /**
     * Fires when plugin is activated
     *
     * @access public
     * @param Activator $activator
     * @return void
     * @since 1.0.0
     */
    public function activate( Activator $activator ) : void
    {
        $activator->run(
            $this->post_types,
            $this->taxonomies,
            $this->database_tables
        );
    }

    /**
     * Fires when plugin is deactivated
     *
     * @access public
     * @param Deactivator $deactivator
     * @return void
     * @since 1.0.0
     */
    public function deactivate( Deactivator $deactivator ) : void
    {
        $deactivator->run(
            $this->post_types,
            $this->taxonomies
        );
    }

    /**
     * Fires when plugin is deleted
     *
     * @access public
     * @static
     * @return void
     * @since 1.0.0
     */
    public static function uninstall() : void
    {
        Uninstaller::run(
            self::$settings,
            self::$post_metaboxes
        );
        AppUninstaller::run();
    }

    /**
     * Creates or returns the plugin instance
     *
     * @access public
     * @return WPSPlugin
     * @since 1.0.0
     */
    public static function get_instance() : WPSPlugin
    {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Method to bootstrap all plugin functionalities.
     *
     * @access public
     * @return void
     * @since 1.0.0
     */
    public function run() : void
    {
        $this->bootstrap = new Bootstrap(
            new Router(),
            $this->database_upgrade,
            new Hooks,
            new AdminHooks(),
            new PublicHooks(),
            new PluginUpdate(),
            $this->menus,
            $this->sub_menus,
            $this->setting_menus,
            $this->plugin_menus,
            $this->post_types,
            $this->taxonomies,
            $this->shortcodes,
            $this->post_metaboxes,
            $this->nav_menu_metaboxes,
            $this->settings,
            $this->admin_notices,
            $this->admin_ajax_requests,
            $this->public_ajax_requests,
            $this->post_columns,
            $this->taxonomy_fields
        );
        $this->bootstrap->init();
    }
}

$wps_plugin = WPSPlugin::get_instance();
$wps_plugin->run();
