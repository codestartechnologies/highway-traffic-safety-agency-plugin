<?php
/**
 * HTSAContactFormShortcode class file.
 *
 * This file contains HTSAContactFormShortcode class that will register a custom shortcode.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Public\Shortcodes;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\Shortcodes;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'HTSAContactFormShortcode' ) ) {
    /**
     * Class HTSAContactFormShortcode
     *
     * This class registers a contact form shortcode.
     *
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAContactFormShortcode extends Shortcodes {
        use ViewLoader;

        /**
         * HTSAContactFormShortcode Class Constructor
         *
         */
        public function __construct()
        {
            $this->tag = HTSA_CONTACT_FORM_SHORTCODE;
            $this->type = 'basic';
        }

        /**
         * Method to check when to register the shortcode
         *
         * @return boolean
         */
        public function can_display_shortcode() : bool
        {
            return wps_is_theme_active( 'Highway Traffic Security Agency' );
        }

        /**
         * Default shortcode attributes
         *
         * @return array
         */
        public function default_attributes() : array
        {
            return array();
        }

        /**
         * Method to display the contents of the shortcode. [htsa_contact_form_shortcode]
         *
         * @return string
         */
        public function display( array $filtered_attributes, string $content, string $tag ) : void
        {
            $this->load_view( 'shortcodes.contact-form', array(), 'public', false );
        }
    }
}
