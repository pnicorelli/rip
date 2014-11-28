<?php
namespace rip;

class Router{
	
	public function Router(){
	
	}

	public static function dispatch(){
		$config = App::getConfig();

		list($req["url"], $query) = explode("?", "/".str_replace( $config["main"]["baseurl"], "", $_SERVER["REQUEST_URI"]));
		$req["components"] = array_values(array_filter(explode("/", $req["url"])));
		$query_values = explode("&", $query);
		foreach($query_values as $value){
			list( $k, $v) = explode("=", $value);
			$req["query"][$k] = $v;
		}

		$req["method"] = $_SERVER["REQUEST_METHOD"];
		$req["params"] = $_REQUEST;
		$res = array();
		if( $req["components"][0]."x" <> "x" ){
			//$req["components"][0] will be the controller class
			$controllerClass = "\\" . $req["components"][0];
			if ( class_exists( $controllerClass, true) ){
				$obj = new $controllerClass();
				$action = $req["method"];
				if( method_exists($obj, $action) ){
					$res = $obj->$action($req);
				} else {
					$res["status"] = "404";
					$res["message"] = "Method not found!";
				}
			} else {
					$res["status"] = "404";
					$res["message"] = "Module {$controllerClass} not found!";
			}
		} else {
			$res["status"] = "404";
			$res["message"] = "Default Route not found!";
		}
		var_dump($res);

	}
}
