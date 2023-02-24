<?php
/**
 * This file contains configuration settings for creating database tables
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @link        https://github.com/codestartechnologies/wordpress-plugin-starter
 */

return array(

    /**
     * Current plugin database version. Must be an integer, and incremented with each new database version.
     * Note: should only be incremented when a new table is meant to be created or modified in the database.
     * Example: 1
     */
    'db_version'    => HTSA_PLUGIN_DB_VERSION,

    /**
     * Identifier for last database version. Option name used to identify the plugin last database version.
     * Must be a unique for each plugin. Example: plugin_name_db_version.
     */
    'last_db_version_name'  => 'htsa_db_version',

);
