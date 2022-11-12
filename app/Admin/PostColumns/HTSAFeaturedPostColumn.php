<?php
/**
 * HTSAFeaturedPostColumn class file.
 *
 * This file contains HTSAFeaturedPostColumn class that will add "Featured" post column.
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

if ( ! class_exists( 'HTSAFeaturedPostColumn' ) ) {
    /**
     * Class HTSAFeaturedPostColumn
     *
     * This class registers a custom post column.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAFeaturedPostColumn extends PostColumns {
        /**
         * HTSAFeaturedPostColumn constructor
         */
        public function __construct()
        {
            $this->post_type        = 'post';
            $this->meta_key         = HTSA_FEATURED_META_KEY;
            $this->is_single_key    = true;
            $this->column_key       = HTSA_FEATURED_META_KEY;
            $this->column_title     = esc_html__( 'Featured', 'htsa-plugin' );
            $this->view             = 'post-columns.featured-post';
        }
    }
}