<?php
if (!defined( 'ABSPATH')) {
    exit;
}

// For woocommerce
function wpesd_WooCommerce_register_required_plugins() {
	$w_check_display = get_current_screen();
	if (isset( $w_check_display->parent_file) && 'plugins.php' === $w_check_display->parent_file && 'update' === $w_check_display->id) {
		return;
	}
	$bwd_w_plugin_plugin = 'woocommerce/woocommerce.php';
	if (wpesd_WooCommerce_addon_install()){
		if (!current_user_can('activate_plugins')){
			return;
		}
		$bwd_w_plugin_active_url = wp_nonce_url('plugins.php?action=activate&plugin=' . $bwd_w_plugin_plugin . '&plugin_status=all&paged=1&s', 'activate-plugin_' . $bwd_w_plugin_plugin );
		$bwd_w_plugin_the_notice_is = '<p><b>'.esc_html__('WProduct Estimated Shiping Date').'</b> '.esc_html__('requires WooCommerce to be activated.').'</p>';
		$bwd_w_plugin_the_notice_is .= '<p><a href="'. $bwd_w_plugin_active_url .'" class="button-primary">'.esc_html__('Activate WooCommerce').'</a></p>';
	} else{
		if (!current_user_can('install_plugins')){
			return;
		}
		$w_install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=woocommerce'), 'install-plugin_woocommerce');
		$bwd_w_plugin_the_notice_is = '<p><b>'.esc_html__('WProduct Estimated Shiping Date').'</b> '.esc_html__('requires WooCommerce to be installed and activated.').'</p>';
		$bwd_w_plugin_the_notice_is .= '<p><a href="'. $w_install_url .'" class="button-primary">'.esc_html__('Install WooCommerce').'</a></p>';
	}
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
		echo '<div class="notice notice-error is-dismissible"><p>' . $bwd_w_plugin_the_notice_is . '</p></div>';
	endif;
}

function wpesd_WooCommerce_addon_install(){
	$w_file_path = 'woocommerce/woocommerce.php';
	$w_installed_plugins = get_plugins();
	return isset($w_installed_plugins[$w_file_path]);
}
