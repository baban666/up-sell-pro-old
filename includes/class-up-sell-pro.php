<?php

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
use classes\settings\UpSellProPluginSettings;
use classes\views\UpSellProViewsCart;
use classes\views\UpSellProViewsEmail;
use classes\views\UpSellProViewsOrder;
use classes\views\UpSellProViewsPopUp;
use classes\views\UpSellProViewsProduct;
use classes\views\UpSellProViewsProvider;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Up_Sell_Pro {

	protected $loader;

	protected $plugin_name;

	protected $version;

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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'libs/codestar-framework/codestar-framework.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-up-sell-pro-public.php';

		/**
		 * The classes autoload
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'vendor/autoload.php';

		/**
		 * Default-options
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/default-options/default-options.php';



		$allSettings = new UpSellProPluginSettings($this->plugin_name, 'Up Sell Pro', upSellProGetDefaultOptions());
		$allSettings->init();

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
			'pop'          => new UpSellProViewsPopUp($allSettings, $helper, $dataProvider, $this->version),
			'product'      => new UpSellProViewsProduct($allSettings, $helper, $dataProvider, $this->version),
			'cart'        => new UpSellProViewsCart($allSettings, $helper, $dataProvider, $this->version),
			'email'        => new UpSellProViewsEmail($allSettings, $helper, $dataProvider, $this->version),
			'order'        => new UpSellProViewsOrder($allSettings, $helper, $dataProvider, $this->version),
		];
		$viewsProvider = new UpSellProViewsProvider($allSettings, $helper, $views, $dataProvider);
		$viewsProvider->run();

		$this->loader = new Up_Sell_Pro_Loader();

		new UpSellProMultipleAddToCart();

	}

	private function set_locale() {

		$plugin_i18n = new Up_Sell_Pro_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_admin_hooks() {

		$plugin_admin = new Up_Sell_Pro_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	private function define_public_hooks() {

		$plugin_public = new Up_Sell_Pro_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
