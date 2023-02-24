<?php
/**
 * Mailer class file.
 *
 * This file contains Mailer class which is used to send SMTP emails using PHPMailer.
 *
 * @package    HighwayTrafficSecurityAgencyPlugin
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @link       https://github.com/codestartechnologies/highway-traffic-security-agency-plugin
 * @license    https://www.gnu.org/licenses/agpl-3.0.txt GNU/AGPLv3
 * @since      1.0.0
 */

namespace HTSA_Plugin\WPS_Plugin\App\HTSA;

use HTSA_Plugin\Codestartechnologies\WordpressPluginStarter\Traits\Logger;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Mailer' ) ) {
    /**
     * Class Mailer
     *
     * This class is used to send SMTP emails using PHPMailer.
     *
     * @package HighwayTrafficSecurityAgencyPlugin
     * @author  Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class Mailer {
        use Logger;

        /**
         * PHPMailer instance
         *
         * @var PHPMailer
         */
        private PHPMailer $mail;

        /**
         * Whether PHPMailer should throw external exceptions
         *
         * @var boolean
         */
        public bool $show_exceptions = false;

        /**
         * SMTP Debug mode
         *
         * @var string
         */
        public string $debug_mode = 'prod';

        /**
         * Enable SMTP debugging
         *
         * @var array
         */
        private array $debug;

        /**
         * Set the hostname of the mail server
         *
         * @var string
         */
        public string $host;

        /**
         * Whether to use SMTP authentication
         *
         * @var boolean
         */
        public bool $use_auth = true;

        /**
         * Username to use for SMTP authentication
         *
         * @var string
         */
        private string $username;

        /**
         * Password to use for SMTP authentication
         *
         * @var string
         */
        private string $password;

        /**
         * Encryption mechanism
         *
         * @var string
         */
        public string $encryption_mode = 'tls';

        /**
         * Set the encryption mechanism to use:
         *
         * @var array
         */
        private array $encryption;

        /**
         * Set the SMTP port number:
         *
         * @var array
         */
        private array $port;

        /**
         * Whether is an HTML Email
         *
         * @var boolean
         */
        public bool $is_html = true;

        /**
         * Set the subject line
         *
         * @var string
         */
        public string $subject;

        /**
         * Set the body
         *
         * @var string
         */
        public string $body;

        /**
         * Set the subject line
         *
         * @var string
         */
        public string $alt_body;

        public function __construct()
        {

            //SMTP::DEBUG_OFF = off (for production use)
            //SMTP::DEBUG_CLIENT = client messages
            //SMTP::DEBUG_SERVER = client and server messages
            $this->debug = array(
                'prod'                  => SMTP::DEBUG_OFF,
                'dev_client'            => SMTP::DEBUG_CLIENT,
                'dev_client_server'     => SMTP::DEBUG_SERVER,
            );

            // - SMTPS (implicit TLS on port 465) or
            // - STARTTLS (explicit TLS on port 587)
            $this->encryption = array(
                'ssl'       => PHPMailer::ENCRYPTION_SMTPS,
                'tls'       => PHPMailer::ENCRYPTION_STARTTLS,
                'mailtrap'  => PHPMailer::ENCRYPTION_STARTTLS,
            );

            // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
            // - 587 for SMTP+STARTTLS
            $this->port = array(
                'ssl'       => 465,
                'tls'       => 587,
                'mailtrap'  => 2525,
            );

            //Create a new PHPMailer instance
            $this->mail = new PHPMailer( $this->show_exceptions );

            $db_credentials = \get_option( 'htsa_smtp_server_credentials' );

            $this->host       = $db_credentials['htsa_smtp_host_field'] ?? '';
            $this->username   = $db_credentials['htsa_smtp_username_field'] ?? '';
            $this->password   = $db_credentials['htsa_smtp_password_field'] ?? '';

            // $this->from( 'support@wordpress.org', get_bloginfo( 'name' ) );
            // $this->to( 'sender@gmail.com' );
            // $this->header( 'X-SES-CONFIGURATION-SET', 'ConfigSet' );
        }

        /**
         * Set who the message is to be sent from
         *
         * @access public
         * @static
         * @param string $sender        The sender email address.
         * @param string $sender_name   The sender name. Default null
         * @return Mailer
         * @since 1.0.0
         */
        public function from( string $sender, string $sender_name = null ) : Mailer
        {
            //Set who the message is to be sent from
            $this->mail->setFrom( $sender, $sender_name );
            return $this;
        }

        /**
         * Set who the message is to be sent to
         *
         * @access public
         * @static
         * @param string $receiver_email  The receiver email address.
         * @param string $receiver_name   The receiver name. Default null
         * @return Mailer
         * @since 1.0.0
         */
        public function to( string $receiver_email, string $receiver_name = null ) : Mailer
        {
            //Set who the message is to be sent to
            //Add a recipient
            //Name is optional
            $this->mail->addAddress( $receiver_email, $receiver_name );
            return $this;
        }

        /**
         * Add a "Reply-To" address.
         *
         * @access public
         * @static
         * @param string $replyto_email     The reply to email address.
         * @param string $replyto_name      The reply to name. Default null
         * @return Mailer
         * @since 1.0.0
         */
        public function reply_to( string $replyto_email, $replyto_name = null ) : Mailer
        {
            //Set an alternative reply-to address
            $this->mail->addReplyTo( $replyto_email, $replyto_name );
            return $this;
        }

        /**
         * Add an attachment from a path on the filesystem.
         *
         * @access public
         * @static
         * @param string $path          Path to the attachment
         * @param string $name          Overrides the attachment name
         * @param string $encoding      File encoding. Default base64
         * @param string $type          MIME type, e.g. image/jpeg; determined automatically from $path if not specified
         * @param string $disposition   Disposition to use
         * @return Mailer
         * @since 1.0.0
         */
        public function attachment( string $path, $name = '', $encoding = PHPMailer::ENCODING_BASE64, $type = '', $disposition = 'attachment' ) : Mailer
        {
            //Attachments
            //Add attachments
            //Optional name
            $this->mail->addAttachment( $path, $name, $encoding, $type, $disposition );
            return $this;
        }

        /**
         * Add a "CC" address.
         *
         * @access public
         * @static
         * @param string $cc_email     The cc email address.
         * @param string $cc_name      Name. Default null
         * @return Mailer
         * @since 1.0.0
         */
        public function cc( string $cc_email, $cc_name = null ) : Mailer
        {
            $this->mail->addCC( $cc_email, $cc_name );
            return $this;
        }

        /**
         * Add a "BCC" address.
         *
         * @access public
         * @static
         * @param string $bcc_email     The bcc email address.
         * @param string $bcc_name      Name. Default null
         * @return Mailer
         * @since 1.0.0
         */
        public function bcc( string $bcc_email, $bcc_name = null ) : Mailer
        {
            $this->mail->addBCC( $bcc_email, $bcc_name );
            return $this;
        }

        /**
         * Add a custom header.
         *
         * @access public
         * @param string $name
         * @param string $value
         * @return Mailer
         */
        public function header( $name, $value = null ) : Mailer
        {
            $this->mail->addCustomHeader( $name, $value );
            return $this;
        }

        /**
         * Method for sending the email notification.
         *
         * @access public
         * @return bool                 Returns true if the email was sent or false if there was an error sending the email.
         * @since 1.0.0
         */
        public function send() : bool
        {
            try {
                //Server settings

                //Enable verbose debug output
                if ( array_key_exists( $this->debug_mode, $this->debug ) ) {
                    $this->mail->SMTPDebug = $this->debug[ $this->debug_mode ];
                }

                //Tell PHPMailer to use SMTP
                //Send using SMTP
                $this->mail->isSMTP();

                //Set the SMTP server to send through
                $this->mail->Host       = $this->host;

                //Enable SMTP authentication
                $this->mail->SMTPAuth   = $this->use_auth;

                //SMTP username
                $this->mail->Username   = $this->username;

                //SMTP password
                $this->mail->Password   = $this->password;

                //Enable implicit TLS encryption
                if ( array_key_exists( $this->encryption_mode, $this->encryption ) ) {
                    $this->mail->SMTPSecure = $this->encryption[ $this->encryption_mode ];
                }

                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                if ( array_key_exists( $this->encryption_mode, $this->port ) ) {
                    $this->mail->Port = $this->port[ $this->encryption_mode ];
                }

                //Recipients


                //Content

                //Set email format to HTML
                $this->mail->isHTML( $this->is_html );

                //Set the subject line
                $this->mail->Subject = $this->subject;

                //Set the message body
                $this->mail->Body    = $this->body;

                //Replace the plain text body with one created manually
                $this->mail->AltBody = $this->alt_body;

                //send the message
                if ( $this->mail->send() ) {
                    // reset mail settings
                    $this->mail->clearAddresses();
                    $this->mail->clearAllRecipients();
                    $this->mail->clearAttachments();
                    $this->mail->clearBCCs();
                    $this->mail->clearCCs();
                    $this->mail->clearCustomHeaders();
                    $this->mail->clearReplyTos();
                    return true;
                }

            } catch ( Exception $e ) {
                ob_start();
            }

            if ( $exception = ob_get_clean() ) {
                $this->log( __FILE__, $exception );
            }

            if ( ! empty( $this->mail->ErrorInfo ) ) {
                $this->log( __FILE__, "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}" );
            }

            return false;
        }
    }
}