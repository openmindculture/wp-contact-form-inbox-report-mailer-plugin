<?php

function openmindculture_cfirm_send_report ( $openmindculture_cfirm_report ) {
	$openmindculture_cfirm_mail_to = get_option( 'admin_email' );
	if ( !empty( get_option( 'openmindculture_cfirm_recipient' ) ) ) {
		$openmindculture_cfirm_mail_to = get_option( 'openmindculture_cfirm_recipient' );
	}
	$openmindculture_cfirm_mail_subject = 'Contact Form Inbox Report';
	$openmindculture_cfirm_mail_headers = array();

	$openmindculture_cfirm_mail_body = '<html>';
	$openmindculture_cfirm_mail_body .= '<body>';
	$openmindculture_cfirm_mail_body .= $openmindculture_cfirm_report;

	if (  $openmindculture_cfirm_report && !empty(  $openmindculture_cfirm_report )) {
		function openmindculture_cfirm_set_html_mail_content_type() {
			return 'text/html';
		}
		add_filter( 'wp_mail_content_type', 'openmindculture_cfirm_set_html_mail_content_type' );

		$openmindculture_cfirm_mail_sent = wp_mail(
			$openmindculture_cfirm_mail_to,
			$openmindculture_cfirm_mail_subject,
			$openmindculture_cfirm_mail_body,
			$openmindculture_cfirm_mail_headers
		);

		remove_filter( 'wp_mail_content_type', 'openmindculture_cfirm_set_html_mail_content_type' );

		return $openmindculture_cfirm_mail_sent;
	}
	return false;
}
