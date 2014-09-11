<?php

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
function theme_enqueue_scripts(){

	// wp_register_script('modernizr', get_bloginfo('template_url') . '/js/modernizr.js');
	// wp_enqueue_script('modernizr');

	if(is_production()){
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', false, '1.11.0');
		wp_enqueue_script('jquery');

		wp_register_script('global', get_bloginfo('template_url') . '/js/global.min.js', array('jquery'), false, true);
		wp_enqueue_script('global');
	}else{
		wp_register_script('require', get_bloginfo('template_url') . '/js/vendor/requirejs/require.js', array(), false, true);
		wp_enqueue_script('require');

		wp_register_script('global', get_bloginfo('template_url') . '/js/global.js', array('require'), false, true);
		wp_enqueue_script('global');
	}

	wp_enqueue_style('global', get_bloginfo('template_url') . '/css/global.css');

	// wp_register_script('livereload', 'http://gevaco:35729/livereload.js?snipver=1', null, false, true);
	// wp_enqueue_script('livereload');
}

//Add Featured Image Support
add_theme_support('post-thumbnails');


// Clean up the <head>
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

function register_menus() {
	register_nav_menus(
		array(
			'main-nav' => 'Main Navigation',
			'secondary-nav' => 'Secondary Navigation',
			'sidebar-menu' => 'Sidebar Menu'
		)
	);
}
add_action( 'init', 'register_menus' );

function register_widgets(){

	register_sidebar( array(
		'name' => __( 'Sidebar' ),
		'id' => 'main-sidebar',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}//end register_widgets()
add_action( 'widgets_init', 'register_widgets' );

/******************************************************************************\
	Custom functions
\******************************************************************************/
/**
 * TypeKit Fonts
 *
 * @since Gevaco 1.0
 */
function theme_typekit() {
    wp_enqueue_script( 'theme_typekit', '//use.typekit.net/dfu2xqe.js');
}
// add_action( 'wp_enqueue_scripts', 'theme_typekit' );
function theme_typekit_inline() {
  if ( wp_script_is( 'theme_typekit', 'done' ) ) { ?>
  	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php }
}
// add_action( 'wp_head', 'theme_typekit_inline' );

/**
 * Retina images
 *
 * @since Gevaco 1.0
 */
function theme_images_inline() {
  ?>
  	<script>(function(d,p){var l=d.getElementsByTagName("link")[0],c=d.createElement("link");c.rel="stylesheet";c.href=p&&p>1?"<?php echo get_bloginfo('template_url'); ?>/css/img_2x.css":"<?php echo get_template_directory_uri(); ?>/css/img.css";l.parentNode.insertBefore(c,l)})(document,window.devicePixelRatio);</script>
<?php
}
add_action( 'wp_head', 'theme_images_inline' );

/**
 * Include meta boxes
 *
 */
include 'metaboxes/metabox-contact-template.php';
include 'metaboxes/metabox-overons-template.php';
include 'metaboxes/metabox-realisaties-template.php';
include 'metaboxes/metabox-vacatures-template.php';
include 'metaboxes/metabox-default-template.php';

/**
 * Include theme overrides
 *
 */
include 'custom-gallery.php';

/**
 * Remove the default jQuery load from wordpress
 *
 */
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
}

/**
 * Check if in production
 */
function is_production(){
  if(ENVIRONMENT == 'production'){
      return true;
  }else{
      return false;
  }
}

/**
 * Remove menu items for non-admin
 *
 */
function edit_admin_menus() {
    global $menu;
    $restricted = array(__('Dashboard'), __('Posts'));
    end ($menu);
    while (prev($menu)){
        $value = explode(' ',$menu[key($menu)][0]);
        if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
    }

    // remove some more when not admin
    if (!current_user_can('manage_options')){
    	remove_menu_page('edit-comments.php');
    	remove_menu_page('tools.php');
        remove_menu_page('wpseo_dashboard');
    	remove_menu_page('wpcf7');
    }
}
add_action( 'admin_menu', 'edit_admin_menus' );

/**
 * Redirect to pages
 */
function login_redirect( $redirect_to, $request, $user ){
    return (is_array($user->roles) && in_array('administrator', $user->roles)) ? admin_url() : 'wp-admin/edit.php?post_type=page';
	// return 'wp-admin/edit.php?post_type=page';
}
add_filter( 'login_redirect', 'login_redirect', 10, 3 );

/**
 * Remove elements for non-admin from general view
 */
function remove_items() {
    $screen = get_current_screen();
    global $current_screen;
    // only administrator gets the quick edit
    if( ! current_user_can('manage_options' )){
        ?>
        <script type="text/javascript">
	        // remove quick edit for pages
	        window.onload = function (){
	            <?php if ($_GET['post_type'] == 'page' || $_GET['post_type'] == 'gallery' || $_GET['post_type'] == 'vacatures') { ?>
	                // remove input fields from quick edit
	                var editinline = document.getElementsByClassName('inline');
	                if ( editinline != null ) {
	                    for (var i = editinline.length - 1; i >= 0; i--) {
	                        editinline[i].parentNode.removeChild(editinline[i]);
	                    };
	                }

                    <?php if ($_GET['post_type'] == 'page') { ?>
                        var editinline = document.getElementsByClassName('trash');
                        if ( editinline != null ) {
                            for (var i = editinline.length - 1; i >= 0; i--) {
                                editinline[i].parentNode.removeChild(editinline[i]);
                            };
                        }

                        var add_new_h2 = document.getElementsByClassName('add-new-h2');
                        if ( add_new_h2 != null ) {
                            for (var i = add_new_h2.length - 1; i >= 0; i--) {
                                add_new_h2[i].parentNode.removeChild(add_new_h2[i]);
                            };
                        }

                        var bulkactions = document.getElementsByClassName('bulkactions');
                        if ( bulkactions != null ) {
                            for (var i = bulkactions.length - 1; i >= 0; i--) {
                                bulkactions[i].parentNode.removeChild(bulkactions[i]);
                            };
                        }
                    <?php } ?>
	            <?php } ?>
	        }
        </script>
        <?php
    }
}
add_action( 'admin_head-edit.php', 'remove_items' );

/*
* Remove input fields on pages
*/
function remove_my_page_metaboxes() {
    global $current_screen;
    global $typenow;

    if ( ! current_user_can('manage_options')){

        if (isset($_GET['post'])) {
        	$type = (get_post_type($_GET['post']));
        }
        else {
            $type = 'none';
        }

        if ($typenow == 'page'){ 
            ?>
            <script type="text/javascript">
                window.onload = function() {
                    // inladen elementen om te verwijderen
                    var homepage_metabox = document.getElementById('homepage_metabox');
                    var page_metabox = document.getElementById('page_metabox');
                    var pageparentdiv = document.getElementById('pageparentdiv');
                    var add_new_h2 = document.getElementsByClassName('add-new-h2');
                    var postimagediv = document.getElementById('postimagediv');
                    var contact_page_metabox = document.getElementById('contact_page_metabox');

                    // elementen verwijderen
                    if ( homepage_metabox !=null ){ homepage_metabox.remove(); }
                    if ( page_metabox != null ){ page_metabox.remove(); }
                    if ( pageparentdiv != null ){ pageparentdiv.remove(); }
                    if ( postimagediv != null ){ postimagediv.remove() }
                    if ( contact_page_metabox != null ){ contact_page_metabox.remove(); }

                    if ( add_new_h2 != null ) {
                        for (var i = add_new_h2.length - 1; i >= 0; i--) {
                            add_new_h2[i].remove();
                        };
                    }

                    // set title readonly
                    var title = document.getElementById('title');
                    title.setAttribute('readonly', 'readonly');
                }
            </script>
        <?php }
        if (is_edit_page() && ($type == 'page' || $type == 'none')){
            ?>
            <script type="text/javascript">
                window.onload = function() {
                    // inladen elementen om te verwijderen
                    var commentstatusdiv = document.getElementById('commentstatusdiv');
                    var commentsdiv = document.getElementById('commentsdiv');
                    var pageparentdiv = document.getElementById('pageparentdiv');
                    var add_new_h2 = document.getElementsByClassName('add-new-h2');
                    // elementen verwijderen
                    if ( commentstatusdiv !=null ){ commentstatusdiv.remove(); }
                    if ( commentsdiv !=null ){ commentsdiv.remove(); }
                    if ( pageparentdiv !=null ){ pageparentdiv.remove(); }

                    if ( add_new_h2 != null ) {
                        for (var i = add_new_h2.length - 1; i >= 0; i--) {
                            add_new_h2[i].remove();
                        };
                    }
                }
            </script>
      <?php }
    }
}
add_action('admin_menu','remove_my_page_metaboxes');

function is_edit_page($new_edit = null){
    global $pagenow;
    //make sure we are on the backend
    if (!is_admin()) return false;


    if($new_edit == "edit")
        return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new") //check for new post page
        return in_array( $pagenow, array( 'post-new.php' ) );
    else //check for either new or edit
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}

/**
* Low priority for yoast meta box
*/
add_filter( 'wpseo_metabox_prio', function() { return 'low';});

/**
* Remove media settings for gallery
*/
add_action('print_media_templates', function(){

    print '
        <style type="text/css">
            .gallery-settings {
            display:none !important;
            }
        </style>';
}); ?>
