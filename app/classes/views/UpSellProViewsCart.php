<?php


namespace classes\views;

use classes\abstracts\UpSellProViewItem;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProViewsCart extends UpSellProViewItem {

	public function __construct( $settings, $helper, $dataProvider, $version ) {
		parent::__construct( $settings, $helper, $dataProvider, $version );
	}

	public function run() {
		$place = $this->settings['cart_relation_place']
			? $this->settings['cart_relation_place']
			: 'woocommerce_after_cart_contents';

		if ( $this->settings['cart_enable_related_products'] === 'yes' ) {
			add_action( $place, array( $this, 'render' ), 10 );
		}
	}

	public function getArgs() {
		return array(
			'posts_per_page' => $this->settings['cart_additional_products'] !== null
				? $this->settings['cart_additional_products'] :
				2,
			'orderby'        => $this->settings['cart_relation_order'] !== null
				? $this->settings['cart_relation_order']
				: 'rand',
			'add_random'     => $this->settings['cart_add_if_empty'] == 'yes',
			'type'           => $this->settings['cart_relation_priority'],
		);
	}

	public function render() {
		global $woocommerce;
		$items           = $woocommerce->cart->get_cart();
		$cartProductsIds = [];

		if ( ! is_wp_error( $items ) ) {
			foreach ( $items as $item => $values ) {
				$_product = wc_get_product( $values['data']->get_id() );
				array_push( $cartProductsIds, $_product->get_id() );
			}
		}

		$args       = $this->getArgs();
		$provider   = $this->dataProvider->getProvider( $args['type'] );
		$args['id'] = implode( ',', $cartProductsIds );
		$loop       = $provider->getData( $args );

		if ( $this->settings['cart_add_if_empty'] == 'yes' && !$loop->have_posts() ) {
			$randomProvider = $this->dataProvider->getProvider( 'random' );
			$loop           = $randomProvider->getData( $args );
		}

		?>
		<?php if ( $loop->have_posts() ): ?>
            <div class="up-sell-products">
				<?php if ( $this->settings['cart_add_bundle'] ): ?>
                    <h2 class="up-sell-products-title">
						<?php echo esc_html( $this->settings['cart_add_bundle'] ); ?>
                    </h2>
				<?php endif; ?>
                <div class="cards-list">
					<?php
					while ( $loop->have_posts() ) : $loop->the_post();
						global $post;
						$_product = wc_get_product( get_the_ID() );
						?>
                        <div class="card related-product related-product-id-<?php esc_attr_e( get_the_ID() ); ?>"
                             data-price="<?php esc_attr_e($_product->get_price()) ; ?>">
							<?php
							if ( $_product->get_sale_price() ) {
								echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'up-sell-pro' ) . '</span>', $post, $_product );
							}
							?>
                            <a href="<?php esc_url(the_permalink()) ; ?>">
								<?php echo $_product->get_image( 'thumbnail' ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </a>
                            <div class="card-desc">
                                <a href="<?php esc_url(the_permalink()) ; ?>">
                                    <h4 class="up-sell-card-title">
										<?php echo wp_kses_post( $_product->get_name() ); ?>
                                    </h4>
                                </a>
                                <div class="rating-info">
									<?php woocommerce_template_loop_rating(); ?>
                                </div>
                                <div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'card-price' ) ); ?>">
									<?php echo $_product->get_price_html(); ?>
                                </div>
								<?php woocommerce_template_loop_add_to_cart(); ?>
                            </div>
                        </div>
					<?php
					endwhile;
					wp_reset_query();
					?>
                </div>
            </div>
		<?php endif; ?>

		<?php

	}
}
