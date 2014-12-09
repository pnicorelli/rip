<?php

namespace rip;

class App{
	public $rootdir;
	public $config;
	
	public function run(){
		Router::dispatch();
	}
	
	/*
	 * Retrieve config from [BASEPATH]/config/main.ini
	 * specify $section for different file
	 */
	public static function getConfig( $section = "main" ){
		$filename = dirname(dirname(__FILE__))."/config/".$section.".ini";
		$ini = parse_ini_file($filename, true);
		return $ini;
	}
}
