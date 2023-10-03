<?php
function openmindculture_cfirm_remove_schedule_interval() {
	$openmindculture_cfirm_scheduled_timestamp = wp_next_scheduled( OPENMINDCULTURE_CFIRM_SCHEDULE_NAME );
	wp_unschedule_event( $openmindculture_cfirm_scheduled_timestamp, OPENMINDCULTURE_CFIRM_SCHEDULE_NAME );
}
