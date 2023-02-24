<?php
/**
 * This file contains configuration settings for custom routes
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 */

return array(

    /**
     * Set routes that need to be registered along with the views
     */
    'routes'    => array(

        /**
         * Add a route for {site_url}/wps-page
         *
         */
        '/wps-page' => array(

            /**
             * The view displayed by the route
             */
            'view'  => 'pages.wps-custom-page',

            /**
             * The page title
             */
            'title' => esc_html__( 'WPS Custom Page', 'wps' ),

            /**
             * Capability needed to access the page
             */
            'capability' => null,

        ),

        '/htsa-shortcodes'  => array(

            'view'      => 'pages.htsa-shortcodes',

            'title'     => esc_html__( 'Available Shortcodes', 'htsa-plugin' ),

            'capability' => 'manage_options',

        ),

        '/email-confirmation'  => array(

            'view'      => 'pages.email-confirmation',

            'title'     => esc_html__( 'Email Confirmation', 'htsa-plugin' ),

            'capability' => null,

        ),

    ),

);
