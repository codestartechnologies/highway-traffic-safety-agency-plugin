<?php
/**
 * HTSAReviewRatingColumn class file.
 *
 * This file contains HTSAReviewRatingColumn class that will register a custom post column.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Admin\PostColumns;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\PostColumns;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class HTSAReviewRatingColumn
 *
 * This class registers a custom post column.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSAReviewRatingColumn extends PostColumns
{
    /**
     * HTSAReviewRatingColumn constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->post_type        = HTSA_REVIEWS_POST_TYPE;
        $this->meta_key         = HTSA_REVIEW_RATING_META_KEY;
        $this->is_single_key    = true;
        $this->column_key       = HTSA_REVIEW_RATING_META_KEY;
        $this->column_title     = esc_html__( 'Rating', 'htsa-plugin' );
        $this->view             = 'post-columns.review-rating';
    }
}