<?php
return [
	array(
		'name'   => 'pop',
		'title'  => 'Pop Up',
		'icon'   => 'dashicons-format-aside',
		'fields' => array(
			array(
				'id'          => 'pop_enable_related_products',
				'type'        => 'switcher',
				'title'       => esc_html__( 'Enable Pop Up', 'up-sell-pro' ),
				'description' => esc_html__( 'Enable\Disable related products Pop up after click add to cart on Shop page', 'up-sell-pro' ),
				'default'     => 'yes',
				'help'        => esc_html__( 'It shows Up-sell\Cross-sell products after click Add to cart button and help suggest to user relevant products on Shop Page', 'up-sell-pro' ),
			),

			array(
				'id'          => 'pop_additional_products',
				'type'        => 'range',
				'title'       => esc_html__( 'Quantity of Products', 'up-sell-pro' ),
				'description' => esc_html__( 'Set up the number of related products for Pop up', 'up-sell-pro' ),
				'default'     => '2',
				'min'         => '1',
				'max'         => '3',
				'step'        => '1',
			),

			array(
				'id'         => 'pop_add_bundle',
				'type'       => 'text',
				'title'      => esc_html__( 'Section title', 'up-sell-pro' ),
				'default'    => esc_html__( 'You may also like', 'up-sell-pro' ),
				'attributes' => array(
					'placeholder' => esc_html__( 'Put title text here', 'up-sell-pro' ),
				),
			),

			array(
				'id'         => 'pop_cart_link',
				'type'       => 'text',
				'title'      => 'Cart link',
				'prepend'    => 'fa-font',
				'default'    => '/cart/',
				'attributes' => array(
					'placeholder' => esc_html__( 'Put link text here', 'up-sell-pro' ),
				),
			),

			array(
				'id'          => 'pop_relation_priority',
				'type'        => 'select',
				'title'       => esc_html__( 'Relation data', 'up-sell-pro' ),
				'options'     => array(
					'tags'       => esc_html__( 'Tags', 'up-sell-pro' ),
					'categories' => esc_html__( 'Categories', 'up-sell-pro' ),
					'viewed'     => esc_html__( 'Viewed', 'up-sell-pro' ),
				),
				'description' => esc_html__( 'Set up which data use for related products', 'up-sell-pro' ),
				'default'     => 'categories',
				'class'       => 'chosen',
				'prepend'     => 'dashicons-arrow-down-alt',
			),

			array(
				'id'          => 'pop_add_if_empty',
				'type'        => 'radio',
				'title'       => esc_html__( 'Add random relations', 'up-sell-pro' ),
				'description' => esc_html__( 'Add products if relations are empty or didn\'t match', 'up-sell-pro' ),
				'options'     => array(
					'yes' => esc_html__( 'Yes', 'up-sell-pro' ),
					'no'  => esc_html__( 'No', 'up-sell-pro' ),
				),
				'default'     => 'yes',
				'style'       => 'fancy',
			),

			array(
				'id'      => 'pop_relation_order',
				'type'    => 'button_bar',
				'title'   => esc_html__( 'Order by', 'up-sell-pro' ),
				'options' => array(
					'rand'     => esc_html__( 'Random', 'up-sell-pro' ),
					'name'     => esc_html__( 'Name', 'up-sell-pro' ),
					'title'    => esc_html__( 'Title', 'up-sell-pro' ),
					'date'     => esc_html__( 'Date', 'up-sell-pro' ),
					'modified' => esc_html__( 'Modified', 'up-sell-pro' ),
				),
				'default' => 'rand',
			),
		)
	)
];







