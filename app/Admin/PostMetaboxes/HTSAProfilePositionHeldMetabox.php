<?php
/**
 * HTSAProfilePositionHeldMetabox class file.
 *
 * This file contains HTSAProfilePositionHeldMetabox class that will register a custom metabox.
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

if ( ! class_exists( 'HTSAProfilePositionHeldMetabox' ) ) {
    /**
     * HTSAProfilePositionHeldMetabox Class
     *
     * This class registers a custom metabox.
     *
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAProfilePositionHeldMetabox extends PostMetaboxes {
        /**
         * Metadata key.
         */
        protected string $meta_key = HTSA_PROFILE_POSITION_HELD_META_KEY;

        /**
         * HTSAProfilePositionHeldMetabox constructor
         */
        public function __construct()
        {
            $this->id = 'htsa_position_held_metabox';
            $this->title = esc_html__( 'Position Held', 'htsa-plugin' );
            $this->screens = array( HTSA_PROFILE_POST_TYPE, );
            $this->context = 'side';
            $this->priority = 'high';
            // $this->meta_key = HTSA_PROFILE_POSITION_HELD_META_KEY;
            $this->is_single_key = true;
            $this->nonce_action = 'handle htsa position held metabox';
            $this->nonce_name = 'htsa_position_held_metabox_nonce';
            $this->is_unique_key = true;
            $this->metabox_view = 'posts-meta-boxes.profile-position-held';
        }
    }
}
