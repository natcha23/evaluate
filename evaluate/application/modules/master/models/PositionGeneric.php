<?php
class Master_Position_Generic extends System_Db_Generic  {
	public function getPosition($params,$start,$perpage){
		$rs = System_Controller::getModel('position','systemapi');
		$m_Search = array("org_position_name_th","org_position_name_en","org_position_level");
		if($params[keyword])
    		$where = $this->GetFiledsWhere($m_Search,$params[keyword]);
		if($params[status]){
    		$where .= ($where)?" AND org_position_status = '".$params[status]."' ":" org_position_status = '".$params[status]."' ";
    	}
        $rows = $rs->getPosition($where,$start,$perpage);

        return $rows;
	}
	public function getPositionById($id){
		$rs = System_Controller::getModel('position','systemapi');
		$where = "org_position_id = '".$id."'";
        $rows = $rs->getPositionById($where);
        return $rows[0];
	}
	public function getMaxId(){
		$rs = System_Controller::getModel('position','systemapi');
        $rows = $rs->getMaxId();
        $maxID = $rows[0][max_id]+1;
        return $maxID;
	}
	public function checkCode($id){
		$rs = System_Controller::getModel('position','systemapi');
		$where = "org_position_code = '".$id."'";
        $rows = $rs->getPositionById($where);
        return $rows[0];
	}
	public function deleteMaster($table,$field,$id_key){
		$db = Zend_Registry :: get("db");
  		$sql ="DELETE FROM $table WHERE $field IN ($id_key) ";
  		$db->query($sql);
	}
	protected function GetFiledsWhere($m_Search,$keywords){
    	if(!is_array($m_Search)) return;
    	foreach ($m_Search as $data){
    		$where .=($where)?"OR $data like '%".$keywords."%' ":"($data like '%".$keywords."%' ";
    	}
    	$where .=")";
    	return $where;
    }
	public function saveMaster($table,$field,$id_key,$params_fields){
		$con = Zend_Registry :: get("db");
		$db = $con->getConnection();
		$id = $id_key;
		foreach($params_fields as $key => $val){

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