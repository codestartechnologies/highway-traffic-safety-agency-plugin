<?php
/**
 * HTSAProfilePositionHeldMetabox class file.
 *
 * This file contains HTSAProfilePositionHeldMetabox class that will register a custom metabox.
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

if ( ! class_exists( 'HTSAProfilePositionHeldMetabox' ) ) {
    /**
     * HTSAProfilePositionHeldMetabox Class
     *
     * This class registers a custom metabox.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAProfilePositionHeldMetabox extends PostMetaboxes {
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
            $this->meta_key = HTSA_PROFILE_POSITION_HELD_META_KEY;
            $this->is_single_key = true;
            $this->nonce_action = 'handle htsa position held metabox';
            $this->nonce_name = 'htsa_position_held_metabox_nonce';
            $this->is_unique_key = true;
            $this->metabox_view = 'posts-meta-boxes.profile-position-held';
        }
    }
}
