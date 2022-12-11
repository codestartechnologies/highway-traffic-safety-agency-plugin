<?php
/**
 * HTSAPenaltyCurrencySymbolMetabox class file.
 *
 * This file contains HTSAPenaltyCurrencySymbolMetabox class that will register a custom metabox for wps_post.
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

if ( ! class_exists( 'HTSAPenaltyCurrencySymbolMetabox' ) ) {
    /**
     * HTSAPenaltyCurrencySymbolMetabox Class
     *
     * This class registers a custom metabox for wps_post.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAPenaltyCurrencySymbolMetabox extends PostMetaboxes {
        /**
         * Metadata key.
         */
        protected string $meta_key = HTSA_PENALTY_CURRENCY_SYMBOL_META_KEY;

        /**
         * HTSAPenaltyCurrencySymbolMetabox constructor
         */
        public function __construct()
        {
            $this->id = 'htsa_penalty_currency_symbol_metabox';
            $this->title = esc_html__( 'Currency Symbol', 'htsa-plugin' );
            $this->screens = array( HTSA_PENALTIES_POST_TYPE, );
            $this->context = 'side';
            $this->priority = 'high';
            // $this->meta_key = HTSA_PENALTY_VEHICLE_CATRGORIES_META_KEY;
            $this->is_single_key = true;
            $this->nonce_action = 'handle penalty currency symbol metabox';
            $this->nonce_name = 'htsa_penalty_currency_symbol_metabox_nonce';
            $this->is_unique_key = true;
            $this->metabox_view = 'posts-meta-boxes.penalty-currency-symbol';
        }
    }
}
