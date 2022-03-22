<?php
return [array(
	'name'   => 'order',
	'title'  => 'Order',
	'icon'   => 'fas fa-file-invoice',
	'fields' => array(

		array(
			'id'        => 'order_add_to_order',
			'type'      => 'checkbox',
			'title'   => esc_html__( 'Add to order', 'up-sell-pro' ),
			'subtitle' => esc_html__( 'Chose which data type need add on Order Page', 'up-sell-pro' ),
			'help'        => esc_html__( 'It shows Up-sell\Cross-sell recommendation and search query in Order Page to help you suggest smartly additional products  if you call to customer to confirm the order', 'up-sell-pro' ),
			'options'   => array(
				'search' => esc_html__( 'Search queries', 'up-sell-pro' ),
				'viewed' => esc_html__( 'Viewed products', 'up-sell-pro' ),
				'category' => esc_html__( 'Category relations', 'up-sell-pro' ),
				'tag' => esc_html__( 'Tag relations', 'up-sell-pro' ),
			),
			'default' => array(
				'search',
				'viewed',
				'category',
				'tag',
			),
		),

		array(
			'id'      => 'order_order_items',
			'type'    => 'slider',
			'title'       => esc_html__( 'Quantity of items', 'up-sell-pro' ),
			'subtitle' => esc_html__( 'Set up the number of related products for Order Page for every data type', 'up-sell-pro' ),
			'default' => 5,
			'min'     => 1,
			'max'     => 15,
			'step'    => 1,
		),

		array(
			'id'      => 'order_relation_order',
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
		),

	)
)];







