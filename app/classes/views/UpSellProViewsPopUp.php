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
			add_action( 'wp_ajax_popUpResponse', array($this, 'popUpResponse') );
			add_action( 'wp_ajax_nopriv_popUpResponse', array($this, 'popUpResponse'));
			$this->render();
		}
	}

	public function localize() {
		wp_localize_script( 'up-sell-pro', 'upSellPro', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'nonce-up-sell-pro' )
		) );
	}


	public function popUpResponse() {

		if ( empty( $_POST['nonce'] ) ) {
			wp_die( '0' );
		}
		$product_id        = $_POST['id'];



		if ( check_ajax_referer( 'nonce-up-sell-pro', 'nonce', false ) ) {
			wp_send_json( $product_id    );
			wp_die(  );
		} else {
			wp_die( 'Эх!', '', 403 );
		}

	}

	public function getArgs() {
		return array(
			'posts_per_page' => $this->settings['product_page_additional_products'] !== null
                ? $this->settings['product_page_additional_products']
                : 2,
			'orderby' => $this->settings['product_page_relation_order'] !== null
                ? $this->settings['product_page_relation_order']
                : 'rand',
			'add_random' => $this->settings['product_page_add_if_empty'] == 'yes',
			'type' => $this->settings['product_page_relation_priority'],
			'offset_search' => $this->settings['general_keep_queries'],
		);
	}

	public function render(){


	}
}
