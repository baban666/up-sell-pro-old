<?php

namespace classes\helpers;

class UpSellProHelper {

	public function getProductCategories() {
		$output     = array();
		$categories = get_terms( array(
			'orderby'      => 'name',
			'pad_counts'   => false,
			'hierarchical' => 1,
			'hide_empty'   => true,
		) );
		foreach ( $categories as $category ) {
			if ( $category->taxonomy == 'product_cat' ) {
				$output[ $category->term_id ] = $category->name;
			}
		}

		return $output;
	}

	public function getProductTags() {
		$output     = array();
		$tags = get_terms( array(
			'orderby'      => 'name',
			'pad_counts'   => false,
			'hierarchical' => 1,
			'hide_empty'   => true,
		) );
		foreach ( $tags as $tag ) {
			if ( $tag->taxonomy == 'product_tag' ) {
				$output[ $tag->term_id ] = $tag->name;
			}
		}

		return $output;
	}

	public function arrayFlatten( $array ) {
		if ( ! is_array( $array ) ) {
			return false;
		}
		$result = array();
		foreach ( $array as $key => $value ) {
			if ( is_array( $value ) ) {
				$result = array_merge( $result, $this->arrayFlatten( $value ) );
			} else {
				$result = array_merge( $result, array( $key => $value ) );
			}
		}

		return $result;
	}

	public function getRelatedCategories( $categories, $relations ) {
		$arr = [];
		if ( is_array( $categories ) && is_array( $relations ) ) {
			foreach ( $relations as $relation ) {
				if ( in_array( $relation['main-category'], $categories ) ) {
					$arr[] = $relation['up-sell-categories'];
				}
			}

			return $this->arrayFlatten( $arr );
		}

		return [];
	}

	public function getRelatedTags( $tags, $relations ) {
		$arr = [];
		if ( is_array( $tags ) && is_array( $relations ) ) {
			foreach ( $relations as $relation ) {
				if ( in_array( $relation['main-tags'], $tags ) ) {
					$arr[] = $relation['up-sell-tags'];
				}
			}

			return $this->arrayFlatten( $arr );
		}

		return [];
	}

	public function getItemsId( $items ) {
		$arr = [];
		if ( is_array( $items )  ) {
			foreach ( $items as $item ) {
				$arr[] = $item->term_id;
			}
		}
		return $arr;
	}
	public function getSeparator( $key, $length ) {
		return $key + 1 == $length ? '' : ', ';
	}

	public function getSearchQueriesTab($value, $data = null){
		$markup = [
			'tab' => '<li><div class="tabs__toggle active" data-tab='. esc_html($value) .'>' . esc_html('Search queries') .'</div></li>',
			'content' =>'',
		];

		if(is_array($data)){
			$content = '';
			foreach ($data as $key => $value){
				$content .= '<strong>'. esc_html($value) . '</strong>' . $this->getSeparator($key, count($data)) ;
			}
			$markup['content'] .= 	'<li class="tabs__tab-panel  active" data-tab="search">
										<div class="tabs__content">
											<p>'
			                                  . $content .
											'</p>
										</div>
									</li>';
		}
		return $markup;
	}


	public function getTabContent($value, $data = null, $provider = null){
		$tabTitle = $this->getTabTitle($value);
		$loop = $provider->getData($data);
		$markup = [
			'tab' => '<li><div class="tabs__toggle" data-tab='. esc_html($value) .'>' . esc_html($tabTitle['title']) .'</div></li>',
			'content' =>'',
		];

		$content = '';
		foreach ($loop->posts as $key => $post){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
			$product = wc_get_product( $post->ID );
			$content .= '<div class="drop__card">
			                <div class="drop__data">
			                    <img src="'. $image[0] .'">
			                    <div>
			                        <a href="'. get_permalink( $post->ID ) .' ">
			                            <h1 class="drop__name">' . $post->post_title .'</h1>
			                        </a>
			                        <span class="drop__profession">Desarrolladora Web</span>
			                    </div>
			                </div>
			                <div>
			                    <p class="card-text">Price:' . $product->get_regular_price() . '</p>
			                </div>
			            </div>';
		}
		wp_reset_query();

		$markup['content'] .= '<li class="tabs__tab-panel" data-tab="'. esc_html($value) .'">
								<div class="tabs__content">
								  <div class="drop">
                                     <div class="drop__container" id="drop-items">'
	                                     . $content .
	                                 '</div>
                                  </div>
                                </div>
							   </li>';
		return $markup;
	}

	public function getTabTitle($value){
		$tabs = [
			'tag'       => ['title'=> 'Related by Tags', 'id' => $value],
			'category'  => ['title'=> 'Related by Categories', 'id' => $value],
			'viewed'    => ['title'=> 'Viewed products', 'id' => $value],
			'search'    => ['title'=> 'Search queries', 'id' => $value],
		];

		return $tabs[$value];
	}

	public function getSearchQueriesEmailRow($value, $data = null){
		$markup = [
			'title' => '<div class="email-queries-title"><strong>' . esc_html('Search queries: ') .'<strong></div>',
			'content' =>'',
		];

		if(is_array($data)){
			$content = '';
			foreach ($data as $key => $value){
				$content .= '<strong>'. esc_html($value) . '</strong>' . $this->getSeparator($key, count($data)) ;
			}
			$markup['content'] .= 	'<div class="email-queries-content">'. $content.'</div>';
		}
		return $markup;
	}

	public function getEmailRowContent($value, $data = null, $provider = null){
		$tabTitle = $this->getTabTitle($value);
		$loop = $provider->getData($data);
		$markup = [
			'title' => '<div class="email-content-title"><strong>' . esc_html($tabTitle['title']) . '<strong></div>',
			'content' =>'',
		];


		$content = '';
		foreach ($loop->posts as $key => $post){
			$product = wc_get_product( $post->ID );
			$content .= '<div>  
                           <a href="'. get_permalink( $post->ID ) .'">
			                  <span class="drop__name">' . $post->post_title .'</span> - 
			                  <span class="card-text">price: ' . $product->get_regular_price() . '</span>
			                </a>
			             <div>';
		}
		wp_reset_query();

		$markup['content'] .= $content;

		return $markup;
	}

	public function getPopUpContent($data = null, $dataProvider = null){
		$provider = $dataProvider->getProvider($data['type']);
		$loop = $provider->getData($data);

		if($data['add_random'] && !$loop->have_posts() ){
			$randomProvider = $dataProvider->getProvider('random');
			$loop = $randomProvider->getData($data);
		}
		ob_start();
		?>
		<?php if($loop->have_posts()): ?>
			<div class="up-sell-products">
				<div class="cards-list">
					<?php
					while ( $loop->have_posts() ) : $loop->the_post();
						global $post;
						$_product = wc_get_product( get_the_ID() );
						?>
						<div class="card related-product related-product-id-<?php esc_attr_e(get_the_ID());  ?>"  data-price="<?php echo $_product->get_price(); ?>" >
							<?php
							if($_product->get_sale_price()){
								echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $_product );
							}
							?>
							<a  href="<?php the_permalink();  ?>">
								<?php echo $_product->get_image('thumbnail'); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</a>
							<div class="card-desc">
								<a href="<?php the_permalink(); ?>">
									<h4 class="up-sell-card-title">
										<?php echo wp_kses_post( $_product->get_name() );  ?>
									</h4>
								</a>
								<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'card-price' ) ); ?>">
									<?php echo $_product->get_price_html(); ?>
									<?php woocommerce_template_loop_add_to_cart( ); ?>
								</p>
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
		return ob_get_contents();
	}

	public function ddAjax($value){
		error_log( print_r($value, true) );
	}

}
