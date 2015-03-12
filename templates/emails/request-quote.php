<?php
/**
 * HTML Template Email
 *
 * @package YITH Woocommerce Request A Quote
 * @since   1.0.0
 * @author  Yithemess
 */
?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php printf( __( 'You received a quote request from %s. The request is the following:', 'ywraq' ), $raq_data['user_name'] ); ?></p>

<?php do_action( 'yith_ywraq_email_before_raq_table', $raq_data ); ?>

<h2><?php _e('Request Quote', 'ywraq') ?></h2>

<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
    <thead>
    <tr>
        <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Product', 'ywraq' ); ?></th>
        <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Quantity', 'ywraq' ); ?></th>
        <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Subtotal', 'ywraq' ); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if( ! empty( $raq_data['raq_content'] ) ):
        foreach( $raq_data['raq_content'] as $item ):
            $_product = wc_get_product( $item['product_id'] );
            ?>
            <tr>
                <td scope="col" style="text-align:left;"><a href="<?php echo get_edit_post_link( $_product->id )?>"><?php echo $_product->post->post_title ?></a>
                 <?php  if( isset($item['variations'])): ?><small><?php echo yith_ywraq_get_produtc_meta($item); ?></small><?php endif ?></td>
                <td scope="col" style="text-align:left;"><?php echo $item['quantity'] ?></td>
                <td scope="col" style="text-align:left;"><?php  echo WC()->cart->get_product_subtotal( $_product, $item['quantity'] ); ?></td>
            </tr>
        <?php
        endforeach;
    endif;
    ?>
    </tbody>
</table>

<?php do_action( 'yith_ywraq_email_after_raq_table', $raq_data ); ?>
<?php if( ! empty( $raq_data['user_message']) ): ?>
<h2><?php _e( 'Customer message', 'ywraq' ); ?></h2>
    <p><?php echo $raq_data['user_message'] ?></p>
<?php endif ?>
<h2><?php _e( 'Customer details', 'ywraq' ); ?></h2>

<p><strong><?php _e( 'Name:', 'ywraq' ); ?></strong> <?php echo $raq_data['user_name'] ?></p>
<p><strong><?php _e( 'Email:', 'ywraq' ); ?></strong> <a href="mailto:<?php echo $raq_data['user_email']; ?>"><?php echo $raq_data['user_email']; ?></a></p>

<?php do_action( 'woocommerce_email_footer' ); ?>