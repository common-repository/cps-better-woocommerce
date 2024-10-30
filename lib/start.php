<?php

// Prevent direct access to the plugin
defined( 'ABSPATH' ) || exit;

// CPS SDK
if ( !function_exists( 'cps' ) ) {
	function cps() {
		// Include CPS SDK.
		require_once CPS_BWC_PLUGIN_DIR . '/cps/start.php';
	}

	// Init CPS.
	cps();
}

// Include files.
if ( is_admin() ) {
	include_once CPS_BWC_PLUGIN_DIR . '/lib/admin.php';
}

$options = get_option( 'cps_bwc_fields' );
$moduleCheckoutValue = isset( $options['module-checkout'] ) ? $options['module-checkout'] : 0;
$taxnumberValue = isset( $options['taxnumber'] ) ? $options['taxnumber'] : 0;
$plusminusValue = isset( $options['plusminus'] ) ? $options['plusminus'] : 0;
$updatecartValue = isset( $options['updatecart'] ) ? $options['updatecart'] : 0;
$returntoshopValue = isset( $options['returntoshop'] ) ? $options['returntoshop'] : 0;
$loginregistrationredirectValue = isset( $options['loginregistrationredirect'] ) ? $options['loginregistrationredirect'] : 0;
$freeshippingnoticeValue = isset( $options['freeshippingnotice'] ) ? $options['freeshippingnotice'] : 0;
$legalcheckoutValue = isset( $options['legalcheckout'] ) ? $options['legalcheckout'] : 0;

if( $moduleCheckoutValue == 1 ) include_once CPS_BWC_PLUGIN_DIR . '/modules/checkout.php';
if( $moduleCheckoutValue == 1 && $taxnumberValue == 1 ) include_once CPS_BWC_PLUGIN_DIR . '/modules/tax-number.php';
if( $plusminusValue == 1 ) include_once CPS_BWC_PLUGIN_DIR . '/modules/plus-minus-buttons.php';
if( $updatecartValue == 1 ) include_once CPS_BWC_PLUGIN_DIR . '/modules/update-cart.php';
if( $returntoshopValue == 1 ) include_once CPS_BWC_PLUGIN_DIR . '/modules/return-to-shop.php';
if( $loginregistrationredirectValue == 1 ) include_once CPS_BWC_PLUGIN_DIR . '/modules/login-registration-redirect.php';
if( $freeshippingnoticeValue == 1 ) include_once CPS_BWC_PLUGIN_DIR . '/modules/free-shipping-notice.php';
if( $legalcheckoutValue == 1 ) include_once CPS_BWC_PLUGIN_DIR . '/modules/legal-checkout.php';

// Add plugin woocommerce templates if exist
function cps_bwc_locate_template( $template, $template_name, $template_path ) {
	global $woocommerce;
	$_template = $template;

	if ( !$template_path ) $template_path = $woocommerce->template_url;
		$plugin_path = CPS_BWC_PLUGIN_DIR . '/woocommerce/';

	// Look within passed path within the theme – this is priority
	$template = locate_template(
		array( $template_path . $template_name, $template_name )
	);

	// Modification: Get the template from this plugin, if it exists
	if ( !$template && file_exists( $plugin_path . $template_name ) )
		$template = $plugin_path . $template_name;

	// Use default template
	if ( !$template )
		$template = $_template;

	// Return what we found
	return $template;
}
add_filter( 'woocommerce_locate_template', 'cps_bwc_locate_template', 10, 3 );
