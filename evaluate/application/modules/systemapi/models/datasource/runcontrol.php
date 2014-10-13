<?php
class Systemapi_runcontrol_Table extends Zend_Db_Table {
    protected $_name= "runcontrol";
	
	public function getRunIdControl($param){
		$select = $this->_db->select()
     				   ->from(array ($this->_name), array('*'))
     				   ->where("dr_type=?",$param);
     				
     	$rs = $select->query();
        $rows = $rs->fetchAll();        
        return $rows[0];
	}
    
    
}

