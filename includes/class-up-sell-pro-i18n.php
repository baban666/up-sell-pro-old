<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Up_Sell_Pro_i18n {


	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'up-sell-pro',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}
