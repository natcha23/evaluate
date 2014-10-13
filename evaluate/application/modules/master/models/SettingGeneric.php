<?php
class Master_Setting_Generic extends System_Db_Generic  {
	public function getDataList($params,$start,$perpage){
		$rs = System_Controller::getModel('setting','systemapi');
		$m_Search = array("hs_step","hs_send","hs_recive");
		if($params[keyword])
    		$where = $this->GetFiledsWhere($m_Search,$params[keyword]);

        $rows = $rs->getDataList($where,$start,$perpage);

        return $rows;
	}
	public function getDataById($id){
		$rs = System_Controller::getModel('setting','systemapi');
		$where = "hs_id = '".$id."'";
        $rows = $rs->getDataById($where);
        return $rows[0];
	}
	public function checkCode($params){
		$rs = System_Controller::getModel('setting','systemapi');
		$where = "hs_send = '".$params["send"]."' and hs_recive = '".$params["recive"]."'";
        $rows = $rs->getDataById($where);
        return $rows[0];
	}
	public function deleteMaster($table,$field,$id_key){
		$db = Zend_Registry :: get("db");
  		$sql ="DELETE FROM $table WHERE $field IN ($id_key) ";
  		$db->query($sql);
	}
	public function getUserHeader() {
    	$rs = System_Controller::getModel('member','systemapi');
    	$result = $rs->getUserHeader();
		if($result){
			foreach($result as $item){
				$dataArr[$item["user_code"]] = $item["user_name"]." ".$item["user_lname"];
			}
		}
        return $dataArr;
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