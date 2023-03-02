<?php
/**
 * HTSAReviewRatingMetabox class file.
 *
 * This file contains HTSAReviewRatingMetabox class that will register a custom metabox for post.
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
 * HTSAReviewRatingMetabox Class
 *
 * This class registers a custom metabox for post.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSAReviewRatingMetabox extends PostMetaboxes
{
    /**
     * Metadata key.
     *
     * @var string
     * @since 1.0.0
     */
    public string $meta_key = HTSA_REVIEW_RATING_META_KEY;

    /**
     * HTSAReviewRatingMetabox constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->id = 'htsa_review_rating_metabox';
        $this->title = esc_html__( 'Rating', 'htsa-plugin' );
        $this->screens = array( HTSA_REVIEWS_POST_TYPE, );
        $this->context = 'side';
        $this->priority = 'high';
        $this->is_single_key = true;
        $this->nonce_action = 'handle htsa review rating metabox';
        $this->nonce_name = 'htsa_review_rating_metabox_nonce';
        $this->is_unique_key = true;
        $this->metabox_view = 'posts-meta-boxes.review-rating';
    }
}