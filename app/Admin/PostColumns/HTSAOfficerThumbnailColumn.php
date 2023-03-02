<?php
/**
 * HTSAOfficerThumbnailColumn class file.
 *
 * This file contains HTSAOfficerThumbnailColumn class that will add "Featured" post column.
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
 * Class HTSAOfficerThumbnailColumn
 *
 * This class registers a custom post column.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSAOfficerThumbnailColumn extends PostColumns
{
    /**
     * HTSAOfficerThumbnailColumn constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->post_type        = HTSA_OFFICERS_POST_TYPE;
        $this->meta_key         = '_thumbnail_id';
        $this->is_single_key    = true;
        $this->column_key       = '_thumbnail_id';
        $this->column_title     = esc_html__( 'Profile Image', 'htsa-plugin' );
        $this->view             = 'post-columns.officer-thumbnail';
    }
}