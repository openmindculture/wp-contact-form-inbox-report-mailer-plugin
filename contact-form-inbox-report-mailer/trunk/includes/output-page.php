<?php

echo '<div class="wrap">';
echo '  <div class="openmindculture-card">';
			require_once( plugin_dir_path( __FILE__ ) . 'generate-report.php' );
			$report = openmindculture_generate_report ();
			if ( $report && !empty( $report )) :
				echo $report;
			// TODO only testing: TODO remove!!
				require_once( plugin_dir_path( __FILE__ ) . 'send-report.php' );
				openmindculture_cfirm_send_report ( $report );
			endif;
echo '  </div>';
echo '</div>';
