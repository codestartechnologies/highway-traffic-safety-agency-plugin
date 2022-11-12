<?php
/**
 * HTSAProfileSocialHandlesMetabox class file.
 *
 * This file contains HTSAProfileSocialHandlesMetabox class that will register a custom metabox.
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

if ( ! class_exists( 'HTSAProfileSocialHandlesMetabox' ) ) {
    /**
     * HTSAProfileSocialHandlesMetabox Class
     *
     * This class registers a custom metabox.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAProfileSocialHandlesMetabox extends PostMetaboxes {
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
            $this->meta_key = HTSA_PROFILE_SOCIAL_HANDLES_META_KEY;
            $this->is_single_key = true;
            $this->nonce_action = 'handle htsa profile social handles metabox';
            $this->nonce_name = 'htsa_profile_social_handles_metabox_nonce';
            $this->is_unique_key = true;
            $this->metabox_view = 'posts-meta-boxes.profile-social-handles';
        }
    }
}
