<?php
/**
 * HTSABranch class file.
 *
 * This file contains HTSABranch class that will register a post type.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Public\PostTypes;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\PostTypes;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'HTSABranch' ) ) {
    /**
     * Class HTSABranch
     *
     * This class registers a custom post type.
     *
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSABranch extends PostTypes {
        /**
         * HTSABranch Class Constructor
         *
         */
        public function __construct()
        {
            $this->post_type = HTSA_BRANCHES_POST_TYPE;
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
                'description'           => esc_html__( 'Archive for displaying branches/regions.', 'htsa-plugin' ),
                'public'                => true,
                'publicly_queryable'    => true,
                'show_in_rest'          => true,
                'menu_position'         => 6,
                'menu_icon'             => 'dashicons-building',
                'supports'              => array( 'title', 'thumbnail', 'custom-fields', ),
                'has_archive'           => true,
                'rewrite'               => array( 'slug' => 'branches', ),
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
                'name'                      => esc_html_x( 'Branches', 'post type general name', 'htsa-plugin' ),
                'singular_name'             => esc_html_x( 'Branch', 'post type singular name', 'htsa-plugin' ),
                'add_new_item'              => esc_html__( 'Add New Branch', 'htsa-plugin' ),
                'edit_item'                 => esc_html__( 'Edit Branch', 'htsa-plugin' ),
                'new_item'                  => esc_html__( 'New Branch', 'htsa-plugin' ),
                'view_item'                 => esc_html__( 'View Branch', 'htsa-plugin' ),
                'view_items'                => esc_html__( 'View Branches', 'htsa-plugin' ),
                'search_items'              => esc_html__( 'Search Branches', 'htsa-plugin' ),
                'not_found'                 => esc_html__( 'No branch found', 'htsa-plugin' ),
                'not_found_in_trash'        => esc_html__( 'No branch found in Trash', 'htsa-plugin' ),
                'all_items'                 => esc_html__( 'All Branches', 'htsa-plugin' ),
                'archives'                  => esc_html__( 'Branch Archives', 'htsa-plugin' ),
                'attributes'                => esc_html__( 'Branch Attributes', 'htsa-plugin' ),
                'insert_into_item'          => esc_html__( 'Insert into branch', 'htsa-plugin' ),
                'uploaded_to_this_item'     => esc_html__( 'Uploaded to this branch', 'htsa-plugin' ),
                'filter_items_list'         => esc_html__( 'Filter branch list', 'htsa-plugin' ),
                'items_list_navigation'     => esc_html__( 'Branch list navigation', 'htsa-plugin' ),
                'items_list'                => esc_html__( 'Branch list', 'htsa-plugin' ),
                'item_published'            => esc_html__( 'Branch published', 'htsa-plugin' ),
                'item_published_privately'  => esc_html__( 'Branch published privately', 'htsa-plugin' ),
                'item_reverted_to_draft'    => esc_html__( 'Branch reverted to draft', 'htsa-plugin' ),
                'item_scheduled'            => esc_html__( 'Branch scheduled', 'htsa-plugin' ),
                'item_updated'              => esc_html__( 'Branch updated', 'htsa-plugin' ),
                'item_link'                 => esc_html__( 'Branch Link', 'htsa-plugin' ),
                'item_link_description'     => esc_html__( 'A link to a branch', 'htsa-plugin' ),
            );
        }
    }
}