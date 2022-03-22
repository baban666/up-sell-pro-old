<?php
use classes\helpers\UpSellProHelper;

$upSellIncreaseHelper = new UpSellProHelper();

return [array(
	'name'   => 'relation',
	'title'  => esc_html__( 'Relation', 'up-sell-pro' ),
	'icon'  => 'fas fa-sitemap',
	'fields' => array(

		array(
			'type'    => 'repeater',
			'id'      => 'relation_by_category',
			'title'   => esc_html__( 'Relation by categories', 'up-sell-pro' ),
			'subtitle' => esc_html__( 'Set up the relations between products categories', 'up-sell-pro' ),
			'help'        => esc_html__( 'It helps to create mass relations between categories (for example: laptops->mouses, cases and etc.)', 'up-sell-pro' ),
			'max' => 40,
			'button_title' =>  esc_html__( 'Add Relation', 'up-sell-pro' ),
			'fields'  => array(
				array(
					'id'          => 'main-category',
					'type'        => 'select',
					'title'       => esc_html__( 'Main category', 'up-sell-pro' ),
					'chosen'      => true,
					'placeholder' => esc_html__( 'Select category', 'up-sell-pro' ),
					'options'     => $upSellIncreaseHelper->getProductCategories(),
				),
				array(
					'id'          => 'up-sell-categories',
					'type'        => 'select',
					'title'       => esc_html__( 'Related categories', 'up-sell-pro' ),
					'placeholder' => esc_html__( 'Select categories', 'up-sell-pro' ),
					'chosen'      => true,
					'ajax'        => true,
					'multiple'    => true,
					'sortable'    => true,
					'options'     => $upSellIncreaseHelper->getProductCategories(),
				),
			),
		),

		array(
			'type'    => 'repeater',
			'id'      => 'relation_by_tag',
			'title'   => esc_html__( 'Relation by tags', 'up-sell-pro' ),
			'subtitle' => esc_html__( 'Set up the relations between products tags', 'up-sell-pro' ),
			'help'        => esc_html__( 'It helps to create mass relations between tags (for example: electronics->cables, supplies and etc.)', 'up-sell-pro' ),
			'max' => 40,
			'button_title' =>  esc_html__( 'Add Relation', 'up-sell-pro' ),
			'fields'  => array(
				array(
					'id'          => 'main-tags',
					'type'        => 'select',
					'title'       => esc_html__( 'Main tag', 'up-sell-pro' ),
					'chosen'      => true,
					'placeholder' => esc_html__( 'Select tag', 'up-sell-pro' ),
					'options'     => $upSellIncreaseHelper->getProductTags(),
				),
				array(
					'id'          => 'up-sell-tags',
					'type'        => 'select',
					'title'       => esc_html__( 'Related tags', 'up-sell-pro' ),
					'placeholder' => esc_html__( 'Select tags', 'up-sell-pro' ),
					'chosen'      => true,
					'ajax'        => true,
					'multiple'    => true,
					'sortable'    => true,
					'options'     => $upSellIncreaseHelper->getProductTags(),
				),
			),
		),

		// A Notice
		array(
			'type'    => 'submessage',
			'style'   => 'normal',
			'content' => esc_html__( 'You can add up to 40 relations for every type', 'up-sell-pro' ),
		),
	),
)];

