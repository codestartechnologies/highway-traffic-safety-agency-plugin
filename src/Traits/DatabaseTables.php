<?php
/**
 * DatabaseTables trait file.
 *
 * This file contains DatabaseTables trait for modifying database table columns.
 *
 * @package    WordpressPluginStarter
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @link       https://github.com/codestartechnologies/wordpress-plugin-starter
 * @since      1.0.0
 */

namespace HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Traits;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Trait DatabaseTables
 *
 * This trait is used for modifying database table columns.
 *
 * @package WordpressPluginStarter
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
trait DatabaseTables
{
    /**
     * Modify the table column(s)
     *
     * @final
     * @return integer|boolean
     * @since 1.0.0
     */
    final public function modify() : int|bool
    {
        return $this->wpdb->query( $this->get_modify_column_query_string() );
    }

    /**
     * SQL query string for modifying the table column(s).
     *
     * @access protected
     * @abstract
     * @return string
     * @since 1.0.0
     */
    protected abstract function get_modify_column_query_string() : string;
}