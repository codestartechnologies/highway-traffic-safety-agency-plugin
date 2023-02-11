<?php
/**
 * HTSANewsletterFormShortcode class file.
 *
 * This file contains HTSANewsletterFormShortcode class that will register a custom shortcode.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Public\Shortcodes;

use Codestartechnologies\WordpressPluginStarter\Abstracts\Shortcodes;
use Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'HTSANewsletterFormShortcode' ) ) {
    /**
     * Class HTSANewsletterFormShortcode
     *
     * This class registers a contact form shortcode.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSANewsletterFormShortcode extends Shortcodes {
        use ViewLoader;

        /**
         * HTSANewsletterFormShortcode Class Constructor
         *
         */
        public function __construct()
        {
            $this->tag = HTSA_NEWSLETTER_FORM_SHORTCODE;
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
            $this->load_view( 'shortcodes.newsletter-form', array(), 'public', false );
        }
    }
}
