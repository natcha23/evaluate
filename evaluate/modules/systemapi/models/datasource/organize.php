<?php
class Systemapi_organize_Table extends Zend_Db_Table {
    protected $_name = "org_sec" ;
	protected static $_recordCount = 0;

	public function getRecordCount() {
        return self::$_recordCount;
    }

	public function getOrganize($where,$start,$perpage){
		$select = $this->_db->select()
     				   ->from($this->_name, array('*'));

     	$select2 = $this->_db->select()
                      	->from($this->_name,"COUNT(*)");
		if($where){
			$select->where($where);
			$select2->where($where);
		}
		$select->order("org_sec_code");
		$select->limitPage($start,$perpage);

        $dataArray   = $select->query()->fetchAll();
        $totalRecord = $this->_db->fetchOne($select2);

        $select = $select2 = null;
        return array('data'=>$dataArray,'total'=>$totalRecord);
	}
    public function getOrganizeById($where){
		$select = $this->_db->select()
     				   ->from(array('org'=>$this->_name), array('*'))
     				   ->joinLeft(array ("u" =>"user"),"org.user_header = u.user_code and u.user_header = 'Y'",array('user_name','user_lname'))
     				   ->where($where);


     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function GetOrgByCode($where){
		$select = $this->_db->select()
     				   ->from(array('org'=>$this->_name), array('*'))
     				   ->where($where);
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
}

