<?php
/* Plugin Name: Gallery Gevaco
Plugin URI: /
Description: Gallery plugin
Version: 1.0
Author: Yoeri Stessens
Author URI: 
License: GPLv2 or later
*/

function gal_activation() {
}
register_activation_hook(__FILE__, 'gal_activation');

function gal_deactivation() {
}
register_deactivation_hook(__FILE__, 'gal_deactivation');

$prfx = 'gal_';
include($prfx . 'post.php');
include($prfx . 'metaboxes.php');
include($prfx . 'text.php');