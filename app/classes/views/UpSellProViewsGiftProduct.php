<?php


namespace classes\views;

use classes\abstracts\UpSellProViewItem;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProViewsGiftProduct extends UpSellProViewItem {

	public function __construct( $settings, $helper, $dataProvider, $version ) {
		parent::__construct( $settings, $helper, $dataProvider, $version );
	}

	public function run() {

		if ( $this->settings['gift_product_enable'] ) {
			add_action( 'woocommerce_after_single_product', array( $this, 'render' ), 10 );
			add_action( 'woocommerce_add_to_cart',  array( $this, 'addToCartAction' ), 20 );
			add_action( 'woocommerce_update_cart_action_cart_updated',  array( $this, 'updateCartAction' ), 20 );
			add_action( 'woocommerce_cart_item_removed', array( $this, 'removeItemAction' ), 10, 2 );
		}
	}

	public function getArgs() {
		return $this->settings['gift_product_item'];
	}

	public function getTagColor($cartTotal, $giftValue) {

		if ($cartTotal >= $giftValue){
			return 'green';
		}

		if (empty($cartTotal) || empty($giftValue)){
			return 'red';
		}

		if ( $giftValue / 2 <= $cartTotal){
			return 'yellow';
		}else{
		    return 'red';
        }
	}


	public function isGiftInCart($id) {
		$inCart = false;
		foreach( WC()->cart->get_cart() as $cartItem ) {
			$productInCart = $cartItem['product_id'];
			if ( in_array( $productInCart, array($id) ) ) {
				$inCart = true;
				break;
			}
		}
		return $inCart;
	}


	public function addToCartAction() {
	    $giftId = $this->settings['gift_product_item'];
		if (empty($giftId)){
			return;
		}

	    if($this->isGiftInCart($giftId)){
		    return;
        }
		WC()->cart->calculate_totals();
		// add gift if applicable
		if (WC()->cart->cart_contents_total >= $this->settings['gift_product_value']){
			WC()->cart->add_to_cart( $giftId );
		}
	}

	public function updateCartAction() {
		$giftId = $this->settings['gift_product_item'];
		$giftValue = $this->settings['gift_product_value'];

		if (empty($giftId) || empty($giftValue)){
			return;
		}

		WC()->cart->calculate_totals();
		// remove\add if less
		if (WC()->cart->cart_contents_total >= $this->settings['gift_product_value']){
			if ($this->isGiftInCart($giftId)){
				return;
			}
			WC()->cart->add_to_cart( $giftId );
		}else{
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				if ( $cart_item['product_id'] == $giftId ) {
					WC()->cart->remove_cart_item( $cart_item_key );
				}
			}
		}
	}

	public function removeItemAction(){
		$giftId = $this->settings['gift_product_item'];
		$giftValue = $this->settings['gift_product_value'];

		if (empty($giftId) || empty($giftValue)){
			return;
		}

		WC()->cart->calculate_totals();
		// remove if less
		if (WC()->cart->cart_contents_total < $this->settings['gift_product_value'] && $this->isGiftInCart($giftId)){
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				if ( $cart_item['product_id'] == $giftId ) {
					WC()->cart->remove_cart_item( $cart_item_key );
				}
			}
		}
    }


	public function render($arguments = '') {
		$place = !empty($this->settings['gift_product_place'])
			? $this->settings['gift_product_place']
			: 'right';
		WC()->cart->calculate_totals();

		$cartTotal = WC()->cart->cart_contents_total;
		$giftValue = $this->settings['gift_product_value'];
		var_dump($this->getTagColor($cartTotal, $giftValue));
		if(empty($this->settings['gift_product_item']) || $cartTotal >= $giftValue){
		    return;
        }
		$title = $this->settings['gift_product_title'];
		$product  = wc_get_product( $this->getArgs() );
		$tagColor = $this->getTagColor($cartTotal, $giftValue);
		if($tagColor == 'yellow'){
			$title = $this->settings['gift_product_title_middle'];
        }

		?>
        <div id="up-sell-gift-action-btn" class="action-button <?php esc_attr_e($place . ' ' . $tagColor); ?>">
            <img class="action-button-icon" src="<?php echo esc_url(UP_SELL_PRO_URL . '/public/img/gift-svgrepo-com.svg'); ?>" alt="Gift icon">
            <div class="action-button-content">
                <div class="action-button-content-inner">
                    <h2><?php esc_html_e($title ); ?></h2>
                    <div class="card related-product-id-<?php echo esc_attr( $this->settings['gift_product_item'] ); ?>">
                        <?php echo $product->get_image( 'thumbnail' ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <div class="card-desc">
                            <h4 class="up-sell-card-title">
                                <?php echo wp_kses_post( $product->get_name() ); ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}
