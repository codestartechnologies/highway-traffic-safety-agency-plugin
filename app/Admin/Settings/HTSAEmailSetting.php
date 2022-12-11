<?php
/**
 * HTSAEmailSetting class file.
 *
 * This file contains HTSAEmailSetting class that will register a custom setting.
 *
 * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link        https://codestar.com.ng
 * @since       1.0.0
 */

namespace WPS_Plugin\App\Admin\Settings;

use Codestartechnologies\WordpressPluginStarter\Abstracts\Settings;
use Codestartechnologies\WordpressPluginStarter\Traits\Logger;
use Codestartechnologies\WordpressPluginStarter\Traits\ViewLoader;

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'HTSAEmailSetting' ) ) {
    /**
     * Class HTSAEmailSetting
     *
     * This class registers a custom setting.
     *
     * @author Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class HTSAEmailSetting extends Settings {
        use ViewLoader, Logger;

        /**
         * Arguements needed to add the section for the settings.
         *
         * @return array
         */
        public function get_section() : array
        {
            return array(
                'id'            => 'htsa_email_settings',
                'title'         => esc_html__( 'Email Settings', 'htsa' ),
                'page'          => 'htsa-email-setting',
                'callback'      => null,
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
         */
        public function get_fields() : array
        {
            return array(

                array(
                    'id'            => 'htsa_smtp_host_field',
                    'title'         => esc_html__( 'SMTP Host', 'htsa' ),
                    'callback'      => 'htsa_smtp_host_field',
                    'setting_key'   => 'smtp_server_credentials',
                ),

                array(
                    'id'            => 'htsa_smtp_username_field',
                    'title'         => esc_html__( 'SMTP Username', 'htsa' ),
                    'callback'      => 'htsa_smtp_username_field',
                    'setting_key'   => 'smtp_server_credentials',
                ),

                array(
                    'id'            => 'htsa_smtp_password_field',
                    'title'         => esc_html__( 'SMTP Password', 'htsa' ),
                    'callback'      => 'htsa_smtp_password_field',
                    'setting_key'   => 'smtp_server_credentials',
                ),

                array(
                    'id'            => 'htsa_email_sender',
                    'title'         => esc_html__( 'Default Sender Address', 'htsa' ),
                    'callback'      => 'htsa_email_sender',
                    'setting_key'   => 'smtp_receipents',
                ),

                array(
                    'id'            => 'htsa_email_sender_name',
                    'title'         => esc_html__( 'Default Sender Name', 'htsa' ),
                    'callback'      => 'htsa_email_sender_name',
                    'setting_key'   => 'smtp_receipents',
                ),

                array(
                    'id'            => 'htsa_email_receiver',
                    'title'         => esc_html__( 'Default Receiver Address', 'htsa' ),
                    'callback'      => 'htsa_email_receiver',
                    'setting_key'   => 'smtp_receipents',
                ),

            );
        }

        /**
         * Function that echos out any content at the top of the section (between heading and fields).
         *
         * @return void
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
         */
        public function htsa_email_receiver( array $args ) : void
        {
            $this->load_view( 'settings.email-settings.input-field', $args, 'admin', false );
        }
    }
}