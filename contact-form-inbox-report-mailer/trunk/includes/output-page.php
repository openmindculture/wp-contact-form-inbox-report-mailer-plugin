<?php

echo '<div class="openmindculture__cfirm__wrap">';

echo '<br>';

echo '  <div class="openmindculture__cfirm__card">';
echo 'Next scheduled email report: ';
if (wp_next_scheduled( OPENMINDCULTURE_CFIRM_SCHEDULE_NAME )) {
	$openmindculture_cfirm_next_scheduled_time = wp_next_scheduled( OPENMINDCULTURE_CFIRM_SCHEDULE_NAME );
	echo get_date_from_gmt( date('Y-m-d H:i:s', $openmindculture_cfirm_next_scheduled_time ) );
	echo ' (server time: ';
	echo get_date_from_gmt( date('Y-m-d H:i:s' ) );
	echo ')';
} else {
	echo 'not scheduled. (Re)activate the plugin to (re)schedule!';
}
echo '  </div>';

echo '  <div class="openmindculture__cfirm__card">';
			require_once( plugin_dir_path( __FILE__ ) . 'generate-report.php' );
			$report = openmindculture_generate_report ();
			if ( $report && !empty( $report )) :
				echo $report;
			endif;
echo '  </div>';

echo '</div>';
