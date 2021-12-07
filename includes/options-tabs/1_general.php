<?php


return [array(
	'name'   => 'general',
	'title'  => 'General',
	'icon'  => 'dashicons-admin-tools',
	'fields' => array(

		array(
			'id'      => 'general_track_search',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Track search', 'plugin-name' ),
			'description' => esc_html__( 'Some description', 'plugin-name' ),
			'default' => 'yes',
			'help'        => 'Help text',
		),

		array(
			'id'      => 'general_keep_queries',
			'type'    => 'range',
			'title'   => 'Keep queries',
			'description' => esc_html__( 'Some description', 'plugin-name' ),
			'default' => '5',
			'min'     => '1',
			'max'     => '15',
			'step'    => '1',
			'help'        => 'Help text',
		),

		array(
			'id'      => 'general_track_viewed',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Track viewed', 'plugin-name' ),
			'description' => esc_html__( 'Some description', 'plugin-name' ),
			'default' => 'yes',
			'help'        => 'Help text',
		),
	),
)];

