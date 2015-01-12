<?php
include_once "./vendor/autoload.php";

$config = Rip\Rip::getConfig("main");

$app = new \Slim\Slim(
	Rip\Rip::getConfig("slim")
);

//default response set to 'Content-Type: application/json'
$app->response->headers->set('Content-Type', 'application/json');

//all call hook
$app->hook('slim.after', function () use ($app) {
    $request = $app->request;
    $response = $app->response;

	Rip\Rip::logCall( $request->getIp(), $request->getMethod(), $request->getPathInfo(), $response->getStatus());
});

// $app->params contain everything (GET/POST/RAWData)
$app->hook('slim.before.dispatch', function () use ($app) {
    $allJSON = json_decode( $app->request->getBody(), true );
		if( !is_array( $allJSON) ){
			$allJSON = array();
		}
		$allGetVars = $app->request->get();
		$allPostVars = $app->request->post();

		$app->params = array_merge($allJSON, $allGetVars, $allPostVars);
});

/*
 * ROUTING TABLES
 *
 */
include_once "routes/errors.php";

$app->run();
