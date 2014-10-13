<?php
class Systemapi_menu_Table extends Zend_Db_Table {
    protected $_name = "menu" ;
	
	public function getTopMenu($Id){
		$select = $this->_db->select()
     				   ->from(array ("member" => "{$this->_name}"), array('*'))
     				   ->order("menu_id");
     				
     	$rs = $select->query();
        $rows = $rs->fetchAll();        
        return $rows;
	}
    public function getMenu($where){
		$select = $this->_db->select()
     				   ->from(array ("member" => "{$this->_name}"), array('*'))
     				   ->where($where)
     				   ->order("menu_id");
     				
     	$rs = $select->query();
        $rows = $rs->fetchAll();        
        return $rows;
	}
	public function getLookupMenu($where) {
		$select = $this->_db->select()
		->from(array ("l" => "lookup_menu"), array('m_id'))
		->join(array ("m" => "menu_master") ,"m.m_id = l.section_id" , array())
		->where($where)
		->order("m_id");
		 
		$rs = $select->query();
		$rows = $rs->fetchAll();
		return $rows;
	}
    
}

