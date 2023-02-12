<?php
/**
 * HTSAProfileSocialHandlesMetabox class file.
 *
 * This file contains HTSAProfileSocialHandlesMetabox class that will register a custom metabox.
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

if ( ! class_exists( 'HTSAProfileSocialHandlesMetabox' ) ) {
    /**
     * HTSAProfileSocialHandlesMetabox Class
     *
     * This class registers a custom metabox.
     *
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAProfileSocialHandlesMetabox extends PostMetaboxes {
        /**
         * Metadata key.
         */
        protected string $meta_key = HTSA_PROFILE_SOCIAL_HANDLES_META_KEY;

        /**
         * HTSAProfileSocialHandlesMetabox constructor
         */
        public function __construct()
        {
            $this->id = 'htsa_profile_social_handles_metabox';
            $this->title = esc_html__( 'Social Handles', 'htsa-plugin' );
            $this->screens = array( HTSA_PROFILE_POST_TYPE, );
            $this->context = 'side';
            $this->priority = 'high';
            // $this->meta_key = HTSA_PROFILE_SOCIAL_HANDLES_META_KEY;
            $this->is_single_key = true;
            $this->nonce_action = 'handle htsa profile social handles metabox';
            $this->nonce_name = 'htsa_profile_social_handles_metabox_nonce';
            $this->is_unique_key = true;
            $this->metabox_view = 'posts-meta-boxes.profile-social-handles';
        }
    }
}
