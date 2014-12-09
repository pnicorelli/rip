<?php
namespace rip;

class Router{

	public function Router(){

	}

	public static function dispatch(){
		$config = App::getConfig();

		if( strrpos($_SERVER["REQUEST_URI"], "?") !== false){
			list($req["url"], $query) = explode("?", "/".str_replace( $config["main"]["baseurl"], "", $_SERVER["REQUEST_URI"]));
		} else {
			$req["url"] = "/".str_replace( $config["main"]["baseurl"], "", $_SERVER["REQUEST_URI"]);
			$query="";
		}
		
		$req["components"] = array_values(array_filter(explode("/", $req["url"])));

		$query_values = array_filter( explode("&", $query) );

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
				$action = strtolower($req["method"]);
				if( method_exists($obj, $action) ){
					try{
						$res["_status"] = "200";
						$res["_embed"] = $obj->$action($req);
					} catch (\Exception $e){
						$res["_status"] = "401";
						$res["_embed"] = $e;
					}
				} else {
					$res["_status"] = "404";
					$res["_embed"] = ["message"=>"Method {$controllerClass}::{$action}() not implemented!"];
				}
			} else {
					$res["_status"] = "404";
					$res["_embed"] =  ["message"=>"Module {$controllerClass} not implemented!"];
			}
		} else {
			$res["_status"] = "404";
			$res["_embed"] = "Default Route not found!";
		}

		Response::send($res);

	}
}
