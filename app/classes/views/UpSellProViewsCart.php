<?php


namespace classes\views;

use classes\abstracts\UpSellProViewItem;

class UpSellProViewsCart extends UpSellProViewItem {

	public function __construct($settings, $helper, $dataProvider) {
		parent::__construct($settings, $helper, $dataProvider);
	}

	public function run(){
		$place = $this->settings['cart_relation_place']
			? $this->settings['cart_relation_place']
			: 'woocommerce_after_cart_contents';

		if($this->settings['cart_enable_related_products'] === 'yes'){
			add_action( $place, array( $this, 'render' ), 10 );
		}
	}

	public function getArgs() {
		return array(
			'posts_per_page' => $this->settings['cart_additional_products'] !== null
                ? $this->settings['cart_additional_products'] :
                2,
			'orderby' => $this->settings['cart_relation_order'] !== null
                ? $this->settings['cart_relation_order']
                : 'rand',
			'add_random' => $this->settings['cart_add_if_empty'] == 'yes',
			'type' => $this->settings['cart_relation_priority'],
		);
	}

	public function render(){
		global $woocommerce;
		$items = $woocommerce->cart->get_cart();
		$cartProductsIds = [];

		if ( !is_wp_error( $items ) ) {
			foreach($items as $item => $values) {
				$_product =  wc_get_product( $values['data']->get_id());
				array_push($cartProductsIds, $_product->get_id()) ;
			}
		}

		$args = $this->getArgs();
		$provider = $this->dataProvider->getProvider($args['type']);
		$args['id'] = implode(',', $cartProductsIds);
		$loop = $provider->getData($args);

		if($this->settings['cart_add_if_empty'] == 'yes' && !$loop->have_posts() ){
			$randomProvider = $this->dataProvider->getProvider('random');
			$loop = $randomProvider->getData($args);
		}

		?>
		<?php if($loop->have_posts()): ?>
            <div class="up-sell-products">
				<?php if($this->settings['cart_add_bundle']): ?>
                    <h2 class="up-sell-products-title">
						<?php esc_html_e($this->settings['cart_add_bundle']); ?>
                    </h2>
				<?php endif; ?>
                <div class="cards-list">
					<?php
					while ( $loop->have_posts() ) : $loop->the_post();
						global $post;
						$_product = wc_get_product( get_the_ID() );
						?>
                        <div class="mdc-card bottom-card mdc-elevation--z4">
	                        <?php
	                        if($_product->get_sale_price()){
		                        echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $_product );
	                        }
	                        ?>
                            <div class="first-half">
                                <div class="mdc-card__primary-action media-image top-card mdc-elevation--z8">
                                    <div class="mdc-card__media mdc-card__media--square">
                                        <div class="mdc-card__media-content">
                                            <a  href="<?php the_permalink();  ?>">
		                                        <?php echo $_product->get_image('thumbnail'); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="last-half">
                                <div class="card-info">
                                    <a href="<?php the_permalink(); ?>">
                                        <h2 class="up-sell-card-title">
			                                <?php echo wp_kses_post( $_product->get_name() );  ?>
                                        </h2>
                                    </a>
                                    <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'card-price' ) ); ?>">
		                                <?php echo $_product->get_price_html(); ?>
                                    </p>
	                                <?php woocommerce_template_loop_add_to_cart( ); ?>
                                </div>
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
