<?php

namespace Rip;

class Db extends \medoo{

  public function __construct( ){
    $db_cfg = Rip::getConfig("database");

	return parent::__construct(array(
		'database_type' => $db_cfg['driver'],
		'database_name' => $db_cfg['database'],
		'server' => $db_cfg['host'],
		'username' => $db_cfg['user'],
		'password' => $db_cfg['password'],
		'charset' => 'utf8',
	));
  }

}
