<?php

function openmindculture_cfirm_schedule() {
	require_once( plugin_dir_path( __FILE__ ) . 'generate-report.php' );
	$openmindculture_cfirm_report = openmindculture_generate_report ();
	if ( !$openmindculture_cfirm_report || empty( $openmindculture_cfirm_report ) ) {
		$openmindculture_cfirm_report = 'Nothing to report, but the mail interval works.';
	}
	require_once( plugin_dir_path( __FILE__ ) . 'send-report.php' );
	openmindculture_cfirm_send_report ( $openmindculture_cfirm_report );
}

function openmindculture_cfirm_add_schedule_interval() {
	if ( ! wp_next_scheduled( OPENMINDCULTURE_CFIRM_SCHEDULE_NAME ) ) {
		wp_schedule_event( time(), 'hourly', OPENMINDCULTURE_CFIRM_SCHEDULE_NAME ); // TODO make daily
	}
}
