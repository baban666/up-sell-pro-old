<?php
return [
	array(
		'name'   => 'help',
		'title'  => esc_html__( 'Help & Info', 'up-sell-pro' ),
		'icon'   => 'far fa-life-ring',
		'fields' => array(
			// Info
			array(
				'type'    => 'heading',
				'content' => esc_html__( 'Help', 'up-sell-pro' ),
			),
			array(
				'type'    => 'content',
				'content' => '<p>'. esc_html__('Up Sell Pro is an easy and powerful plugin to set up upsell and cross-sell for your WooCommerce shop. This is up-selling, cross-selling plugin for WooCommerce helps you Increase revenue as well as profitability for your eCommerce website.', 'up-sell-pro').'</p>
                              <p><strong>'. esc_html__('Documentation', 'up-sell-pro').'</strong></p>
                              <p>'. esc_html__('Useful documentation you can find via link', 'up-sell-pro').' <a href="'. esc_url('https://docs-up-sell-pro.first-design-company.com/')  .'" target="_blank" >'. esc_html__('online documentation', 'up-sell-pro').'</a> </p>
                              <p><strong>'. esc_html__('Contact', 'up-sell-pro').'</strong></p>
                              <p>'. esc_html__('Please ask any question via contact form in', 'up-sell-pro').' <a href="'. esc_url('https://first-design-company.com/contact/')  .'" target="_blank" >'. esc_html__('Website', 'up-sell-pro').'</a> </p>',
			),
			// A Other products
			array(
				'type'    => 'heading',
				'content' => esc_html__( 'Other products', 'up-sell-pro' ),
			),

			array(
				'type'    => 'content',

				'content' => '<div class="up-cards-container">
							
								<div class="card">
								  <div class="image">
								    <!-- You can add an image here using the <img> element -->
								    <img src="'. esc_url(UP_SELL_PRO_URL . '/admin/img/baner-new.jpg')  .'" alt="Curie">
								  </div>
								  <div class="content">
								    <h2 class="title">'. esc_html__('Curie', 'up-sell-pro').'</h2>
								    <p class="description">'. esc_html__('Useful and Fast WordPress Theme For Authors And Writers', 'up-sell-pro').'</p>
								    <a class="button" href="'. esc_url('https://www.templatemonster.com/wordpress-themes/curie-wordpress-theme-for-authors-and-writers-278443.html')  .'" target="_blank">'. esc_html__('Learn more', 'up-sell-pro').'</a>
								  </div>
								</div>
								
								<div class="card">
								  <div class="image">
								    <!-- You can add an image here using the <img> element -->
								    <img src="'. esc_url(UP_SELL_PRO_URL . '/admin/img/pinkmilk.jpg')  .'" alt="Curie">
								  </div>
								  <div class="content">
								    <h2 class="title">'. esc_html__('PinkMilk', 'up-sell-pro').'</h2>
								    <p class="description">'. esc_html__('Creative And Clean WordPress Theme For Corporate Websites', 'up-sell-pro').'</p>
								    <a class="button" href="'. esc_url('https://www.templatemonster.com/wordpress-themes/pinkmilk-wordpress-theme-creative-and-clean-theme-for-corporate-websites-215871.html')  .'" target="_blank">'. esc_html__('Learn more', 'up-sell-pro').'</a>
								  </div>
								</div>
								
								<div class="card">
								  <div class="image">
								    <!-- You can add an image here using the <img> element -->
								    <img src="'. esc_url(UP_SELL_PRO_URL . '/admin/img/wellbook.jpg')  .'" alt="Curie">
								  </div>
								  <div class="content">
								    <h2 class="title">'. esc_html__('WellBook', 'up-sell-pro').'</h2>
								    <p class="description">'. esc_html__('Useful and Fast WordPress Theme For Authors And Writers', 'up-sell-pro').'</p>
								    <a class="button" href="'. esc_url('https://author-website.com/wellbook/')  .'" target="_blank">'. esc_html__('Learn more', 'up-sell-pro').'</a>
								  </div>
								</div>
								
								<div class="card">
								  <div class="image">
								    <!-- You can add an image here using the <img> element -->
								    <img src="'. esc_url(UP_SELL_PRO_URL . '/admin/img/lav.jpg')  .'" alt="Curie">
								  </div>
								  <div class="content">
								    <h2 class="title">'. esc_html__('LavRel', 'up-sell-pro').'</h2>
								    <p class="description">'. esc_html__('Religion & Church, Non-Profit WordPress Theme', 'up-sell-pro').'</p>
								    <a class="button" href="'. esc_url('https://lavrel.author-website.com/')  .'" target="_blank">'. esc_html__('Learn more', 'up-sell-pro').'</a>
								  </div>
								</div>
								
								<div class="card">
								  <div class="image">
								    <!-- You can add an image here using the <img> element -->
								    <img src="'. esc_url(UP_SELL_PRO_URL . '/admin/img/web-design.jpg')  .'" alt="Curie">
								  </div>
								  <div class="content">
								    <h2 class="title">'. esc_html__('Website Design', 'up-sell-pro').'</h2>
								    <p class="description">'. esc_html__('Professional Web Design & Development Services', 'up-sell-pro').'</p>
								    <a class="button" href="'. esc_url('https://first-design-company.com/web-development-agency/web-design/')  .'" target="_blank">'. esc_html__('Learn more', 'up-sell-pro').'</a>
								  </div>
								</div>
								
								<div class="card">
								  <div class="image">
								    <!-- You can add an image here using the <img> element -->
								    <img src="'. esc_url(UP_SELL_PRO_URL . '/admin/img/brand.jpg')  .'" alt="Curie">
								  </div>
								  <div class="content">
								    <h2 class="title">'. esc_html__('Branding', 'up-sell-pro').'</h2>
								    <p class="description">'. esc_html__('Branding And Identity Design Services', 'up-sell-pro').'</p>
								    <a class="button" href="'. esc_url('https://first-design-company.com/branding-service/')  .'" target="_blank">'. esc_html__('Learn more', 'up-sell-pro').'</a>
								  </div>
								</div>
								
								<div class="card">
								  <div class="image">
								    <!-- You can add an image here using the <img> element -->
								    <img src="'. esc_url(UP_SELL_PRO_URL . '/admin/img/redesign.jpg')  .'" alt="Curie">
								  </div>
								  <div class="content">
								    <h2 class="title">'. esc_html__('Website Redesign', 'up-sell-pro').'</h2>
								    <p class="description">'. esc_html__('Revamp And Redesign Of An Existing Website', 'up-sell-pro').'</p>
								    <a class="button" href="'. esc_url('https://first-design-company.com/web-development-agency/website-redesign/')  .'" target="_blank">'. esc_html__('Learn more', 'up-sell-pro').'</a>
								  </div>
								</div>
								
								<div class="card">
								  <div class="image">
								    <!-- You can add an image here using the <img> element -->
								    <img src="'. esc_url(UP_SELL_PRO_URL . '/admin/img/support.jpg')  .'" alt="Curie">
								  </div>
								  <div class="content">
								    <h2 class="title">'. esc_html__('Website Maintenance', 'up-sell-pro').'</h2>
								    <p class="description">'. esc_html__('Professional Website Maintenance & Support', 'up-sell-pro').'</p>
								    <a class="button" href="'. esc_url('https://first-design-company.com/web-development-agency/website-maintenance/')  .'" target="_blank">'. esc_html__('Learn more', 'up-sell-pro').'</a>
								  </div>
								</div>
								
								<div class="card">
								  <div class="image">
								    <!-- You can add an image here using the <img> element -->
								    <img src="'. esc_url(UP_SELL_PRO_URL . '/admin/img/tweaks.jpg')  .'" alt="Curie">
								  </div>
								  <div class="content">
								    <h2 class="title">'. esc_html__('WordPress Tweaks & Fix', 'up-sell-pro').'</h2>
								    <p class="description">'. esc_html__('Develop A New Plugin, Finalize The Theme', 'up-sell-pro').'</p>
								    <a class="button" href="'. esc_url('https://first-design-company.com/branding-service/')  .'" target="_blank">'. esc_html__('Learn more', 'up-sell-pro').'</a>
								  </div>
								</div>
							
							</div>',
			),
		)
	)
];







