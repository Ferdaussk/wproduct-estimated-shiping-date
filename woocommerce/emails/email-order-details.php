<?php
/**
 * Email Order Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * @package WooCommerce/Templates/Emails
 * @version 5.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div style="margin-bottom: 40px">
    <table style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif" width="100%">
        <thead>
            <tr>
                <th scope="col" style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; padding: 12px; text-align: left" align="left"><?php echo esc_html__('Product'); ?></th>
                <th scope="col" style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; padding: 12px; text-align: left" align="left"><?php echo esc_html__('Quantity'); ?></th>
                <th scope="col" style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; padding: 12px; text-align: left" align="left"><?php echo esc_html__('Per Price'); ?></th>
                <th scope="col" style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; padding: 12px; text-align: left" align="left"><?php echo esc_html__('Price'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($order->get_items() as $item_id => $item) :
                $product = $item->get_product();
                $product_name = $product->get_name();
                $quantity = $item->get_quantity();
                $product_price = wc_price($product->get_price());
                $line_total = wc_price($product->get_price() * $quantity); // Calculate the line total

                ?>
                <tr>
                    <td style="color: #636363; border: 1px solid #fbdc0e; padding: 12px; text-align: left; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap: break-word" align="left">
                        <?php echo esc_html__($product_name); ?>
                    </td>
                    <td style="color: #636363; border: 1px solid #fbdc0e; padding: 12px; text-align: left; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif" align="left">
                        <?php echo esc_html__($quantity); ?>
                    </td>
                    <td style="color: #636363; border: 1px solid #fbdc0e; padding: 12px; text-align: left; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif" align="left">
                        <?php echo __($product_price); ?>
                    </td>
                    <td style="color: #636363; border: 1px solid #fbdc0e; padding: 12px; text-align: left; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif" align="left">
                        <?php echo __($line_total); ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th scope="row" colspan="3" style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; padding: 12px; text-align: left; border-top-width: 4px" align="left"><?php echo esc_html__('Subtotal: '); ?></th>
                <td style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; padding: 12px; text-align: left; border-top-width: 4px" align="left">
                    <?php echo wc_price($order->get_subtotal()); ?>
                </td>
            </tr>
            <?php
            if ($order->get_shipping_total()) {
            ?>
                <tr>
                    <th scope="row" colspan="3" style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; padding: 12px; text-align: left" align="left"><?php echo esc_html__('Shipping: '); ?></th>
                    <td style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; padding: 12px; text-align: left" align="left">
                        <?php echo wc_price($order->get_shipping_total()); ?>
                    </td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <th scope="row" colspan="3" style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; padding: 12px; text-align: left;" align="left"><?php echo esc_html__('Payment Method: '); ?></th>
                <td style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; padding: 12px; text-align: left;" align="left">
                    <?php echo esc_html($order->get_payment_method_title()); ?>
                </td>
            </tr>
            <tr>
                <th scope="row" colspan="3" style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; padding: 12px; text-align: left" align="left"><?php echo esc_html__('Total: '); ?></th>
                <td style="color: #636363; border: 1px solid #fbdc0e; vertical-align: middle; padding: 12px; text-align: left" align="left">
                    <?php echo wc_price($order->get_total()); ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

    <?php

$wpesd_estimass_bgcolor_value = get_option( 'wpesd-estimass-bgcolor', '#ffb657' );
if (function_exists('WC')) {// for all products id in checkout page
    $cart = WC()->cart;
    $items = $cart->get_cart();
    $largest_custom_number = null;
    foreach ($items as $item) {
        $product_id = $item['product_id'];
        $custom_number_value = get_post_meta($product_id, '_custom_number', true);

        if ($custom_number_value !== '' && $custom_number_value > $largest_custom_number) {
            $largest_custom_number = $custom_number_value;
        }
    }
}

$wpesd_email_check = get_option( 'wpesd-send-date-email', 'on' );
if($wpesd_email_check == true){
    if($largest_custom_number !== null){
        ?>
        <tr class="<?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'order_item', $item, $order)); ?>">
            <td class="td show_/_ estimass-style" style="background-color:<?php echo esc_attr($wpesd_estimass_bgcolor_value);?>;  border-radius: 3px; margin: 4px;  color:<?php echo get_option( 'wpesd-estimass-color', 'black');?>; padding: 10px;">
                <?php
                $wpesd_shipping_icon = '<img src="'.get_option('wpesd-shipping-icon', plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png').'" atr="Image" style="width: 40px;margin-right: 10px;">';
                $wpesd_shipping_checkIcon = (!empty(get_option('wpesd-shipping-icon',plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png')))?$wpesd_shipping_icon:'';	
                $etoday = new \DateTime();
                $etarget_date = $etoday->modify("+$largest_custom_number days")->format(get_option('wpesd-check-pagechack-taxo-widget', 'M j, Y'));
                echo '<div class="show_/_ estimass-style">'.$wpesd_shipping_checkIcon.esc_html(get_option('wpesd-product-shipted', 'This product will be shipped on ')).' <span class="estimdate-style" style="color:'.get_option( 'wpesd-estimdate-color', 'red' ).';font-size: 15px;">'.esc_html__($etarget_date) . '</span></div>';
                ?>
            </td>
        </tr>
    <?php
    }
}
?>
