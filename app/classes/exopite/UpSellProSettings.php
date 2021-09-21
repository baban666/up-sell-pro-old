<?php
namespace classes\exopite;


class UpSellProSettings {
	public $allSettings;

	public function __construct($allPluginsSettings) {
		$this->setAllSettings($allPluginsSettings);
	}

	public function getAllSettings() {
		return $this->allSettings;
	}

	public function setAllSettings( $allSettings ) {
		$this->allSettings = $allSettings;
	}

}
