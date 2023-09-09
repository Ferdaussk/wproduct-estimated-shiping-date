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

// For product name
foreach ($order->get_items() as $item_id => $item) :
    $product = $item->get_product();
    $product_id = $product->get_id();
    $product_name = $product->get_name();
    $quantity = $item->get_quantity();
    
    // Output the product name and quantity
    ?>
    <div class="<?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'order_item', $item, $order)); ?>" style="display: flex; justify-content: space-between; align-items: center; border: 1px solid #e5e5e5; border-radius: 3px; margin: 4px; background-color: #b7b7b7; color: #000000; padding: 10px;">
        <div style="flex: 1; font-weight: bold;width: 50%;"><?php echo esc_html__('Name: '.$product_name); ?></div>
        <div style="flex: 1; text-align: left;width: 50%;"><?php echo esc_html__('Quantity: '.$quantity); ?></div>
    </div>
    <?php
endforeach;

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
                echo '<div class="show_/_ estimass-style">'.$wpesd_shipping_checkIcon.esc_html(get_option('wpesd-product-shipted', 'This product will be shipped on ')).' <span class="estimdate-style" style="color:'.get_option( 'wpesd-estimdate-color', 'red' ).';font-size: 15px;">'.$etarget_date . '</span></div>';
                ?>
            </td>
        </tr>
    <?php
    }
}
?>
