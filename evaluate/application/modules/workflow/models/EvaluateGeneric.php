<?php
class Workflow_Evaluate_Generic extends System_Db_Generic  {
	protected function GetFiledsWhere($m_Search,$keywords){
    	if(!is_array($m_Search)) return;
    	foreach ($m_Search as $data){
    		$where .=($where)?"OR $data like '%".$keywords."%' ":"($data like '%".$keywords."%' ";
    	}
    	$where .=")";
    	return $where;
    }
    public function deleteMaster($table,$field,$id_key){
		$db = Zend_Registry :: get("db");
  		$sql ="DELETE FROM $table WHERE $field IN ($id_key) ";
  		$db->query($sql);
	}
	public function updateMaster($table,$field,$id_key,$update){
		$db = Zend_Registry :: get("db");
  		$sql ="UPDATE $table SET $update WHERE $field IN ($id_key) ";
  		$db->query($sql);
  		if($table=='master_evaluate'){
			$sql1 ="UPDATE $table SET $update WHERE	mst_eva_parent IN ($id_key) ";
			$db->query($sql1);
		}
	}
	public function UpdateIn($id_key,$params_filed){
		$db = Zend_Registry :: get("db");
		foreach($params_filed as $key => $val){
			$update = "mph_incentive = '".$val[mph_incentive]."',mph_level_now = '".$val[mph_level_now]."'";
			$sql ="UPDATE eva_mipi_head SET $update WHERE mph_month = '$id_key' AND mph_user = '$key' ";
			$db->query($sql);
		}
	}

	public function getEvaluateMST($params,$start,$perpage){
		$rs = System_Controller::getModel('master','systemapi');
		$m_Search = array("mst_eva_name","mst_eva_dsc","mst_eva_type");
		if($params[keyword])
    		$where = $this->GetFiledsWhere($m_Search,$params[keyword]);
    	if($where) $where1 = "$where and mst_eva_parent = '0' and mst_eva_status = 'Y'"; else $where1 = "mst_eva_parent = '0' and mst_eva_status = 'Y'";
    	if($where) $where2 = "$where and mst_eva_parent != '0' and mst_eva_status = 'Y'"; else $where2 = "mst_eva_parent != '0' and mst_eva_status = 'Y'";
        $head = $rs->getEvaluateMST($where1);
        $line = $rs->getEvaluateMST($where2);

        if($head){
        	foreach($head as $itemH){
        		$dataArr[$itemH["mst_eva_id"]] = $itemH;
        		foreach($line as $item){
        			$dataArr[$item["mst_eva_parent"]][dataLine][$item["mst_eva_id"]] = $item;
        		}
        	}
        }

       return $dataArr;
	}

    public function getEvaluateMSTById($params) {
    	$rs = System_Controller::getModel('master','systemapi');
    	$where = " mst_eva_id = '$params[id]'";
    	$result = $rs->getEvaluateMST($where);
        return $result[0];
    }

	public function InsertMaster($table,$field,$id_key,$params_fields){
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

    public function getEvaluateByType($type) {
    	$rs = System_Controller::getModel('master','systemapi');
    	$result = $rs->getEvaluateByType($type);
    	#_print($result);
        return $result;
    }
    public function getEvaluateByHPI($type,&$dataLine) {
    	$rs = System_Controller::getModel('master','systemapi');
    	$where_h = "mst_eva_type = '$type' and mst_eva_parent = '0' and mst_eva_status = 'Y' ";
    	$where_l = "mst_eva_type = '$type' and mst_eva_parent != '0' and mst_eva_status = 'Y' ";
    	$head = $rs->getEvaluateByHPI($where_h);
    	$line = $rs->getEvaluateByHPI($where_l);
    	if($head){
    		foreach($head as $key=> $item){
    			$dataHead["Left"][$item["mst_eva_id"]] = $item;
    			/*if($item["mst_eva_id"]%2 =='1'){
    				$dataHead["Left"][$item["mst_eva_id"]] = $item;
    			}else{
    				$dataHead["Right"][$item["mst_eva_id"]] = $item;
    			}*/
    		}
    	}
    	if($line){
    		foreach($line as $key=> $item){
    			$dataLine[$item["mst_eva_parent"]][$item["mst_eva_id"]] = $item;
    		}
    	}
        return $dataHead;
    }
    public function getUserOption(){
    	$rs = System_Controller::getModel('member','systemapi');
    	$result = $rs->getUserOption();
        return $result;
    }
    public function getUserList($params) {
    	$rs = System_Controller::getModel('member','systemapi');
    	$result = $rs->getUserList();
        return $result;
    }
    public function getUserPage($params,$start,$perpage) {
    	$rs = System_Controller::getModel('member','systemapi');
    	$result = $rs->getUserPage($start,$perpage);
        return $result;
    }
	public function getUserAccept($params,$user_Array) {
    	$rs = System_Controller::getModel('member','systemapi');
    	if($params[group])
    		$where = "user_sec_depart = '".$params[group]."' ";
    	if($user_Array)
    		$where1 = "user_code IN ($user_Array) ";

    	$result = $rs->getUserAccept($where,$where1);

    	if($result){
    		foreach($result as $item){
    			$dataArr[$item["user_sec_depart"]]["department"] = $item["user_sec_depart"]." :: ".$item["org_sec_name_th"];
    			$dataArr[$item["user_sec_depart"]]["user"][$item["user_code"]] = $item;
    		}
    	}
        return $dataArr;
    }
    public function GetOrgByCode($user_code){
    	$rs = System_Controller::getModel('organize','systemapi');
    	$where = "user_header IN ($user_code)";
    	$result = $rs->GetOrgByCode($where);
    	if($result){
    		foreach($result as $item){
    			$dataArr .= ($dataArr)?",".$item["org_sec_code"]:$item["org_sec_code"];
    		}
    	}
    	return $dataArr;
    }
    public function getUserListWhere($params) {
    	$rs = System_Controller::getModel('member','systemapi');
    	if($params[group] && $params["group"] != 'all'){
	    	if($params[group])
	    		$where = "user_sec_depart = '".$params[group]."'";
    	}else{
    		if($params[depart] && $params["group"] != 'all')
	    		$where = "user_sec_depart = '".$params[depart]."'";
    	}
    	if($params[head])
    		$where .= ($where)?" and user_header = 'Y'":" user_header = 'Y'";
    	
    	$m_Search = array("user_name","user_lname");
	   	if($params['keyword'])
    		$where .= ($where)?" AND ".$this->GetFiledsWhere($m_Search,$params['keyword']): $this->GetFiledsWhere($m_Search,$params['keyword']);
    	$result = $rs->getUserListWhere($where);
        return $result;
    }
    public function getUserPortal($params) {
    	$rs = System_Controller::getModel('member','systemapi');

    	if($params[group])
    		$where = "user_sec_depart = '".$params[group]."' ";
    	if($params[head_org])
    		$where .= ($where)?" and user_sec_depart IN (".$params[head_org].") ":"user_sec_depart IN (".$params[head_org].") ";
    	if($params["not_user"])
    		$where .= ($where)?" and user_code != '".$params["not_user"]."'":"user_code != '".$params["not_user"]."'";
		if($params["user_view"])
			$where .= ($where)?" and user_code = '".$params["user_view"]."'":"user_code = '".$params["user_view"]."'";
    	$result = $rs->getUserPortal($where,'');
    	if($result){
    		foreach($result as $item){
    			$dataArr[$item["user_sec_depart"]]["department"] = $item["user_sec_depart"]." :: ".$item["org_sec_name_th"];
    			$dataArr[$item["user_sec_depart"]]["user"][$item["user_code"]] = $item;
    		}
    	}
        return $dataArr;
    }
    public function getUserListByG($params) {
    	$rs = System_Controller::getModel('member','systemapi');
    	$result = $rs->getUserListByG($params[group]);
        return $result;
    }
    public function getUserPageByG($params,$start,$perpage) {
    	$rs = System_Controller::getModel('member','systemapi');
    	if($params[group])
    		$where = "user_sec_depart = '".$params[group]."'";
    	$result = $rs->getUserPageByG($where,$start,$perpage);
        return $result;
    }
    public function getUserINCode($code) {
    	$rs = System_Controller::getModel('member','systemapi');
    	$where = "user_code in ($code)";
    	$result = $rs->getUserINCode($where);
        return $result;
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
	public function getGroupBUList() {
    	$rs = System_Controller::getModel('member','systemapi');
    	$result = $rs->getGroupBUList();
    	if($result){
    		foreach($result as $key=>$item){
    			$dataArr[$item["org_sec_code"]] = $item["org_sec_code"]." : ".$item["org_sec_name_th"];
    		}
    	}
       return $dataArr;
    }
    public function getUserByHeader($header){
    	$rs = System_Controller::getModel('member','systemapi');
    	$result = $rs->getUserByHeader($header);

        return $result;
    }
    public function getEvaluateViewByUser($params){
    	$rs = System_Controller::getModel('evaluate','systemapi');
	   	$where = "mph_user_flow = '".$params[user]."' and mph_user != '".$params[user]."' and mph_type = '".$params[type]."' " .
    			 "and mph_status = '".$params[status]."' ";

    	$result = $rs->getEvaluateViewUser($where);

    	/*if($result){
    		foreach($result as $key=>$item){
    			$dataArr = $item ;
    		}
    	}*/
    	return $result;
    }
    public function getStepEvadataByUser($params,&$userArr){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$rs_lev = System_Controller::getModel('level','systemapi');
    	$rs_user = System_Controller::getModel('member','systemapi');

    	$where = "mph_user_flow = '".$params[user]."' and mph_type = '".$params[type]."' " .
    			 "and mph_status = '".$params[status]."' ";
    	$result = $rs->getEvaluateHead($where);

    	if($result){
    		foreach($result as $key=>$item){
    			//$userArr .= ($userArr)?",$item[mph_user]":$item[mph_user];
    			$userArr .=($userArr)?",'".$item[mph_user]."'":"'".$item[mph_user]."'";

    			$pos = $rs_user->getPositionByUser($item[mph_user_flow]);
    			$row = $rs_lev->getLevelByPos($pos[level]);

    			$dataArr[$item[mph_user]][mph_month] = $item[mph_month] ;
    			$dataArr[$item[mph_user]][mph_user_flow] = $item[mph_user_flow] ;
    			$dataArr[$item[mph_user]][mph_status] = $item[mph_status] ;
    			$dataArr[$item[mph_user]][mph_sflow] = $item[mph_sflow];
    			$dataArr[$item[mph_user]][mph_eflow] = $item[mph_eflow];
        		$dataArr[$item[mph_user]][level] = $row[lv_code];
        		$dataArr[$item[mph_user]][level_name] = $row[lv_shotname];
    		}
    		$userArr = $this->getUserINCode($userArr);
    	}
    	//_print($userArr);
        return $dataArr;
    }
     public function getTotalWorklist($where){
     	$db = Zend_Registry :: get("db");
     	$sql = "SELECT mph_user_flow,mph_status,mph_type,count(mph_id) as total FROM eva_mipi_head " .
     		   "WHERE $where GROUP BY mph_status ";
     	$rs = $db->query($sql);
     	$result = $rs->fetchAll();

     	if($result){
	     	foreach($result as $item){
	     		$dataArr[$item[mph_type]][data] = $item;
	     		$dataArr[$item[mph_type]][$item[mph_status]] = $item[total];
	     	}
     	}

     	return $result;
     }

    public function getEvaluateTotalByUser($uid){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$where_mi = "mph_user_flow = '$uid' and mph_user != '$uid' and mph_type = 'MI' and mph_status IN ('C','P') ";
    	$where_pi = "mph_user_flow = '$uid' and mph_user != '$uid' and mph_type = 'PI' and mph_status IN ('C','P') ";
    	$where_own = "mph_user_flow = '$uid' and mph_user = '$uid' and mph_status IN ('C','P') ";
    	$result_mi = $rs->getEvalHeadWorklistTotal($where_mi);
    	$result_pi = $rs->getEvalHeadWorklistTotal($where_pi);
    	$result_own = $rs->getEvalHeadTotal($where_own);

    	$dataArr["worklist"]['MI'] = $result_mi;
    	$dataArr["worklist"]['PI'] = $result_pi;
      	$dataArr["activity"] = $result_own;

    	return $dataArr;
    }
    public function getEvaluateActByUser($uid){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$where_own = "mph_user_flow = '$uid' and mph_user = '$uid' and mph_status IN ('C','P') ";
    	//$result_own = $rs->getEvalHeadTotal($where_own);
    	$result_own = $rs->getEvaluateViewUser($where_own);
    	return $result_own;
    }
    public function getOwnerAppByUser($uid){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$rs1 = System_Controller::getModel('member','systemapi');
    	$where = "mph_user_flow = '$uid' ";
    	$result = $rs->getEvaluateHead($where);
    	if($result){
    		foreach($result as $val){
    			$val .= ($val)?",":$val;
    		}
    	}
    	//$result = $rs1->getOwnerAppByUser($header);
        return $result;
    }
    public function createMIMaster($params){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$con = Zend_Registry :: get("db");
		$db = $con->getConnection();

		$field_head = "mph_user,form_code,mph_user_create,mph_month,mph_status,mph_user_flow,mph_type,mph_objective,mph_sflow,mph_eflow,mph_createdate,mph_datetime,user_first_recive,user_send";
		$field_line = "mph_id,mpl_subject,mpl_type,mpl_status,mpl_datetime";
		$user_code = explode(",",$params[fields][user_code]);

		foreach($user_code as $key1 => $item){
			$params[head][mph_user] = $item;
			$where = "mph_user = '".$params[head][mph_user]."' and mph_month = '".$params[head][mph_month]."'";
			$chkDup = $rs->ChkInsertDup($where);
			if(!$chkDup){
				$insert_value = "'$item','".$params[head][form_code]."','".$params[head][mph_user_create]."','".$params[head][mph_month]."'," .
						        "'".$params[head][mph_status]."','".$params[head][mph_user_flow]."','".$params[head][mph_type]."'," .
						        "'".$params[head][mph_objective]."','".$params[head][mph_sflow]."','".$params[head][mph_eflow]."'," .
						        "'".$params[head][mph_createdate]."','".$params[head][mph_datetime]."','".$params[head][user_first_recive]."','".$params[head][user_send]."'";

				$sql ="INSERT INTO eva_mipi_head ($field_head) VALUES ($insert_value)";

				$db->query($sql);
				$id = $con->lastInsertId();

				foreach($params[fields][subject] as $subj){
					$dateNow = date('Y-m-d H:i:s');
					$value_line = "'$id','$subj','M','F','$dateNow'";

					$sql1 ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_line) ";
					$db->query($sql1);
				}
			}
		}

		return $id;
    }
    public function updateMIMaster($params,$insert_subl){
    	$con = Zend_Registry :: get("db");
		$db = $con->getConnection();

    	$field_head = "mph_status,form_code,mph_user_flow,mph_datetime";
    	$field_line = "mph_id,mpl_subject,mpl_weight,mpl_point_full,mpl_point,mpl_type,mpl_datetime,mpl_status";
    	$field_subline = "mph_id,mpl_id,sl_usend,sl_urecive,sl_point,sl_column,sl_datetime";
    	$id = $params[head][mph_id];

    	foreach($params[head] as $key => $val){
			$update .=($update)?",".$key."='".$val."'":$key."='".$val."'";
		}
		$sql ="UPDATE eva_mipi_head SET $update WHERE mph_id ='".$params[head][mph_id]."'";
		$db->query($sql);

		$where = "mph_id = '".$params[head][mph_id]."' ";
		$rowColumn = $this->GetColumnSubline($where);
		if($rowColumn["sl_column"]) $sl_column = $rowColumn["sl_column"]+1; else $sl_column = 1;

		$pointScoll = 0;
		$where_id = '';
    	foreach($params["detail"] as $line){
    		$line["mpl_datetime"] = date('Y-m-d H:i:s');
    		//if($line[mpl_id])$where_id .=($where_id)?",".$line[mpl_id]:$line[mpl_id];
    		if($line["mpl_weight"]){
	    		$pointScoll = $pointScoll + ($line["mpl_weight"] * $line["mpl_point"]);
	    		foreach($line as $key1 => $value){
					$update_l .=($update_l)?",".$key1."='".$value."'":$key1."='".$value."'";
				}
				//_print($line);
				if($line[mpl_id]){
					$sql_u ="UPDATE eva_mipi_line SET $update_l WHERE mpl_id ='".$line[mpl_id]."'";
					$db->query($sql_u);
					$id_line = $line[mpl_id];
				}else{
					$dateNow = date('Y-m-d H:i:s');
					$value_line = "'$id','$line[mpl_subject]','$line[mpl_weight]','$line[mpl_point_full]','$line[mpl_point]','M','$dateNow','N'";

					$sql1 ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_line) ";
					$db->query($sql1);
					$id_line = $con->lastInsertId();
				}
				$where_id .=($where_id)?",".$id_line:$id_line;
				if($insert_subl =='ok'){
					$dateNow = date('Y-m-d H:i:s');
					$value_subline = "'$id','$id_line','$params[user_send]','$params[user_recive]','$line[mpl_point]','$sl_column','$dateNow'";

					$sql2 ="INSERT INTO eva_mipi_subline ($field_subline) VALUES ($value_subline) ";
					$db->query($sql2);
			    }
    		}
    	}
    	if($where_id){
		    $where_del = "mph_id ='".$params[head][mph_id]."' and mpl_id not in ($where_id)";
		    $sql ="DELETE FROM eva_mipi_line WHERE $where_del ";
			$db->query($sql);
		}
    	/*if($pointScoll){
    		$grade = $this->getGradeByScoll($pointScoll);
    		$sql_g = "UPDATE eva_mipi_head SET mph_totalscoll = '$pointScoll',mph_grade = '$grade' " .
    			   	 "WHERE mph_id ='".$params[head][mph_id]."'";
 			$db->query($sql_g);
    	}*/


    	if($pointScoll){
    		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        	$auth = Zend_Auth :: getInstance();
        	$identity = $auth->getIdentity();
    		$inctArr = $rs->getIncentive();
    		$grade = $this->getGradeByScoll($pointScoll);
    		$incentive = $inctArr[$grade][$params['level_user']];

    		$sql_g = "UPDATE eva_mipi_head SET mph_totalscoll = '$pointScoll',mph_grade = '$grade'" .
    				 ",mph_incentive = '".$incentive."',mph_level_now = '".$params['level_user']."' " .
    			     "WHERE mph_id ='".$params[head][mph_id]."'";
			$db->query($sql_g);
    	}

    	return $id;
    }
    public function GetColumnSubline($where){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$result = $rs->GetColumnSubline($where);
    	return $result[0];
    }
	public function GetColumnSublineINID($where){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$result = $rs->GetColumnSublineINID($where);
    	return $result;
    }
    public function EditUserReceive($params,$type){
    	$con = Zend_Registry :: get("db");
		$db = $con->getConnection();
		$rs = System_Controller::getModel('evaluate','systemapi');
		$id = $params[head][mph_id];
		$field_line = "mph_id,mpl_subject,mpl_weight,mpl_point_full,mpl_point,mpl_type,mpl_parent,mpl_datetime,mpl_status";
		if($params['head']['mph_desc'])$params['head']['mph_desc'] = str_replace("\'","||",$params['head']['mph_desc']);		
		foreach($params[head] as $key => $val){
			$update .=($update)?",".$key."='".$val."'":$key."='".$val."'";
		}
		
		$sql ="UPDATE eva_mipi_head SET $update WHERE mph_id ='".$id."'";
		$db->query($sql);
		$where1 = "mph_id ='".$id."' and sl_usend = '".$params[head][user_send]."' and sl_urecive = '".$params[receive_old]."' ";
		$rows = $rs->GetSubLine($where1);
		if($type == 'PI'){
			$pointScoll = 0;
			foreach($params[detail] as $keyH=>$head){
				$where_id = '';
				if($head[line]){
					foreach($head[line] as $key2=> $line){
						if($line[mpl_weight])$pointScoll = $pointScoll + ($line[mpl_weight] * $line[mpl_point]);
						//if($line[mpl_id])$where_id .=($where_id)?",".$line[mpl_id]:$line[mpl_id];
						foreach($line as $key1 => $value){
							$update_l .=($update_l)?",".$key1."='".$value."'":$key1."='".$value."'";
						}
						if($line[mpl_id]){
							$sql_u ="UPDATE eva_mipi_line SET $update_l WHERE mpl_id ='".$line[mpl_id]."'";
							$db->query($sql_u);
							$id_line = $line[mpl_id];
						}else{
							$dateNow = date('Y-m-d H:i:s');
							$value_line = "'$id','".$line[mpl_subject]."','".$line[mpl_weight]."','".$line[mpl_point_full]."','".$line[mpl_point]."','D','".$head[mpl_id]."','$dateNow','N'";
							$sql1 ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_line) ";
							$db->query($sql1);
							$id_line = $con->lastInsertId();
						}
						$where_id .=($where_id)?",".$id_line:$id_line;
						if($rows){
							$where = "mph_id ='".$id."' and mpl_id = '".$line[mpl_id]."' and sl_usend = '".$params[head][user_send]."' and sl_urecive = '".$params[receive_old]."' ";
							$sql ="UPDATE eva_mipi_subline SET sl_urecive = '".$params[head][mph_user_flow]."',sl_point = '".$line["mpl_point"]."' WHERE $where " ;
							$db->query($sql);
						}
					}
				}
				if($where_id){
		    		$where_del = "mpl_parent = '".$head[mpl_id]."' and mph_id ='".$params[head][mph_id]."' and mpl_id not in ($where_id)";
		    		$sql ="DELETE FROM eva_mipi_line WHERE $where_del ";
					$db->query($sql);
		    	}
			}
			
		}else{
			$pointScoll = 0;
			$where_id = '';
			foreach($params[detail] as $line){
				if($line[mpl_weight])$pointScoll = $pointScoll + ($line[mpl_weight] * $line[mpl_point]);
				//if($line[mpl_id])$where_id .=($where_id)?",".$line[mpl_id]:$line[mpl_id];
				foreach($line as $key1 => $value){
						$update_l .=($update_l)?",".$key1."='".$value."'":$key1."='".$value."'";
				}
				if($line[mpl_id]){
					$sql_u ="UPDATE eva_mipi_line SET $update_l WHERE mpl_id ='".$line[mpl_id]."'";
					$db->query($sql_u);
					$id_line = $line[mpl_id];
				}else{
					$dateNow = date('Y-m-d H:i:s');
					$value_line = "'$id','".$line[mpl_subject]."','".$line[mpl_weight]."','".$line[mpl_point_full]."','".$line[mpl_point]."','D','".$head[mpl_id]."','$dateNow','N'";

					$sql1 ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_line) ";
					$db->query($sql1);
					$id_line = $con->lastInsertId();
				}
				$where_id .=($where_id)?",".$id_line:$id_line;
				if($rows){
					$where = "mph_id ='".$id."' and mpl_id = '".$line[mpl_id]."' and sl_usend = '".$params[head][user_send]."' and sl_urecive = '".$params[receive_old]."' ";
					$sql ="UPDATE eva_mipi_subline SET sl_urecive = '".$params[head][mph_user_flow]."',sl_point = '".$line["mpl_point"]."' WHERE $where " ;
					$db->query($sql);
				}
			}
			if($where_id){
			    $where_del = "mph_id ='".$params[head][mph_id]."' and mpl_id not in ($where_id)";
			    $sql ="DELETE FROM eva_mipi_line WHERE $where_del ";
				$db->query($sql);
			}
		}
		if($pointScoll){
    		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        	$auth = Zend_Auth :: getInstance();
        	$identity = $auth->getIdentity();
    		$inctArr = $rs->getIncentive();
    		$grade = $this->getGradeByScoll($pointScoll);
    		$incentive = $inctArr[$grade][$params['level_user']];
    		$sql_g = "UPDATE eva_mipi_head SET mph_totalscoll = '$pointScoll',mph_grade = '$grade'," .
    				 "mph_incentive = '".$incentive."',mph_level_now = '".$params['level_user']."' " .
    			     "WHERE mph_id ='".$params[head][mph_id]."'";
			$db->query($sql_g);
    	}
		/*if($rows){
			$sql ="UPDATE eva_mipi_subline SET sl_urecive = '".$params[head][mph_user_flow]."' WHERE $where " ;
			$db->query($sql);
		}*/
    }
	/* public function updatePIAcpDetail($head_arr,$keyid,$params,$insert_subl){
    	$rs = System_Controller::getModel('level','systemapi');
    	$con = Zend_Registry :: get("db");
		$db = $con->getConnection();
    	$field_head = "mph_status,form_code,mph_user_flow,mph_datetime,mph_column";
    	$field_subj = "mph_id,mpl_subject,mpl_type,mpl_datetime,mpl_status,mpl_weight";
    	$field_line = "mph_id,mpl_subject,mpl_weight,mpl_point_full,mpl_point,mpl_type,mpl_parent,mpl_datetime,mpl_status";
    	$field_subline = "mph_id,mpl_id,sl_usend,sl_urecive,sl_point,sl_column,sl_datetime";
    	$id = $head_arr[mph_id];

    	if($head_arr['mph_desc'])$head_arr['mph_desc'] = str_replace("\'","||",$head_arr['mph_desc']);
    	foreach($head_arr as $key => $val){
    		$update .=($update)?",".$key."='".$val."'":$key."='".$val."'";
		}
		
		$sql ="UPDATE eva_mipi_head SET $update WHERE mph_id ='".$head_arr[mph_id]."'";		
		$db->query($sql);
		$where = "mph_id = '".$head_arr[mph_id]."' ";
		$rowColumn = $this->GetColumnSubline($where);
		if($rowColumn["sl_column"]) $sl_column = $rowColumn["sl_column"]+1; else $sl_column = 1;
    	$pointScoll = 0;    	    	
    	if($params[detail][$keyid]){
	    	foreach($params[detail][$keyid] as $keyH=>$head){	    		
	    		$head[mpl_datetime] = date('Y-m-d H:i:s');
	    		if($head[mpl_id]){
	    			if($head[line]){
	    				$where_id = '';		    			
		    			foreach($head[line] as $key2=> $line){		    				
		    				$line['mpl_datetime'] = date('Y-m-d H:i:s');
		    				$line['mpl_subject'] = str_replace("\'","||",$line['mpl_subject']);
		    				if($line[mpl_weight]){
				    			$pointScoll = $pointScoll + ($line[mpl_weight] * $line[mpl_point]);
				    			$update_l = '';
				    			foreach($line as $key1 => $value){
									$update_l .=($update_l)?",".$key1."='".$value."'":$key1."='".$value."'";
								}
			    				if($line[mpl_id]){
									$sql_u ="UPDATE eva_mipi_line SET $update_l WHERE mpl_id ='".$line[mpl_id]."'";
									$db->query($sql_u);
									$id_line = $line[mpl_id];
								}else{
									$dateNow = date('Y-m-d H:i:s');
									$value_line = "'$id','".$line[mpl_subject]."','".$line[mpl_weight]."','".$line[mpl_point_full]."','".$line[mpl_point]."','D','".$head[mpl_id]."','$dateNow','N'";

									$sql1 ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_line) ";
									$db->query($sql1);
									$id_line = $con->lastInsertId();
								}
								$where_id .=($where_id)?",".$id_line:$id_line;
								
								if($insert_subl =='ok'){
									$dateNow = date('Y-m-d H:i:s');
									$value_subline = "'".$id."','".$id_line."','".$params['user_send'][$keyid]."','".$params['user_recive'][$keyid]."','$line[mpl_point]','$sl_column','$dateNow'";
									$sql2 ="INSERT INTO eva_mipi_subline ($field_subline) VALUES ($value_subline) ";
									$db->query($sql2);
			    				}
			    			}
		    			}
					    if($where_id){
					    	$where_del = "mpl_parent = '".$head[mpl_id]."' AND mph_id ='".$head_arr[mph_id]."' AND mpl_id NOT IN ($where_id)";
					    	$sql ="DELETE FROM eva_mipi_line WHERE $where_del ";
							$db->query($sql);
					    }
	    			}
	    		}else{
					$head['mpl_subject'] = str_replace("\'","||",$head['mpl_subject']);
	 				$dateNow = date('Y-m-d H:i:s');
					$value_sub = "'$id','".$head[mpl_subject]."','S','$dateNow','N','".$head[mpl_weight]."'";

					$sql ="INSERT INTO eva_mipi_line ($field_subj) VALUES ($value_sub) ";
					$db->query($sql);
					$id_parent = $con->lastInsertId();

					if($head[line]){
						foreach($head[line] as $key4=>$item){							
							$item['mpl_subject'] = str_replace("\'","||",$item['mpl_subject']);
							$dateNow = date('Y-m-d H:i:s');
							$value_inline = "'$id','$item[mpl_subject]','$item[mpl_weight]','$item[mpl_point_full]','$item[mpl_point]','D','$id_parent','$dateNow','N'";

							$sql1 ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_inline) ";
							$db->query($sql1);

						}
					}
	    		}

	    	}	    	
    	}
    	if($pointScoll){
    		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        	$auth = Zend_Auth :: getInstance();
        	$identity = $auth->getIdentity();
    		$inctArr = $rs->getIncentive();
    		$grade = $this->getGradeByScoll($pointScoll);
    		$incentive = $inctArr[$grade][$params['level_user'][$keyid]];
    		$sql_g = "UPDATE eva_mipi_head SET mph_totalscoll = '$pointScoll',mph_grade = '$grade'" .
    				 ",mph_incentive = '".$incentive."',mph_level_now = '".$params['level_user'][$keyid]."' " .
    			     "WHERE mph_id ='".$head_arr[mph_id]."'";
			$db->query($sql_g);
    	}
    	return $id;
    } */
    
    		/*
    		 * Modify by natcha
    		 * 04 June 2014
    		 * edit insert & update by used zend framework format.
    		 */
        public function updatePIMaster($params,$insert_subl){
     
        	$rs = System_Controller::getModel('level','systemapi');
        	$con = Zend_Registry :: get("db");
    		$db = $con->getConnection();
    
        	$field_head = "mph_status,form_code,mph_user_flow,mph_datetime,mph_column";
        	$field_subj = "mph_id,mpl_subject,mpl_type,mpl_datetime,mpl_status,mpl_weight";
        	$field_line = "mph_id,mpl_subject,mpl_weight,mpl_point_full,mpl_point,mpl_type,mpl_parent,mpl_datetime,mpl_status";
        	$field_subline = "mph_id,mpl_id,sl_usend,sl_urecive,sl_point,sl_column,sl_datetime";
     
        	$id = $params[head][mph_id];
        	if($params['head']['mph_desc'])$params['head']['mph_desc'] = str_replace("\'","||",$params['head']['mph_desc']);
     
        	$update_arr = array();
        	foreach($params[head] as $key => $val){
        		$update_arr[$key] = $val;
        		//$update .=($update)?",".$key."='".$val."'":$key."='".$val."'";
    		}
    		$where = "mph_id = '" . $params['head']['mph_id'] . "' ";
    		$con->update('eva_mipi_head', $update_arr, $where);
    
    		$rowColumn = $this->GetColumnSubline($where);
    		if($rowColumn["sl_column"]) $sl_column = $rowColumn["sl_column"]+1; else $sl_column = 1;
        	$pointScoll = 0;
        	if($params[detail]){
    
    	    	foreach($params[detail] as $keyH=>$head){
     
    	    		$head[mpl_datetime] = date('Y-m-d H:i:s');
    	    		if($head[mpl_id]){
    
    	    			#natcharee //Update input new score main topic by user.
    	    			$sqlhead = "UPDATE eva_mipi_line SET mpl_weight = '". $head['mpl_weight'] ."' WHERE mpl_id = '" . $head['mpl_id'] . "'";
    	    			$db->query($sqlhead);
    	    			#
    
    	    			if($head[line]){
    	    				$where_id = '';
    		    			foreach($head[line] as $key2=> $line){
    		    				$line['mpl_datetime'] = date('Y-m-d H:i:s');
    		    				$line['mpl_subject'] = str_replace("\'","||",$line['mpl_subject']);
    		    				if($line[mpl_weight]){
    				    			$pointScoll = $pointScoll + ($line[mpl_weight] * $line[mpl_point]);
     
    			    				if($line['mpl_id']){
    
    			    					$update_arr = array();
    			    					foreach($line as $key1 => $value){
    			    						$update_arr[$key1] = $value;
    			    					}
    
    			    					$where_line = "mpl_id = '" . $line['mpl_id'] . "'";
    			    					$con->update('eva_mipi_line', $update_arr, $where_line);
    
    									$id_line = $line[mpl_id];
    								}else{
    									$dateNow = date('Y-m-d H:i:s');
    	
    									//$value_line = "'$id','".$line[mpl_subject]."','".$line[mpl_weight]."','".$line[mpl_point_full]."','".$line[mpl_point]."','D','".$head[mpl_id]."','$dateNow','N'";
    									$items = '';
    									$items = array(
    											'mph_id'		=> $id,
    											'mpl_subject'	=> $line['mpl_subject'],
    											'mpl_weight'	=> $line['mpl_weight'],
    											'mpl_point_full'=> ($line['mpl_point_full'])? $line['mpl_point_full'] : 0,
    											'mpl_point'		=> ($line['mpl_point'])? $line['mpl_point'] : 0,
    											'mpl_type'		=> "D",
    											'mpl_parent'	=> $head['mpl_id'],
    											'mpl_datetime'	=> $dateNow,
    											'mpl_status'	=> "N"
    									);
    	
    									$inserted = $con->insert('eva_mipi_line', $items);
    									$id_line = $con->lastInsertId();
    								}
    								$where_id .=($where_id)?",".$id_line:$id_line;
    
    								if($insert_subl =='ok'){
    									$dateNow = date('Y-m-d H:i:s');
    									$value_subline = "'$id','$id_line','$params[user_send]','$params[user_recive]','$line[mpl_point]','$sl_column','$dateNow'";
    									$sql2 ="INSERT INTO eva_mipi_subline ($field_subline) VALUES ($value_subline) ";
    									$db->query($sql2);
    			    				}
    			    			}
    		    			}
    					    if($where_id){
    					    	$where_del = "mpl_parent = '".$head[mpl_id]."' AND mph_id ='".$params[head][mph_id]."' AND mpl_id NOT IN ($where_id)";
    					    	$sql ="DELETE FROM eva_mipi_line WHERE $where_del ";
    							$db->query($sql);
    					    }
    	    			}
    	    		}else{
    					$head['mpl_subject'] = str_replace("\'","||",$head['mpl_subject']);
    	 				$dateNow = date('Y-m-d H:i:s');
    					//$value_sub = "'$id','".$head[mpl_subject]."','S','$dateNow','N','".$head[mpl_weight]."'";
    					$items = '';
    					$items = array(
    							'mph_id'		=> $id,
    							'mpl_subject'	=> $head['mpl_subject'],
    							'mpl_weight'	=> ($head['mpl_weight'])? $head['mpl_weight'] : 0,
    							'mpl_type'		=> "S",
    							'mpl_datetime'	=> $dateNow,
    							'mpl_status'	=> "N"
    					);
    					$inserted = $con->insert('eva_mipi_line', $items);
    					//$sql ="INSERT INTO eva_mipi_line ($field_subj) VALUES ($value_sub) ";
    					//$db->query($sql);
    					$id_parent = $con->lastInsertId();
    
    					if($head[line]){
    						foreach($head[line] as $key4=>$item){
    							$item['mpl_subject'] = str_replace("\'","||",$item['mpl_subject']);
    							$dateNow = date('Y-m-d H:i:s');
    							$value_inline = "'$id','$item[mpl_subject]','$item[mpl_weight]','$item[mpl_point_full]','$item[mpl_point]','D','$id_parent','$dateNow','N'";
    
    							$items = '';
    							$items = array(
    											'mph_id'		=> $id,
    											'mpl_subject'	=> $item['mpl_subject'],
    											'mpl_weight'	=> $item['mpl_weight'],
    											'mpl_point_full'=> ($item['mpl_point_full'])? $item['mpl_point_full'] : 0,
    											'mpl_point'		=> ($item['mpl_point'])? $item['mpl_point'] : 0,
    											'mpl_type'		=> "D",
    											'mpl_parent'	=> $id_parent,
    											'mpl_datetime'	=> $dateNow,
    											'mpl_status'	=> "N"
    							);
    							$inserted = $con->insert('eva_mipi_line', $items);
    							//$sql1 ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_inline) ";
    							//$db->query($sql1);
    
    						}
    					}
    	    		}
    
    	    	}
        	}
        	//9999
        	if($pointScoll){
        		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
            	$auth = Zend_Auth :: getInstance();
            	$identity = $auth->getIdentity();
        		$inctArr = $rs->getIncentive();
        		$grade = $this->getGradeByScoll($pointScoll);
        		$incentive = $inctArr[$grade][$params['level_user']];
        		$sql_g = "UPDATE eva_mipi_head SET mph_totalscoll = '$pointScoll',mph_grade = '$grade'" .
        				 ",mph_incentive = '".$incentive."',mph_level_now = '".$params['level_user']."' " .
        			     "WHERE mph_id ='".$params[head][mph_id]."'";
    			$db->query($sql_g);
        	}
        	return $id;
        }    
        
        

/*     public function updatePIMaster($params,$insert_subl){
    	$rs = System_Controller::getModel('level','systemapi');
    	$con = Zend_Registry :: get("db");
		$db = $con->getConnection();
    	$field_head = "mph_status,form_code,mph_user_flow,mph_datetime,mph_column";
    	$field_subj = "mph_id,mpl_subject,mpl_type,mpl_datetime,mpl_status,mpl_weight";
    	$field_line = "mph_id,mpl_subject,mpl_weight,mpl_point_full,mpl_point,mpl_type,mpl_parent,mpl_datetime,mpl_status";
    	$field_subline = "mph_id,mpl_id,sl_usend,sl_urecive,sl_point,sl_column,sl_datetime";
    	$id = $params[head][mph_id];
    	if($params['head']['mph_desc'])$params['head']['mph_desc'] = str_replace("\'","||",$params['head']['mph_desc']);  	
    	foreach($params[head] as $key => $val){
    		$update .=($update)?",".$key."='".$val."'":$key."='".$val."'";
		}
		$sql ="UPDATE eva_mipi_head SET $update WHERE mph_id ='".$params[head][mph_id]."'";		
		$db->query($sql);
		$where = "mph_id = '".$params[head][mph_id]."' ";
		$rowColumn = $this->GetColumnSubline($where);
		if($rowColumn["sl_column"]) $sl_column = $rowColumn["sl_column"]+1; else $sl_column = 1;
    	$pointScoll = 0;    	    	
    	if($params[detail]){
	    	foreach($params[detail] as $keyH=>$head){	    		
	    		$head[mpl_datetime] = date('Y-m-d H:i:s');
	    		if($head[mpl_id]){
	    			
	    			#natcharee //Update input new score main topic by user.
	    			$sqlhead = "UPDATE eva_mipi_line SET mpl_weight = '". $head['mpl_weight'] ."' WHERE mpl_id = '" . $head['mpl_id'] . "'";
	    			$ddd = $db->query($sqlhead);
	    			#
	    			
	    			if($head[line]){
	    				$where_id = '';		    			
		    			foreach($head[line] as $key2=> $line){		    				
		    				$line['mpl_datetime'] = date('Y-m-d H:i:s');
		    				$line['mpl_subject'] = str_replace("\'","||",$line['mpl_subject']);
		    				if($line[mpl_weight]){
				    			$pointScoll = $pointScoll + ($line[mpl_weight] * $line[mpl_point]);
				    			$update_l = '';
				    			foreach($line as $key1 => $value){
									$update_l .=($update_l)?",".$key1."='".$value."'":$key1."='".$value."'";
								}
			    				if($line[mpl_id]){
									$sql_u ="UPDATE eva_mipi_line SET $update_l WHERE mpl_id ='".$line[mpl_id]."'";
									$db->query($sql_u);
									$id_line = $line[mpl_id];
								}else{
									$dateNow = date('Y-m-d H:i:s');
									$value_line = "'$id','".$line[mpl_subject]."','".$line[mpl_weight]."','".$line[mpl_point_full]."','".$line[mpl_point]."','D','".$head[mpl_id]."','$dateNow','N'";

									$sql1 ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_line) ";
									$db->query($sql1);
									$id_line = $con->lastInsertId();
								}
								$where_id .=($where_id)?",".$id_line:$id_line;
								
								if($insert_subl =='ok'){
									$dateNow = date('Y-m-d H:i:s');
									$value_subline = "'$id','$id_line','$params[user_send]','$params[user_recive]','$line[mpl_point]','$sl_column','$dateNow'";
									$sql2 ="INSERT INTO eva_mipi_subline ($field_subline) VALUES ($value_subline) ";
									$db->query($sql2);
			    				}
			    			}
		    			}
					    if($where_id){
					    	$where_del = "mpl_parent = '".$head[mpl_id]."' AND mph_id ='".$params[head][mph_id]."' AND mpl_id NOT IN ($where_id)";
					    	$sql ="DELETE FROM eva_mipi_line WHERE $where_del ";
							$db->query($sql);
					    }
	    			}
	    		}else{
					$head['mpl_subject'] = str_replace("\'","||",$head['mpl_subject']);
	 				$dateNow = date('Y-m-d H:i:s');
					$value_sub = "'$id','".$head[mpl_subject]."','S','$dateNow','N','".$head[mpl_weight]."'";

					$sql ="INSERT INTO eva_mipi_line ($field_subj) VALUES ($value_sub) ";
					$db->query($sql);
					$id_parent = $con->lastInsertId();

					if($head[line]){
						foreach($head[line] as $key4=>$item){							
							$item['mpl_subject'] = str_replace("\'","||",$item['mpl_subject']);
							$dateNow = date('Y-m-d H:i:s');
							$value_inline = "'$id','$item[mpl_subject]','$item[mpl_weight]','$item[mpl_point_full]','$item[mpl_point]','D','$id_parent','$dateNow','N'";

							$sql1 ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_inline) ";
							$db->query($sql1);

						}
					}
	    		}

	    	}	    	
    	}
    	//9999
    	if($pointScoll){
    		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        	$auth = Zend_Auth :: getInstance();
        	$identity = $auth->getIdentity();
    		$inctArr = $rs->getIncentive();
    		$grade = $this->getGradeByScoll($pointScoll);
    		$incentive = $inctArr[$grade][$params['level_user']];
    		$sql_g = "UPDATE eva_mipi_head SET mph_totalscoll = '$pointScoll',mph_grade = '$grade'" .
    				 ",mph_incentive = '".$incentive."',mph_level_now = '".$params['level_user']."' " .
    			     "WHERE mph_id ='".$params[head][mph_id]."'";
			$db->query($sql_g);
    	}
    	return $id;
    } */
	public function updatePIMaster_OLD($params,$insert_subl){
    	$rs = System_Controller::getModel('level','systemapi');
    	$con = Zend_Registry :: get("db");
		$db = $con->getConnection();
    	$field_head = "mph_status,form_code,mph_user_flow,mph_datetime,mph_column";
    	$field_subj = "mph_id,mpl_subject,mpl_type,mpl_datetime,mpl_status";
    	$field_line = "mph_id,mpl_subject,mpl_weight,mpl_point_full,mpl_point,mpl_type,mpl_parent,mpl_datetime,mpl_status";
    	$field_subline = "mph_id,mpl_id,sl_usend,sl_urecive,sl_point,sl_column,sl_datetime";
    	$id = $params[head][mph_id];
    	foreach($params[head] as $key => $val){
			$update .=($update)?",".$key."='".$val."'":$key."='".$val."'";
		}

		$sql ="UPDATE eva_mipi_head SET $update WHERE mph_id ='".$params[head][mph_id]."'";
		$db->query($sql);
		$where = "mph_id = '".$params[head][mph_id]."' ";
		$rowColumn = $this->GetColumnSubline($where);
		if($rowColumn["sl_column"]) $sl_column = $rowColumn["sl_column"]+1; else $sl_column = 1;

    	$pointScoll = 0;
    	if($params[detail]){
	    	foreach($params[detail] as $keyH=>$head){	    		
	    		$head[mpl_datetime] = date('Y-m-d H:i:s');
	    		if($head[mpl_id]){
	    			if($head[line]){
		    			$where_id = '';		    			
		    			foreach($head[line] as $key2=> $line){
		    				$line[mpl_datetime] = date('Y-m-d H:i:s');
							//if($line[mpl_id])$where_id .=($where_id)?",".$line[mpl_id]:$line[mpl_id];
			    			if($line[mpl_weight]){
				    			$pointScoll = $pointScoll + ($line[mpl_weight] * $line[mpl_point]);
				    			$update_l = '';
				    			foreach($line as $key1 => $value){
									$update_l .=($update_l)?",".$key1."='".$value."'":$key1."='".$value."'";
								}
			    				if($line[mpl_id]){
									$sql_u ="UPDATE eva_mipi_line SET $update_l WHERE mpl_id ='".$line[mpl_id]."'";
									$db->query($sql_u);
									$id_line = $line[mpl_id];
								}else{
									$dateNow = date('Y-m-d H:i:s');
									$value_line = "'$id','".$line[mpl_subject]."','".$line[mpl_weight]."','".$line[mpl_point_full]."','".$line[mpl_point]."','D','".$head[mpl_id]."','$dateNow','N'";

									$sql1 ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_line) ";
									$db->query($sql1);
									$id_line = $con->lastInsertId();
								}
								$where_id .=($where_id)?",".$id_line:$id_line;
								
								if($insert_subl =='ok'){
									$dateNow = date('Y-m-d H:i:s');
									$value_subline = "'$id','$id_line','$params[user_send]','$params[user_recive]','$line[mpl_point]','$sl_column','$dateNow'";
									$sql2 ="INSERT INTO eva_mipi_subline ($field_subline) VALUES ($value_subline) ";
									$db->query($sql2);
			    				}
			    			}
		    			}
		    			if($where_id){
		    				$where_del = "mpl_parent = '".$head[mpl_id]."' and mph_id ='".$params[head][mph_id]."' and mpl_id not in ($where_id)";
		    				$sql ="DELETE FROM eva_mipi_line WHERE $where_del ";
							$db->query($sql);
		    			}
	    			}
	    		}else{

	 				$dateNow = date('Y-m-d H:i:s');
					$value_sub = "'$id','".$head[mpl_subject]."','S','$dateNow','N'";

					$sql ="INSERT INTO eva_mipi_line ($field_subj) VALUES ($value_sub) ";
					$db->query($sql);
					$id_parent = $con->lastInsertId();

					if($head[line]){
						foreach($head[line] as $key4=>$item){
							$dateNow = date('Y-m-d H:i:s');
							$value_inline = "'$id','$item[mpl_subject]','$item[mpl_weight]','$item[mpl_point_full]','$item[mpl_point]','D','$id_parent','$dateNow','N'";

							$sql1 ="INSERT INTO eva_mipi_line ($field_line) VALUES ($value_inline) ";
							$db->query($sql1);

						}
					}
	    		}

	    	}
    	}
    	//9999
    	if($pointScoll){
    		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        	$auth = Zend_Auth :: getInstance();
        	$identity = $auth->getIdentity();
    		$inctArr = $rs->getIncentive();
    		$grade = $this->getGradeByScoll($pointScoll);
    		$incentive = $inctArr[$grade][$params['level_user']];
    		$sql_g = "UPDATE eva_mipi_head SET mph_totalscoll = '$pointScoll',mph_grade = '$grade'" .
    				 ",mph_incentive = '".$incentive."',mph_level_now = '".$params['level_user']."' " .
    			     "WHERE mph_id ='".$params[head][mph_id]."'";
			$db->query($sql_g);
    	}
    	return $id;
    }
    public function acceptPI($mph_id,$params,$mph_eflow,$lookup_code){
		$db = Zend_Registry :: get("db");
		$sql_l = "SELECT * FROM eva_mipi_line WHERE mph_id = '$mph_id'";
		$rs_l = $db->query($sql_l);
		$rows_l = $rs_l->fetchAll();

		$where = "mph_id = '".$mph_id."' ";
		$rowColumn = $this->GetColumnSubline($where);
		if($rowColumn["sl_column"]) $sl_column = $rowColumn["sl_column"]+1; else $sl_column = 1;

		if($rows_l){
			$field_subline = "mph_id,mpl_id,sl_usend,sl_urecive,sl_point,sl_column,sl_datetime";
    		$id = $mph_id;

    		$sql_update = "UPDATE eva_mipi_line SET mpl_datetime = '".date('Y-m-d H:i:s')."' WHERE mph_id = '$mph_id'";
			$db->query($sql_update);
			if($mph_eflow != $params["mph_eflow"]){				
				if($lookup_code=='AM'){
					$mph_status = "F";
				}else{
					$mph_status = "P";
				}
			}else{
				$mph_status = "F";
			}
			
			//if($mph_eflow != $params["mph_eflow"]){
				foreach($rows_l as $item){
					$value_inline = "'".$id."','".$item["mpl_id"]."','".$params["user_send"]."','".$params["user_recive"]."','".$item["mpl_point"]."','".$sl_column."','".date('Y-m-d H:i:s')."'";
	    			$sql2 ="INSERT INTO eva_mipi_subline ($field_subline) VALUES ($value_inline) ";
					$db->query($sql2);
    			}
    			$mph_column = $params["mph_column"]+1;
    			$sql_g = "UPDATE eva_mipi_head SET mph_user_flow = '".$params["user_recive"]."',mph_status = '".$mph_status."',mph_column = '".$mph_column."',mph_datetime = '".date('Y-m-d H:i:s')."'" .
    					 ",mph_incentive = '".$params["mph_incentive"]."',mph_level_now = '".$params["mph_level_now"]."' " .
    			     	 "WHERE mph_id ='".$mph_id."'";
				$db->query($sql_g);
			/*}else{
				$sql_g = "UPDATE eva_mipi_head SET mph_user_flow = '".$params["user_recive"]."',mph_status = 'F',mph_datetime = '".date('Y-m-d H:i:s')."' " .
    			         "WHERE mph_id ='".$mph_id."'";
				$db->query($sql_g);
			}*/
		}
		return $mph_id;
	}
    public function getGradeByScoll($pointScoll){
		$rs = System_Controller::getModel('master','systemapi');
		$where = "start_scoll <='$pointScoll' and end_scoll >= '$pointScoll'";
		$result = $rs->getGradeByScoll($where);

		return $result[0][grade];
	}
    public function createPIMaster($params){
    	$rs = System_Controller::getModel('evaluate','systemapi');

    	$con = Zend_Registry :: get("db");
		$db = $con->getConnection();
		$field_head = "mph_user,form_code,mph_user_create,mph_month,mph_status,mph_user_flow,mph_type,mph_objective,mph_sflow,mph_eflow,mph_createdate,mph_datetime,user_first_recive,user_send";
		$field_line = "mph_id,mpl_subject,mpl_weight,mpl_type,mpl_status,mpl_parent,mpl_datetime";
		$user_code = explode(",",$params["fields"][user_code]);

		foreach($user_code as $key1 => $item){
			$params[head][mph_user] = $item;
			$where = "mph_user = '".$params[head][mph_user]."' and mph_month = '".$params[head][mph_month]."'";
			$chkDup = $rs->ChkInsertDup($where);
			if(!$chkDup){
				$insert_value = "'$item','".$params[head][form_code]."','".$params[head][mph_user_create]."','".$params[head][mph_month]."'," .
						        "'".$params[head][mph_status]."','".$params[head][mph_user_flow]."','".$params[head][mph_type]."'," .
						        "'".$params[head][mph_objective]."','".$params[head][mph_sflow]."','".$params[head][mph_eflow]."'," .
						        "'".$params[head][mph_createdate]."','".$params[head][mph_datetime]."','".$params[head][user_first_recive]."','".$params[head][user_send]."'";

				$sql ="INSERT INTO eva_mipi_head ($field_head) VALUES ($insert_value)";
				$db->query($sql);
				$id = $con->lastInsertId();
				if($params["fields"]["data"]){
					foreach($params["fields"]["data"] as $key=>$subj){
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
		return $id;
    }
    public function getEvaluateMIPI($type){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$result = $rs->getEvaluateMIPI($type);

    	if($result){
    		foreach($result as $key=>$item){
    			$dataArr[$item[mph_user]][$item[mph_month]] = $item ;
    		}
    	}

        return $dataArr;
    }
    public function getSumIncentiveMIPI($type){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = "mph_type = '$type' and mph_status = 'F'";
    	$result = $rs->getEvaluateHead($where);

    	if($result){
    		foreach($result as $key=>$item){
    			$dataArr[$item[mph_user]][$item[mph_month]] = $item ;
    		}
    	}
        return $dataArr;
    }
    public function getAcceptIncentive($group,$month,$type,$user_code,$lookup_code,&$dataInc,&$userAll){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$rs_l = System_Controller::getModel('level','systemapi');
    	if($lookup_code == 'AM')
    		$where = "mph_month = '$month' and mph_type = '$type' and mph_status = 'P' ";
    	else
    		$where = "mph_month = '$month' and mph_type = '$type' and mph_status = 'P' and mph_user_flow = '$user_code'";

		if($group && $where)
    		$where .= "and u.user_sec_depart = '".$group."'";

    	$result = $rs->getEvaluateHead($where);

    	if($result){
			foreach($result as $user_key){
				$user_Array .= ($user_Array)?",".$user_key["mph_user"]:$user_key["mph_user"];
			}
		}

    	$incentive = $rs_l->getIncentive();
    	if($group)
    		$where_g = "user_sec_depart = '".$group."'";
    	if($user_Array)
    		$where_1 = "user_code IN ($user_Array)";
    	$count_user = $rs_l->getCountUser($where_g,$where_1);
		$myNow = substr($month,-4)."".sprintf("%02d",substr($month,0,2));

    	if($result){
    		foreach($result as $key=>$item){
				if(!$count_user[$item["user_sec_depart"]]) $count_userinsec = 0; else $count_userinsec = $count_user[$item["user_sec_depart"]];
    			$dataInc[$item["user_sec_depart"]]["sum_scoll"] += $item["mph_totalscoll"];
    			$dataInc[$item["user_sec_depart"]]["count_user"] = $count_userinsec;
    			if($count_userinsec == 0)
    				$dataInc[$item["user_sec_depart"]]["average_scoll"] = 0;
    			else
    				$dataInc[$item["user_sec_depart"]]["average_scoll"] = $dataInc[$item["user_sec_depart"]]["sum_scoll"]/$count_userinsec;

				$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]] = $item ;
    			$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]]["incentive"] = $item["mph_incentive"];
				$dataArr["data"][$item["user_sec_depart"]]["total"] = $dataInc[$item["user_sec_depart"]]["average_scoll"] ;
				$dataArr["endflow"] = $item["mph_eflow"];

					if($type == 'PI'){
						$date_start = $item["user_start_pi"];
					}else{
						$date_start = $item["user_start_mi"];
					}
	    			if($date_start){

	    				$date_pi = explode("-",$date_start);
	    				$day = $date_pi[2];
	    				$my = $date_pi[0]."".$date_pi[1];

	    				if($myNow == $my && $day =='01'){
							$dataInc[$item["user_sec_depart"]]["sum_incentive"] += $item["mph_incentive"];
	    					$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]]["incentive"] = $item["mph_incentive"];
	    				}elseif($myNow == $my && $day !='01'){
							$dayFull = $this->t($day,$date_pi[1],$date_pi[0]);
							$countDay = $dayFull - $day;
							$avg_money = $item["mph_incentive"]/$dayFull;
							$sum_money = $avg_money * $countDay;
							$dataInc[$item["user_sec_depart"]]["sum_incentive"] += $sum_money;
	    					$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]]["incentive"] = $sum_money;

	    				}elseif($myNow < $my){
	    					$dataInc[$item["user_sec_depart"]]["sum_incentive"] += 0;
	    					$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]]["incentive"] = 0;
	    					$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]]["re_inc"] = 'N';
	    				}elseif($myNow > $my){
	    					$dataInc[$item["user_sec_depart"]]["sum_incentive"] += $item["mph_incentive"];
	    					$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]]["incentive"] = $item["mph_incentive"];
	    				}
	    			}else{
	    				
	    			}

    		}
    	}
    	if($count_user){
			$userAll = array_sum($count_user);
		}

        return $dataArr;
    }
    public function getUserById($code){
    	$rs = System_Controller::getModel('member','systemapi');
    	$result = $rs->getUserById($code);

        return $result[0];
    }
	public function getUserINId($code){
    	$rs = System_Controller::getModel('member','systemapi');
    	$result = $rs->getUserINId($code);
        return $result;
    }
	public function getEvaluateHeadPIDetail($code){
    	$rs = System_Controller::getModel('evaluate','systemapi');
		$where = " mph_id IN ($code) ";
    	$result = $rs->getEvaluateHead($where);
    	if($result){
    		foreach($result as $item){
     			$data_arr[$item['mph_id']] = $item;
    		}
    	}
        return $data_arr;
    }
	public function getEvaluateLinePIDetail($mph_id,&$column,& $user_col,& $totalLine){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = " mph_id IN ($mph_id) AND mpl_type = 'S' ";
    	$result = $rs->getEvaluateLine($where);   	   	
    	if($result){
	    	foreach($result as $key=>$item){
				$dataArray[$item['mph_id']][$item['mpl_id']][subject]= $item;
				$dataLine = $this->getDataPILine($item[mpl_id]);
				
				$where_sub = " mph_id IN ($item[mph_id]) ";
		    	$rowColumn = $this->GetColumnSubline($where_sub);
		    	$dataColumn = $rowColumn["sl_column"];
				
				if($dataLine){
					$dataArray[$item['mph_id']][$item[mpl_id]][detail]= $dataLine;
					
					foreach($dataLine as $row){
						$dataArray[$item['mph_id']][$item[mpl_id]][detail][$row[mpl_id]][subCol] = $this->getDataSubLine($row[mpl_id],$dataColumn);
						$column[$item['mph_id']] = $dataColumn;
						$user_col[$item['mph_id']] = $this->getDataSubLine($row[mpl_id],$dataColumn);
						if($user_col){
							foreach($user_col[$item['mph_id']] as $sumLine){
								$totalLine[$item['mph_id']][$sumLine[sl_column]][scoll] += $row[mpl_weight]*$sumLine[sl_point];
								$totalLine[$item['mph_id']][$sumLine[sl_column]][grade] = $this->getGradeByScoll($totalLine[$item['mph_id']][$sumLine[sl_column]][scoll]);
							}
						}
					}

				}
			}

    	}  	
       return $dataArray;
    }
	
    public function getEvaluateHeadPI($code,$uflow,$dateNow,$chkDate,$status){
    	$rs = System_Controller::getModel('evaluate','systemapi');
		if($chkDate < date("m") || $chkDate > date("m")){
			$where = " mph_user = '$code' AND mph_month = '$dateNow' AND mph_type='PI' ";
		}else{
			if($status == 'W' || $status == 'A'){
    			 $where = " mph_user = '$code' AND mph_month = '$dateNow' AND mph_type='PI' ";
			}else if($status == 'E'){
				$where = " mph_user = '$code' AND user_send = '$uflow' " .
    			 " AND mph_month = '$dateNow' AND mph_type='PI' ";
			}else{
				$where = " mph_user = '$code' AND mph_user_flow = '$uflow' " .
    			 " AND mph_month = '$dateNow' AND mph_type='PI' ";
			}
		}
    	$result = $rs->getEvaluateHead($where);
        return $result[0];
    }
	public function getEvaluateLinePI_OLD($id,$user_code,$mhp_status,&$column,&$user_col,&$totalLine,$status){
    	Zend_Loader :: loadClass('Zend_Json');
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = " mph_id = '$id' and mpl_type ='S' ";
    	$result = $rs->getEvaluateLine($where);
    	if($status == 'W' || $status == 'A')
    		$where_sub = "mph_id = '$id' ";
    	else
    		$where_sub = "mph_id = '$id' and sl_urecive = '$user_code'";
    	$rowColumn = $this->GetColumnSubline($where_sub);
    	if($mhp_status == 'P' || $mhp_status == 'R' || $mhp_status == 'C')$dataColumn = $rowColumn["sl_column"];
    	if($mhp_status == 'F')$dataColumn = $rowColumn["sl_column"];

    	if($result){
	    	foreach($result as $key=>$item){
				$dataArray[$item[mpl_id]][subject]= $item;
				$dataLine = $this->getDataPILine($item[mpl_id]);
				if($dataLine){
					$dataArray[$item[mpl_id]][detail]= $dataLine;
					foreach($dataLine as $row){
						$dataArray[$item[mpl_id]][detail][$row[mpl_id]][subCol] = $this->getDataSubLine($row[mpl_id],$dataColumn);
						$dataArray[$item[mpl_id]][detail][$row[mpl_id]][subColJSON] =  Zend_Json::encode($dataArray[$item[mpl_id]][detail][$row[mpl_id]][subCol]);
						//$dataArray[$item[mpl_id]][detail][$row[mpl_id]][numCol] = count($dataArray[$item[mpl_id]][detail][$row[mpl_id]][subCol]);
						//$column = $dataArray[$item[mpl_id]][detail][$row[mpl_id]][numCol];
					$column = $dataColumn;
					$user_col = $this->getDataSubLine($row[mpl_id],$dataColumn);
						if($user_col){
							foreach($user_col as $sumLine){
								$totalLine[$sumLine[sl_column]][scoll] += $row[mpl_weight]*$sumLine[sl_point];
								$totalLine[$sumLine[sl_column]][grade] = $this->getGradeByScoll($totalLine[$sumLine[sl_column]][scoll]);
							}
						}
					}

				}
			}

    	}//5555
    	//_print($totalLine);
       return $dataArray;
    }
    public function getEvaluateLinePI($id,$user_code,$mhp_status,&$column,&$user_col,&$totalLine,$status){
    	//Zend_Loader :: loadClass('Zend_Json');
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = " mph_id = '$id' and mpl_type ='S' ";
    	$result = $rs->getEvaluateLine($where);
    	if($status == 'W' || $status == 'A')
    		$where_sub = "mph_id = '$id' ";
    	else{   		
    		$where_sub = "mph_id = '$id' and sl_urecive = '$user_code'"; 
    	}

    	$rowColumn = $this->GetColumnSubline($where_sub);
    	if($mhp_status == 'P' || $mhp_status == 'R' || $mhp_status == 'C')$dataColumn = $rowColumn["sl_column"];
    	if($mhp_status == 'F')$dataColumn = $rowColumn["sl_column"];

    	if($result){
	    	foreach($result as $key=>$item){
				$dataArray[$item[mpl_id]][subject]= $item;
				$dataLine = $this->getDataPILine($item[mpl_id]);
				if($dataLine){
					$dataArray[$item[mpl_id]][detail]= $dataLine;
					foreach($dataLine as $row){
						$dataArray[$item[mpl_id]][detail][$row[mpl_id]][subCol] = $this->getDataSubLine($row[mpl_id],$dataColumn);
						//$dataArray[$item[mpl_id]][detail][$row[mpl_id]][subColJSON] =  Zend_Json::encode($dataArray[$item[mpl_id]][detail][$row[mpl_id]][subCol]);
						$column = $dataColumn;
						$user_col = $this->getDataSubLine($row[mpl_id],$dataColumn);
						if($user_col){
							foreach($user_col as $sumLine){
								$totalLine[$sumLine[sl_column]][scoll] += $row[mpl_weight]*$sumLine[sl_point];
								$totalLine[$sumLine[sl_column]][grade] = $this->getGradeByScoll($totalLine[$sumLine[sl_column]][scoll]);
							}
						}
					}

				}
			}

    	}//5555    	
       return $dataArray;
    }
    public function getEvaluateHeadMI($code,$uflow,$dateNow,$mN,$status){
    	$rs = System_Controller::getModel('evaluate','systemapi');
		$chkDate = substr($dateNow,1,1);
		if($chkDate > $mN || $chkDate < $mN){
			$where = " mph_user = '$code' AND mph_month = '$dateNow' AND mph_type='MI' ";
		}else{
    		if($status == 'W'){
    			 $where = " mph_user = '$code' AND mph_month = '$dateNow' AND mph_type='MI' ";
			}else if($status == 'E'){
				$where = " mph_user = '$code' AND user_send = '$uflow' " .
    			 " AND mph_month = '$dateNow' AND mph_type='MI' ";
			}else{
				$where = " mph_user = '$code' AND mph_user_flow = '$uflow' " .
    			 " AND mph_month = '$dateNow' AND mph_type='MI' ";
			}
    	}
    	$result = $rs->getEvaluateHead($where);
        return $result[0];
    }
    public function getEvaluateLineMI($id,$user_code,$mhp_status,&$column,&$userColumn,&$totalLine,$status){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = " mph_id = '$id' ";
    	$result = $rs->getEvaluateLine($where);

    	if($status != 'W')$where_sub = "mph_id = '$id' and sl_urecive = '$user_code'"; else $where_sub = "mph_id = '$id'";
    	$rowColumn = $this->GetColumnSubline($where_sub);
    	if($mhp_status == 'P' || $mhp_status == 'R' || $mhp_status == 'C')$dataColumn = $rowColumn["sl_column"];
    	if($mhp_status == 'F')$dataColumn = $rowColumn["sl_column"];

    	if($result){
	    	foreach($result as $key=>$item){
				$dataArray[$item[mpl_id]]= $item;
				$dataArray[$item[mpl_id]][subCol] = $this->getDataSubLine($item[mpl_id],$dataColumn);
				$dataArray[$item[mpl_id]][subColJSON] =  $this->array2json($dataArray[$item[mpl_id]][subCol]);
				//$dataArray[$item[mpl_id]][numCol] = count($this->getDataSubLine($item[mpl_id]));
				//$column = $dataArray[$item[mpl_id]][numCol];
				$column = $dataColumn;
				$userColumn = $this->getDataSubLine($item[mpl_id],$dataColumn);
				if($userColumn){
					foreach($userColumn as $sumLine){
						$totalLine[$sumLine[sl_column]][scoll] += $item[mpl_weight]*$sumLine[sl_point];
						$totalLine[$sumLine[sl_column]][grade] = $this->getGradeByScoll($totalLine[$sumLine[sl_column]][scoll]);
					}
				}
			}

    	}
       return $dataArray;
    }
    public function getStepEvadata($where){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$rs_lev = System_Controller::getModel('level','systemapi');
    	$rs_user = System_Controller::getModel('member','systemapi');

    	$where1 = "mph_type = '".$where["type"]."' and mph_status = 'P' and mph_month = '".$where["month"]."".$where[year]."' ";
    	//_print($where1);//555
    	$result = $rs->getEvaluateHead($where1);

    	if($result){
    		foreach($result as $key=>$item){
    			$user = $rs_user->getPositionByUser($item["mph_user_flow"]);
    			if($user["level"])
    				$row = $rs_lev->getLevelByPos($user["level"]);

    			$dataArr[$item["mph_user"]]["mph_month"] = $item["mph_month"] ;
    			$dataArr[$item["mph_user"]]["mph_user_flow"] = $item["mph_user_flow"] ;
    			$dataArr[$item["mph_user"]]["mph_status"] = $item["mph_status"] ;
    			$dataArr[$item["mph_user"]]["mph_sflow"] = $item["mph_sflow"];
    			$dataArr[$item["mph_user"]]["mph_eflow"] = $item["mph_eflow"];
        		$dataArr[$item["mph_user"]]["level"] = $row["lv_code"];
        		$dataArr[$item["mph_user"]]["level_name"] = $row["lv_shotname"];
        		$dataArr[$item["mph_user"]]["name_user_flow"] = $user["user_name"];
    		}
    	}
    	//_print($dataArr);
        return $dataArr;
    }

    public function getDataPILine($id){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = " mpl_parent = '$id' and mpl_type ='D' ";
    	$result = $rs->getEvaluateLine($where);
    	//_print($result);
    	return $result;
    }
    public function getDataSubLine($id,$column){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = " mpl_id = '$id' and sl_column <= '$column' "; //and sl_column = '$column'
    	$result = $rs->getDataSubLine($where);
    	return $result;
    }
    public function getTypeOp(){
    	$rs = System_Controller::getModel('level','systemapi');
    	$result = $rs->getTypeMST('');
    	if($result){
    		foreach($result as $item){
    			$dataArr[$item[type_name]] = $item[type_name];
    		}
    	}
    	return $dataArr;
    }
    public function getLevelOp(){
    	$rs = System_Controller::getModel('level','systemapi');
    	$result = $rs->getGLevel();
    	if($result){
    		foreach($result as $item){
    			$dataArr[$item[l_shotname]] = $item[l_shotname];
    		}
    	}
    	return $dataArr;
    }
    public function getFormEvaluateById($id){
		$rs = System_Controller::getModel('form','systemapi');
		$where = "form_id = '".$id."'";
        $rows = $rs->getFormEvaluateById($where);
        return $rows[0];
	}
	public function getDraftFrmById($id){
		$rs = System_Controller::getModel('form','systemapi');
		$where = "drf_id = '".$id."'";
        $rows = $rs->getDraftFrmById($where);
        if($rows[0]["data"]) $data_arr = array (unserialize($rows[0]["data"]));
        $rows[0]["data_select"] = $data_arr[0];
//_print($data_arr);
        return $rows[0];
	}
	public function checkDateSend($level_send,$user_recive){
		$rs = System_Controller::getModel('account','systemapi');
		$rs1 = System_Controller::getModel('level','systemapi');
        $where = "user_code = '$user_recive'";
        $recive = $rs->getAccountById($where);
		if($recive[0][org_position_level]){
			$where1 = "config_level = '".$recive[0][org_position_level]."'";
	        $rows = $rs1->getSendDate($where1);
	        $date_now = date('YmdHis');

	        if($rows[0][config_senddate]){
		        $date_send = date('Ym')."".sprintf("%02d",$rows[0][config_senddate])."235959";
		        if($date_now < $date_send){
		        	$check_date = 'Y';
		        }else{
		        	$check_date = 'N';
		        }
	        }
		}
        return $check_date;
	}
	public function GetHistorySend($user_send,$start,$perpage){
		$rs = System_Controller::getModel('evaluate','systemapi');
		$where = "user_send = '".$user_send."' and mph_status IN ('C','P')";
		$rows = $rs->GetDataMasterPage($where,$start,$perpage);
        return $rows;
	}
	public function GetHistoryAdmin($start,$perpage){
		$rs = System_Controller::getModel('evaluate','systemapi');
		$where = "mph_status IN ('C','P')";
		$rows = $rs->GetDataMasterPage($where,$start,$perpage);
        return $rows;
	}
	public function GetDataTocopy($params){
		$rs = System_Controller::getModel('evaluate','systemapi');
		$where = "mph_user = '".$params[user_owner]."' " .
				 "and mph_type = '".$params[type]."' and mph_status = 'C'";
				 //mph_month > ".$params["month_now"]." and
        $rows = $rs->GetDataMaster($where);
        return $rows;
	}
	public function GetEmail($user_code){
		$rs = System_Controller::getModel('account','systemapi');
		$where = "user_code = '".$user_code."' AND user_active = 'Y' ";
		$rows = $rs->getAccountById($where);
        return $rows[0];
	}
	public function GetName($user_code){
		$rs = System_Controller::getModel('account','systemapi');
		$where = "user_code = '".$user_code."' AND user_active = 'Y' ";
		$rows = $rs->getAccountById($where);
        return $rows[0];
	}
	public function getDataCopy($params){
		$con = Zend_Registry :: get("db");
		$db = $con->getConnection();
		$field_head = "mph_id,mpl_subject,mpl_weight,mpl_type,mpl_status,mpl_parent,mpl_datetime";

		$rs = System_Controller::getModel('master','systemapi');
		if($params["type"]=='MI')
			$where = "h.mph_id = '".$params["copy_from"]."' and h.mpl_status = 'N' ";
		if($params["type"]=='PI')
			$where = "h.mph_id = '".$params["copy_from"]."' and h.mpl_status = 'N' and h.mpl_parent > 0 ";

		$rows_fr = $rs->getDataCopy($where);

		if($rows_fr){
			foreach($rows_fr as $item_fr){
				$where_parent = "h.mpl_id = '".$item_fr["mpl_parent"]."'";
				$rows_parent = $rs->getDataCopyById($where_parent);

				$rows_arr[$item_fr["mpl_id"]] = $item_fr;
				$rows_arr[$item_fr["mpl_id"]]["parent_name"] = $rows_parent["mpl_subject"];
			}
		}

		$where_to = "h.mph_id = '".$params["copy_to"]."' and h.mpl_parent = 0 ";
		$rows_to = $rs->getParentDataCopy($where_to);

		if($rows_to){
			foreach($rows_to as $item_to){
				$option[$item_to["mpl_subject"]] = $item_to["mpl_id"];
			}
		}
		if($rows_arr){
			foreach($rows_arr as $key=> $item){
				if($params["type"]=='PI'){
					if($item["parent_name"]=='Personality'){
						$sqlCk = "SELECT mpl_id FROM eva_mipi_line WHERE mph_id = '".$params["copy_to"]."' AND mpl_subject = '".$item["mpl_subject"]."' ";						
						$rs = $con->query($sqlCk);
     					$result = $rs->fetchAll();  
     					if($result[0]){    					
     						$update = "mpl_weight = '".$item[mpl_weight]."',mpl_type = '".$item["mpl_type"]."' ,mpl_status = '".$item[mpl_status]."', mpl_datetime = '".date("Y-m-d H:i:s")."' ";
							$sql ="UPDATE eva_mipi_line SET $update WHERE mpl_id = '".$result[0][mpl_id]."' ";
							$db->query($sql);     						
     					}else{
     						$insert_value = "'".$params["copy_to"]."','".$item["mpl_subject"]."','".$item["mpl_weight"]."','".$item["mpl_type"]."','".$item["mpl_status"]."','".$option[$item["parent_name"]]."','".date("Y-m-d H:i:s")."'";
							$sql ="INSERT INTO eva_mipi_line ($field_head) VALUES ($insert_value)" ;
							$db->query($sql);
     					}						
					}elseif($option[$item["parent_name"]] && $item["parent_name"]!='Personality'){
						$insert_value = "'".$params["copy_to"]."','".$item["mpl_subject"]."','".$item["mpl_weight"]."','".$item["mpl_type"]."','".$item["mpl_status"]."','".$option[$item["parent_name"]]."','".date("Y-m-d H:i:s")."'";
						$sql ="INSERT INTO eva_mipi_line ($field_head) VALUES ($insert_value)" ;
						$db->query($sql);
					}
				}
				if($params["type"]=='MI'){
					$insert_value = "'".$params["copy_to"]."','".$item["mpl_subject"]."','".$item["mpl_weight"]."','".$item["mpl_type"]."','".$item["mpl_status"]."','','".date("Y-m-d H:i:s")."'";
					$sql ="INSERT INTO eva_mipi_line ($field_head) VALUES ($insert_value)";
					$db->query($sql);
				}
			}
			return "ok";
		}
	}
	protected function t($day,$month, $year){return date('t', mktime(0, 0, 0, $month, $day, $year));}
	
    public function array2json($arr) {
	    $parts = array();
	    $is_list = false;

	    //Find out if the given array is a numerical array
	    $keys = array_keys($arr);
	    $max_length = count($arr)-1;
	    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
	        $is_list = true;
	        for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position
	            if($i != $keys[$i]) { //A key fails at position check.
	                $is_list = false; //It is an associative array.
	                break;
	            }
	        }
	    }


	    foreach($arr as $key=>$value) {
	        if(is_array($value)) { //Custom handling for arrays
	            if($is_list) $parts[] = $this->array2json($value); /* :RECURSION: */
	            else $parts[] = '"' . $key . '":"' . $this->array2json($value).'"'; /* :RECURSION: */
	        } else {
	            $str = '';
	            if(!$is_list) $str = '"' . $key . '":';

	            //Custom handling for multiple data types
	            if(is_numeric($value)) $str .= '"'.$value.'"'; //Numbers
	            elseif($value === false) $str .= 'false'; //The booleans
	            elseif($value === true) $str .= 'true';
	            else $str .= '"' . addslashes($value) . '"'; //All other things
	            // :TODO: Is there any more datatype we should be in the lookout for? (Object?)

	            $parts[] = $str;
	        }
	    }
	    $json = implode(',',$parts);

	    if($is_list) return '[' . $json . ']';//Return numerical JSON
	    return '{' . $json . '}';//Return associative JSON
	}

	/*
	 * get data for backward process.
	 * by natcha
	 * 06 Jun 2014
	 */
	public function getFinishList($data=array())
	{
		$rs 	= System_Controller::getModel('evaluate','systemapi');
		$where 	= '';

		if(!empty($data)) {
			foreach($data as $field => $value) {
				$where .= ($where)? " AND ": "";
				$where .= $field . " = '" . $value . "'";
			}
		}

		$where .=  " AND mph_status IN ('F')";
		$rows = $rs->GetDataMasterNoPage($where);
		
		return $rows;
	}
	/*
	* Backward process for administrator. 
	* Modify by natcha
	* 04 June 2014
	*/
	public function backwardPIProcess($mphid, $mplArr, $column) {
		$rs = System_Controller::getModel('level','systemapi');
		$con = Zend_Registry :: get("db");
		$db = $con->getConnection();
			
		// delete eva_mipi_subline.
		if($mplArr) {
			$where_del_line = "sl_id IN (" . implode(', ' , $mplArr) . ")";
// 			$where_del_line = "sl_usend = sl_urecive AND mph_id = " . $mphid . " AND mpl_id IN (" . implode(', ' , $mplArr) . ")";
			$sql ="DELETE FROM eva_mipi_subline WHERE $where_del_line ";
			$delFlag = $db->query($sql);
		}
			
		// change eva_mipi_head.mph_status is 'P'
		// change eva_mipi_head.mph_column is current value minus 1.
		$update_arr = array("mph_status" => "P",
							"mph_column" => $column - 1
		);
		$where = "mph_id = '" . $mphid . "' ";
		$con->update('eva_mipi_head', $update_arr, $where);
			
		// change eva_mipi_head.mph_user_recevie is selected from popup.
		return true;
	}
	
	public function getLastSubLinePI($mph_id)
	{
		$rs 	= System_Controller::getModel('evaluate','systemapi');
		$where 	= "mph_id = " . $mph_id;
// 		$where .= " AND m.sl_usend = m.sl_urecive";
		
		$max	= $rs->getMaxSublineApprove($where);
		
		$items 	= $rs->getEvaluateSubLineLastApprove($where, $max);
		
		$results = array();
		if(!empty($items)) {
			foreach($items as $item) {
				$results['sl_id'][] = $item['sl_id'];
			}
		}
		
		$results['mph_column'] = $max;
		
		return $results;
	}

	public function getOrgActiveByCode($user_code){
    	$rs = System_Controller::getModel('organize','systemapi');
    	$where = "user_header IN ($user_code)";
    	$where .= " AND org_sec_status = 'Y'";
    	$result = $rs->GetOrgByCode($where);
    	if($result){
    		foreach($result as $item){
    			$dataArr .= ($dataArr)?",".$item["org_sec_code"]:$item["org_sec_code"];
    		}
    	}
    	return $dataArr;
    }
    
    public function getUsersSection($orgs, $user_Array=array()) {
    	$rs = System_Controller::getModel('member','systemapi');
    	if($orgs) {
    		$where = "user_sec_depart IN (". $orgs .") ";
    	}
    	if(!empty($user_Array)) {
    		$where1 = "user_code IN ($user_Array) ";
    	}
    	
    	$result = $rs->getUserAccept($where,$where1);
    	$dataArr = array();
    	if(!empty($result)) {
    		
    		foreach($result as $val) {
    			$dataArr[] = $val['user_code'];
    		}
    	}
    	
    	return $dataArr;
    }
    
    public function updatePIAcpDetail($head_arr,$keyid,$params,$insert_subl){
    	
    	$rs 	= System_Controller::getModel('level','systemapi');
    	$con 	= Zend_Registry :: get("db");
    	$db 	= $con->getConnection();
    	
    	$field_head = "mph_status,form_code,mph_user_flow,mph_datetime,mph_column";
    	$field_subj = "mph_id,mpl_subject,mpl_type,mpl_datetime,mpl_status,mpl_weight";
    	$field_line = "mph_id,mpl_subject,mpl_weight,mpl_point_full,mpl_point,mpl_type,mpl_parent,mpl_datetime,mpl_status";
    	$field_subline = "mph_id,mpl_id,sl_usend,sl_urecive,sl_point,sl_column,sl_datetime";
    	$id = $head_arr['mph_id'];
    
    	if($head_arr['mph_desc'])$head_arr['mph_desc'] = str_replace("\'","||",$head_arr['mph_desc']);
    	$update_arr = array();
    	foreach($head_arr as $key => $val){
    		$update_arr[$key] = $val;
    	}
    	
    	$where = "mph_id = '" . $head_arr['mph_id'] . "' ";
    	$con->update('eva_mipi_head', $update_arr, $where);
    	
    	$rowColumn = $this->GetColumnSubline($where);

    	if($rowColumn["sl_column"]) $sl_column = $rowColumn["sl_column"]+1; else $sl_column = 1;
    	$pointScoll = 0;
    	if($params['detail'][$keyid]){
    		
    		foreach($params['detail'][$keyid] as $keyH => $head){
    			$head['mpl_datetime'] = date('Y-m-d H:i:s');
    			
    			if($head['mpl_id']){
    				if($head['line']){
    					$where_id = '';
    					foreach($head['line'] as $key2=> $line){
    						
    						$line['mpl_datetime'] = date('Y-m-d H:i:s');
    						$line['mpl_subject'] = str_replace("\'","||",$line['mpl_subject']);
    						if($line['mpl_weight']){
    							$pointScoll = $pointScoll + ($line['mpl_weight'] * $line['mpl_point']);
    							$update_l = array();
    							foreach($line as $key1 => $value){
    								$update_l[$key1] = $value;
    							}
    							
    							if($line['mpl_id']){
    								$where_line = "mpl_id = '" . $line['mpl_id'] . "' ";
    								$con->update('eva_mipi_line', $update_l, $where_line);
    								$id_line = $line['mpl_id'];
    							}else{
    								$dateNow = date('Y-m-d H:i:s');
    								$lineArr = array(
    										"mph_id" 		=> $id,
    										"mpl_subject"	=> $line['mpl_subject'],
    										"mpl_weight"	=> $line['mpl_weight'],
    										"mpl_point_full"=> $line['mpl_point_full'],
    										"mpl_point"		=> $line['mpl_point'],
    										"mpl_type"		=> "D",
    										"mpl_parent"	=> $head['mpl_id'],
    										"mpl_datetime"	=> $dateNow,
    										"mpl_status"	=> "N"
    								);
    
    								$inserted = $con->insert('eva_mipi_line', $lineArr);
    								$id_line = $con->lastInsertId();
    							}
    							
    							$where_id .=($where_id)?",".$id_line:$id_line;
    
    							if($insert_subl =='ok'){
    								
    								$dateNow = date('Y-m-d H:i:s');
    								$sublineArr = array(
    										"mph_id" 	=> $id,
    										"mpl_id"	=> $id_line,
    										"sl_usend"	=> $params['user_send'][$keyid],
    										"sl_urecive" => $params['user_recive'][$keyid],
    										"sl_point"	=> $line['mpl_point'],
    										"sl_column"	=> $sl_column,
    										"sl_datetime" => $dateNow
    								);
    								$inssubline = $con->insert('eva_mipi_subline', $sublineArr);
    								
    							}
    						}
    					}
    					
    					if($where_id){
    						$where_del = "mpl_parent = '".$head['mpl_id']."' AND mph_id ='".$head_arr['mph_id']."' AND mpl_id NOT IN ($where_id)";
    						$sql ="DELETE FROM eva_mipi_line WHERE $where_del ";
    						$db->query($sql);
    					}
    				}
    			}else{
    				$head['mpl_subject'] = str_replace("\'","||",$head['mpl_subject']);
    				$dateNow = date('Y-m-d H:i:s');
    				$subjArr = array(
    						"mph_id"	=> $id,
    						"mpl_subject"	=> $head['mpl_subject'],
    						"mpl_type"	=> "S",
    						"mpl_datetime"	=> $dateNow,
    						"mpl_status"	=> "N",
    						"mpl_weight"	=> $head['mpl_weight']
    				);
    				
    				$inssubject = $con->insert('eva_mipi_line', $subjArr);
    				$id_parent = $con->lastInsertId();
    
    				if($head['line']){
    					foreach($head['line'] as $key4=>$item){
    						$item['mpl_subject'] = str_replace("\'","||",$item['mpl_subject']);
    						$dateNow = date('Y-m-d H:i:s');
    						$inlineArr = array(
    								"mph_id" 		=> $id,
    								"mpl_subject"	=> $item['mpl_subject'],
    								"mpl_weight"	=> $item['mpl_weight'],
    								"mpl_point_full"=> $item['mpl_point_full'],
    								"mpl_point"		=> $item['mpl_point'],
    								"mpl_type"		=> "D",
    								"mpl_parent"	=> $id_parent,
    								"mpl_datetime"	=> $dateNow,
    								"mpl_status"	=> "N"
    						);
    						
    						$inlineinserted = $con->insert('eva_mipi_line', $inlineArr);
    					}
    				}
    			}
    
    		}
    	}
    	if($pointScoll){
    		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
    		$auth 		= Zend_Auth :: getInstance();
    		$identity 	= $auth->getIdentity();
    		$inctArr 	= $rs->getIncentive();
    		$grade 		= $this->getGradeByScoll($pointScoll);
    		$incentive 	= $inctArr[$grade][$params['level_user'][$keyid]];
    		
    		$sql_g = "UPDATE eva_mipi_head SET mph_totalscoll = '$pointScoll',mph_grade = '$grade'" .
    		",mph_incentive = '".$incentive."',mph_level_now = '".$params['level_user'][$keyid]."' " .
    		"WHERE mph_id ='".$head_arr[mph_id]."'";
    		$db->query($sql_g);
    	}
    	return $id;
    }
    
    public function getUserCodeByEvaId($id=null)
    {
    	$rs 		= System_Controller::getModel('evaluate','systemapi');
    	$user_code 	= $rs->getUserByEvaId($id);
    	 
    	return $user_code;
    }
}