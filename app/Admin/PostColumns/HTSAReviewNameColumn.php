<?php
/**
 * HTSAReviewNameColumn class file.
 *
 * This file contains HTSAReviewNameColumn class that will register a custom post column.
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

if ( ! class_exists( 'HTSAReviewNameColumn' ) ) {
    /**
     * Class HTSAReviewNameColumn
     *
     * This class registers a custom post column.
     *
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAReviewNameColumn extends PostColumns {
        /**
         * HTSAReviewNameColumn constructor
         */
        public function __construct()
        {
            $this->post_type        = HTSA_REVIEWS_POST_TYPE;
            $this->meta_key         = HTSA_REVIEW_NAME_META_KEY;
            $this->is_single_key    = true;
            $this->column_key       = HTSA_REVIEW_NAME_META_KEY;
            $this->column_title     = esc_html__( 'Full name', 'htsa-plugin' );
            $this->view             = 'post-columns.review-name';
        }
    }
}