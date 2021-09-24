(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */


	$(document).ready(function(){
		const addLink = document.querySelector('.up-sell-products .btn');
		const addButton = document.querySelector('.up-sell-products .single_add_to_cart_button');
		const addCheckboxes = document.querySelectorAll('.up-sell-products .box');

		const addDisableToProduct = (id) => {
			const card = document.querySelector(`.related-product-id-${id}`);
			card.classList.add('disabled');
		}

		const removeDisableToProduct = (id) => {
			const card = document.querySelector(`.related-product-id-${id}`);
			card.classList.remove('disabled');
		}

		const addDisableToButton = () => {
			addButton.disabled = true;
		}

		const removeDisableToButton = () => {
			addButton.removeAttribute('disabled');
		}

		const addAdditionalProduct = (id) => {
			const url = new URL(addLink.getAttribute('href'));
			url.searchParams.set('add-to-cart', [url.searchParams.get('add-to-cart'),id].join(','));
			addLink.setAttribute('href', url.href.replace(/%2C/g,","));
			removeDisableToProduct(id);
			if(url.searchParams.get('add-to-cart').split(',').length > 1){
				removeDisableToButton();
			}
		}

		const removeAdditionalProduct = (id) => {
			const url = new URL(addLink.getAttribute('href'));
			const hrefAttr = url.searchParams.get('add-to-cart').split(',').filter((item) => item !== id);
			url.searchParams.set('add-to-cart', hrefAttr.join(','));
			addLink.setAttribute('href', url.href.replace(/%2C/g,","));
			addDisableToProduct(id);
			if(url.searchParams.get('add-to-cart').split(',').length === 1){
				addDisableToButton();
			}
		}

		const additionalProducts = (event) => {
			if (event.currentTarget.checked === true){
				addAdditionalProduct(event.currentTarget.getAttribute('data-id'))
			} else {
				removeAdditionalProduct(event.currentTarget.getAttribute('data-id'))
			}
		}

		addCheckboxes.forEach((elem) =>{
			elem.addEventListener('click', additionalProducts)
		});



		// Track Search
		const addSearchQuery = (searchQuery) => {
			const search = JSON.parse(Cookies.get('up-sell-search'));
			const queries = new Set([...search, searchQuery]);
			Cookies.set('up-sell-search', JSON.stringify(Array.from(queries)));
		}

		const escape = (value) => value.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

		const trackSearch = () => {
			const search = Cookies.get('up-sell-search');
			$('form[role="search"]').submit(function() {
				if(Array.isArray($(this).serializeArray()) && $(this).serializeArray()[0].value){
					addSearchQuery(escape($(this).serializeArray()[0].value));
				}
			});
		};

		if(Cookies.get('up-sell-search')){
			trackSearch();
		}


// Pop up Ajax button
		const popUpShow = (data) =>{
			popupS.window({
				mode: 'modal',
				title: 'Title',
				content : data ,
				className : 'additionalClass',  // for additional styling, gets append on every popup div
				placeholder : 'Input Text',     // only available for mode: 'prompt'
				onOpen: function(){
					console.log('onOpen')
				},      // gets called when popup is opened
				onSubmit: function(val){
					console.log('Submit')
				}, // gets called when submitted. val as an paramater for prompts
				onClose: function(){
					console.log('onClose')
				}      // gets called when popup is closed
			});
		}

		jQuery(function($) {
			/* global wc_add_to_cart_params */
			if (typeof wc_add_to_cart_params === 'undefined') {
				return false;
			}

			if (!upSellPro) {
				return false;
			}

			$('body').on('added_to_cart',function( event, fragments, cart_hash, button) {
				const product_id = button.data('product_id');

				if (!product_id) {
					return false;
				}

				$.ajax({
					type: 'POST',
					url: upSellPro.ajaxurl,
					data: {
						action: 'popUpResponse',
						nonce: upSellPro.nonce,
						id: product_id,
					},
					success: function(response){
						if(!response){
							return;
						}
						// Redirect to cart option
						if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
							return;
						}

						popUpShow(response)
					},
					error: function(response) {
						return;
					}
				});

				return false;

			});
		});


// Pop up without AJAX

		jQuery(function($) {
			$('.up-sell-pro-not-ajax .add_to_cart_button').on('click', function () {
				const product_id = $(this).data('product_id');
				localStorage.setItem('addedToCart', product_id);
			})

			const addedToCart = localStorage.getItem('addedToCart');
			console.log(addedToCart);
			if(addedToCart){


				$.ajax({
					type: 'POST',
					url: upSellPro.ajaxurl,
					data: {
						action: 'popUpResponse',
						nonce: upSellPro.nonce,
						id: addedToCart,
					},
					success: function(response){
						if(!response){
							return;
						}
						
						popupS.window({
							mode: 'modal',
							title: 'Title',
							content : response ,
							className : 'additionalClass',  // for additional styling, gets append on every popup div
							placeholder : 'Input Text',     // only available for mode: 'prompt'
							onOpen: function(){
								console.log(addedToCart);
								localStorage.removeItem('addedToCart');
							},      // gets called when popup is opened
							onSubmit: function(val){
								console.log('Submit')
							}, // gets called when submitted. val as an paramater for prompts
							onClose: function(){
								console.log('onClose')
							}      // gets called when popup is closed
						});

					},
					error: function(response) {
						return;
					}
				});

			}
		});

	});

})( jQuery );
