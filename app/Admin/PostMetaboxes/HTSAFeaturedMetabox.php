<?php
/**
 * HTSAFeaturedMetabox class file.
 *
 * This file contains HTSAFeaturedMetabox class that will register a custom metabox for post.
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

if ( ! class_exists( 'HTSAFeaturedMetabox' ) ) {
    /**
     * HTSAFeaturedMetabox Class
     *
     * This class registers a custom metabox for post.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAFeaturedMetabox extends PostMetaboxes {
        /**
         * HTSAFeaturedMetabox constructor
         */
        public function __construct()
        {
            $this->id = 'htsa_post_featured_metabox';
            $this->title = esc_html__( 'Featured', 'htsa-plugin' );
            $this->screens = array( 'post', );
            $this->context = 'side';
            $this->priority = 'high';
            $this->meta_key = HTSA_FEATURED_META_KEY;
            $this->is_single_key = true;
            $this->nonce_action = 'handle htsa post featured metabox';
            $this->nonce_name = 'htsa_post_featured_metabox_nonce';
            $this->is_unique_key = true;
            $this->metabox_view = 'posts-meta-boxes.post-featured';
        }
    }
}
