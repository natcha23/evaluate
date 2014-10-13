<?php
class Systemapi_form_Table extends Zend_Db_Table {
    protected $_name = "mst_evaluateform" ;
	protected static $_recordCount = 0;

	public function getRecordCount() {
        return self::$_recordCount;
    }

	public function getFormEvaluate($where,$start,$perpage){
		$select = $this->_db->select()
     				   ->from($this->_name, array('*'));

     	$select2 = $this->_db->select()
                      	->from($this->_name,"COUNT(*)");
		if($where){
			$select->where($where);
			$select2->where($where);
		}
		$select->order("form_id");
		$select->limitPage($start,$perpage);

        $dataArray   = $select->query()->fetchAll();
        $totalRecord = $this->_db->fetchOne($select2);

        $select = $select2 = null;
        return array('data'=>$dataArray,'total'=>$totalRecord);
	}
    public function getFormEvaluateById($where){
		$select = $this->_db->select()
     				   ->from($this->_name, array('*'))
     				   ->where($where);

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getCopyFormEvaluate(){
		$select = $this->_db->select()
					   ->from(array ("h" => "eva_mipi_head"), array('user_first_recive'))
					   ->joinLeft(array ("u" =>"user"),"h.user_first_recive = u.user_code",array('user_name','user_lname','user_sec_depart','user_position'))
					   ->joinLeft(array ("T1" =>"org_position"),"user_position = T1.org_position_code",array('org_position_name_th','org_position_level'))
     				  // ->joinLeft(array ("T2" =>"org_sec"),"user_sec_depart = T2.org_sec_code",array('org_sec_name_th'))
					   ->group("user_first_recive")
					   ->order("user_first_recive");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getDraftFormEvaluate(){
		$select = $this->_db->select()
					   ->from(array ("h" => "draft_evaluateform"), array('*'))
					   ->joinLeft(array ("u" =>"user"),"h.user_rec = u.user_code",array('user_name','user_lname', 'lookup_code'))
					   ->order("h.createdate DESC");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getDraftFrmById($where){
		$select = $this->_db->select()
     				   ->from("draft_evaluateform", array('*'))
     				   ->where($where);

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}


}

