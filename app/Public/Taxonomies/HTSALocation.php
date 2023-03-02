<?php
/**
 * HTSALocation class file.
 *
 * This file contains HTSALocation class that will register a custom taxonomy.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Public\Taxonomies;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\Taxonomies;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class HTSALocation
 *
 * This class registers a custom taxonomy.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSALocation extends Taxonomies
{
    /**
     * HTSALocation Class Constructor
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->taxonomy = HTSA_LOCATION_TAXONOMY;
    }

    /**
     * An array of objects types the taxonomy belongs to
     *
     * @return array
     * @since 1.0.0
     */
    public function object_types() : array
    {
        return array( HTSA_BRANCHES_POST_TYPE );
    }

    /**
     * The taxonomy arguements
     *
     * @return array
     * @since 1.0.0
     */
    public function taxonomy_args() : array
    {
        return array(
            'labels'                => $this->get_labels(),
            'description'           => esc_html__( 'Location', 'htsa-plugin' ),
            'show_in_rest'          => true,
            'show_admin_column'     => true,
        );
    }

    /**
     * The taxonomy labels
     *
     * @return array
     * @since 1.0.0
     */
    public function get_labels() : array
    {
        return array(
            'name'                          => esc_html_x( 'Locations', 'taxonomy general name', 'htsa-plugin' ),
            'singular_name'                 => esc_html_x( 'Location', 'taxonomy singular name', 'htsa-plugin' ),
            'all_items'                     => esc_html__( 'All Locations', 'htsa-plugin' ),
            'edit_item'                     => esc_html__( 'Edit Location', 'htsa-plugin' ),
            'view_item'                     => esc_html__( 'View Location', 'htsa-plugin' ),
            'update_item'                   => esc_html__( 'Update Location', 'htsa-plugin' ),
            'add_new_item'                  => esc_html__( 'Add New Location', 'htsa-plugin' ),
            'new_item_name'                 => esc_html__( 'New Location Name', 'htsa-plugin' ),
            'search_items'                  => esc_html__( 'Search Locations', 'htsa-plugin' ),
            'popular_items'                 => esc_html__( 'Popular Locations', 'htsa-plugin' ),
            'separate_items_with_commas'    => esc_html__( 'Separate locations with commas', 'htsa-plugin' ),
            'add_or_remove_items'           => esc_html__( 'Add or remove locations', 'htsa-plugin' ),
            'choose_from_most_used'         => esc_html__( 'Choose from the most used location', 'htsa-plugin' ),
            'not_found'                     => esc_html__( 'No location found', 'htsa-plugin' ),
            'back_to_items'                 => esc_html__( '← Back to locations', 'htsa-plugin' ),
            'no_terms'                      => esc_html__( 'No locations', 'htsa-plugin' ),
            'items_list_navigation'         => esc_html__( 'Locations list navigation', 'htsa-plugin' ),
            'items_list'                    => esc_html__( 'Locations list', 'htsa-plugin' ),
            'item_link'                     => esc_html__( 'Location Link', 'htsa-plugin' ),
            'item_link_description'         => esc_html__( 'A link to a location', 'htsa-plugin' ),
        );
    }
}