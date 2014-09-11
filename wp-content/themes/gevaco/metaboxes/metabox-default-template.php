<?php
/**
 * Register meta boxes
 *
 * @return void
 */

function default_register_meta_boxes()
{
	$meta_boxes = default_metabox();

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( ! class_exists( 'RW_Meta_Box' ) )
		return;

	// Register meta boxes only for some posts/pages
	if ( ! default_maybe_include() )
		return;

	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}

add_action( 'admin_init', 'default_register_meta_boxes' );

/**
 * Check if meta boxes is included
 *
 * @return bool
 */
function default_maybe_include()
{
	// Include in back-end only
	if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN )
		return false;

	// Always include for ajax
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
		return true;

	if ( isset( $_GET['post'] ) )
		$post_id = $_GET['post'];
	elseif ( isset( $_POST['post_ID'] ) )
		$post_id = $_POST['post_ID'];
	else
		$post_id = false;

	$post_id = (int) $post_id;

	// Check for page template
	$checked_templates = array( 'page.php' );

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
function default_metabox()
{
	$prefix = 'ge_';

	$meta_boxes   = array();
	$meta_boxes[] = array(
		'id' => 'gegevens',
		'title' => __( 'Gegevens eerste pagina', 'rwmb' ),
		'pages' => array( 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'type' => 'heading',
				'name' => __( 'Gegevens onderaan de pagina', 'rwmb' ),
				'id'   => 'fake_gegevens', // Not used but needed for plugin
			),
			array(
				'name'  => __( 'Titel:', 'rwmb' ),
				'id'    => "{$prefix}title",
				'desc'  => __( 'Hoogste verworven titel', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'name'  => __( 'Voornaam:', 'rwmb' ),
				'id'    => "{$prefix}firstname",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'name'  => __( 'Achternaam:', 'rwmb' ),
				'id'    => "{$prefix}surname",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'name'  => __( 'Functie:', 'rwmb' ),
				'id'    => "{$prefix}function",
				'desc'  => __( '', 'rwmb' ),
				'type'  => 'text',
				'std'   => '',
				'clone' => false,
			),
			array(
				'type' => 'heading',
				'name' => __( 'Afbeelding aan de zijkant', 'rwmb' ),
				'id'   => 'fake_image', // Not used but needed for plugin
			),
			array(
				'name'             => __( 'Upload afbeelding (max 1)', 'rwmb' ),
				'id'               => "{$prefix}side_img",
				'type'             => 'plupload_image',
				'max_file_uploads' => 1,
			),
		)
	);

	return $meta_boxes;
}
