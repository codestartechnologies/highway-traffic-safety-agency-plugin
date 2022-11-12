<?php
/**
 * HTSAProfilePositionHeldColumn class file.
 *
 * This file contains HTSAProfilePositionHeldColumn class that will add "Featured" post column.
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

if ( ! class_exists( 'HTSAProfilePositionHeldColumn' ) ) {
    /**
     * Class HTSAProfilePositionHeldColumn
     *
     * This class registers a custom post column.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAProfilePositionHeldColumn extends PostColumns {
        /**
         * HTSAProfilePositionHeldColumn constructor
         */
        public function __construct()
        {
            $this->post_type        = HTSA_PROFILE_POST_TYPE;
            $this->meta_key         = HTSA_PROFILE_POSITION_HELD_META_KEY;
            $this->is_single_key    = true;
            $this->column_key       = HTSA_PROFILE_POSITION_HELD_META_KEY;
            $this->column_title     = esc_html__( 'Position Held', 'htsa-plugin' );
            $this->view             = 'post-columns.profile-position-held';
        }
    }
}