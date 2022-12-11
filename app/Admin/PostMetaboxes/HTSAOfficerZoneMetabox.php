<?php
/**
 * HTSAOfficerZoneMetabox class file.
 *
 * This file contains HTSAOfficerZoneMetabox class that will register a custom metabox for post.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\PostMetaboxes;

use Codestartechnologies\WordpressPluginStarter\Abstracts\PostMetaboxes;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'HTSAOfficerZoneMetabox' ) ) {
    /**
     * HTSAOfficerZoneMetabox Class
     *
     * This class registers a custom metabox for post.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAOfficerZoneMetabox extends PostMetaboxes {
        /**
         * Metadata key.
         */
        protected string $meta_key = HTSA_OFFICER_ZONE_META_KEY;

        /**
         * HTSAOfficerZoneMetabox constructor
         */
        public function __construct()
        {
            $this->id = 'htsa_officer_zone_metabox';
            $this->title = esc_html__( 'Zone/Department', 'htsa-plugin' );
            $this->screens = array( HTSA_OFFICERS_POST_TYPE, );
            $this->context = 'side';
            $this->priority = 'high';
            // $this->meta_key = HTSA_OFFICER_ZONE_META_KEY;
            $this->is_single_key = true;
            $this->nonce_action = 'handle htsa officer zone metabox';
            $this->nonce_name = 'htsa_officer_zone_metabox_nonce';
            $this->is_unique_key = true;
            $this->metabox_view = 'posts-meta-boxes.officer-zone';
        }
    }
}
