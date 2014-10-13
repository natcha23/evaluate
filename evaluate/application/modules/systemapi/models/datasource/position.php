<?php
class Systemapi_position_Table extends Zend_Db_Table {
    protected $_name = "org_position" ;
	protected static $_recordCount = 0;

	public function getRecordCount() {
        return self::$_recordCount;
    }

	public function getPosition($where,$start,$perpage){
		$select = $this->_db->select()
     				   ->from($this->_name, array('*'));
     	$select2 = $this->_db->select()
                      	->from($this->_name,"COUNT(*)");
		if($where){
			$select->where($where);
			$select2->where($where);
		}
		if($_POST[fields_sort])
			$select->order($_POST[fields_sort]." ".$_POST[order]);
		else
			$select->order("org_position_code");

		$select->limitPage($start,$perpage);
        $dataArray   = $select->query()->fetchAll();
        $totalRecord = $this->_db->fetchOne($select2);

        $select = $select2 = null;
        return array('data'=>$dataArray,'total'=>$totalRecord);
	}

    public function getPositionById($where){
		$select = $this->_db->select()
     				   ->from($this->_name, array('*'))
     				   ->where($where);
		
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getMaxId(){
		$select = $this->_db->select()
     				   ->from($this->_name, array('MAX(org_position_code) as max_id'));

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	
	/*
	 * add function by natcha 
	 * on 06 Jun 2014.
	 * V.1.2
	 */
	public function getPositionByIdActive($where){
		$select = $this->_db->select()
						->from($this->_name, array('*'))
						->where($where);
		
		$select->where("org_position_status = 'Y'");
		$rs = $select->query();
		$rows = $rs->fetchAll();
		
		return $rows;
	}


}

