<?php


namespace classes\data;

use classes\abstracts\UpSellProData;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProDataProvider extends UpSellProData {

	public function __construct( $settings, $helper, $providers ) {
		parent::__construct( $settings, $helper, $providers );
	}

	public function getProvider( $type ) {
		switch ( $type ) {
			case 'tags':
				return $this->providers['tags'];
				break;
			case 'categories':
				return $this->providers['categories'];
				break;
			case 'viewed':
				return $this->providers['viewed'];
				break;
			case 'search':
				return $this->providers['search'];
				break;
			default:
				return $this->providers['random'];
		}
	}

	public function getData( $args ) {

	}
}
