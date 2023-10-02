<?php

function openmindculture_send_report () {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/generate-report.php' );
	$report = openmindculture_generate_report ();
	if ( $report && !empty( $report )) {
		// mail $report
	}
}
