<?php

namespace classes\settings;

use CSF;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProPluginSettings {
	public $allSettings;
	public $fields;
	public $config;
	public $type;
	public $defaultSettings;
	public $pluginName;


	public function __construct( $id, $pluginName, $title = 'Settings', $config = null, $defaultSettings = null, $type = 'codestar'  ) {

		if ( $config !== null ) {
			$this->config = $config;
		} else {
			$settings = array(
				'menu_title'              => $title,
				'menu_slug'               => $pluginName,
				'menu_type'               => 'menu',
				'menu_capability'         => 'manage_options',
				'menu_icon'               => 'dashicons-chart-area',
				'menu_position'           => null,
				'menu_hidden'             => true,
				'menu_parent'             => '',
				'sub_menu_title'          => '',
				'framework_title'         => $title,
				'id'                      => $id,
			);
			$this->setConfig( $settings );
		}
		$this->defaultSettings = $defaultSettings;
		$this->pluginName = $pluginName;
		$this->setType($type);
	}


	public function getConfig() {
		return $this->config;
	}

	public function setConfig( $config ) {
		$this->config = $config;
	}

	public function getAllSettings() {
		return $this->allSettings;
	}

	public function setAllSettings( $allSettings ) {
		$this->allSettings = $allSettings;
	}

	public function getFields() {
		foreach ( glob( UP_SELL_PRO_ROOT . 'includes/options-tabs/*.php' ) as $option_load ) {
			if ( is_file( $option_load ) ) {
				$opt = include $option_load;
				foreach ( $opt as $theme_options_add ) {
					$this->fields[] = $theme_options_add;
				}

			}
		}

		return $this->fields;
	}



	public function getType() {
		return $this->type;
	}


	public function setType( $type ) {
		$this->type = $type;
	}

	public function init() {
		if( class_exists( 'CSF' ) ) {

			// Set a unique slug-like ID
			$prefix = $this->pluginName;

			// Create options
			CSF::createOptions( $prefix, $this->getConfig() );

			// Create a section
			CSF::createSection( $prefix, array(
				'title'  => 'Tab Title 1',
				'fields' => array(

					// A text field
					array(
						'id'    => 'opt-text',
						'type'  => 'text',
						'title' => 'Simple Text',
					),

				)
			) );

			// Create a section
			CSF::createSection( $prefix, array(
				'title'  => 'Tab Title 2',
				'fields' => array(

					// A textarea field
					array(
						'id'    => 'opt-textarea',
						'type'  => 'textarea',
						'title' => 'Simple Textarea',
					),

				)
			) );

		}
	}


}
