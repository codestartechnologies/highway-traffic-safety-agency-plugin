<?php
/**
 * PluginUpdate class file.
 *
 * This file contains PluginUpdate class which checks for latest update for the theme.
 *
 * @package    HighwayTrafficSecurityAgencyPlugin
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since      1.0.0
 */

namespace WPS_Plugin\App\HTSA;

use Codestartechnologies\WordpressPluginStarter\Interfaces\FilterHook;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'PluginUpdate' ) ) {
    /**
     * PluginUpdate Class
     *
     * @package     HighwayTrafficSecurityAgencyPlugin
     * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class PluginUpdate implements FilterHook
    {
        /**
         * Register filter hooks
         *
         * @return void
         * @since 1.0.0
         */
        public function register_add_filter() : void
        {
            $transient = "update_plugins";
            add_filter( "pre_set_site_transient_{$transient}", array( $this, 'filter_pre_set_site_transient_transient' ), 10, 2 );
            add_filter( "plugins_api", array( $this, 'filter_plugins_api' ), 10, 3 );
        }

        /**
         * Fetch details for latest version of plugin from Codestar API
         *
         * @access private
         * @return mixed
         * @since 1.0.0
         */
        private function get_product_info() : mixed
        {
            $product_info = CodestarAPI::get_product_info();
            return ( CodestarAPI::is_api_error( $product_info ) ) ? false : $product_info;
        }

        /**
         * Check if there is an available update for the theme
         *
         * @access private
         * @return false|object
         * @since 1.0.0
         */
        private function is_update_available() : false|object
        {
            if ( $product_info = $this->get_product_info() ) {
                $local_version = get_plugin_data( WPS_FILE, false )['Version'];
                return ( version_compare( $product_info->version, $local_version ) === 1 ) ? $product_info : false;
            }

            return false;
        }

        /**
         * Filters the value of a specific site transient before it is set.
         *
         * @param mixed  $value     New value of site transient.
         * @param string $transient Transient name.
         * @return mixed New value of site transient.
         * @since 1.0.0
         */
        public function filter_pre_set_site_transient_transient( $value, string $transient ) : mixed
        {
            if ( ! empty( $value->checked ) ) {
                $plugin_slug = plugin_basename( WPS_FILE );
                $plugin_info = $this->is_update_available();

                if ( false !== $plugin_info ) {
                    $value->response[ $plugin_slug ] = ( object ) array(
                        'new_version'   => $plugin_info->version,
                        'package'       => $plugin_info->package_url,
                        'slug'          => $plugin_slug,
                    );
                } else {
                    unset( $value->checked[ $plugin_slug ] );
                    unset( $value->response[ $plugin_slug ] );
                }
            }

        	return $value;
        }

        /**
         * Filters the response for the current WordPress.org Plugin Installation API request.
         *
         * @param false|object|array $result The result object or array. Default false.
         * @param string             $action The type of information being requested from the Plugin Installation API.
         * @param object             $args   Plugin API arguments.
         * @return false|object|array The result object or array. Default false.
         * @since 1.0.0
         */
        public function filter_plugins_api( $result, string $action, object $args ) {
            if ( $action === 'plugin_information' && isset( $args->slug ) && $args->slug === plugin_basename( WPS_FILE )  ) {
                if ( $product_info = $this->get_product_info() ) {
                    return ( object ) array(
                        'name'              => $product_info->name ?? '',
                        'version'           => $product_info->version,
                        'slug'              => $args->slug,
                        'download_link'     => $product_info->package_url,
                        'tested'            => $product_info->tested ?? false,
                        'requires'          => $product_info->requires ?? false,
                        'requires_php'      => $product_info->requires_php ?? false,
                        'last_updated'      => $product_info->last_updated ?? '',
                        'homepage'          => $product_info->description_url ?? '',
                        'sections'          => array(
                            'description'   => $product_info->description ?? '',
                            'changelog'     => $product_info->changelog ?? '',
                        ),
                        'icons'             => array(
                            '2x'    => $product_info->icon_256 ?? '',
                            '1x'    => $product_info->icon_128 ?? '',
                        ),
                        'banners'           => array(
                            'low'   => $product_info->banner_low ?? '',
                            'high'  => $product_info->banner_high ?? '',
                        ),
                        'external'          => true,
                    );
                }
            }

        	return $result;
        }
    }
}
