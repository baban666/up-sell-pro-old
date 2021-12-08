<?php


return [array(
	'name'   => 'general',
	'title'  => 'General',
	'icon'  => 'dashicons-admin-tools',
	'fields' => array(

		array(
			'id'      => 'general_track_search',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Track search', 'up-sell-pro' ),
			'description' => esc_html__( 'Enable\Disable tracing of user\'s search queries on website', 'up-sell-pro' ),
			'default' => 'yes',
			'help'        => esc_html__( 'It helps better understand what user looked for in shop before placing an order', 'up-sell-pro' ),
		),

		array(
			'id'      => 'general_keep_queries',
			'type'    => 'range',
			'title'   => esc_html__( 'Keep queries', 'up-sell-pro' ),
			'description' => esc_html__( 'Set up the number of latest search queries to keep', 'up-sell-pro' ),
			'default' => '5',
			'min'     => '1',
			'max'     => '15',
			'step'    => '1',
		),

		array(
			'id'      => 'general_track_viewed',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Track viewed', 'up-sell-pro' ),
			'description' => esc_html__( 'Enable\Disable tracing of viewed products', 'up-sell-pro' ),
			'default' => 'yes',
			'help'        => 'It helps better understand which products  interesting user  shop before placing an order',
		),
	),
)];

