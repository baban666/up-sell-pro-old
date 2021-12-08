<?php
use classes\helpers\UpSellProHelper;

$upSellIncreaseHelper = new UpSellProHelper();
return [array(
	'name'   => 'relation',
	'title'  => 'Relation',
	'icon'  => 'dashicons-rest-api',
	'fields' => array(
		array(
			'type'    => 'group',
			'id'      => 'relation_by_category',
			'title'   => esc_html__( 'Relation by categories', 'up-sell-pro' ),
			'description' => esc_html__( 'Set up the relations between products categories', 'up-sell-pro' ),
			'help'        => esc_html__( 'It helps to create mass relations between categories (for example: laptops->mouses, cases and etc.)', 'up-sell-pro' ),
			'options' => array(
				'repeater'          => true,
				'accordion'         => true,
				'button_title'      => esc_html__( 'Add new', 'up-sell-pro' ),
				'group_title'       => esc_html__( 'Accordion Title', 'up-sell-pro' ),
				'limit'             => 100,
				'sortable'          => true,
				'mode'              => 'compact',
			),
			'fields'  => array(
				array(
					'id'             => 'main-category',
					'type'           => 'select',
					'title'          => esc_html__( 'Select Chosen', 'up-sell-pro' ),
					'options'        => $upSellIncreaseHelper->getProductCategories(),
					'default'     => '',
					'class'       => 'chosen',
					'prepend'     => 'dashicons-arrow-down-alt',
					'attributes' => array(
						'style'    => 'width: 200px; height: 125px;',
					),
				),

				array(
					'id'             => 'up-sell-categories',
					'type'           => 'select',
					'title'          => esc_html__( 'Select Chosen', 'up-sell-pro' ),
					'options'        => $upSellIncreaseHelper->getProductCategories(),
					'default'     => '',
					'class'       => 'chosen',
					'prepend'     => 'dashicons-arrow-down-alt',
					'attributes' => array(
						'multiple' => 'multiple',
						'style'    => 'width: 200px; height: 125px;',
					),
				),

			),
		),

		array(
			'type'    => 'group',
			'id'      => 'relation_by_tag',
			'title'   => esc_html__( 'Relation by tags', 'up-sell-pro' ),
			'description' => esc_html__( 'Set up the relations between products tags', 'up-sell-pro' ),
			'help'        => esc_html__( 'It helps to create mass relations between tags (for example: electronics->cables, supplies and etc.)', 'up-sell-pro' ),
			'options' => array(
				'repeater'          => true,
				'accordion'         => true,
				'button_title'      => esc_html__( 'Add new', 'up-sell-pro' ),
				'group_title'       => esc_html__( 'Accordion Title', 'up-sell-pro' ),
				'limit'             => 100,
				'sortable'          => true,
				'mode'              => 'compact',
			),
			'fields'  => array(
				array(
					'id'             => 'main-tags',
					'type'           => 'select',
					'title'          => esc_html__( 'Select Chosen', 'up-sell-pro' ),
					'options'        => $upSellIncreaseHelper->getProductTags(),
					'default'     => '',
					'class'       => 'chosen',
					'prepend'     => 'dashicons-arrow-down-alt',
					'attributes' => array(
						'style'    => 'width: 200px; height: 125px;',
					),
				),

				array(
					'id'             => 'up-sell-tags',
					'type'           => 'select',
					'title'          => esc_html__( 'Select Chosen', 'up-sell-pro' ),
					'options'        => $upSellIncreaseHelper->getProductTags(),
					'default'     => '',
					'class'       => 'chosen',
					'prepend'     => 'dashicons-arrow-down-alt',
					'attributes' => array(
						'multiple' => 'multiple',
						'style'    => 'width: 200px; height: 125px;',
					),
				),

			),
		),
	),
)];

