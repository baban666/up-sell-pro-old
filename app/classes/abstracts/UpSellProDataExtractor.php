<?php

namespace classes\abstracts;

use interfaces\IUpSellProData;

if ( ! defined( 'WPINC' ) ) {
	die;
}

abstract class UpSellProDataExtractor implements IUpSellProData {
	public $settings;
	public $helper;

	public function __construct( $settings, $helper ) {
		$this->settings = $settings->allSettings;
		$this->helper   = $helper;
	}

	abstract function getData( $args );
}
