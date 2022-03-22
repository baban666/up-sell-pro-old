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


	public function __construct( $pluginName, $title = 'Settings', $defaultSettings = null, $type = 'codestar', $config = null ) {

		if ( $config !== null ) {
			$this->config = $config;
		} else {
			$settings = array(
				'menu_title'      => $title,
				'menu_slug'       => $pluginName,
				'menu_type'       => 'menu',
				'menu_capability' => 'manage_options',
				'menu_icon'       => 'dashicons-chart-area',
				'menu_position'   => null,
				'menu_hidden'     => false,
				'menu_parent'     => '',
				'sub_menu_title'  => '',
				'theme'           => 'light',
				'framework_title' => $title,
			);
			$this->setConfig( $settings );
		}
		$this->defaultSettings = $defaultSettings;
		$this->pluginName      = $pluginName;
		$this->setType( $type );
		$this->fields = $this->getFields();
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

	public function runCSF() {
		if ( class_exists( 'CSF' ) ) {
			CSF::createOptions( $this->pluginName, $this->getConfig() );

			foreach ( $this->fields as $key => $value ) {
				CSF::createSection( $this->pluginName, array(
					'title'  => $value['title'],
					'fields' => $value['fields'],
					'icon'   => $value['icon'],
				) );
			}

			if ( ! get_option( $this->pluginName ) ) {
				$this->setAllSettings( $this->defaultSettings );
			} else {
				$this->setAllSettings( get_option( $this->pluginName ) );
			}
		}
	}


	public function init() {
		if ( $this->getType() === 'codestar' ) {
			$this->runCSF();
		}
	}


}
