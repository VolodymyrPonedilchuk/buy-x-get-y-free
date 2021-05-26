<?php

add_action( 'admin_menu', 'buyxgetyfree_add_admin_menu' );
add_action( 'admin_init', 'buyxgetyfree_settings_init' );
 

// Add menu page
function buyxgetyfree_add_admin_menu() { 

	add_options_page('Buy X get Y free', 'Buy X get Y free', 'manage_options', 'buy_x_get_y_free', 'buyxgetyfree_options_page');

}

// Register settings
function buyxgetyfree_settings_init() { 
	
	register_setting( 'pluginPage', 'buyxgetyfree_settings', 'buyxgetyfree_options_validate' );
	
	add_settings_section(
		'buyxgetyfree_pluginPage_section', 
		__( 'Main settings', 'buyxgetyfree' ), 
		'', 
		'pluginPage'
	);	
	
	add_settings_section(
		'buyxgetyfree_additional_section', 
		__( 'Additional settings', 'buyxgetyfree' ), 
		'', 
		'pluginPage'
	);

	add_settings_field( 
		'buyxgetyfree_promo_status', 
		__( 'Turn it ', 'buyxgetyfree' ), 
		'buyxgetyfree_promo_status_render', 
		'pluginPage', 
		'buyxgetyfree_pluginPage_section' 
	);
	
	add_settings_field(
		'buyxgetyfree_every_x_free',
		__( 'Every X item is free', 'buyxgetyfree' ),
		'buyxgetyfree_every_x_free_render',
		'pluginPage',
		'buyxgetyfree_pluginPage_section'
	);
	
	add_settings_field( 
		'buyxgetyfree_sorting_option', 
		__( 'Sort cart items by price', 'buyxgetyfree' ), 
		'buyxgetyfree_sorting_option_render', 
		'pluginPage', 
		'buyxgetyfree_additional_section' 
	);
	
}


// Render Status field
function buyxgetyfree_promo_status_render() { 
	global $plugin_options;
	?>
	<select name='buyxgetyfree_settings[buyxgetyfree_promo_status]'>
		<option value='On' <?php selected( $plugin_options['buyxgetyfree_promo_status'], 'On' ); ?>>On</option>
		<option value='Off' <?php selected( $plugin_options['buyxgetyfree_promo_status'], 'Off' ); ?>>Off</option>
	</select>

<?php

}


// Render X field 
function buyxgetyfree_every_x_free_render() {
	global $plugin_options;
	?>
	<input id='buyxgetyfree_every_x_free' name='buyxgetyfree_settings[buyxgetyfree_every_x_free]'  type='number' min='2' max='100' value='<?php echo $plugin_options['buyxgetyfree_every_x_free'] ?>' />
	<p><em><?php echo __( 'Must be a number between 2 and 100', 'buyxgetyfree' ); ?></em></p>

<?php	
}


// Render Sort By field
function buyxgetyfree_sorting_option_render() { 
	global $plugin_options;
	?>
	<select name='buyxgetyfree_settings[buyxgetyfree_sorting_option]'>
		<option value='Off' <?php selected( $plugin_options['buyxgetyfree_sorting_option'], 'Off' ); ?>>Off</option>
		<option value='PriceASC' <?php selected( $plugin_options['buyxgetyfree_sorting_option'], 'PriceASC' ); ?>>Price ASC</option>
		<option value='PriceDESC' <?php selected( $plugin_options['buyxgetyfree_sorting_option'], 'PriceDESC' ); ?>>Price DESC</option>
	</select>

<?php

}


// Print settings
function buyxgetyfree_options_page() { 

		?>
		<form action='options.php' method='post'>

			<h2>Buy X get Y free</h2>

			<?php
			settings_fields( 'pluginPage' );
			do_settings_sections( 'pluginPage' );
			submit_button();
			?>

		</form>
		<?php

}

// Validate X input field
function buyxgetyfree_options_validate ($input){
	
	// Check if X field containes number
	$message = __( 'X must be a number between 2 and 100 (set to default value = 3)', 'buyxgetyfree' );
	
	// If not number set to default value = 3
	if (!is_numeric($input['buyxgetyfree_every_x_free']) ){
		$input['buyxgetyfree_every_x_free'] = '3';
		add_settings_error( $input, 'settings_error', $message, 'error' );
	}
	
	return $input;
}
