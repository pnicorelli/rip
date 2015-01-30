<?php
namespace IY;

class Collection{
	private $_iv_entity;
	private $_iv_db;

	public function __construct(Entity $entity){
		$this->_iv_entity = $entity;
		$this->_iv_db = new Db();
	}

	public function getAll(){
		return $this->_iv_db->select($this->_iv_entity->getTable(),  "*");
	}

	public function find( $where, $select = null){
		if( is_null($select) ){
			$select  ="*";
		}
		return $this->_iv_db->select($this->_iv_entity->getTable(),  $select, $where);
	}

	public function delete( $where ){

		return $this->_iv_db->delete($this->_iv_entity->getTable(),  $where);
	}

}
