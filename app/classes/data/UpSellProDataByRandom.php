<?php


namespace classes\data;



use classes\abstracts\UpSellProDataExtractor;
use WP_Query;

class UpSellProDataByRandom extends UpSellProDataExtractor{

	public function __construct($settings, $helper) {
		parent::__construct($settings, $helper);
	}

	public function getArgs($values){
		$type = $values['type'] == 'tags' ? 'product_tag' : 'product_cat';

		$args = $this->helper->getItemsId(get_the_terms( $values['id'], $type ));

		return array(
			'post_type' => 'product',
			'posts_per_page' => $values['posts_per_page'],
			'orderby' => $values['orderby'],
			'tax_query' => array(
				array(
					'taxonomy' => $type,
					'field' => 'term_id', //This is optional, as it defaults to ‘term_id’
					'terms' => $args,
					'operator' => 'IN' // Possible values are ‘IN’, ‘NOT IN’, ‘AND’.
				),
				array(
					'taxonomy'  => 'product_type',
					'field'     => 'name',
					'terms'     => array('simple'),
				)
			),
		);
	}

	public function getData( $args ){
		return new WP_Query( $this->getArgs($args) );
	}
}
