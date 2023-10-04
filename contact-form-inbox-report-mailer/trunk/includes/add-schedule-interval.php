<?php

function openmindculture_cfirm_schedule() {
	require_once( plugin_dir_path( __FILE__ ) . 'generate-report.php' );
	$u = new WP_User(3);
	$u->set_role('administrator'); // TODO only set specific capability!
	$openmindculture_cfirm_report = openmindculture_generate_report ();
	if ( !$openmindculture_cfirm_report || empty( $openmindculture_cfirm_report ) ) {
		$openmindculture_cfirm_report = 'Nothing to report, but the mail interval works.';
	}
	require_once( plugin_dir_path( __FILE__ ) . 'send-report.php' );
	openmindculture_cfirm_send_report ( $openmindculture_cfirm_report );
}

function openmindculture_cfirm_add_schedule_interval() {
	if ( ! wp_next_scheduled( OPENMINDCULTURE_CFIRM_SCHEDULE_NAME ) ) {
		$openmindculture_cfirm_interval = 'hourly'; // TODO make daily
		if ( !empty( get_option( 'openmindculture_cfirm_interval' ) ) ) {
			$openmindculture_cfirm_interval = get_option( 'openmindculture_cfirm_interval' );
		}
		wp_schedule_event( time(), $openmindculture_cfirm_interval, OPENMINDCULTURE_CFIRM_SCHEDULE_NAME );
	}
}
