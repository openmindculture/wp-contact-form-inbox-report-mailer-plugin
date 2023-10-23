<?php

echo '<div class="openmindculture__cfirm__wrap">';

echo '<br>';

echo '  <div class="openmindculture__cfirm__card">';
			require_once( plugin_dir_path( __FILE__ ) . 'generate-report.php' );
			$report = openmindculture_generate_report ();
			if ( $report && !empty( $report )) :
				echo $report;
			endif;
echo '  </div>';

require_once( plugin_dir_path( __FILE__ ) . 'add-schedule-interval.php' );
do_action( 'openmindculture_cfirm_schedule' );

echo '</div>';
