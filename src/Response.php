<?php

namespace rip;

class Response{

  public function send( $res = array()){
    Response::sendJson($res);
  }

  public function sendJson( $res = array()){

		$config = App::getConfig();
		http_response_code($res["_status"]);
		header("Content-Type: application/json");
		header("X-Powered-By: ".$config["main"]["appName"]." v".$config["main"]["appVersion"], true);

    echo json_encode($res["_embed"], JSON_FORCE_OBJECT);
  }

}
