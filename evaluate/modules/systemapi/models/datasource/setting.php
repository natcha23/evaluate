<?php
class Systemapi_setting_Table extends Zend_Db_Table {
    protected $_name = "head_setting" ;
	protected static $_recordCount = 0;

	public function getRecordCount() {
        return self::$_recordCount;
    }
	public function getDataList($where,$start,$perpage){
		$select = $this->_db->select()
     				   ->from($this->_name, array('*'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = hs_send",array('user_name as user_send'))
     				   ->joinLeft(array ("u2" =>"user"),"u2.user_code = hs_recive",array('user_name as user_recive'));
     	$select2 = $this->_db->select()
                      	->from($this->_name,"COUNT(*)");
		if($where){
			$select->where($where);
			$select2->where($where);
		}
		if($_POST[fields_sort])
			$select->order($_POST[fields_sort]." ".$_POST[order]);
		else
			$select->order("hs_id");

		$select->limitPage($start,$perpage);
        $dataArray   = $select->query()->fetchAll();
        $totalRecord = $this->_db->fetchOne($select2);

        $select = $select2 = null;
        return array('data'=>$dataArray,'total'=>$totalRecord);
	}
    public function getDataById($where){
		$select = $this->_db->select()
     				   ->from($this->_name, array('*'))
     				   ->where($where);

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
}

