<?php

// Be sure to add your schedule to the passed array, as shown in the example. If you simply return
// only your own schedule array then you will potentially delete schedules created by other plugins.
function openmindculture_cfirm_add_intervals( $schedules ) {

	require_once plugin_dir_path( __FILE__ ) . 'includes/send-report.php';

	// add a 'weekly' interval
	$schedules['weekly'] = array(
		'interval' => 604800,
		'display' => __('Once Weekly')
	);
	$schedules['monthly'] = array(
		'interval' => 2635200,
		'display' => __('Once a month')
	);
	return $schedules;
}
