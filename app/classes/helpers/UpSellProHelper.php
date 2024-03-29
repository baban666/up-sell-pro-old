<?php

namespace classes\helpers;

if ( ! defined( 'WPINC' ) ) {
	die;
}

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

	public function allowedHtml( $string ) {
		return wp_kses( $string, $this->getAllowedTags());
	}

	public function getAllowedTags() {
		return [
			'b'      => [],
			's'      => [],
			'strong' => [],
			'i'      => [],
			'u'      => [],
			'br'     => [],
			'em'     => [],
			'del'    => [],
			'ins'    => [],
			'sup'    => [],
			'sub'    => [],
			'code'   => [],
			'small'  => [],
			'strike' => [],
			'abbr'   => [
				'title' => [],
			],
			'div'   => [
				'class' => [],
				'data-tab' => [],
			],
			'li'   => [
				'class' => [],
				'data-tab' => [],
			],
			'span'   => [
				'class' => [],
			],
			'a'      => [
				'href'  => [],
				'title' => [],
				'class' => [],
				'id'    => [],
			],
			'img'    => [
				'src'    => [],
				'alt'    => [],
				'height' => [],
				'width'  => [],
			],
			'hr'     => [],
            'h1'     => [],
			'id'     => [],
		];
	}



	public function getProductTags() {
		$output = array();
		$tags   = get_terms( array(
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
		if ( is_array( $items ) ) {
			foreach ( $items as $item ) {
				$arr[] = $item->term_id;
			}
		}

		return $arr;
	}

	public function getSeparator( $key, $length ) {
		return $key + 1 == $length ? '' : ', ';
	}

	public function getSearchQueriesTab( $value, $data = null ) {
		$markup = [
			'tab'     => '<li><div class="tabs__toggle" data-tab=' . esc_attr( $value ) . '>' . esc_html__( 'Search queries', 'up-sell-pro' ) . '</div></li>',
			'content' => '',
		];


        $content = '';
        if (count($data) && is_array($data)){
            foreach ( $data as $key => $value ) {
                $content .= '<strong>' . esc_html( $value ) . '</strong>' . $this->getSeparator( $key, count( $data ) );
            }
        } else {
            $content .= esc_html__('Nothing to show', 'up-sell-pro');
        }

        $markup['content'] .= '<li class="tabs__tab-panel" data-tab="search">
                                    <div class="tabs__content">
                                        <p>'
                              . $content .
                              '</p>
                                    </div>
                                </li>';

		return $markup;
	}


	public function getTabContent( $value, $data = null, $provider = null ) {
		$tabTitle = $this->getTabTitle( $value );
		$loop     = $provider->getData( $data );
		$markup   = [
			'tab'     => '<li><div class="tabs__toggle" data-tab=' . esc_attr( $value ) . '>' . esc_html( $tabTitle['title'] ) . '</div></li>',
			'content' => '',
		];

		$content = '';

		if(count($loop->posts) && is_array($loop->posts)){
			foreach ( $loop->posts as $key => $post ) {
				$product = wc_get_product( $post->ID );
				$content .= '<div class="drop__card">
			                <div class="drop__data">
			                    ' . $product->get_image( "thumbnail" ) . '
			                    <div>
			                        <a href="' . esc_url(get_permalink( $post->ID ))  . '" target="_blank">
			                            <h1 class="drop__name">' . $post->post_title . '</h1>
			                        </a>
			                    </div>
			                </div>
			                <div>
			                    <p class="card-text">'. esc_html__('Price: ', 'up-sell-pro') . $product->get_price_html() . '</p>
			                </div>
			            </div>';
			}
        } else{
		    $content .= esc_html__('Nothing to show', 'up-sell-pro');
        }

		wp_reset_query();

		$markup['content'] .= '<li class="tabs__tab-panel" data-tab="' . esc_attr( $value ) . '">
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

	public function getTabTitle( $value ) {
		$tabs = [
			'tag'      => [ 'title' =>  esc_html__( 'Related by Tags', 'up-sell-pro' ), 'id' => $value ],
			'category' => [ 'title' => esc_html__( 'Related by Categories', 'up-sell-pro' ), 'id' => $value ],
			'viewed'   => [ 'title' => esc_html__( 'Viewed products', 'up-sell-pro' ), 'id' => $value ],
			'search'   => [ 'title' => esc_html__( 'Search queries', 'up-sell-pro' ), 'id' => $value ],
		];

		return $tabs[ $value ];
	}

	public function getSearchQueriesEmailRow( $value, $data = null ) {
		$markup = [
			'title'   => '<div class="email-queries-title"><strong>' . esc_html__( 'Search queries: ', 'up-sell-pro' ) . '<strong></div>',
			'content' => '',
		];

		if ( is_array( $data ) ) {
			$content = '';
			foreach ( $data as $key => $value ) {
				$content .= '<strong>' . esc_html( $value ) . '</strong>' . $this->getSeparator( $key, count( $data ) );
			}
			$markup['content'] .= '<div class="email-queries-content">' . $content . '</div>';
		}

		return $markup;
	}

	public function getEmailRowContent( $value, $data = null, $provider = null ) {
		$tabTitle = $this->getTabTitle( $value );
		$loop     = $provider->getData( $data );

		$markup   = [
			'title'   => '<div class="email-content-title"><strong>' . esc_html( $tabTitle['title'] ) . '<strong></div>',
			'content' => '',
		];


		$content = '';
		foreach ( $loop->posts as $key => $post ) {
			$product = wc_get_product( $post->ID );
			$content .= '<div>  
                           <a href="' . esc_url(get_permalink( $post->ID )) . '">
			                  <span class="drop__name">' . $post->post_title . '</span> - 
			                  <span class="card-text">' . esc_html__( 'price: ', 'up-sell-pro' ) . $product->get_price_html() . '</span>
			                </a>
			             <div>';
		}
		wp_reset_query();

		$markup['content'] .= $content;

		return $markup;
	}

	public function getPopUpContent( $data = null, $dataProvider = null ) {
		$provider = $dataProvider->getProvider( $data['type'] );
		$loop     = $provider->getData( $data );

		if ( $data['add_random'] && ! $loop->have_posts() ) {
			$randomProvider = $dataProvider->getProvider( 'random' );
			$loop           = $randomProvider->getData( $data );
		}
		$cart_page = $data['cart'] ? $data['cart'] : esc_url( wc_get_page_permalink( 'cart' ) );

		$message = sprintf( '<a href="%s" class="wc-forward">%s</a>', $cart_page, esc_html__( 'View cart', 'up-sell-pro' ) );
		ob_start();
		?>
		<?php if ( $loop->have_posts() ): ?>
			<?php echo wp_kses( $message, $this->getAllowedTags()); ?>
            <h4><?php echo esc_html( $data['title']); ?></h4>
            <div class="up-sell-products">
                <div class="cards-list">
					<?php
					while ( $loop->have_posts() ) : $loop->the_post();
						global $post;
						$_product = wc_get_product( get_the_ID() );
						?>
                        <div class="card related-product related-product-id-<?php echo esc_attr( get_the_ID() ); ?>"
                             data-price="<?php echo esc_attr($_product->get_price()) ; ?>">
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
                                <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'card-price' ) ); ?>">
									<?php echo $_product->get_price_html(); ?>
									<?php woocommerce_template_loop_add_to_cart(); ?>
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

	public function ddAjax( $value ) {
		error_log( print_r( $value, true ) );
	}

}
