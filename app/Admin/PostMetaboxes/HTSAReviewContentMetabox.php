<?php
/**
 * HTSAReviewContentMetabox class file.
 *
 * This file contains HTSAReviewContentMetabox class that will register a custom metabox for post.
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
 * HTSAReviewContentMetabox Class
 *
 * This class registers a custom metabox for post.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSAReviewContentMetabox extends PostMetaboxes
{
    /**
     * Metadata key.
     *
     * @var string
     * @since 1.0.0
     */
    public string $meta_key = HTSA_REVIEW_CONTENT_META_KEY;

    /**
     * HTSAReviewContentMetabox constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->id = 'htsa_review_content_metabox';
        $this->title = esc_html__( 'Content', 'htsa-plugin' );
        $this->screens = array( HTSA_REVIEWS_POST_TYPE, );
        $this->context = 'normal';
        $this->priority = 'high';
        $this->is_single_key = true;
        $this->nonce_action = 'handle htsa review content metabox';
        $this->nonce_name = 'htsa_review_content_metabox_nonce';
        $this->is_unique_key = true;
        $this->metabox_view = 'posts-meta-boxes.review-content';
    }
}