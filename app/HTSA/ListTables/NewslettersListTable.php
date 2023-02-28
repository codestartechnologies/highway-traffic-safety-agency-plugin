<?php
/**
 * NewslettersListTable class file.
 *
 * This file contains NewslettersListTable class which checks for latest update for the theme.
 *
 * @package    HighwayTrafficSecurityAgencyPlugin
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since      1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\HTSA\ListTables;

use WP_List_Table;
use wpdb;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * NewslettersListTable Class
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class NewslettersListTable extends WP_List_Table
{
    /**
     * wpdb class
     *
     * @var wpdb
     * @since 1.0.0
     */
    protected wpdb $wpdb;

    /**
     * Constructor
     *
     * @return void
     * @since 1.0.0
     */
    public function __construct()
    {
        global $wpdb;

        $this->wpdb = $wpdb;

        parent::__construct();
    }

    /**
     * Gets a list of columns.
     *
     * @return array
     * @since 1.0.0
     */
    public function get_columns()
    {
        return array(
            'name'          => __( 'Full Name', 'htsa-plugin' ),
            'email'         => __( 'Email Address', 'htsa-plugin' ),
            'valid'         => __( 'Subscription Status', 'htsa-plugin' ),
            'created_at'    => __( 'Date Subscribed', 'htsa-plugin' ),
        );
    }

    /**
     * Gets a list of sortable columns.
     *
     * @return array
     * @since 1.0.0
     */
    protected function get_sortable_columns()
    {
        return array(
            'name'          => array( 'name', false ),
            'email'         => array( 'email', false ),
            'created_at'    => array( 'date', true ),
        );
    }

    /**
     * This is method that is used to render a column when no other specific method exists for that column.
     *
     * @param object|array $item
     * @param string $column_name
     * @return mixed
     * @since 1.0.0
     */
    protected function column_default( $item, $column_name )
    {
        return $item[ $column_name ];
    }

    /**
     * This method is used to render a column for subscriber fullname.
     *
     * @param object|array $item
     * @return void
     * @since 1.0.0
     */
    public function column_name( $item )
    {
        return sprintf( '<b><a>%s</a></b>', $item['name'] );
    }

    /**
     * This method is used to render a column for subscriber email address.
     *
     * @param object|array $item
     * @return void
     * @since 1.0.0
     */
    public function column_email( $item )
    {
        return sprintf( '<a>%s</a>', $item['email'] );
    }

    /**
     * This method is used to render a column for subscription status.
     *
     * @param object|array $item
     * @return void
     * @since 1.0.0
     */
    public function column_valid( $item )
    {
        $arr = ( 1 == $item['valid'] ) ? array( 'color' => '#4caf50', 'msg' => 'active' ) : array( 'color' => '#ffcc29', 'msg' => 'pending' );
        return sprintf( '<b style="color: %1$s;">%2$s</b>', $arr['color'], $arr['msg'] );
    }

    /**
     * This method is used to render a column for subscription date.
     *
     * @param object|array $item
     * @return void
     * @since 1.0.0
     */
    public function column_created_at( $item )
    {
        return sprintf( 'Registered on <br/> %s', date( 'Y/m/d - g:i a', strtotime( $item['created_at'] ) ) );
    }

    /**
     * Prepares the list of items for displaying.
     *
     * @return void
     * @since 1.0.0
     */
    public function prepare_items()
    {
        $table_name = HTSA_PLUGIN_DB_TABLE_PREFIX . 'newsletters';
        $total_items = $this->wpdb->get_var( "SELECT COUNT(*) FROM `{$table_name}`" );
        $per_page = 20;
        $total_pages = ceil( $total_items/$per_page );
        $order_by = ( in_array( $_REQUEST['order_by'] ?? null, array_keys( $this->get_sortable_columns() ) ) ) ? $_REQUEST['order_by'] : 'name';
        $order = ( in_array( $_REQUEST['order'] ?? null, array( 'asc', 'desc' ) ) ) ? $_REQUEST['order'] : 'asc';
        $offset = ( isset( $_REQUEST['paged'] ) ) ? ( $per_page * max( 0, intval( $_REQUEST['paged'] ) - 1 ) ) : 0;

        // Set column headers
        $this->_column_headers = array(
            $this->get_columns(),
            array(),
            $this->get_sortable_columns(),
            'name',
        );

        // Set all the necessary pagination arguments
        $this->set_pagination_args( array(
            'total_items'   => $total_items,
            'per_page'      => $per_page,
            'total_pages'   => $total_pages,
        ) );

        // Store the raw data you want to display
        $this->items = $this->wpdb->get_results(
            $this->wpdb->prepare( "SELECT * FROM `{$table_name}` ORDER BY `{$order_by}` {$order} LIMIT %d OFFSET %d", array( $per_page, $offset ) ),
            ARRAY_A
        );
    }
}