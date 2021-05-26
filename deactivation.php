<?php
// Delete settings on plugin deactivation
function buyxgetyfree_deactivate() {
	delete_option('buyxgetyfree_settings');
	flush_rewrite_rules(); 
}
register_deactivation_hook( PLUGIN_FILE_URL, 'buyxgetyfree_deactivate' );