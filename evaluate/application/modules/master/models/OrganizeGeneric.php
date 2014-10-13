<?php
class Master_Organize_Generic extends System_Db_Generic  {
	public function getOrganize($params,$start,$perpage){
		$rs = System_Controller::getModel('organize','systemapi');
		$m_Search = array("org_sec_code","org_sec_name_th","org_sec_name_en");
		if($params[keyword])
    		$where = $this->GetFiledsWhere($m_Search,$params[keyword]);
    	if($params[status]){
    		$where .= ($where)?" AND org_sec_status = '".$params[status]."' ":" org_sec_status = '".$params[status]."' ";
    	}
        $rows = $rs->getOrganize($where,$start,$perpage);
        return $rows;
	}
	public function getAccountOp(){
		$rs = System_Controller::getModel('account','systemapi');
        $rows = $rs->getAccountOp();
        if($rows){
        	foreach($rows as $item){
        		$data[$item[user_code]] = $item[user_name]." ".$item[user_lname];
        	}
        }
       return $data;
	}
	public function getOrganizeById($id){
		$rs = System_Controller::getModel('organize','systemapi');
		$where = "org_sec_id = '".$id."'";
        $rows = $rs->getOrganizeById($where);
        return $rows[0];
	}
	public function checkCode($id){
		$rs = System_Controller::getModel('organize','systemapi');
		$where = "org_sec_code = '".$id."'";
        $rows = $rs->getOrganizeById($where);
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