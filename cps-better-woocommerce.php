<?php

/*
Plugin Name: CPS | Better WooCommerce
Plugin URI: https://www.cherrypickstudios.com/plugins/better-woocommerce/
Description: A better WooCommerce experience with a lot of useful extras.

Version: 2.0

Author: CherryPickStudios
Author URI: https://www.cherrypickstudios.com/

License: GPLv2

Text Domain: cps-better-woocommerce
Domain Path: /languages/

WooCommerce options
WC requires at least: 4.0
WC tested up to: 4.0
*/

// Prevent direct access
defined( 'ABSPATH' ) || exit;

define( 'CPS_BWC_PLUGIN_VERSION_NUMBER', '2.0' );
define( 'CPS_BWC_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'CPS_BWC_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'CPS_BWC_PLUGIN_FILE', __FILE__ );

// Freemius SDK wrap to prevent conflicts with premium version.
if ( function_exists( 'betterwoocommerce_fs' ) ) {

	// Check if premium version is used.
	if( hucommerce_fs()->is__premium_only() ) {
		define( 'CPS_BWC_PLUGIN_VERSION', 'premium' );
	}

	// Set license.
	if( hucommerce_fs()->can_use_premium_code() ) {
		define( 'CPS_BWC_PLUGIN_LICENSE', 'valid' );
	} elseif( defined( 'CPS_BWC_PLUGIN_VERSION' ) && CPS_BWC_PLUGIN_VERSION == 'premium' ) {
		define( 'CPS_BWC_PLUGIN_LICENSE', 'expired' );
	}

}

// Set plugin veryion to free if premium version is not active.
if( !defined( 'CPS_BWC_PLUGIN_VERSION' ) ) {
	define( 'CPS_BWC_PLUGIN_VERSION', 'free' );
}

// Set plugin license to free if premium version is not active.
if( !defined( 'CPS_BWC_PLUGIN_LICENSE' ) ) {
	define( 'CPS_BWC_PLUGIN_LICENSE', 'free' );
}

// Check WooCommerce.
function cps_bwc_check_woocommerce() {
	if ( class_exists( 'WooCommerce' ) ) {
		// Start HuCommerce.
		require_once CPS_BWC_PLUGIN_DIR . '/lib/start.php';
	} else {
		// Notify user, that WooCommerce is not active.
		add_action( 'admin_notices', 'cps_bwc_admin_notice__no_woocommerce' );
	}
}
add_action( 'plugins_loaded', 'cps_bwc_check_woocommerce' );

// Localization
function cps_bwc_localization() {
	load_plugin_textdomain( 'cps-better-woocommerce', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'cps_bwc_localization' );

function cps_bwc_admin_notice__no_woocommerce() {
	?>
	<div class="notice notice-error">
		<div style="padding: 20px;">
			<img src="<?php echo CPS_BWC_PLUGIN_URL; ?>/assets/images/cps-bwc-logo.png" alt="CPS | Better WooCommerce" height="100" style="max-height: 100px;">
			<p><?php _e( 'To use Better WooCommerce, you need to activate WooCommerce plugin first. If you don\'t want to use WooCommerce, please deactivate Better WooCommerce plugin also!', 'cps-better-woocommerce' ); ?></p>
			<p><?php _e( 'To activate WooCommerce or deactivate Better WooCommerce, go to this page:', 'cps-better-woocommerce' ); ?> <a href="<?php admin_url(); ?>plugins.php"><?php _e( 'Plugins' ); ?></a></p>
		</div>
	</div>
	<?php
}
