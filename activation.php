<?php
// Set default settings on plugin activation
function buyxgetyfree_activate() { 
	 $default_values = array(
        'buyxgetyfree_promo_status'     => 'Off',
        'buyxgetyfree_sorting_option'   => 'Off',
        'buyxgetyfree_every_x_free'   => '3'
    );
    add_option( 'buyxgetyfree_settings', $default_values );
	flush_rewrite_rules(); 
}
register_activation_hook( PLUGIN_FILE_URL, 'buyxgetyfree_activate' );
