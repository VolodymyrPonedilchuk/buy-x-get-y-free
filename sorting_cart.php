<?php

// Sorting cart items (for better look)
add_action( 'woocommerce_cart_loaded_from_session', 'buyxgetyfree_order_items_by_price' );

function buyxgetyfree_order_items_by_price( $cart ) {
	
	global $plugin_options;

	//if the cart is empty do nothing
	if ( empty( $cart->cart_contents ) ) {
		return;
	}

	//this is an array to collect cart items
	$cart_sort = array();

	//add cart item inside the array
	foreach ( $cart->cart_contents as $cart_item_key => $cart_item ) {
		$cart_sort[ $cart_item_key ] = $cart->cart_contents[ $cart_item_key ];
	}

	//call the function to sort cart items
	if ($plugin_options['buyxgetyfree_sorting_option'] == 'PriceASC'){
		@uasort( $cart_sort, 'buyxgetyfree_sort_by_price_asc' );
	} else {
		@uasort( $cart_sort, 'buyxgetyfree_sort_by_price_desc' );
	}


	//replace the cart contents with the array sorted
	$cart->cart_contents = $cart_sort;

}

// Sort items By Price (ASC)
function buyxgetyfree_sort_by_price_asc( $cart_item_a, $cart_item_b ) {
	return $cart_item_a['data']->get_price() > $cart_item_b['data']->get_price();
}

// Sort items By Price (DESC)
function buyxgetyfree_sort_by_price_desc( $cart_item_a, $cart_item_b ) {
	return $cart_item_a['data']->get_price() < $cart_item_b['data']->get_price();
}


