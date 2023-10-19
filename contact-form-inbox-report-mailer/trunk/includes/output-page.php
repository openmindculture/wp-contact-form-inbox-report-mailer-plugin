<?php

echo '<div class="openmindculture__cfirm__wrap">';

echo '<br>';

echo '  <div class="openmindculture__cfirm__card">';
echo esc_html(
	'Next scheduled email report: ',
	OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
);
if (wp_next_scheduled( 'openmindculture_cfirm_schedule' )) {
	$openmindculture_cfirm_next_scheduled_time = wp_next_scheduled( 'openmindculture_cfirm_schedule' );
	echo get_date_from_gmt( date('Y-m-d H:i:s', $openmindculture_cfirm_next_scheduled_time ) );
	echo ' (';
	echo esc_html(
		'server time',
		OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
	);
	echo ' ';
	echo get_date_from_gmt( date('Y-m-d H:i:s' ) );
	echo ')';
} else {
	echo esc_html(
		'not scheduled. (Re)activate the plugin to (re)schedule!',
		OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
	);
}
echo '  </div>';

echo '  <div class="openmindculture__cfirm__card">';
			require_once( plugin_dir_path( __FILE__ ) . 'generate-report.php' );
			$report = openmindculture_generate_report ();
			if ( $report && !empty( $report )) :
				echo $report;
			endif;
echo '  </div>';

echo '<div>DEBUG: execute `openmindculture_cfirm_schedule` callback to mail report.</div>';
require_once( plugin_dir_path( __FILE__ ) . 'add-schedule-interval.php' );
do_action( 'openmindculture_cfirm_schedule' );

echo '</div>';
