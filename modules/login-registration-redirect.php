<?php

function cps_bwc_login_redirect( $redirect, $user ) {
	$options = get_option( 'cps_bwc_fields' );
	$loginredirecturlValue = isset( $options['loginredirecturl'] ) ? $options['loginredirecturl'] : wc_get_page_permalink( 'shop' );

	$redirect_page_id = url_to_postid( $redirect );
	$checkout_page_id = wc_get_page_id( 'checkout' );

	if( $redirect_page_id == $checkout_page_id ) {
		return $redirect;
	}

	if( $loginredirecturlValue == '' ) {
		return $redirect;
	} else {
		return $loginredirecturlValue;
	}
}
add_filter( 'woocommerce_login_redirect', 'cps_bwc_login_redirect', 10, 2 );

function cps_bwc_register_redirect( $var ) {
	$options = get_option( 'cps_bwc_fields' );
	$registrationredirecturlValue = isset( $options['registrationredirecturl'] ) ? $options['registrationredirecturl'] : wc_get_page_permalink( 'shop' );

	if( $registrationredirecturlValue == '' ) {
		return $var;
	} else {
		return $registrationredirecturlValue;
	}
}
add_filter( 'woocommerce_registration_redirect', 'cps_bwc_register_redirect', 10, 1 );
