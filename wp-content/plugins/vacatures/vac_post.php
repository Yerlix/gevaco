<?php
add_action( 'init', 'create_post_type' );
function create_post_type() {
        $args = array(
        'labels' => post_vac_labels( 'Vacature' ),
        'public' => true,
        'menu_icon' => 'dashicons-groups',
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => true,
        'menu_position' => 20,
        'supports' => array('editor', 'title'));
 
        register_post_type( 'vacatures', $args );
}

function post_vac_labels( $singular, $plural = '' )
{
    if( $plural == '') $plural = $singular .'s';
   
    return array(
        'name' => _x( $plural, 'post type general name' ),
        'singular_name' => _x( $singular, 'post type singular name' ),
        'add_new' => __( 'Nieuw toevoegen' ),
        'add_new_item' => __( 'Nieuwe '. $singular . ' toevoegen' ),
        'edit_item' => __( 'Bewerk '. $singular ),
        'new_item' => __( 'Nieuwe '. $singular ),
        'view_item' => __( 'Bekijke '. $singular ),
        'search_items' => __( 'Zoek in '. $plural ),
        'not_found' =>  __( 'Geen '. $singular .' gevonden' ),
        'not_found_in_trash' => __( 'Geen '. $singular .' gevonden in de prullenmand' ),
        'parent_item_colon' => ''
    );
}


add_filter('post_updated_messages', 'vac_updated_messages');
function vac_updated_messages( $messages ) {
    global $post, $post_ID;

    $messages['vacatures'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __('Vacatures updated. <a href="%s">View vacatures</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Vacatures updated.'),
        /* translators: %s: date and time of the revision */
        5 => isset($_GET['revision']) ? sprintf( __('Vacatures restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Vacatures published. <a href="%s">View vacatures</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Vacatures saved.'),
        8 => sprintf( __('Vacatures submitted. <a target="_blank" href="%s">Preview vacatures</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Vacatures scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview vacatures</a>'),
        // translators: Publish box date format, see php.net/date
        date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Vacatures draft updated. <a target="_blank" href="%s">Preview vacatures</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}
