<?php
function openmindculture_cfirm_remove_schedule_interval() {
	$openmindculture_cfirm_scheduled_timestamp = wp_next_scheduled( 'openmindculture_cfirm_schedule' );
	wp_unschedule_event( $openmindculture_cfirm_scheduled_timestamp, 'openmindculture_cfirm_schedule' );
}
