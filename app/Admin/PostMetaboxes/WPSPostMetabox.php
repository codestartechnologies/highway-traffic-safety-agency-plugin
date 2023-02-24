<?php
/**
 * WPSPostMetabox class file.
 *
 * This file contains WPSPostMetabox class that will register a custom metabox for wps_post.
 *
 * @package     WordpressPluginStarter
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
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

if ( ! class_exists( 'WPSPostMetabox' ) ) {
    /**
     * WPSPostMetabox Class
     *
     * This class registers a custom metabox for wps_post.
     *
     * @package WordpressPluginStarter
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class WPSPostMetabox extends PostMetaboxes {
        /**
         * Metadata key.
         *
         * @var string
         * @since 1.0.0
         */
        public string $meta_key = 'wps_post_text';

        /**
         * WPSPostMetabox constructor
         *
         * @since 1.0.0
         */
        public function __construct()
        {
            $this->id = 'wps_post_metabox';
            $this->title = esc_html__( 'WPS Post Metabox', 'wps' );
            $this->screens = array( 'wps_post', );
            $this->context = 'side';
            $this->priority = 'high';
            // $this->meta_key = 'wps_post_text';
            $this->is_single_key = true;
            $this->nonce_action = 'handle wps post metabox';
            $this->nonce_name = 'wps_post_metabox_nonce';
            $this->is_unique_key = true;
            $this->metabox_view = 'posts-meta-boxes.wps-post-metabox';
        }
    }
}