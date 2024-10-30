<?php

add_action( 'admin_init', function() {
	register_setting(
		'cps_bwc_options',
		'cps_bwc_fields',
		'cps_bwc_fields_validate'
	);
} );

global $returntoshopcartposition_options;
global $returntoshopcheckoutposition_options;

$returntoshopcartposition_options = array(
	'beforecarttable' => array(
		'value' => 'beforecarttable',
		'label' => __( 'Before Product table (with text)', 'cps-better-woocommerce' )
	),
	'aftercarttable' => array(
		'value' => 'aftercarttable',
		'label' => __( 'After Product table (with text)', 'cps-better-woocommerce' )
	),
	'cartactions' => array(
		'value' => 'cartactions',
		'label' => __( 'Next to Update cart button (without text)', 'cps-better-woocommerce' )
	),
	'proceedtocheckout' => array(
		'value' => 'proceedtocheckout',
		'label' => __( 'Under Proceed to checkout button (without text)', 'cps-better-woocommerce' )
	)
);

$returntoshopcheckoutposition_options = array(
	'nocheckout' => array(
		'value' => 'nocheckout',
		'label' => __( 'Don\'t show on Checkout page', 'cps-better-woocommerce' )
	),
	'beforecheckoutform' => array(
		'value' => 'beforecheckoutform',
		'label' => __( 'Before Checkout form (with text)', 'cps-better-woocommerce' )
	),
	'aftercheckoutform' => array(
		'value' => 'aftercheckoutform',
		'label' => __( 'After Checkout form (with text)', 'cps-better-woocommerce' )
	)
);

function cps_bwc_settings_page() {
	global $returntoshopcartposition_options;
	global $returntoshopcheckoutposition_options;

	$freeNotification = '<p class="uk-text-meta uk-text-center">Ezek a modulok a bővítmény PRO kiegészítőjével érhetők el, amelyet külön kell megvásárolni a bővítményhez.</p>';

	$szamlazzhu_options = get_option( 'woocommerce_wc_szamlazz_settings' );
	$billingo_options = get_option( 'woocommerce_wc_billingo_plus_settings' );

?>
<div class="cps-admin cps-bwc-settings-page">
	<?php cps_admin_header( CPS_BWC_PLUGIN_FILE ); ?>
	<div class="wrap">
		<?php if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true ) { ?>
			<div class="updated notice is-dismissible"><p><strong><?php _e( 'Settings saved.' ); ?></strong></p></div>
		<?php } ?>

		<div class="uk-grid-small" uk-grid>
			<div class="uk-width-3-4@l">
				<form class="uk-form-horizontal" method="post" action="options.php">
					<?php settings_fields( 'cps_bwc_options' ); ?>
					<?php $options = get_option( 'cps_bwc_fields' ); ?>

					<div class="uk-card uk-card-small uk-card-default uk-card-hover uk-margin-bottom">
						<div class="uk-card-header uk-background-muted">
							<h3 class="uk-card-title"><?php _e( 'Better WooCommerce modules', 'cps-better-woocommerce' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #hc-modules"></a></h3>
						</div>
						<div id="hc-modules" class="uk-card-body">

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Checkout page customizations', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'Extra fields and other customizations on the Checkout page', 'cps-better-woocommerce' ); ?>; pos: right"></span></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $moduleCheckoutValue = isset( $options['module-checkout'] ) ? $options['module-checkout'] : 0; ?>
											<input id="module-checkout" name="cps_bwc_fields[module-checkout]" type="checkbox" value="1" <?php checked( '1', $moduleCheckoutValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<hr>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Plus/minus quantity buttons', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'Shows plus/minus quantity buttons for products.', 'cps-better-woocommerce' ); ?>; pos: right"></span></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $plusminusValue = isset( $options['plusminus'] ) ? $options['plusminus'] : 0; ?>
											<input id="cps_bwc_fields[plusminus]" name="cps_bwc_fields[plusminus]" type="checkbox" value="1" <?php checked( '1', $plusminusValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<hr>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Automatic Cart update', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'It will automatically update the cart, when customer changes the quantity on the Cart page.', 'cps-better-woocommerce' ); ?>; pos: right"></span></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $updatecartValue = isset( $options['updatecart'] ) ? $options['updatecart'] : 0; ?>
											<input id="cps_bwc_fields[updatecart]" name="cps_bwc_fields[updatecart]" type="checkbox" value="1" <?php checked( '1', $updatecartValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<hr>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Continue shopping buttons', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'A Continue shopping button on Cart and/or Checkout pages, that will bring customer to Shop page.', 'cps-better-woocommerce' ); ?>; pos: right"></span></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $returntoshopValue = isset( $options['returntoshop'] ) ? $options['returntoshop'] : 0; ?>
											<input id="cps_bwc_fields[returntoshop]" name="cps_bwc_fields[returntoshop]" type="checkbox" value="1" <?php checked( '1', $returntoshopValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<hr>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Login and registration redirection', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'Set custom landing pages after login and/or registration.', 'cps-better-woocommerce' ); ?>; pos: right"></span></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $loginregistrationredirectValue = isset( $options['loginregistrationredirect'] ) ? $options['loginregistrationredirect'] : 0; ?>
											<input id="cps_bwc_fields[loginregistrationredirect]" name="cps_bwc_fields[loginregistrationredirect]" type="checkbox" value="1" <?php checked( '1', $loginregistrationredirectValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<hr>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Free shipping notification', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'A notification on the Cart page to let customer know, how much total purchase is missing to get free shipping.', 'cps-better-woocommerce' ); ?>; pos: right"></span></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $freeshippingnoticeValue = isset( $options['freeshippingnotice'] ) ? $options['freeshippingnotice'] : 0; ?>
											<input id="cps_bwc_fields[freeshippingnotice]" name="cps_bwc_fields[freeshippingnotice]" type="checkbox" value="1" <?php checked( '1', $freeshippingnoticeValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<hr>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Legal compliance (GDPR, CCPA, ePrivacy)', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'Custom Terms & Conditions and Privacy Policy checkboxes on Checkout page.', 'cps-better-woocommerce' ); ?>; pos: right"></span></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $legalcheckoutValue = isset( $options['legalcheckout'] ) ? $options['legalcheckout'] : 0; ?>
											<input id="cps_bwc_fields[legalcheckout]" name="cps_bwc_fields[legalcheckout]" type="checkbox" value="1" <?php checked( '1', $legalcheckoutValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

						</div>
						<div class="uk-card-footer uk-background-muted">
							<p><input type="submit" class="uk-button uk-button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>
						</div>
					</div>

					<div class="uk-card uk-card-small uk-card-default uk-card-hover uk-margin-bottom">
						<div class="uk-card-header uk-background-muted">
							<h3 class="uk-card-title"><?php _e( 'Module settings', 'cps-better-woocommerce' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #modulesettings"></a></h3>
						</div>
						<div id="modulesettings" class="uk-card-body">

							<h4 class="uk-heading-divider"><?php _e( 'Checkout page customizations', 'cps-better-woocommerce' ); ?></h4>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Conditional display of Company fields', 'cps-better-woocommerce' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $billingcompanycheckValue = isset( $options['billingcompanycheck'] ) ? $options['billingcompanycheck'] : 0; ?>
											<input id="billingcompanycheck" name="cps_bwc_fields[billingcompanycheck]" type="checkbox" value="1" <?php checked( '1', $billingcompanycheckValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Tax number field', 'cps-better-woocommerce' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $taxnumberValue = isset( $options['taxnumber'] ) ? $options['taxnumber'] : 0; ?>
											<input id="cps_bwc_fields[taxnumber]" name="cps_bwc_fields[taxnumber]" type="checkbox" value="1" <?php checked( '1', $taxnumberValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Hide Country field', 'cps-better-woocommerce' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $nocountryValue = isset( $options['nocountry'] ) ? $options['nocountry'] : 0; ?>
											<input id="nocountry" name="cps_bwc_fields[nocountry]" type="checkbox" value="1" <?php checked( '1', $nocountryValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Hide State/County field', 'cps-better-woocommerce' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $nocountyValue = isset( $options['nocounty'] ) ? $options['nocounty'] : 0; ?>
											<input id="cps_bwc_fields[nocounty]" name="cps_bwc_fields[nocounty]" type="checkbox" value="1" <?php checked( '1', $nocountyValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Hide Order notes field', 'cps-better-woocommerce' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $noordercommentsValue = isset( $options['noordercomments'] ) ? $options['noordercomments'] : 0; ?>
											<input id="noordercomments" name="cps_bwc_fields[noordercomments]" type="checkbox" value="1" <?php checked( '1', $noordercommentsValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Inline Company and Tax number fields', 'cps-better-woocommerce' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $companytaxnumberpairValue = isset( $options['companytaxnumberpair'] ) ? $options['companytaxnumberpair'] : 0; ?>
											<input id="companytaxnumberpair" name="cps_bwc_fields[companytaxnumberpair]" type="checkbox" value="1" <?php checked( '1', $companytaxnumberpairValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Inline ZIP and City fields', 'cps-better-woocommerce' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $postcodecitypairValue = isset( $options['postcodecitypair'] ) ? $options['postcodecitypair'] : 0; ?>
											<input id="postcodecitypair" name="cps_bwc_fields[postcodecitypair]" type="checkbox" value="1" <?php checked( '1', $postcodecitypairValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Inline Phone and Email fields', 'cps-better-woocommerce' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $phoneemailpairValue = isset( $options['phoneemailpair'] ) ? $options['phoneemailpair'] : 0; ?>
											<input id="phoneemailpair" name="cps_bwc_fields[phoneemailpair]" type="checkbox" value="1" <?php checked( '1', $phoneemailpairValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<h4 class="uk-heading-divider"><?php _e( 'Continue shopping buttons', 'cps-better-woocommerce' ); ?></h4>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Button position on Cart page', 'cps-better-woocommerce' ); ?></div>
								<div class="uk-form-controls">
									<select class="uk-select" name="cps_bwc_fields[returntoshopcartposition]">
										<?php
											$returntoshopcartpositionValue = isset( $options['returntoshopcartposition'] ) ? $options['returntoshopcartposition'] : 'cartactions';
											$selected = $returntoshopcartpositionValue;
											$p = '';
											$r = '';

											foreach ( $returntoshopcartposition_options as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Button position on Checkout page', 'cps-better-woocommerce' ); ?></div>
								<div class="uk-form-controls">
									<select class="uk-select" name="cps_bwc_fields[returntoshopcheckoutposition]">
										<?php
											$returntoshopcheckoutpositionValue = isset( $options['returntoshopcheckoutposition'] ) ? $options['returntoshopcheckoutposition'] : 'nocheckout';
											$selected = $returntoshopcheckoutpositionValue;
											$p = '';
											$r = '';

											foreach ( $returntoshopcheckoutposition_options as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>

							<div class="uk-margin">
								<label class="uk-form-label" for="cps_bwc_fields[returntoshopmessage]"><?php _e( 'Message text', 'cps-better-woocommerce' ); ?></label>
								<div class="uk-form-controls">
									<?php $returntoshopmessageValue = isset( $options['returntoshopmessage'] ) ? $options['returntoshopmessage'] : __( 'Would you like to continue shopping?', 'cps-better-woocommerce' ); ?>
									<input id="cps_bwc_fields[returntoshopmessage]" class="uk-input" type="text" name="cps_bwc_fields[returntoshopmessage]" value="<?php echo stripslashes( $returntoshopmessageValue ); ?>" />
								</div>
							</div>

							<h4 class="uk-heading-divider"><?php _e( 'Login and registration redirection', 'cps-better-woocommerce' ); ?></h4>

							<div class="uk-margin">
								<label class="uk-form-label" for="cps_bwc_fields[loginredirecturl]"><?php _e( 'Redirection URL after Login', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'Absoulute URL path. If empty, than default WooCommerce redirection will be set.', 'cps-better-woocommerce' ); ?>; pos: right"></span></label>
								<div class="uk-form-controls">
									<?php $loginredirecturlValue = isset( $options['loginredirecturl'] ) ? $options['loginredirecturl'] : wc_get_page_permalink( 'shop' ); ?>
									<input id="cps_bwc_fields[loginredirecturl]" class="uk-input" type="text" name="cps_bwc_fields[loginredirecturl]" value="<?php echo stripslashes( $loginredirecturlValue ); ?>" />
								</div>
							</div>

							<div class="uk-margin">
								<label class="uk-form-label" for="cps_bwc_fields[registrationredirecturl]"><?php _e( 'Redirection URL after Registration', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'Absoulute URL path. If empty, than default WooCommerce redirection will be set.', 'cps-better-woocommerce' ); ?>; pos: right"></span></label>
								<div class="uk-form-controls">
									<?php $registrationredirecturlValue = isset( $options['registrationredirecturl'] ) ? $options['registrationredirecturl'] : wc_get_page_permalink( 'shop' ); ?>
									<input id="cps_bwc_fields[registrationredirecturl]" class="uk-input" type="text" name="cps_bwc_fields[registrationredirecturl]" value="<?php echo stripslashes( $registrationredirecturlValue ); ?>" />
								</div>
							</div>

							<h4 class="uk-heading-divider"><?php _e( 'Free shipping notification', 'cps-better-woocommerce' ); ?></h4>

							<div class="uk-margin">
								<label class="uk-form-label" for="cps_bwc_fields[freeshippingnoticemessage]"><?php _e( 'Message text', 'cps-better-woocommerce' ); ?></label>
								<div class="uk-form-controls">
									<?php $freeshippingnoticemessageValue = isset( $options['freeshippingnoticemessage'] ) && ( $options['freeshippingnoticemessage'] != '' ) ? $options['freeshippingnoticemessage'] : __( 'The remaining amount to get FREE shipping', 'cps-better-woocommerce' ); ?>
									<input id="cps_bwc_fields[freeshippingnoticemessage]" class="uk-input" type="text" name="cps_bwc_fields[freeshippingnoticemessage]" value="<?php echo stripslashes( $freeshippingnoticemessageValue ); ?>" />
								</div>
							</div>

							<h4 class="uk-heading-divider"><?php _e( 'Legal compliance (GDPR, CCPA, ePrivacy)', 'cps-better-woocommerce' ); ?></h4>

							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Save customer IP address on registration', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'If enabled, the customer\'s IP address will be saved in profile after registration.' , 'cps-better-woocommerce' ); ?>; pos: right"></span></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<label class="switch">
											<?php $regipValue = isset( $options['regip'] ) ? $options['regip'] : 0; ?>
											<input id="cps_bwc_fields[regip]" name="cps_bwc_fields[regip]" type="checkbox" value="1" <?php checked( '1', $regipValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>

							<div class="uk-margin">
								<label class="uk-form-label" for="cps_bwc_fields[regacceptpp]"><?php _e( 'Privacy Policy checkbox text on Registration form (with HTML link, if needed)', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'If empty, than this checkbox will not be displayed.', 'cps-better-woocommerce' ); ?>; pos: right"></span></label>
								<div class="uk-form-controls">
									<?php $regacceptppValue = isset( $options['regacceptpp'] ) ? $options['regacceptpp'] : esc_attr( __( 'I\'ve read and accept the <a href="/privacy-policy/" target="_blank">Privacy Policy</a>', 'cps-better-woocommerce' ) ); ?>
									<textarea id="cps_bwc_fields[regacceptpp]" class="uk-textarea" cols="50" rows="5" name="cps_bwc_fields[regacceptpp]"><?php echo stripslashes( $regacceptppValue ); ?></textarea>
									<p class="uk-text-meta"><?php _e( 'HTML tags are allowed', 'cps-better-woocommerce' ); ?></p>
								</div>
							</div>

							<div class="uk-margin">
								<label class="uk-form-label" for="cps_bwc_fields[legalcheckouttitle]"><?php _e( 'Section title on Checkout page', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'Title above the checkbox. If empty, than no title will be displayed.', 'cps-better-woocommerce' ); ?>; pos: right"></span></label>
								<div class="uk-form-controls">
									<?php $legalcheckouttitleValue = isset( $options['legalcheckouttitle'] ) ? $options['legalcheckouttitle'] : __( 'Legal confirmations', 'cps-better-woocommerce' ); ?>
									<input id="cps_bwc_fields[legalcheckouttitle]" class="uk-input" type="text" name="cps_bwc_fields[legalcheckouttitle]" value="<?php echo stripslashes( $legalcheckouttitleValue ); ?>" />
								</div>
							</div>

							<div class="uk-margin">
								<label class="uk-form-label" for="cps_bwc_fields[accepttos]"><?php _e( 'Terms of Service checkbox text (with HTML link, if needed)', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'If empty, than this checkbox will not be displayed.', 'cps-better-woocommerce' ); ?>; pos: right"></span></label>
								<div class="uk-form-controls">
									<?php $accepttosValue = isset( $options['accepttos'] ) ? $options['accepttos'] : esc_attr( __( 'I\'ve read and accept the <a href="/tos/" target="_blank">Terms of Service</a>', 'cps-better-woocommerce' ) ); ?>
									<textarea id="cps_bwc_fields[accepttos]" class="uk-textarea" cols="50" rows="5" name="cps_bwc_fields[accepttos]"><?php echo stripslashes( $accepttosValue ); ?></textarea>
									<p class="uk-text-meta"><?php _e( 'HTML tags are allowed', 'cps-better-woocommerce' ); ?></p>
								</div>
							</div>

							<div class="uk-margin">
								<label class="uk-form-label" for="cps_bwc_fields[acceptpp]"><?php _e( 'Privacy Policy checkbox text on Checkout page (with HTML link, if needed)', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'If empty, than this checkbox will not be displayed.', 'cps-better-woocommerce' ); ?>; pos: right"></span></label>
								<div class="uk-form-controls">
									<?php $acceptppValue = isset( $options['acceptpp'] ) ? $options['acceptpp'] : esc_attr( __( 'I\'ve read and accept the <a href="/privacy-policy/" target="_blank">Privacy Policy</a>', 'cps-better-woocommerce' ) ); ?>
									<textarea id="cps_bwc_fields[acceptpp]" class="uk-textarea" cols="50" rows="5" name="cps_bwc_fields[acceptpp]"><?php echo stripslashes( $acceptppValue ); ?></textarea>
									<p class="uk-text-meta"><?php _e( 'HTML tags are allowed', 'cps-better-woocommerce' ); ?></p>
								</div>
							</div>

							<div class="uk-margin">
								<label class="uk-form-label" for="cps_bwc_fields[beforeorderbuttonmessage]"><?php _e( 'Custom text before Place order button', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'This text will be displayed just above the Place order button on Checkout page. If empty, than no text will be displayed.', 'cps-better-woocommerce' ); ?>; pos: right"></span></label>
								<div class="uk-form-controls">
									<?php $beforeorderbuttonmessageValue = isset( $options['beforeorderbuttonmessage'] ) ? $options['beforeorderbuttonmessage'] : null; ?>
									<textarea id="cps_bwc_fields[beforeorderbuttonmessage]" class="uk-textarea" cols="50" rows="5" name="cps_bwc_fields[beforeorderbuttonmessage]"><?php echo stripslashes( $beforeorderbuttonmessageValue ); ?></textarea>
									<p class="uk-text-meta"><?php _e( 'HTML tags are allowed', 'cps-better-woocommerce' ); ?></p>
								</div>
							</div>

							<div class="uk-margin">
								<label class="uk-form-label" for="cps_bwc_fields[afterorderbuttonmessage]"><?php _e( 'Custom text after Place order button', 'cps-better-woocommerce' ); ?> <span uk-icon="icon: info; ratio: 1" uk-tooltip="title: <?php _e( 'This text will be displayed just under the Place order button on Checkout page. If empty, than no text will be displayed.', 'cps-better-woocommerce' ); ?>; pos: right"></span></label>
								<div class="uk-form-controls">
									<?php $afterorderbuttonmessageValue = isset( $options['afterorderbuttonmessage'] ) ? $options['afterorderbuttonmessage'] : null; ?>
									<textarea id="cps_bwc_fields[afterorderbuttonmessage]" class="uk-textarea" cols="50" rows="5" name="cps_bwc_fields[afterorderbuttonmessage]"><?php echo stripslashes( $afterorderbuttonmessageValue ); ?></textarea>
									<p class="uk-text-meta"><?php _e( 'HTML tags are allowed', 'cps-better-woocommerce' ); ?></p>
								</div>
							</div>

							<hr>

							<div class="uk-margin">
								<label class="uk-form-label"><?php _e( 'Allowed HTML tags', 'cps-better-woocommerce' ); ?></label>
								<div class="uk-form-controls">
									<pre><?php echo allowed_tags(); ?></pre>
								</div>
							</div>

						</div>
						<div class="uk-card-footer uk-background-muted">
							<p><input type="submit" class="uk-button uk-button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>
						</div>
					</div>

				</form>
			</div>
			<div class="uk-width-1-4@l">
				<?php cps_bwc_admin_sidebar(); ?>
			</div>
		</div>
		<div class="uk-margin-bottom" id="bottom"></div>
	</div>
	<?php cps_admin_footer( CPS_BWC_PLUGIN_FILE ); ?>
</div>
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function cps_bwc_fields_validate( $input ) {
	global $returntoshopcartposition_options;
	global $returntoshopcheckoutposition_options;

	$options = get_option( 'cps_bwc_fields' );

	// Checkbox validation.
	$input['huformatfix'] = isset( $input['huformatfix'] ) && $input['huformatfix'] == 1 ? 1 : 0;
	$input['module-checkout'] = isset( $input['module-checkout'] ) && $input['module-checkout'] == 1 ? 1 : 0;
	$input['plusminus'] = isset( $input['plusminus'] ) && $input['plusminus'] == 1 ? 1 : 0;
	$input['updatecart'] = isset( $input['updatecart'] ) && $input['updatecart'] == 1 ? 1 : 0;
	$input['translations'] = isset( $input['translations'] ) && $input['translations'] == 1 ? 1 : 0;
	$input['returntoshop'] = isset( $input['returntoshop'] ) && $input['returntoshop'] == 1 ? 1 : 0;
	$input['loginregistrationredirect'] = isset( $input['loginregistrationredirect'] ) && $input['loginregistrationredirect'] == 1 ? 1 : 0;
	$input['freeshippingnotice'] = isset( $input['freeshippingnotice'] ) && $input['freeshippingnotice'] == 1 ? 1 : 0;
	$input['taxnumber'] = isset( $input['taxnumber'] ) && $input['taxnumber'] == 1 ? 1 : 0;
	$input['legalcheckout'] = isset( $input['legalcheckout'] ) && $input['legalcheckout'] == 1 ? 1 : 0;
	$input['autofillcity'] = isset( $input['autofillcity'] ) && $input['autofillcity'] == 1 ? 1 : 0;
	$input['nocounty'] = isset( $input['nocounty'] ) && $input['nocounty'] == 1 ? 1 : 0;
	$input['nocountry'] = isset( $input['nocountry'] ) && $input['nocountry'] == 1 ? 1 : 0;
	$input['noordercomments'] = isset( $input['noordercomments'] ) && $input['noordercomments'] == 1 ? 1 : 0;
	$input['billingcompanycheck'] = isset( $input['billingcompanycheck'] ) && $input['billingcompanycheck'] == 1 ? 1 : 0;
	$input['companytaxnumberpair'] = isset( $input['companytaxnumberpair'] ) && $input['companytaxnumberpair'] == 1 ? 1 : 0;
	$input['postcodecitypair'] = isset( $input['postcodecitypair'] ) && $input['postcodecitypair'] == 1 ? 1 : 0;
	$input['phoneemailpair'] = isset( $input['phoneemailpair'] ) && $input['phoneemailpair'] == 1 ? 1 : 0;
	$input['regip'] = isset( $input['regip'] ) && $input['regip'] == 1 ? 1 : 0;

	// Our select option must actually be in our array of select options
	if ( !array_key_exists( $input['returntoshopcartposition'], $returntoshopcartposition_options ) )
		$input['returntoshopcartposition'] = 'cartactions';
	if ( !array_key_exists( $input['returntoshopcheckoutposition'], $returntoshopcheckoutposition_options ) )
		$input['returntoshopcheckoutposition'] = 'nocheckout';

	// Say our text option must be safe text with no HTML tags
	$input['returntoshopmessage'] = wp_filter_nohtml_kses( $input['returntoshopmessage'] );
	$input['loginredirecturl'] = wp_filter_nohtml_kses( $input['loginredirecturl'] );
	$input['registrationredirecturl'] = wp_filter_nohtml_kses( $input['registrationredirecturl'] );
	$input['freeshippingnoticemessage'] = wp_filter_nohtml_kses( $input['freeshippingnoticemessage'] );
	$input['legalcheckouttitle'] = wp_filter_nohtml_kses( $input['legalcheckouttitle'] );

	// Say our text/textarea option must be safe text with the allowed tags for posts
	$input['regacceptpp'] = wp_filter_post_kses( $input['regacceptpp'] );
	$input['accepttos'] = wp_filter_post_kses( $input['accepttos'] );
	$input['acceptpp'] = wp_filter_post_kses( $input['acceptpp'] );
	$input['beforeorderbuttonmessage'] = wp_filter_post_kses( $input['beforeorderbuttonmessage'] );
	$input['afterorderbuttonmessage'] = wp_filter_post_kses( $input['afterorderbuttonmessage'] );

	return $input;
}
