<?php
/**
 * Request A Quote pages template; load template parts
 *
 * @package YITH Woocommerce Request A Quote
 * @since   1.0.0
 * @author  Yithemess
 */

global $wpdb, $woocommerce;


if( function_exists( 'wc_print_notices' ) ) {
    yith_ywraq_print_notices();
}
?>
	<div id="yith-ywraq-message"></div>

	<?php yit_plugin_get_template( YITH_YWRAQ_DIR, 'request-quote-' . $template_part . '.php', $args );  ?>

    <?php if( count($raq_content) != 0): ?>

        <?php yit_plugin_get_template( YITH_YWRAQ_DIR, 'request-quote-form.php', $args );  ?>

    <?php endif ?>
