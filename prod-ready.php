<?php
namespace ProdWPESD;
if ( ! defined( 'ABSPATH' ) ) exit;
use ProdWPESD\PageSettings\Page_Settings;
define( "WPESD_ASFSK_ASSETS_PUBLIC_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/public" );
define( "WPESD_ASFSK_ASSETS_ADMIN_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/admin" );
class ClassProdWPESD {
	private static $_instance = null;
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function wpesd_all_assets_for_the_admin(){
        wp_enqueue_style( 'wpesd-order', plugin_dir_url( __FILE__ ) . 'assets/admin/order.css', null, '1.0', 'all' );
		if (isset($_GET['page']) && $_GET['page'] === 'get-wproduct-estimated-shiping-date') {
            wp_enqueue_script( 'wpesd-script', plugin_dir_url( __FILE__ ) . 'assets/admin/script.js', array('jquery'), '1.0', true );
            $all_css_js_file = array(
                'wpesd-style' => array('wpesd_path_define'=>WPESD_ASFSK_ASSETS_ADMIN_DIR_FILE . '/style.css'),
            );
            foreach($all_css_js_file as $handle => $fileinfo){
                wp_enqueue_style( $handle, $fileinfo['wpesd_path_define'], null, '1.0', 'all');
            }
        }
	}

	public function wpesd_all_assets_for_the_public(){
        $all_css_js_file = array(
            'wpesd-style' => array('wpesd_path_define'=>WPESD_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/style.css'),
        );
        foreach($all_css_js_file as $handle => $fileinfo){
            wp_enqueue_style( $handle, $fileinfo['wpesd_path_define'], null, '1.0', 'all');
        }
	}

	public function wpesd_admin_menu_test(){
		if(current_user_can('manage_options')){
			add_submenu_page(
				'woocommerce',
				'WProduct Estimated Shiping Date',
				'WProduct Estimated Shiping Date',
				'manage_options',
				'get-wproduct-estimated-shiping-date',
				array($this, 'wpesd_plugin_submenu_about_plugin_page'),
                12
			);
		}
    add_action('admin_init', array($this, 'wpesd_admin_controls'));
	}
    public function wpesd_admin_controls() {
        include 'dashboard/controls.php';
    }

	public function wpesd_plugin_submenu_about_plugin_page() {
        include 'dashboard/dashboard-style.php';
    }
    
    public function wpesd_plugin_function_for_datas_callback() {}

    public function wpesd_plugin_settings_to_whitelist( $options ) {
      $options['wpesd-plugin-settings'] = array(
        'wpesd-notice-position',
        'wpesd-product-shipted',
        'wpesd-product-shipted',
        'wpesd-shipping-icon',
        'wpesd-shipimgsize-check',
        'wpesd-check-pagechack-taxo-widget',
        'wpesd-checkout-page-check',
        'wpesd-thankyou-page-check',
        'wpesd-orderdate-thankyou-page-check',
        'wpesd-send-date-email',
        // *** reason
        'wpesd-reason-color',
        'wpesd-reason-fontsize',
        'wpesd-reason-fontweight',
        'wpesd-reason-fontfamilly',
        // *** estimdate
        'wpesd-estimdate-color',
        'wpesd-estimdate-fontsize',
        'wpesd-estimdate-fontweight',
        'wpesd-estimdate-fontfamilly',
        // *** estimass
        'wpesd-estimass-color',
        'wpesd-estimass-fontsize',
        'wpesd-estimass-fontweight',
        'wpesd-estimass-fontfamilly',
      );
      return $options;
    }

    public function wpesd_taxoes_styles(){
        // *** reason
        $wpesd_reason_color_value = get_option( 'wpesd-reason-color', 'black' );
        $wpesd_reason_bgcolor_value = get_option( 'wpesd-reason-bgcolor', '#ffe300' );
        $wpesd_reason_fontsize_value = get_option( 'wpesd-reason-fontsize', '20px');
        $wpesd_reason_fontweight_value = get_option( 'wpesd-reason-fontweight');
        $wpesd_reason_fontfamilly_value = get_option( 'wpesd-reason-fontfamilly', 'roboto' );
        // *** estimdate
        $wpesd_estimdate_color_value = get_option( 'wpesd-estimdate-color', 'red' );
        $wpesd_estimdate_fontsize_value = get_option( 'wpesd-estimdate-fontsize', '20px');
        $wpesd_estimdate_fontweight_value = get_option( 'wpesd-estimdate-fontweight');
        $wpesd_estimdate_fontfamilly_value = get_option( 'wpesd-estimdate-fontfamilly', 'roboto' );
        // *** estimass
        $wpesd_estimass_color_value = get_option( 'wpesd-estimass-color', 'black' );
        $wpesd_estimass_bgcolor_value = get_option( 'wpesd-estimass-bgcolor', '#ffe300' );
        $wpesd_estimass_fontsize_value = get_option( 'wpesd-estimass-fontsize', '20px');
        $wpesd_estimass_fontweight_value = get_option( 'wpesd-estimass-fontweight');
        $wpesd_estimass_fontfamilly_value = get_option( 'wpesd-estimass-fontfamilly', 'roboto' );
        $wpesd_shipimgsize_value = get_option( 'wpesd-shipimgsize-check', '40px');
        $html = "<style>
        .show_reason_notice{
            color:{$wpesd_reason_color_value};
            font-size:{$wpesd_reason_fontsize_value};
            font-weight:{$wpesd_reason_fontweight_value};
            font-family:{$wpesd_reason_fontfamilly_value};
        }
        .estimdate-style{
            color:{$wpesd_estimdate_color_value};
            font-size:{$wpesd_estimdate_fontsize_value};
            font-weight:{$wpesd_estimdate_fontweight_value};
            font-family:{$wpesd_estimdate_fontfamilly_value};
        }
        .estimass-style{
            color:{$wpesd_estimass_color_value};
            font-size:{$wpesd_estimass_fontsize_value};
            font-weight:{$wpesd_estimass_fontweight_value};
            font-family:{$wpesd_estimass_fontfamilly_value};
        }
        .show_plus_day_date img, .estimass-style img{
            width:{$wpesd_shipimgsize_value};
        }
        .show_plus_day_date.estimass-style, .estimass-style, .show_reason_notice{
            background-color:{$wpesd_estimass_bgcolor_value};
        }
        ";
        $html .= '</style>';
        echo $html;
    }

    public function wpesd_settings_plugin_action_link($links, $file) {
        if (plugin_basename(__FILE__) == $file) {
            $wpesd_settings_link = '<a href="' . admin_url('admin.php?page=get-wproduct-estimated-shiping-date') . '" target="_blank">' . esc_html__('Settings', 'text-domain') . '</a>';
            array_push($links, $wpesd_settings_link);
        }
        return $links;
    }

    public function wpesd_product_data_tabs($tabs){
        $tabs['custom_tab'] = array(
            'label'    => __('Product estimated date', 'wproduct-estimated-shiping-date'),
            'target'   => 'wpesd_product_estimated_date_tab',
            'priority' => 100,
        );
        return $tabs;
    }

    public function wpesd_general_product_datas(){
        global $post;
        echo '<div id="wpesd_product_estimated_date_tab" class="panel woocommerce_options_panel">';
            echo '<div class="options_group">';
            // Checkbox Input
            woocommerce_wp_checkbox(
                array(
                    'id'            => '_custom_checkbox',
                    'label'         => __('Estimated date', 'wproduct-estimated-shiping-date'),
                    'description'   => __('Show estimated date for this product.', 'wproduct-estimated-shiping-date'),
                    'desc_tip'      => true,
                )
            );
            // Number Input
            woocommerce_wp_text_input(
                array(
                    'id'            => '_custom_number',
                    'label'         => __('Day number', 'wproduct-estimated-shiping-date'),
                    'placeholder'   => __('Enter estimated day', 'wproduct-estimated-shiping-date'),
                    'desc_tip'      => true,
                    'type'          => 'number',
                    'custom_attributes' => array(
                        'step' => '1',  // Allow only whole numbers
                    ),
                )
            );
            // Reason notice Input
            woocommerce_wp_text_input(
                array(
                    'id'            => '_custom_notice',
                    'label'         => __('Reason notice', 'wproduct-estimated-shiping-date'),
                    'placeholder'   => __('Enter reason. If don\'t have empty this.', 'wproduct-estimated-shiping-date'),
                    'desc_tip'      => true,
                    'type'          => 'text',
                    'custom_attributes' => array(
                        'step' => '1',  // Allow only whole numbers
                    ),
                )
            );
            echo '</div>';
        echo '</div>';
    }

    public function wpesd_save_general_product_datas($product_id) {
        $checkbox_value = isset($_POST['_custom_checkbox']) ? 'yes' : 'no';
        update_post_meta($product_id, '_custom_checkbox', $checkbox_value);
      
        $number_value = isset($_POST['_custom_number']) ? sanitize_text_field($_POST['_custom_number']) : '';
        update_post_meta($product_id, '_custom_number', $number_value);
      
        $notice_value = isset($_POST['_custom_notice']) ? sanitize_text_field($_POST['_custom_notice']) : '';
        update_post_meta($product_id, '_custom_notice', $notice_value);
    }

    public function wpesd_shop_page($cart_item){
        $wpesd_each_id = get_the_id();
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
        );
        $products = get_posts($args);
        if (!empty($products)) {
            foreach ($products as $product) {
                $product_id = $product->ID;
                $custom_checkbox_value = get_post_meta($product_id, '_custom_checkbox', true);
                $custom_number_value = get_post_meta($product_id, '_custom_number', true);
                $custom_notice_value = get_post_meta($product_id, '_custom_notice', true);
                $Estimated_message_text = get_option('wpesd-product-shipted', 'This product will be shipped on ');
                if ($custom_checkbox_value === 'yes') {
                echo '<div class="show_/_">';
                    if ($custom_number_value !== '') {
                        $today = new \DateTime();
                        $target_date = $today->modify("+$custom_number_value days")->format(get_option('wpesd-check-pagechack-taxo-widget', 'M j, Y'));
                        if($product_id == $wpesd_each_id){
                            $wpesd_shipping_icon = '<img src="'.get_option('wpesd-shipping-icon', plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png').'" atr="Image">';
                            $wpesd_shipping_checkIcon = (!empty(get_option('wpesd-shipping-icon',plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png')))?$wpesd_shipping_icon:'';
                            $wpesd_shipping_checkIcon = (!empty(get_option('wpesd-shipping-icon',plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png')))?$wpesd_shipping_icon:'';
                            if(get_option('wpesd-notice-position') == 'bottom'){ 
                            echo '<div class="show_plus_day_date estimass-style">' .$wpesd_shipping_checkIcon.esc_html__($Estimated_message_text).'<span class="estimdate-style"> '.esc_html__($target_date).'</span></div>';
                            echo (!empty($custom_notice_value))?'<div class="show_reason_notice">'.esc_html__($custom_notice_value).'</div>':'';
                            }else{
                                echo (!empty($custom_notice_value))?'<div class="show_reason_notice">' . esc_html__($custom_notice_value) . '</div>':'';
                                echo '<div class="show_plus_day_date estimass-style">' .$wpesd_shipping_checkIcon.esc_html__($Estimated_message_text).' <span class="estimdate-style">'.esc_html__($target_date) . '</span></div>';
                            }
                        }
                    }
                echo '</div>';
                }
            }
        }
    }

    public function wpesd_archive_page($cart_item){
        $wpesd_each_id = get_the_id();
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
        );
        $products = get_posts($args);
        if (!empty($products)) {
            foreach ($products as $product) {
                $product_id = $product->ID;
                $custom_checkbox_value = get_post_meta($product_id, '_custom_checkbox', true);
                $custom_number_value = get_post_meta($product_id, '_custom_number', true);
                $custom_notice_value = get_post_meta($product_id, '_custom_notice', true);
                $Estimated_message_text = get_option('wpesd-product-shipted', 'This product will be shipped on ');
                if ($custom_checkbox_value === 'yes') {
                echo '<div class="show_/_">';
                    if ($custom_number_value !== '') {
                        $today = new \DateTime();
                        $target_date = $today->modify("+$custom_number_value days")->format(get_option('wpesd-check-pagechack-taxo-widget', 'M j, Y'));
                        if($product_id == $wpesd_each_id){
                            $wpesd_shipping_icon = '<img src="'.get_option('wpesd-shipping-icon', plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png').'" atr="Image">';
                            $wpesd_shipping_checkIcon = (!empty(get_option('wpesd-shipping-icon',plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png')))?$wpesd_shipping_icon:'';
                            if(get_option('wpesd-notice-position') == 'bottom'){ 
                            echo '<div class="show_plus_day_date estimass-style">' .$wpesd_shipping_checkIcon.esc_html__($Estimated_message_text).'<span class="estimdate-style"> '.esc_html__($target_date).'</span></div>';
                            echo (!empty($custom_notice_value))?'<div class="show_reason_notice">'.esc_html__($custom_notice_value).'</div>':'';
                            }else{
                                echo (!empty($custom_notice_value))?'<div class="show_reason_notice">' . esc_html__($custom_notice_value) . '</div>':'';
                                echo '<div class="show_plus_day_date estimass-style">' .$wpesd_shipping_checkIcon.esc_html__($Estimated_message_text).' <span class="estimdate-style">'.esc_html__($target_date) . '</span></div>';
                            }
                        }
                    }
                echo '</div>';
                }
            }
        }
    }

    public function wpesd_cart_page($cart_item){
        $wpesd_each_id = $cart_item['product_id'];
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
        );
        $products = get_posts($args);
        if (!empty($products)) {
            foreach ($products as $product) {
                $product_id = $product->ID;
                $custom_checkbox_value = get_post_meta($product_id, '_custom_checkbox', true);
                $custom_number_value = get_post_meta($product_id, '_custom_number', true);
                $custom_notice_value = get_post_meta($product_id, '_custom_notice', true);
                $Estimated_message_text = get_option('wpesd-product-shipted', 'This product will be shipped on ');
                if ($custom_checkbox_value === 'yes') {
                echo '<div class="show_/_">';
                    if ($custom_number_value !== '') {
                        $today = new \DateTime();
                        $target_date = $today->modify("+$custom_number_value days")->format(get_option('wpesd-check-pagechack-taxo-widget', 'M j, Y'));
                        if($product_id == $wpesd_each_id){
                            $wpesd_shipping_icon = '<img src="'.get_option('wpesd-shipping-icon', plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png').'" atr="Image">';
                            $wpesd_shipping_checkIcon = (!empty(get_option('wpesd-shipping-icon',plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png')))?$wpesd_shipping_icon:'';
                            if(get_option('wpesd-notice-position') == 'bottom'){ 
                            echo '<div class="show_plus_day_date estimass-style">' .$wpesd_shipping_checkIcon.esc_html__($Estimated_message_text).'<span class="estimdate-style"> '.esc_html__($target_date).'</span></div>';
                            echo (!empty($custom_notice_value))?'<div class="show_reason_notice">'.esc_html__($custom_notice_value).'</div>':'';
                            }else{
                                echo (!empty($custom_notice_value))?'<div class="show_reason_notice">' . esc_html__($custom_notice_value) . '</div>':'';
                                echo '<div class="show_plus_day_date estimass-style">' .$wpesd_shipping_checkIcon.esc_html__($Estimated_message_text).' <span class="estimdate-style">'.esc_html__($target_date) . '</span></div>';
                            }
                        }
                    }
                echo '</div>';
                }
            }
        }
    }

    public function wpesd_thankyou_page($order_id) {
        $order = wc_get_order($order_id);
        $items = $order->get_items();
        $largest_custom_number = null; // Initialize variable to store the largest custom number
    
        foreach ($items as $item) {
            $product_id = $item->get_product_id();
            $custom_number_value = get_post_meta($product_id, '_custom_number', true);
    
            if ($custom_number_value !== '' && $custom_number_value > $largest_custom_number) {
                $largest_custom_number = $custom_number_value;
            }
        }
    
        $wpesd_shipping_icon = '<img src="'.get_option('wpesd-shipping-icon', plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png').'" alt="Image">';
        $wpesd_shipping_checkIcon = (!empty(get_option('wpesd-shipping-icon',plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png')))?$wpesd_shipping_icon:'';
    
        if ($largest_custom_number !== null) {
            $etoday = new \DateTime();
            $etarget_date = $etoday->modify("+$largest_custom_number days")->format(get_option('wpesd-check-pagechack-taxo-widget', 'M j, Y'));
            echo '<div class="show_/_ estimass-style">'.$wpesd_shipping_checkIcon.esc_html(get_option('wpesd-product-shipted', 'This product will be shipped on ')).' <span class="estimdate-style">'.esc_html__($etarget_date) . '</span></div>';
        } else {
            echo '';
        }

        
    }

    public function wpesd_checkout_page() {
        if (function_exists('WC')) {
            $cart = WC()->cart;
            $items = $cart->get_cart();
            $largest_custom_number = null; // Initialize variable to store the largest custom number
        
            foreach ($items as $item) {
                $product_id = $item['product_id'];
                $custom_number_value = get_post_meta($product_id, '_custom_number', true);
        
                if ($custom_number_value !== '' && $custom_number_value > $largest_custom_number) {
                    $largest_custom_number = $custom_number_value;
                }
            }
        }
        $wpesd_checkout_page_check = get_option( 'wpesd-checkout-page-check', 'off' );
        if($wpesd_checkout_page_check == true){
            $wpesd_shipping_icon = '<img src="'.get_option('wpesd-shipping-icon', plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png').'" atr="Image">';
            $wpesd_shipping_checkIcon = (!empty(get_option('wpesd-shipping-icon',plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png')))?$wpesd_shipping_icon:'';
            if (is_checkout() && !isset($_GET['order-received'])) {
                if ($largest_custom_number !== null) {
                    $etoday = new \DateTime();
                    $etarget_date = $etoday->modify("+$largest_custom_number days")->format(get_option('wpesd-check-pagechack-taxo-widget', 'M j, Y'));
                    echo '<div class="show_/_ estimass-style">'.$wpesd_shipping_checkIcon.esc_html(get_option('wpesd-product-shipted', 'This product will be shipped on ')).' <span class="estimdate-style">'.esc_html__($etarget_date) . '</span></div>';
                }else{echo '';}
            }
        }
    }

    public function add_custom_content_to_order_number_column($columns) {
        $columns['order_number'] = __('Order Number', 'wproduct-estimated-shiping-date');
        return $columns;
    }
    
    public function display_custom_content_in_order_number_column($column, $post_id) {
        if ($column === 'order_number') {
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => -1,
            );
            $products = get_posts($args);
            
            $highest_custom_number_value = 0;
            
            if (!empty($products)) {
                foreach ($products as $product) {
                    $product_id = $product->ID;
                    $custom_number_value = get_post_meta($product_id, '_custom_number', true);
            
                    if ($custom_number_value > $highest_custom_number_value) {
                        $highest_custom_number_value = $custom_number_value;
                    }
                }
            }
            $order = wc_get_order($post_id);
            if ($order && $order->get_date_created()) {
                $order_date = $order->get_date_created();
                $new_date = clone $order_date;
                $new_date->modify("+$highest_custom_number_value days");
                echo '<div class="show_/_ wpesd_order_shi_datadm">'.esc_html__('This order will be shipped on ') . $new_date->format(get_option('wpesd-check-pagechack-taxo-widget', 'M j, Y')) . '</div>';
            } 
        }
    }

    // This for the all products page VVVVV
    public function add_custom_content_to_product_name_column($columns) {
        $columns['name'] = __('Product Name', 'wproduct-estimated-shiping-date');
        return $columns;
    }

    public function display_custom_content_in_product_name_column($column, $post_id) {
        if ($column === 'name') {
            $wpesd_each_id = get_the_id();
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => -1,
            );
            $products = get_posts($args);
            if (!empty($products)) {
                foreach ($products as $product) {
                    $product_id = $product->ID;
                    $custom_checkbox_value = get_post_meta($product_id, '_custom_checkbox', true);
                    $custom_number_value = get_post_meta($product_id, '_custom_number', true);
                    $Estimated_message_text = get_option('wpesd-product-shipted', 'This product will be shipped on ');
                    if ($custom_checkbox_value === 'yes') {
                    echo '<div class="wpesd_order_shi_datadm">';
                        if ($custom_number_value !== '') {
                            $today = new \DateTime();
                            $target_date = $today->modify("+$custom_number_value days")->format(get_option('wpesd-check-pagechack-taxo-widget', 'M j, Y'));
                            if($product_id == $wpesd_each_id){
                                echo esc_html__($Estimated_message_text.' '.$target_date);
                            }
                        }
                    echo '</div>';
                    }
                }
            }
        }
    }

    // For email sender
    public function custom_email_templates($template, $template_name, $template_path) {
        if ($template_name == 'emails/email-order-details.php') {
            $template = plugin_dir_path(__FILE__) . 'woocommerce/emails/email-order-details.php';
        }
    
        return $template;
    }

    public function include_order_notes_in_email($order_meta, $order, $is_customer_email) {
        // Include order notes in customer email but not in admin email
        if ($is_customer_email) {
            $order_notes = wc_get_order_notes(array(
                'order_id' => $order->get_id(),
            ));
    
            foreach ($order_notes as $order_note) {
                $order_meta .= $order_note->content . "\n";
            }
        }
    
        return $order_meta;
    }

	public function __construct() {
        // Last Date 
        add_action('woocommerce_thankyou', [$this, 'wpesd_thankyou_page']); // Thank you page
        add_action('woocommerce_review_order_before_payment', [$this, 'wpesd_checkout_page']); // for Your order page
        // Show date
        add_action('woocommerce_after_cart_item_name', [$this, 'wpesd_cart_page']); // For cart page
        add_action('woocommerce_shop_loop_item_title', [$this, 'wpesd_archive_page']); // For shop page
        add_action('woocommerce_before_add_to_cart_button', [$this, 'wpesd_shop_page']); // For product single page
        // For product edit page
        add_filter('woocommerce_product_data_tabs', [$this, 'wpesd_product_data_tabs']);
        add_action('woocommerce_product_data_panels', [$this,'wpesd_general_product_datas']);
        add_action('woocommerce_process_product_meta', [$this,'wpesd_save_general_product_datas']);
        // It's for the admin order page
		add_filter('manage_edit-shop_order_columns', [$this,'add_custom_content_to_order_number_column']);
        add_action('manage_shop_order_posts_custom_column', [$this,'display_custom_content_in_order_number_column'], 10, 2);
        // It's for the admin all products page
        add_filter('manage_product_posts_columns', [$this,'add_custom_content_to_product_name_column']);
        add_action('manage_product_posts_custom_column', [$this,'display_custom_content_in_product_name_column'], 10, 2);
        // Plugins
		add_filter( 'plugin_action_links', [$this,'wpesd_settings_plugin_action_link'], 10, 2 );
		add_filter( 'whitelist_options', [$this,'wpesd_plugin_settings_to_whitelist'] );
        add_action('admin_enqueue_scripts', [$this, 'wpesd_all_assets_for_the_admin']);
        add_action('wp_enqueue_scripts', [$this, 'wpesd_all_assets_for_the_public']);
		add_action('admin_menu', [$this,'wpesd_admin_menu_test']);
        add_action('wp_head', [$this, 'wpesd_taxoes_styles'],99);
        // Email
        add_filter('woocommerce_locate_template', [$this, 'custom_email_templates'],10,3);
        add_filter('woocommerce_email_order_meta', [$this, 'include_order_notes_in_email'],10,3);
	}
}
ClassProdWPESD::instance();

