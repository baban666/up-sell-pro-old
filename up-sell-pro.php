<?php

/**
 * Plugin Name:       Up Sell Pro
 * Plugin URI:        https://up-sell-pro.first-design-company.com/
 * Description:       Up Sell Pro is an easy and powerful plugin to set up upsell and cross-sell for your WooCommerce shop. This is up-selling, cross-selling plugin for WooCommerce helps you Increase revenue as well as profitability for your eCommerce website.
 * Version:           1.2.0
 * Author:            AliceThemes
 * Author URI:        https://first-design-company.com/
 * Text Domain:       up-sell-pro
 * Domain Path:       /languages
 * Requires PHP: 7.1
 * Tags: bulk crosssells, bulk upsells, cross-sells, crosssells, crosssells copy, mass crosssells, mass upsells, up-sells, upsells, woocommerce, woocommerce bulk up-sells and cross-sells, boost sales for woocommerce, marketing plugin, upsells popups, woocommerce display cross sells on product page
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'UP_SELL_PRO_VERSION', '1.2.0' );
define( 'UP_SELL_PRO_ROOT', plugin_dir_path( __FILE__ ) );
define( 'UP_SELL_PRO_LANG', UP_SELL_PRO_ROOT . '/languages/up-sell-pro' );
define( 'UP_SELL_PRO_URL', plugin_dir_url( __FILE__ ) );

function activate_up_sell_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-up-sell-pro-activator.php';
	Up_Sell_Pro_Activator::activate();
}


function deactivate_up_sell_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-up-sell-pro-deactivator.php';
	Up_Sell_Pro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_up_sell_pro' );
register_deactivation_hook( __FILE__, 'deactivate_up_sell_pro' );


require plugin_dir_path( __FILE__ ) . 'includes/class-up-sell-pro.php';


function run_up_sell_pro() {

	$plugin = new Up_Sell_Pro();
	$plugin->run();

}

function up_sell_pro_general_admin_notice(){
	if ( current_user_can( 'manage_options' ) ) {
		echo '<div class="notice notice-warning is-dismissible">
             <p>'. esc_html__( 'Sorry, Up Sell Pro plugin works only with Woocommerce plugin. Please, deactivate Up Sell Pro plugin or activate Woocommerce plugin', 'up-sell-pro').'</p>
         </div>';
	}
}

if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	run_up_sell_pro();
} else{
	add_action('admin_notices', 'up_sell_pro_general_admin_notice');
}
