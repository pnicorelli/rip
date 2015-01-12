<?php

namespace Rip;

class Rip{

	public static function getConfig( $section = "main" ){
		$filename = dirname(dirname(__FILE__))."/config/".$section.".ini";
		$ini = parse_ini_file($filename, true);
		return $ini;
	}

	public static function say401( $app ){
		$app->response->setStatus(401);
		$app->response->setBody( json_encode( array( "message" => "You are not authorized for that" ), JSON_FORCE_OBJECT ) );
		$app->stop();
		return;
	}

	public static function logCall( $remote_ip, $method, $path, $res_status){
		$log = new \RipModel\Log;
		$log->remote_ip = $remote_ip;
		$log->method = $method;
		$log->path = $path;
		$log->res_status = $res_status;
		$log->date = date("Y-m-d H:i:s");
		return $log->save();
	}

	public static function authorizeOnly($app, $roles ){
		if( !isset($app->params['user_token']) ){
			Rip::say401( $app );
			return false;
		}

		$user = new \RipModel\User;
		$user->loadBy("token", $app->params["user_token"] );

		if( $user->is( $roles ) ){

			return true;
		} else {
			Rip::say401( $app );
			return false;
		}

	}
}
