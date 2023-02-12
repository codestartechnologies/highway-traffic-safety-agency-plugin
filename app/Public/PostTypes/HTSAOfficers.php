<?php
/**
 * HTSAOfficers class file.
 *
 * This file contains HTSAOfficers class that will register a post type: htsa_officers.
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

if ( ! class_exists( 'HTSAOfficers' ) ) {
    /**
     * Class HTSAOfficers
     *
     * This class registers a custom post type.
     *
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAOfficers extends PostTypes {
        /**
         * HTSAOfficers Class Constructor
         *
         */
        public function __construct()
        {
            $this->post_type = HTSA_OFFICERS_POST_TYPE;
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
                'description'           => esc_html__( 'Archive for displaying principal officers.', 'htsa-plugin' ),
                'public'                => true,
                'publicly_queryable'    => true,
                'show_in_rest'          => true,
                'menu_position'         => 6,
                'menu_icon'             => 'dashicons-groups',
                'supports'              => array( 'title', 'thumbnail', 'custom-fields', ),
                'has_archive'           => true,
                'rewrite'               => array( 'slug' => 'officers', ),
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
                'name'                      => esc_html_x( 'Officers', 'post type general name', 'htsa-plugin' ),
                'singular_name'             => esc_html_x( 'Officer', 'post type singular name', 'htsa-plugin' ),
                'add_new_item'              => esc_html__( 'Add New Officer', 'htsa-plugin' ),
                'edit_item'                 => esc_html__( 'Edit Officer', 'htsa-plugin' ),
                'new_item'                  => esc_html__( 'New Officer', 'htsa-plugin' ),
                'view_item'                 => esc_html__( 'View Officer', 'htsa-plugin' ),
                'view_items'                => esc_html__( 'View Officers', 'htsa-plugin' ),
                'search_items'              => esc_html__( 'Search Officers', 'htsa-plugin' ),
                'not_found'                 => esc_html__( 'No officer found', 'htsa-plugin' ),
                'not_found_in_trash'        => esc_html__( 'No officer found in Trash', 'htsa-plugin' ),
                'all_items'                 => esc_html__( 'All Officers', 'htsa-plugin' ),
                'archives'                  => esc_html__( 'Officer Archives', 'htsa-plugin' ),
                'attributes'                => esc_html__( 'Officer Attributes', 'htsa-plugin' ),
                'insert_into_item'          => esc_html__( 'Insert into officer', 'htsa-plugin' ),
                'uploaded_to_this_item'     => esc_html__( 'Uploaded to this officer', 'htsa-plugin' ),
                'filter_items_list'         => esc_html__( 'Filter officer list', 'htsa-plugin' ),
                'items_list_navigation'     => esc_html__( 'Officer list navigation', 'htsa-plugin' ),
                'items_list'                => esc_html__( 'Officer list', 'htsa-plugin' ),
                'item_published'            => esc_html__( 'Officer published', 'htsa-plugin' ),
                'item_published_privately'  => esc_html__( 'Officer published privately', 'htsa-plugin' ),
                'item_reverted_to_draft'    => esc_html__( 'Officer reverted to draft', 'htsa-plugin' ),
                'item_scheduled'            => esc_html__( 'Officer scheduled', 'htsa-plugin' ),
                'item_updated'              => esc_html__( 'Officer updated', 'htsa-plugin' ),
                'item_link'                 => esc_html__( 'Officer Link', 'htsa-plugin' ),
                'item_link_description'     => esc_html__( 'A link to a officer', 'htsa-plugin' ),
            );
        }
    }
}