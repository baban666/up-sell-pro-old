<?php


return [array(
	'name'   => 'general',
	'title'  => 'General',
	'icon'  => 'dashicons-admin-tools',
	'fields' => array(

		array(
			'id'      => 'general_track_search',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Track search', 'plugin-name' ), // optional
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			'default' => 'yes',                                   // optional
			'help'        => 'Help text',
		),

		array(
			'id'      => 'general_keep_queries',
			'type'    => 'range',
			'title'   => 'Keep queries',
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			'default' => '5',                                     // optional
			// 'unit'    => '$',                                      // optional
			// 'after'   => ' <i class="text-muted">$ (dollars)</i>', // optional
			'min'     => '1',                                      // optional
			'max'     => '15',                                     // optional
			'step'    => '1',                                      // optional
			'help'        => 'Help text',
		),

		array(
			'id'      => 'general_track_viewed',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Track viewed', 'plugin-name' ), // optional
			'description' => esc_html__( 'Some description', 'plugin-name' ), // optional
			'default' => 'yes',                                   // optional
			'help'        => 'Help text',
		),
	),


)];

