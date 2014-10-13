<?php
class Master_Form_Generic extends System_Db_Generic  {
	public function getFormEvaluate($params,$start,$perpage){
		$rs = System_Controller::getModel('form','systemapi');
		$m_Search = array("form_code","form_name","form_stdate","form_enddate");
		if($params[keyword])
    		$where = $this->GetFiledsWhere($m_Search,$params[keyword]);

        $rows = $rs->getFormEvaluate($where,$start,$perpage);
        if($rows[data]){
        	foreach($rows[data] as $item){

        		if(date('Y-m-d')>$item["form_enddate"])
        			$item["create"] = 'N';
        		$dataArr["data"][] = $item;
        	}
        }

        $dataArr["total"] = $rows["total"];

        return $dataArr;
	}
	public function getFormEvaluateById($id){
		$rs = System_Controller::getModel('form','systemapi');
		$where = "form_id = '".$id."'";
        $rows = $rs->getFormEvaluateById($where);
        return $rows[0];
	}
	public function getTypeEvaOption(){
	   $rs = System_Controller::getModel('level','systemapi');
	   $rows = $rs->getTypeMST('');
	   if($rows){
	   		foreach($rows as $item){
	   			$dataArr[$item["type_name"]] = $item["type_name"];
	   		}
	   }
       return $dataArr;
	}
	public function getCopyFormEvaluate($params){
	   $rs = System_Controller::getModel('form','systemapi');
	   $rows = $rs->getCopyFormEvaluate($params);
       return $rows;
	}
	public function getDraftFormEvaluate($params){
	   $rs = System_Controller::getModel('form','systemapi');
	   $rows = $rs->getDraftFormEvaluate($params);
       return $rows;
	}
	public function deleteMaster($table,$field,$id_key){
		$db = Zend_Registry :: get("db");
  		$sql ="DELETE FROM $table WHERE $field IN ($id_key) ";
  		$db->query($sql);
	}
	public function GetUser($id_key){
		$db = Zend_Registry :: get("db");  		
  		$sql = "SELECT user_id,user_code,`user_name`, `user_lname`,user_email FROM user WHERE user_code IN ($id_key) " ; 		
  		$rs = $db->query($sql);
     	$result = $rs->fetchAll();
     	return $result;
	}
	public function GetDraftOwner($id_key){
		$db = Zend_Registry :: get("db");  		
  		$sql = "SELECT `drf_id`, `user_rec`,t0.user_code FROM draft_evaluateform t0 
		  		WHERE drf_id IN ($id_key) " ;
  		
  		$rs = $db->query($sql);
     	$result = $rs->fetchAll();
     	if($result){
     		foreach($result as $item){
     			if($item['user_code']){
     				$owner = $this->GetUser($item['user_code']);
     				$item['owner'] = $owner;
     			}
     			$rows[$item['user_rec']] = $item;
     		}
     	}     	
     	return $rows;
	}
	public function GetDraft($id_key){
		$db = Zend_Registry :: get("db");  		
  		$sql = "SELECT `drf_id`, `month`, `year`, `user_rec`,CONCAT(`user_name`,' ', `user_lname`) as fullname FROM draft_evaluateform t0 
  		LEFT JOIN user t1 ON t0.user_rec = t1.user_code
  		WHERE drf_id IN ($id_key) " ;
  		
  		$rs = $db->query($sql);
     	$result = $rs->fetchAll();
     	if($result){
     		foreach($result as $item){
     			$user_id .= ($user_id)?",".$item['user_rec']:$item['user_rec'];
     			$user_name .= ($user_name)?", ".$item['fullname']:$item['fullname'];
     		}
     	}
     	$rows['month'] = $result[0]['month']."/".$result[0]['year'];
     	$rows['uid'] = $user_id;
     	$rows['uname'] = $user_name;
     
     	return $rows;
	}
	public function UpdateDraft($fields){
		$db = Zend_Registry :: get("db");
		$date = date('Y-m-d H:i:s');
		$mm = explode("/",$fields['month']);
		
		$sql ="UPDATE draft_evaluateform SET createdate = '".$date."',month = '".$mm[0]."',year = '".$mm[1]."' 
		WHERE drf_id IN (".$fields['sid'].") ";
		$db->query($sql);
	}
	
	public function SendAuto($fields,$ucode){
		$db = Zend_Registry :: get("db");  
		$sql = "SELECT * FROM draft_evaluateform WHERE drf_id IN (".$fields['sid'].") " ;  		
  		$rs = $db->query($sql);
  		
     	$result = $rs->fetchAll();
     	
     	$mph_month = str_replace("/", "", $fields['month']);
     	if($result){
     		foreach($result as $item){     			
     			$head['mph_user_create'] = $ucode;
		        $head['mph_month'] = $mph_month;
		        $head['mph_type'] = 'PI';
		        $head['mph_status'] = 'C';
		        $head['user_send'] = $ucode;
		        $head['mph_user_flow'] = $item['user_rec'];
		        $head['user_first_recive'] = $item['user_rec'];
		        $head['form_code'] = $item['form_code'];
		        $head['mph_objective'] = $item['mph_objective'];
		        $head['mph_sflow'] = $item['mph_sflow'];
		        $head['mph_eflow'] = $item['mph_eflow'];
		        $head['mph_createdate'] = date('Y-m-d H:i:s');
		        $head['mph_datetime'] = date('Y-m-d H:i:s');

		        $uarray['user_code'] = $item['user_code'];
		        $detail = array (unserialize($item["data"]));
		       
		        $this->GeneratePI($head,$uarray,$detail[0]);
		          			
     		}
     	}
	}
	public function ChkInsertDupPI($where){
		$db = Zend_Registry :: get("db");  
		$sql = "SELECT mph_id FROM eva_mipi_head WHERE $where " ;  				
  		$rs = $db->query($sql);
     	$result = $rs->fetchAll();
     	return $result;
	}
	public function GeneratePI($head,$uarray,$detail){
			
		$con = Zend_Registry :: get("db");
		$db = $con->getConnection();
		
		$field_head = "mph_user,form_code,mph_user_create,mph_month,mph_status,mph_user_flow,mph_type,mph_objective,mph_sflow,mph_eflow,mph_createdate,mph_datetime,user_first_recive,user_send";
		$field_line = "mph_id,mpl_subject,mpl_weight,mpl_type,mpl_status,mpl_parent,mpl_datetime";
		$user_code = explode(",",$uarray['user_code']);

		foreach($user_code as $key1 => $item){			
			$head['mph_user'] = $item;
			$where = "mph_user = '".$head['mph_user']."' AND mph_month = '".$head['mph_month']."'";						
			$chkDup = $this->ChkInsertDupPI($where);
			
			if(!$chkDup){
				$insert_value = "'$item','".$head[form_code]."','".$head[mph_user_create]."','".$head[mph_month]."'," .
						        "'".$head[mph_status]."','".$head[mph_user_flow]."','".$head[mph_type]."'," .
						        "'".$head[mph_objective]."','".$head[mph_sflow]."','".$head[mph_eflow]."'," .
						        "'".$head[mph_createdate]."','".$head[mph_datetime]."','".$head[user_first_recive]."','".$head[user_send]."'";

				$sql ="INSERT INTO eva_mipi_head ($field_head) VALUES ($insert_value)";
				$db->query($sql);
				$id = $con->lastInsertId();
				
				if($detail){
					foreach($detail as $key=>$subj){
						if($subj["subject"]){
							$dateNow = date('Y-m-d H:i:s');
							if($subj["mpl_weight"])$FixData = 'F';else $FixData = 'N';
							$value_sub = "'$id','".$subj["subject"]."','".$subj["mpl_weight"]."','S','$FixData','0','$dateNow'";

							$sql ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_sub) ";
							$db->query($sql);
							$id_parent = $con->lastInsertId();

							if($subj["detail"]){
								foreach($subj["detail"] as $item){
									if($item[subject]){
										$dateNow = date('Y-m-d H:i:s');
										if($item["mpl_weight"])$FixData = 'F';else $FixData = 'N';
										$value_line = "'$id','$item[subject]','$item[mpl_weight]','D','$FixData','$id_parent','$dateNow'";

										$sql1 ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_line) ";
										$db->query($sql1);
									}
								}
							}
						}
					}
				}
			}
			
		}
		
		
		return 'ok';
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