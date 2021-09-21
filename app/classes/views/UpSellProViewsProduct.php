<?php


namespace classes\views;

use classes\abstracts\UpSellProViewItem;

class UpSellProViewsProduct extends UpSellProViewItem {

	public function __construct($settings, $helper, $dataProvider) {
		parent::__construct($settings, $helper, $dataProvider);
	}

	public function run(){
		$place = $this->settings['product_page_relation_place']
			? $this->settings['product_page_relation_place']
			: 'woocommerce_after_single_product_summary';

		if($this->settings['product_page_enable_related_products'] === 'yes'){
			add_action( $place, array( $this, 'render' ), 10 );
		}
	}

	public function getArgs() {
		return array(
			'posts_per_page' => $this->settings['product_page_additional_products'] !== null ? $this->settings['product_page_additional_products'] : 2,
			'orderby' => $this->settings['product_page_relation_order'] !== null ? $this->settings['product_page_relation_order'] : 'rand',
			'add_random' => $this->settings['product_page_add_if_empty'] == 'yes',
			'type' => $this->settings['product_page_relation_priority'],
			'offset_search' => $this->settings['general_keep_queries'],
		);
	}

	public function render(){
		global $product;
		$args = $this->getArgs();
		$provider = $this->dataProvider->getProvider($args['type']);
		$args['id'] = $product->get_id();
		$loop = $provider->getData($args);

		if($this->settings['product_page_add_if_empty'] == 'yes' && !$loop->have_posts() ){
			$randomProvider = $this->dataProvider->getProvider('random');
			$loop = $randomProvider->getData($args);
		}
		?>
		<div class="container up-sell-products">
			<div class="row">
				<div class="col">
					<div class="card">
						<?php
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'single-post-thumbnail' );
						?>
						<img src="<?php echo $image[0]; ?>" data-id="<?php echo $product->get_id(); ?>" />
						<div class="card-block">
							<h4 class="card-title"><?php echo get_the_title($product->get_id());  ?></h4>
							<p class="card-text">Price: <?php echo  $product->get_regular_price();  ?></p>
						</div>
					</div>
				</div>
				<div class="col">
					+
				</div>
				<?php
				while ( $loop->have_posts() ) : $loop->the_post();
					$_product = wc_get_product( get_the_ID() );
					$imageRel = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
					?>
					<div class="col">
						<div class="card related-product disabled related-product-id-<?php echo get_the_ID();  ?>" >
							<a href="<?php echo  get_permalink();  ?>">
								<img src="<?php echo $imageRel[0]; ?>" data-id="<?php echo $product->get_id(); ?>" />
							</a>
							<div class="card-block">
								<h4 class="card-title"><?php echo get_the_title();  ?></h4>
								<p class="card-text">Price: <?php echo  $_product->get_regular_price();  ?></p>
								<input type="checkbox" data-id="<?php echo get_the_ID();  ?>" class="box">
							</div>
						</div>
					</div>
				<?php
				endwhile;
				wp_reset_query();
				?>
				<div class="col">
					<a href="<?php echo get_permalink() . '?add-to-cart=' . get_the_ID();  ?>" class="btn">
						<button type="button" name="add-to-cart" disabled class="single_add_to_cart_button button alt">
							Add to cart
						</button>
					</a>
				</div>
			</div>

		</div>

		<?php

	}
}
