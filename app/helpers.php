<?php
/**
 * This file contains general helper functions used in creating your plugin
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 */

if ( ! function_exists( 'htsa_plugin_store_session_data' ) ) {
    /**
     * Store data in wp session
     *
     * @param string $key
     * @param mixed $value
     * @param int $expire
     * @return void
     * @since 1.0.0
     */
    function htsa_plugin_store_session_data( string $key, mixed $value, int $expire ) : void
    {
        $wp_session = WP_Session_Tokens::get_instance( get_current_user_id() );
        $wp_session->update( $key, array(
            'expiration'    => $expire,
            'message'       => $value,
        ) );
    }
}

if ( ! function_exists( 'htsa_plugin_get_session_data' ) ) {
    /**
     * Retrieve data from wp session
     *
     * @param string $key
     * @return mixed
     * @since 1.0.0
     */
    function htsa_plugin_get_session_data( string $key ) : mixed
    {
        $wp_session = WP_Session_Tokens::get_instance( get_current_user_id() );
        $value = $wp_session->get( $key );
        return ( is_array( $value ) ) ? $value['message'] : null;
    }
}

if ( ! function_exists( 'htsa_plugin_destroy_session_data' ) ) {
    /**
     * Remove data from wp session
     *
     * @param string $key
     * @return void
     * @since 1.0.0
     */
    function htsa_plugin_destroy_session_data( string $key ) : void
    {
        $wp_session = WP_Session_Tokens::get_instance( get_current_user_id() );
        $wp_session->destroy( $key );
    }
}

if ( ! function_exists( 'htsa_plugin_get_license_api_response' ) ) {
    /**
     * Decode and translate API response
     *
     * @param mixed $response
     * @return array
     * @since 1.0.0
     */
    function htsa_plugin_get_license_api_response( mixed $response ) : array
    {
        $message = array();

        switch ( $response ) {
            case 'invalid user credentials':
            case 'unknown license key':
                $message['type'] = 'error';
                $message['message'] = sprintf( __( '<b>%s</b>: License settings are invalid! Check your license key and access key', 'htsa-plugin' ), HTSA_PLUGIN_NAME );
                break;

            case 'unactivated license key':
                $message['type'] = 'error';
                $message['message'] = sprintf( __( '<b>%s</b>: License key has not yet been activated! Activate license key before deactivation', 'htsa-plugin' ), HTSA_PLUGIN_NAME );
                break;

            case 'invalid license key domain':
                $message['type'] = 'error';
                $message['message'] = sprintf( __( '<b>%s</b>: License key cannot be deactivated from this website domain', 'htsa-plugin' ), HTSA_PLUGIN_NAME );
                break;

            case 'license key activation limited':
                $message['type'] = 'error';
                $message['message'] = sprintf( __( '<b>%s</b>: You have reached the maximum activation limit for license key', 'htsa-plugin' ), HTSA_PLUGIN_NAME );
                break;

            case 'too much requests':
                $message['type'] = 'error';
                $message['message'] = sprintf( __( '<b>%s</b>: You\'ve made too much request to API, try again in one hour time', 'htsa-plugin' ), HTSA_PLUGIN_NAME );
                break;

            case 'activation error':
            case 'deactivation error':
                $message['type'] = 'error';
                $message['message'] = sprintf( __( '<b>%s</b>: An error occured with deactivation/activation! Refresh page and try again', 'htsa-plugin' ), HTSA_PLUGIN_NAME );
                break;

            case 'error':
                $message['type'] = 'error';
                $message['message'] = sprintf( __( '<b>%s</b>: An error occured! Refresh page and try again. Or contact plugin author', 'htsa-plugin' ), HTSA_PLUGIN_NAME );
                break;

            default:
                $message['type'] = 'error';
                $message['message'] = sprintf( __( '<b>%s</b>: Could not make API request. Unknown error occured!', 'htsa-plugin' ), HTSA_PLUGIN_NAME );
        }

        return $message;
    }
}

if ( ! function_exists( 'htsa_plugin_license_api_notice' ) ) {
    /**
     * Prints out API response message
     *
     * @param mixed $response
     * @return void
     * @since 1.0.0
     */
    function htsa_plugin_license_api_notice( mixed $response ) : void
    {
        $message = htsa_plugin_get_license_api_response( $response );
        printf( '<div class="%1$s"><p>%2$s</p></div>', $message['type'], $message['message'] );
    }
}