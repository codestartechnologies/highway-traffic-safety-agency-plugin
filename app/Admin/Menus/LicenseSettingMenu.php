<?php
/**
 * LicenseSettingMenu class file.
 *
 * This file contains LicenseSettingMenu class that will register a menu page that displays plugin license settings.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Admin\Menus;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\OptionsMenus;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Traits\Logger;
use HTSA_Plugin\WPS_Plugin\App\HTSA\CodestarAPI;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * LicenseSettingMenu Class
 *
 * This class registers a custom admin setting menu page.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class LicenseSettingMenu extends OptionsMenus
{

    use Logger;

    /**
     * LicenseSettingMenu Constructor
     */
    public function __construct()
    {
        $this->page_title   = sprintf( esc_html__( 'License Settings For %s', 'htsa-plugin' ), HTSA_PLUGIN_NAME );
        $this->menu_title   = sprintf( esc_html__( '%s License', 'htsa-plugin' ), HTSA_PLUGIN_SNAME );
        $this->capability   = 'manage_options';
        $this->menu_slug    = 'htsa-plugin-license-setting';
        $this->view         = 'admin-menu-pages.license-setting-menu';
    }

    /**
     * Check before adding the menu page
     *
     * @return boolean
     */
    public function can_add_menupage() : bool
    {
        return true;
    }

    /**
     * Fires before a particular screen is loaded. Example can be to handle POST or GET request sent to the menu page
     *
     * @return void
     */
    public function load_page() : void
    {
        $action = $_GET['action'] ?? null;
        $nonce = $_GET['_wpnonce'] ?? null;

        if (
            isset( $action ) &&
            isset( $nonce ) &&
            in_array( $action, array( 'license-status', 'activate-license', 'deactivate-license', ), true ) &&
            1 === wp_verify_nonce( $nonce, 'htsa-plugin-license-api' )
        ) {
            if ( 'license-status' === $action ) {
                if ( CodestarAPI::is_api_error( $response = CodestarAPI::validate_license() ) ) {
                    update_option( 'htsa_plugin_license_valid', 0 );
                    $this->log( __FILE__, 'API call to codestar.com.ng for license status failed' );
                    $this->log( __FILE__, $response->message ?? $response );
                } else {
                    update_option( 'htsa_plugin_license_valid', 1 );
                }
            }

            if ( 'activate-license' === $action ) {
                if ( CodestarAPI::is_api_error( $response = CodestarAPI::activate_license() ) ) {
                    update_option( 'htsa_plugin_license_activated', 0 );
                } else {
                    update_option( 'htsa_plugin_license_deactivated', 0 );
                    update_option( 'htsa_plugin_license_activated', 1 );
                }
            }

            if ( 'deactivate-license' === $action ) {
                if ( CodestarAPI::is_api_error( $response = CodestarAPI::deactivate_license() ) ) {
                    update_option( 'htsa_plugin_license_deactivated', 0 );
                } else {
                    update_option( 'htsa_plugin_license_activated', 0 );
                    update_option( 'htsa_plugin_license_deactivated', 1 );
                }
            }

            $response = ( isset( $response->success ) ) ? $response->message : 'error';
            htsa_plugin_store_session_data( 'htsa_plugin_license_api', $response, strtotime( '+2 minutes' ) );
            wp_safe_redirect( admin_url( 'options-general.php?page=htsa-plugin-license-setting' ) );
            exit;
        }
    }

    /**
     * Arguements to pass to the menu page view
     *
     * @return array
     */
    public function menu_page_view_args() : array
    {
        return array(
            'page'  => $this->menu_slug,
        );
    }

    /**
     * The content to display in the footer of the admin menu page
     *
     * @param string $text
     * @return string
     */
    public function get_footer_content( string $text ) : string
    {
        $text = sprintf(
            __( '%1$s developed by <a href="%2$s" target="_blank">%3$s</a>', 'htsa-plugin' ),
            HTSA_PLUGIN_NAME, $_ENV['HTSA_PLUGIN_AUTHOR_URI'], $_ENV['HTSA_PLUGIN_AUTHOR']
        );
        return $text;
    }
}