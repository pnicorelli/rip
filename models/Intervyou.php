<?php
namespace ripModel;

class Intervyou extends \rip\Entity{
		
	/* TABLE FIELDS */
	public $id;
	public $name;
	
	public function __construct(){
		//parent::__construct( $table, $tableid);
		parent::__construct("test", "id");
	}
		
}
