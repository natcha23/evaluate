<?php
if(!class_exists('Zend_Db_Select_Exception'))
     Zend_Loader :: loadClass('Zend_Db_Select_Exception');

class Systemapi_account_Table extends System_Db_Table {
    protected $_name= "user";
    protected $_dependentTables = array("Systemapi_Product_Table");
	protected static $_recordCount = 0;

	public function getRecordCount() {
        return self::$_recordCount;
    }
	public function getAccount($where,$start,$perpage,$status){
		$select = $this->_db->select()
     				   ->from($this->_name, array('*'))
     				   ->joinLeft(array ("T1" =>"org_position"),"user_position = T1.org_position_code",array('org_position_name_th','org_position_level'))
     				   ->joinLeft(array ("T2" =>"org_sec"),"user_sec_depart = T2.org_sec_code",array('org_sec_name_th'))
					   ->where("user_active =?",$status);
     	$select2 = $this->_db->select()
                      	->from($this->_name,"COUNT(*)")
                      	->where("user_active =?",$status);
		if($where){
			$select->where($where);
			$select2->where($where);
		}
		if($_POST[fields_sort])
			$select->order($_POST[fields_sort]." ".$_POST[order]);
		else
		$select->order("user_sec_depart");
     	$select->order("org_position_level desc");
     	$select->order("user_position");
     	$select->order("user_code");
		$select->limitPage($start,$perpage);
        $dataArray   = $select->query()->fetchAll();
        $totalRecord = $this->_db->fetchOne($select2);

        $select = $select2 = null;
        return array('data'=>$dataArray,'total'=>$totalRecord);
	}
	public function getSalary($where,$start,$perpage){
		$select = $this->_db->select()
     				   ->from("acc_salary", array('*'))
 					   ->where($where);
     	$select2 = $this->_db->select()
                      	->from("acc_salary","COUNT(*)")
                      	->where($where);

		$select->order("date_upsalary DESC");
		$select->limitPage($start,$perpage);

        $dataArray   = $select->query()->fetchAll();
        $totalRecord = $this->_db->fetchOne($select2);

        $select = $select2 = null;
        return array('data'=>$dataArray,'total'=>$totalRecord);
	}
	public function getAccountById($where){
		$select = $this->_db->select()
     				   ->from($this->_name, array('*'))
     				   ->joinLeft(array ("T1" =>"org_position"),"user_position = T1.org_position_code",array('org_position_name_th','org_position_level'))
     				   ->where($where);

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getAccountOp(){
		$select = $this->_db->select()
     				   ->from($this->_name, array('*'))
     				   ->joinLeft(array ("T1" =>"org_position"),"user_position = T1.org_position_code",array('org_position_name_th','org_position_level'));

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getSalaryById($where){
		$select = $this->_db->select()
     				   ->from("acc_salary", array('*'))
     				   ->where($where);

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function GetGroupMenuOp(){
		$select = $this->_db->select()
     				   ->from("lookup_menu", array('lookup_code','lookup_name'))
     				   ->group("lookup_code")
     				   ->order("lookup_code");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getPositionActiveOp($where){
		$select = $this->_db->select()
     				   ->from("org_position", array('org_position_code','org_position_name_th'))
     				   ->where($where)
     				   ->group("org_position_code")
     				   ->order("org_position_name_th");
     	return $this->_db->fetchPairs($select);
	}
	public function getDepartmentActiveOp($where){
		$select = $this->_db->select()
     				   ->from("org_sec", array('org_sec_code','org_sec_name_th'))
     				   ->where($where)
     				   ->order("org_sec_code");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getPositionOp(){
		$select = $this->_db->select()
     				   ->from("org_position", array('org_position_code','org_position_name_th'))
     				   ->group("org_position_code")
     				   ->order("org_position_name_th");
     	return $this->_db->fetchPairs($select);
	}
	public function getDepartmentOp(){
		$select = $this->_db->select()
     				   ->from("org_sec", array('org_sec_code','org_sec_name_th'))
     				   ->order("org_sec_code");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function GetLevel($where){
		$select = $this->_db->select()
     				   ->from("org_position", array('org_position_level'))
     				   ->where($where);

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}

}


