<?php
namespace rip;

class Entity{
	private $_rip_db;
	private $_rip_table;
	private $_rip_tableid;

	/*
	 * table & table_id for database binding
	 */
	public function __construct($table, $tableid="id"){
		$this->_rip_table = $table;
		$this->_rip_tableid = $tableid;
		$this->_rip_db = new Db();
	}
	
	public function save(){
		$data = $this->getProperty();
		if( is_null($data[$this->_rip_tableid]) ){
			//insert 
			
			$res = $this->_rip_db->insert($this->_rip_table,  $data);
		} else {
			//update
			$res = Db::query("UPDATE {$this->_rip_table} SET name='rocco' WHERE {$this->_rip_tableid} = {$prop[$this->_rip_tableid]} ");
		}
		var_dump($data);
	}
	
	public function getProperty(){
		$prop = get_object_vars	($this);
		return array_filter( $prop, function( $item ){
			 return (substr($item, 0, 5)==="_rip_" );
		});
	}
	
	public function dump(){
			var_dump( $this );
	}
}
