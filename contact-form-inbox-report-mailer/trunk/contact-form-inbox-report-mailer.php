<?php
/**
 * @package	contact-form-inbox-report-mailer
 * @author	Ingo Steinke
 * @version 0.0.1
 *
 * @wordpress-plugin
 * Plugin Name: Contact Form Inbox Report Mailer
 * Text Domain: contact-form-inbox-report-mailer
 * Domain Path: /languages
 * Plugin URI: https://github.com/openmindculture/wp-contact-form-inbox-report-mailer-plugin
 * Description: Contact Form Inbox Report Mailer sends email reports of contact form inbox entries, including possible spam.
 * Short Description: Sends email reports of contact form inbox entries, including possible spam.
 * Version: 0.0.1
 * Author: openmindculture
 * Author URI: https://wordpress.org/support/users/openmindculture/
 * Requires at least: 6.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 */

if (is_admin()) {

	// - receive = send emails or other notifications
	//- regular = using a scheduler like wp-cron
	//- reports = output a human-readable list
	//- about inbound messages = query Flamingo database

	function openmindculture_contactFormInboxReportMailer()
	{
		$messages = [];
		global $wp_version;
		add_filter( 'cron_schedules', 'example_add_cron_interval' );
		function example_add_cron_interval( $schedules ) {
			$schedules['five_seconds'] = array(
				'interval' => 5,
				'display'  => esc_html__( 'Every Five Seconds' ), );
			return $schedules;
		}
	}

}
