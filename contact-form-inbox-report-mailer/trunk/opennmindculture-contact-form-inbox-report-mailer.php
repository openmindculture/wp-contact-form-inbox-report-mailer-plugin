<?php
/**
 * @package	contact-form-inbox-report-mailer
 * @author	Ingo Steinke
 * @version 1.0.0
 *
 * @wordpress-plugin
 * Version: 1.0.0
 * Plugin Name: Contact Form Inbox Report Mailer
 * Text Domain: contact-form-inbox-report-mailer
 * Domain Path: /languages
 * Plugin URI: https://github.com/openmindculture/wp-contact-form-inbox-report-mailer-plugin
 * Description: Contact Form Inbox Report Mailer sends email reports of contact form inbox entries, including possible spam.
 * Short Description: Sends email reports of contact form inbox entries, including possible spam.
 * Author: openmindculture
 * Author URI: https://wordpress.org/support/users/openmindculture/
 * Requires at least: 6.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 */

if ( is_admin() ) {
	define( 'OPENMINDCULTURE_CFIRM_TEXT_DOMAIN', 'contact-form-inbox-report-mailer' );
	define( 'OPENMINDCULTURE_CFIRM_SCHEDULE_NAME', 'openmindculture_cfirm_schedule' );

	require_once plugin_dir_path( __FILE__ ) . 'includes/add-menu-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/add-schedule-interval.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/remove-schedule-interval.php';

	register_activation_hook(
		__FILE__,
		'openmindculture_cfirm_add_schedule_interval'
	);

	register_deactivation_hook(
		__FILE__,
		'openmindculture_cfirm_remove_schedule_interval'
	);

	function openmindculture_cfirm_load_plugin_textdomain() {
		load_plugin_textdomain( 'contact-form-inbox-report-mailer', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	}
	add_action( 'plugins_loaded', 'openmindculture_cfirm_load_plugin_textdomain' );

}
