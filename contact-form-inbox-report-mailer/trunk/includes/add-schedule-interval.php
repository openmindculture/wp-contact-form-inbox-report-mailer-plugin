<?php

function openmindculture_cfirm_schedule() {
	require_once( plugin_dir_path( __FILE__ ) . 'generate-report.php' );
	$openmindculture_cfirm_report = '';

	try {
		$u = new WP_User(3);
		$u->set_role('administrator'); // TODO only set specific capability!
	} catch(Exception $ex) {
		$openmindculture_cfirm_report = 'Failed to set user role for mail report ' . $ex->getMessage();
	}

	try {
		$openmindculture_cfirm_report = openmindculture_generate_report ();
	} catch(Exception $ex) {
		$openmindculture_cfirm_report = 'Failed to generate report ' . $ex->getMessage();
	}

	if ( !$openmindculture_cfirm_report || empty( $openmindculture_cfirm_report ) ) {
		$openmindculture_cfirm_report = 'Nothing to report, but the mail interval works.';
	}
	require_once( plugin_dir_path( __FILE__ ) . 'send-report.php' );
	openmindculture_cfirm_send_report ( $openmindculture_cfirm_report );
}

function openmindculture_cfirm_add_schedule_interval() {
	if ( ! wp_next_scheduled( 'openmindculture_cfirm_schedule' ) ) {
		$openmindculture_cfirm_interval = 'daily';
		if ( !empty( get_option( 'openmindculture_cfirm_interval' ) ) ) {
			$openmindculture_cfirm_interval = get_option( 'openmindculture_cfirm_interval' );
		}
		wp_schedule_event( time(), $openmindculture_cfirm_interval, 'openmindculture_cfirm_schedule' );
	}
}
