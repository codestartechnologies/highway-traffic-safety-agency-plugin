<?php
/**
 * HTSADepartment class file.
 *
 * This file contains HTSADepartment class that will register a custom taxonomy.
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

if ( ! class_exists( 'HTSADepartment' ) ) {
    /**
     * Class HTSADepartment
     *
     * This class registers a custom taxonomy.
     *
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSADepartment extends Taxonomies {
        /**
         * HTSADepartment Class Constructor
         *
         */
        public function __construct()
        {
            $this->taxonomy = HTSA_DEPARTMENT_TAXONOMY;
        }

        /**
         * An array of objects types the taxonomy belongs to
         *
         * @return array
         */
        public function object_types() : array
        {
            return array( HTSA_OFFICERS_POST_TYPE, HTSA_PROFILE_POST_TYPE );
        }

        /**
         * The taxonomy arguements
         *
         * @return array
         */
        public function taxonomy_args() : array
        {
            return array(
                'labels'                => $this->get_labels(),
                'description'           => esc_html__( 'Zone/Department', 'htsa-plugin' ),
                'show_in_rest'          => true,
                'show_admin_column'     => true,
            );
        }

        /**
         * The taxonomy labels
         *
         * @return array
         */
        public function get_labels() : array
        {
            return array(
                'name'                          => esc_html_x( 'Departments', 'taxonomy general name', 'htsa-plugin' ),
                'singular_name'                 => esc_html_x( 'Department', 'taxonomy singular name', 'htsa-plugin' ),
                'all_items'                     => esc_html__( 'All Departments', 'htsa-plugin' ),
                'edit_item'                     => esc_html__( 'Edit Department', 'htsa-plugin' ),
                'view_item'                     => esc_html__( 'View Department', 'htsa-plugin' ),
                'update_item'                   => esc_html__( 'Update Department', 'htsa-plugin' ),
                'add_new_item'                  => esc_html__( 'Add New Department', 'htsa-plugin' ),
                'new_item_name'                 => esc_html__( 'New Department Name', 'htsa-plugin' ),
                'search_items'                  => esc_html__( 'Search Departments', 'htsa-plugin' ),
                'popular_items'                 => esc_html__( 'Popular Departments', 'htsa-plugin' ),
                'separate_items_with_commas'    => esc_html__( 'Separate departments with commas', 'htsa-plugin' ),
                'add_or_remove_items'           => esc_html__( 'Add or remove departments', 'htsa-plugin' ),
                'choose_from_most_used'         => esc_html__( 'Choose from the most used department', 'htsa-plugin' ),
                'not_found'                     => esc_html__( 'No department found', 'htsa-plugin' ),
                'back_to_items'                 => esc_html__( '← Back to departments', 'htsa-plugin' ),
                'no_terms'                      => esc_html__( 'No departments', 'htsa-plugin' ),
                'items_list_navigation'         => esc_html__( 'Departments list navigation', 'htsa-plugin' ),
                'items_list'                    => esc_html__( 'Departments list', 'htsa-plugin' ),
                'item_link'                     => esc_html__( 'Department Link', 'htsa-plugin' ),
                'item_link_description'         => esc_html__( 'A link to a department', 'htsa-plugin' ),
            );
        }
    }
}