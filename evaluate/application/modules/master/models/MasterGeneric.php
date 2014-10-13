<?php
class Master_Master_Generic extends System_Db_Generic  {
	protected function GetFiledsWhere($m_Search,$keywords){
    	if(!is_array($m_Search)) return;
    	foreach ($m_Search as $data){
    		$where .=($where)?"OR $data like '%".$keywords."%' ":"($data like '%".$keywords."%' ";
    	}
    	$where .=")";
    	return $where;
    }
	public function getGradeMST(){
		$rs = System_Controller::getModel('grade','systemapi');
        $rows = $rs->getGradeMST();
       return $rows;
	}
	public function getGradeMST2(){
		$rs = System_Controller::getModel('grade','systemapi');
        $rows = $rs->getGradeMST2();
       return $rows;
	}
	public function getLevelMST(){
		$rs = System_Controller::getModel('level','systemapi');
        $rows = $rs->getLevelMST();
       return $rows;
	}
	public function getIncentive(){
		$rs = System_Controller::getModel('level','systemapi');
        $rows = $rs->getIncentive2();
       return $rows;
	}
	public function getGroupMST(){
		$rs = System_Controller::getModel('level','systemapi');
        $rows = $rs->getGLevel();
       return $rows;
	}
	public function getTypeMST($params){
		$rs = System_Controller::getModel('level','systemapi');
		$m_Search = array("type_name","type_fullname");
		if($params[keyword])
    		$where = $this->GetFiledsWhere($m_Search,$params[keyword]);
        $rows = $rs->getTypeMST($where);
       return $rows;
	}
	public function getSendDate($params){
		$rs = System_Controller::getModel('level','systemapi');
        $m_Search = array("config_level","config_senddate","config_desc");

		if($params[keyword])
    		$where = $this->GetFiledsWhere($m_Search,$params[keyword]);
        $rows = $rs->getSendDate($where);
       return $rows;
	}
	public function checkData($params){
		$rs = System_Controller::getModel('level','systemapi');
		$where = "config_level = '".$params["id"]."'";
        $rows = $rs->getSendDate($where);
       return $rows;
	}
	public function getSendDateById($id){
		$rs = System_Controller::getModel('level','systemapi');
		$where = "config_id = '".$id."'";
        $rows = $rs->getSendDate($where);
       return $rows[0];
	}
	public function getTypeById($params){
		$rs = System_Controller::getModel('level','systemapi');
        $rows = $rs->getTypeById($params[id]);
       return $rows[0];
	}

	public function getTypeMSTById($params){
		$rs = System_Controller::getModel('level','systemapi');
        $where = " type_id = '$params[id]'";
        $rows = $rs->getTypeMSTById($where);
       return $rows[0];
	}

	public function getGradeById2($params){
		$rs = System_Controller::getModel('grade','systemapi');
        $rows = $rs->getGradeById($params[grade]);
       return $rows[0];
	}
	public function getGradeById($grade){
        $db = Zend_Registry :: get("db");
		$sql = "SELECT * FROM master_grade WHERE gr_id = '".$grade."' ";
		$rows = $db->FetchAll($sql);
       return $rows[0];
	}
	public function getGroupById($params){
		$rs = System_Controller::getModel('level','systemapi');
        $rows = $rs->getGroupById($params[id]);
       return $rows[0];
	}
	public function getLevelById($params){
		$rs = System_Controller::getModel('level','systemapi');
        $rows = $rs->getLevelById($params[id]);
       return $rows[0];
	}
	public function delGradeMaster($params){
    	$db = Zend_Registry :: get("db");
		$id = $params[id];

		$sql ="DELETE FROM master_grade WHERE gr_id = '$id' ";
		$db->query($sql);
	}
	public function getLevelByGrade($params){
		$rs = System_Controller::getModel('level','systemapi');
		$m_Search = array("lv_code","lv_shotname");

		if($params[keyword])
    		$where = $this->GetFiledsWhere($m_Search,$params[keyword]);
    	if($where) $where = "$where and grade = '".$params[grade]."'";
    	else
    		$where = "grade = '".$params[grade]."'";

        $rows = $rs->getLevelByGrade($where);
       return $rows;
	}
	public function getGroupOp(){
    	$rs = System_Controller::getModel('level','systemapi');
    	$result = $rs->getGLevel();
    	if($result){
    		foreach($result as $item){
    			$dataArr[$item[l_shotname]] = $item[l_shotname];
    		}
    	}
    	return $dataArr;
    }
    public function getLevelOp(){
    	$rs = System_Controller::getModel('level','systemapi');
    	$result = $rs->getLevel();
    	if($result){
    		foreach($result as $item){
    			$dataArr[$item[org_position_level]] = $item[org_position_level];
    		}
    	}

    	return $dataArr;
    }
    public function getLevelNameOp(){
    	$rs = System_Controller::getModel('level','systemapi');
    	$result = $rs->getLevel();
    	if($result){
    		foreach($result as $item){
    			$dataArr[$item[org_position_level]] = $item[org_position_level].":".$item[lv_shotname];
    		}
    	}

    	return $dataArr;
    }
	public function saveGradeMaster($params){
    	$db = Zend_Registry :: get("db");
		$id = $params[fields][grade];
		$field_insert = "grade,start_scoll,end_scoll,u_create,datetime";

		foreach($params[fields] as $key => $val){
			$update .=($update)?",".$key."='".$val."'":$key."='".$val."'";
			$insert_field .=($insert_field)?",".$key:$key;
			$insert_value .=($insert_value)?",'".$val."'":"'".$val."'";
		}

		if($params[mode] =='new'){
			$sql ="INSERT INTO master_grade ($insert_field) VALUES ($insert_value) ";
			$db->query($sql);
		}else{
			
			$sql ="UPDATE master_grade SET $update WHERE grade ='".$params[grade_old]."' AND gr_id = '".$params['grade'] ."'";
			$db->query($sql);

			$sql ="UPDATE master_level SET grade = '".$params[fields][grade]."' WHERE grade ='".$params[grade_old]."'";
			$db->query($sql);
		}

		return $id;
    }
    public function saveGroupMaster($params){
    	$db = Zend_Registry :: get("db");
		$id = $params[fields][l_id];

		foreach($params[fields] as $key => $val){
			$update .=($update)?",".$key."='".$val."'":$key."='".$val."'";
			$insert_field .=($insert_field)?",".$key:$key;
			$insert_value .=($insert_value)?",'".$val."'":"'".$val."'";
		}

		if($params[mode] =='new'){
			$sql ="INSERT INTO master_group_level ($insert_field) VALUES ($insert_value) ";
			$db->query($sql);
		}else{
			$sql ="UPDATE master_group_level SET $update WHERE l_id ='".$params[fields][l_id]."'";
			$db->query($sql);
		}

		return $id;
    }
    public function saveLevelMaster($params){
    	$db = Zend_Registry :: get("db");
		$id = $params[fields][lv_id];
		$field_insert = "grade,start_scoll,end_scoll,u_create,datetime";

		foreach($params[fields] as $key => $val){
			$update .=($update)?",".$key."='".$val."'":$key."='".$val."'";
			$insert_field .=($insert_field)?",".$key:$key;
			$insert_value .=($insert_value)?",'".$val."'":"'".$val."'";
		}

		if($params[mode] =='new'){
			$sql ="INSERT INTO master_level ($insert_field) VALUES ($insert_value) ";
			$db->query($sql);
		}else{
			$sql ="UPDATE master_level SET $update WHERE lv_id ='".$params[fields][lv_id]."'";
			$db->query($sql);
		}

		return $id;
    }
	public function deleteMaster($table,$field,$id_key){
		$db = Zend_Registry :: get("db");
  		$sql ="DELETE FROM $table WHERE $field IN ($id_key) ";
  		$db->query($sql);
	}
	public function saveMaster($table,$field,$id_key,$params){
		$con = Zend_Registry :: get("db");
		$db = $con->getConnection();
		$id = $id_key;
		foreach($params[fields] as $key => $val){

			$update .=($update)?",".$key."='".$val."'":$key."='".$val."'";
			$insert_field .=($insert_field)?",".$key:$key;
			$insert_value .=($insert_value)?",'".$val."'":"'".$val."'";
		}

		if(!$id_key){
			$sql ="INSERT INTO $table ($insert_field) VALUES ($insert_value) ";
			$db->query($sql);
			$id = $con->lastInsertId();
		}else{
			$sql ="UPDATE $table SET $update WHERE $field ='".$id_key."'";
			$db->query($sql);
		}

		return $id;
	}

}