<?php


function upSellProGetDefaultOptions(){
	return [
		'general_track_search'                 => 'yes',
		'general_keep_queries'                 => 5,
		'general_track_viewed'                 => 'yes',
		'product_page_enable_related_products' => 'yes',
		'product_page_relation_place'          => 'woocommerce_after_single_product_summary',
		'product_page_additional_products'     => 2,
		'product_page_add_bundle'              => 'Buy the bundle',
		'product_page_add_to_cart'             => 'Add to cart',
		'product_page_add_to_cart_desc'        => 'Full price',
		'product_page_relation_priority'       => 'categories',
		'product_page_add_if_empty'            => 'yes',
		'product_page_relation_order'          => 'rand',
		'cart_enable_related_products'         => 'yes',
		'cart_relation_place'                  => 'woocommerce_after_cart_contents',
		'cart_additional_products'             => 2,
		'cart_add_bundle'                      => 'Buy the bundle',
		'cart_add_to_cart_desc'                => 'Full price',
		'cart_relation_priority'               => 'categories',
		'cart_add_if_empty'                    => 'yes',
		'cart_relation_order'                  => 'rand',
		'pop_enable_related_products'          => 'yes',
		'pop_additional_products'              => 2,
		'pop_add_bundle'                       => 'Buy the bundle',
		'pop_cart_link'                        => '/cart/',
		'pop_relation_priority'                => 'categories',
		'pop_add_if_empty'                     => 'yes',
		'pop_relation_order'                   => 'rand',
		'order_add_to_order'                   => [ '0' => 'tag' ],
		'order_order_items'                    => 5,
		'order_relation_order'                 => 'rand',
		'email_add_to_order'                   => [ '0' => 'viewed' ],
		'email_order_items'    => 5,
		'email_relation_order' => 'rand',
	];
}

