(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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



		// Tabs in Order
		class Tabs {
			constructor(element) {
				this.tabs = element;
				this.toggles = this.tabs.querySelectorAll('.tabs__toggle');
				this.panels = this.tabs.querySelectorAll('.tabs__tab-panel')
			}
			init() {
				this.toggles.forEach(toggle => {
					toggle.addEventListener('click', (e) => {
						this.toggles.forEach(toggle => {
							toggle.classList.remove('active');
						})
						this.panels.forEach(panel => {
							panel.classList.remove('active');
						})
						e.target.classList.add('active');
						this.tabs.querySelector(`.tabs__tab-panel[data-tab='${e.target.dataset.tab}']`).classList.add('active')
					})
				})
			}
		}

		document.querySelectorAll('.tabs').forEach(tab =>{
			const tabs = new Tabs(tab);
			tabs.init();
		})


	})


})( jQuery );
