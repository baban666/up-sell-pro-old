<?php

namespace classes\cart;


use WC_Form_Handler;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProMultipleAddToCart {

	public function __construct() {
		add_action( 'wp_loaded', array( $this, 'multipleProductsToCart' ), 15 );
	}

	public function multipleProductsToCart() {
		if ( ! class_exists( 'WC_Form_Handler' ) || empty( $_REQUEST['add-to-cart'] ) || false === strpos( $_REQUEST['add-to-cart'], ',' ) ) {
			return;
		}

		remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

		$product_ids = explode( ',', $_REQUEST['add-to-cart'] );
		$count       = count( $product_ids );
		$number      = 0;

		foreach ( $product_ids as $product_id ) {

			if ( ++ $number === $count ) {
				$_REQUEST['add-to-cart'] = $product_id;
				return WC_Form_Handler::add_to_cart_action();
			}

			$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $product_id ) );
			$was_added_to_cart = false;
			$adding_to_cart    = wc_get_product( $product_id );

			if ( ! $adding_to_cart ) {
				continue;
			}

			$add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $adding_to_cart->get_type(), $adding_to_cart );

			if ( 'simple' !== $add_to_cart_handler ) {
				continue;
			}

			$quantity          = empty( $_REQUEST['quantity'] ) ? 1 : wc_stock_amount( $_REQUEST['quantity'] );
			$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

			if ( $passed_validation && false !== WC()->cart->add_to_cart( $product_id, $quantity ) ) {
				wc_add_to_cart_message( array( $product_id => $quantity ), true );
			}
		}
	}

}
