<?php

namespace rip;

class Db extends \Asgard\Db\DB{

  public function __construct( ){
    $config = App::getConfig("database");

    $dbCfg = [
      'host' => $config['host'],
      'user' => $config['user'],
      'password' => $config['password'],
      'database' => $config['database'],
      'prefix' => $config['prefix'],
      'driver' => $config['driver']
    ];
    return parent::__construct( $dbCfg );
  }

}
