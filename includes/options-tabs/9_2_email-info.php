<?php


return [
	array(
		'name'   => 'new_order_email_info',
		'title'  => esc_html__( 'New Order Email', 'up-sell-pro' ),
		'icon'   => 'fas fa-store',
		'fields' => array(
			array(
				'id'       => 'email_info_enable',
				'type'     => 'switcher',
				'title'    => esc_html__( 'Enable notice', 'up-sell-pro' ),
				'subtitle' => esc_html__( 'Enable\Disable New Order Email notice for client', 'up-sell-pro' ),
				'default'  => '0',
				'help'     => esc_html__( 'It shows notice in new order email', 'up-sell-pro' ),
			),

			array(
				'id'           => 'email_info_items',
				'type'         => 'repeater',
				'max' => 3,
				'title'        => esc_html__( 'Conditions', 'up-sell-pro' ),
				'subtitle'     => esc_html__( 'Conditions to show notices', 'up-sell-pro' ),
				'button_title' => esc_html__( 'Add Notice', 'up-sell-pro' ),
				'fields'       => array(
					array(
						'id'          => 'email_info_order_items',
						'type'        => 'select',
						'title'       => esc_html__( 'Products in order', 'up-sell-pro' ),
						'subtitle'    => esc_html__( 'Choose products', 'up-sell-pro' ),
						'chosen'      => true,
						'ajax'        => true,
						'multiple'    => true,
						'placeholder' => esc_html__( 'Select product', 'up-sell-pro' ),
						'options'     => 'posts',
						'query_args'  => array(
							'post_type'      => 'product',
							'status'         => 'publish',
							'posts_per_page' => - 1,
						),
					),
					array(
						'id'          => 'email_info_item_condition',
						'type'        => 'select',
						'title'       => esc_html__( 'Condition', 'up-sell-pro' ),
						'chosen'      => true,
						'placeholder' => esc_html__( 'Select condition', 'up-sell-pro' ),
						'options'     => array(
							'some'  => esc_html__( 'Some', 'up-sell-pro' ),
							'every' => esc_html__( 'Every', 'up-sell-pro' ),
							'any'   => esc_html__( 'Any', 'up-sell-pro' ),
						),
						'default'     => array( 'some' )
					),

					array(
						'id'          => 'email_info_item_title',
						'type'        => 'text',
						'title'       => esc_html__( 'Section title', 'up-sell-pro' ),
						'subtitle'    => esc_html__( 'Title if total cart is less than 50% of gift value', 'up-sell-pro' ),
						'default'     => esc_html__( 'Buying together often', 'up-sell-pro' ),
						'placeholder' => esc_html__( 'Put title text here', 'up-sell-pro' ),
					),

					array(
						'id'          => 'email_info_item_note',
						'type'        => 'textarea',
						'title'       => esc_html__( 'Note message', 'up-sell-pro' ),
						'subtitle'    => esc_html__( 'Title if total cart is less than 50% of gift value', 'up-sell-pro' ),
						'default'     => esc_html__( 'Buying together often', 'up-sell-pro' ),
						'placeholder' => esc_html__( 'Put title text here', 'up-sell-pro' ),
					),
				),
				'dependency'   => array( 'email_info_enable', '==', '1', '', 'visible' ),
			),

		)
	)
];







