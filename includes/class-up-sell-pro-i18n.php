<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       veraksoff.info
 * @since      1.0.0
 *
 * @package    Up_Sell_Pro
 * @subpackage Up_Sell_Pro/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Up_Sell_Pro
 * @subpackage Up_Sell_Pro/includes
 * @author     Uladzimir Veraksa <baban666@tut.by>
 */
class Up_Sell_Pro_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'up-sell-pro',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
