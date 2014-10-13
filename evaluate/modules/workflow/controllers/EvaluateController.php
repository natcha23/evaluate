<?php
/**
 *  This is the main controller of the Application. If the user enters
 *  the domain of the site, this is the controller they are routed to.
 **/
require(BIZWARE_HOME."/libs/phpmailer/class.phpmailer.php");
if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');
class Workflow_EvaluateController extends Workflow_Controller_Flow_Action {
	protected $monthOp = array('01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน',
							   '07'=>'กรกฎาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
	protected $quarterOp = array('Q1'=>'Quarter 1','Q2'=>'Quarter 2','Q3'=>'Quarter 3','Q4'=>'Quarter 4');
	protected $column;
	protected $sumIncentive;
	protected $user_col;
	protected $per_page = "20";
	//protected $org_arr = "931,932,940,941,942";
	//protected $org_arr = "400,410,411,412,413,420,421,422,430,431,432,440,441,442";
	protected $org_arr = "310,311";
	
	protected $lookup_authen = array("AM", ""); 
	
	private function prepareUrl(){
    	return $this->getRequest()->getRequestUri();
    }
   
    public function indexAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $data[headPage] = "Evaluate Master";
        $data["rows"] = $cat->getEvaluateMST($params,$params["page"],$this->per_page);
        $data["keyword"] = $params["keyword"];
        $data[mId] = $params['menu_id'];
   		/*$data["rows"] = $rows["data"];
   		$data["totalRecord"] = $rows["total"];
        $data["perpage"]     = $this->per_page;
        $data["page"]  = $params["page"]?$params["page"]:1;
        $data["url"]  = $this->prepareUrl();*/

        $view->assign('', $data);
    	$view->output('index.tpl');
    }

    public function evalmstAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $data[headPage] = "Evaluate Master";
   		$data[typeOp] = $cat->getTypeOp();
        $data[rows] = $cat->getEvaluateMSTById($params);
   		$data[mId] = $params['menu_id'];
   		$data[mode] = $params['mode'];
   		$data[parId] = $params[parId];
   		$data[level] = $params[level];
		$pageUrl = "workflow/evaluate/index/menu_id/{$params[menu_id]}";
   		$data[pageUrl] = $pageUrl;

   		if($params[save]){
   			$id_key = $params[fields][mst_eva_id];
			if($params[parId]){
   				$params[fields][mst_eva_parent] = $params[parId];
				$params[fields][mst_eva_level] = 2;
				$params[fields][mst_eva_type] = $params[type];
			}
			if(!$id_key)
	        	$params[fields][datetime] = date('Y-m-d H:i:s');

	        $params[fields][updatetime] = date('Y-m-d H:i:s');
	        $params[fields][user_create] = $identity->user_code;
	        $id = $cat->saveMaster('master_evaluate','mst_eva_id',$id_key,$params);
	        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Evaluate Master Management","Save");
			$this->_redirect("$pageUrl");
   		}

        $view->assign('', $data);
    	$view->output('mstform.tpl');
    }


    public function portalAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
        $m = date("m");
        $yearPrev = date('Y')-1;
        $year = date('Y');
        $yearNext = date('Y')+1;
        $data["yearOp"] = array($yearPrev=>$yearPrev,$year=>$year,$yearNext=>$yearNext);

		if($m >= '01' && $m <= '03'){
			$mQuarter = 'Q1';
		}elseif($m >= '04' && $m <= '06'){
			$mQuarter = 'Q2';
		}elseif($m >= '07' && $m <= '09'){
			$mQuarter = 'Q3';
		}elseif($m >= '10' && $m <= '12'){
			$mQuarter = 'Q4';
		}
		if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			$data["head_org"] = "Y";
			if($identity->level == '11'){
				$org = $cat->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params[head_org] = $org;
			}else{
				$org = $cat->GetOrgByCode($identity->user_code);
				if($org)$params[head_org] = $org; else $params[head_org] = $identity->user_sec_depart;
			}
			$data["group"] = $identity->user_sec_depart;
		}elseif($identity->user_header =='N' && $identity->lookup_code != 'AM' && $identity->level < 12){
			$data["head_org"] = "Y";
			$params["user_view"] = $identity->user_code;
			$data["group"] = $identity->user_sec_depart;
		}else{
			$data["group"] = $params["group"];
		}
        $data["headPage"] = "Process Status Portal";
        $data["groupBUOp"] = $cat->getGroupBUList();
        $data["levelOp"] = $cat->getLevelOp();
        $data["typeOp"] = $cat->getTypeOp();
        $data["dataArr"] = $cat->getUserPortal($params,'');
		//$data["userArr"] = $cat->getUserListWhere($params);

		if($params["fields"]["type"]=='PI' || !$params["fields"]["type"]){
			$data["typenow"] = 'PI';
			if(!$params["fields"]["type"]){
				if($m=='1') $data["monthNow"] = '12'; else $data["monthNow"] = sprintf("%02d",$m-1);
			}else{
				$data["monthNow"] = $params["fields"]["month"];
			}
			$params["fields"]["type"]=='PI';
		}else{
			$data["typenow"] = 'MI';
			if(!$params["fields"]["month"])
				$data["monthNow"] = $mQuarter;
			else
				$data["monthNow"] = $params["fields"]["quarter"];
			$params["fields"]["type"]=='MI';
		}

		if(!$params["fields"]["year"])
        	$data["yearNow"] = date('Y');
        else
        	$data["yearNow"] = $params["fields"]["year"];

		$where["year"] = $data["yearNow"];
		$where["type"] = $data["typenow"];
		$where["month"] = $data["monthNow"];

		$data["quarterOp"] = $this->quarterOp;
		$data["monthOp"] = $this->monthOp;
		$data["stepArr"] = $cat->getStepEvadata($where);

		$data["page"] = $params["page"];
		$data["show"] = $params["show"];
		$data["form_id"] = $params["form_id"];
		$data["form_type"] = $params["form_type"];

        $view->assign('', $data);
    	$view->output('summary/portal.tpl');
    }
   public function summaryAction(){
   		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
        $data[headPage] = "Summary Incentive";
        $data[groupBUOp] = $cat->getGroupBUList();
        $data[levelOp] = $cat->getLevelOp();
        $data[typeOp] = $cat->getTypeOp();

		if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			$data["head_org"] = "Y";
			if($identity->level == '11'){//|| $identity->level == '10'
				$org = $cat->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params[head_org] = $org;
			}else{
				$org = $cat->GetOrgByCode($identity->user_code);
				if($org)$params[head_org] = $org; else $params[head_org] = $identity->user_sec_depart;
			}
			$params["not_user"] = $identity->user_code;
			$data["group"] = $identity->user_sec_depart;
		}else{
			$data["group"] = $params["group"];
		}
		$data["dataArr"] = $cat->getUserPortal($params,'');
		if($params[typeEva]=='PI' || !$params[typeEva]){
			$n = 1;
			for($i=0;$i<5;$i++){
				$m = date("m")-4;
				$y = date("Y");
				if($m <= 12){
					$num = $m+$i;
					$year = $y;
					$m++;
					if($num > 12) {
						$num = $n;
						$year = $y+1;
						$n++;
					}
					$l = 12+$num;
					if($num < 1) {
						$num = $l;
						$year = $y-1;
						$l--;
					}
				}
				$yearN = sprintf("%02d",$year);
				$numM = sprintf("%02d",$num);
				$key = $numM."".$yearN;
				$month[$key] = $this->monthOp[$numM]." : ".$yearN;
			}


			/*for($i=0;$i<5;$i++){
				$m = date("m")-4;
				$y = date("Y");
				if($m <= 12){
					$num = $m+$i;
					$year = $y;
					$m++;
					if($num > 12) {
						$num = $n;
						$year = $y+1;
						$n++;
					}
				}
				$yearN = sprintf("%02d",$year);
				$numM = sprintf("%02d",$num);
				$key = $numM."".$yearN;
				$month[$key] = $this->monthOp[$numM]." : ".$yearN;
			}*/

			$data[typePage]= "PI";
			if(date("m")=='1') $data[month] = '12'; else $data[month] = sprintf("%02d",date("m")-1);
		}else{
			$m = date("m");
			if($m >= '01' && $m <= '03'){
				$mN = 'Q1';
				$mOp = array("Q2"=>"2","Q3"=>"3","Q4"=>"4","Q1"=>"1");
			}elseif($m >= '04' && $m <= '06'){
				$mN = 'Q2';
				$mOp = array("Q3"=>"3","Q4"=>"4","Q1"=>"1","Q2"=>"2");
			}elseif($m >= '07' && $m <= '09'){
				$mN = 'Q3';
				$mOp = array("Q4"=>"4","Q1"=>"1","Q2"=>"2","Q3"=>"3");
			}elseif($m >= '10' && $m <= '12'){
				$mN = 'Q4';
				$mOp = array("Q1"=>"1","Q2"=>"2","Q3"=>"3","Q4"=>"4");
			}
			$year = date("Y");
			foreach($mOp as $key=>$data2){
				//if($key<$key_old) $year++;
				if($mN =='Q1'){
					if($key =='Q1')$y = $year; else $y = $year-1;
				}
				if($mN =='Q2'){
					if($key =='Q1' || $key =='Q2')$y = $year; else $y = $year-1;
				}
				if($mN =='Q3'){
					if($key =='Q1' || $key =='Q2' || $key =='Q3')$y = $year; else $y = $year-1;
				}
				if($mN =='Q4')$y = $year;

				$yearN = sprintf("%02d",$y);
				$numM = sprintf("%02d",$key);
				$key_new = $key."".$yearN;
				$month[$key_new] = $this->quarterOp[$key]." : ".$yearN;
				$key_old = $key;
			}
			$data[typePage]= "MI";
			$data[month] = $mN;
		}

		$data["year"] = date("Y");
		$data["monthNow"] = $data[month]."".$data[year];
		$data["monthOp"]= $month;
		$data[rowsArr] = $cat->getSumIncentiveMIPI($data[typePage]);

		$view->assign('', $data);
    	$view->output('summary/_grade.tpl');
   }
   public function masterAction() {
		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
        $data[rows] = $cat->getEvaluateMST();

        $view->assign('', $data);
    	$view->output('index.tpl');
    }
    public function createmiAction() {
		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $year = date('Y');
        $yearPrv = date('Y')-1;
        $yearNext = date('Y')+1;

        $data["yearOp"] = array($yearPrv=>$yearPrv,$year=>$year,$yearNext=>$yearNext);
        $data["monthNow"] = date('m');
        $data["yearNow"] = date('Y');

        $data["levelOp"] = $cat->getLevelOp();
        $data["evaluate"] = $cat->getEvaluateByType($params["form_type"]);
        $data["frmRow"] = $cat->getFormEvaluateById($params["form_id"]);
        $data["userEva"] = $cat->getUserList($params);
        $data["userRecive"] = $cat->getUserHeader();
        $data["headPage"] = "Create Evaluate ".$params["form_type"]." Incentive";
        $view->assign('', $data);
    	$view->output('MI/create.tpl');
    }
    public function portalmiAction() {
		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $data[groupBUOp] = $cat->getGroupBUList();
		if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			$data["head_org"] = "Y";
			if($identity->level == '11'){//|| $identity->level == '10'
				$org = $cat->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params[head_org] = $org;
			}else{
				$org = $cat->GetOrgByCode($identity->user_code);
				if($org)$params[head_org] = $org; else $params[head_org] = $identity->user_sec_depart;
			}
			$data["group"] = $identity->user_sec_depart;
		}elseif($identity->user_header =='N' && $identity->lookup_code != 'AM' && $identity->level < 12){
			$data["head_org"] = "Y";
			$params["user_view"] = $identity->user_code;
			$data["group"] = $identity->user_sec_depart;
		}else{
			$data["group"] = $params["group"];
		}
		$data["dataArr"] = $cat->getUserPortal($params,'');
		$m = date("m");

		if($m >= '01' && $m <= '03'){
			$mN = 'Q1';
			$mOp = array("Q4"=>"4","Q1"=>"1","Q2"=>"2","Q3"=>"3");
		}elseif($m >= '04' && $m <= '06'){
			$mN = 'Q2';
			$mOp = array("Q1"=>"1","Q2"=>"2","Q3"=>"3","Q4"=>"4");
		}elseif($m >= '07' && $m <= '09'){
			$mN = 'Q3';
			$mOp = array("Q2"=>"2","Q3"=>"3","Q4"=>"4","Q1"=>"1");
		}elseif($m >= '10' && $m <= '12'){
			$mN = 'Q4';
			$mOp = array("Q3"=>"3","Q4"=>"4","Q1"=>"1","Q2"=>"2");
		}
		$year = date("Y");
		$yearPre = date("Y")-1;
		foreach($mOp as $key=>$data2){
			if($mN =='Q1'){
				if($key =='Q1' || $key =='Q2' || $key =='Q3')$y = $year; else $y = $year-1;
			}
			if($mN =='Q2'){
				if($key =='Q1' || $key =='Q2')$y = $year; else $y = $year+1;
			}
			if($mN =='Q3'){
				if($key =='Q2' || $key =='Q3' || $key =='Q4')$y = $year; else $y = $year+1;
			}
			if($mN =='Q4'){
				if($key =='Q3' || $key =='Q4')$y = $year; else $y = $year+1;
			}

			/*if($key<$key_old && $key_old) $year++;
			if(!$key_old) $year = $year-1;*/
			$yearN = sprintf("%02d",$y);
			$numM = sprintf("%02d",$key);
			$key_new = $key."".$yearN;
			$month[$key_new] = $this->quarterOp[$key]." : ".$yearN;
			$key_old = $key;
			/*$yearN = sprintf("%02d",$year);
			$numM = sprintf("%02d",$key);
			$key_new = $key."".$yearN;
			$month[$key_new] = $this->quarterOp[$key]." : ".$yearN;
			$key_old = $key;*/
		}
		$data["month"] = date("m");
		$data["monthNow"] = $mN.date("Y");
		$data["year"] = date("Y");
		$data["Tab"]= $params["Tab"];
		$data["typePage"]= "MI";
		$data["form_id"]= $params["form_id"];
		$data["form_type"]= $params["form_type"];
		$data["monthOp"]= $month;
		$data["rowsArr"] = $cat->getEvaluateMIPI('MI');
		$data["userOp"] = $cat->getUserOption();
		$data["headPage"] = "Portal Status Flow Incentive MI";
		$data["show"]= $params["show"];
        $view->assign('', $data);
    	$view->output('portal.tpl');
    }
    public function portalpiAction() {
		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

		if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			$data["head_org"] = "Y";
			if($identity->level == '11'){// || $identity->level == '10'
				$org = $cat->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params[head_org] = $org;
			}else{
				$org = $cat->GetOrgByCode($identity->user_code);
				if($org)$params[head_org] = $org; else $params[head_org] = $identity->user_sec_depart;
			}
			$data["group"] = $identity->user_sec_depart;
		}elseif($identity->user_header =='N' && $identity->lookup_code != 'AM' && $identity->level < 12){
			$data["head_org"] = "Y";
			$params["user_view"] = $identity->user_code;
			$data["group"] = $identity->user_sec_depart;
		}else{
			$data["group"] = $params["group"];
		}
 		$data[groupBUOp] = $cat->getGroupBUList();
		$data["dataArr"] = $cat->getUserPortal($params,'');

        $n = 1;
        for($i=0;$i<4;$i++){
				$m = date("m")-2;
				$y = date("Y");
				if($m <= 12){
					$num = $m+$i;
					$year = $y;
					$m++;
					if($num > 12) {
						$num = $n;
						$year = $y+1;
						$n++;
					}
					$l = 12+$num;
					if($num < 1) {
						$num = $l;
						$year = $y-1;
						$l--;
					}
				}
				$yearN = sprintf("%02d",$year);
				$numM = sprintf("%02d",$num);
				$key = $numM."".$yearN;
				$month[$key] = $this->monthOp[$numM]." : ".$yearN;
			}
		if(date("m")=='1') $monthNow = '12'; else $monthNow = sprintf("%02d",date("m")-1);
		$data["month"] = date("m");
		$data["year"] = date("Y");
		$data["monthNow"] = $monthNow.date("Y");
		$data["Tab"]= $params["Tab"];
		$data["typePage"]= "PI";
		$data["form_id"]= $params["form_id"];
		$data["form_type"]= $params["form_type"];
		$data["monthOp"]= $month;
		$data["rowsArr"] = $cat->getEvaluateMIPI('PI');
		$data["userOp"] = $cat->getUserOption();
		$data["headPage"] = "Portal Status Flow Incentive PI";
		$data["show"]= $params["show"];

        $view->assign('', $data);
    	$view->output('portal.tpl');
    }
    public function savemiAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $params[head][mph_user_create] = $identity->user_code;
        $params[head][mph_month] = $params[fields][month]."".$params[fields][year];
        $params[head][mph_type] = 'MI';
        $params[head][mph_status] = 'C';
        $params[head][user_send] = $identity->user_code;
        $params[head][mph_user_flow] = $params[fields][user_rec];
        $params[head][user_first_recive] = $params[fields][user_rec];
        $params[head][form_code] = $params[fields][form_code];
        $params[head][mph_objective] = $params[fields][mph_objective];
        $params[head][mph_sflow] = $params[fields][mph_sflow];
        $params[head][mph_eflow] = $params[fields][mph_eflow];
        $params[head][mph_createdate] = date('Y-m-d H:i:s');
        $params[head][mph_datetime] = date('Y-m-d H:i:s');

        $cat->createMIMaster($params);
        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Create Evaluate MI","Save");
		$user_eva = explode(",",$params["user_eva"]);
		$mph_month = $params[fields][month]."/".$params[fields][year];
        $eForm["email"] = $identity->user_email;
        $eForm["name"] = $identity->user_name ." ".$identity->user_lname;
		//$mail_to = 'siriphan@icesolution.com';
		$mail_arr = $cat->GetEmail($params[fields][user_rec]);
		$mail_to = $mail_arr["user_email"];
		if($mail_to){
			$subject  = "การประเมิน MI ประจำเดือน ".$mph_month;
			$message = "<font size=2>Admin ได้ Create ใบประเมิน MI ประจำเดือน ".$mph_month." ดังรายชื่อ <br>" ;
			foreach($user_eva as$key=>$item){
				$i = $key+1;
				$message .= "<dd>".$i.". ".$item."<br>";
			}
			$message .= "<br>มาถึงคุณเรียบร้อยแล้ว<br>";
			$message .= "กรุณาเข้าระบบประเมิน <a href='http://sfa.icesolution.com/iceworkflow'>http://sfa.icesolution.com/iceworkflow</a> เพื่อทำการใส่ข้อมูลรายการประเมิน<br><br>";
			$message .= "มีปัญหา ในการใช้งานแจ้ง Admin ระบบ</font>";
			$this->sendMail($message,$subject,$mail_to,$eForm);
		}
		if($mail_arr["user_mobile"]){
			$mobile = "66".substr($mail_arr["user_mobile"],-9);
			$message_sms = "Admin ได้ Create ใบประเมิน MI เดือน ".$mph_month." มาถึงคุณ เรียบร้อยแล้ว";
			$sender = "ICEs";
			$this->sms($mobile,$message_sms,$sender);
		}

    	//echo "'var data = 1';";
	   	exit;
    }
    public function updatemiAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
		if($params[page_status] !='E'){
			if($params[user_recive] == $params[user_send]){
	    		$params[head][mph_column] = $params[loopCol];
	    	}else{
	    		if($params[old_status] != 'C'){
		    		$check_date = $cat->checkDateSend($identity->level,$params[user_recive]);
		    		if($check_date == 'N')$params[head][mph_status] = 'R';
	    		}
	    		if($params[old_status] == 'P'){
	    			$params[head][mph_column] = $params[loopCol]+1;
	    			$insert_subl = "ok";
	    		}else{
	    			$params[head][mph_column] = $params[loopCol];
	    		}
	    	}
		}
    	$params["head"]["user_send"] = $params["user_send"];
    	$params["head"]["mph_user_flow"] = $params["user_recive"];
    	$params["head"]["mph_datetime"] = date('Y-m-d H:i:s');
    	if($params[page_status] !='E'){
        	$cat->updateMIMaster($params,$insert_subl);
    	}else{
    		$cat->EditUserReceive($params,'MI');
    	}
        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Update Evaluate MI","Save");

        if($params[user_recive] != $params[user_send]){
	        $mph_month = substr($params[head][mph_month],0,2)."/".substr($params[head][mph_month],-4);
	        $eForm["email"] = $identity->user_email;
	        $eForm["name"] = $identity->user_name ." ".$identity->user_lname;
			//$mail_to = 'siriphan@icesolution.com';
			$mail_arr = $cat->GetEmail($params[user_recive]);
			$owner = $cat->GetName($params[head][mph_user]);
			$mail_to = $mail_arr["user_email"];
			if($mail_to){
				$subject  = "การประเมิน MI ประจำเดือน ".$mph_month;
				$message = "<font size=2>คุณ ". $eForm["name"] ." ได้ส่ง ใบประเมิน MI ประจำเดือน ".$mph_month." ของ คุณ ".$owner["user_name"]." มาถึงคุณเรียบร้อยแล้ว<br>";
				$message .= "กรุณาเข้าระบบประเมิน <a href='http://sfa.icesolution.com/iceworkflow'>http://sfa.icesolution.com/iceworkflow</a> เพื่อทำการประเมิน PI<br><br><br>";
				$message .= "มีปัญหา ในการใช้งานแจ้ง Admin ระบบ</font>";
				$this->sendMail($message,$subject,$mail_to,$eForm);
			}
			/*if($mail_arr["user_mobile"]){
				$mobile = "66".substr($mail_arr["user_mobile"],-9);
				$message_sms = $identity->user_name." ส่งใบประเมิน MI เดือน ".$mph_month." มาถึงคุณแล้ว กรุณา เข้าระบบประเมิน";
				$sender = "ICEs";
				$this->sms($mobile,$message_sms,$sender);
			}*/
        }
		if($check_date == 'N') echo "\$('#checksend').val('".$check_date."');";
    	//echo "'var data = 1';";
	   	exit;
    }
    public function mifrmAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

		$m = date("m");
		$year = date('Y');
        $yearPrv = date('Y')-1;
        $yearNext = date('Y')+1;
        $data["yearOp"] = array($yearPrv=>$yearPrv,$year=>$year,$yearNext=>$yearNext);
		if($m >= '01' && $m <= '03'){
			$mN = 1;
		}elseif($m >= '04' && $m <= '06'){
			$mN = 2;
		}elseif($m >= '07' && $m <= '09'){
			$mN = 3;
		}elseif($m >= '10' && $m <= '12'){
			$mN = 4;
		}
		if($params["tab"]=='T2'){
			if($mN <=3){
				//$qtN = $mN+1;
				$qtN = $mN;
				$y = date("Y");
			}else{
				$qtN = 1;
				$y = date("Y")+1;
			}
		}else{
			if($m >= '01' && $m <= '03'){
				$qtN = 1;
			}elseif($m >= '04' && $m <= '06'){
				$qtN = 2;
			}elseif($m >= '07' && $m <= '09'){
				$qtN = 3;
			}elseif($m >= '10' && $m <= '12'){
				$qtN = 4;
			}
			$y = date("Y");
		}
		if($params["m"]){
			$dateNow = $params["m"];
			$data["monthNow"]= substr($params["m"],0,2);
			$y = substr($params["m"],-4);
		}else{
			$dateNow = 'Q'.$qtN.''.$y;
			$data["monthNow"]= 'Q'.$qtN;
    	}

    	$TabName = substr($dateNow,0,2);
		$data["TabName"] = "ประเมิน ".$this->quarterOp[$TabName]." ปี ".$y;

		if($params["user"]){
	        $userArr = $cat->getUserById($params["user"]);
	        $headArr = $cat->getEvaluateHeadMI($params["user"],$identity->user_code,$dateNow,$mN,$params["status"]);
	        $lineArr = $cat->getEvaluateLineMI($headArr["mph_id"],$identity->user_code,$headArr["mph_status"],$this->column,$this->user_col,$this->totalLine,$params["status"]);
		}
		if($params["copy_to"]){
    		$data["copy_to"] = $params["copy_to"];
    	}else{
    		$data["copy_to"] = $headArr["mph_id"];
    	}

		if($this->user_col){
			foreach($this->user_col as $key=> $val){
				$userColumn[$key+1] = $val[user_name];
			}
		}

        $data["headArr"]= $headArr;
        $data["dataRows"]= $lineArr;
        $data["userArr"]= $userArr;
		$data["userColumn"]= $userColumn;
        $data["user"] = $params["user"];
        $data["Tab"] = $params["tab"];
        $data["yearNow"] = $y;
        $data["year"] = $year;
        $data["yearPrv"] = $year-1;
        $data["yearNext"] = $year+1;

        $data['IMG_URL'] = IMG_URL;
        $data["totalLine"] = $this->totalLine;
        $data["user_send"] = $identity->user_code;
        $data['column'] = $this->column;
        if($userArr["user_image"] && file_exists(UPLOAD_PATH."/account/".$userArr["user_image"]))
        	$data["user_image"] = '1';
		if($identity->user_code == $headArr["user_first_recive"] && $identity->user_code ==$headArr["user_send"]){
			$data["change"] = '1';
			//&& $headArr["mph_user"]==$headArr["mph_user_flow"]
		}
		$data["status"] = $params["status"];
        $view->assign('', $data);
        $view->output('MI/_form.tpl');
    }
    public function draftpiAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
		foreach($params["fields"]["data"] as $key=>$data){
			if($data[subject]){
				$data_new[$key]= $data;
			}
		}

		//$params["fields"]["data"] = serialize($params["fields"]["data"]);
		$params["fields"]["drf_id"] = $params[drf_id];
		$params["fields"]["data"] = serialize($data_new);
 		$params["fields"]["user_eva"] = $params["user_eva"];
 		$params["fields"]["mph_type"] = 'PI';
 		$params["fields"]["createdate"] = date('Y-m-d H:i:s');
		$cat->InsertMaster("draft_evaluateform","drf_id",$params[drf_id],$params[fields]);

		exit;
    }
    public function draftmiAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

		$params["fields"]["data"] = serialize($params["fields"]["data"]);
 		$params["fields"]["user_eva"] = $params["user_eva"];
 		$params["fields"]["mph_type"] = 'MI';
 		$params["fields"]["createdate"] = date('Y-m-d H:i:s');
		$cat->InsertMaster("draft_evaluateform","drf_id","",$params[fields]);
		exit;
    }
    public function savepiAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $params[head][mph_user_create] = $identity->user_code;
        $params[head][mph_month] = $params[fields][month]."".$params[fields][year];
        $params[head][mph_type] = 'PI';
        $params[head][mph_status] = 'C';
        $params[head][user_send] = $identity->user_code;
        $params[head][mph_user_flow] = $params[fields][user_rec];
        $params[head][user_first_recive] = $params[fields][user_rec];
        $params[head][form_code] = $params[fields][form_code];
        $params[head][mph_objective] = $params[fields][mph_objective];
        $params[head][mph_sflow] = $params[fields][mph_sflow];
        $params[head][mph_eflow] = $params[fields][mph_eflow];
        $params[head][mph_createdate] = date('Y-m-d H:i:s');
        $params[head][mph_datetime] = date('Y-m-d H:i:s');

        $cat->createPIMaster($params);
        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Create Evaluate PI","Save");

		$user_eva = explode(",",$params["user_eva"]);

		$mph_month = $params[fields][month]."/".$params[fields][year];
        $eForm["email"] = $identity->user_email;
        $eForm["name"] = $identity->user_name ." ".$identity->user_lname;
		//$mail_to = 'siriphan@icesolution.com';
		$mail_arr = $cat->GetEmail($params[fields][user_rec]);
		$mail_to = $mail_arr["user_email"];
		if($mail_to){
			$subject  = "การประเมิน PI ประจำเดือน ".$mph_month." จากฝ่ายบุคคล";
			$message = "<font size=2>ฝ่ายบุคคลได้สร้างใบประเมิน PI ประจำเดือน ".$mph_month." ดังรายชื่อต่อไปนี้ <br>" ;
			foreach($user_eva as$key=>$item){
				$i = $key+1;
				$message .= "<dd>".$i.". ".$item."<br>";
			}
			$message .= "<br>มาถึงคุณเรียบร้อยแล้ว<br>";
			$message .= "กรุณาเข้าระบบประเมิน <a href='http://sfa.icesolution.com/iceworkflow'>http://sfa.icesolution.com/iceworkflow</a> เพื่อทำการใส่ข้อมูลรายการประเมิน<br><br>";
			$message .= "มีปัญหา ในการใช้งานแจ้ง Admin ระบบ</font>";
			$this->sendMail($message,$subject,$mail_to,$eForm);
		}
		/*if($mail_arr["user_mobile"]){
			$mobile = "66".substr($mail_arr["user_mobile"],-9);
			//$mobile = "66818657643";
			$message_sms = "Admin ได้ Create ใบประเมิน PI เดือน ".$mph_month." มาถึงคุณ เรียบร้อยแล้ว";
			$sender = "ICEs";
			$this->sms($mobile,$message_sms,$sender);
		}*/
   		//echo "'var data = 1';";
	   	exit;
    }
    public function sms($mobile,$message,$sender){
        $ch = curl_init();
        $message = iconv("UTF-8","TIS-620",$message);
        //$url = "http://intranet.icesolution.com/sms-wf/send-workflow.php";
        $url = SMS_PROXY;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST,1);
        $POSTFIELDS = array("message"=>$message,"mobile"=>$mobile,"sender"=>$sender);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDS);
        curl_exec($ch);
 	    curl_close($ch);
    }
    public function sendsmsAction() {
		$cat = $this->getGeneric();
		$params = $this->getParams();
        include('SendSMS.php');
         $csvObj = new SendSMS();
         $mail_arr = $cat->GetEmail($params[user_rec]);
 		//if($mail_arr["user_mobile"]){
			//$mobile = "66".substr($mail_arr["user_mobile"],-9);
			$mobile = "66818657643";
			$message_sms = "Admin ได้ Create ใบประเมิน PI เดือน ".$params["month"]." มาถึงคุณ เรียบร้อยแล้ว";
			$sender = "ICEs";
			$csvObj->sms($mobile,$message_sms,$sender);
		//}
        exit;
    }
    public function sendMail($body,$subject,$eMail,$eForm){

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = SETHOST;
		$mail->SMTPAuth = false;
		$mail->CharSet = "utf-8";
		$mail->Username = "siriphan@icesolution.com";
		$mail->Password = "siriphan";

		$mail->From = $eForm["email"];
		$mail->FromName = $eForm["name"];

		$mail->AddAddress($eMail);// $eMail
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $body;

		$mail->Send();
	}
	public function updatedetailpiAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
 
        if($params['chk']=='1'){
        	$code_arr = explode(":",$params["key_chk"]);        	        	
	        foreach($code_arr as $val){
	        	if($params['page_status'][$val] !='E'){
		        	if($params['user_recive_popup'])$params['user_recive'][$val] = $params['user_recive_popup'];   

	        		if($params['user_recive'][$val] == $params['user_send'][$val]){	    		
				    	if($params['status']=='F'){
				    		$insert_subl = "ok";
				    		$params['head'][$val]['mph_status'] = 'F';
				    		$params['head'][$val]['mph_column'] = $params['loopCol'][$val]+1;
				    	}else{
				    		$params['head'][$val]['mph_column'] = $params['loopCol'][$val];
				    	}    		
				    }else{
				    	
				    	if($params['old_status'][$val] == 'P'){	
					   		$params['head'][$val]['mph_column'] = $params['loopCol'][$val]+1;
				    		$insert_subl = "ok";
				    	}elseif($params['old_status'][$val] == 'C'){	
					   		$params['head'][$val]['mph_column'] = $params['loopCol'][$val];
				    	}else{
				    		$check_date = $cat->checkDateSend($identity->level,$params['user_recive'][$val]);
					   		if($check_date == 'N')$params['head'][$val][mph_status] = 'R';
				    	}
				    }			    	
	        	}
	        	
				$params['head'][$val]['mph_user_flow'] = $params['user_recive'][$val];
		    	$params['head'][$val]["user_send"] = $params["user_send"][$val];
		    	$params['head'][$val]['mph_datetime'] = date('Y-m-d H:i:s');
		    	
	         	$head_arr = $params['head'][$val];
	         	$cat->updatePIAcpDetail($head_arr,$val,$params,$insert_subl);

	         	$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Update Evaluate PI","Save");
		        if($params['user_recive'][$val] != $params['user_send'][$val]){
			        $mph_month = substr($params['head'][$val]['mph_month'],0,2)."/".substr($params['head'][$val]['mph_month'],-4);
			        $eForm["email"] = $identity->user_email;
			        $eForm["name"] = $identity->user_name ." ".$identity->user_lname;
					//$mail_to = 'siriphan@icesolution.com';
					$mail_arr = $cat->GetEmail($params['user_recive'][$val]);
					$owner = $cat->GetName($params['head'][$val]['mph_user']);
					$mail_to = $mail_arr["user_email"];
					if($mail_to){
						$subject  = "การประเมิน PI ประจำเดือน ".$mph_month." ของคุณ ".$owner["user_name"]." ".$owner["user_lname"];
						$message  = "<font size=2>เรียนคุณ   ".$mail_arr["user_name"]." ".$mail_arr["user_lname"]."<br><br>";						
						$message .= "คุณ ". $eForm["name"] ." ได้ส่งใบประเมิน PI พนักงานประจำเดือน ".$mph_month." ของคุณ ".$owner["user_name"]." ".$owner["user_lname"]." มาถึงคุณเรียบร้อยแล้ว<br>";
						$message .= "กรุณาเข้าระบบประเมิน <a href='http://sfa.icesolution.com/iceworkflow'>http://sfa.icesolution.com/iceworkflow</a> เพื่อทำการประเมิน PI พนักงาน<br><br><br>";
						$message .= "มีปัญหา ในการใช้งานแจ้ง Admin ระบบ</font>";
						$this->sendMail($message,$subject,$mail_to,$eForm);
					}				
		        }	         	     
	        } 
        }
  
        if($check_date == 'N') echo "\$('#checksend').val('".$check_date."');";
        echo "'var data = 1';";
	   	exit;
        
    }
    public function updatepiAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
		if($params[page_status] !='E'){
	    	if($params[user_recive] == $params[user_send]){	    		
	    		if($params[head]['mph_status']=='F'){
	    			$insert_subl = "ok";
	    			$params[head][mph_column] = $params[loopCol]+1;
	    		}else{
	    			$params[head][mph_column] = $params[loopCol];
	    		}    		
	    	}else{
	    		if($params[old_status] == 'P'){		    		
		    		$params[head][mph_column] = $params[loopCol]+1;
	    			$insert_subl = "ok";
	    		}elseif($params[old_status] == 'C'){	    			
		    		if($params['owner_create']){
		    			$params[head][mph_column] = $params[loopCol]+1;
	    				$insert_subl = "ok";
		    		}else{
		    			$params[head][mph_column] = $params[loopCol];
		    		}	    			
	    		}else{
	    			$check_date = $cat->checkDateSend($identity->level,$params[user_recive]);
		    		if($check_date == 'N')$params[head][mph_status] = 'R';
	    		}
	    	}
		}
		$params[head][mph_user_flow] = $params[user_recive];
    	$params["head"]["user_send"] = $params["user_send"];
    	$params[head][mph_datetime] = date('Y-m-d H:i:s');

		if($params[page_status] !='E'){
        	$cat->updatePIMaster($params,$insert_subl);
		}else{
			$cat->EditUserReceive($params,'PI');
		}

        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Update Evaluate PI","Save");

        if($params[user_recive] != $params[user_send]){
	        $mph_month = substr($params[head][mph_month],0,2)."/".substr($params[head][mph_month],-4);
	        $eForm["email"] = $identity->user_email;
	        $eForm["name"] = $identity->user_name ." ".$identity->user_lname;
			//$mail_to = 'siriphan@icesolution.com';
			$mail_arr = $cat->GetEmail($params[user_recive]);
			$owner = $cat->GetName($params[head][mph_user]);
			$mail_to = $mail_arr["user_email"];
			if($mail_to){
				$subject  = "การประเมิน PI ประจำเดือน ".$mph_month." ของคุณ ".$owner["user_name"]." ".$owner["user_lname"];
				$message  = "<font size=2>เรียนคุณ   ".$mail_arr["user_name"]." ".$mail_arr["user_lname"]."<br><br>";
				$message .= "คุณ ". $eForm["name"] ." ได้ส่ง ใบประเมิน PI พนักงานประจำเดือน ".$mph_month." ของคุณ ".$owner["user_name"]." ".$owner["user_lname"]." มาถึงคุณเรียบร้อยแล้ว<br>";
				$message .= "กรุณาเข้าระบบประเมิน <a href='http://sfa.icesolution.com/iceworkflow'>http://sfa.icesolution.com/iceworkflow</a> เพื่อทำการประเมิน PI พนักงาน<br><br><br>";
				$message .= "มีปัญหา ในการใช้งานแจ้ง Admin ระบบ</font>";
				$this->sendMail($message,$subject,$mail_to,$eForm);
			}
			/*if($mail_arr["user_mobile"]){
				$mobile = "66".substr($mail_arr["user_mobile"],-9);
				//$mobile = "66818657643";
				$message_sms = $identity->user_name." ส่งใบประเมิน PI เดือน ".$mph_month." มาถึงคุณแล้ว กรุณา เข้าระบบประเมิน";
				$sender = "ICEs";
				$this->sms($mobile,$message_sms,$sender);
			}*/
        }

    	if($check_date == 'N') echo "\$('#checksend').val('".$check_date."');";
	   	exit;
    }
    public function pifrmAction(){
    	
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $year = date('Y');
        $yearPrv = date('Y')-1;
        $yearNext = date('Y')+1;
        $data["yearOp"] = array($yearPrv=>$yearPrv,$year=>$year,$yearNext=>$yearNext);
        
        $data['fix_month'] = 03; #natcharee
        $data['fix_year'] = 2014; #natcharee

       if($params["tab"]=='T2'){
        	if($params["m"]){
				$date = substr($params["m"],0,2);
				$m = sprintf("%02d",$date);
				$y = substr($params["m"],-4);
				$dateNow = $m."".$y;
        	}else{
				$m = sprintf("%02d",date("m"));
        		$y = date("Y");
				$dateNow = $m."".$y;
			}
        }else{
			if($params["m"]){
				$dateNow = $params["m"];
				$y = substr($params["m"],-4);
				$chkDate = substr($params["m"],0,2);
			}else{
				$m = sprintf("%02d",date("m"));
				$y = date("Y");
				#
				#natcharee
				/* if($y <= $data['fix_year']) {
					if($m < $data['fix_month']) {
						$m = $data['fix_month'];
					}
					$y = $data['fix_year'];
				} */
				#
				$dateNow = $m."".$y;
			}
		}
		if($params["m"]){
        	$data["monthNow"] = substr($params["m"],0,2);
        	#
        	#natcharee
        	/* $yearsub = substr($params['m'],-4,4);
        	if($yearsub <= $data['fix_year']) {
        		if($data["monthNow"] < $data['fix_month']) {
        			$data["monthNow"] = $data['fix_month'];
        		}
        		$y = $data['fix_year'];
        	} */
        	#
        }else{
        	
         	$data["monthNow"]= sprintf("%02d",$m); //sprintf("%02d",date("m")); #natcharee
        }
        $dateNow = sprintf('%02d',$data["monthNow"])."".$y; #natcharee
		$TabName = substr($dateNow,0,2);
		
		// ***************************
		// Trammel other user. #natcha
		if(!empty($params['id']) && empty($params['user'])) {
			$params['user'] = $cat->getUserCodeByEvaId($params['id']);
		}
		// If user is empty.
		if(empty($params['user'])) {
			$params['user'] = $identity->user_code;
		}
		
		if($identity->lookup_code != 'AM') {
				
			$permission = true;
			if (in_array($params['user'], $identity->empAccess)) {
				$permission = false;
			}
			if($permission) {
				// Display to error page.
				echo "<script>window.location.href = '/".projectName."/workflow/evaluate/errpermission';</script>";
				exit;
				// 				$data['msg'] = 'You not permission!!';
		
				// 				$view->assign('', $data);
				// 				$view->output('error.tpl');
				// 				return;
			}
		}
		// Trammel other user.
		// ***************************
		if($params["user"]){	        
			$userArr = $cat->getUserById($params["user"]);
	        $headArr = $cat->getEvaluateHeadPI($params["user"],$identity->user_code,$dateNow,$chkDate,$params["status"]);
	        if($headArr["mph_user_flow"])$user_flow = $cat->getUserById($headArr["mph_user_flow"]);
			if($headArr['mph_user'] == $identity->user_code){
	        	$usend = 'ok';
	        }	    
	       if($headArr)    
	       		$lineArr = $cat->getEvaluateLinePI($headArr["mph_id"],$identity->user_code,$headArr["mph_status"],&$this->column,&$this->user_col,&$this->totalLine,$params["status"]);
		}
		if($params["copy_to"]){
    		$data["copy_to"] = $params["copy_to"];
    	}else{
    		$data["copy_to"] = $headArr["mph_id"];
    	}
		if($this->user_col){
			foreach($this->user_col as $key=> $val){
				$userColumn[$key+1] = $val[user_name];
			}
		}

		$data["TabName"] 	= "ประเมิน ".$this->monthOp[$TabName]." ปี ".$y;
        $data["headArr"]	= $headArr;
        $data["dataRows"]	= $lineArr;
        $data["userArr"]	= $userArr;
        $data["userColumn"]	= $userColumn;
        $data["yearNow"] 	= $y;
        $data["year"] 		= $y; //$year; #natcharee
        $data["yearPrv"] 	= $y-1; //$year-1; #natcharee
        $data["yearNext"] 	= $y+1; //$year+1; #natcharee

		if($lineArr){
			foreach($lineArr as $item){
				if($item[detail]){
					foreach($item[detail] as $val){
						$sum_weight += $val['mpl_weight'];
						$sum_point += $val['mpl_weight']*$val['mpl_point'];
					}
				}
			}
			$data["sum_weight"] = $sum_weight;
			$data["sum_point"] = $sum_point;			
		}

        $data["user"] = $params["user"];
        $data["Tab"] = $params["tab"];
        $data['IMG_URL'] = IMG_URL;
        $data["totalLine"] = $this->totalLine;
        $data["user_send"] = $identity->user_code;
        $data["level"] = $identity->level;
        $data["column"] = $this->column;
		if($userArr["user_image"] && file_exists(UPLOAD_PATH."/account/".$userArr["user_image"]))
        	$data["user_image"] = '1';
		if($identity->level_name == $headArr["mph_eflow"])
			$data["Finish"] = '1';

		if($identity->user_code == $headArr["user_first_recive"] && $identity->user_code ==$headArr["user_send"]){
			$data["change"] = '1';
			//&& $headArr["mph_user"]!=$headArr["mph_user_flow"]
		}
		$data["status"] = $params["status"];
		$data["user_flow"] = $user_flow;
        $view->assign('', $data);
        $view->output('PI/_form.tpl');
    }
    public function acceptdetailAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
        
    	if($params["code"]){	        
	        $code_arr = explode(":",$params["code"]);
	        sort($code_arr);
	        foreach($code_arr as$key=> $val){
	        	$code .= ($code)?",".$val:$val;
	        	$code_chk .= ($code_chk)?":".$val:$val;
	        }

    		$headArr = $cat->getEvaluateHeadPIDetail($code);
    		if($headArr)
    			$lineArr = $cat->getEvaluateLinePIDetail($code,&$this->column,&$this->user_col,&$this->totalLine);
	    	if($lineArr){
	    		foreach($lineArr as $key=> $item_line){
	    			$sum_weight=0;
	    			$sum_point=0;
	    			foreach($item_line as $item){
						if($item[detail]){
							foreach($item[detail] as $val){
								$sum_weight += $val['mpl_weight'];
								$sum_point += $val['mpl_weight']*$val['mpl_point'];
							}
						}
					}
					$headArr[$key]["sum_weight"] = $sum_weight;
					$headArr[$key]["sum_point"] = $sum_point;
	    		}	    					
			}
	    	if($this->user_col){
				foreach($this->user_col as $key=> $val_col){
					foreach($val_col as $key1=> $val){
						$userColumn[$key][$key1+1] = $val[user_name];
					}
				}
			}
		}
		$data["key_chk"]= $code_chk;		
		$data["headRows"]= $headArr;
        $data["dataRows"]= $lineArr;
        $data["userColumn"]= $userColumn;
        $data["column"]= $this->column;
        $data["totalLine"] = $this->totalLine;

		$TabName = substr($params['month'],0,2);
		$y = substr($params["month"],-4);
		$data["TabName"] = "รายละเอียดการประเมิน PI ประจำเดือน ".$this->monthOp[$TabName]." ปี ".$y;		
        $data["user_send"] = $identity->user_code;        
        $data['IMG_URL'] = IMG_URL;
        $data["status"] = $params["status"];
        $data['user_flow'] = $identity->user_name;
        $data['lookup_code'] = $identity->lookup_code;
        $view->assign('', $data);
        $view->output('PI/_formdetail.tpl');
    }
    public function createpiAction() {
		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
        $year = date('Y');
        $yearPrv = date('Y')-1;
        $yearNext = date('Y')+1;

        $data["yearOp"] = array($yearPrv=>$yearPrv,$year=>$year,$yearNext=>$yearNext);
        $data["monthNow"] = date('m');
        $data["yearNow"] = date('Y');
        $data["frmDraft"] = $cat->getDraftFrmById($params["drf_id"]);

        $data["frmRow"] = $cat->getFormEvaluateById($params["form_id"]);
        $data["levelOp"] = $cat->getLevelOp();
        $data["evaluate"] = $cat->getEvaluateByHPI($params["form_type"],&$dataLine);

        $data["userEva"] = $cat->getUserList($params);
        $data["userRecive"] = $cat->getUserHeader();
        $data["dataLine"] = $dataLine;
        if($params["drf_id"])
        	$data["drfid"] = $params["drf_id"];
        $data["headPage"] = "Create Evaluate ".$params["form_type"]." Incentive";

        $view->assign('', $data);
    	$view->output('PI/create.tpl');
    }
    public function userpopupAction(){
		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
        
		$params["groupDefaul"] = $identity->user_sec_depart;
		if($params["group"] && $params["group"] != 'all')
			if($params["group"])
				$data["group"] = $params["group"];
		else{
			if($params["depart"] && $params["group"] != 'all')
				$data["group"] = $params["depart"];
			if($params["group"] == 'all')
				$data["group"] = $params["group"];
		}
		$data["groupBUOp"] = $cat->getGroupBUList();
		$data["userEva"] = $cat->getUserListWhere($params);
		$data["pageview"]  = $params["pageview"];
		//$rows = $cat->getUserPageByG($params,$params["page"],$this->per_page);

		$data["headPage"] = 'รายชื่อพนักงาน';

		$data["accept"] = $params["accept"];
		$data["chk_code"] = $params["code"];
		$data["status"] = $params["status"];
		$data["head"] = $params["head"];
		$data["keyword"] = $params["keyword"];

		/*$data["userEva"] = $rows["data"];
   		$data["totalRecord"] = $rows["total"];
        $data["perpage"]     = $this->per_page;
        $data["page"]  = $params["page"]?$params["page"]:1;
        $data["url"]  = $this->prepareUrl();*/
		$view->assign('', $data);
		$view->output('userpopup.tpl');
	}
	public function popvalueAction(){
		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();

		//$params["chkM"] = substr($params["month_now"],-4)."".substr($params["month_now"],0,2);

		$data["rows"] = $cat->GetDataTocopy($params);
		$data["headPage"] = 'รายการใบประเมินที่ต้องการใส่ข้อมูล Copy';

		$data["copy_from"] = $params["copy_from"];
		$data["month_now"] = $params["month_now"];
		$data["type"] = $params["type"];
		$data["user_owner"] = $params["user_owner"];

		$view->assign('', $data);
		$view->output('_popupcopy.tpl');
	}
	public function ureciveAction(){
		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
		$rowsArr = $cat->getEvaluateTotalByUser($identity->user_code);

		$data["level"] = $identity->level;
		$data["worklist"] = $rowsArr["worklist"];
		$rowsAc = $cat->getEvaluateActByUser($identity->user_code);
		$data["rowsArr"] = $rowsAc;
		//$data["activity"] = $rowsArr["activity"];
		$view->assign('', $data);
		$view->output('sum_portal.tpl');
	}
	public function historyAction(){
		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
 
        if($identity->lookup_code == 'AM'){
       	 	$rows_history = $cat->GetHistoryAdmin($params["page"],$this->per_page);
        }else{
			$rows_history = $cat->GetHistorySend($identity->user_code,$params["page"],$this->per_page);
        }
//         _print($rows_finish);
		//$data["history"] = $rows_history;
		//_print($params);

		$data["history"] = $rows_history["data"];
   		$data["totalRecord"] = $rows_history["total"];
        $data["perpage"]     = $this->per_page;
        $data["page"]  = $params["page"]?$params["page"]:1;
        $data["url"]  = $this->prepareUrl();
		$view->assign('', $data);
		$view->output('history.tpl');
	}
	public function viewAction(){
		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
 		$data["levelOp"] = $cat->getLevelOp();

		$rowsArr = $cat->getEvaluateViewByUser($params);
		//_print($rowsArr);
		$data["rowsArr"] = $rowsArr;
		$data["status"] = $params["status"];
		$data["type"] = $params["type"];
		$view->assign('', $data);
		$view->output('view_portal.tpl');
	}
	public function caldatamiAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();

		if($params["detail"]){
			foreach($params["detail"] as $item){
				if($item["mpl_weight"]){
					if($item["mpl_weight"]){
						$sum_weight += $item["mpl_weight"];
						if($item["mpl_point"])
							$sum_total += ($item["mpl_weight"]*$item["mpl_point"]);
					}
				}
			}
		}
    	echo "\$('#weight').html('".number_format($sum_weight,0)."');";
    	echo "\$('#point_total').html('".number_format($sum_total,0)."');";
        //echo "\$('#point_total').val('".number_format($sum_total,2)."');";
	   	exit;
    }
    public function calgradeAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$grade = $cat->getGradeByScoll($params[total]);
		if($params['key']){
     		$id = $params['key'];
			echo "\$('#point_grade_".$id."').html('".$grade.":');";
    	}else{
     		echo "\$('#point_grade').html('".$grade.":');";
     	}
	   	exit;
    }
    public function caldataAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();

		if($params["detail"]){
			foreach($params["detail"] as $val){
				if($val["line"]){
					foreach($val["line"] as $item){
						if($item["mpl_weight"]){
							$sum_weight += $item["mpl_weight"];

							if($item["mpl_point"])
								$sum_total += ($item["mpl_weight"]*$item["mpl_point"]);
						}
					}
				}
			}
		}
		$grade = $cat->getGradeByScoll($sum_total);
    	echo "\$('#weight').html('".number_format($sum_weight,0)."');";
    	echo "\$('#point_total').html('".number_format($sum_total,0)."');";
    	echo "\$('#point_grade').html('".$grade.":');";

	   	exit;
    }
    public function getgradeAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();

		$grade = $cat->getGradeByScoll($params[total]);
	   	echo "\$('#point_grade').html('".$grade.":');";
	   	exit;
    }
    public function acceptAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
    	$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

		$yearPrev = date('Y')-1;
        $yearNow = date('Y');
        $yearNext = date('Y')+1;
        $data["yearOp"] = array($yearPrev=>$yearPrev,$yearNow=>$yearNow,$yearNext=>$yearNext);

		if($params["my"]){
			if($params["type"] == 'PI')
				$params["search"]["month"] = sprintf("%02d",substr($params["my"],0,2));
			else
				$params["search"]["month"] = substr($params["my"],0,2);
			$params["search"]["year"] = substr($params["my"],-4);
		}

		$m = date("m");
		$year = date("Y");
		if($m >= '01' && $m <= '03'){
			$mQuarter = 'Q1';
		}elseif($m >= '04' && $m <= '06'){
			$mQuarter = 'Q2';
		}elseif($m >= '07' && $m <= '09'){
			$mQuarter = 'Q3';
		}elseif($m >= '10' && $m <= '12'){
			$mQuarter = 'Q4';
		}

		if($params["search"]["year"]){
			$year = $params["search"]["year"];
		}else{
			if(date("m")== 1)$year = date("Y")-1; else $year = date("Y");
		}
		if($params["type"] == 'PI'){
			if($params["search"]["month"]){
				$month = sprintf("%02d",$params["search"]["month"]);
			}else{
				if(date("m")== 1)$month = '12'; else $month = sprintf("%02d",date("m")-1);
			}
			$data["month_name"] = $this->monthOp[$month]." ปี ".$year;
		}else{
			if($params["search"]["quarter"]){
				$month = $params["search"]["quarter"];
			}else{
				$month = $mQuarter;
			}
			$data["month_name"] = $this->quarterOp[$month]." ปี ".$year;
		}
		if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			$data["head_org"] = "Y";
			if($identity->level == '11'){// || $identity->level == '10'
				$org = $cat->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params[head_org] = $org;
			}else{
				$org = $cat->GetOrgByCode($identity->user_code);
				$params[head_org] = $org;
			}
			$params["not_user"] = $identity->user_code;
			$data["group"] = $identity->user_sec_depart;
		}else{
			$data["group"] = $params["group"];
		}

		$data["monthNow"]= $month.$year;
		$data["month"] = $month;
		$data["year"] = $year;

		$data["headPage"] = "สรุปการประเมิน ".$params["type"]." ประจำ  ".$data["month_name"];
    	$data["groupBUOp"] = $cat->getGroupBUList();
		$data["group"] = $params["group"];
		$data["typePage"] = $params["type"];
		$rowsArr = $cat->getAcceptIncentive($params["group"],$data["monthNow"],$data["typePage"],$identity->user_code,$identity->lookup_code,$this->sumIncentive,$this->countAll);

		if($rowsArr["data"]){
			foreach($rowsArr["data"] as $user_sec){

				foreach($user_sec as $user_key){
					if($user_key["mph_user"]){
						$user_Array .= ($user_Array)?",".$user_key["mph_user"]:$user_key["mph_user"];
					}
				}
			}
		}

		$data["dataArr"] = $cat->getUserAccept($params,$user_Array);
		$data["incArr"] = $this->sumIncentive;
		$data["rowsArr"] = $rowsArr["data"];
		//_print($data["rowsArr"]);
		$data["endflow"] = $rowsArr["endflow"];
		if($data["incArr"]){
			foreach($data["incArr"] as $item){
				$totalArr["count_user"] = $this->countAll;
				if($this->countAll)
					$totalArr["sum_incentive"] += $item["sum_incentive"];
				$totalArr["sum_scoll"] += $item["sum_scoll"];
				if($this->countAll)
					$totalArr["average_scoll"] += $item["sum_scoll"]/$this->countAll;
				
			}
		}
		$data["quarterOp"] = $this->quarterOp;
    	$data["monthOp"] = $this->monthOp;
    	$data["totalArr"] = $totalArr;
		$data["lookup_code"] = $identity->lookup_code;
		$data["level"] = $identity->level;
		$data["show"] = $params["show"];
        $view->assign('', $data);
		$view->output('summary/_accept.tpl');
    }
    public function upincenAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		if($params["update"]){
			$cat->UpdateIn($params["mval"],$params["update"]);
		}
	   	exit;
    }

    public function acceptpiAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $params["head"]["user_recive"] = $params["user_recive"];
        $params["head"]["mph_eflow"] = $identity->level_name;
        $params["head"]["user_send"] = $params["user_send"];
//_print($params);exit;
        	if($params["check"]){
				foreach($params["check"] as $item){
					if($item["grade"]){
						$params["head"]["mph_column"] = $item["mph_column"];
						$params["head"]["mph_level_now"] = $item["mph_level_now"];
						$params["head"]["mph_incentive"] = $item["mph_incentive"];
						$mph_id = $cat->acceptPI($item["mph_id"],$params["head"],$item["mph_eflow"],$params['lookup_code']);
					}
				}
				$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Accept Evaluate Incentive","Save");
				if($params["user_recive"] != $params["user_send"]){
			        $mph_month = substr($params["mph_month"],0,2)."/".substr($params["mph_month"],-4);
			        $eForm["email"] = $identity->user_email;
			        $eForm["name"] = $identity->user_name ." ".$identity->user_lname;
					$mail_arr = $cat->GetEmail($params["user_recive"]);
					$mail_to = $mail_arr["user_email"];
					if($mail_to){
						$subject  = "การประเมิน PI ประจำเดือน ".$mph_month;
						$message = "<font size=2>". $eForm["name"] ." ได้ส่ง ใบประเมิน PI ประจำเดือน ".$mph_month." มาถึงคุณเรียบร้อยแล้ว<br>";
						$message .= "กรุณาเข้าระบบประเมิน <a href='http://sfa.icesolution.com/iceworkflow'>http://sfa.icesolution.com/iceworkflow</a> เพื่อทำการประเมิน PI<br><br><br>";
						$message .= "มีปัญหา ในการใช้งานแจ้ง Admin ระบบ</font>";
						$this->sendMail($message,$subject,$mail_to,$eForm);
					}
					if($mail_arr["user_mobile"]){
						$mobile = "66".substr($mail_arr["user_mobile"],-9);
						$message_sms = $identity->user_name." ส่งใบประเมิน PI เดือน ".$mph_month." มาถึงคุณแล้ว กรุณา เข้าระบบประเมิน";
						$sender = "ICEs";
						$this->sms($mobile,$message_sms,$sender);
					}
		        }

			}
		//if($mph_id)echo "'var data = 1';";
			exit;




    }
    public function acceptmiAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $params["head"]["user_recive"] = $params["user_recive"];
        $params["head"]["mph_eflow"] = $identity->level_name;
        $params["head"]["user_send"] = $params["user_send"];

		if($params["check"]){
			foreach($params["check"] as $item){
				if($item["grade"]){
					$params["head"]["mph_column"] = $item["mph_column"];
					$params["head"]["mph_level_now"] = $item["mph_level_now"];
					$params["head"]["mph_incentive"] = $item["mph_incentive"];
					$mph_id = $cat->acceptPI($item["mph_id"],$params["head"],$item["mph_eflow"],'');
				}
			}
			$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Accept Evaluate Incentive","Save");
			if($params["user_recive"] != $params["user_send"]){
		        $mph_month = substr($params["mph_month"],0,2)."/".substr($params["mph_month"],-4);
		        $eForm["email"] = $identity->user_email;
		        $eForm["name"] = $identity->user_name ." ".$identity->user_lname;
				$mail_arr = $cat->GetEmail($params["user_recive"]);
				$mail_to = $mail_arr["user_email"];
				if($mail_to){
					$subject  = "การประเมิน MI ประจำเดือน ".$mph_month;
					$message = "<font size=2>". $eForm["name"] ." ได้ส่ง ใบประเมิน MI ประจำเดือน ".$mph_month." มาถึงคุณเรียบร้อยแล้ว<br>";
					$message .= "กรุณาเข้าระบบประเมิน <a href='http://sfa.icesolution.com/iceworkflow'>http://sfa.icesolution.com/iceworkflow</a> เพื่อทำการประเมิน PI<br><br><br>";
					$message .= "มีปัญหา ในการใช้งานแจ้ง Admin ระบบ</font>";
					$this->sendMail($message,$subject,$mail_to,$eForm);
				}
				if($mail_arr["user_mobile"]){
					$mobile = "66".substr($mail_arr["user_mobile"],-9);
					$message_sms = $identity->user_name." ส่งใบประเมิน MI เดือน ".$mph_month." มาถึงคุณแล้ว กรุณา เข้าระบบประเมิน";
					$sender = "ICEs";
					$this->sms($mobile,$message_sms,$sender);
				}
	        }
		}
		//if($mph_id)echo "'var data = 1';";
		exit;

    }
    public function delrecAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
    	$update = "mst_eva_status = 'N'";
    	$cat->updateMaster("master_evaluate","mst_eva_id",$params["delID"],$update);
    	echo "'var data = 1';";
	   	exit;
    }
	public function deleteAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

		if($params["delID"]){
     		$idArray = explode(",",$params["delID"]);
    		foreach($idArray as $item){
    			$id_del .=($id_del)?",'".$item."'":"'".$item."'";
    		}
    		$update = "mst_eva_status = 'N'";
    		$cat->updateMaster($params["table"],$params["filed_id"],$id_del,$update);
    		$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Delete table ".$params["table"],"Delete");

    		echo "'var data = 1';";
    	}
	   	exit;
    }
    public function delhisAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

		if($params["delID"]){
     		$idArray = explode(",",$params["delID"]);
    		foreach($idArray as $item){
    			$id_del .=($id_del)?",'".$item."'":"'".$item."'";
    		}
    		$cat->deleteMaster('eva_mipi_head','mph_id',$id_del);
    		$cat->deleteMaster('eva_mipi_line','mph_id',$id_del);
    		$cat->deleteMaster('eva_mipi_subline','mph_id',$id_del);
    		$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Delete table "."eva_mipi_head","Delete");
    		$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Delete table "."eva_mipi_line","Delete");

    		echo "'var data = 1';";
    	}
	   	exit;
    }
    public function copyAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$rows = $cat->getDataCopy($params);
		if($rows)
			echo "'var data = 1';";
	   	exit;
    }

    // Add status finish for backward process.
    // Natcha # 06 Jun 2014.
    public function backwardAction() 
    {
    	$cat 	= $this->getGeneric();
    	$params = $this->getParams();
    	$view 	= $this->_getView();
    	
    	if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
    	$auth = Zend_Auth :: getInstance();
    	$identity = $auth->getIdentity();
    	
    	if(empty($params['search'])) {
    		$data['month'] 	= date('m');
    		$data['year']	= date('Y');
    	} else {
    		$data['month']	= $params['search']['month'];
    		$data['year']	= $params['search']['year'];
    	}
    	
    	$where['mph_month'] = $data['month'] . $data['year'];
    	if($params['group']) {
    		$data['group'] 				= $params['group'];
    		$where['o.user_sec_depart'] = $params['group'];
    	}
    	
    	// Submit backward.
    	if($params['backwardaction']) {
    		if(!empty($params['mph_id'])) {
    			foreach($params['mph_id'] as $mphId) {
    				// Find subline id for backward approve.
    				$item[$mphId] = $cat->getLastSubLinePI($mphId);
    				// Backward process.
    				$cat->backwardPIProcess($mphId, $item[$mphId]['sl_id'], $item[$mphId]['mph_column']);
    			}
    		}
    	}
    	
    	$rows = array();
    	if($identity->lookup_code == 'AM'){
    		$rows	= $cat->getFinishList($where);
    	}
    	
    	$data['monthOp']	= $this->monthOp;
    	$data['yearOp']		= $this->genYearOption();
    	$data['groupBUOp'] 	= $cat->getGroupBUList();
    	
    	$data["items"] 		= $rows["data"];
    	$data["totalRecord"]= $rows["total"];
    	$data["perpage"]    = $this->per_page;
    	$data["page"]  		= $params["page"]?$params["page"]:1;
    	$data["url"]  		= $this->prepareUrl();
    	
    	$view->assign('', $data);
    	$view->output('backward.tpl');
    }
    
    public function genYearOption()
    {
    	$yearArr= array();
    	$year 	= date('Y');
    	$start 	= $year-2;
    	$end	= $year+1;
    	
    	for($i=$start; $i<=$end; $i++) {
    		$yearArr[$i] = $i;
    	}
    	
    	return $yearArr;
    }
    
    public function errpermissionAction() {
    	$params = $this->getParams();
    	$view 	= $this->_getView();
    	
    	$data['msg'] = "You not permission!!";
    	
    	$view->assign('', $data);
    	$view->output('error.tpl');
    }
    
    public function updatedetailpibyadminAction(){
    	$cat = $this->getGeneric();
    	$params = $this->getParams();
    	$view = $this->_getView();
    
    	if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
    	$auth = Zend_Auth :: getInstance();
    	$identity = $auth->getIdentity();
    	
    	if($params['chk']=='1'){
    		$code_arr = explode(":",$params["key_chk"]);
    		foreach($code_arr as $val) {
    			if($params['page_status'][$val] !='E'){
    				if($params['user_recive_popup'])$params['user_recive'][$val] = $params['user_recive_popup'];
    				// find this.
    				if($params['user_recive'][$val] == $params['user_send'][$val]) {
    					if($params['status']=='F') {
    						$insert_subl = "ok";
    						$params['head'][$val]['mph_status'] = 'F';
    						$params['head'][$val]['mph_column'] = $params['loopCol'][$val]+1;
    					}else{
    						$params['head'][$val]['mph_column'] = $params['loopCol'][$val];
    					}
    				}else{
    					if($params['old_status'][$val] == 'P'){
    						$params['head'][$val]['mph_column'] = $params['loopCol'][$val]+1;
    						$insert_subl = "ok";
    					}elseif($params['old_status'][$val] == 'C'){
    						$params['head'][$val]['mph_column'] = $params['loopCol'][$val];
    					}else{
    						$check_date = $cat->checkDateSend($identity->level,$params['user_recive'][$val]);
    						if($check_date == 'N')$params['head'][$val][mph_status] = 'R';
    					}
    					// Add because admin request finish by detail button on June 2014.
    					// Natcha - 17 June 2014
    					if($params['status']=='F') {
    						$params['head'][$val]['mph_status'] = 'F';
    					}
    				}
    			}
    
    			$params['head'][$val]['mph_user_flow'] = $params['user_recive'][$val];
    			$params['head'][$val]["user_send"] = $params["user_send"][$val];
    			$params['head'][$val]['mph_datetime'] = date('Y-m-d H:i:s');
    			$head_arr = $params['head'][$val];
    			
    			$cat->updatePIAcpDetail($head_arr,$val,$params,$insert_subl);
    			
    			$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Update Evaluate PI","Save");
    			if($params['user_recive'][$val] != $params['user_send'][$val]){
    				$mph_month = substr($params['head'][$val]['mph_month'],0,2)."/".substr($params['head'][$val]['mph_month'],-4);
    				$eForm["email"] = $identity->user_email;
    				$eForm["name"] = $identity->user_name ." ".$identity->user_lname;
    				//$mail_to = 'siriphan@icesolution.com';
    				$mail_arr = $cat->GetEmail($params['user_recive'][$val]);
    				$owner = $cat->GetName($params['head'][$val]['mph_user']);
    				$mail_to = $mail_arr["user_email"];
    				if($mail_to){
    					$subject  = "การประเมิน PI ประจำเดือน ".$mph_month." ของคุณ ".$owner["user_name"]." ".$owner["user_lname"];
    					$message  = "<font size=2>เรียนคุณ   ".$mail_arr["user_name"]." ".$mail_arr["user_lname"]."<br><br>";
    					$message .= "คุณ ". $eForm["name"] ." ได้ส่งใบประเมิน PI พนักงานประจำเดือน ".$mph_month." ของคุณ ".$owner["user_name"]." ".$owner["user_lname"]." มาถึงคุณเรียบร้อยแล้ว<br>";
    					$message .= "กรุณาเข้าระบบประเมิน <a href='http://sfa.icesolution.com/iceworkflow'>http://sfa.icesolution.com/iceworkflow</a> เพื่อทำการประเมิน PI พนักงาน<br><br><br>";
    					$message .= "มีปัญหา ในการใช้งานแจ้ง Admin ระบบ</font>";
    					$this->sendMail($message,$subject,$mail_to,$eForm);
    				}
    			}
    		}
    	}
    
    	if($check_date == 'N') echo "\$('#checksend').val('".$check_date."');";
    	echo "'var data = 1';";
    	exit;
    
    }
}