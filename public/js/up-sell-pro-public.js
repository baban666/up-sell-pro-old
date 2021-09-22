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



		const popUpShow = (id) =>{
			console.log('formData',id)
			var jqXHR = jQuery.post(
				upSellPro.ajaxurl,
				{
					action: 'popUpResponse',
					nonce: upSellPro.nonce,
					id: id
				}
			);

// Обработка успешного запроса
			jqXHR.done(function (responce) {
				console.log('Успех', responce, 'success');

				popupS.window({
					mode: 'alert',
					title: 'Title',
					content : responce ,
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

			});

// Обработка запроса с ошибкой
			jqXHR.fail(function (responce) {
				console.log('Ошибка', responce.responseText, 'error');
			});
		}

//https://www.divikingdom.com/ajax-add-to-cart-woocommerce-product-archive/
		jQuery(function($){

			/* global wc_add_to_cart_params */
			if ( typeof wc_add_to_cart_params === 'undefined' ) {
				return false;
			}

			$(document).on('submit', 'form.cart', function(e){

				var form = $(this),
					button = form.find('.single_add_to_cart_button');

				var formFields = form.find('input:not([name="product_id"]), select, button, textarea');

				var id = null;
				// create the form data array
				var formData = [];
				formFields.each(function(i, field){

					// store them so you don't override the actual field's data
					var fieldName = field.name,
						fieldValue = field.value;

					if(fieldName && fieldValue){

						// set the correct product/variation id for single or variable products
						if(fieldName == 'add-to-cart'){
							fieldName = 'product_id';
							fieldValue = form.find('input[name=variation_id]').val() || fieldValue;
							id = fieldValue;
						}

						// if the fiels is a checkbox/radio and is not checked, skip it
						if((field.type == 'checkbox' || field.type == 'radio') && field.checked == false){
							return;
						}

						// add the data to the array
						formData.push({
							name: fieldName,
							value: fieldValue
						});
					}

				});

				if(!formData.length){
					return;
				}

				e.preventDefault();

				form.block({
					message: null,
					overlayCSS: {
						background: "#ffffff",
						opacity: 0.6
					}
				});

				$(document.body).trigger('adding_to_cart', [button, formData]);

				$.ajax({
					type: 'POST',
					url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
					data: formData,
					success: function(response){

						if(!response){
							return;
						}

						if(response.error & response.product_url){
							window.location = response.product_url;
							return;
						}

						// Redirect to cart option
						if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
							window.location = wc_add_to_cart_params.cart_url;
							return;
						}

						$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, button]);

						popUpShow(id)
					},
					complete: function(){
						form.unblock();
					}
				});

				return false;

			});
		});

	});

})( jQuery );
