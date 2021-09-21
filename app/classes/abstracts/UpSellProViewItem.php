<?php
namespace classes\abstracts;

use interfaces\IUpSellProView;

abstract class UpSellProViewItem implements IUpSellProView {
	public $settings;
	public $helper;
	public $dataProvider;

	public function __construct($settings, $helper, $dataProvider) {
		$this->settings = $settings->allSettings;
		$this->helper = $helper;
		$this->dataProvider = $dataProvider;
	}
	abstract function render();
	abstract function run();
}
