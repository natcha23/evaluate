<?php
class Master_Account_Generic extends System_Db_Generic  {
	public function getAccount($params,$start,$perpage){
		$rs = System_Controller::getModel('account','systemapi');
		$m_Search = array("user_code","user_name","user_lname","u_login","user_email");
		if($params[keyword])
    		$where = $this->GetFiledsWhere($m_Search,$params[keyword]);

        $rows = $rs->getAccount($where,$start,$perpage,$params["status"]);
        return $rows;
	}
	public function getSalary($params,$start,$perpage,&$dataArr){
		$rs = System_Controller::getModel('account','systemapi');
		$where = "user_code = '".$params["user_code"]."'";
        $row = $rs->getSalary($where,$start,$perpage);
        if($row){
        	foreach($row["data"] as $item){
        		$salary = explode(":",base64_decode($item["salary"]));
        		$dataArr[$item["sal_id"]][$item["user_code"]] = $salary[1];
        		$rows[$item["sal_id"]] = $item;
        	}
        }
		$arrayReturn["data"] = $rows;
		$arrayReturn["total"] = $row["total"];

        return $arrayReturn;
	}
	public function getAccountByCode($params){
		$rs = System_Controller::getModel('account','systemapi');
        $where = "user_code = '$params[user_code]'";
        $rows = $rs->getAccountById($where);
       return $rows[0];
	}
	public function getSalaryById($params){
		$rs = System_Controller::getModel('account','systemapi');
        $where = "sal_id = '$params[id]'";
        $rows = $rs->getSalaryById($where);
        if($rows){
        	$salary = explode(":",base64_decode($rows[0]["salary"]));
        	$rows[0]["explode"] = $salary[1];
        }
       return $rows[0];
	}
	public function getAccountById($user_id){
		$rs = System_Controller::getModel('account','systemapi');
        $where = "user_id = '$user_id'";
        $rows = $rs->getAccountById($where);
       return $rows[0];
	}
	public function GetLevel($pos_id){
		$rs = System_Controller::getModel('account','systemapi');
        $where = "org_position_code = '$pos_id'";
        $rows = $rs->GetLevel($where);
       return $rows[0];
	}

	public function getPositionOp(){
		$rs = System_Controller::getModel('account','systemapi');
		$where = "org_position_status = 'Y'";
        $rows = $rs->getPositionActiveOp($where);
        return $rows;
	}
	public function GetGroupMenuOp(){
		$rs = System_Controller::getModel('account','systemapi');
        $rows = $rs->GetGroupMenuOp();
        if($rows){
        	foreach($rows as $item){
        		$dataArr[$item[lookup_code]] = $item[lookup_code]." :: ".$item[lookup_name];
        	}
        }
        return $dataArr;
	}
	public function getDepartmentOp(){
		$rs = System_Controller::getModel('account','systemapi');
		$where = "org_sec_status = 'Y'";
        $rows = $rs->getDepartmentActiveOp($where);
        if($rows){
        	foreach($rows as $item){
        		$dataArr[$item[org_sec_code]] = $item[org_sec_code]." :: ".$item[org_sec_name_th];
        	}
        }
        return $dataArr;
	}
	public function deleteMaster($table,$field,$id_key){
		$db = Zend_Registry :: get("db");
  		$sql ="DELETE FROM $table WHERE $field IN ($id_key) ";
  		$db->query($sql);
	}
	public function inactiveUser($table,$field,$id_key){
		$db = Zend_Registry :: get("db");
		$update = "user_active = 'N',updatetime = '".date('Y-m-d H:i:s')."'";
   		$sql ="UPDATE $table SET $update WHERE $field IN ($id_key) ";
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