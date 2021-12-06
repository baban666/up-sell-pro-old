<?php


namespace classes\views;

use classes\abstracts\UpSellProViewItem;

class UpSellProViewsPopUp extends UpSellProViewItem {

	public function __construct($settings, $helper, $dataProvider) {
		parent::__construct($settings, $helper, $dataProvider);
	}

	public function run(){
		if($this->settings['pop_enable_related_products'] === 'yes'){
			wp_enqueue_script( 'popupS', UP_SELL_PRO_URL . 'public/js/popupS.js', array( ), $this->version, true );
			add_action( 'wp_enqueue_scripts', array($this, 'localize'), 99 );
			add_filter( 'body_class',array($this, 'addBodyClasses') );
			add_action( 'wp_ajax_popUpResponse', array($this, 'render') );
			add_action( 'wp_ajax_nopriv_popUpResponse', array($this, 'render'));
		}
	}

	public function localize() {
		wp_localize_script( 'up-sell-pro', 'upSellPro', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'nonce-up-sell-pro' )
		) );
	}

	function addBodyClasses( $classes ) {

		if('yes' === get_option( 'woocommerce_cart_redirect_after_add')){
			$classes[] = 'up-sell-pro-redirect-after-add';
		}
		if('yes' === get_option( 'woocommerce_enable_ajax_add_to_cart') && 'no' === get_option( 'woocommerce_cart_redirect_after_add')){
			$classes[] = 'up-sell-pro-ajax';
		} else {
			$classes[] = 'up-sell-pro-not-ajax';
		}

		return $classes;
	}

	public function getArgs() {
		return array(
			'posts_per_page' => $this->settings['pop_additional_products'] !== null
                ? $this->settings['pop_additional_products']
                : 2,
			'orderby' => $this->settings['pop_relation_order'] !== null
                ? $this->settings['pop_relation_order']
                : 'rand',
			'add_random' => $this->settings['pop_add_if_empty'] == 'yes',
			'type' => $this->settings['pop_relation_priority'],
			'title' => $this->settings['pop_add_bundle'],
			'cart' => $this->settings['pop_cart_link'],
		);
	}

	public function render(){

		if ( empty( $_POST['nonce'] ) ) {
			wp_die( '0' );
		}

		if ( empty( $_POST['id'] ) ) {
			wp_die( '0' );
		}

		$args = $this->getArgs();
		$args['id'] = $_POST['id'];

		$row = $this->helper->getPopUpContent($args, $this->dataProvider);
		ob_end_clean();

		if ( check_ajax_referer( 'nonce-up-sell-pro', 'nonce', false ) ) {
			wp_send_json( ['markup' => $row,
			               'title' => esc_html__('Product has been added to your cart', 'up-sell-pro' ),
			               'continue' => esc_html__('Continue shopping', 'up-sell-pro' )
			] );
			wp_die(  );
		} else {
			wp_die( '0', '', 403 );
		}

	}
}
