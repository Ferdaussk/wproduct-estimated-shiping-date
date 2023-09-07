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
$wpesd_estimass_bgcolor_value = get_option( 'wpesd-estimass-bgcolor', '#ffb657' );
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
);
$products = get_posts($args);
$highest_custom_number_value = 0;
$highest_custom_number_product_id = 0;
if (!empty($products)) {
    foreach ($products as $product) {
        $product_id = $product->ID;
        $custom_number_value = get_post_meta($product_id, '_custom_number', true);

        if ($custom_number_value > $highest_custom_number_value) {
            $highest_custom_number_value = $custom_number_value;
            $highest_custom_number_product_id = $product_id;
        }
    }
}

if (function_exists('WC')) {// for all products id in checkout page
    $cart = WC()->cart;
    $items = $cart->get_cart();
    $product_ids = array();
    foreach ($items as $item) {
        $product_id = $item['product_id'];
        $product_ids[] = $product_id;
    }
}

$wpesd_email_check = get_option( 'wpesd-send-date-email', 'on' );
if($wpesd_email_check == true){
    if(in_array($highest_custom_number_product_id, $product_ids)){
        ?>
        <tr class="<?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'order_item', $item, $order)); ?>">
            <td class="td show_/_ estimass-style" style="background-color:<?php echo esc_attr($wpesd_estimass_bgcolor_value);?>;  border-radius: 3px; margin: 4px;  color:<?php echo get_option( 'wpesd-estimass-color', 'black');?>; padding: 10px;">
                <?php
                $wpesd_shipping_icon = '<img src="'.get_option('wpesd-shipping-icon', plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png').'" atr="Image" style="width: 40px;margin-right: 10px;">';
                $wpesd_shipping_checkIcon = (!empty(get_option('wpesd-shipping-icon',plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png')))?$wpesd_shipping_icon:'';	
                $etoday = new \DateTime();
                $etarget_date = $etoday->modify("+$highest_custom_number_value days")->format(get_option('wpesd-check-pagechack-taxo-widget', 'M j, Y'));
                echo '<div class="show_/_ estimass-style">'.$wpesd_shipping_checkIcon.esc_html(get_option('wpesd-product-shipted', 'This product will be shipped on ')).' <span class="estimdate-style" style="color:'.get_option( 'wpesd-estimdate-color', 'red' ).';font-size: 15px;">'.$etarget_date . '</span></div>';
                ?>
            </td>
        </tr>
    <?php
    }
}
?>
