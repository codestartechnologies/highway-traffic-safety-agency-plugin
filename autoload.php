<?php
/**
 * This file contains functions for loading classes and files
 *
 * @link https://github.com/codestartechnologies/wordpress-plugin-starter
 */

namespace HTSA_Plugin\Codestartechnologies\WordpressPluginStarter;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPSAutoLoader class
 *
 * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class WPSAutoLoader
{
    /**
     * Prefix to add to namespace
     *
     * @access protected
     * @static
     * @var string|null
     * @since 1.0.0
     */
    protected static ?string $prefix = 'HTSA_Plugin';

    /**
     * Auto load class mappings
     *
     * @access protected
     * @static
     * @var array
     * @since 1.0.0
     */
    protected static array $class_autoloads = array(
        "WPS_Plugin\\App" => "app",
        "Codestartechnologies\\WordpressPluginStarter" => "src",
    );

    /**
     * Auto load file mappings
     *
     * @access protected
     * @static
     * @var array
     * @since 1.0.0
     */
    protected static array $file_autoloads = array(
        "src/functions.php",
        "app/helpers.php",
    );

    /**
     * PHPmailer files
     *
     * @access protected
     * @static
     * @var array
     * @since 1.0.0
     */
    protected static array $phpmailer_files = array(
        "Exception.php",
        "PHPMailer.php",
        "SMTP.php",
    );

    /**
     * handles autoloading for classes and files
     *
     * @static
     * @return void
     * @since 1.0.0
     */
    public static function autoload() : void
    {
        self::autoload_phpmailer_files();
        self::autoload_wps_files();
        spl_autoload_register( array( __CLASS__, 'wps_autoloader' ) );
    }

    /**
     * handles autoloading for classes
     *
     * @static
     * @param string $class
     * @return void
     * @since 1.0.0
     */
    public static function wps_autoloader( string $class ) : void
    {
        self::autoload_wps_classes( $class );
    }

    private static function autoload_wps_classes( string $class ) : void
    {
        $prefix = isset( self::$prefix ) ? self::$prefix . "\\" : '';

        foreach ( self::$class_autoloads as $namespace => $dir ) {
            $namespace = $prefix . $namespace;

            if ( strpos( $class, $namespace ) === 0 ) {
                $class = str_replace( $namespace, '', $class );
                $class = str_replace( '\\', DIRECTORY_SEPARATOR, $class ) . '.php';
                $path = trailingslashit( plugin_dir_path( __FILE__ ) ) . $dir . DIRECTORY_SEPARATOR . $class;

                if ( is_readable( $path ) ) {
                    require_once( $path );
                }
            }
        }
    }

    private static function autoload_wps_files() : void
    {
        $path = trailingslashit( plugin_dir_path( __FILE__ ) );

        foreach ( self::$file_autoloads as $file ) {
            if ( is_readable( $path . $file ) ) {
                require_once( $path . $file );
            }
        }
    }

    private static function autoload_phpmailer_files() : void
    {
        $path = trailingslashit( ABSPATH . WPINC ) . 'PHPMailer/';

        foreach ( self::$phpmailer_files as $file ) {
            if ( is_readable( $path . $file ) ) {
                require_once( $path . $file );
            }
        }
    }
}

\HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\WPSAutoLoader::autoload();