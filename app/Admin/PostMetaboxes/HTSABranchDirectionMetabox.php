<?php
/**
 * HTSABranchDirectionMetabox class file.
 *
 * This file contains HTSABranchDirectionMetabox class that will register a custom metabox for post.
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

if ( ! class_exists( 'HTSABranchDirectionMetabox' ) ) {
    /**
     * HTSABranchDirectionMetabox Class
     *
     * This class registers a custom metabox for post.
     *
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSABranchDirectionMetabox extends PostMetaboxes {
        /**
         * Metadata key.
         *
         * @var string
         * @since 1.0.0
         */
        public string $meta_key = HTSA_BRANCH_DIRECTION_META_KEY;

        /**
         * HTSABranchDirectionMetabox constructor
         *
         * @since 1.0.0
         */
        public function __construct()
        {
            $this->id = 'htsa_branch_direction_metabox';
            $this->title = esc_html__( 'Direction', 'htsa-plugin' );
            $this->screens = array( HTSA_BRANCHES_POST_TYPE, );
            $this->context = 'normal';
            $this->priority = 'high';
            // $this->meta_key = HTSA_BRANCH_DIRECTION_META_KEY;
            $this->is_single_key = true;
            $this->nonce_action = 'handle htsa branch direction metabox';
            $this->nonce_name = 'htsa_branch_direction_metabox_nonce';
            $this->is_unique_key = true;
            $this->metabox_view = 'posts-meta-boxes.branch-direction';
        }
    }
}
