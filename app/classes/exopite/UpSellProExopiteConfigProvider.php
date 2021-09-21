<?php
namespace classes\exopite;


class UpSellProExopiteConfigProvider {
	public $config;

	public function __construct($id, $pluginName, $title = 'Settings', $config = null) {

		if($config !== null){
			$this->config = $config;
		}else{
			$settings = array(
				'type'              => 'menu',           // Required, menu or metabox
				'id'                => $id,              // Required, meta box id,
				// unique per page, to save:
				// get_option( id )
				'parent'            => '',                   // Required, sub page to your options page
				'submenu'           => false,
				'menu_title'        => $title,// Required for submenu
				'title'             => $title,               // The name in the WordPress menu and the title of the Option page
				'option_title'      => $title,               // The title of the Option page, this will override 'title'
				'capability'        => 'manage_options',                // The capability needed to view the page
				'plugin_basename'   =>  plugin_basename( plugin_dir_path( __DIR__ ) . $pluginName . '.php' ),
				// 'tabbed'            => false,                        // is tabbed or not
				// Note: if only one section then
				// Tabs are disabled.
				'multilang'         => false                         // Disable mutilang support, default: true
			);
			$this->setConfig($settings);
		}

	}

	public function getConfig(){
		return $this->config;
	}

	/**
	 * @param array $config
	 */
	public function setConfig( $config ) {
		$this->config = $config;
	}

}
