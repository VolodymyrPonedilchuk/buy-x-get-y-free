<?php
/*
Plugin Name: Buy X Get Y Free
Description: Promo functionality for woo
Version: 1.0
Author: Volodymyr Ponedilchuk
*/

define('PLUGIN_FILE_URL', __FILE__);

// Activate the plugin.
include_once('activation.php');

// Deactivate the plugin.
include_once('deactivation.php');

// Get plugin options
$plugin_options = get_option( 'buyxgetyfree_settings' );

// Add settings
include_once('settings.php');


// Add cart sorting capabilities if needed
if ($plugin_options['buyxgetyfree_sorting_option'] != 'Off'){
	include_once('sorting_cart.php');
}


// Turn promo on and off
if ($plugin_options['buyxgetyfree_promo_status'] != 'Off'){
	include_once('promo_logic.php');
}


//Plugin Settings Page link
add_filter( 'plugin_action_links_' . plugin_basename(PLUGIN_FILE_URL), 'buyxgetyfree_settings_page_link' );
 
function buyxgetyfree_settings_page_link ( $actions ) {
   $mylinks = array(
      '<a href="' . admin_url( 'options-general.php?page=buy_x_get_y_free' ) . '">Settings</a>',
   );
   $actions = array_merge( $actions, $mylinks );
   return $actions;
}
