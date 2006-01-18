<?php
//language class
class rich_lang{
	var $lang;					//current language
	var $default_lang = 'en';	//default language
	var $lang_data;				//text data in the current language
	var $dialog;				//must be true for dialog windows

	//constructor
	function rich_lang($lang='en', $dialog=true){
		$this->load_lang($lang, $dialog);
	}

	//load new language
	function load_lang($lang='en', $dialog=true){
		if(!$dialog){
			global $class_path;
			$path_prefix = $class_path.'rich_files/';
		}else $path_prefix = '';

		$this->lang = $lang;
		$this->dialog = $dialog;

		//get language
		@include($path_prefix.'lang/rich_lang_'.$this->lang.'.inc.php');

		//the language not found
		if(!$rich_lang){
			//get default language
			@include($path_prefix.'lang/rich_lang_'.$this->default_lang.'.inc.php');
		}

		$this->lang_data = $rich_lang; //store language data
  
	}

	//get language item (string or array of strings)
	function item($name){
		return @$this->lang_data[$name];
	}
}
?>