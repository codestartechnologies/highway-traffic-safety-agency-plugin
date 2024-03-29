<?php
/**
 * HTSAOfficerContactMetabox class file.
 *
 * This file contains HTSAOfficerContactMetabox class that will register a custom metabox.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Admin\PostMetaboxes;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\PostMetaboxes;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * HTSAOfficerContactMetabox Class
 *
 * This class registers a custom metabox for post.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSAOfficerContactMetabox extends PostMetaboxes
{
    /**
     * Metadata key.
     *
     * @var string
     * @since 1.0.0
     */
    public string $meta_key = HTSA_OFFICER_CONTACT_META_KEY;

    /**
     * HTSAOfficerContactMetabox constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->id = 'htsa_officer_contact_metabox';
        $this->title = esc_html__( 'Contact', 'htsa-plugin' );
        $this->screens = array( HTSA_OFFICERS_POST_TYPE, );
        $this->context = 'side';
        $this->priority = 'high';
        // $this->meta_key = HTSA_OFFICER_CONTACT_META_KEY;
        $this->is_single_key = true;
        $this->nonce_action = 'handle htsa officer contact metabox';
        $this->nonce_name = 'htsa_officer_contact_metabox_nonce';
        $this->is_unique_key = true;
        $this->metabox_view = 'posts-meta-boxes.officer-contact';
    }
}