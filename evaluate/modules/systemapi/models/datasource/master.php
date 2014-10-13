<?php
class Systemapi_master_Table extends Zend_Db_Table {
    protected $_name = "master_evaluate" ;

	public function getEvaluateHead($where){
		$select = $this->_db->select()
     				   ->from(array ("mst_eva" => "{$this->_name}"), array('*'));
     	if($where)
     		$select->where($where);

     				   $select->order("mst_eva_order");
     				   $select->order("mst_eva_parent");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getEvaluateMST($where){
		$select = $this->_db->select()
     				   ->from(array ("mst_eva" => "{$this->_name}"), array('*'));
     	if($where)
     		$select->where($where);

     				   $select->order("mst_eva_order");
     				   //$select->order("mst_eva_parent");
//_print($select->__toString());exit;
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}

	public function getEvaluateByType($type){
		$select = $this->_db->select()
     				   ->from(array ("mst_eva" => "{$this->_name}"), array('*'))
     				   ->where("mst_eva_type =?",$type)
     				   ->order("datetime");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getEvaluateByHPI($where){
		$select = $this->_db->select()
     				   ->from(array ("mst_eva" => "{$this->_name}"), array('*'))
     				   ->where($where)
     				   ->order("mst_eva_order");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getGradeData(){
		$select = $this->_db->select()
     				   ->from(array ("grade" => "master_grade"), array('*'))
     				   ->order("grade");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getGradeByScoll($where){
		$select = $this->_db->select()
     				   ->from(array ("grade" => "master_grade"), array('*'))
     				   ->where($where)
     				   ->order("grade");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getDataCopy($where){
		$select = $this->_db->select()
     				   ->from(array("h"=>"eva_mipi_line"), array('*'));
     				   //->joinLeft(array("l"=>"eva_mipi_line"),"h.mpl_id = l.mpl_parent", array("parent_name"=>"l.mpl_subject"));
     	if($where)
     		$select->where($where);

     	$select->order("h.mpl_id");
	//_print($select->__toString());exit;
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getDataCopyById($where){
		$select = $this->_db->select()
     				   ->from(array("h"=>"eva_mipi_line"), array('*'))
     				   ->where($where);
	//_print($select->__toString());exit;
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows[0];
	}
	public function getParentDataCopy($where){
		$select = $this->_db->select()
     				   ->from(array("h"=>"eva_mipi_line"), array('*'));
      	if($where)
     		$select->where($where);

     	$select->order("h.mpl_id");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	
	/*
	 * get year from database
	 * have on head pi only.
	 * natcharee@icesolution.com
	 * 2014 Aug 28
	 */
	public function getApiYearOptions()
	{
		$db = $this->_db;
		
		$select = $db->select()
					->from(array("eva_mipi_head"), array("mph_createdate") )
					->where("1")
					->group("year(mph_createdate)");
		
		$rows = $select->query()->fetchAll();
		
		return $rows;
	}

}

