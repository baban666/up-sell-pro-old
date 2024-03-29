<?php


namespace classes\views;

use classes\abstracts\UpSellProView;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProViewsProvider extends UpSellProView {

	public function __construct( $settings, $helper, $views, $dataProvider ) {
		parent::__construct( $settings, $helper, $views, $dataProvider );
	}

	public function getView( $type ) {
		if ( $this->views[ $type ] ) {
			return $this->views[ $type ];
		}
	}

	public function run() {
		$this->render();
	}

	public function render($arguments = '') {
		foreach ( $this->views as $key => $view ) {
			$this->views[ $key ]->run();
		}
	}
}
