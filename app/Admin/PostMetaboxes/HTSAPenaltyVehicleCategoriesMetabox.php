<?php
/**
 * HTSAPenaltyVehicleCategoriesMetabox class file.
 *
 * This file contains HTSAPenaltyVehicleCategoriesMetabox class that will register a custom metabox for wps_post.
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

if ( ! class_exists( 'HTSAPenaltyVehicleCategoriesMetabox' ) ) {
    /**
     * HTSAPenaltyVehicleCategoriesMetabox Class
     *
     * This class registers a custom metabox for wps_post.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAPenaltyVehicleCategoriesMetabox extends PostMetaboxes {
        /**
         * Metadata key.
         */
        protected string $meta_key = HTSA_PENALTY_VEHICLE_CATRGORIES_META_KEY;

        /**
         * HTSAPenaltyVehicleCategoriesMetabox constructor
         */
        public function __construct()
        {
            $this->id = 'htsa_penalty_vehicle_categories_metabox';
            $this->title = esc_html__( 'Vehicle Categories', 'htsa-plugin' );
            $this->screens = array( HTSA_PENALTIES_POST_TYPE, );
            $this->context = 'normal';
            $this->priority = 'high';
            // $this->meta_key = HTSA_PENALTY_VEHICLE_CATRGORIES_META_KEY;
            $this->is_single_key = true;
            $this->nonce_action = 'handle penalty vehicle categories metabox';
            $this->nonce_name = 'htsa_penalty_vehicle_categories_metabox_nonce';
            $this->is_unique_key = true;
            $this->metabox_view = 'posts-meta-boxes.penalty-vehicle-categories';
        }
    }
}
