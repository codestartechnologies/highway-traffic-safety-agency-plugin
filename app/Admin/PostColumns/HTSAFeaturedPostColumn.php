<?php
/**
 * HTSAFeaturedPostColumn class file.
 *
 * This file contains HTSAFeaturedPostColumn class that will add "Featured" post column.
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
 * Class HTSAFeaturedPostColumn
 *
 * This class registers a custom post column.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSAFeaturedPostColumn extends PostColumns
{
    /**
     * HTSAFeaturedPostColumn constructor
     *
     * @since 1.0.0
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