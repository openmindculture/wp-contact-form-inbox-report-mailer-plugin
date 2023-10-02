<?php

function openmindculture_generate_report () {
  $report = '';
  // WP Query
	// post type flamingo_inbound
	// date >= -2d
	//
	// get
	// from
	// subject
	// date
	// post_status
	//
	// order by data, post_status
	//

	?>
	<h1><?php _e('Contact Form Inbox Report Mailer', 'openmindculture-openmindculture-contact-form-inbox-report-mailer'); ?></h1>
	<table>
		<?php 	// loop
		?>
		<tr>
			<td><?php  esc_html( get_the_subject ); /* TODO get custom property */ ?></td>
			<td><?php  esc_html( get_the_from ); /* TODO get custom property */ ?></td>
			<td><?php  esc_html( get_the_date ); /* TODO get custom property */ ?></td>
			<td><?php
			if ( get_the_post_status === 'spam' ) :
				echo '<b>spam?</b>';
			endif;
				?></td>
		</tr>
		<?php
		?>
	</table>
	<?php _e('Automatic report sent from ', 'openmindculture-openmindculture-contact-form-inbox-report-mailer'); ?>
	<!-- TODO current wordpress url -->
	by the plugin Contact Form Inbox Report Mailer <!-- TODO add plugin version -->
	<?php _e('Disable the plugin to unsubscribe.', 'openmindculture-openmindculture-contact-form-inbox-report-mailer'); ?>

	<?php
    return report;
}
