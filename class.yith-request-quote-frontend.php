<?php
if ( !defined( 'ABSPATH' ) || !defined( 'YITH_YWRAQ_VERSION' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Implements features of FREE version of YITH Woocommerce Request A Quote
 *
 * @class   YITH_YWRAQ_Frontend
 * @package YITH Woocommerce Request A Quote
 * @since   1.0.0
 * @author  Yithemes
 */
if ( !class_exists( 'YITH_YWRAQ_Frontend' ) ) {

    class YITH_YWRAQ_Frontend {

        /**
         * Single instance of the class
         *
         * @var \YWRAQ
         */

        protected static $instance;

        public $action_add = 'yith_ywraq_add_item';

        protected $error = array();

        /**
         * Returns single instance of the class
         *
         * @return \YITH_YWRAQ_Frontend
         * @since 1.0.0
         */

        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Constructor
         *
         * Initialize plugin and registers actions and filters to be used
         *
         * @since  1.0
         * @author Emanuela Castorina
         */

        public function __construct() {

            //start the session
            if ( !session_id() ) {
                session_start();
            }

            add_action( 'init', array( $this, 'update_raq_list' ) );

            //show button in single page
            add_action( 'woocommerce_single_product_summary', array( $this, 'add_button_single_page' ), 35 );


            //custom styles and javascripts
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_scripts' ) );

            add_action( 'woocommerce_single_product_summary', array( $this, 'hide_add_to_cart_single' ), 10 );
            add_action( 'woocommerce_after_shop_loop_item', array( $this, 'hide_add_to_cart_single' ), 5 );

            $shortcodes = new YITH_YWRAQ_Shortcodes();

        }

        /**
         * Hide add to cart in single page
         *
         * Hide the button add to cart in the single product page
         *
         * @since  1.0
         * @author Emanuela Castorina
         */
        public function hide_add_to_cart_single() {

            if ( get_option( 'ywraq_hide_add_to_cart' ) == 'yes' ) {

                $priority = has_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart' );
                if ( $priority ) {
                    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', $priority );
                }

                $priority = has_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );

                if ( $priority ) {
                    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', $priority );
                }
            }
        }


        /**
         * Enqueue Scripts and Styles
         *
         * @return void
         * @since  1.0.0
         * @author Emanuela Castorina
         */
        public function enqueue_styles_scripts() {

            $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
            wp_register_script( 'yith_ywraq_frontend', YITH_YWRAQ_ASSETS_URL . '/js/frontend' . $suffix . '.js', array( 'jquery' ), '1.0', true );

            $localize_script_args = array(
                'ajaxurl'            => admin_url( 'admin-ajax.php' ),
                'no_product_in_list' => __( 'Your list is empty', 'ywraq' )
            );
            wp_localize_script( 'yith_ywraq_frontend', 'ywraq_frontend', $localize_script_args );

            wp_enqueue_style( 'yith_ywraq_frontend', YITH_YWRAQ_ASSETS_URL . '/css/frontend.css' );
            wp_enqueue_script( 'yith_ywraq_frontend' );
        }

        /**
         * Check if the button can be showed in single page
         *
         * @return void
         * @since  1.0.0
         * @author Emanuela Castorina
         */
        public function add_button_single_page() {

            $show_button = apply_filters('yith_ywraq-show_btn_single_page', 'yes' );
            if( $show_button != 'yes' ){
                return false;
            }

            $this->print_button();
        }

        /**
         * Print the button "Add to Quote"
         *
         * @return void
         * @since  1.0.0
         * @author Emanuela Castorina
         */
        public function print_button(){
            global $product;

            $style_button = ( get_option( 'ywraq_show_btn_link' ) == 'button' ) ? 'button' : '';

            $args         = array(
                'class'         => 'add-request-quote-button ' . $style_button,
                'wpnonce'       => wp_create_nonce( 'add-request-quote-' . $product->id ),
                'product_id'    => $product->id,
                'label'         => get_option('ywraq_show_btn_link_text'),
                'label_browse'  => __( 'Browse the list', 'ywraq' ),
                'template_part' => 'button',
                'rqa_url'       => YITH_Request_Quote()->get_raq_page_url(),
                'exists'        => ( $product->product_type == 'variable' ) ? false : YITH_Request_Quote()->exists( $product->id )
            );
            $args['args'] = $args;

            yit_plugin_get_template( YITH_YWRAQ_DIR, 'add-to-quote.php', $args );
        }

        /**
         * Update the Request Quote List
         *
         * @return void
         * @since  1.0.0
         * @author Emanuela Castorina
         */
        public function update_raq_list() {
            if ( isset( $_POST['update_raq_wpnonce'] ) && isset( $_POST['raq'] ) && wp_verify_nonce( $_POST['update_raq_wpnonce'], 'update-request-quote-quantity' ) ) {
                foreach ( $_POST['raq'] as $key => $value ) {
                    if ( $value['qty'] != 0 ) {
                        YITH_Request_Quote()->update_item( $key, 'quantity', $value['qty'] );
                    }
                    else {
                        YITH_Request_Quote()->remove_item( $key );
                    }
                }
            }
        }

    }

    /**
     * Unique access to instance of YITH_YWRAQ_Frontend class
     *
     * @return \YITH_YWRAQ_Frontend
     */
    function YITH_YWRAQ_Frontend() {
        return YITH_YWRAQ_Frontend::get_instance();
    }
}