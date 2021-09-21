<?php
return [array(
	'name'   => 'order',
	'title'  => 'Order',
	'icon'   => 'dashicons-media-spreadsheet',
	'fields' => array(
		array(
			'id'        => 'order_add_to_order',
			'type'      => 'tap_list',
			'title'   => esc_html__( 'Add to order', 'plugin-name' ), // optional
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional 			// optional
			'help'        => 'Help text',
			'options'   => array(
				'search' => 'Search queries',
				'viewed' => 'Viewed products',
				'category' => 'Category relations',
				'tag' => 'Tag relations',
			),
			'radio'        => false,        // optional, true or false
		),

		array(
			'id'      => 'order_order_items',
			'type'    => 'range',
			'title'   => 'Max items in order',
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			'default' => '5',                                     // optional
			'min'     => '1',                                      // optional
			'max'     => '15',                                     // optional
			'step'    => '1',                                      // optional
			'help'        => 'Help text',
		),

		array(
			'id'      => 'order_relation_order',
			'type'    => 'button_bar',
			'title'   => 'Order by',
			'options' => array(
				'rand'    => 'Random',
				'name'    => 'Name',
				'title'    => 'Title',
				'date'    => 'Date',
				'modified'    => 'Modified',
			),
			'default' => 'rand',
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			'help'        => 'Help text',
		),

	)
)];







