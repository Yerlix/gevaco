<?php
/**
 * Add Needed Post Types 
 */
function gallery_init_post_types() {
  if (function_exists('gallery_get_post_types')) {
    foreach (gallery_get_post_types() as $type => $options) {
      gallery_add_post_type($type, $options['config'], $options['singular'], $options['multiple']);
    }
  }
}
add_action('init', 'gallery_init_post_types');

/**
 * Add Needed Taxonomies
 */
function gallery_init_taxonomies() {
  if (function_exists('gallery_get_taxonomies')) {
    foreach (gallery_get_taxonomies() as $type => $options) {
      gallery_add_taxonomy($type, $options['for'], $options['config'], $options['singular'], $options['multiple']);
    }
  }
}
// add_action('init', 'gallery_init_taxonomies');

/**
 * Add post types that are used in the theme 
 * 
 * @return array
 */
function gallery_get_post_types() {
  return array(
        'gallery' => array(
            'config' => array(
                'public' => true,
                'menu_position' => 20,
                'menu_icon' => 'dashicons-format-gallery',
                'has_archive'   => true,
                'supports'=> array(
                    'title',
                    'comments',
                    'editor',
                    'thumbnail',
                    'page-attributes',
                ),
                'show_in_nav_menus'=> true,
                'taxonomies' => array('category'),
            ),
            'singular' => 'Galerij',
            'multiple' => 'Galerijen',
            'columns'    => array(
                'first_image',
            )
        ),
    );
}

/**
 * Register Post Type Wrapper
 * @param string $name
 * @param array $config
 * @param string $singular
 * @param string $multiple
 */
function gallery_add_post_type($name, $config, $singular = 'Entry', $multiple = 'Entries') {
  if (!isset($config['labels'])) {
    $config['labels'] = array(
      'name' => $multiple,
      'singular_name' => $singular,
      'not_found'=> 'Geen ' . $multiple . ' gevonden',
      'not_found_in_trash'=> 'Geen ' . $multiple . ' gevonden in de prullenbak',
      'edit_item' => 'Bewerk ', $singular,
      'search_items' => 'Zoek ' . $multiple,
      'view_item' => 'Bekijk ', $singular,
      'new_item' => 'Nieuwe ' . $singular,
      'add_new' => 'Nieuw toevoegen',
      'add_new_item' => 'Nieuwe ' . $singular . ' toevoegen',
    );
  }

  register_post_type($name, $config);
}

/**
 * Post types where metaboxes should show
 * 
 * @return array
 */
function gallery_get_post_types_with_gallery() {
  return array('post','gallery');
}

/**
 * Add taxonomies that are used in theme
 * 
 * @return array
 */
function gallery_get_taxonomies() {
  return array(

        'gallery-category'    => array(
            'for'        => array('gallery'),
            'config'    => array(
                'sort'        => true,
                'args'        => array('orderby' => 'term_order'),
                'hierarchical' => true,
            ),
            'singular'    => 'Galerij Categorie',
            'multiple'    => 'Galerij Categorieën',
        ),
    );
}

/**
 * Register taxonomy wrapper
 * @param string $name
 * @param mixed $object_type
 * @param array $config
 * @param string $singular
 * @param string $multiple
 */
function gallery_add_taxonomy($name, $object_type, $config, $singular = 'Entry', $multiple = 'Entries') {
  
  if (!isset($config['labels'])) {
    $config['labels'] = array(
      'name' => $multiple,
      'singular_name' => $singular,
      'search_items' =>  'Zoek ' . $multiple,
      'all_items' => 'Alle ' . $multiple,
      'parent_item' => 'Hoogste ' . $singular,
      'parent_item_colon' => 'Hoogste ' . $singular . ':',
      'edit_item' => 'Bewerk ' . $singular,
      'update_item' => 'Update ' . $singular,
      'add_new_item' => 'Nieuwe ' . $singular,
      'new_item_name' => 'Nieuwe ' . $singular . ' naam',
      'menu_name' => $singular,
    );
  }
  
  register_taxonomy($name, $object_type, $config);
}