<?php
class Workflow_Report_Generic extends System_Db_Generic  {
	protected $gradeOp = array("A","B","C","F");
	public function GetSummaryGrade($month,$head_org){
		$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = "mph_status = 'F' and mph_month = '$month'";
    	if($head_org)
    		$where .= "and user_sec_depart IN ($head_org) ";
    	$result = $rs->GetSummaryGrade($where);
    	if($result){
    		foreach($result as $item){
    			$dataArr[] = $item["sumtotal"];
    		}
    	}
    	return $dataArr;
	}
	public function GetSummaryGradeInYear($year,$grade,$head_org){
		$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = "mph_status = 'F' and mph_month like '%".$year."' and mph_grade = '$grade'";
    	if($head_org)
    		$where .= "and user_sec_depart IN ($head_org) ";
	   	$result = $rs->GetSummaryGradeInYear($where);
	   	
    	if($result){
    		foreach($result as $item){
    			$dataArr[$key] = $item["sumtotal"];
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
	public function getGroupByHeader($head_org) {
    	$rs = System_Controller::getModel('member','systemapi');
    	$where = "org_sec_code IN ($head_org)";
    	$result = $rs->getGroupByHeader($where);
    	if($result){
    		foreach($result as $key=>$item){
    			$dataArr[$item[org_sec_code]] = $item[org_sec_code]." : ".$item[org_sec_name_th];
    		}
    	}
       return $dataArr;
    }
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
    public function getPosition($head_org){
    	$rs = System_Controller::getModel('member','systemapi');
    	$rs1 = System_Controller::getModel('position','systemapi');
    	if($head_org)
    		$where = "user_sec_depart IN ($head_org)";
    	$user = $rs->GetPositionUser($where);
    	if($user){
    		foreach($user as $u_pos){
    			$data_arr .=($data_arr)?",'".$u_pos["user_position"]."'":"'".$u_pos["user_position"]."'";
    		}
    		$where = "org_position_code IN ($data_arr)";
    	}
    	$result = $rs1->getPositionById($where);
    	if($result){
    		foreach($result as $key=>$item){
    			$dataArr[$item[org_position_code]] = $item[org_position_code]." : ".$item[org_position_name_th];
    		}
    	}
       return $dataArr;
    }
    public function GetDetailGrade($params,$head_org,&$userArr){
		$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = "mph_status = 'F' and mph_month = '".$params["month"]."' and mph_grade = '".$this->gradeOp[$params["grade"]]."' ";
    	if($head_org)
    		$where .= "and user_sec_depart IN ($head_org) ";
    	$result = $rs->GetDetailGrade($where);
    	if($result){
    		foreach($result as $item){
    			$dataArr[] = $item["mph_totalscoll"];
    			$userArr[] = $item["user_name"];
    		}
    	}
    	return $dataArr;
	}
	public function GetDetailDepart($field,$head_org,&$userArr){
		$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = "mph_status = 'F' and mph_month = '".$field["month"].$field["year"]."' ";
    	if($field["group"])
    		$where .= "and user_sec_depart = '".$field["group"]."' ";
    	if($head_org && !$field["group"])
    		$where .= "and user_sec_depart IN ($head_org) ";
    	$result = $rs->GetDetailGrade($where);
    	if($result){
    		foreach($result as $item){
    			$dataArr[] = $item["mph_totalscoll"];
    			$userArr[] = $item["user_name"];
    		}
    	}
    	return $dataArr;
	}
	public function GetDetailPosition($field,$head_org,&$userArr){
		$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = "mph_status = 'F' and mph_month = '".$field["month"].$field["year"]."' ";
    	if($field["group"])
    		$where .= "and user_position = '".$field["group"]."' ";
    	if($head_org && !$field["group"])
    		$where .= "and user_sec_depart IN ($head_org) ";
    	$result = $rs->GetDetailGrade($where);
    	if($result){
    		foreach($result as $item){
    			$dataArr[] = $item["mph_totalscoll"];
    			$userArr[] = $item["user_name"];
    		}
    	}
    	return $dataArr;
	}
	public function GetDetailByEmp($field){
		$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = "mph_status = 'F' and mph_month like '%".$field["year"]."' and mph_user = '".$field["emp"]."' ";
    	$result = $rs->GetDetailByEmp($where);
    	if($result){
    		foreach($result as $item){
    			$dataArr[] = $item["mph_totalscoll"];
    		}
    	}
    	return $dataArr;
	}
	public function GetEmployee($field){
		$rs = System_Controller::getModel('member','systemapi');
    	$where = "user_code = '".$field["emp"]."' ";
    	$result = $rs->GetEmployee($where);
    	return $result[0];
	}

	public function getEmpDataList($field,$yearNow,$head_org) {
    	$rs = System_Controller::getModel('member','systemapi');
   		if($field["group"])
    		$where = "user_sec_depart = '".$field["group"]."' ";
    	if($head_org && !$field["group"])
    		$where .= "user_sec_depart IN ($head_org) ";
    	$result = $rs->getUserPortal($where,'');
    	if($result){
    		foreach($result as $item){
    			$dataArr[$item["user_sec_depart"]]["department"] = $item["user_sec_depart"]." :: ".$item["org_sec_name_th"];
    			$dataArr[$item["user_sec_depart"]]["user"][$item["user_code"]] = $item;
    		}
    	}
        return $dataArr;
    }
	public function getDataGradeByType($type,$yearNow,$head_org){
    	$rs = System_Controller::getModel('evaluate','systemapi');
    	$where = "mph_type = '$type' and mph_month like '%".$yearNow."' and mph_status = 'F'";
    	if($head_org)
    		$where .= "and user_sec_depart IN ($head_org) ";

    	$result = $rs->getDataGradeByType($where);
    	if($result){
    		foreach($result as $key=>$item){
    			$item["mph_month"] = substr($item["mph_month"],0,2);
    			$dataArr[$item["mph_user"]][$item["mph_month"]] = $item ;
    		}
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
	
	/*
	 * Add new function 
	 * #natcha 06 Jun 2014.
	 * for evaluate in 2014.
	 */
	public function GetSummaryGradeInYear2014($year,$grade,$head_org){
		$rs = System_Controller::getModel('evaluate','systemapi');
		$where = "mph_status = 'F' and mph_month like '%".$year."' and mph_grade = '$grade'";
		if($head_org)
			$where .= "and user_sec_depart IN ($head_org) ";
		$result = $rs->GetSummaryGradeInYear($where);
		 
		// Check used new grade in year Mar 2014. #natcha
		if($year >= 2014) {
			$key = 2;
		} else {
			$key = 0;
		}
		if($result){
			$j = 0;
			for($i=$key; $i<13; $i++) {
				$dataArr[$i] = $result[$j]['sumtotal'];
				$j++;
			}
		}
		return $dataArr;
	}
	
	public function GetSummaryGrade2014($month,$head_org){
		$apiGeneric = System_Controller::getModel('grade','systemapi');
		$gradeOpt 	= array();
		$gradeOpt 	= $apiGeneric->getGradeMST2('DESC');
		
		$rs = System_Controller::getModel('evaluate','systemapi');
		$where = "mph_status = 'F' and mph_month = '$month'";
		
		if($head_org) {
			$where .= "and user_sec_depart IN ($head_org) ";
		}
		$result = $rs->GetSummaryGrade($where);
		$dataArr = array();
		if($result){
			foreach($gradeOpt as $key => $val) {
				$grades[$val['grade']] = 0;
			}
			
			foreach($result as $item) {
				$rows[$item['mph_grade']] = $item['sumtotal'];
			}
			$dataArray = array_merge((array)$grades, (array)$rows);
			foreach($dataArray as $data) {
				$dataArr[] = $data;
			}
		}
		
		return $dataArr;
	}
	
	/*
	* have on head pi only.
	* natcharee@icesolution.com
	* 2014 Aug 28
	*/
	public function getYearOptions()
	{
		$rs = System_Controller::getModel('master','systemapi');
		
		$data = $rs->getApiYearOptions();
		$temp = $result = array();
		if( !empty($data) ) {
			foreach($data as $key => $item) {
				$year = explode('-', $item['mph_createdate']);
				$temp[] = $year[0];
			}
		}
		
		$current[] = date('Y');
		$temp = array_merge($temp, $current);
		if( !empty($temp) ) {
			foreach($temp as $key => $item) {
				$result[$item] = $item;
			}
		}
		
		return $result;
	}
}