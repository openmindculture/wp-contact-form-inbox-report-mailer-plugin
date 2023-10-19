<?php

function openmindculture_generate_report() {
	$report = '';
	global $wpdb;

	$openmindculture_cfirm_range = '-2 day';
	if ( !empty( get_option( 'openmindculture_cfirm_range' ) ) ) {
		$openmindculture_cfirm_range = get_option( 'openmindculture_cfirm_range' );
	}

	$date_from = date('Y-m-d H:i', strtotime( $openmindculture_cfirm_range ));
	$query = "SELECT * FROM {$wpdb->prefix}posts";
	$query .= " WHERE ";
	$query .= "post_type = 'flamingo_inbound'";
	$query .= " AND ";
	$query .= "post_date > '$date_from'";
	$query .= " AND ";
	$query .= "post_status IN (";
	$query .= " 'publish',";
	$query .= " 'spam',";
	$query .= " 'flamingo-spam',";
	$query .= ")";
	$query .= " ORDER BY date DESC";

	$results = $wpdb->get_results( $query, OBJECT );

	$report .= "using query: " . $query . "<br><hr>";

	if ( sizeof( $results ) ) :
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
		$report .= '  </tr>';

		foreach ( (array) $results as $post_item ) {
			$item_meta_subject     = get_post_meta( $post_item->ID, '_subject',     true );
			$item_meta_from        = get_post_meta( $post_item->ID, '_from',        true );

			$report .= '  <tr>';
			$report .= '    <td>';
			$report .= $post_item->post_date;
			get_the_date('', $post_item->ID);
			$report .= '    </td>';
			$report .= '    <td>';
			if ( $post_item->post_status == 'spam' || $post_item->post_status == 'flamingo-spam' ) :
				$report .= '<b>spam</b>';
			elseif ( $post_item->post_status == 'publish' ) :
				$report .= 'sent';
			endif;
			$report .= '    </td>';
			$report .= '    <td>';
			$report .= '<a href="';
			$report .= get_site_url();
			$report .= '/wp-admin/admin.php?page=flamingo_inbound&post=';
			$report .= $post_item->ID;
			$report .= '&action=edit">view</a>';
			$report .= '    </td>';

			$report .= '    <td>';
			if ( !empty( $item_meta_subject ) ) {
				$report .= $item_meta_subject;
			} else {
				$report .= '-';
			}

			$report .= '    </td>';
			$report .= '    <td>';

			if ( !empty( $item_meta_from ) ) {
				$report .= $item_meta_from;
			} else {
				$report .= '-';
			}

			$report .= '    </td>';
			$report .= '  </tr>';
		}

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


function openmindculture_cfirm_generate_report_using_sql() {
	$report = '';
	return $report;
}
