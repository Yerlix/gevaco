<?php
/**
 * Register meta boxes
 *
 * @return void
 */
function contact_register_meta_boxes()
{
	$meta_boxes = contact_metabox();

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( ! class_exists( 'RW_Meta_Box' ) )
		return;

	// Register meta boxes only for some posts/pages
	if ( ! contact_maybe_include() )
		return;

	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}

add_action( 'admin_init', 'contact_register_meta_boxes' );

/**
 * Check if meta boxes is included
 *
 * @return bool
 */
function contact_maybe_include()
{
	// Include in back-end only
	if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN )
		return false;

	// Always include for ajax
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
		return true;

	// Check for post IDs
	if ( isset( $_GET['post'] ) )
		$post_id = $_GET['post'];
	elseif ( isset( $_POST['post_ID'] ) )
		$post_id = $_POST['post_ID'];
	else
		$post_id = false;

	$post_id = (int) $post_id;

	// Check for page template
	$checked_templates = array( 'page-contact.php' );

	$template = get_post_meta( $post_id, '_wp_page_template', true );
	if ( in_array( $template, $checked_templates ) )
		return true;

	// If no condition matched
	return false;
}

/**
* Creates metaboxes
*
* @return metabox
*/
function contact_metabox()
{
	$prefix = 'ge_';
	$meta_boxes   = array();
	$meta_boxes[] = array(
		'id' => 'sidebar',
		'title' => __( 'Extra informatie', 'rwmb' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			// -------------------------------
			// Hoofdtitel van de sidebar
			// -------------------------------
			array(
					'name'  => __( 'Boven titel:', 'rwmb' ),
					'id'    => "{$prefix}side_subtitle",
					'desc'  => __( 'Titeltje boven hooofdtitel', 'rwmb' ),
					'type'  => 'text',
					'std'   => __( 'Meer weten?', 'rwmb' ),
					'clone' => false,
				),
			// adres
			array(
		        'type' => 'heading',
		        'name' => __( 'Titel van de zijbalk', 'rwmb' ),
		        'id'   => 'side_heading'
		    ),
	    array(
				'name'  => __( 'Titel:', 'rwmb' ),
				'id'    => "{$prefix}side_title",
				'desc'  => __( 'Titel van de zijbalk', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( 'Nuttige info', 'rwmb' ),
				'clone' => false,
			),

			// -------------------------------
			// Gegevens maatschappelijke zetel
			// -------------------------------

			// adres
			array(
		        'type' => 'heading',
		        'name' => __( 'Gegevens van de maatschappelijke zetel', 'rwmb' ),
		        'id'   => 'mz_heading'
		    ),
		    array(
				'name'  => __( 'Titel:', 'rwmb' ),
				'id'    => "{$prefix}mz_title",
				'desc'  => __( 'Titel boven dit blok', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( 'Bouwbedrijf GEVACO bvba', 'rwmb' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'Maatschappelijke Zetel van:', 'rwmb' ),
				'id'    => "{$prefix}mz_name",
				'desc'  => __( 'Naam van het bedrijf', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( 'Bouwbedrijf GEVACO bvba', 'rwmb' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'Maatschappelijke Zetel adres:', 'rwmb' ),
				'id'    => "{$prefix}mz_address",
				'desc'  => __( 'Straat en huisnummer van de zetel', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( 'Diepestraat 79', 'rwmb' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'Maatschappelijke Zetel gemeente:', 'rwmb' ),
				'id'    => "{$prefix}mz_town",
				'desc'  => __( 'Postcode en gemeente, eventueel het land', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( 'B-2400 Mol' ),
				'clone' => false,
			),

			// Google maps embedding
		    array(
		        'type' => 'heading',
		        'name' => __( 'Google maps', 'rwmb' ),
		        'id'   => 'map_heading'
		    ),
		    array(
		        'id'            => 'address-one',
		        'name'          => __( 'Address', 'rwmb' ),
		        'type'          => 'text',
		    ),
		    array(
		        'id'            => 'loc',
		        'name'          => __( 'Location', 'rwmb' ),
		        'type'          => 'map',
		        'style'         => 'width: 500px; height: 250px',
		        'address_field' => 'address-one',                    // Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)
		    ),
		    array(
		    	'name'  => __( 'Extra infomatie:', 'rwmb' ),
				'id'    => "{$prefix}map_extra",
				'desc'  => __( 'Extra informatie in het kader op de kaart', 'rwmb' ),
				'type'  => 'textarea',
				'std'   => '',
				'clone' => false,
		    ),

		    // Contact gegevens
		    array(
		        'type' => 'heading',
		        'name' => __( 'Contact gegevens', 'rwmb' ),
		        'id'   => 'ct_heading'
		    ),
			array(
				'name'  => __( 'Telefoonnummer:', 'rwmb' ),
				'id'    => "{$prefix}ct_tel",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'name'  => __( 'Fax:', 'rwmb' ),
				'id'    => "{$prefix}ct_fax",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( '', 'rwmb' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'GSM', 'rwmb' ),
				'id'    => "{$prefix}ct_gsm",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( '', 'rwmb' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'GSM houder', 'rwmb' ),
				'id'    => "{$prefix}ct_gsmhouder",
				'desc'  => __( 'Bij wie komt men terecht als men naar de GSM nummer belt', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( '', 'rwmb' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'Email', 'rwmb' ),
				'id'    => "{$prefix}ct_email",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'email',
				'std'   => __( '', 'rwmb' ),
			),


		    // -------------------------------
			// Gegevens magazijn
			// -------------------------------
			array(
		        'type' => 'heading',
		        'name' => __( 'Magazijn gegevens', 'rwmb' ),
		        'id'   => 'ma_heading'
		    ),
		    array(
				'name'  => __( 'Titel:', 'rwmb' ),
				'id'    => "{$prefix}ma_title",
				'desc'  => __( 'Titel boven dit blok', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( 'Bouwbedrijf GEVACO bvba', 'rwmb' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'Adres:', 'rwmb' ),
				'id'    => "{$prefix}ma_address",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),

			// -------------------------------
			// Gegevens voor betalingen
			// -------------------------------
			array(
		        'type' => 'heading',
		        'name' => __( 'Overige gegevens zoals BTW-nummer, Bank, ...', 'rwmb' ),
		        'id'   => 'ov_heading'
		    ),
		    array(
				'name'  => __( 'Titel:', 'rwmb' ),
				'id'    => "{$prefix}ov_title",
				'desc'  => __( 'Titel boven dit blok', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( 'Bouwbedrijf GEVACO bvba', 'rwmb' ),
				'clone' => false,
			),
			array(
				'name'  => __( 'BTW-nummer:', 'rwmb' ),
				'id'    => "{$prefix}ov_btw",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'name'  => __( 'RSZ-nummer:', 'rwmb' ),
				'id'    => "{$prefix}ov_rsz",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'name'  => __( 'Registratie nummer:', 'rwmb' ),
				'id'    => "{$prefix}ov_reg",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'name'  => __( 'Naam van de bank:', 'rwmb' ),
				'id'    => "{$prefix}ov_bank",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'name'  => __( 'BIC:', 'rwmb' ),
				'id'    => "{$prefix}ov_bic",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'name'  => __( 'IBAN:', 'rwmb' ),
				'id'    => "{$prefix}ov_iban",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
		)
	);

	return $meta_boxes;
}