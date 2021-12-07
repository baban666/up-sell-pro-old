<?php

namespace classes\exopite;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProSettings {
	public $allSettings;

	public function __construct( $allPluginsSettings ) {
		$this->setAllSettings( $allPluginsSettings );
		if (!$this->allSettings){
			$this->setAllSettings( upSellProGetDefaultOptions() );
		}
	}

	public function getAllSettings() {
		return $this->allSettings;
	}

	public function setAllSettings( $allSettings ) {
		$this->allSettings = $allSettings;
	}

}
