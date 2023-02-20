(function ($) {
    'use strict';

    $(document).ready(function () {
        const addLink = document.querySelector('.up-sell-products .btn');
        const addButton = document.querySelector('.up-sell-products .single_add_to_cart_button');
        const addCheckboxes = document.querySelectorAll('.up-sell-products .box');
        const cards = document.querySelectorAll('.up-sell-products .card');
        const priceFull = document.querySelector('.up-sell-products .price-full');
        const fullPriceLine = document.querySelector('.up-sell-products .full-price-line');

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

        const hideFullPriceLine = () => {
            fullPriceLine.style.display = 'none';
        }
        const showFullPriceLine = () => {
            fullPriceLine.style.display = 'inline';
        }

        const removeDisableToButton = () => {
            addButton.removeAttribute('disabled');
        }

        const getFullPrice = () => {
            let fullPrice = null;
            if (cards.length) {
                cards.forEach(elem => {
                    if (!elem.classList.contains('disabled')) {
                        fullPrice += +elem.dataset.price;
                    }
                })
            }

            return fullPrice;
        }

        const updatePrice = (value) => {
            priceFull.textContent = priceFull.textContent
                .replace(/\d+([,.]\d+)?/g, parseFloat(value).toFixed(+priceFull.dataset.num));
        }

        const addAdditionalProduct = (id) => {
            const url = new URL(addLink.getAttribute('href'));
            url.searchParams.set('add-to-cart', [url.searchParams.get('add-to-cart'), id].join(','));
            addLink.setAttribute('href', url.href.replace(/%2C/g, ","));
            removeDisableToProduct(id);
            if (url.searchParams.get('add-to-cart').split(',').length > 1) {
                removeDisableToButton();
                showFullPriceLine();
            }
        }

        const removeAdditionalProduct = (id) => {
            const url = new URL(addLink.getAttribute('href'));
            const hrefAttr = url.searchParams.get('add-to-cart').split(',').filter((item) => item !== id);
            url.searchParams.set('add-to-cart', hrefAttr.join(','));
            addLink.setAttribute('href', url.href.replace(/%2C/g, ","));
            addDisableToProduct(id);
            if (url.searchParams.get('add-to-cart').split(',').length === 1) {
                addDisableToButton();
                hideFullPriceLine();
            }
        }

        const additionalProducts = (event) => {
            if (event.currentTarget.checked === true) {
                addAdditionalProduct(event.currentTarget.getAttribute('data-id'))
            } else {
                removeAdditionalProduct(event.currentTarget.getAttribute('data-id'))
            }
            updatePrice(getFullPrice());
        }

        addCheckboxes.forEach((elem) => {
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
            $('form[role="search"]').submit(function () {
                if (Array.isArray($(this).serializeArray()) && $(this).serializeArray()[0].value) {
                    addSearchQuery(escape($(this).serializeArray()[0].value));
                }
            });
        };

        if (Cookies.get('up-sell-search')) {
            trackSearch();
        }

        // Pop up Ajax button
        const popUpShow = (data) => {
            const body = document.querySelector('body');
            if (!data['markup'].includes('up-sell-products')) {
                return false;
            }
            popupS.window({
                mode: 'alert',
                title: data['title'],
                content: data['markup'],
                className: 'additionalClass',
                labelOk: data['continue'],
                onOpen: () => {
                    body.classList.add('up-sell-pop-up-open');
                    localStorage.removeItem('addedToCart');
                },
                onClose: () => {
                    body.classList.remove('up-sell-pop-up-open');
                },
                onSubmit: () => {
                    body.classList.remove('up-sell-pop-up-open');
                },
            });
        }


        /* global upSellPro */

        if (typeof upSellPro !== 'undefined') {
            const body = document.querySelector('body');
            /* global wc_add_to_cart_params */
            if (typeof wc_add_to_cart_params === 'undefined' && !body.classList.contains('up-sell-pro-not-ajax')) {
                return false;
            }
            /* global upSellPro */
            if (typeof upSellPro === 'undefined') {
                return false;
            }

            $('body').on('added_to_cart', function (event, fragments, cart_hash, button) {
                const product_id = button.data('product_id');

                if (!product_id) {
                    return false;
                }

                if (body.classList.contains('up-sell-pop-up-open')) {
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
                    success: function (response) {

                        if (!response) {
                            return;
                        }

                        if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
                            return;
                        }

                        if (!body.classList.contains('up-sell-pop-up-open') && !body.classList.contains('woocommerce-cart')) {
                            popUpShow(response);
                        }

                    },
                    error: function (response) {
                        return;
                    }
                });

            });


            // Pop up without AJAX
            $('.woocommerce-shop.up-sell-pro-not-ajax .add_to_cart_button').on('click', function () {
                const product_id = $(this).data('product_id');
                localStorage.setItem('addedToCart', product_id);
            })

            const addedToCart = localStorage.getItem('addedToCart');
            if (addedToCart) {

                $.ajax({
                    type: 'POST',
                    url: upSellPro.ajaxurl,
                    data: {
                        action: 'popUpResponse',
                        nonce: upSellPro.nonce,
                        id: addedToCart,
                    },
                    success: function (response) {
                        if (!response) {
                            return;
                        }

                        if (!body.classList.contains('up-sell-pop-up-open') && !body.classList.contains('woocommerce-cart')) {
                            popUpShow(response);
                        }

                    },
                    error: function (response) {
                        return;
                    }
                });

            }
        }

//
// Action Button Gift
//

        const actionButton = document.getElementById('up-sell-gift-action-btn');

        const toggleActionButton = () => {
            if (actionButton.classList.contains('actionsBoxOpen')) {
                actionButton.classList.remove('actionsBoxOpen');
            } else {
                actionButton.classList.add('actionsBoxOpen');
            }
        }

        actionButton.addEventListener('click', toggleActionButton);
    });

})(jQuery);
