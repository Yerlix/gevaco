<?php
/**
 * Register meta boxes
 *
 * @return void
 */
function vacatures_register_meta_boxes()
{
	$meta_boxes = vacatures_metabox();

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( ! class_exists( 'RW_Meta_Box' ) )
		return;

	// Register meta boxes only for some posts/pages
	if ( ! vacatures_maybe_include() )
		return;

	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}

add_action( 'admin_init', 'vacatures_register_meta_boxes' );

/**
 * Check if meta boxes is included
 *
 * @return bool
 */
function vacatures_maybe_include()
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
	$checked_templates = array( 'page-vacatures.php' );

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
function vacatures_metabox()
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
				'name' => __( 'Titel zijbalk', 'rwmb' ),
				'desc' => __( '', 'rwmb' ),
				'id'   => "{$prefix}va_title",
				'type' => 'text',
			),
			array(
				'name' => __( 'Informatie zijbalk', 'rwmb' ),
				'desc' => __( '', 'rwmb' ),
				'id'   => "{$prefix}va_info",
				'type' => 'textarea',
			),
			array(
				'name' => __( 'Geen vacatures', 'rwmb' ),
				'desc' => __( 'Tekst die getoond wordt indien er geen vacatures zijn', 'rwmb' ),
				'id'   => "{$prefix}va_notfound",
				'type' => 'text',
			)
		)
	);

	return $meta_boxes;
}