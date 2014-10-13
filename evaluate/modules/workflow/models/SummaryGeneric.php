<?php
class Workflow_Summary_Generic extends System_Db_Generic  {
	public function getGroupBUList() {
    	$rs = System_Controller::getModel('member','systemapi');
    	$result = $rs->getGroupBUList();
    	if($result){
    		foreach($result as $key=>$item){
    			$dataArr[$item[org_sec_code]] = $item[org_sec_code]." : ".$item[org_sec_name_th];
    		}
    	}
       return $dataArr;
    }
    public function getUserAccept2($params,$user_Array) {
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
	public function getUserAccept($params) {
    	$rs = System_Controller::getModel('member','systemapi');

    	if($params[group])
    		$where = "user_sec_depart IN (".$params[group].") ";
    		
		if($params[head_org] && !$params[first_recive])
			$where .= ($where)?" AND user_sec_depart IN (".$params[head_org].") ":"user_sec_depart IN (".$params[head_org].")";
		if($params[head_org] && $params[first_recive])
			$where .= ($where)?" AND (user_sec_depart IN (".$params[head_org].") OR user_code IN (".$params[first_recive].") )":"( user_sec_depart IN (".$params[head_org].") OR user_code IN (".$params[first_recive].") )";
		if(!$params[head_org] && $params[first_recive])
			$where .= ($where)?" AND user_code IN (".$params[first_recive].")":" user_code IN (".$params[first_recive].") ";    		    		
    	if($params["not_user"])
   			$where .= ($where)?" AND user_code != '".$params["not_user"]."'":"user_code != '".$params["not_user"]."'";

   			$result = $rs->getUserAccept($where,'');

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
    	$where = "user_header IN ($user_code) AND org_sec_status = 'Y' ";
    	$result = $rs->GetOrgByCode($where);
    	if($result){
    		foreach($result as $item){
    			$dataArr .= ($dataArr)?",".$item["org_sec_code"]:$item["org_sec_code"];
    		}
    	}
    	return $dataArr;
    }
    public function GetUserByFirstRecive($user_code,$_year){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$mm = $params['search']['month']."".$params['search']['year'];
    	$where = " user_first_recive IN ($user_code) ";
    	if($_year)
    		$where .= ($where)?" AND mph_month = '".$_year."' ":"mph_month = '".$_year."'";
 
    	$result = $rs->GetUserByFirstRecive($where);
    	
    	if($result){
    		foreach($result as $item){
    			$dataArr .= ($dataArr)?",".$item["mph_user"]:$item["mph_user"];
    		}
    	}
    	return $dataArr;
    }
    public function getSendDelay($year,$group,$type,$status,$head_org){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = "mph_month LIKE '%$year' and mph_type = '$type' and mph_status = '$status' ";
    	if($group)
    		$where .= ($where)?" and user_sec_depart = '".$group."' ":"user_sec_depart = '".$group."'";
    	if($head_org)
			$where .= ($where)?" and user_sec_depart IN (".$head_org.") ":"user_sec_depart IN (".$head_org.")";
		$result = $rs->getEvaluateMaster($where);
    	if($result){
    		foreach($result as $key=>$item){
    			$dataArr[$item["mph_user"]][$item["mph_month"]] = $item ;
    		}
    	}
        return $dataArr;
    }
	public function getEmpByTypeNew($type,$first_recive){
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
    public function getEmpByType($type){
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
    public function getGradeData (){
    	$rs = System_Controller::getModel('master','systemapi');
    	$result = $rs->getGradeData();
    	if($result){
    		foreach($result as $key=>$item){
    			$dataArr[$item[grade]] = $item[grade] ;
    		}
    	}
    	return $dataArr;
    }
    public function getGradeByScoll($pointScoll){
		$rs = System_Controller::getModel('master','systemapi');
		$where = "start_scoll <='$pointScoll' and end_scoll >= '$pointScoll'";
		$result = $rs->getGradeByScoll($where);
		return $result[0][grade];
	}
    public function getSumIncentivePI($group,$month,$type,$status,&$dataInc,&$userAll,$head_org,$not_user){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$rs_l = System_Controller::getModel('level','systemapi');
    	$where = "mph_month LIKE '%$month' and mph_type = '$type' and mph_status = '$status' ";//and user_code ='1531017'
		if($group && $where)
    		$where .= "and user_sec_depart = '".$group."'";
		if($head_org)
			$where .= ($where)?" and user_sec_depart IN (".$head_org.") ":"user_sec_depart IN (".$head_org.")";
    	if($not_user)
    		$where .= ($where)?" and user_code != '".$not_user."'":"user_code != '".$not_user."'";

    	$result = $rs->getEvaluateMaster($where);
    	$incentive = $rs_l->getIncentive();
    	$myNow = substr($month,-4)."".sprintf("%02d",substr($month,0,2));
    	if($group)
    		$where_g = "user_sec_depart = '".$group."'";
    	if($head_org)
			$where_g .= ($where_g)?" and user_sec_depart IN (".$head_org.") ":"user_sec_depart IN (".$head_org.")";
    	if($not_user)
    		$where_g .= ($where_g)?" and user_code != '".$not_user."'":"user_code != '".$not_user."'";

    	$count_user = $rs_l->getCountUser($where_g,'');
    	if($result){
    		foreach($result as $key=>$item){

				$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]]["total"] += $item["mph_totalscoll"]*1;
				$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]]["num"] += 1;
				$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]][$item["mph_month"]] = $item["mph_totalscoll"];
    		}
    	}
    //	_print($dataArr);
    	if($count_user){
			$userAll = array_sum($count_user);
		}
        return $dataArr;
    }
	public function getAcceptIncentivePI($group,$month,$type,$status,&$dataInc,&$userAll,$head_org,$not_user,$first_recive=null){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$rs_l = System_Controller::getModel('level','systemapi');
    	$where = "mph_month = '$month' AND mph_type = '$type' AND mph_status = '$status'";//and user_code ='1541010'
	
		if($group && $where)
    		$where .= "AND user_sec_depart = '".$group."'";
		if($head_org && !$first_recive)
			$where .= ($where)?" AND user_sec_depart IN (".$head_org.") ":"user_sec_depart IN (".$head_org.")";
		if($head_org && $first_recive)
			$where .= ($where)?" AND (user_sec_depart IN (".$head_org.") OR mph_user IN (".$first_recive.") )":"( user_sec_depart IN (".$head_org.") OR mph_user IN (".$first_recive.") )";
		if(!$head_org && $first_recive)
			$where .= ($where)?" AND mph_user IN (".$first_recive.")":" mph_user IN (".$first_recive.") ";    		    				
	   	if($not_user)
    		$where .= ($where)?" AND user_code != '".$not_user."'":"user_code != '".$not_user."'";

    	$result = $rs->getEvaluateMaster($where);
    	
    	$incentive = $rs_l->getIncentive();
    	$myNow = substr($month,-4)."".sprintf("%02d",substr($month,0,2));
    	if($group)
    		$where_g = "user_sec_depart = '".$group."'";
    	if($head_org && !$first_recive)
			$where_g .= ($where_g)?" AND user_sec_depart IN (".$head_org.") ":"user_sec_depart IN (".$head_org.")";					
		if($head_org && $first_recive)
			$where_g .= ($where_g)?"AND (user_sec_depart IN (".$head_org.") OR user_code IN (".$first_recive.") )":"(user_sec_depart IN (".$head_org.") OR user_code IN (".$first_recive.") )";
		if(!$head_org && $first_recive)
			$where_g .= ($where_g)?" AND user_code IN (".$first_recive.")":" user_code IN (".$first_recive.") ";	
						
    	if($not_user)
    		$where_g .= ($where_g)?" AND user_code != '".$not_user."'":"user_code != '".$not_user."'";

    	$count_user = $rs_l->getCountUser($where_g,'');

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
    			//$dataArr["data"][$item["mph_user"]]["diff_scoll"] = $item["mph_totalscoll"]-$dataInc[$item["user_sec_depart"]]["average_scoll"];
    			$dataArr["data"][$item["user_sec_depart"]]["total"] = $dataInc[$item["user_sec_depart"]]["average_scoll"] ;
				$dataArr["endflow"] = $item["mph_eflow"];
				if($type == 'PI'){   			
	    			if($item["user_start_pi"]){
	    				$date_pi = explode("-",$item["user_start_pi"]);
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
	    			}//else{
	    			//	$dataInc[$item["user_sec_depart"]]["sum_incentive"] += $item["mph_incentive"];
	    			//	$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]]["incentive"] = $item["mph_incentive"];	    				
	    			//}
				}
    		}
    	}
    	
    	if($count_user){
			$userAll = array_sum($count_user);
		}
        return $dataArr;
    }
    public function getAcceptIncentivePI_AVG($group,$month,$type,$status,&$dataInc,&$userAll,$head_org,$not_user){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$rs_l = System_Controller::getModel('level','systemapi');
    	$where = "mph_month = '$month' and mph_type = '$type' and mph_status = '$status' ";
		if($group && $where)
    		$where .= "and user_sec_depart = '".$group."'";
		if($head_org)
			$where .= ($where)?" and user_sec_depart IN (".$head_org.") ":"user_sec_depart IN (".$head_org.")";
    	if($not_user)
    		$where .= ($where)?" and user_code != '".$not_user."'":"user_code != '".$not_user."'";

    	$result = $rs->getEvaluateMaster($where);
    	$incentive = $rs_l->getIncentive();
    	$myNow = substr($month,-4)."".sprintf("%02d",substr($month,0,2));
    	if($group)
    		$where_g = "user_sec_depart = '".$group."'";
    	if($head_org)
			$where_g .= ($where_g)?" and user_sec_depart IN (".$head_org.") ":"user_sec_depart IN (".$head_org.")";
    	if($not_user)
    		$where_g .= ($where_g)?" and user_code != '".$not_user."'":"user_code != '".$not_user."'";

    	$count_user = $rs_l->getCountUser($where_g,'');
    	if($result){
    		foreach($result as $key=>$item){
				$line_arr = $rs->getEvaluateLineMaster($item["mph_id"]);
				if($line_arr){
					foreach($line_arr as $key1=>$item2_arr){
						foreach($item2_arr as $key2=>$item2){
							foreach($item2["head"] as $key3=>$item3){
								$new_arr[$key1][$key2][$item3["subject"]] = $item2["detail"][$key3]["total"];
							}
						}
					}

				}

    		}
    //_print($new_arr);
    	}
    	if($count_user){
			$userAll = array_sum($count_user);
		}
        return $new_arr;
    }
    public function getAcceptIncentive($group,$month,$type,$status,&$dataInc,&$userAll,$head_org,$not_user){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$rs_l = System_Controller::getModel('level','systemapi');
    	$where = "mph_month = '$month' and mph_type = '$type' and mph_status = '$status' ";
		if($group && $where)
    		$where .= "and user_sec_depart = '".$group."'";
		if($head_org)
			$where .= ($where)?" and user_sec_depart IN (".$head_org.") ":"user_sec_depart IN (".$head_org.")";
    	if($not_user)
    		$where .= ($where)?" and user_code != '".$not_user."'":"user_code != '".$not_user."'";

    	$result = $rs->getEvaluateMaster($where);
    	$incentive = $rs_l->getIncentive();
    	$myNow = substr($month,-4)."".sprintf("%02d",substr($month,0,2));

    	if($group)
    		$where_g = "user_sec_depart = '".$group."'";
    	if($head_org)
			$where_g .= ($where_g)?" and user_sec_depart IN (".$head_org.") ":"user_sec_depart IN (".$head_org.")";
    	if($not_user)
    		$where_g .= ($where_g)?" and user_code != '".$not_user."'":"user_code != '".$not_user."'";

    	$count_user = $rs_l->getCountUser($where_g,'');
    	if($result){
    		foreach($result as $key=>$item){

    			$dataInc[$item["user_sec_depart"]]["sum_scoll"] += $item["mph_totalscoll"];
    			$dataInc[$item["user_sec_depart"]]["count_user"] = $count_user[$item["user_sec_depart"]];
    			$dataInc[$item["user_sec_depart"]]["average_scoll"] = $dataInc[$item["user_sec_depart"]]["sum_scoll"]/$count_user[$item["user_sec_depart"]];

				$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]] = $item ;
				$dataArr["data"][$item["user_sec_depart"]][$item["mph_user"]]["incentive"] = $incentive[$item["mph_grade"]][$item["org_position_level"]];
    			$dataArr["data"][$item["user_sec_depart"]]["total"] = $dataInc[$item["user_sec_depart"]]["average_scoll"] ;
				$dataArr["endflow"] = $item["mph_eflow"];

				if($type == 'MI'){
	    			if($item["user_start_mi"]){
	    				$date_pi = explode("-",$item["user_start_mi"]);
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
	    			}
				}
    		}
    	}
    	if($count_user){
			$userAll = array_sum($count_user);
		}
        return $dataArr;
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
	
	public function getAllEvaByMonth($params=array()) {
		
		if(empty($params)) { return; }
		$results = array();
		
		$evaapi = System_Controller::getModel('evaluate','systemapi');
    	$levapi = System_Controller::getModel('level','systemapi');
    	
    	$where = "mph_month = '" . $params['month'].$params['year'] . "' AND mph_status = 'F'";
    	$results = $evaapi->getEvaluateHeadByMonth($where, $params['type']);
    	
    	return $results;
	}
	
	public function updateSyncEvaluation($params=array()) 
	{
		$con = Zend_Registry :: get("db");
		$db = $con->getConnection();
		
		$tbl = "eva_mipi_head";
		foreach($params as $item){
			$where = "mph_id = '" . $item['mph_id'] . "' ";
			$con->update($tbl, $item, $where);
		}
		
		return true;
	}

}