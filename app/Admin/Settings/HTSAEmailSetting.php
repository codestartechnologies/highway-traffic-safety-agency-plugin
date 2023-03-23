<?php
/**
 * HTSAEmailSetting class file.
 *
 * This file contains HTSAEmailSetting class that will register a custom setting.
 *
 * @package     HighwayTrafficSecurityAgencyPlugin
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @link        https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @since       1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\Admin\Settings;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Abstracts\Settings;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Traits\Logger;
use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class HTSAEmailSetting
 *
 * This class registers a custom setting.
 *
 * @package HighwayTrafficSecurityAgencyPlugin
 * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
 */
final class HTSAEmailSetting extends Settings
{

    use ViewLoader, Logger;

    /**
     * Arguements needed to add the section for the settings.
     *
     * @return array
     * @since 1.0.0
     */
    public function get_section() : array
    {
        return array(

            'smtp_settings' => array(
                'id'            => 'htsa_smtp_settings',
                'title'         => esc_html__( 'SMTP Settings', 'htsa' ),
                'page'          => 'htsa-email-setting',
                'callback'      => null,
            ),

            'user_settings' => array(
                'id'            => 'htsa_user_settings',
                'title'         => esc_html__( 'User Settings', 'htsa' ),
                'page'          => 'htsa-email-setting',
                'callback'      => null,
            ),

        );
    }

    /**
     * Arrays of arguements for registering the settings associated with the section.
     *
     * Settings are saved as arrays. `$setting_id[ $setting_field_id ] = value;`
     *
     * To get a setting, use the format: `get_option( $setting_id )[ $setting_field_id ]`
     *
     * @return array
     * @since 1.0.0
     */
    public static function get_settings() : array
    {
        return array(

            'smtp_server_credentials' => array(
                'option_name'   => 'htsa_smtp_server_credentials',
                'args'          => array(
                    'description'  => esc_html__( 'SMTP Host', 'htsa' ),
                ),
            ),

            'smtp_receipents' => array(
                'option_name'   => 'htsa_smtp_receipents',
                'args'          => array(
                    'description'  => esc_html__( 'SMTP Username', 'htsa' ),
                ),
            ),

        );
    }

    /**
     * Arrays of arguements to add the fields associated with the section.
     *
     * @return array
     * @since 1.0.0
     */
    public function get_fields() : array
    {
        return array(

            array(
                'id'            => 'htsa_smtp_host_field',
                'title'         => esc_html__( 'SMTP Host', 'htsa' ),
                'callback'      => 'htsa_smtp_host_field',
                'setting_key'   => 'smtp_server_credentials',
                'section'       => 'smtp_settings',
            ),

            array(
                'id'            => 'htsa_smtp_username_field',
                'title'         => esc_html__( 'SMTP Username', 'htsa' ),
                'callback'      => 'htsa_smtp_username_field',
                'setting_key'   => 'smtp_server_credentials',
                'section'       => 'smtp_settings',
            ),

            array(
                'id'            => 'htsa_smtp_password_field',
                'title'         => esc_html__( 'SMTP Password', 'htsa' ),
                'callback'      => 'htsa_smtp_password_field',
                'setting_key'   => 'smtp_server_credentials',
                'section'       => 'smtp_settings',
            ),

            array(
                'id'            => 'htsa_email_sender',
                'title'         => esc_html__( 'Default Sender Address', 'htsa' ),
                'callback'      => 'htsa_email_sender',
                'setting_key'   => 'smtp_receipents',
                'section'       => 'user_settings',
            ),

            array(
                'id'            => 'htsa_email_sender_name',
                'title'         => esc_html__( 'Default Sender Name', 'htsa' ),
                'callback'      => 'htsa_email_sender_name',
                'setting_key'   => 'smtp_receipents',
                'section'       => 'user_settings',
            ),

            array(
                'id'            => 'htsa_email_receiver',
                'title'         => esc_html__( 'Default Receiver Address', 'htsa' ),
                'callback'      => 'htsa_email_receiver',
                'setting_key'   => 'smtp_receipents',
                'section'       => 'user_settings',
            ),

        );
    }

    /**
     * Function that echos out any content at the top of the section (between heading and fields).
     *
     * @return void
     * @since 1.0.0
     */
    public function section_cb() : void
    {
        esc_html_e( 'This page contains settings for sending emails', 'htsa' );
    }

    /**
     * Function that fills the field with the desired form inputs. The function should echo its output.
     *
     * @param array $args   An array of arguements passed to add_settings_field()
     * @return void
     * @since 1.0.0
     */
    public function htsa_smtp_host_field( array $args ) : void
    {
        $this->load_view( 'settings.email-settings.input-field', $args, 'admin', false );
    }

    /**
     * Function that fills the field with the desired form inputs. The function should echo its output.
     *
     * @param array $args   An array of arguements passed to add_settings_field()
     * @return void
     * @since 1.0.0
     */
    public function htsa_smtp_username_field( array $args ) : void
    {
        $this->load_view( 'settings.email-settings.input-field', $args, 'admin', false );
    }

    /**
     * Function that fills the field with the desired form inputs. The function should echo its output.
     *
     * @param array $args   An array of arguements passed to add_settings_field()
     * @return void
     * @since 1.0.0
     */
    public function htsa_smtp_password_field( array $args ) : void
    {
        $this->load_view( 'settings.email-settings.input-field', $args, 'admin', false );
    }

    /**
     * Function that fills the field with the desired form inputs. The function should echo its output.
     *
     * @param array $args   An array of arguements passed to add_settings_field()
     * @return void
     * @since 1.0.0
     */
    public function htsa_email_sender( array $args ) : void
    {
        $this->load_view( 'settings.email-settings.input-field', $args, 'admin', false );
    }

    /**
     * Function that fills the field with the desired form inputs. The function should echo its output.
     *
     * @param array $args   An array of arguements passed to add_settings_field()
     * @return void
     * @since 1.0.0
     */
    public function htsa_email_sender_name( array $args ) : void
    {
        $this->load_view( 'settings.email-settings.input-field', $args, 'admin', false );
    }

    /**
     * Function that fills the field with the desired form inputs. The function should echo its output.
     *
     * @param array $args   An array of arguements passed to add_settings_field()
     * @return void
     * @since 1.0.0
     */
    public function htsa_email_receiver( array $args ) : void
    {
        $this->load_view( 'settings.email-settings.input-field', $args, 'admin', false );
    }
}