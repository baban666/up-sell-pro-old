<?php
namespace classes\abstracts;

use interfaces\IUpSellProData;

abstract class UpSellProData implements IUpSellProData {
	public $settings;
	public $helper;
	public $providers;

	public function __construct($settings, $helper, $providers) {
		$this->settings = $settings->allSettings;
		$this->helper = $helper;
		$this->providers = $providers;
	}
	abstract function getData($args);
}
