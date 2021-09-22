<?php
return [array(
	'name'   => 'pop',
	'title'  => 'Pop up',
	'icon'   => 'dashicons-format-aside',
	'fields' => array(
		array(
			'id'      => 'pop_enable_related_products',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable Pop Up', 'plugin-name' ), // optional
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			'default' => 'yes',                                   // optional
			'help'        => 'Help text',
		),

		array(
			'id'      => 'pop_additional_products',
			'type'    => 'range',
			'title'   => 'Additional Products',
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			'default' => '2',                                     // optional
			// 'unit'    => '$',                                      // optional
			// 'after'   => ' <i class="text-muted">$ (dollars)</i>', // optional
			'min'     => '1',                                      // optional
			'max'     => '3',                                     // optional
			'step'    => '1',
			'help'        => 'Help text',    // optional
		),
		array(
			'id'          => 'pop_add_bundle',
			'type'        => 'text',
			'title'       => 'Buy the bundle text',
			//'prepend' => 'fa-font',             // optional
			//'append'  => 'Char',                // optional
			// 'before'      => 'Text Before',  // optional
			// 'after'       => 'Text After',   // optional
			// 'class'       => 'text-class',   // optional
			// 'description' => 'Description',  // optional
			'default'     => 'Buy the bundle', // optional
			'attributes'    => array(
				'placeholder' => 'Buy the bundle',     // optional
				// 'data-test'   => 'test',      // optional, some extra HTML attribute(s)

			),
			'help'        => 'Help text',    // optional
		),
		array(
			'id'          => 'pop_add_to_cart',
			'type'        => 'text',
			'title'       => 'Add to cart text',
			//'prepend' => 'fa-font',             // optional
			//'append'  => 'Char',                // optional
			// 'before'      => 'Text Before',  // optional
			// 'after'       => 'Text After',   // optional
			// 'class'       => 'text-class',   // optional
			// 'description' => 'Description',  // optional
			'default'     => 'Add to cart', // optional
			'attributes'    => array(
				'placeholder' => 'Add to cart',     // optional
				// 'data-test'   => 'test',      // optional, some extra HTML attribute(s)

			),
			'help'        => 'Help text',    // optional
		),

		array(
			'id'             => 'pop_relation_priority',
			'type'           => 'select',
			'title'          => 'Relation data',
			'options'        => array(
				'tags'          => 'Tags',
				'categories'    => 'Categories',
				'viewed'        => 'Viewed',
			),
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			//'default_option' => 'categories',     // optional
			'default'     => 'categories',                             // optional
			'class'       => 'chosen',                          // optional
			'prepend'     => 'dashicons-arrow-down-alt',        // optional, add icon, text before the element
			//'append'      => 'dashicons-admin-tools',           // optional, add icon, text after the element
			'help'        => 'Help text',
		),

		array(
			'id'      => 'pop_add_if_empty',
			'type'    => 'radio',
			'title'   => 'Add random relations',
			'description' => esc_html__( 'Add product if relations are empty', 'plugin-name' ),
			'options' => array(
				'yes'   => 'Yes',
				'no'    => 'No',
			),
			'default' => 'yes',
			'style'    => 'fancy',
		),


		array(
			'id'      => 'pop_relation_order',
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







