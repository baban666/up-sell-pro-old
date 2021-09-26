<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       veraksoff.info
 * @since      1.0.0
 *
 * @package    Up_Sell_Pro
 * @subpackage Up_Sell_Pro/includes
 */

use classes\cart\UpSellProMultipleAddToCart;
use classes\data\UpSellProDataByCategories;
use classes\data\UpSellProDataByRandom;
use classes\data\UpSellProDataBySearch;
use classes\data\UpSellProDataByTags;
use classes\data\UpSellProDataByViewed;
use classes\data\UpSellProDataProvider;
use classes\exopite\UpSellProExopiteConfigProvider;
use classes\exopite\UpSellProExopiteFieldsProvider;
use classes\exopite\UpSellProExopitePluginOptions;
use classes\exopite\UpSellProSettings;
use classes\helpers\UpSellProHelper;
use classes\views\UpSellProViewsCart;
use classes\views\UpSellProViewsEmail;
use classes\views\UpSellProViewsOrder;
use classes\views\UpSellProViewsPopUp;
use classes\views\UpSellProViewsProduct;
use classes\views\UpSellProViewsProvider;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Up_Sell_Pro
 * @subpackage Up_Sell_Pro/includes
 * @author     Uladzimir Veraksa <baban666@tut.by>
 */
class Up_Sell_Pro {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Up_Sell_Pro_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'UP_SELL_PRO_VERSION' ) ) {
			$this->version = UP_SELL_PRO_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'up-sell-pro';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Up_Sell_Pro_Loader. Orchestrates the hooks of the plugin.
	 * - Up_Sell_Pro_i18n. Defines internationalization functionality.
	 * - Up_Sell_Pro_Admin. Defines all hooks for the admin area.
	 * - Up_Sell_Pro_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-up-sell-pro-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-up-sell-pro-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-up-sell-pro-admin.php';

		/**
		 * The libs.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'libs/exopite-simple-options/exopite-simple-options-framework-class.php';


		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-up-sell-pro-public.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'vendor/autoload.php';


		$configProvider = new UpSellProExopiteConfigProvider($this->plugin_name, $this->plugin_name, 'Up Sell Pro');
		$fieldsProvider = new UpSellProExopiteFieldsProvider();
		$options = new UpSellProExopitePluginOptions($configProvider, $fieldsProvider);
		$options->init();

		$allSettings =  new UpSellProSettings(get_exopite_sof_option($this->plugin_name));

		$helper = new UpSellProHelper();

		$providers = [
			'tags'          => new UpSellProDataByTags($allSettings, $helper),
			'categories'    => new UpSellProDataByCategories($allSettings, $helper),
			'viewed'        => new UpSellProDataByViewed($allSettings, $helper),
			'random'        => new UpSellProDataByRandom($allSettings, $helper),
			'search'        => new UpSellProDataBySearch($allSettings, $helper),
		];
		$dataProvider = new UpSellProDataProvider($allSettings, $helper, $providers);

		$views = [
			'pop'          => new UpSellProViewsPopUp($allSettings, $helper, $dataProvider),
			'product'      => new UpSellProViewsProduct($allSettings, $helper, $dataProvider),
			'cart'        => new UpSellProViewsCart($allSettings, $helper, $dataProvider),
			'email'        => new UpSellProViewsEmail($allSettings, $helper, $dataProvider),
			'order'        => new UpSellProViewsOrder($allSettings, $helper, $dataProvider),
		];
		$viewsProvider = new UpSellProViewsProvider($allSettings, $helper, $views, $dataProvider);
		$viewsProvider->run();


		$this->loader = new Up_Sell_Pro_Loader();

		new UpSellProMultipleAddToCart();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Up_Sell_Pro_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Up_Sell_Pro_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Up_Sell_Pro_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Up_Sell_Pro_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Up_Sell_Pro_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
