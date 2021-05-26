<?php

add_action('woocommerce_before_calculate_totals', 'buyxgetyfree_recalc_price');
 
function buyxgetyfree_recalc_price( $cart_object ) {
	
	if ( is_admin() && ! defined('DOING_AJAX') ) return;
	
	global $plugin_options;
	$everyXfree = $plugin_options['buyxgetyfree_every_x_free'];
	
	// Chek if X number is set correctly in admin
	if ( is_numeric($everyXfree) ){
		$everyXfree = intval ($everyXfree);
	}else {
		// wc_add_notice( __("The number of promoted items is not set correctly in admin",'buyxgetyfree'), 'notice');
		return;
	}
	
    $prices = array();
	$items_count = 0;
	$discount = 0;
    	
    foreach ( $cart_object->get_cart() as $cart_item ){
        $sale_price = $cart_item['data']->get_sale_price();
        // NOT for items on sale
        if( empty($sale_price) || $sale_price == 0 ) {
            for( $i = 0; $i < $cart_item['quantity']; $i++){
                $prices[] = floatval( $cart_item['data']->get_regular_price() );
                $items_count++;
            }
        }
    }
	
	// Get number of discounted items
	$disc_items_count = intval($items_count / $everyXfree);
    if( $disc_items_count >= 1 ){
        // Sort all prices
        asort($prices);

        // Get every X items free in cart (cheeppest)
        $free_cheapest_items = array_slice($prices, 0, $disc_items_count, true);

        // Calculate total discount amount
        foreach( $free_cheapest_items as $item_price )
            $discount -= $item_price;

        // Echo total discount
        if( $discount != 0 ){
            $cart_object->add_fee( __("Bulk discount",'buyxgetyfree'), $discount, true );

            // Displaying a custom notice
            wc_clear_notices();
            wc_add_notice( __("You will get $disc_items_count free items for the $items_count items in cart",'buyxgetyfree'), 'notice');
        }
    }


}