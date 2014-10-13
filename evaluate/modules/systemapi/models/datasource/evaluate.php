<?php
class Systemapi_evaluate_Table extends Zend_Db_Table {
    protected $_name = 'eva_mipi_head';

	public function getEvaluateMIPI($type){
		$select = $this->_db->select()
     				   ->from(array ("head" =>"{$this->_name}"), array('*'))
     				   ->where("mph_type =?",$type)
    				   ->order("mph_id");

     	$rs = $select->query();
        $rows = $rs->fetchAll();

        return $rows;
	}
	public function GetUserByFirstRecive($where){
		$select = $this->_db->select()
     				   ->from(array ("head" =>"{$this->_name}"), array('mph_user'))
     				   ->where($where)
     				   ->group("mph_user")
    				   ->order("mph_user");

     	$rs = $select->query();
        $rows = $rs->fetchAll();

        return $rows;
	}
	
	public function ChkInsertDup($where){
		$select = $this->_db->select()
     				   ->from(array ("head" =>"{$this->_name}"), array('*'))
     				   ->where($where)
    				   ->order("mph_id");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getEvaluateHead($where){
		$select = $this->_db->select()
     				   ->from(array ("head" =>"{$this->_name}"), array('*'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = head.mph_user",array('user_name','user_lname','user_sec_depart','user_position','user_start_mi','user_start_pi'))
     				   ->joinLeft(array ("u1" =>"user"),"u1.user_code = head.user_first_recive",array('user_name as first_recive'))
     				   ->joinLeft(array ("p" =>"org_position"),"p.org_position_code = u.user_position",array('org_position_level'))
     				   ->where($where)
     				   //->where("u.user_active = 'Y'")
    				   ->order("mph_id");
    				   //_print($select->__toString());exit;
     	$rs = $select->query();
        $rows = $rs->fetchAll();

        return $rows;
	}
	public function getDataGradeByType($where){
		$select = $this->_db->select()
     				   ->from(array ("h" =>"{$this->_name}"), array('mph_user','mph_month','mph_totalscoll','mph_grade'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = h.mph_user",array('user_sec_depart'))
     				   ->where($where)
    				   ->order("mph_id");
      	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getEvaluateMaster($where){
		$select = $this->_db->select()
     				   ->from(array ("head" =>"{$this->_name}"), array('*'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = head.mph_user",array('user_name','user_sec_depart','user_position','user_start_mi','user_start_pi'))
    				   ->joinLeft(array ("p" =>"org_position"),"p.org_position_code = u.user_position",array('org_position_level'))
     				   ->where($where)
    				   ->order("org_position_level DESC")
    				   ->order("user_code");
    				  // _print($select->__toString());//exit;
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getEvaluateLineMaster($mph_id){
		$select = $this->_db->select()
     				   ->from(array ("m" =>"eva_mipi_line"), array('*'))
     				   ->joinLeft(array ("h" =>"{$this->_name}"),"h.mph_id = m.mph_id",array('mph_user'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = h.mph_user",array('user_sec_depart'))
     				   ->where("m.mph_id = '$mph_id'")
    				   ->order("m.mpl_parent")
    				   ->order("m.mpl_id");
    				   //_print($select->__toString());exit;
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        if($rows){
        	foreach($rows as $data){
        		if($data["mpl_parent"]>0){
        			$dataArr[$data["user_sec_depart"]][$data["mph_user"]]["detail"][$data["mpl_parent"]]["total"] += ($data["mpl_weight"]*$data["mpl_point"]);
        		}else{
         			$dataArr[$data["user_sec_depart"]][$data["mph_user"]]["head"][$data["mpl_id"]]["code"]=$data["mpl_id"];
         			$dataArr[$data["user_sec_depart"]][$data["mph_user"]]["head"][$data["mpl_id"]]["subject"]=$data["mpl_subject"];
         			$dataArr[$data["user_sec_depart"]][$data["mph_user"]]["head"][$data["mpl_id"]]["weight"]=$data["mpl_weight"];
        		}
        	}
        }

        return $dataArr;
	}
	public function getEvaluateViewUser($where){
		$select = $this->_db->select()
     				   ->from(array ("head" =>"{$this->_name}"), array('*'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = head.mph_user",array('user_name','user_lname'))
     				   ->joinLeft(array ("u1" =>"user"),"u1.user_code = head.user_send",array('user_name as user_sendname'))
     				   ->where($where)
    				   ->order("mph_month");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getEvalHeadTotal($where){
		$select = $this->_db->select()
     				   ->from(array ("head" =>"{$this->_name}"), array('mph_id','mph_user','mph_month','mph_user_flow','mph_type','count(mph_id) as total'))
     				   ->where($where)
     				   ->group("mph_type")
    				   ->order("mph_type");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        if($rows){
	        foreach($rows as $item){
	        	$dataArr[$item[mph_type]]= $item;
	  	    }
        }
        return $dataArr;
	}
	public function getEvalHeadWorklistTotal($where){
		$select = $this->_db->select()
     				   ->from(array ("head" =>"{$this->_name}"), array('mph_user_flow','mph_type','mph_status','count(mph_id) as total'))
     				   ->where($where)
     				   ->group("mph_status")
    				   ->order("mph_type");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        if($rows){
	        foreach($rows as $item){
	        	//$dataArr = $item;
	     		//$dataArr[$item[mph_status]] = $item[total];
	     		$dataArr[data][mph_user_flow] = $item[mph_user_flow];
	     		$dataArr[data][mph_type] = $item[mph_type];
	     		$dataArr[$item[mph_status]] = $item[total];
	  	    }

        }

        return $dataArr;
	}
	public function getEvaluateLine($where){
		$select = $this->_db->select()
     				   ->from(array ("line" =>"eva_mipi_line"), array('*'))
     				   ->where($where)
    				   ->order("mpl_id");
// _print($select->__toString());exit;
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        if($rows){
	        foreach($rows as $item){
	        	$dataArr[$item[mpl_id]] = $item;
	        }
        }
        return $dataArr;
	}
	public function GetColumnSubline($where){
		$select = $this->_db->select()
     				   ->from("eva_mipi_subline", array('MAX(sl_id) as sl_id',"sl_column"))
     				   ->where($where)
     				   ->group("sl_id")
    				   ->order("sl_id DESC")
    				   ->limit("1");
	//_print($select->__toString());exit;
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function GetColumnSublineINID($where){
		$select = $this->_db->select()
     				   ->from("eva_mipi_subline", array('MAX(sl_id) as sl_id',"sl_column","mph_id"))
     				   ->where($where)
     				   ->group("mph_id")
    				   ->order("sl_id DESC");
// _print($select->__toString());//exit;
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getDataPILine($where){
		$select = $this->_db->select()
     				   ->from(array ("line" =>"eva_mipi_line"), array('*'))
     				   ->where($where)
    				   ->order("mpl_id");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function getDataSubLine($where){
		$select = $this->_db->select()
     				   ->from(array ("subl" =>"eva_mipi_subline"), array('*'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = subl.sl_usend",array('user_name'))
     				   ->where($where)
    				   ->order("sl_id");

     	$rs = $select->query();
        $rows = $rs->fetchAll();

        return $rows;
	}
	public function GetDataMaster($where){
		$select = $this->_db->select()
     				   ->from(array ("h" =>"{$this->_name}"), array('*'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = h.mph_user_flow",array('user_name'))
     				   ->joinLeft(array ("o" =>"user"),"o.user_code = h.mph_user",array('user_name as user_name_owner'))
     				   ->where($where)
    				   ->order("mph_type")
    				   ->order("mph_month");
     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function GetDataMasterPage($where,$start,$perpage){
		$select = $this->_db->select()
     				   ->from(array ("h" =>"{$this->_name}"), array('*'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = h.mph_user_flow",array('user_name'))
     				   ->joinLeft(array ("o" =>"user"),"o.user_code = h.mph_user",array('user_name as user_name_owner'));
        $select2 = $this->_db->select()
                  			->from(array ("h" => "{$this->_name}"), "COUNT(*)");
        if($where){
			$select->where($where);
			$select2->where($where);
		}

        $select->order("mph_type");
        $select->order("mph_month");
        $select->limitPage($start,$perpage);
       // _print($select->__toString());//exit;
        $dataArray   = $select->query()->fetchAll();
        $totalRecord = $this->_db->fetchOne($select2);

        $select = $select2 = null;
       return array('data'=>$dataArray,'total'=>$totalRecord);

	}
	public function GetSubLine($where){
		$select = $this->_db->select()
     				   ->from(array ("s" =>"eva_mipi_subline"), array('*'))
     				   ->where($where)
     				   ->order("sl_id");
    	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function GetSummaryGrade($where){
		$select = $this->_db->select()
     				   ->from(array ("h" =>"eva_mipi_head"), array('COUNT(mph_grade) as sumtotal','mph_month','mph_grade'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = h.mph_user",array('user_sec_depart'))
    				   ->where($where)
    				   ->group("mph_grade")
    				   ->order("mph_grade");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function GetSummaryGradeInYear($where) {
		$select = $this->_db->select()
     				   ->from(array ("h" =>"eva_mipi_head"), array('COUNT(mph_grade) as sumtotal','mph_month','mph_grade'))
    				   ->joinLeft(array ("u" =>"user"),"u.user_code = h.mph_user",array('user_sec_depart'))
    				   ->where($where)
    				   ->group("mph_month")
    				   ->order("mph_month");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function GetDetailGrade($where){
		$select = $this->_db->select()
     				   ->from(array ("h" =>"eva_mipi_head"), array('mph_user','mph_totalscoll'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = h.mph_user",array('user_name','user_sec_depart','user_position'))
    				   ->where($where)
      				   ->order("user_name");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function GetDetailByEmp($where){
		$select = $this->_db->select()
     				   ->from(array ("h" =>"eva_mipi_head"), array('mph_user','mph_totalscoll'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = h.mph_user",array('user_name','user_sec_depart','user_position'))
    				   ->where($where)
      				   ->order("mph_month");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
	}
	public function GetDetailDepart($where){
		$select = $this->_db->select()
     				   ->from(array ("h" =>"eva_mipi_head"), array('mph_user','mph_totalscoll'))
     				   ->joinLeft(array ("u" =>"user"),"u.user_code = h.mph_user",array('user_name'))
    				   ->where($where)
      				   ->order("user_name");

     	$rs = $select->query();
        $rows = $rs->fetchAll();
        return $rows;
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
	public function GetDataMasterNoPage($where){
		$select = $this->_db->select()
		->from(array ("h" =>"{$this->_name}"), array('*'))
		->joinLeft(array ("u" =>"user"),"u.user_code = h.mph_user_flow",array('user_name'))
		->joinLeft(array ("o" =>"user"),"o.user_code = h.mph_user",array('user_name as user_name_owner',"user_sec_depart"));

		if($where){
			$select->where($where);
// 			$select2->where($where);
		}
	
		$select->order("mph_type");
		$select->order("mph_month");
		
// 		$select->limitPage($start,$perpage);
// 		_print($select->__toString());exit;
		$dataArray   = $select->query()->fetchAll();
// 		$totalRecord = $this->_db->fetchOne($select2);
		$totalRecord=0;
	
		$select = $select2 = null;
		return array('data'=>$dataArray,'total'=>$totalRecord);
	}
	
	public function getEvaluateSubLineLastApprove($where, $max){
		
		$select = $this->_db->select()
					->from(array ("m" =>"eva_mipi_subline"), array('*'))
					->where($where)
					->where("sl_column = " . $max)
					->order("m.mpl_id");
// 		_print($select->__toString());exit;
		$rs = $select->query();
		$rows = $rs->fetchAll();
// 		_print($rows);exit;
		if($rows){
			foreach($rows as $data){
				$dataArr[] =  $data;
			}
		}
	
		return $rows;
	}
	
	public function getSummaryBadge($date) {
		$casewhen = array("SUM(CASE WHEN mph_status = 'F' THEN 1 ELSE 0 END) AS Final, SUM(CASE WHEN mph_status != 'F' THEN 1 ELSE 0 END) AS Unfinal");
		$select = $this->_db->select() 
					->from(array("m" => "eva_mipi_head"), $casewhen) ;
		if(!empty($date)) {
			$select->where("m.mph_month = " . $date);
		}
		$rs = $select->query();
		$results = $rs->fetchAll();
		
		return $results;
	}
	
	public function getMaxSublineApprove($where) {
		$select = $this->_db->select()
					->from(array ("m" => "eva_mipi_subline"), array("MAX(sl_column)"))
					->where($where);
		
		$rs = $select->query();
		$results = $rs->fetchColumn();

		return $results;
	}
	
	public function getEvaluateHeadByMonth($where='1', $type='PI')
	{
		$select = $this->_db->select()
					->from(array ("head" =>"{$this->_name}"), array('*'))
					->where($where)
					->where("mph_type =?",$type)
					->order("mph_id");
	
		$rs = $select->query();
// 		_print($select->__toString());exit;
		$rows = $rs->fetchAll();
	
		return $rows;
	}
	
	public function getUserByEvaId($id=null)
	{
		if(empty($id)) { return false; }
	
		$db 	= $this->_db;
		$select	= $db->select()
		->from(array("e" => "eva_mipi_head"), array("mph_user"))
		->where("mph_id = '" . $id . "'");
	
		$rs = $select->query();
		$row = $rs->fetchAll();
	
		return $row[0]['mph_user'];
	}
}