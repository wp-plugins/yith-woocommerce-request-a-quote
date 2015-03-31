<?php
if ( !defined( 'ABSPATH' ) || !defined( 'YITH_YWRAQ_VERSION' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Implements features of YITH Woocommerce Request A Quote
 *
 * @class   YITH_YWRAQ_Send_Email_Request_Quote
 * @package YITH Woocommerce Request A Quote
 * @since   1.0.0
 * @author  Yithemes
 */
if ( !class_exists( 'YITH_YWRAQ_Send_Email_Request_Quote' ) ) {

    /**
     * YITH_YWRAQ_Send_Email_Request_Quote
     *
     * @since 1.0.0
     */
    class YITH_YWRAQ_Send_Email_Request_Quote extends WC_Email {

        /**
         * Constructor method, used to return object of the class to WC
         *
         * @return \YITH_YWRAQ_Send_Email_Request_Quote
         * @since 1.0.0
         */
        public function __construct() {
            $this->id          = 'ywraq_email';
            $this->title       = __( 'Email to request a quote', 'ywraq' );
            $this->description = __( 'This email is sent when a user clicks on "Request a quote" button', 'ywraq' );

            $this->heading = __( 'Request a quote', 'ywraq' );
            $this->subject = __( '[Request a quote]', 'ywraq' );

            $this->template_html  = 'emails/request-quote.php';
            $this->template_plain = 'emails/plain/request-quote.php';

            // Triggers for this email
            add_action( 'send_raq_mail_notification', array( $this, 'trigger' ), 15, 1 );

            // Call parent constructor
            parent::__construct();

            // Other settings
            $this->recipient = $this->get_option( 'recipient' );

            if ( !$this->recipient ) {
                $this->recipient = get_option( 'admin_email' );
            }

            $this->enable_cc = $this->get_option( 'enable_cc' );
            $this->enable_cc = $this->enable_cc == 'yes';
        }

        /**
         * Method triggered to send email
         *
         * @param int $args
         *
         * @return void
         * @since  1.0
         * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
         */
        public function trigger( $args ) {
            $this->raq                = $args;
            $this->raq['raq_content'] = YITH_Request_Quote()->get_raq_return();

            $return = $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );

            if ( $return ) {
                YITH_Request_Quote()->clear_raq_list();
                yith_ywraq_add_notice( __('Your request has been sent successfully','ywraq'), 'success' );
            }else {
                yith_ywraq_add_notice( __( 'There was a problem in sending your request. Please try again.', 'ywraq' ), 'error' );
            }
        }

        /**
         * get_headers function.
         *
         * @access public
         * @return string
         */
        function get_headers() {
            $headers = "Reply-to: " . $this->raq['user_email'] . "\r\n";

            if ( $this->enable_cc ) {
                $headers .= "Cc: " . $this->raq['user_email'] . "\r\n";
            }

            $headers .= "Content-Type: " . $this->get_content_type() . "\r\n";

            return apply_filters( 'woocommerce_email_headers', $headers, $this->id, $this->object );
        }

        /**
         * Get HTML content for the mail
         *
         * @return string HTML content of the mail
         * @since  1.0
         * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
         */
        public function get_content_html() {
            ob_start();
            wc_get_template( $this->template_html, array(
                'raq_data'      => $this->raq,
                'email_heading' => $this->get_heading(),
                'sent_to_admin' => true,
                'plain_text'    => false
            ) );
            return ob_get_clean();
        }

        /**
         * Get plain text content of the mail
         *
         * @return string Plain text content of the mail
         * @since  1.0
         * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
         */
        public function get_content_plain() {
            ob_start();
            wc_get_template( $this->template_plain, array(
                'raq_data'      => $this->raq,
                'email_heading' => $this->get_heading(),
                'sent_to_admin' => true,
                'plain_text'    => false
            ) );
            return ob_get_clean();
        }

        /**
         * Init form fields to display in WC admin pages
         *
         * @return void
         * @since  1.0
         * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
         */
        public function init_form_fields() {
            $this->form_fields = array(
                'subject'    => array(
                    'title'       => __( 'Subject', 'woocommerce' ),
                    'type'        => 'text',
                    'description' => sprintf( __( 'This field lets you modify the email subject line. Leave it blank to use default subject: <code>%s</code>.', 'ywraq' ), $this->subject ),
                    'placeholder' => '',
                    'default'     => ''
                ),
                'recipient'  => array(
                    'title'       => __( 'Recipient(s)', 'ywraq' ),
                    'type'        => 'text',
                    'description' => sprintf( __( 'Enter recipients (comma separated) for this email. Defaults to <code>%s</code>', 'ywraq' ), esc_attr( get_option( 'admin_email' ) ) ),
                    'placeholder' => '',
                    'default'     => ''
                ),
                'enable_cc'  => array(
                    'title'       => __( 'Send CC copy', 'ywraq' ),
                    'type'        => 'checkbox',
                    'description' => __( 'Send a carbon copy to the user', 'ywraq' ),
                    'default'     => 'no'
                ),
                'heading'    => array(
                    'title'       => __( 'Email Heading', 'woocommerce' ),
                    'type'        => 'text',
                    'description' => sprintf( __( 'This field lets you modify the main heading contained within the email notification. Leave blank to use the default heading: <code>%s</code>.', 'ywraq' ), $this->heading ),
                    'placeholder' => '',
                    'default'     => ''
                ),
                'email_type' => array(
                    'title'       => __( 'Email type', 'woocommerce' ),
                    'type'        => 'select',
                    'description' => __( 'Choose format for the email to be sent.', 'woocommerce' ),
                    'default'     => 'html',
                    'class'       => 'email_type',
                    'options'     => array(
                        'plain'     => __( 'Plain text', 'woocommerce' ),
                        'html'      => __( 'HTML', 'woocommerce' ),
                        'multipart' => __( 'Multipart', 'woocommerce' ),
                    )
                )
            );
        }
    }
}


// returns instance of the mail on file include
return new YITH_YWRAQ_Send_Email_Request_Quote();