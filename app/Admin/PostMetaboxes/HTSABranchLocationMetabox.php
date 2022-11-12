<?php
/**
 * HTSABranchLocationMetabox class file.
 *
 * This file contains HTSABranchLocationMetabox class that will register a custom metabox for post.
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

if ( ! class_exists( 'HTSABranchLocationMetabox' ) ) {
    /**
     * HTSABranchLocationMetabox Class
     *
     * This class registers a custom metabox for post.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSABranchLocationMetabox extends PostMetaboxes {
        /**
         * HTSABranchLocationMetabox constructor
         */
        public function __construct()
        {
            $this->id = 'htsa_branch_location_metabox';
            $this->title = esc_html__( 'Location', 'htsa-plugin' );
            $this->screens = array( HTSA_BRANCHES_POST_TYPE, );
            $this->context = 'side';
            $this->priority = 'high';
            $this->meta_key = HTSA_BRANCH_LOCATION_META_KEY;
            $this->is_single_key = true;
            $this->nonce_action = 'handle htsa branch location metabox';
            $this->nonce_name = 'htsa_branch_location_metabox_nonce';
            $this->is_unique_key = true;
            $this->metabox_view = 'posts-meta-boxes.branch-location';
        }
    }
}
