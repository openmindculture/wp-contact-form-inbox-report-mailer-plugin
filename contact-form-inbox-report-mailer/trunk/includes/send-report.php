<?php

function openmindculture_cfirm_send_report ( $openmindculture_cfirm_report ) {
	$openmindculture_cfirm_mail_to = get_option( 'admin_email' );
	if ( !empty( get_option( 'openmindculture_cfirm_recipient' ) ) ) {
		$openmindculture_cfirm_mail_to = get_option( 'openmindculture_cfirm_recipient' );
		echo 'Setting recipient to configured option.';
	} else {
		echo 'No configured reicpient option found.';
	}
	echo 'Recipient: ' . $openmindculture_cfirm_mail_to;
	$openmindculture_cfirm_mail_subject = 'Contact Form Inbox Report';
	if ( !empty(get_bloginfo('name')) ) {
		$openmindculture_cfirm_mail_subject .= ': ' . get_bloginfo('name');
	}
	$openmindculture_cfirm_mail_headers = array();

	$openmindculture_cfirm_mail_body = '<html>';
	$openmindculture_cfirm_mail_body .= '<body>';
	$openmindculture_cfirm_mail_body .= $openmindculture_cfirm_report;

	if (  $openmindculture_cfirm_report && !empty(  $openmindculture_cfirm_report )) {
		echo 'Ready to send mail.<br>';
		echo 'mail_to: ' . $openmindculture_cfirm_mail_to . '<br>';
		echo 'subject: ' . $openmindculture_cfirm_mail_subject . '<br>';
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
        if ($openmindculture_cfirm_mail_sent) {
			echo ' - wp_mail returned true : ' . $openmindculture_cfirm_mail_sent . ' - ';
        } else {
	        echo ' - wp_mail returned FALSE : ' . $openmindculture_cfirm_mail_sent . ' - ';
        }
		return $openmindculture_cfirm_mail_sent;
	} else {
		echo 'Not enough data to send mail.';
	}
	return false;
}
