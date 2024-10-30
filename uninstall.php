<?php

// if uninstall.php is not called by WordPress, die.
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) die;

delete_option( 'cps_bwc_fields' );
delete_option( 'pand-' . md5( 'cps-bwc-notice-welcome' ) );
