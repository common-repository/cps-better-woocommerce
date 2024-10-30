<?php

include_once( CPS_BWC_PLUGIN_DIR . '/pages/settings.php');

// Admin options menu
function cps_bwc_add_menus() {
	global $cps_bwc_settings_page;
	$cps_bwc_settings_page = add_submenu_page(
		'cps-plugins-menu',
		'Better WooCommerce',
		'Better WooCommerce',
		'manage_options',
		'cps-bwc-menu',
		'cps_bwc_settings_page'
	);
}
add_action( 'admin_menu', 'cps_bwc_add_menus', 999 );

// Custom styles and scripts for admin pages
function cps_bwc_init( $hook ) {
	wp_register_style( 'cps-bwc-admin', CPS_BWC_PLUGIN_URL . '/assets/css/admin.css', false, '18.4' );
	global $cps_bwc_settings_page;
	if ( $hook == $cps_bwc_settings_page ) {
		add_action( 'admin_enqueue_scripts', 'cps_admin_scripts', 9999 );
        wp_enqueue_style( 'cps-bwc-admin' );
	}
}
add_action( 'admin_enqueue_scripts', 'cps_bwc_init' );

function cps_bwc_admin_sidebar() {
	$options = get_option( 'cps_bwc_fields' );
	$home_url = get_option( 'home' );
	$current_user = wp_get_current_user();

	?><div uk-sticky="offset: 42; bottom: #bottom">
	<div class="uk-card uk-card-small uk-card-default uk-card-hover">
		<div class="uk-card-header uk-background-muted">
			<h3 class="uk-card-title"><?php _e( 'Informations', 'cps-better-woocommerce' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #informations"></a></h3>
		</div>
		<div id="informations" class="uk-card-body">
			<p><?php _e( 'Subscribe to our newsletter to get the latest news and offers!', 'cps-better-woocommerce' ); ?></p>
			<p><a class="uk-button uk-button-danger uk-button-large uk-width-1-1" href="https://hucommerce.us20.list-manage.com/subscribe?u=8e6a039140be449ecebeb5264&id=2f5c70bc50&EMAIL=<?php echo urlencode( $current_user->user_email ); ?>&FNAME=<?php echo urlencode( $current_user->user_firstname ); ?>&LNAME=<?php echo urlencode( $current_user->user_lastname ); ?>&URL=<?php echo urlencode( $home_url ); ?>" target="_blank"><span uk-icon="mail"></span> <?php _e( 'Join CPS Newsletter', 'cps-better-woocommerce' ); ?></a></p>
			<h4 class="uk-heading-divider"><?php _e( 'Plugin links', 'cps-better-woocommerce' ); ?></h4>
			<ul class="uk-list">
				<li><a href="https://wordpress.org/support/plugin/cps-better-woocommerce" target="_blank"><?php _e( 'Official support forum', 'cps-better-woocommerce' ); ?></a></li>
				<li><a href="https://hu.wordpress.org/plugins/cps-better-woocommerce/#reviews" target="_blank"><?php _e( 'Read our reviews', 'cps-better-woocommerce' ); ?></a></li>
			</ul>
			<hr>
			<p>
				<strong><?php _e( 'Do you like this plugin? Please give a 5 star review:', 'cps-better-woocommerce' ); ?></strong>
				 <a href="https://wordpress.org/support/plugin/cps-better-woocommerce/reviews/#new-post" target="_blank"><?php _e( 'Write a new review', 'cps-better-woocommerce' ); ?></a>
			</p>
			<h4 class="uk-heading-divider"><?php _e( 'Coming features', 'cps-better-woocommerce' ); ?></h4>
			<ul class="uk-list">
				<li><span uk-icon="icon: check; ratio: 0.8"></span> Global variables, that can be displayed everywhere with simple shortcodes.</li>
				<li><span uk-icon="icon: check; ratio: 0.8"></span> Custom Thank you page.</li>
			</ul>
			<?php /*
			<h4 class="uk-heading-divider">Szerezd meg a PRO verziót</h4>
			<p>Aktiváld a HuCommerce bővítmény összes lehetőségét! A PRO verzió megvásárlásával további fantasztikus funkciókat és integrációkat kapsz.</p>
			<div class="uk-alert-success" style="display: none;" uk-alert>
				<?php _e( '<p>Use this special <strong>BEFOREGDPR</strong> coupon to get 50% OFF your first purchase, which is available till <strong>May 26, 2018</strong>. Hurry, GDPR is coming!</p>', 'cps-better-woocommerce' ); ?>
			</div>
			<p><a class="uk-button uk-button-default uk-width-1-1" href="#">Vedd meg a PRO verziót!</a></p>
			<div class="uk-alert-primary" style="display: none;" uk-alert>
				<a class="uk-alert-close" uk-close></a>
				<h3><?php _e( 'Affiliate Program', 'cps-better-woocommerce' ); ?></h3>
				<p><?php _e( 'Do you like this plugin? Let\'s make some money by referring new customers and get 20% commission, for the lifetime of the new customers! Good deal, hah?', 'cps-better-woocommerce' ); ?></p>
				<p><a class="uk-button uk-button-primary uk-width-1-1" href="<?php echo esc_url( get_admin_url() ); ?>admin.php?page=cps-bwc-menu-affiliation"><?php _e( 'Be an Affiliate!', 'cps-better-woocommerce' ); ?></a></p>
			</div>
			*/ ?>
		</div>
		<div class="uk-card-footer uk-background-muted">
			<p class="uk-text-right"><?php _e( 'License: GPLv2', 'cps-better-woocommerce' ); ?></p>
		</div>
	</div>
</div>
<?php
}

/*
// Admin notice classes:
// notice-success
// notice-success notice-alt
// notice-info
// notice-warning
// notice-error
// Without a class, there is no colored left border.
*/

// Welcome notice
function cps_bwc_admin_notice__welcome() {
	if ( ! PAnD::is_admin_notice_active( 'cps-bwc-notice-welcome-forever' ) ) return;

	$home_url = get_option( 'home' );
	$current_user = wp_get_current_user();
	?>
	<div data-dismissible="cps-bwc-notice-welcome-forever" class="notice notice-info is-dismissible">
		<div style="padding: 20px;">
			<img src="<?php echo CPS_BWC_PLUGIN_URL; ?>/assets/images/cps-bwc-logo.png" alt="CPS | Better WooCommerce" height="100" style="max-height: 100px;">
			<p><strong><?php _e( 'Thank you for installing Better WooCommerce plugin!', 'cps-better-woocommerce' ); ?></strong></p>
			<p><?php _e( 'First step is to activate Better WooCommerce modules and set the individual module settings.', 'cps-better-woocommerce' ); ?>
			<br><?php _e( 'To activate the Better WooCommerce modules and adjust settings, go to this page', 'cps-better-woocommerce' ); ?>: <a href="<?php admin_url(); ?>admin.php?page=cps-bwc-menu"><?php _e( 'CPS Plugins -> Better WooCommerce' ); ?></a></p>
			<p><?php _e( '<strong>IMPORTANT!</strong> This notification will not show up again after you close it. Before do this, please subscribe to our newsletter and join the CPS Facebook group!', 'cps-better-woocommerce' ); ?></p>
			<p><a href="https://cherrypickstudios.us19.list-manage.com/subscribe?u=b132c87c5a57f861f7d81620e&id=27c28e2aca&EMAIL=<?php echo urlencode( $current_user->user_email ); ?>&FNAME=<?php echo urlencode( $current_user->user_firstname ); ?>&LNAME=<?php echo urlencode( $current_user->user_lastname ); ?>&URL=<?php echo urlencode( $home_url ); ?>" target="_blank" class="button button-secondary"><span class="dashicons dashicons-email" style="position: relative;top: 3px;left: -3px;"></span> <?php _e( 'Join CPS Newsletter', 'cps-better-woocommerce' ); ?></a> <a href="https://www.facebook.com/groups/HuCommerce.hu/" target="_blank" class="button button-primary"><span class="dashicons dashicons-facebook-alt" style="position: relative;top: 3px;left: -3px;"></span> <?php _e( 'CPS Facebook group', 'cps-better-woocommerce' ); ?></a></p>
		</div>
	</div>
	<?php
}
add_action( 'admin_notices', 'cps_bwc_admin_notice__welcome' );
