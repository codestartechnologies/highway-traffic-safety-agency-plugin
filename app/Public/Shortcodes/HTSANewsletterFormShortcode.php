<?php
/**
 * HTSANewsletterFormShortcode class file.
 *
 * This file contains HTSANewsletterFormShortcode class that will register a custom shortcode.
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

/**
 * Class HTSANewsletterFormShortcode
 *
 * This class registers a contact form shortcode.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSANewsletterFormShortcode extends Shortcodes
{

    use ViewLoader;

    /**
     * HTSANewsletterFormShortcode Class Constructor
     *
     * @since 1.0.0
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
     * @since 1.0.0
     */
    public function can_display_shortcode() : bool
    {
        return wps_is_theme_active( HTSA_PLUGIN_RECOMMENDED_THEME_NAME );
    }

    /**
     * Default shortcode attributes
     *
     * @return array
     * @since 1.0.0
     */
    public function default_attributes() : array
    {
        return array();
    }

    /**
     * Method to display the contents of the shortcode. [htsa_contact_form_shortcode]
     *
     * @return string
     * @since 1.0.0
     */
    public function display( array $filtered_attributes, string $content, string $tag ) : void
    {
        $this->load_view( 'shortcodes.newsletter-form', array(), 'public', false );
    }
}