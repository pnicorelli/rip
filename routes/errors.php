<?php

$app->get('/401', function ()  use ($app) {
		$app->response->setStatus(401);
		$app->response->setBody( json_encode( array( "message" => "You are not authorized for that" ), JSON_FORCE_OBJECT ) );
});
