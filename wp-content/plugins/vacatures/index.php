<?php
/* Plugin Name: Vacatures Gevaco
Plugin URI: /
Description: Vacatures plugin
Version: 1.0
Author: Yoeri Stessens
Author URI: 
License: GPLv2 or later
*/

function vac_activation() {
}
register_activation_hook(__FILE__, 'vac_activation');

function vac_deactivation() {
}
register_deactivation_hook(__FILE__, 'vac_deactivation');

$prfx = 'vac_';
include($prfx . 'post.php');