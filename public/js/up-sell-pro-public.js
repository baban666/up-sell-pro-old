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
	})

})( jQuery );
