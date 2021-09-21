<?php
namespace classes\abstracts;

use interfaces\IUpSellProView;

abstract class UpSellProView implements IUpSellProView {
	public $settings;
	public $helper;
	public $views;
	public $dataProvider;

	public function __construct($settings, $helper, $views, $dataProvider) {
		$this->settings = $settings->allSettings;
		$this->helper = $helper;
		$this->views = $views;
		$this->dataProvider = $dataProvider;
	}
	abstract function render();
	abstract function run();
}
