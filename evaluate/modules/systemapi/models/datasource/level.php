<?php
class Systemapi_level_Table extends Zend_Db_Table {
    protected $_name = "master_level" ;

    public function getLevelMST(){
		$select = $this->_db->select()
     				   ->from(array ("glevel" => "master_level"), array('*'))
     				   ->group("lv_code")
     				   ->order("lv_code");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        if($rows){
        	foreach($rows as $item){
        		$dataArr[$item["lv_code"]]= $item;
        	}
        }
        return $dataArr;
 	}

    public function getLevelByGrade($where){
		$select = $this->_db->select()
     				   ->from(array ("mst_lev" => "{$this->_name}"), array('*'))
     				   ->joinLeft(array ("gr" =>"master_group_level"),"gr.l_shotname = mst_lev.lv_shotname",array('l_fullname'));
     	if($where)
     		$select->where($where);

		$select->order("lv_code");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        if($rows){
        	foreach($rows as $item){
        		$item["money"] = base64_decode($item["money"]);
        		$dataArr[]= $item;
        	}
        }
        return $dataArr;
	}
    public function getLevelById($grade){
		$select = $this->_db->select()
     				   ->from(array ("mst_lev" => "{$this->_name}"), array('*'))
     				   ->where("lv_id =?",$grade)
     				   ->order("lv_code");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        if($rows){
        	foreach($rows as $item){
        		$item["money"] = base64_decode($item["money"]);
        		$dataArr[]= $item;
        	}
        }
        return $dataArr;
	}
	public function getSendDate($where){
		$select = $this->_db->select()
     				   ->from("config_senddate", array('*'));
     	if($where)
     		$select->where($where);
		$select->order("config_level");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getGroupById($grade){
		$select = $this->_db->select()
     				   ->from(array ("gr" => "master_group_level"), array('*'))
     				   ->where("l_id =?",$grade)
     				   ->order("l_order");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getGLevel(){
		$select = $this->_db->select()
     				   ->from(array ("glevel" => "master_group_level"), array('*'))
     				   ->order("l_order");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getTypeMST($where){
		$select = $this->_db->select()
     				   ->from(array ("typ" => "master_type"), array('*'));
     	if($where)
     		$select->where($where);
		$select->order("type_name");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getTypeMSTById($where){
		$select = $this->_db->select()
     				   ->from(array ("typ" => "master_type"), array('*'))
     				   ->where($where)
     				   ->order("type_name");
#_print($select->__toString());
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getTypeById($grade){
		$select = $this->_db->select()
     				   ->from(array ("typ" => "master_type"), array('*'))
     				   ->where("type_id =?",$grade)
     				   ->order("type_id");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getLevelByPos($id){
		$select = $this->_db->select()
     				   ->from(array ("lev" => "master_level"), array('lv_code','lv_shotname'))
     				   ->where("lv_code =?",$id)
     				   ->order("lv_code");
     	$rs = $select->query();
        $rows = $rs->fetchAll();

        return $rows[0];
	}
	public function getLevelByPosition($id){
		$select = $this->_db->select()
     				   ->from("org_position", array('org_position_code','org_position_name_th','org_position_level'))
     				   ->joinLeft("master_level","lv_code = org_position_level",array('lv_shotname'))
     				   ->where("org_position_code =?",$id);
     	$rs = $select->query();
        $rows = $rs->fetchAll();

        return $rows[0];
	}
	public function getLevel(){
		$select = $this->_db->select()
     				   ->from(array ("level" => "org_position"), array('org_position_level'))
     				   ->joinLeft("master_level","lv_code = org_position_level",array('lv_shotname'))
     				   ->group("org_position_level")
     				   ->order("org_position_level");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getCountUser($where,$where_1){
		$select = $this->_db->select()
     				   ->from(array ("u" => "user"), array('COUNT(*) as count_user','user_sec_depart'))
     				   ->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = u.user_position",array('org_position_name_th','org_position_level'))
     				   ->where("org_position_level < '12' ")
     				   ->where("user_active = 'Y'");
     				if($where)$select->where($where);
     				if($where_1)$select->where($where_1);

     				   $select->group("user_sec_depart");
     				   $select->order("user_sec_depart");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        if($rows){
        	foreach($rows as $item){
        		$dataArr[$item["user_sec_depart"]] = $item["count_user"];
        	}
        }
       return $dataArr;
	}
	public function getCountUser2($where,$where_1){
		$select = $this->_db->select()
     				   ->from(array ("h" => "eva_mipi_head"), array('COUNT(*) as count_user'))
     				   ->joinINNER(array ("u" =>"user"),"h.mph_user = u.user_code",array('user_sec_depart'))
     				   //->joinLeft(array ("pos" =>"org_position"),"pos.org_position_code = u.user_position",array('org_position_name_th','org_position_level'))
     				   //->where("org_position_level < '12' ")
     				   ->where("user_active = 'Y'");
     				if($where)$select->where($where);
     				if($where_1)$select->where($where_1);

     				   $select->group("user_sec_depart");
     				   $select->order("user_sec_depart");
     	$rs = $select->query();
     	//_print($select->__toString());
        $rows = $rs->fetchAll();
        if($rows){
        	foreach($rows as $item){
        		$dataArr[$item["user_sec_depart"]] = $item["count_user"];
        	}
        }
       return $dataArr;
	}
	public function getIncentive2(){
		$select = $this->_db->select()
     				   ->from(array ("lev" => "master_level"), array('lv_id','grade','lv_code','money'))
     				   ->order("grade")
     				   ->order("lv_code");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        if($rows){
        	foreach($rows as $item){
        		$item["money"] = base64_decode($item["money"]);
        		if($item["grade"])$dataArr[$item["lv_code"]][$item["grade"]] = $item;
        	}
        }
        return $dataArr;
	}
	public function getIncentive(){
		$select = $this->_db->select()
     				   ->from(array ("lev" => "master_level"), array('grade','lv_code','money'))
     				   ->order("grade")
     				   ->order("lv_code");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        if($rows){
        	foreach($rows as $item){
        		$dataArr[$item["grade"]][$item["lv_code"]] = base64_decode($item["money"]);
        	}
        }
        return $dataArr;
	}
}

