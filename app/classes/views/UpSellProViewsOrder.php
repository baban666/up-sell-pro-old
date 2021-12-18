<?php


namespace classes\views;

use classes\abstracts\UpSellProViewItem;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProViewsOrder extends UpSellProViewItem {

	public function __construct( $settings, $helper, $dataProvider, $version ) {
		parent::__construct( $settings, $helper, $dataProvider, $version );
	}

	public function run() {
		if (!empty($this->settings['order_add_to_order']) && is_array($this->settings['order_add_to_order']) ) {
			foreach ( $this->settings['order_add_to_order'] as $key => $value ) {
				if ( $value == 'search' ) {
					add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'saveSearchQueries' ) );
				}
			}
			add_action( 'add_meta_boxes', array( $this, 'render' ) );
		}
	}


	public function getArgs() {
		return array(
			'posts_per_page' => $this->settings['order_order_items'] !== null ? $this->settings['order_order_items'] : 3,
			'orderby'        => $this->settings['order_relation_order'] !== null ? $this->settings['order_relation_order'] : 'rand',
			'offset_search'  => $this->settings['general_keep_queries'],
		);
	}

	public function saveSearchQueries( $order_id ) {
		$provider = $this->dataProvider->getProvider( 'search' );
		update_post_meta( $order_id, '_search_up_queries', serialize( $provider->getData( $this->getArgs() ) ) );
	}

	public function renderTabs() {
		global $post;

		$order            = wc_get_order( $post->ID );
		$order_items      = $order->get_items( array( 'line_item', 'fee', 'shipping' ) );
		$orderProductsIds = [];

		if ( ! is_wp_error( $order_items ) ) {
			foreach ( $order_items as $item_id => $order_item ) {
				array_push( $orderProductsIds, $order_item->get_product_id() );
			}
		}

		$args       = $this->getArgs();
		$args['id'] = implode( ',', $orderProductsIds );

		$tabs        = '';
		$tabsContent = '';

		foreach ( $this->settings['order_add_to_order'] as $key => $value ) {
			// render viewed products
			if ( $value == 'viewed' ) {
				$provider    = $this->dataProvider->getProvider( 'viewed' );
				$tab         = $this->helper->getTabContent( $value, $args, $provider );
				$tabs        .= $tab['tab'];
				$tabsContent .= $tab['content'];
			}
			// render search queries
			if ( $value == 'search' ) {
				$tab         = $this->helper->getSearchQueriesTab( $value, unserialize( get_post_meta( $post->ID, '_search_up_queries', true ) ) );
				$tabs        .= $tab['tab'];
				$tabsContent .= $tab['content'];
			}
			// render related by categories products
			if ( $value == 'category' ) {
				$provider    = $this->dataProvider->getProvider( 'categories' );
				$tab         = $this->helper->getTabContent( $value, $args, $provider );
				$tabs        .= $tab['tab'];
				$tabsContent .= $tab['content'];
			}
			// render related by tags products
			if ( $value == 'tag' ) {
				$provider    = $this->dataProvider->getProvider( 'tags' );
				$tab         = $this->helper->getTabContent( $value, $args, $provider );
				$tabs        .= $tab['tab'];
				$tabsContent .= $tab['content'];
			}
		}
		?>
        <div class="up-sell-pro-tabs">
            <ul class="tabs__button-group">
                <?php echo $this->helper->allowedHtml( $tabs ); ?>
            </ul>
            <ul class="tabs__container">
                <?php echo $this->helper->allowedHtml( $tabsContent ); ?>
            </ul>
        </div>
		<?php
	}


	public function render() {
		add_meta_box( 'up_sell_pro_info', esc_html( 'Up Sell Pro Info', 'up-sell-pro' ), array(
			$this,
			'renderTabs'
		), 'shop_order', 'normal', 'core' );
	}
}
