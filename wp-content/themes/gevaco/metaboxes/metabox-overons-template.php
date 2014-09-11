<?php
/**
 * Register meta boxes
 *
 * @return void
 */
function over_register_meta_boxes()
{
	$meta_boxes = over_metabox();

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( ! class_exists( 'RW_Meta_Box' ) )
		return;

	// Register meta boxes only for some posts/pages
	if ( ! over_maybe_include() )
		return;

	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}

add_action( 'admin_init', 'over_register_meta_boxes' );

/**
 * Check if meta boxes is included
 *
 * @return bool
 */
function over_maybe_include()
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
	$checked_templates = array( 'page-over-ons.php' );

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
function over_metabox()
{
	$prefix = 'ge_';

	$meta_boxes   = array();
	$meta_boxes[] = array(
		'id' => 'image',
		'title' => __( 'Afbeelding aan de zijkant', 'rwmb' ),
		'pages' => array( 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
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