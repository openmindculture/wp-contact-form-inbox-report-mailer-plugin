<?php

function openmindculture_generate_report() {
	$report = '';
	$openmindculture_cfirm_range = '-2 day';
	if ( !empty( get_option( 'openmindculture_cfirm_range' ) ) ) {
		$openmindculture_cfirm_range = get_option( 'openmindculture_cfirm_range' );
	}

	$args = array(
		'post_type'    => 'flamingo_inbound',
		'post_status' => array(
			'publish',
			'spam',
			'flamingo-spam'
		),
		'date_query'   => array(
			'after'    => $openmindculture_cfirm_range,
			'column' => 'post_date',
		),
		'orderby'        => array( 'date' ),
		'order'          => 'DESC',
		'posts_per_page' => -1,
	);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) :
		$report .= '<h1>';
		$report .= esc_html(
			'Contact Form Inbox Report',
			'contact-form-inbox-report-mailer'
		);
		$report .= '</h1>';

		$report .= esc_html(
			'Possible spam has not been sent to your email inbox!',
			OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
		);
		$report .= '<br>';
		$report .= '<br>';

		$report .= '<table>';
		$report .= '  <tr>';
		$report .= '    <th>Date</th>';
		$report .= '    <th>Status</th>';
		$report .= '    <th>Link</th>';
		$report .= '    <th>Subject</th>';
		$report .= '    <th>From</th>';
		$report .= '  <tr>';

		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			$item_meta_subject     = get_post_meta( get_the_ID(), '_subject',     true );
			$item_meta_from        = get_post_meta( get_the_ID(), '_from',        true );

			$report .= '  <tr>';

			$report .= '    <td>';
			$report .= get_the_date();
			$report .= '    </td>';
			$report .= '    <td>';
			if ( get_post_status() == 'spam' || get_post_status() == 'flamingo-spam' ) :
				$report .= '<b>spam</b>';
			elseif ( get_post_status() == 'publish' ) :
				$report .= 'sent';
			endif;
			$report .= '    </td>';
			$report .= '    <td>';
			$report .= '<a href="';
			$report .= get_site_url();
			$report .= '/wp-admin/admin.php?page=flamingo_inbound&post=';
			$report .= get_the_ID();
			$report .= '&action=edit">view</a>';
			$report .= '    </td>';

			$report .= '    <td>';

			$report .= $item_meta_subject;
			if ( empty( $item_meta_subject ) ) :
				$report .= '-';
			endif;

			$report .= '    </td>';
			$report .= '    <td>';

			$report .= esc_html( $item_meta_from );
			if ( empty( $item_meta_from ) ) :
				$report .= '-';
			endif;

			$report .= '    </td>';
			$report .= '  </tr>';
		endwhile;
		$report .= '</table>';
		$report .= '<br>';
		$report .= '<br>';
	endif;
	if ( !empty($report) ) {
		$report .= esc_html(
			'This message was generated automatically ',
			OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
		);
		$report .= esc_html(
			'by the Contact Form Inbox Report Mailer ',
			OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
		);
		$report .= esc_html(
			'WordPress plugin',
			OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
		);
		$report .= ' ' . OPENMINDCULTURE_CFIRM_PLUGIN_VERSION;
		$report .= ' (current user ID: ' . get_current_user_id() . ')';
		$report .= '.';
		$report .= '<br>';

		$report .= '<br>';
		$report .= esc_html(
			'To unsubscribe, edit the',
			OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
		);

		$report .= ' <a href="' . get_site_url() . '/wp-admin/options-general.php#openmindculture-cfirm-settings">';
		$report .= esc_html(
			'configuration',
			OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
		);
		$report .= '</a> ';

		$report .= esc_html(
			'or disable the plugin ',
			OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
		);

		$report .= '<a href="' . get_site_url() . '/wp-admin/plugins.php">';
		$report .= esc_html(
			'here',
			OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
		);
		$report .= ':';
		$report .= '<br>';
		$report .= get_site_url() . '/wp-admin/plugins.php';
		$report .= '</a>';

		$report .= '<br>';
	}
	return $report;
}
