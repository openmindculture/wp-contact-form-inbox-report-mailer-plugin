<?php

function openmindculture_cfirm_schedule_callback( $arg ) {
	add_action( 'admin_notices', 'openmindculture_cfirm_admin_notice__callback_success' );

	$openmindculture_cfirm_report = '';

	try {
		require_once( plugin_dir_path( __FILE__ ) . 'generate-report.php' );
	} catch(Exception $ex) {
		$openmindculture_cfirm_report = 'Failed to require mail report function file: ' . $ex->getMessage();
	}

	try {
		$openmindculture_cfirm_report = openmindculture_generate_report ();
	} catch(Exception $ex) {
		$openmindculture_cfirm_report = 'Failed to generate report ' . $ex->getMessage();
	}

	if ( !$openmindculture_cfirm_report || empty( $openmindculture_cfirm_report ) ) {
		$openmindculture_cfirm_report = 'Nothing to report, but the mail interval works.';
		$openmindculture_cfirm_report .= 'Trying alternative database method.<hr>';
		try {
			$openmindculture_cfirm_alternative_report = openmindculture_cfirm_generate_report_using_sql();
			$openmindculture_cfirm_report .= $openmindculture_cfirm_alternative_report;
		} catch(Exception $ex) {
			$openmindculture_cfirm_report = 'Failed to generate report using alternative method: ' . $ex->getMessage();
		}
		echo $openmindculture_cfirm_alternative_report;
	}

	try {
	require_once( plugin_dir_path( __FILE__ ) . 'send-report.php' );
		openmindculture_cfirm_send_report ( $openmindculture_cfirm_report );
	} catch(Exception $ex) {
		echo 'Failed to send report ' . $ex->getMessage();
	}
}

add_action('openmindculture_cfirm_schedule', 'openmindculture_cfirm_schedule_callback', 10, 1);

function openmindculture_cfirm_add_schedule_interval() {
	if ( ! wp_next_scheduled( OPENMINDCULTURE_CFIRM_SCHEDULE_NAME ) ) {
		$openmindculture_cfirm_interval = 'daily';
		if ( !empty( get_option( 'openmindculture_cfirm_interval' ) ) ) {
			$openmindculture_cfirm_interval = get_option( 'openmindculture_cfirm_interval' );
		}
		$openmindculture_cfirm_args = array( '' );
		$openmindculture_cfirm_scheduled = wp_schedule_event( time(), $openmindculture_cfirm_interval, OPENMINDCULTURE_CFIRM_SCHEDULE_NAME, $openmindculture_cfirm_args, true );
		if (!$openmindculture_cfirm_scheduled || gettype($openmindculture_cfirm_scheduled)!=='boolean') {
			echo 'failed to schedule sending, possible error: ' . $openmindculture_cfirm_scheduled;
			add_action( 'admin_notices', 'openmindculture_cfirm_admin_notice__scheduled_error' );
		} else {
			add_action( 'admin_notices', 'openmindculture_cfirm_admin_notice__scheduled_success' );
		}


	}
}

function openmindculture_cfirm_admin_notice__scheduled_success() {
	?>
	<div class="notice notice-success is-dismissible">
		<p><?php _e( 'openmindculture scheduled success', 'sample-text-domain' ); ?></p>
	</div>
	<?php
}

function openmindculture_cfirm_admin_notice__callback_success() {
	?>
	<div class="notice notice-success is-dismissible">
		<p><?php _e( 'openmindculture callback success', 'sample-text-domain' ); ?></p>
	</div>
	<?php
}

function openmindculture_cfirm_admin_notice__callback_error() {
	?>
	<div class="notice notice-error is-dismissible">
		<p><?php _e( 'openmindculture error', 'sample-text-domain' ); ?></p>
	</div>
	<?php
}

function openmindculture_cfirm_admin_notice__scheduled_error() {
	?>
	<div class="notice notice-error is-dismissible">
		<p><?php _e( 'openmindculture error', 'sample-text-domain' ); ?></p>
	</div>
	<?php
}
