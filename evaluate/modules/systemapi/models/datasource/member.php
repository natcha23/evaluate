<?php
class Systemapi_Member_Table extends Zend_Db_Table {
    protected $_name = 'user';
    protected static $_recordCount = 0;

	public function getRecordCount() {
        return self::$_recordCount;
    }

	public function getUserOption(){
		$select = $this->_db->select()
     				   ->from(array ("user" =>"{$this->_name}"), array('user_code','user_name','user_lname'))
     	   			   ->order("user_code");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
		if($rows){
			foreach($rows as $item){
				$dataArr[$item[user_code]] = $item;
			}
		}
        return $dataArr;
	}
	public function getUserList(){
		$select = $this->_db->select()
     				   ->from(array ("user" =>"{$this->_name}"), array('user_code','user_name','user_lname','user_sec_depart'))
     				   ->joinLeft(array ("sec" =>"org_sec"),"sec.org_sec_code = user.user_sec_depart",array('org_sec_name_th'))
     				   ->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = user.user_position",array('org_position_name_th'))
     				   ->where("user_active =?",'Y')
     				   ->order("user_code");

     	$rs = $select->query();
        $rows = $rs->fetchAll();

        return $rows;
	}
	public function getUserPage($start,$perpage){
		$select = $this->_db->select()
     				   ->from(array ("user" =>"{$this->_name}"), array('user_code','user_name','user_lname','user_sec_depart'))
     				   ->joinLeft(array ("sec" =>"org_sec"),"sec.org_sec_code = user.user_sec_depart",array('org_sec_name_th'))
     				   ->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = user.user_position",array('org_position_name_th'))
     				   ->where("user_active =?",'Y')
     				   ->order("user_code");

     	/*$rs = $select->query();
        $rows = $rs->fetchAll();*/
       	$select2 = $this->_db->select()
                      	->from($this->_name,"COUNT(*)")
                      	->where("user_active =?",'Y');

        $select->limitPage($start,$perpage);

        $dataArray   = $select->query()->fetchAll();
        $totalRecord = $this->_db->fetchOne($select2);

        $select = $select2 = null;
        return array('data'=>$dataArray,'total'=>$totalRecord);

	}
	public function getUserAccept($where,$where1){
		$select = $this->_db->select()
     				   ->from(array ("user" =>"{$this->_name}"), array('user_code','user_name','user_lname','user_sec_depart'))
     				   ->joinLeft(array ("sec" =>"org_sec"),"sec.org_sec_code = user.user_sec_depart",array('org_sec_name_th'))
     				   ->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = user.user_position",array('org_position_name_th','org_position_level'))
					   ->where("org_position_level < '12' AND user_active = 'Y' ");

     	if($where)
     		$select->where($where);

     	if($where1)
     		$select->where($where1);

     	$select->order("user_sec_depart");
     	$select->order("org_position_level desc");
     	$select->order("user_position");
     	$select->order("user_code");
	
     	$rs = $select->query();
        $rows = $rs->fetchAll();

        return $rows;
	}
	public function getUserPortal($where,$where1){
		$select = $this->_db->select()
     				   ->from(array ("user" =>"{$this->_name}"), array('user_code','user_name','user_lname','user_sec_depart'))
     				   ->joinLeft(array ("sec" =>"org_sec"),"sec.org_sec_code = user.user_sec_depart",array('org_sec_name_th'))
     				   ->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = user.user_position",array('org_position_name_th','org_position_level'))
					   ->where("user_active ='Y' and org_position_level < '12' ");
     	if($where)
     		$select->where($where);

     	if($where1)
     		$select->where($where1);

     	$select->order("user_sec_depart");
     	$select->order("org_position_level desc");
     	$select->order("user_position");
     	$select->order("user_code");

     	$rs = $select->query();
        $rows = $rs->fetchAll();

        return $rows;
	}
	public function getUserListByG($group){
		$select = $this->_db->select()
     				   ->from(array ("user" => "{$this->_name}"), array('user_code','user_name','user_lname'))
     				   ->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = user.user_position",array('org_position_name_th'))
     				   ->where("user_sec_depart =?",$group)
     				   ->where("user_active =?",'Y')
     				   ->order("user_code");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getUserListWhere($where){
		$select = $this->_db->select()
     				   ->from(array ("user" =>"{$this->_name}"), array('user_code','user_name','user_lname','user_sec_depart'))
     				   //->joinLeft(array ("sec" =>"org_sec"),"sec.org_sec_code = user.user_sec_depart",array('org_sec_name_th'))
     				   ->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = user.user_position",array('org_position_name_th','org_position_level'))
					   ->where("user_active = 'Y'");
					  // ->where("user_active = 'Y' and org_position_level < '9' ");
     	if($where)
     		$select->where($where);
     	$select->order("org_position_level desc");
     	$select->order("user_position");
     	$select->order("user_code");
     	$select->order("user_name");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getUserPageByG($where,$start,$perpage){
		$select = $this->_db->select()
     				   ->from(array ("user" => "{$this->_name}"), array('user_code','user_name','user_lname'))
     				   ->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = user.user_position",array('org_position_name_th'))
     				   ->where("user_active =?",'Y');

		$select2 = $this->_db->select()
                      	->from("user","COUNT(*)")
                      	->where("user_active =?",'Y');
		if($where){
			$select->where($where);
			$select2->where($where);
		}
        $select->limitPage($start,$perpage);
        $select->order("user_code");

        $dataArray   = $select->query()->fetchAll();
        $totalRecord = $this->_db->fetchOne($select2);

        $select = $select2 = null;
        return array('data'=>$dataArray,'total'=>$totalRecord);

	}
	public function getUserByHeader($header){
		$select = $this->_db->select()
     				   ->from(array ("user" => "{$this->_name}"), array('user_code','user_name','user_lname'))
     				   ->where("user_sec_depart =?",$header)
     				   ->where("user_active =?",'Y')
     				   ->order("user_code");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getPositionByUser($code){
		$db = Zend_Registry :: get("db");
		$select = $this->_db->select()
     				   ->from(array ("user" => "{$this->_name}"), array('user_code','user_name','user_position'))
    				   //->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = user.user_position",array('org_position_level'))
     				   ->where("user_code =?",$code)
     				   ->where("user_active =?",'Y');

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        if($rows){
        	foreach($rows as $item){
        		$sql ="SELECT org_position_level FROM org_position WHERE org_position_code = '".$item[user_position]."' ";
				$rs_po = $db->query($sql);
				$data = $rs_po->fetchAll();
				//_print($data);
				$dataArr = $item;
				$dataArr[level] = $data[0][org_position_level];
        	}
        }
        return $dataArr;
	}
	public function getUserById($code){
		$select = $this->_db->select()
     				   ->from(array ("user" => "{$this->_name}"), array('*'))
     				   ->joinLeft(array ("sec" =>"org_sec"),"sec.org_sec_code = user.user_sec_depart",array('org_sec_name_th'))
     				   ->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = user.user_position",array('org_position_name_th','org_position_level'))
     				   ->where("user_code =?",$code);
     				   //->where("user_active =?",'Y');

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        unset($rows[0][u_password]);
        return $rows;
	}
	public function getUserINId($code){
		$select = $this->_db->select()
     				   ->from(array ("user" => "{$this->_name}"), array('*'))
     				   ->joinLeft(array ("sec" =>"org_sec"),"sec.org_sec_code = user.user_sec_depart",array('org_sec_name_th'))
     				   ->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = user.user_position",array('org_position_name_th','org_position_level'))
     				   ->where("user_code IN ($code) ");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        if($rows){
        	foreach($rows as $item){
        		unset($item[u_password]);
        		$data_arr[] = $item;
        	}
        }
        
        return $data_arr;
	}
	public function GetEmployee($where){
		$select = $this->_db->select()
     				   ->from(array ("user" => "{$this->_name}"), array('user_code','user_name','user_lname','user_sec_depart'))
     				   ->joinLeft(array ("sec" =>"org_sec"),"sec.org_sec_code = user.user_sec_depart",array('org_sec_name_th'))
     				   ->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = user.user_position",array('org_position_name_th','org_position_level'))
     				   ->where($where);
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}

	public function getUserINCode($where){
		$select = $this->_db->select()
     				   ->from(array ("user" => "{$this->_name}"), array('user_code','user_name','user_lname'))
    				   ->where($where);
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getUserHeader(){
		$select = $this->_db->select()
     				   ->from(array ("user" => "{$this->_name}"), array('user_code','user_name','user_lname'))
     				   ->where("user_header = 'Y' and user_active = 'Y' ")
    				   ->order("user_code");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getGroupByHeader($where){
		$select = $this->_db->select()
     				   ->from(array ("group" => "org_sec"), array('org_sec_code','org_sec_name_th'))
     				   ->where($where)
     				   ->order("org_sec_code");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getGroupBUList(){
		$select = $this->_db->select()
     				   ->from(array ("group" => "org_sec"), array('org_sec_code','org_sec_name_th'))
     				   ->where("org_sec_status = 'Y'") #Add where by Natcharee.
     				   ->order("org_sec_code");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getPositionList(){
		$select = $this->_db->select()
     				   ->from(array ("group" => "org_position"), array('*'))
     				   ->order("org_position_name_th");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function GetPositionUser($where){
		$select = $this->_db->select()
     				   ->from(array ("user" => "{$this->_name}"), array('user_position'));
		
     	if($where)$select->where($where);
     	
		$select->group("user_position");
    	$select->order("user_position");
    	
    	
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}


}

