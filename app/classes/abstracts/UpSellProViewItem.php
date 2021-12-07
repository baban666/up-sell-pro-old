<?php

namespace classes\abstracts;

use interfaces\IUpSellProView;

if ( ! defined( 'WPINC' ) ) {
	die;
}

abstract class UpSellProViewItem implements IUpSellProView {
	public $settings;
	public $helper;
	public $dataProvider;
	public $version;

	public function __construct( $settings, $helper, $dataProvider, $version ) {
		$this->settings     = $settings->allSettings;
		$this->helper       = $helper;
		$this->dataProvider = $dataProvider;
		$this->version      = $version;
	}

	abstract function render();

	abstract function run();
}
