<?php

function cps_bwc_continue_shopping_message_to_cart() {
	$options = get_option( 'cps_bwc_fields' );
	$returntoshopmessageValue = isset( $options['returntoshopmessage'] ) ? $options['returntoshopmessage'] : __( 'Would you like to continue shopping?', 'cps-better-woocommerce' );
	echo '<div class="woocommerce-message returntoshop">';
	echo $returntoshopmessageValue . ' <a href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '" class="button wc-forward">' . esc_html__( 'Return to shop', 'woocommerce' ) . '</a>';
	echo '</div>';
}

function cps_bwc_continue_shopping_button_to_cart() {
	echo '<a class="button wc-backward returntoshop" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">';
	echo esc_html__( 'Return to shop', 'woocommerce' );
	echo '</a>';
}

$options = get_option( 'cps_bwc_fields' );
$returntoshopcartpositionValue = isset( $options['returntoshopcartposition'] ) ? $options['returntoshopcartposition'] : 'cartactions';
$returntoshopcheckoutpositionValue = isset( $options['returntoshopcheckoutposition'] ) ? $options['returntoshopcheckoutposition'] : 'nocheckout';

if( $returntoshopcartpositionValue == 'beforecarttable' )
	add_action( 'woocommerce_before_cart_table', 'cps_bwc_continue_shopping_message_to_cart' );
if( $returntoshopcartpositionValue == 'aftercarttable' )
	add_action( 'woocommerce_after_cart_table', 'cps_bwc_continue_shopping_message_to_cart' );
if( $returntoshopcartpositionValue == 'cartactions' )
	add_action( 'woocommerce_cart_actions', 'cps_bwc_continue_shopping_button_to_cart' );
if( $returntoshopcartpositionValue == 'proceedtocheckout' )
	add_action( 'woocommerce_proceed_to_checkout', 'cps_bwc_continue_shopping_button_to_cart', 999 );
if( $returntoshopcheckoutpositionValue == 'beforecheckoutform' )
	add_action( 'woocommerce_before_checkout_form', 'cps_bwc_continue_shopping_message_to_cart', 0 );
if( $returntoshopcheckoutpositionValue == 'aftercheckoutform' )
	add_action( 'woocommerce_after_checkout_form', 'cps_bwc_continue_shopping_message_to_cart' );
