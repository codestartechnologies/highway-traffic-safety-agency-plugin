<?php
/**
 * LicenseSetting class file.
 *
 * This file contains LicenseSetting class that will register setting sections and fields for plugin license.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Admin\Settings;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\Settings;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Traits\Logger;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'LicenseSetting' ) ) {
    /**
     * Class LicenseSetting
     *
     * This class registers a custom setting.
     *
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class LicenseSetting extends Settings {
        use ViewLoader, Logger;

        /**
         * Arguements needed to add the section for the settings.
         *
         * @return array
         */
        public function get_section() : array
        {
            return array(
                'id'            => 'license_settings',
                'title'         => sprintf( esc_html__( '%s License Settings', 'htsa-plugin' ), HTSA_PLUGIN_NAME ),
                'page'          => 'htsa-plugin-license-setting',
                'callback'      => null,
            );
        }

        /**
         * Arrays of arguements for registering the settings associated with the section.
         *
         * Settings are saved as arrays. `$setting_id[ $setting_field_id ] = value;`
         *
         * To get a setting, use the format: `get_option( $setting_id )[ $setting_field_id ]`
         *
         * @return array
         */
        public static function get_settings() : array
        {
            return array(
                'license_setting' => array(
                    'option_name'   => 'htsa_plugin_license_setting',
                    'args'          => array(
                        'description'  => sprintf( esc_html__( '%s setting.', 'htsa-plugin' ), HTSA_PLUGIN_NAME ),
                    ),
                    'update_cb'     => null,
                ),
            );
        }

        /**
         * Arrays of arguements to add the fields associated with the section.
         *
         * @return array
         */
        public function get_fields() : array
        {
            return array(
                array(
                    'id'            => 'license_key',
                    'title'         => esc_html__( 'Plugin License Key', 'htsa-plugin' ),
                    'callback'      => 'license_key_field_cb',
                    'setting_key'   => 'license_setting',
                ),
                array(
                    'id'            => 'access_key',
                    'title'         => esc_html__( 'User Access Key', 'htsa-plugin' ),
                    'callback'      => 'access_key_field_cb',
                    'setting_key'   => 'license_setting',
                ),
            );
        }

        /**
         * Function that fills the field with the desired form inputs. The function should echo its output.
         *
         * @param array $args   An array of arguements passed to add_settings_field()
         * @return void
         */
        public function license_key_field_cb( array $args ) : void
        {
            $this->load_view( 'settings.default-fields.input-field', $args, 'admin', false );
        }

        /**
         * Function that fills the field with the desired form inputs. The function should echo its output.
         *
         * @param array $args   An array of arguements passed to add_settings_field()
         * @return void
         */
        public function access_key_field_cb( array $args ) : void
        {
            $this->load_view( 'settings.default-fields.input-field', $args, 'admin', false );
        }
    }
}