<?php
/**
 * HTSAReviewNameMetabox class file.
 *
 * This file contains HTSAReviewNameMetabox class that will register a custom metabox for post.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
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

if ( ! class_exists( 'HTSAReviewNameMetabox' ) ) {
    /**
     * HTSAReviewNameMetabox Class
     *
     * This class registers a custom metabox for post.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAReviewNameMetabox extends PostMetaboxes {
        /**
         * Metadata key.
         */
        protected string $meta_key = HTSA_REVIEW_NAME_META_KEY;

        /**
         * HTSAReviewNameMetabox constructor
         */
        public function __construct()
        {
            $this->id = 'htsa_review_name_metabox';
            $this->title = esc_html__( 'Full Name', 'htsa-plugin' );
            $this->screens = array( HTSA_REVIEWS_POST_TYPE, );
            $this->context = 'normal';
            $this->priority = 'high';
            $this->is_single_key = true;
            $this->nonce_action = 'handle htsa review name metabox';
            $this->nonce_name = 'htsa_review_name_metabox_nonce';
            $this->is_unique_key = true;
            $this->metabox_view = 'posts-meta-boxes.review-name';
        }
    }
}
