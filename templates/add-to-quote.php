<?php
/**
 * Add to Quote button template
 *
 * @package YITH Woocommerce Request A Quote
 * @since   1.0.0
 * @author  Yithemess
 */
?>

<div class="yith-ywraq-add-to-quote add-to-quote-<?php echo $product_id ?>">
    <div class="yith-ywraq-add-button <?php echo ( $exists ) ? 'hide': 'show' ?>" style="display:<?php echo ( $exists ) ? 'none': 'block' ?>">
        <?php yit_plugin_get_template( YITH_YWRAQ_DIR, 'add-to-quote-' . $template_part . '.php', $args );  ?>
    </div>
    <?php if( $exists ): ?>
        <div class="yith_ywraq_add_item_response-<?php echo $product_id ?>"><?php _e( 'The product is already in quote request list!', 'ywraq' )?></div>
        <div class="yith_ywraq_add_item_browse-list-<?php echo $product_id ?>"><a href="<?php echo  $rqa_url ?>"><?php echo $label_browse ?></a></div>
    <?php endif ?>
</div>

<div class="clear"></div>
