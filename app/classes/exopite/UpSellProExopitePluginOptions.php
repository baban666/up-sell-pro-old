<?php

namespace classes\exopite;

use Exopite_Simple_Options_Framework;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProExopitePluginOptions {

	public $configProvider;
	public $fieldsProvider;

	public function __construct( $configProvider, $fieldsProvider ) {
		$this->setConfigProvider( $configProvider );
		$this->setFieldsProvider( $fieldsProvider );
	}

	public function init() {
		return new Exopite_Simple_Options_Framework( $this->configProvider->getConfig(), $this->fieldsProvider->getFields() );
	}

	public function setConfigProvider( $configProvider ) {
		$this->configProvider = $configProvider;
	}

	public function setFieldsProvider( $fieldsProvider ) {
		$this->fieldsProvider = $fieldsProvider;
	}

}
