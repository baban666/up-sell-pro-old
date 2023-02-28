<?php


namespace classes\views;

use classes\abstracts\UpSellProViewItem;

if ( ! defined( 'WPINC' ) ) {
	die;
}

class UpSellProViewsProduct extends UpSellProViewItem {

	public function __construct( $settings, $helper, $dataProvider, $version ) {
		parent::__construct( $settings, $helper, $dataProvider, $version );
	}

	public function run() {
		$place = $this->settings['product_page_relation_place']
			? $this->settings['product_page_relation_place']
			: 'woocommerce_after_single_product_summary';

		if ( $this->settings['product_page_enable_related_products'] ) {
			add_action( $place, array( $this, 'render' ), 10 );
		}
	}

	public function getArgs() {
		return array(
			'posts_per_page' => $this->settings['product_page_additional_products'] !== null
				? $this->settings['product_page_additional_products'] :
				2,
			'orderby'        => $this->settings['product_page_relation_order'] !== null
				? $this->settings['product_page_relation_order']
				: 'rand',
			'add_random'     => $this->settings['product_page_add_if_empty'] == 'yes',
			'type'           => $this->settings['product_page_relation_priority'],
		);
	}

	public function render($arguments = '') {
		global $product, $post;
		$args          = $this->getArgs();
		$provider      = $this->dataProvider->getProvider( $args['type'] );
		$args['id']    = $product->get_id();
		$loop          = $provider->getData( $args );
		$fullPrice     = $product->get_price();
		$productPrice  = $product->get_price();
		$fullPriceHtml = $product->get_price_html();
		if ( $product->is_on_sale() ) {
			$fullPriceHtml = wc_price( $product->get_price() );
		}

		$relatedIDs = [ $product->get_id() ];

		if ( $this->settings['product_page_add_if_empty'] == 'yes' && ! $loop->have_posts() ) {
			$randomProvider = $this->dataProvider->getProvider( 'random' );
			$loop           = $randomProvider->getData( $args );
		}

		?>
		<?php if ( $loop->have_posts() ): ?>
            <div class="up-sell-products">
				<?php if ( $this->settings['product_page_add_bundle'] ): ?>
                    <h2 class="up-sell-products-title">
						<?php echo esc_html( $this->settings['product_page_add_bundle'] ); ?>
                    </h2>
				<?php endif; ?>
                <div class="cards-list">
                    <div class="main-item">
                        <div class="card main" data-price="<?php echo $product->get_price(); ?>">
							<?php echo $product->get_image( 'thumbnail' ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php
							if ( $product->get_sale_price() ) {
								echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'up-sell-pro' ) . '</span>', $post, $product );
							}
							?>
                            <div class="card-block">
                                <h4 class="card-title">
                                    <span class="product-title"><?php echo wp_kses_post( $product->get_name() ); ?></span>
                                </h4>
                                <div class="rating-info">
									<?php woocommerce_template_loop_rating(); ?>
                                </div>
                                <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'card-price' ) ); ?>">
									<?php echo $product->get_price_html(); ?>
                                </p>
                            </div>

                        </div>
                        <div class="plus">
                            <span>+</span>
                        </div>
                    </div>

					<?php
					while ( $loop->have_posts() ) : $loop->the_post();
						global $post;
						$_product  = wc_get_product( get_the_ID() );
						$fullPrice += $_product->get_price();
						array_push( $relatedIDs, get_the_ID() );
						?>
                        <div class="card related-product related-product-id-<?php echo esc_attr( get_the_ID() ); ?>"
                             data-price="<?php echo $_product->get_price(); ?>">
                            <input id="up-sell-check-id-<?php echo esc_attr( get_the_ID() ); ?>"  type="checkbox" checked data-id="<?php echo esc_attr( get_the_ID() ); ?>"
                                   class="box">
                            <label for="up-sell-check-id-<?php echo esc_attr( get_the_ID() ); ?>"></label>
							<?php
							if ( $_product->get_sale_price() ) {
								echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'up-sell-pro' ) . '</span>', $post, $_product );
							}
							?>
                            <a href="<?php esc_url( the_permalink() ); ?>">
								<?php echo $_product->get_image( 'thumbnail' ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </a>
                            <div class="card-desc">
                                <a href="<?php esc_url( the_permalink() ); ?>">
                                    <h4 class="up-sell-card-title">
										<?php echo wp_kses_post( $_product->get_name() ); ?>
                                    </h4>
                                </a>
                                <div class="rating-info">
									<?php woocommerce_template_loop_rating(); ?>
                                </div>
                                <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'card-price' ) ); ?>">
									<?php echo $_product->get_price_html(); ?>
                                </p>
                            </div>
                        </div>
					<?php
					endwhile;
					wp_reset_query();
					?>
                </div>
                <div class="button-row">
                    <a href="<?php echo get_permalink() . '?add-to-cart=' . implode( ',', $relatedIDs ); ?>"
                       class="btn">
                        <button type="button" name="add-to-cart" class="single_add_to_cart_button button alt">
							<?php echo esc_html( $this->settings['product_page_add_to_cart'] ); ?>
                        </button>
                    </a>
					<?php if ( $this->settings['product_page_add_to_cart_desc'] ): ?>
                        <span class="full-price-line">
                            <span class="price-desc">
                                <?php echo esc_html( $this->settings['product_page_add_to_cart_desc'] ); ?>
                            </span>
                            <span class="price-full"
                                  data-thousand="<?php echo esc_attr( wc_get_price_thousand_separator() ); ?>"
                                  data-decimal="<?php echo esc_attr( wc_get_price_decimal_separator() ); ?>"
                                  data-num="<?php echo esc_attr( wc_get_price_decimals() ); ?>">
                                <?php echo sprintf( get_woocommerce_price_format(), get_woocommerce_currency_symbol(), $fullPrice ); ?>
                            </span>
                        </span>
					<?php endif; ?>
                </div>
            </div>
		<?php endif; ?>

		<?php
	}
}
