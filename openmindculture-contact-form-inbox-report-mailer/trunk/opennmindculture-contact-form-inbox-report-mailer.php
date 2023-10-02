<?php
/**
 * @package	openmindculture-openmindculture-contact-form-inbox-report-mailer
 * @author	Ingo Steinke
 * @version 0.0.1
 *
 * @wordpress-plugin
 * Plugin Name: Contact Form Inbox Report Mailer
 * Text Domain: openmindculture-openmindculture-contact-form-inbox-report-mailer
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

if ( is_admin() ) {

	// - receive = send emails or other notifications
	//- regular = using a scheduler like wp-cron
	//- reports = output a human-readable list
	//- about inbound messages = query Flamingo database

	require_once plugin_dir_path( __FILE__ ) . 'includes/add-menu-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/add-schedule-interval.php';



	function openmindculture_cfirm_contact_form_inbox_report_mailer() {
        add_filter( 'cron_schedules', 'openmindculture_cfirm_add_intervals' );
    }

	function openmindculture_cfirm_load_plugin_textdomain() {
		load_plugin_textdomain( 'openmindculture-openmindculture-contact-form-inbox-report-mailer', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	}
	add_action( 'plugins_loaded', 'openmindculture_cfirm_load_plugin_textdomain' );

}
