<?php
return [array(
	'name'   => 'product_page',
	'title'  => esc_html__( 'Product Page', 'up-sell-pro' ),
	'icon'   => 'fas fa-laptop',
	'fields' => array(
		array(
			'id'      => 'product_page_enable_related_products',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable related products', 'up-sell-pro' ),
			'subtitle' => esc_html__( 'Enable\Disable related products section for product detail page', 'up-sell-pro' ),
			'default' => '1',
			'help'        => esc_html__( 'It shows Up-sell\Cross-sell products for current item and help suggest to user relevant products', 'up-sell-pro' ),
		),

		array(
			'id'      => 'product_page_relation_place',
			'type'    => 'button_set',
			'title'   =>  esc_html__( 'Relation place', 'up-sell-pro' ),
			'options' => array(
				'woocommerce_after_single_product'          => esc_html__( 'After product', 'up-sell-pro' ),
				'woocommerce_after_single_product_summary'  => esc_html__( 'After summary', 'up-sell-pro' ),
			),
			'dependency' => array( 'product_page_enable_related_products', '==', '1', '', 'visible' ),
			'default' => 'woocommerce_after_single_product',
			'subtitle' => esc_html__( 'Place to put related products section for product detail page', 'up-sell-pro' ),
		),

		array(
			'id'      => 'product_page_additional_products',
			'type'    => 'slider',
			'title'   => esc_html__( 'Quantity of Products', 'up-sell-pro' ),
			'subtitle' => esc_html__( 'Set up the number of related products for  current item', 'up-sell-pro' ),
			'default' => 2,
			'min'     => 1,
			'max'     => 3,
			'step'    => 1,
			'dependency' => array( 'product_page_enable_related_products', '==', '1', '', 'visible' ),
		),

		array(
			'id'          => 'product_page_add_bundle',
			'type'        => 'text',
			'title'       => esc_html__( 'Section title', 'up-sell-pro' ),
			'default'     => esc_html__( 'Customers often buy together with this product', 'up-sell-pro' ),
			'placeholder' => esc_html__( 'Put title text here', 'up-sell-pro' ),
			'dependency' => array( 'product_page_enable_related_products', '==', '1', '', 'visible' ),
		),

		array(
			'id'          => 'product_page_add_to_cart',
			'type'        => 'text',
			'title'       => esc_html__( 'Button text', 'up-sell-pro' ),
			'default'     => esc_html__( 'Add to cart', 'up-sell-pro' ),
		    'placeholder' => esc_html__( 'Put text for button here', 'up-sell-pro' ),
			'dependency' => array( 'product_page_enable_related_products', '==', '1', '', 'visible' ),
		),

		array(
			'id'          => 'product_page_add_to_cart_desc',
			'type'        => 'text',
			'title'       => esc_html__( 'Price description', 'up-sell-pro' ),
			'default'     => esc_html__( 'Full price: ', 'up-sell-pro' ),
			'placeholder' => esc_html__( 'Put text here', 'up-sell-pro' ),
			'dependency' => array( 'product_page_enable_related_products', '==', '1', '', 'visible' ),
		),

		array(
			'id'             => 'product_page_relation_priority',
			'type'           => 'select',
			'title'          => esc_html__( 'Relation data', 'up-sell-pro' ),
			'options'        => array(
				'tags'          => esc_html__( 'Tags', 'up-sell-pro' ),
				'categories'    => esc_html__( 'Categories', 'up-sell-pro' ),
				'viewed'        => esc_html__( 'Viewed', 'up-sell-pro' ),
			),
			'subtitle' => esc_html__( 'Set up which data use for related products', 'up-sell-pro' ),
			'default'     => 'categories',
			'chosen'      => true,
			'dependency' => array( 'product_page_enable_related_products', '==', '1', '', 'visible' ),
		),

		array(
			'id'      => 'product_page_add_if_empty',
			'type'    => 'radio',
			'title'   => esc_html__( 'Add random relations', 'up-sell-pro' ),
			'subtitle' => esc_html__( 'Add products if relations are empty or didn\'t match' , 'up-sell-pro' ),
			'options' => array(
				'yes'   => 'Yes',
				'no'    => 'No',
			),
			'default' => 'yes',
			'dependency' => array( 'product_page_enable_related_products', '==', '1', '', 'visible' ),
		),


		array(
			'id'      => 'product_page_relation_order',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Order by', 'up-sell-pro' ),
			'options' => array(
				'rand'    => esc_html__( 'Random', 'up-sell-pro' ),
				'name'    => esc_html__( 'Name', 'up-sell-pro' ),
				'title'    => esc_html__( 'Title', 'up-sell-pro' ),
				'date'    => esc_html__( 'Date', 'up-sell-pro' ),
				'modified'    => esc_html__( 'Modified', 'up-sell-pro' ),
			),
			'default' => 'rand',
			'dependency' => array( 'product_page_enable_related_products', '==', '1', '', 'visible' ),
		),
	)
)];







