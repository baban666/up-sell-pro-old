<?php

use classes\helpers\UpSellProHelper;

$upSellIncreaseHelper = new UpSellProHelper();

return [
	array(
		'name'   => 'gift_product',
		'title'  => esc_html__( 'Gift Product', 'up-sell-pro' ),
		'icon'   => 'fas fa-gift',
		'fields' => array(
			array(
				'id'       => 'gift_product_enable',
				'type'     => 'switcher',
				'title'    => esc_html__( 'Enable Gift Product', 'up-sell-pro' ),
				'subtitle' => esc_html__( 'Enable\Disable Gift Product', 'up-sell-pro' ),
				'default'  => '1',
				'help'     => esc_html__( 'It shows Gift Products on single product page', 'up-sell-pro' ),
			),
			array(
				'id'          => 'gift_product_item',
				'type'        => 'select',
				'title'       => esc_html__( 'Gift Product', 'up-sell-pro' ),
				'chosen'      => true,
				'ajax'        => true,
				'placeholder' => esc_html__( 'Select product', 'up-sell-pro' ),
				'options'     => 'posts',
				'query_args'  => array(
					'post_type'      => 'product',
					'status'         => 'publish',
					'posts_per_page' => - 1,
				),
				'dependency'  => array( 'gift_product_enable', '==', '1', '', 'visible' ),
			),

			array(
				'id'         => 'gift_product_place',
				'type'       => 'button_set',
				'title'      => esc_html__( 'Gift product place', 'up-sell-pro' ),
				'options'    => array(
					'left'  => esc_html__( 'Left', 'up-sell-pro' ),
					'right' => esc_html__( 'Right', 'up-sell-pro' ),
				),
				'default'    => 'right',
				'dependency' => array( 'gift_product_enable', '==', '1', '', 'visible' ),
				'subtitle'   => esc_html__( 'Place to put product section on single product page', 'up-sell-pro' ),
			),

			array(
				'id'       => 'gift_product_value',
				'type'     => 'number',
				'title'    => esc_html__( 'Cart value for gift', 'up-sell-pro' ),
				'default'  => 50,
				'dependency'  => array( 'gift_product_enable', '==', '1', '', 'visible' ),
			),
			// Style settings
			array(
				'type'    => 'heading',
				'content' => esc_html__( 'Headings', 'up-sell-pro' ),
			),
			array(
				'id'          => 'gift_product_title',
				'type'        => 'text',
				'title'       => esc_html__( 'Section title', 'up-sell-pro' ),
				'default'     => esc_html__( 'Buying together often', 'up-sell-pro' ),
				'placeholder' => esc_html__( 'Put title text here', 'up-sell-pro' ),
				'dependency'  => array( 'gift_product_enable', '==', '1', '', 'visible' ),
				'help'     => esc_html__( 'Title if total cart is less than 50% of gift value', 'up-sell-pro' ),
			),

			array(
				'id'          => 'gift_product_title_middle',
				'type'        => 'text',
				'title'       => esc_html__( 'Section title', 'up-sell-pro' ),
				'default'     => esc_html__( 'Buying together often', 'up-sell-pro' ),
				'placeholder' => esc_html__( 'Put title text here', 'up-sell-pro' ),
				'dependency'  => array( 'gift_product_enable', '==', '1', '', 'visible' ),
				'help'     => esc_html__( 'Title if total cart is more than 50% of gift value', 'up-sell-pro' ),
			),

		)
	)
];







