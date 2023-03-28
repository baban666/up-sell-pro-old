<?php


namespace classes\views;

use classes\abstracts\UpSellProViewItem;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProViewsNewOrderEmail extends UpSellProViewItem {

	public function __construct( $settings, $helper, $dataProvider, $version ) {
		parent::__construct( $settings, $helper, $dataProvider, $version );
	}

	public function run() {
		if (!empty($this->settings['email_info_enable']) ) {
			$this->render();
		}
	}

	public function isNote($args, $orderProductsIds) {
		if(empty($args['email_info_item_condition'])){
			return true;
		}
		if(!empty($args['email_info_item_condition']) && $args['email_info_item_condition'] === 'some'){
			return $this->hasSome($orderProductsIds, $args['email_info_order_items']);
		}
		if(!empty($args['email_info_item_condition']) && $args['email_info_item_condition'] === 'every'){
			return $this->hasEvery($orderProductsIds, $args['email_info_order_items']);
		}
		if(!empty($args['email_info_item_condition']) && $args['email_info_item_condition'] === 'any'){
			return !$this->hasSome($orderProductsIds, $args['email_info_order_items']);
		}

		return false;
	}

	public function hasSome($orderProductsIds, $infoItemsIds) {
		$intersection = array_intersect($orderProductsIds, $infoItemsIds);

		if (!empty($intersection)) {
			return true;
		} else {
			return false;
		}
	}

	public function hasEvery($orderProductsIds, $infoItemsIds) {
		$diff = array_diff($infoItemsIds, $orderProductsIds);

		if (empty($diff)) {
			return true;
		} else {
			return false;
		}
	}

	public function getNoteMessage($values) {
		$output = '';
		$output .= !empty($values['email_info_item_title'])
			? '<strong>' . $values['email_info_item_title'] . '</strong><br>'
			: '<br>';
		$output .= !empty($values['email_info_item_note'])
			? '<p>' . $values['email_info_item_note'] . '</p><br>'
			: '<br>';

		return $output;
	}

	public function renderRows( $order, $sent_to_admin, $plain_text, $email ) {

		if ( !$sent_to_admin && !$plain_text ) {
			$output = '';

			$order_items      = $order->get_items();
			$orderProductsIds = [];

			if ( ! is_wp_error( $order_items ) ) {
				foreach ( $order_items as $item_id => $order_item ) {
					array_push( $orderProductsIds, $order_item->get_product_id() );
				}
			}

			foreach ( $this->settings['email_info_items'] as $value ) {
				// render notices
				if ( is_array($value) && !empty($value['email_info_order_items'])) {
					$output .= $this->isNote($value, $orderProductsIds)
						? $this->getNoteMessage($value)
						: '';
				}
			}
			echo wp_kses( $output, $this->helper->getAllowedTags());
		}
	}

	public function render($arguments = '') {
		add_action( 'woocommerce_email_customer_details', array( $this, 'renderRows' ), 90, 4 );
	}
}
