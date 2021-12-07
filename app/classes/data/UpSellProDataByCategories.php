<?php


namespace classes\data;

use classes\abstracts\UpSellProDataExtractor;
use WP_Query;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProDataByCategories extends UpSellProDataExtractor {

	public function __construct( $settings, $helper ) {
		parent::__construct( $settings, $helper );
	}

	public function getArgs( $values ) {

		$productCategories = $this->helper->getItemsId( get_the_terms( $values['id'], 'product_cat' ) );
		$relatedCategories = [];

		if(isset($this->settings['relation_by_category'])){
			$relatedCategories = $this->helper->getRelatedCategories( $productCategories, $this->settings['relation_by_category'] );
		}

		return array(
			'post_type'      => 'product',
			'posts_per_page' => $values['posts_per_page'],
			'orderby'        => $values['orderby'],
			'post__not_in'   => array( $values['id'] ),
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $relatedCategories,
					'operator' => 'IN',
				),
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
