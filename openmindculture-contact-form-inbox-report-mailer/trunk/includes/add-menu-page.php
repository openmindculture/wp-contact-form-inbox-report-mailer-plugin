<?php

function openmindculture_cfirm_outputpage () {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/output-page.php' );
}
function openmindculture_cfirm_add_menu() {
	add_menu_page(
		'Contact Form Inbox Report Mailer', // page title
		'Contact Form Inbox Report Mailer', // menu title
		'publish_posts',                    // capability level
		'openmindculture-openmindculture-contact-form-inbox-report-mailer', // text domain
		'openmindculture_cfirm_outputpage'   // callback
	);
}

add_action( 'admin_menu', 'openmindculture_cfirm_add_menu' );
