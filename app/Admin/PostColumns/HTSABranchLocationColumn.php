<?php
/**
 * HTSABranchLocationColumn class file.
 *
 * This file contains HTSABranchLocationColumn class that will register a custom post column.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\PostColumns;

use Codestartechnologies\WordpressPluginStarter\Abstracts\PostColumns;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'HTSABranchLocationColumn' ) ) {
    /**
     * Class HTSABranchLocationColumn
     *
     * This class registers a custom post column.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSABranchLocationColumn extends PostColumns {
        /**
         * HTSABranchLocationColumn constructor
         */
        public function __construct()
        {
            $this->post_type        = HTSA_BRANCHES_POST_TYPE;
            $this->meta_key         = HTSA_BRANCH_LOCATION_META_KEY;
            $this->is_single_key    = true;
            $this->column_key       = HTSA_BRANCH_LOCATION_META_KEY;
            $this->column_title     = esc_html__( 'Location', 'htsa-plugin' );
            $this->view             = 'post-columns.branch-location';
        }
    }
}