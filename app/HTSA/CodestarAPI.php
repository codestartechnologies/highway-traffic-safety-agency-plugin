<?php
/**
 * CodestarAPI class file.
 *
 * This file contains CodestarAPI class which makes api calls to an endpoint for fetching theme information.
 *
 * @package    HighwayTrafficSecurityAgencyPlugin
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since      1.0.0
 */

namespace WPS_Plugin\App\HTSA;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'CodestarAPI' ) ) {
    /**
     * CodestarAPI Class
     *
     * @package     HighwayTrafficSecurityAgencyPlugin
     * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class CodestarAPI
    {
        /**
         * Gets license settings from database
         *
         * @return array
         * @since 1.0.0
         */
        private static function get_license_setting() : array
        {
            $setting = get_option( 'htsa_plugin_license_setting' );
            return array(
                'access_key'    => $setting['access_key'] ?? null,
                'license_key'   => $setting['license_key'] ?? null,
            );
        }

        /**
         * Checks if license setting exists
         *
         * @static
         * @return boolean
         * @since 1.0.0
         */
        public static function has_license_setting() : bool
        {
            $setting = self::get_license_setting();
            return ( empty( $setting['access_key'] ) || empty( $setting['license_key'] ) ) ? false : true;
        }

        /**
         * Makes api call to an endpoint
         *
         * @access private
         * @static
         * @param string $action
         * @param array $params
         * @param string $method
         * @return mixed
         * @since 1.0.0
         */
        private static function call_api( string $action, array $params, string $method = 'GET' ) : mixed
        {
            if ( ! self::has_license_setting() ) {
                return "invalid license setting";
            }

            $endpoint = ( $_ENV['HTSA_PLUGIN_ENV'] === 'production' ) ? $_ENV['HTSA_PLUGIN_API_ENDPOINT_PROD'] : $_ENV['HTSA_PLUGIN_API_ENDPOINT_DEV'];
            $url = trailingslashit( $endpoint ) . $action;
            $setting = self::get_license_setting();
            $access_key = $setting['access_key'];

            $args = array(
                'sslverify'     => false,
                'timeout'       => 45,
                'redirection'   => 2,
                'headers'       => array(
                    'referer'           => home_url(),
                    'Authorization'     => 'Bearer ' . $access_key,
                ),
            );

            if ( $_ENV['HTSA_PLUGIN_ENV'] === 'production' ) {
                if ( $method === 'GET' ) {
                    $url .= '?' . http_build_query( $params );
                    $response = wp_safe_remote_get( $url, $args );
                } elseif ( $method === 'POST' ) {
                    $args['body'] = $params;
                    $response = wp_safe_remote_post( $url, $args );
                }
            } else {
                if ( $method === 'GET' ) {
                    $url .= '?' . http_build_query( $params );
                    $response = wp_remote_get( $url, $args );
                } elseif ( $method === 'POST' ) {
                    $args['body'] = $params;
                    $response = wp_remote_post( $url, $args );
                }
            }

            if ( is_wp_error( $response ) ) {
                return $response->get_error_message();
            }

            $response_body = wp_remote_retrieve_body( $response );
            return json_decode( $response_body );
        }

        /**
         * Checks if error occured after api call was made
         *
         * @static
         * @param mixed $response
         * @return boolean
         * @since 1.0.0
         */
        public static function is_api_error( mixed $response ) : bool
        {
            return ( ! is_object( $response ) || ! $response->success ) ? true : false;
        }

        /**
         * API call for validating product license
         *
         * @static
         * @return mixed
         * @since 1.0.0
         */
        public static function validate_license() : mixed
        {
            return self::call_api(
                'validate',
                array(
                    'product_id'    => $_ENV['HTSA_PLUGIN_API_PRODUCT_ID'],
                    'license_key' => self::get_license_setting()['license_key']
                ),
                'GET'
            );
        }

        /**
         * API call for activating product license
         *
         * @static
         * @return mixed
         * @since 1.0.0
         */
        public static function activate_license() : mixed
        {
            return self::call_api(
                'activate',
                array(
                    'product_id'    => $_ENV['HTSA_PLUGIN_API_PRODUCT_ID'],
                    'license_key'   => self::get_license_setting()['license_key'],
                    'domain'        => str_replace( ['https://', 'http://'], "", home_url() ),
                ),
                'POST'
            );
        }

        /**
         * API call for deactivating product license
         *
         * @static
         * @return mixed
         * @since 1.0.0
         */
        public static function deactivate_license() : mixed
        {
            return self::call_api(
                'deactivate',
                array(
                    'product_id'    => $_ENV['HTSA_PLUGIN_API_PRODUCT_ID'],
                    'license_key'   => self::get_license_setting()['license_key'],
                    'domain'        => str_replace( ['https://', 'http://'], "", home_url() ),
                ),
                'POST'
            );
        }

        /**
         * API call for getting information related to a product
         *
         * @static
         * @return mixed
         * @since 1.0.0
         */
        public static function get_product_info() : mixed
        {
            return self::call_api(
                'product-info',
                array(
                    'product_id'    => $_ENV['HTSA_PLUGIN_API_PRODUCT_ID'],
                    'license_key'   => self::get_license_setting()['license_key'],
                    'domain'        => str_replace( ['https://', 'http://'], "", home_url() ),
                ),
                'POST'
            );
        }
    }
}
