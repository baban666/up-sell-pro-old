<?php


namespace classes\views;

use classes\abstracts\UpSellProViewItem;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProViewsEmail extends UpSellProViewItem {

	public function __construct( $settings, $helper, $dataProvider, $version ) {
		parent::__construct( $settings, $helper, $dataProvider, $version );
	}

	public function run() {
		if ($this->settings['email_add_to_order'] ) {
			$this->render();
		}
	}


	public function getArgs() {
		return array(
			'posts_per_page' => $this->settings['order_order_items'] !== null ? $this->settings['order_order_items'] : 3,
			'orderby'        => $this->settings['order_relation_order'] !== null ? $this->settings['order_relation_order'] : 'rand',
			'offset_search'  => $this->settings['general_keep_queries'],
		);
	}

	public function renderRows( $order, $sent_to_admin, $plain_text, $email ) {

		if ( $sent_to_admin && ! $plain_text ) {
			$order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;

			$order            = wc_get_order( $order_id );
			$order_items      = $order->get_items( array( 'line_item', 'fee', 'shipping' ) );
			$orderProductsIds = [];

			if ( ! is_wp_error( $order_items ) ) {
				foreach ( $order_items as $item_id => $order_item ) {
					array_push( $orderProductsIds, $order_item->get_product_id() );
				}
			}

			$args       = $this->getArgs();
			$args['id'] = implode( ',', $orderProductsIds );

			$output = '<h2>' . esc_html__( 'Up Sell Pro Info', 'up-sell-pro' ) . '</h2>';
			foreach ( $this->settings['email_add_to_order'] as $key => $value ) {
				// render search queries
				if ( $value == 'search' ) {
					$row    = $this->helper->getSearchQueriesEmailRow( $value, unserialize( get_post_meta( $order_id, '_search_up_queries', true ) ) );
					$output .= $row['title'];
					$output .= $row['content'];
				}
				// render viewed products
				if ( $value == 'viewed' ) {
					$provider = $this->dataProvider->getProvider( 'viewed' );
					$row      = $this->helper->getEmailRowContent( $value, $args, $provider );
					$output   .= $row['title'];
					$output   .= $row['content'];
				}
				// render related by categories products
				if ( $value == 'category' ) {
					$provider = $this->dataProvider->getProvider( 'categories' );
					$row      = $this->helper->getEmailRowContent( $value, $args, $provider );
					$output   .= $row['title'];
					$output   .= !empty($row['content']) ? $row['content'] : esc_html__('Nothing to show', 'up-sell-pro');
				}
				// render related by tags products
				if ( $value == 'tag' ) {
					$provider = $this->dataProvider->getProvider( 'tags' );
					$row      = $this->helper->getEmailRowContent( $value, $args, $provider );
					$output   .= $row['title'];
					$output   .= !empty($row['content']) ? $row['content'] : esc_html__('Nothing to show', 'up-sell-pro');
				}
			}

			echo $output;
		}


	}

	public function render() {
		add_action( 'woocommerce_email_customer_details', array( $this, 'renderRows' ), 90, 4 );
	}
}
