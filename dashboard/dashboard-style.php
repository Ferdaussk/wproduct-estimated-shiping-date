<?php
if ( ! defined( 'ABSPATH' ) ) exit;
// Taxos label check
$wpesd_checkout_page_check = get_option( 'wpesd-checkout-page-check', 'on' );
$wpesd_thankyou_page_check = get_option( 'wpesd-thankyou-page-check', 'on' );
$wpesd_orderdate_thankyou_page_check = get_option( 'wpesd-orderdate-thankyou-page-check', 'off' );
$wpesd_send_date_email = get_option( 'wpesd-send-date-email', 'on' );
// Label controls
// *** estimass
$wpesd_estimass_color_value = get_option( 'wpesd-estimass-color', 'black' );
$wpesd_estimass_bgcolor_value = get_option( 'wpesd-estimass-bgcolor', '#ffb657' );
$wpesd_estimass_fontsize_value = get_option( 'wpesd-estimass-fontsize', '20px');
$wpesd_estimass_fontweight_value = get_option( 'wpesd-estimass-fontweight');
$wpesd_estimass_fontfamilly_value = get_option( 'wpesd-estimass-fontfamilly', 'roboto' );
// *** estimdate
$wpesd_product_shipted_value = get_option( 'wpesd-product-shipted', 'This product will be shipped on ');
$wpesd_shipping_icon_value = get_option( 'wpesd-shipping-icon', plugin_dir_url( __FILE__ ) . 'assets/public/shipping.png');
$wpesd_shipimgsize_value = get_option( 'wpesd-shipimgsize-check', '40px');
$wpesd_notice_position_value = get_option( 'wpesd-notice-position', 'top' );
$wpesd_pagechack_value = get_option( 'wpesd-check-pagechack-taxo-widget', 'M j, Y' );
// *** reason
$wpesd_reason_color_value = get_option( 'wpesd-reason-color', 'black' );
$wpesd_reason_fontsize_value = get_option( 'wpesd-reason-fontsize', '20px');
$wpesd_reason_fontweight_value = get_option( 'wpesd-reason-fontweight');
$wpesd_reason_fontfamilly_value = get_option( 'wpesd-reason-fontfamilly', 'roboto' );
// *** estimdate
$wpesd_estimdate_color_value = get_option( 'wpesd-estimdate-color', 'red' );
$wpesd_estimdate_fontsize_value = get_option( 'wpesd-estimdate-fontsize', '20px');
$wpesd_estimdate_fontweight_value = get_option( 'wpesd-estimdate-fontweight');
$wpesd_estimdate_fontfamilly_value = get_option( 'wpesd-estimdate-fontfamilly');

?>
<div class="admin-panel">
  <form method="post" action="options.php">
    <div class="header">
			<?php
			settings_fields( 'wpesd-plugin-settings' );
      ?>
      <a href="https://bestwpdeveloper.com/" target="_blank"><h1 class="dashboard-title"><?php _e('BEST WP DEVELOPER', 'wproduct-estimated-shipping-date'); ?></h1></a>
      <?php
			do_settings_sections( 'wpesd-plugin-main-menu' );
      ?>
      <div class="save-button">
        <?php submit_button(); ?>
      </div>
    </div>
    <div class="section">
      <div class="clmn-wrap first-clm">
        <div class="select-container">
          <label for=""><?php _e('Reason notice position', 'wproduct-estimated-shipping-date'); ?></label>
          <select name="wpesd-notice-position">
            <option value="top" <?php selected($wpesd_notice_position_value, 'top'); ?>><?php _e('Top', 'wproduct-estimated-shipping-date'); ?></option>
            <option value="bottom" <?php selected($wpesd_notice_position_value, 'bottom'); ?>><?php _e('Bottom', 'wproduct-estimated-shipping-date'); ?></option>
          </select>
        </div>
        <div class="select-container emessage-container">
          <label><?php _e('Estimated Message:', 'wproduct-estimated-shipping-date'); ?></label>
          <?php echo '<input type="text" name="wpesd-product-shipted" id="wpesd-product-shipted" value="'.$wpesd_product_shipted_value.'" title="Text"  placeholder="This product will be shipped on ">';?>
        </div>
        <div class="select-container emessage-container">
          <label><?php _e('Image url:', 'wproduct-estimated-shipping-date'); ?></label>
          <?php echo '<input type="text" name="wpesd-shipping-icon" id="wpesd-shipping-icon" value="'.$wpesd_shipping_icon_value.'" title="If don\'t want empty it."  placeholder="Url here">';?>
        </div>
        <div class="select-container emessage-container">
          <label><?php _e('Image size', 'wproduct-estimated-shipping-date'); ?></label>
          <input type="text" name="wpesd-shipimgsize-check" value="<?php echo $wpesd_shipimgsize_value; ?>" title="If don\'t want empty it."  placeholder="px, %, rem">
        </div>
        <div class="choose-page"><?php _e('Date format:', 'wproduct-estimated-shipping-date'); ?></div>
        <div class="list-container">
          <div class="list-item">
            <input type="radio" name="wpesd-check-pagechack-taxo-widget" value="F j, Y"
            <?php checked(get_option('wpesd-check-pagechack-taxo-widget', 'off'), 'F j, Y'); ?>>
            <label ><?php _e('November 6, 2023 ', 'wproduct-estimated-shipping-date'); ?></label>
          </div>
          <div class="list-item">
            <input type="radio" name="wpesd-check-pagechack-taxo-widget" value="F, Y"
            <?php checked(get_option('wpesd-check-pagechack-taxo-widget', 'off'), 'F, Y'); ?>>
            <label ><?php _e('November, 2023', 'wproduct-estimated-shipping-date'); ?></label>
          </div>
          <div class="list-item">
            <input type="radio" name="wpesd-check-pagechack-taxo-widget" value="M j, Y"
            <?php checked(get_option('wpesd-check-pagechack-taxo-widget', 'off'), 'M j, Y'); ?>>
            <label ><?php _e('Nov 6, 2023', 'wproduct-estimated-shipping-date'); ?></label>
          </div>
          <div class="list-item">
            <input type="radio" name="wpesd-check-pagechack-taxo-widget" value="Y/m/d"
            <?php checked(get_option('wpesd-check-pagechack-taxo-widget', 'off'), 'Y/m/d'); ?>>
            <label ><?php _e('2023/11/06', 'wproduct-estimated-shipping-date'); ?></label>
          </div>
        </div>
        <div class="list-container wpesd_cmmn_chacthak">
          <input type="checkbox" name="wpesd-checkout-page-check" value="on" <?php echo checked( $wpesd_checkout_page_check, 'on', false ); ?>>
          <label class="checker-switch"><?php _e('Show in checkout page', 'wproduct-estimated-shipping-date'); ?></label>
        </div>
        <div class="list-container wpesd_cmmn_chacthak">
          <input type="checkbox" name="wpesd-thankyou-page-check" value="on" <?php echo checked( $wpesd_thankyou_page_check, 'on', false ); ?>>
          <label class="checker-switch"><?php _e('Show in thank you Page', 'wproduct-estimated-shipping-date'); ?></label>
        </div>
        <div class="list-container wpesd_cmmn_chacthak">
          <input type="checkbox" name="wpesd-orderdate-thankyou-page-check" value="off" <?php echo checked( $wpesd_orderdate_thankyou_page_check, 'off', false ); ?>>
          <label class="checker-switch"><?php _e('Show order date in thank you page', 'wproduct-estimated-shipping-date'); ?></label>
        </div>
        <div class="list-container wpesd_cmmn_chacthak">
          <input type="checkbox" name="wpesd-send-date-email" value="on" <?php echo checked( $wpesd_send_date_email, 'on', false ); ?>>
          <label class="checker-switch"><?php _e('Send date in email', 'wproduct-estimated-shipping-date'); ?></label>
        </div>
      </div>
      <div class="clmn-wrap secound-clm">
        <div class="control_row">
        <label for="" class="wpesd_style_title"><?php _e('Estimated Message', 'wproduct-estimated-shipping-date');?></label>
          <div class="color-control wpesd-style-style">
            <label for=""><?php _e('Color', 'wproduct-estimated-shipping-date');?></label>
            <?php echo '<input type="color" name="wpesd-estimass-color" id="wpesd-estimass-text" value="'.$wpesd_estimass_color_value.'" title="Text">';?>
          </div>
          <div class="color-control wpesd-style-style">
            <label for=""><?php _e('BG', 'wproduct-estimated-shipping-date');?></label>
            <?php echo '<input type="color" name="wpesd-estimass-bgcolor" id="wpesd-estimass-text" value="'.$wpesd_estimass_bgcolor_value.'" title="Text">';?>
          </div>
          <div class="text-control wpesd-style-style">
            <label for=""><?php _e('Font size', 'wproduct-estimated-shipping-date');?></label>
            <?php echo '<input type="text" name="wpesd-estimass-fontsize" id="wpesd-estimass-fontsize" value="'.$wpesd_estimass_fontsize_value.'" title="10px"  placeholder="px, %, rem">';?>
          </div>
          <div class="number-control wpesd-style-style">
            <label for=""><?php _e('Font weight', 'wproduct-estimated-shipping-date');?></label>
            <?php echo '<input type="text" name="wpesd-estimass-fontweight" id="wpesd-estimass-fontweight" value="'.$wpesd_estimass_fontweight_value.'" title="Number"  placeholder="400">';?>
          </div>
          <div class="select-control wpesd-style-style">
            <label for=""><?php _e('Font family', 'wproduct-estimated-shipping-date');?></label>
            <select name="wpesd-estimass-fontfamilly">
              <option value="roboto" <?php selected($wpesd_estimass_fontfamilly_value, 'roboto'); ?>><?php _e('Roboto - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
              <option value="open-sans" <?php selected($wpesd_estimass_fontfamilly_value, 'open-sans'); ?>><?php _e('Open Sans - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
              <option value="lato" <?php selected($wpesd_estimass_fontfamilly_value, 'lato'); ?>><?php _e('Lato - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
              <option value="montserrat" <?php selected($wpesd_estimass_fontfamilly_value, 'montserrat'); ?>><?php _e('Montserrat - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
              <option value="nunito" <?php selected($wpesd_estimass_fontfamilly_value, 'nunito'); ?>><?php _e('Nunito - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
            </select>
          </div>
        </div>
        <div class="control_row">
        <label for="" class="wpesd_style_title"><?php _e('Date', 'wproduct-estimated-shipping-date');?></label>
          <div class="color-control wpesd-style-style">
            <label for=""><?php _e('Color', 'wproduct-estimated-shipping-date');?></label>
            <?php echo '<input type="color" name="wpesd-estimdate-color" id="wpesd-estimdate-text" value="'.$wpesd_estimdate_color_value.'" title="Text">';?>
          </div>
          <div class="text-control wpesd-style-style">
            <label for=""><?php _e('Font size', 'wproduct-estimated-shipping-date');?></label>
            <?php echo '<input type="text" name="wpesd-estimdate-fontsize" id="wpesd-estimdate-fontsize" value="'.$wpesd_estimdate_fontsize_value.'" title="10px"  placeholder="px, %, rem">';?>
          </div>
          <div class="number-control wpesd-style-style">
            <label for=""><?php _e('Font weight', 'wproduct-estimated-shipping-date');?></label>
            <?php echo '<input type="text" name="wpesd-estimdate-fontweight" id="wpesd-estimdate-fontweight" value="'.$wpesd_estimdate_fontweight_value.'" title="Number"  placeholder="400">';?>
          </div>
          <div class="select-control wpesd-style-style">
            <label for=""><?php _e('Font family', 'wproduct-estimated-shipping-date');?></label>
            <select name="wpesd-estimdate-fontfamilly">
              <option value="roboto" <?php selected($wpesd_estimdate_fontfamilly_value, 'roboto'); ?>><?php _e('Roboto - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
              <option value="open-sans" <?php selected($wpesd_estimdate_fontfamilly_value, 'open-sans'); ?>><?php _e('Open Sans - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
              <option value="lato" <?php selected($wpesd_estimdate_fontfamilly_value, 'lato'); ?>><?php _e('Lato - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
              <option value="montserrat" <?php selected($wpesd_estimdate_fontfamilly_value, 'montserrat'); ?>><?php _e('Montserrat - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
              <option value="nunito" <?php selected($wpesd_estimdate_fontfamilly_value, 'nunito'); ?>><?php _e('Nunito - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
            </select>
          </div>
        </div>
        <div class="control_row">
        <label for="" class="wpesd_style_title"><?php _e('Reason', 'wproduct-estimated-shipping-date');?></label>
          <div class="color-control wpesd-style-style">
            <label for=""><?php _e('Color', 'wproduct-estimated-shipping-date');?></label>
            <?php echo '<input type="color" name="wpesd-reason-color" id="wpesd-reason-color" value="'.$wpesd_reason_color_value.'" title="Text">';?>
          </div>
          <div class="text-control wpesd-style-style">
            <label for=""><?php _e('Font size', 'wproduct-estimated-shipping-date');?></label>
            <?php echo '<input type="text" name="wpesd-reason-fontsize" id="wpesd-reason-fontsize" value="'.$wpesd_reason_fontsize_value.'" title="10px"  placeholder="px, %, rem">';?>
          </div>
          <div class="number-control wpesd-style-style">
            <label for=""><?php _e('Font weight', 'wproduct-estimated-shipping-date');?></label>
            <?php echo '<input type="text" name="wpesd-reason-fontweight" id="wpesd-reason-fontweight" value="'.$wpesd_reason_fontweight_value.'" title="Number"  placeholder="400">';?>
          </div>
          <div class="select-control wpesd-style-style">
            <label for=""><?php _e('Font family', 'wproduct-estimated-shipping-date');?></label>
            <select name="wpesd-reason-fontfamilly">
              <option value="roboto" <?php selected($wpesd_reason_fontfamilly_value, 'roboto'); ?>><?php _e('Roboto - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
              <option value="open-sans" <?php selected($wpesd_reason_fontfamilly_value, 'open-sans'); ?>><?php _e('Open Sans - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
              <option value="lato" <?php selected($wpesd_reason_fontfamilly_value, 'lato'); ?>><?php _e('Lato - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
              <option value="montserrat" <?php selected($wpesd_reason_fontfamilly_value, 'montserrat'); ?>><?php _e('Montserrat - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
              <option value="nunito" <?php selected($wpesd_reason_fontfamilly_value, 'nunito'); ?>><?php _e('Nunito - Sans-serif', 'wproduct-estimated-shipping-date'); ?></option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
