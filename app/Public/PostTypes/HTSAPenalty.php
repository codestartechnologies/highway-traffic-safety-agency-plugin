<?php
/**
 * HTSAPenalty class file.
 *
 * This file contains HTSAPenalty class that will register a post type.
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

/**
 * Class HTSAPenalty
 *
 * This class registers a custom post type.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSAPenalty extends PostTypes
{
    /**
     * HTSAPenalty Class Constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->post_type = HTSA_PENALTIES_POST_TYPE;
    }

    /**
     * Returns arguements needed to register the custom post type.
     *
     * @return array
     * @since 1.0.0
     */
    public function post_type_args() : array
    {
        return array(
            'labels'                => $this->get_labels(),
            'description'           => esc_html__( 'Archive for displaying traffic offence penalties.', 'htsa-plugin' ),
            'public'                => true,
            'publicly_queryable'    => true,
            'show_in_rest'          => true,
            'menu_position'         => 6,
            'menu_icon'             => 'dashicons-warning',
            'supports'              => array( 'title', 'custom-fields', ),
            'has_archive'           => true,
            'rewrite'               => array( 'slug' => 'penalties', ),
            'delete_with_user'      => false,
        );
    }

    /**
     * Returns labels for the custom post type.
     *
     * @return array
     * @since 1.0.0
     */
    public function get_labels() : array
    {
        return array(
            'name'                      => esc_html_x( 'Penalties', 'post type general name', 'htsa-plugin' ),
            'singular_name'             => esc_html_x( 'Penalty', 'post type singular name', 'htsa-plugin' ),
            'add_new_item'              => esc_html__( 'Add New Penalty', 'htsa-plugin' ),
            'edit_item'                 => esc_html__( 'Edit Penalty', 'htsa-plugin' ),
            'new_item'                  => esc_html__( 'New Penalty', 'htsa-plugin' ),
            'view_item'                 => esc_html__( 'View Penalty', 'htsa-plugin' ),
            'view_items'                => esc_html__( 'View Penalties', 'htsa-plugin' ),
            'search_items'              => esc_html__( 'Search Penalties', 'htsa-plugin' ),
            'not_found'                 => esc_html__( 'No penalty found', 'htsa-plugin' ),
            'not_found_in_trash'        => esc_html__( 'No penalty found in Trash', 'htsa-plugin' ),
            'all_items'                 => esc_html__( 'All Penalties', 'htsa-plugin' ),
            'archives'                  => esc_html__( 'Penalty Archives', 'htsa-plugin' ),
            'attributes'                => esc_html__( 'Penalty Attributes', 'htsa-plugin' ),
            'insert_into_item'          => esc_html__( 'Insert into penalty', 'htsa-plugin' ),
            'uploaded_to_this_item'     => esc_html__( 'Uploaded to this penalty', 'htsa-plugin' ),
            'filter_items_list'         => esc_html__( 'Filter penalty list', 'htsa-plugin' ),
            'items_list_navigation'     => esc_html__( 'Penalty list navigation', 'htsa-plugin' ),
            'items_list'                => esc_html__( 'Penalty list', 'htsa-plugin' ),
            'item_published'            => esc_html__( 'Penalty published', 'htsa-plugin' ),
            'item_published_privately'  => esc_html__( 'Penalty published privately', 'htsa-plugin' ),
            'item_reverted_to_draft'    => esc_html__( 'Penalty reverted to draft', 'htsa-plugin' ),
            'item_scheduled'            => esc_html__( 'Penalty scheduled', 'htsa-plugin' ),
            'item_updated'              => esc_html__( 'Penalty updated', 'htsa-plugin' ),
            'item_link'                 => esc_html__( 'Penalty Link', 'htsa-plugin' ),
            'item_link_description'     => esc_html__( 'A link to a penalty', 'htsa-plugin' ),
        );
    }
}