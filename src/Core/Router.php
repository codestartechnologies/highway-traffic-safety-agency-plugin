<?php
/**
 * Router class file.
 *
 * This file contains Router class which handles routes that will be registered in the frontend.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Core;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Interfaces\ActionHook;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Interfaces\FilterHook;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Router
 *
 * This class handles routes that will be registered in the frontend.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class Router implements ActionHook, FilterHook
{

    use ViewLoader;

    /**
     * Array containing registered routes.
     *
     * @access private
     * @var array
     * @since 1.0.0
     */
    private array $routes;

    /**
     * Router constructor
     *
     * @access public
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->set_routes( wps_config( 'routes.routes' ) );
    }

    /**
     * Set registered routes
     *
     * @access private
     * @param array $routes
     * @return void
     * @since 1.0.0
     */
    private function set_routes( array $routes ) : void
    {
        $this->routes = $routes;
    }

    /**
     * Register add_action() and remove_action().
     *
     * @access public
     * @return void
     * @since 1.0.0
     */
    public function register_add_action() : void
    {
        /**
         * Fires once all query variables for the current request have been parsed.
         *
         * @param \WP $wp Current WordPress environment instance (passed by reference).
         */
        add_action( 'parse_request',  array( $this, 'handle_routes' )  );
    }

    /**
     * Register add_filter() and remove_filter().
     *
     * @access public
     * @return void
     * @since 1.0.0
     */
    public function register_add_filter() : void
    {
        add_filter( 'document_title', array( $this, 'set_page_title' ) );
    }

    /**
     * Handle regsitered routes
     *
     * Loads view for a registered route
     *
     * @final
     * @access public
     * @return void
     * @since 1.0.0
     */
    final public function handle_routes() : void
    {
        if ( $this->route_exists() ) {
            $route_handler = $this->get_route_handler( $this->get_current_route() );
            $check = ( isset( $route_handler['capability'] ) ) ? current_user_can( $route_handler['capability'] ) : true;

            if ( ! isset( $route_handler['view'] ) ) {
                _e( '<br /><br /> <h1><center>No view found! Set a default view for this page.</center></h1>', 'wps' );
            } elseif ( ! $check  ) {
                _e( '<br /><br /> <h1><center>You do not have permission to view this page!</center></h1>', 'wps' );
            } else {
                $this->load_view( $route_handler['view'], array(), 'public' );
            }

            exit;
        }
    }

    /**
     * Gets the currently registered route
     *
     * @access private
     * @return string|false
     * @since 1.0.0
     */
    private function get_current_route() : string|false
    {
        $protocol = ( isset( $_SERVER['HTTPS'] )  && 'on' ===  $_SERVER['HTTPS'] )  ? 'https://' : 'http://';
        $link = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $site_link = get_site_url();
        $temp_link = str_replace( $site_link, '', $link );
        $route = strtok( $temp_link, '?' );
        return $route;
    }

    /**
     * Check if a route exists
     *
     * @access private
     * @return boolean
     * @since 1.0.0
     */
    private function route_exists() : bool
    {
        return ( in_array( $this->get_current_route(), $this->get_route_keys(), true ) );
    }

    /**
     * Gets registered route keys
     *
     * @access private
     * @return array
     * @since 1.0.0
     */
    private function get_route_keys() : array
    {
        return array_keys( $this->routes );
    }

    /**
     * Gets information associated with a regsitered route.
     *
     * @access private
     * @param string $route_key
     * @return array
     * @since 1.0.0
     */
    private function get_route_handler( string $route_key ) : array
    {
        return $this->routes[ $route_key ];
    }

    /**
     * Filters the document title.
     *
     * @final
     * @access public
     * @param string $title Document title.
     * @return string Document title.
     * @since 1.0.0
     */
    final public function set_page_title ( string $title ) : string
    {
        if ( $this->route_exists() ) {
            $route_handler = $this->get_route_handler( $this->get_current_route() );
            return $route_handler['title'] ?? esc_html__( 'WordPress Plugin Starter Custom Page', 'wps' );
        }

        return $title;
    }
}