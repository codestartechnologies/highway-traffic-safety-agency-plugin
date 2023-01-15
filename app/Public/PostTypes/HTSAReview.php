<?php
/**
 * HTSAReview class file.
 *
 * This file contains HTSAReview class that will register a post type.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Public\PostTypes;

use Codestartechnologies\WordpressPluginStarter\Abstracts\PostTypes;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'HTSAReview' ) ) {
    /**
     * Class HTSAReview
     *
     * This class registers a custom post type.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAReview extends PostTypes {
        /**
         * HTSAReview Class Constructor
         *
         */
        public function __construct()
        {
            $this->post_type = HTSA_REVIEWS_POST_TYPE;
        }

        /**
         * Returns arguements needed to register the custom post type.
         *
         * @return array
         */
        public function post_type_args() : array
        {
            return array(
                'labels'                => $this->get_labels(),
                'description'           => esc_html__( 'Archive for displaying reviews.', 'htsa-plugin' ),
                'public'                => true,
                'publicly_queryable'    => false,
                'show_in_rest'          => true,
                'menu_position'         => 6,
                'menu_icon'             => 'dashicons-testimonial',
                'supports'              => array( 'title', 'thumbnail', 'custom-fields', ),
                'has_archive'           => true,
                'rewrite'               => array( 'slug' => 'reviews', ),
                'delete_with_user'      => false,
            );
        }

        /**
         * Returns labels for the custom post type.
         *
         * @return array
         */
        public function get_labels() : array
        {
            return array(
                'name'                      => esc_html_x( 'Reviews', 'post type general name', 'htsa-plugin' ),
                'singular_name'             => esc_html_x( 'Review', 'post type singular name', 'htsa-plugin' ),
                'add_new_item'              => esc_html__( 'Add New Review', 'htsa-plugin' ),
                'edit_item'                 => esc_html__( 'Edit Review', 'htsa-plugin' ),
                'new_item'                  => esc_html__( 'New Review', 'htsa-plugin' ),
                'view_item'                 => esc_html__( 'View Review', 'htsa-plugin' ),
                'view_items'                => esc_html__( 'View Reviews', 'htsa-plugin' ),
                'search_items'              => esc_html__( 'Search Reviews', 'htsa-plugin' ),
                'not_found'                 => esc_html__( 'No review found', 'htsa-plugin' ),
                'not_found_in_trash'        => esc_html__( 'No review found in Trash', 'htsa-plugin' ),
                'all_items'                 => esc_html__( 'All Reviews', 'htsa-plugin' ),
                'archives'                  => esc_html__( 'Review Archives', 'htsa-plugin' ),
                'attributes'                => esc_html__( 'Review Attributes', 'htsa-plugin' ),
                'insert_into_item'          => esc_html__( 'Insert into review', 'htsa-plugin' ),
                'uploaded_to_this_item'     => esc_html__( 'Uploaded to this review', 'htsa-plugin' ),
                'filter_items_list'         => esc_html__( 'Filter review list', 'htsa-plugin' ),
                'items_list_navigation'     => esc_html__( 'Review list navigation', 'htsa-plugin' ),
                'items_list'                => esc_html__( 'Review list', 'htsa-plugin' ),
                'item_published'            => esc_html__( 'Review published', 'htsa-plugin' ),
                'item_published_privately'  => esc_html__( 'Review published privately', 'htsa-plugin' ),
                'item_reverted_to_draft'    => esc_html__( 'Review reverted to draft', 'htsa-plugin' ),
                'item_scheduled'            => esc_html__( 'Review scheduled', 'htsa-plugin' ),
                'item_updated'              => esc_html__( 'Review updated', 'htsa-plugin' ),
                'item_link'                 => esc_html__( 'Review Link', 'htsa-plugin' ),
                'item_link_description'     => esc_html__( 'A link to a review', 'htsa-plugin' ),
            );
        }
    }
}