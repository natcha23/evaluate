<?php
class Systemapi_grade_Table extends Zend_Db_Table {
    protected $_name = "master_grade" ;


	public function getGradeMST(){
		$select = $this->_db->select()
     				   ->from(array ("mst_grad" => "master_grade"), array('*'))
     				   ->order("start_scoll DESC");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getGradeMST2($direction='ASC'){
		$select = $this->_db->select()
     				   ->from(array ("mst_grad" => "master_grade"), array('*'))
     				   #->order("gr_id DESC");
						->order("start_scoll " . $direction); #natcharee (02 Apr 2014)

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}

    public function getGradeById($grade){
		$select = $this->_db->select()
     				   ->from(array ("mst_grad" => "master_grade"), array('*'))
     				   ->where("gr_id =?",$grade)
     				   ->order("grade");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}

}

