<?php
use classes\helpers\UpSellProHelper;

$upSellIncreaseHelper = new UpSellProHelper();
return [array(
	'name'   => 'relation',
	'title'  => 'Relation',
	'icon'  => 'dashicons-rest-api',
	'fields' => array(

		// fields...
		array(
			'type'    => 'group',
			'id'      => 'relation_by_category',
			'title'   => esc_html__( 'Relation by categories', 'plugin-name' ),
			'options' => array(
				'repeater'          => true,
				'accordion'         => true,
				'button_title'      => esc_html__( 'Add new', 'plugin-name' ),
				'group_title'       => esc_html__( 'Accordion Title', 'plugin-name' ),
				'limit'             => 100,
				'sortable'          => true,
				'mode'              => 'compact',
			),
			'fields'  => array(
				array(
					'id'             => 'main-category',
					'type'           => 'select',
					'title'          => 'Select Chosen',
					'options'        => $upSellIncreaseHelper->getProductCategories(),
					//'default_option' => 'Select your favorite car',     // optional
					'default'     => '',                             // optional
					'class'       => 'chosen',                          // optional
					'prepend'     => 'dashicons-arrow-down-alt',        // optional, add icon, text before the element
					// optional, add icon, text after the element
					'attributes' => array(
						// optional, create a multi select
						'style'    => 'width: 200px; height: 125px;',   // optional
					),
				),

				array(
					'id'             => 'up-sell-categories',
					'type'           => 'select',
					'title'          => 'Select Chosen',
					'options'        => $upSellIncreaseHelper->getProductCategories(),
					//'default_option' => 'Select your favorite car',     // optional
					'default'     => '',                             // optional
					'class'       => 'chosen',                          // optional
					'prepend'     => 'dashicons-arrow-down-alt',        // optional, add icon, text before the element
					// optional, add icon, text after the element
					'attributes' => array(
						'multiple' => 'multiple',                       // optional, create a multi select
						'style'    => 'width: 200px; height: 125px;',   // optional
					),
				),

			),
		),

		array(
			'type'    => 'group',
			'id'      => 'relation_by_tag',
			'title'   => esc_html__( 'Relation by tags', 'plugin-name' ),
			'options' => array(
				'repeater'          => true,
				'accordion'         => true,
				'button_title'      => esc_html__( 'Add new', 'plugin-name' ),
				'group_title'       => esc_html__( 'Accordion Title', 'plugin-name' ),
				'limit'             => 100,
				'sortable'          => true,
				'mode'              => 'compact',
			),
			'fields'  => array(
				array(
					'id'             => 'main-tags',
					'type'           => 'select',
					'title'          => 'Select Chosen',
					'options'        => $upSellIncreaseHelper->getProductTags(),
					//'default_option' => 'Select your favorite car',     // optional
					'default'     => '',                             // optional
					'class'       => 'chosen',                          // optional
					'prepend'     => 'dashicons-arrow-down-alt',        // optional, add icon, text before the element
					// optional, add icon, text after the element
					'attributes' => array(
						// optional, create a multi select
						'style'    => 'width: 200px; height: 125px;',   // optional
					),
				),

				array(
					'id'             => 'up-sell-tags',
					'type'           => 'select',
					'title'          => 'Select Chosen',
					'options'        => $upSellIncreaseHelper->getProductTags(),
					//'default_option' => 'Select your favorite car',     // optional
					'default'     => '',                             // optional
					'class'       => 'chosen',                          // optional
					'prepend'     => 'dashicons-arrow-down-alt',        // optional, add icon, text before the element
					// optional, add icon, text after the element
					'attributes' => array(
						'multiple' => 'multiple',                       // optional, create a multi select
						'style'    => 'width: 200px; height: 125px;',   // optional
					),
				),

			),
		),

	),
)];

