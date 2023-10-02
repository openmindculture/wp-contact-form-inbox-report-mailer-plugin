<div class="wrap">
	<div>
		<div class="openmindculture-card">
			<?php
			require_once plugin_dir_path( __FILE__ ) . 'includes/generate-report.php';
			$report = openmindculture_generate_report ();
			if ( $report && !empty( $report )) :
				echo $report;
			endif;
			?>
		</div>
	</div>
</div>
