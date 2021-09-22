<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              veraksoff.info
 * @since             1.0.0
 * @package           Up_Sell_Pro
 *
 * @wordpress-plugin
 * Plugin Name:       Up Sell Pro
 * Plugin URI:        veraksoff.info
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Uladzimir Veraksa
 * Author URI:        veraksoff.info
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       up-sell-pro
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'UP_SELL_PRO_VERSION', '1.0.0' );
define( 'UP_SELL_PRO_ROOT', plugin_dir_path( __FILE__ ) );
define( 'UP_SELL_PRO_URL', plugin_dir_url( __FILE__ ) );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-up-sell-pro-activator.php
 */
function activate_up_sell_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-up-sell-pro-activator.php';
	Up_Sell_Pro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-up-sell-pro-deactivator.php
 */
function deactivate_up_sell_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-up-sell-pro-deactivator.php';
	Up_Sell_Pro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_up_sell_pro' );
register_deactivation_hook( __FILE__, 'deactivate_up_sell_pro' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-up-sell-pro.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_up_sell_pro() {

	$plugin = new Up_Sell_Pro();
	$plugin->run();

}
run_up_sell_pro();
