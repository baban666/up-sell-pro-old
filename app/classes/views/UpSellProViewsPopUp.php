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
			$this->render();
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
