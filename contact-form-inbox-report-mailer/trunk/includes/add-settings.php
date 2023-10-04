<?php

function openmindculture_cfirm_settings_init() {
	add_settings_section(
		'openmindculture_cfirm_settings_section', // section ID
		'Contact Form Inbox Report Mailer', // display title (default englisch)
		'openmindculture_cfirm_before_settings_callback', // callback function to be called when opening section
		'general' // settings page ID (where to render: default general settings page)
	);
	add_settings_field(
		'openmindculture_cfirm_interval', // option field ID
		'Interval between mailings', // display title (default englisch)
		'openmindculture_cfirm_render_input_callback_interval', // generic input field renderer
		'general', // settings page ID (where to render: default general settings page)
		'openmindculture_cfirm_settings_section', // section inside settings page
		array( // arguments passed to generic input field renderer
			'openmindculture_cfirm_interval' // option field ID
		)
	);
	add_settings_field(
		'openmindculture_cfirm_range', // option field ID
		'Date Range to report', // display title (default englisch)
		'openmindculture_cfirm_render_input_callback_range', // generic input field renderer
		'general', // settings page ID (where to render: default general settings page)
		'openmindculture_cfirm_settings_section', // section inside settings page
		array( // arguments passed to generic input field renderer
			'openmindculture_cfirm_range' // option field ID
		)
	);
	register_setting(
		'general', // settings page ID (where to render: default general settings page)
		'openmindculture_cfirm_interval', // id/Name of option
		'esc_attr' // validation callback (built-in esc_attr)
	);
	register_setting(
		'general', // settings page ID (where to render: default general settings page)
		'openmindculture_cfirm_range', // id/Name of option
		'esc_attr' // validation callback (built-in esc_attr)
	);
}
add_action('admin_init', 'openmindculture_cfirm_settings_init');

function openmindculture_cfirm_render_input_callback_interval($args) {
	echo '<select name="' . $args[0] . '">';
	echo '<option value="daily" "' . selected( get_option('myplugin_admin_bar'), 'daily' ) . '">daily</option>';
	echo '<option value="twicedaily" "' . selected( get_option('myplugin_admin_bar'), 'twicedaily' ) . '">twicedaily</option>';
	echo '<option value="hourly" "' . selected( get_option('myplugin_admin_bar'), 'hourly' ) . '">hourly</option>';
	echo '</select>';
}

function openmindculture_cfirm_render_input_callback_range($args) {
	echo '<select name="' . $args[0] . '">';
	echo '<option value="-1 week" "' . selected( get_option('myplugin_admin_bar'), '-1 week' ) . '">1 week</option>';
	echo '<option value="-3 day" "' . selected( get_option('myplugin_admin_bar'), '-3 day' ) . '">3 days</option>';
	echo '<option value="-2 day" "' . selected( get_option('myplugin_admin_bar'), '-2 day' ) . '">2 days</option>';
	echo '<option value="-1 day" "' . selected( get_option('myplugin_admin_bar'), '-1 day' ) . '">1 day</option>';
	echo '<option value="-20 hour" "' . selected( get_option('myplugin_admin_bar'), '-1 day' ) . '">20 hours</option>';
	echo '</select>';
}

function openmindculture_cfirm_before_settings_callback() { // above settings section:
	?>
		<p id="openmindculture-cfirm-settings">
			<?php
			_e( 'Do not rely on interval times on pages with low traffic, as WordPress task schedule relies on regular page visits!',
				OPENMINDCULTURE_CFIRM_TEXT_DOMAIN );
			?>
			<?php
				_e( 'After changing schedule settings, (re)activate the plugin to (re)schedule if necessary.',
					OPENMINDCULTURE_CFIRM_TEXT_DOMAIN );
			?>
		</p>
	<?php
}
