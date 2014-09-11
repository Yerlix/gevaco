<?php
/**
 * Register meta boxes
 *
 * @return void
 */
function gallery_register_meta_boxes()
{
	$meta_boxes = gallery_metabox();

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( ! class_exists( 'RW_Meta_Box' ) )
		return;

	// Register meta boxes only for some posts/pages
	if ( ! gallery_maybe_include() )
		return;

	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}

add_action( 'admin_init', 'gallery_register_meta_boxes' );

/**
 * Check if meta boxes is included
 *
 * @return bool
 */
function gallery_maybe_include()
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
	$checked_templates = array( 'page-realisaties.php' );

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
function gallery_metabox()
{
	$prefix = 'ge_';

	$meta_boxes   = array();
	$meta_boxes[] = array(
		'id' => 'sidebar',
		'title' => __( 'Informatie die in de balk aan de zijkant komt te staan', 'rwmb' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name' => __( 'Navigatie titel', 'rwmb' ),
				'desc' => __( '', 'rwmb' ),
				'id'   => "{$prefix}re_nav_title",
				'type' => 'text'
			),
			array(
				'name' => __( 'Informatie', 'rwmb' ),
				'desc' => __( '', 'rwmb' ),
				'id'   => "{$prefix}re_info",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			)
		)
	);

	return $meta_boxes;
}