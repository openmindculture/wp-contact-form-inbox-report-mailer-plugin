<?php

function openmindculture_generate_report() {
	$report = '';

	$args = array(
		'post_type'    => 'flamingo_inbound',
		'date_query'   => array(
			'after'    => '-30 day', // TODO change to '-2 day' in production
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
			'Contact Form Inbox Report Mailer',
			'contact-form-inbox-report-mailer'
		);
		$report .= '</h1>';
		$report .= '<table>';
		$report .= '  <tr>';
		$report .= '    <th>Subject</th>';
		$report .= '    <th>From</th>';
		$report .= '    <th>Date</th>';
		$report .= '    <th>Spam?</th>';
		$report .= '    <th></th>';
		$report .= '  <tr>';

		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			$item_meta_subject     = get_post_meta( get_the_ID(), '_subject',     true );
			$item_meta_from        = get_post_meta( get_the_ID(), '_from',        true );
			$item_meta_from_email  = get_post_meta( get_the_ID(), '_from_email',  true );
			$item_meta_post_status = get_post_meta( get_the_ID(), '_post_status', true );

			$report .= '  <tr>';
			$report .= '    <td>';

			$report .= $item_meta_subject;

			$report .= '    </td>';
			$report .= '    <td>';

			$report .= esc_html( $item_meta_from );

			$report .= '    </td>';
			$report .= '    <td>';
			$report .= get_the_date();
			$report .= '    </td>';
			$report .= '    <td>';
			if (strpos( $item_meta_post_status, 'spam' ) !== false) :
				$report .= '      <b>spam?</b>';
			endif;
			$report .= '    </td>';
			$report .= '    <td>';
			$report .= '<a href="';
			$report .= get_site_url();
			$report .= '/wp-admin/admin.php?page=flamingo_inbound&post=';
			$report .= get_the_ID();
			$report .= '&action=edit">view</a>';
			$report .= '    </td>';
			$report .= '  </tr>';
		endwhile;
		$report .= '</table>';
		$report .= '<br>';
		$report .= '<br>';
	endif;
	if ( !empty($report) ) {
		$report .= esc_html(
			'Automatic report sent from ',
			OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
		);
		$report .= get_site_url();
		$report .= ' ';
		$report .= esc_html(
			'by the plugin Contact Form Inbox Report Mailer',
			OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
		);
		$report .= '.<br>';
		$report .= esc_html(
			'Disable the plugin to unsubscribe.',
			OPENMINDCULTURE_CFIRM_TEXT_DOMAIN
		);
	}
	return $report;
}
