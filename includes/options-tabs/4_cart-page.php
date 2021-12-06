<?php
return [array(
	'name'   => 'cart_page',
	'title'  => 'Cart Page',
	'icon'   => 'dashicons-cart',
	'fields' => array(
		array(
			'id'      => 'cart_enable_related_products',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Enable related products', 'plugin-name' ), // optional
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			'default' => 'yes',                                   // optional
			'help'        => 'Help text',
		),

		array(
			'id'      => 'cart_relation_place',
			'type'    => 'button_bar',
			'title'   => 'Relation place',
			'options' => array(
				'woocommerce_after_cart_contents'   => 'After content',
				'woocommerce_after_cart_table'      => 'After table',
				'woocommerce_after_cart'      => 'After cart',
			),
			'default' => 'woocommerce_after_cart_contents',
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			'help'        => 'Help text',
		),


		array(
			'id'      => 'cart_additional_products',
			'type'    => 'range',
			'title'   => 'Additional Products',
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			'default' => '2',                                     // optional
			// 'unit'    => '$',                                      // optional
			// 'after'   => ' <i class="text-muted">$ (dollars)</i>', // optional
			'min'     => '1',                                      // optional
			'max'     => '4',                                     // optional
			'step'    => '1',
			'help'        => 'Help text',    // optional
		),
		array(
			'id'          => 'cart_add_bundle',
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
			'id'          => 'cart_add_to_cart_desc',
			'type'        => 'text',
			'title'       => 'Add to cart desc',
			//'prepend' => 'fa-font',             // optional
			//'append'  => 'Char',                // optional
			// 'before'      => 'Text Before',  // optional
			// 'after'       => 'Text After',   // optional
			// 'class'       => 'text-class',   // optional
			// 'description' => 'Description',  // optional
			'default'     => 'Full price', // optional
			'attributes'    => array(
				'placeholder' => 'Full price:',     // optional
				// 'data-test'   => 'test',      // optional, some extra HTML attribute(s)
			),
			'help'        => 'Help text',    // optional
		),

		array(
			'id'             => 'cart_relation_priority',
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
			'id'      => 'cart_add_if_empty',
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
			'id'      => 'cart_relation_order',
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







