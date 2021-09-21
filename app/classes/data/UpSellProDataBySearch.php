<?php


namespace classes\data;



use classes\abstracts\UpSellProDataExtractor;

class UpSellProDataBySearch extends UpSellProDataExtractor{
	public $DESTROY_COOKIE_TIME;

	public function __construct($settings, $helper) {
		parent::__construct($settings, $helper);
		$this->run();
		$this->DESTROY_COOKIE_TIME = time()-(60*60*24*7);
	}

	public function enableTrackSearch(){
		if(!isset($_COOKIE['up-sell-search'])){
			setcookie( 'up-sell-search', json_encode([]), time()+(60*60*24*7),'/');
		}
	}

	public function disableTrackSearch(){
		setcookie('up-sell-search', '', $this->DESTROY_COOKIE_TIME,'/');
	}

	public function run() {
		if($this->settings['general_track_search'] == 'yes'){
			add_action( 'init', array($this, 'enableTrackSearch') );
		}else{
			add_action( 'init', array($this, 'disableTrackSearch') );
		}
	}

	public function getData($args) {
		if(isset($_COOKIE['up-sell-search'])){
			return  array_slice(json_decode(stripslashes($_COOKIE['up-sell-search'])), '-' . $args['offset_search'])  ;
		}
	}
}
