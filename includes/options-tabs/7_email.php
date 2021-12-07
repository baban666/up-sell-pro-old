<?php
return [array(
	'name'   => 'email',
	'title'  => 'Email',
	'icon'   => 'dashicons-email-alt',
	'fields' => array(
		array(
			'id'        => 'email_add_to_order',
			'type'      => 'tap_list',
			'title'   => esc_html__( 'Add to email', 'plugin-name' ), // optional
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional 			// optional
			'help'        => 'Help text',
			'options'   => array(
				'search' => 'Search queries',
				'viewed' => 'Viewed products',
				'category' => 'Category relations',
				'tag' => 'Tag relations',
			),
			'radio'        => false,
			'default' => 'viewed',
		),

		array(
			'id'      => 'email_order_items',
			'type'    => 'range',
			'title'   => 'Max items in email',
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			'default' => '5',                                     // optional
			'min'     => '1',                                      // optional
			'max'     => '15',                                     // optional
			'step'    => '1',                                      // optional
			'help'        => 'Help text',
		),

		array(
			'id'      => 'email_relation_order',
			'type'    => 'button_bar',
			'title'   => 'Order by',
			'options' => array(
				'rand'     => 'Random',
				'name'     => 'Name',
				'title'    => 'Title',
				'date'     => 'Date',
				'modified' => 'Modified',
			),
			'default' => 'rand',
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			'help'        => 'Help text',
		),
	)
)];







