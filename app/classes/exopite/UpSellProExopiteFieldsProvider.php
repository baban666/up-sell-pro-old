<?php

namespace classes\exopite;
if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProExopiteFieldsProvider {

	public $fields;

	public function getFields() {
		foreach ( glob( UP_SELL_PRO_ROOT . 'includes/options-tabs/*.php' ) as $option_load ) {
			if ( is_file( $option_load ) ) {
				$opt = include $option_load;
				foreach ( $opt as $theme_options_add ) {
					$this->fields[] = $theme_options_add;
				}

			}
		}

		return $this->fields;
	}

}
