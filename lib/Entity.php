<?php
namespace Rip;

class Entity{

	/**
	 * All the internal vars must have _rip_ prefix
	 */
	protected $_rip_db;
	protected $_rip_table;
	protected $_rip_tableid;

	/*
	 * table & table_id for database binding
	 */
	public function __construct($table, $tableid="id"){
		$this->_rip_table = $table;
		$this->_rip_tableid = $tableid;
		$this->_rip_db = new Db();

	}

	/**
	 * delete a document
	 * @param  [model id]
	 * @return [boolean]
	 */
	public function delete($id){

		$where = [ $this->_rip_tableid => $id];

		$data = $this->_rip_db->delete( $this->_rip_table, $where);

		if( $data>0 ){
			return true;
		} else {
			return false;
		}
	}
	/**
	 * fetch a document and load by id
	 * @param  [model id]
	 * @return [boolean]
	 */
	public function load($id){
		$fields = array_keys($this->getProperty());
		$where = [ $this->_rip_tableid => $id];

		$data = $this->_rip_db->get( $this->_rip_table, $fields, $where);

		if( !empty($data) ){
			foreach( $fields as $key ){
				$this->$key = $data[$key];
			}
			return true;
		} else {
			return false;
		}
	}

	/**
	 * fetch a document and load
	 * @param  [model id]
	 * @return [boolean]
	 */
	public function loadBy($field, $value){
		$fields = array_keys($this->getProperty());
		$where = [ $field => $value];

		$data = $this->_rip_db->get( $this->_rip_table, $fields, $where);

		if( !empty($data) ){
			foreach( $fields as $key ){
				$this->$key = $data[$key];
			}
			return true;
		} else {
			return false;
		}
	}

	/**
	 * if $this->[tableid] is set perform UPDATE. If not do INSERT.
	 */
	public function save(){
		$data = $this->getProperty();
		if( !isset($data[ $this->_rip_tableid ]) || is_null($data[ $this->_rip_tableid ]) ){
			//insert
			$res = $this->_rip_db->insert($this->_rip_table,  $data);
			$this->id = $res;
		} else {
			//update
			$res = $this->_rip_db->update($this->_rip_table,  $data, [ $this->_rip_tableid => $data[ $this->_rip_tableid ] ]);
			//$res = Db::query("UPDATE {$this->_rip_table} SET name='rocco' WHERE {$this->_rip_tableid} = {$prop[$this->_rip_tableid]} ");
		}
		$error = $this->_rip_db->error();
		if( $error[0] !== "00000"){
			var_dump( $error );
		}
		return $res;
	}

	/**
	 * return array(): child's class property
	 */
	public function getProperty(){

		$prop = [];
		foreach( get_object_vars($this) as $key => $value){
			if( is_string( $key)) {
				if( substr($key, 0, 4)!=="_rip_" ){
					$prop[$key] = $value;
				}
			}
		}
		return $prop;
	}

	public function dump(){
			var_dump( $this );
	}

	public function getTable(){
			return $this->_rip_table;
	}

	public function toJSON(){
			$values = $this->getProperty();
			return json_encode( $values, JSON_FORCE_OBJECT);
	}

}
