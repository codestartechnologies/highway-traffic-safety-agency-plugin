<?php
/**
 * HTSAProfile class file.
 *
 * This file contains HTSAProfile class that will register a post type: htsa_profile.
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
 * Class HTSAProfile
 *
 * This class registers a custom post type.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSAProfile extends PostTypes
{
    /**
     * HTSAProfile Class Constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->post_type = HTSA_PROFILE_POST_TYPE;
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
            'description'           => esc_html__( 'Archive for displaying profiles.', 'htsa-plugin' ),
            'public'                => true,
            'publicly_queryable'    => true,
            'show_in_rest'          => true,
            'menu_position'         => 6,
            'menu_icon'             => 'dashicons-id',
            'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' ),
            'has_archive'           => true,
            'rewrite'               => array( 'slug' => 'profiles', ),
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
            'name'                      => esc_html_x( 'Profiles', 'post type general name', 'htsa-plugin' ),
            'singular_name'             => esc_html_x( 'Profile', 'post type singular name', 'htsa-plugin' ),
            'add_new_item'              => esc_html__( 'Add New Profile', 'htsa-plugin' ),
            'edit_item'                 => esc_html__( 'Edit Profile', 'htsa-plugin' ),
            'new_item'                  => esc_html__( 'New Profile', 'htsa-plugin' ),
            'view_item'                 => esc_html__( 'View Profile', 'htsa-plugin' ),
            'view_items'                => esc_html__( 'View Profiles', 'htsa-plugin' ),
            'search_items'              => esc_html__( 'Search Profiles', 'htsa-plugin' ),
            'not_found'                 => esc_html__( 'No profile found', 'htsa-plugin' ),
            'not_found_in_trash'        => esc_html__( 'No profile found in Trash', 'htsa-plugin' ),
            'all_items'                 => esc_html__( 'All Profiles', 'htsa-plugin' ),
            'archives'                  => esc_html__( 'Profile Archives', 'htsa-plugin' ),
            'attributes'                => esc_html__( 'Profile Attributes', 'htsa-plugin' ),
            'insert_into_item'          => esc_html__( 'Insert into profile', 'htsa-plugin' ),
            'uploaded_to_this_item'     => esc_html__( 'Uploaded to this profile', 'htsa-plugin' ),
            'filter_items_list'         => esc_html__( 'Filter profile list', 'htsa-plugin' ),
            'items_list_navigation'     => esc_html__( 'Profile list navigation', 'htsa-plugin' ),
            'items_list'                => esc_html__( 'Profile list', 'htsa-plugin' ),
            'item_published'            => esc_html__( 'Profile published', 'htsa-plugin' ),
            'item_published_privately'  => esc_html__( 'Profile published privately', 'htsa-plugin' ),
            'item_reverted_to_draft'    => esc_html__( 'Profile reverted to draft', 'htsa-plugin' ),
            'item_scheduled'            => esc_html__( 'Profile scheduled', 'htsa-plugin' ),
            'item_updated'              => esc_html__( 'Profile updated', 'htsa-plugin' ),
            'item_link'                 => esc_html__( 'Profile Link', 'htsa-plugin' ),
            'item_link_description'     => esc_html__( 'A link to a profile', 'htsa-plugin' ),
        );
    }
}