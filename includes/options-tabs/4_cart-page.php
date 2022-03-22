<?php
return [
	array(
		'name'   => 'cart_page',
		'title'  => esc_html__( 'Cart Page', 'up-sell-pro' ),
		'icon'   => 'fas fa-shopping-cart',
		'fields' => array(
			array(
				'id'          => 'cart_enable_related_products',
				'type'        => 'switcher',
				'title'       => esc_html__( 'Enable related products', 'up-sell-pro' ),
				'subtitle' => esc_html__( 'Enable\Disable related products section for Cart page', 'up-sell-pro' ),
				'default'     => '1',
				'help'        => esc_html__( 'It shows Up-sell\Cross-sell products for added to Cart items and help suggest to user relevant products on Cart Page', 'up-sell-pro' ),
			),

			array(
				'id'          => 'cart_relation_place',
				'type'        => 'button_set',
				'title'       => esc_html__( 'Relation place', 'up-sell-pro' ),
				'options'     => array(
					'woocommerce_after_cart_contents' => esc_html__( 'After content', 'up-sell-pro' ),
					'woocommerce_after_cart_table'    => esc_html__( 'After table', 'up-sell-pro' ),
					'woocommerce_after_cart'          => esc_html__( 'After cart', 'up-sell-pro' ),
				),
				'default'     => 'woocommerce_after_cart',
				'dependency' => array( 'cart_enable_related_products', '==', '1', '', 'visible' ),
				'subtitle' => esc_html__( 'Place to put related products section for Cart page', 'up-sell-pro' ),
			),

			array(
				'id'          => 'cart_additional_products',
				'type'        => 'slider',
				'title'       => esc_html__( 'Quantity of Products', 'up-sell-pro' ),
				'subtitle' => esc_html__( 'Set up the number of related products for on Cart page', 'up-sell-pro' ),
				'default'     => 2,
				'min'         => 1,
				'max'         => 4,
				'step'        => 1,
				'dependency' => array( 'cart_enable_related_products', '==', '1', '', 'visible' ),
			),

			array(
				'id'         => 'cart_add_bundle',
				'type'       => 'text',
				'title'      => esc_html__( 'Section title', 'up-sell-pro' ),
				'default'    => esc_html__( 'Buying together often', 'up-sell-pro' ),
				'placeholder' => esc_html__( 'Put title text here', 'up-sell-pro' ),
				'dependency' => array( 'cart_enable_related_products', '==', '1', '', 'visible' ),
			),

			array(
				'id'          => 'cart_relation_priority',
				'type'        => 'select',
				'title'       => esc_html__( 'Relation data', 'up-sell-pro' ),
				'options'     => array(
					'tags'       => esc_html__( 'Tags', 'up-sell-pro' ),
					'categories' => esc_html__( 'Categories', 'up-sell-pro' ),
					'viewed'     => esc_html__( 'Viewed', 'up-sell-pro' ),
				),
				'subtitle' => esc_html__( 'Set up which data use for related products', 'up-sell-pro' ),
				'default'     => 'categories',
				'chosen'      => true,
				'dependency' => array( 'cart_enable_related_products', '==', '1', '', 'visible' ),
			),

			array(
				'id'          => 'cart_add_if_empty',
				'type'        => 'radio',
				'title'       => esc_html__( 'Add random relations', 'up-sell-pro' ),
				'subtitle' => esc_html__( 'Add products if relations are empty or didn\'t match', 'up-sell-pro' ),
				'options'     => array(
					'yes' => esc_html__( 'Yes', 'up-sell-pro' ),
					'no'  => esc_html__( 'No', 'up-sell-pro' ),
				),
				'default'     => 'yes',
				'dependency' => array( 'cart_enable_related_products', '==', '1', '', 'visible' ),
			),

			array(
				'id'      => 'cart_relation_order',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Order by', 'up-sell-pro' ),
				'options' => array(
					'rand'     => esc_html__( 'Random', 'up-sell-pro' ),
					'name'     => esc_html__( 'Name', 'up-sell-pro' ),
					'title'    => esc_html__( 'Title', 'up-sell-pro' ),
					'date'     => esc_html__( 'Date', 'up-sell-pro' ),
					'modified' => esc_html__( 'Modified', 'up-sell-pro' ),
				),
				'default' => 'rand',
				'dependency' => array( 'cart_enable_related_products', '==', '1', '', 'visible' ),
			),
		)
	)
];







