<?php


namespace classes\data;

use classes\abstracts\UpSellProDataExtractor;
use WP_Query;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProDataByViewed extends UpSellProDataExtractor {

	public function __construct( $settings, $helper ) {
		parent::__construct( $settings, $helper );
		$this->run();
	}

	public function run() {
		remove_action( 'template_redirect', 'wc_track_product_view', 20 );
		add_action( 'template_redirect', array( $this, 'trackViewProducts' ), 20 );
	}

	function trackViewProducts() {

		if ( ! is_singular( 'product' )) {
			return;
		}

		global $post;

		if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) {
			$viewed_products = array();
		} else {
			$viewed_products = wp_parse_id_list( (array) explode( '|', sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ) );
		}

		$keys = array_flip( $viewed_products );

		if ( isset( $keys[ $post->ID ] ) ) {
			unset( $viewed_products[ $keys[ $post->ID ] ] );
		}

		$viewed_products[] = $post->ID;

		if ( count( $viewed_products ) > 15 ) {
			array_shift( $viewed_products );
		}

		wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
	}

	public function getArgs( $values ) {
		$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', sanitize_text_field(wp_unslash( $_COOKIE['woocommerce_recently_viewed'] )) ) : array();

		$keys = array_flip( $viewed_products );
		if ( isset( $keys[ $values['id'] ] ) ) {
			unset( $viewed_products[ $keys[ $values['id'] ] ] );
		}

		if ( empty( $viewed_products ) && $values['add_random'] == false ) {
			return [];
		}

		return array(
			'post_type'      => 'product',
			'posts_per_page' => $values['posts_per_page'],
			'orderby'        => $values['orderby'],
			'post_status'    => 'publish',
			'post__in'       => $viewed_products,
			'post__not_in'   => array( $values['id'] ),
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_type',
					'field'    => 'name',
					'terms'    => array( 'simple' ),
				),
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'outofstock',
					'operator' => 'NOT IN',
				),
			),
		);
	}

	public function getData( $args ) {
		return new WP_Query( $this->getArgs( $args ) );
	}
}
