<?php
if ( !defined( 'ABSPATH' ) || ! defined( 'YITH_YWRAQ_VERSION' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Implements helper functions for YITH Woocommerce Request A Quote
 *
 * @package YITH Woocommerce Request A Quote
 * @since   1.0.0
 * @author  Yithemes
 */

if ( !function_exists( 'yith_ywraq_locate_template' ) ) {
    /**
     * Locate the templates and return the path of the file found
     *
     * @param string $path
     * @param array  $var
     *
     * @return void
     * @since 1.0.0
     */
    function yith_ywraq_locate_template( $path, $var = NULL ) {
        global $woocommerce;

        if ( function_exists( 'WC' ) ) {
            $woocommerce_base = WC()->template_path();
        }
        elseif ( defined( 'WC_TEMPLATE_PATH' ) ) {
            $woocommerce_base = WC_TEMPLATE_PATH;
        }
        else {
            $woocommerce_base = $woocommerce->plugin_path() . '/templates/';
        }

        $template_woocommerce_path = $woocommerce_base . $path;
        $template_path             = '/' . $path;
        $plugin_path               = YITH_YWRAQ_DIR . 'templates/' . $path;

        $located = locate_template( array(
            $template_woocommerce_path, // Search in <theme>/woocommerce/
            $template_path,             // Search in <theme>/
            $plugin_path                // Search in <plugin>/templates/
        ) );

        if ( !$located && file_exists( $plugin_path ) ) {
            return apply_filters( 'yith_ywraq_locate_template', $plugin_path, $path );
        }

        return apply_filters( 'yith_ywraq_locate_template', $located, $path );
    }
}

if ( !function_exists( 'yith_ywraq_get_produtc_meta' ) ) {
    function yith_ywraq_get_produtc_meta( $raq, $echo = true ) {
        /**
         * Return the product meta in a varion product
         *
         * @param array $raq
         * @param bool  $echo
         *
         * @return string
         * @since 1.0.0
         */
        $item_data = array();

        // Variation data
        if ( !empty( $raq['variation_id'] ) && is_array( $raq['variations'] ) ) {

            foreach ( $raq['variations'] as $name => $value ) {

                if ( '' === $value ) {
                    continue;
                }

                $taxonomy = wc_attribute_taxonomy_name( str_replace( 'attribute_pa_', '', urldecode( $name ) ) );

                // If this is a term slug, get the term's nice name
                if ( taxonomy_exists( $taxonomy ) ) {
                    $term = get_term_by( 'slug', $value, $taxonomy );
                    if ( !is_wp_error( $term ) && $term && $term->name ) {
                        $value = $term->name;
                    }
                    $label = wc_attribute_label( $taxonomy );

                }

                $item_data[] = array(
                    'key'   => $label,
                    'value' => $value
                );
            }
        }

        $out = "";
        // Output flat or in list format
        if ( sizeof( $item_data ) > 0 ) {
            foreach ( $item_data as $data ) {
                if ( $echo ) {
                    echo esc_html( $data['key'] ) . ': ' . wp_kses_post( $data['value'] ) . "\n";
                }
                else {
                    $out .= ' - ' . esc_html( $data['key'] ) . ': ' . wp_kses_post( $data['value'] ) . ' ';
                }
            }
        }

        return $out;

    }
}

/**
 * Get the count of notices added, either for all notices (default) or for one
 * particular notice type specified by $notice_type.
 *
 * @since 2.1
 * @param string $notice_type The name of the notice type - either error, success or notice. [optional]
 * @return int
 */
function yith_ywraq_notice_count( $notice_type = '' ) {
    $session = YITH_Request_Quote()->session_class;
    $notice_count = 0;
    $all_notices  = $session->get( 'yith_ywraq_notices', array() );

    if ( isset( $all_notices[$notice_type] ) ) {

        $notice_count = absint( sizeof( $all_notices[$notice_type] ) );

    } elseif ( empty( $notice_type ) ) {

        foreach ( $all_notices as $notices ) {
            $notice_count += absint( sizeof( $all_notices ) );
        }

    }

    return $notice_count;
}



/**
 * Add and store a notice
 *
 * @since 2.1
 * @param string $message The text to display in the notice.
 * @param string $notice_type The singular name of the notice type - either error, success or notice. [optional]
 */
function yith_ywraq_add_notice( $message, $notice_type = 'success' ) {

    $session = YITH_Request_Quote()->session_class;
    $notices = $session->get( 'yith_ywraq_notices', array() );

    // Backward compatibility
    if ( 'success' === $notice_type ) {
        $message = apply_filters( 'yith_ywraq_add_message', $message );
    }

    $notices[$notice_type][] = apply_filters( 'yith_ywraq_add_' . $notice_type, $message );

    $session->set( 'yith_ywraq_notices', $notices );

}


/**
 * Prints messages and errors which are stored in the session, then clears them.
 *
 * @since 2.1
 */
function yith_ywraq_print_notices() {

    $session = YITH_Request_Quote()->session_class;
    $all_notices  =$session->get( 'yith_ywraq_notices', array() );
    $notice_types = apply_filters( 'yith_ywraq_notice_types', array( 'error', 'success', 'notice' ) );

    foreach ( $notice_types as $notice_type ) {
        if ( yith_ywraq_notice_count( $notice_type ) > 0 ) {
            wc_get_template( "notices/{$notice_type}.php", array(
                'messages' => $all_notices[$notice_type]
            ) );
        }
    }

    yith_ywraq_clear_notices();
}

/**
 * Unset all notices
 *
 * @since 2.1
 */
function yith_ywraq_clear_notices() {
    $session = YITH_Request_Quote()->session_class;
    $session->set( 'yith_ywraq_notices', null );
}
