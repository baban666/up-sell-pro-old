<?php

namespace classes\exopite;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProExopiteConfigProvider {
	public $config;

	public function __construct( $id, $pluginName, $title = 'Settings', $config = null ) {

		if ( $config !== null ) {
			$this->config = $config;
		} else {
			$settings = array(
				'type'            => 'menu',
				'id'              => $id,
				'parent'          => '',
				'icon'            => 'dashicons-chart-area',
				'submenu'         => false,
				'menu_title'      => $title,
				'title'           => $title,
				'option_title'    => $title,
				'capability'      => 'manage_options',
				'plugin_basename' => plugin_basename( plugin_dir_path( __DIR__ ) . $pluginName . '.php' ),
				'multilang'       => false,
			);
			$this->setConfig( $settings );
		}
	}

	public function getConfig() {
		return $this->config;
	}

	public function setConfig( $config ) {
		$this->config = $config;
	}

}
