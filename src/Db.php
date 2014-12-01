<?php

namespace rip;

class Db extends \medoo{

  public function __construct( ){
    $config = App::getConfig("database");

	parent::__construct(array(
		'database_type' => $config['driver'],
		'database_name' => $config['database'],
		'server' => $config['host'],
		'username' => $config['user'],
		'password' => $config['password'],
		'charset' => 'utf8',
	));
  }

}
