<?php
if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');
class Master_MasterController extends Workflow_Controller_Flow_Action {
	public function gradeAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $data[headPage] = "Grade Master Management";
        $data[rows] = $cat->getGradeMST();


        $view->assign('', $data);
    	$view->output('grade.tpl');
    }
    public function groupAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $data[headPage] = "Group Master Management";
        $data[rows] = $cat->getGroupMST();

        $view->assign('', $data);
    	$view->output('group.tpl');
    }
    public function typemstAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $data[headPage] = "Type Master Management";
        $data[rows] = $cat->getTypeMST($params);
        $data[mId] = $params['menu_id'];
        $data["keyword"] = $params["keyword"];

        $view->assign('', $data);
    	$view->output('typemst.tpl');
    }

    public function typemstfromAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
#_print($params);
        $data[headPage] = "Type Master Management";
        $data[rows] = $cat->getTypeMSTById($params);
        $data[mId] = $params['menu_id'];
   		$data[mode] = $params['mode'];
		$pageUrl = "master/master/typemst/menu_id/{$params[menu_id]}";
   		$data[pageUrl] = $pageUrl;

   		if($params[save]){
   			$id_key = $params[fields][type_id];
	        $params[fields][datetime] = date('Y-m-d H:i:s');
	        $params[fields][u_create] = $identity->account_code;
	        $id = $cat->saveMaster('master_type','type_id',$id_key,$params);
	        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,$data[headPage],"Save");
			$this->_redirect("$pageUrl");
   		}

        $view->assign('', $data);
    	$view->output('typemstfrom.tpl');
    }
    public function delgradeAction(){
    	$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();

		$cat->delGradeMaster($params);

		echo "'var data = 1';";
	   	exit;
    }
    public function groupfrmAction() {
    	$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();

		$data[rows] = $cat->getGroupById($params);
		$data[mode] = $params[mode];

		$data[headPage] = "Group Master Management";
		$view->assign('', $data);
    	$view->output('groupfrm.tpl');
    }
    public function gradefrmAction() {
    	$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

		if($params[save]){
			$params[fields][datetime] = date('Y-m-d H:i:s');
	        $params[fields][u_create] = $identity->user_code;

	        $cat->saveGradeMaster($params);
	        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Grade Master","Save");

	        $pageUrl = "master/master/grade";
   			$this->_redirect($pageUrl);
		}

		$data[rows] = $cat->getGradeById($params[grade]);
		$data[mode] = $params[mode];

		$data[headPage] = "Grade Master Management";
		$view->assign('', $data);
    	$view->output('gradefrm.tpl');
    }
    public function savegradeAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();


        $params[fields][datetime] = date('Y-m-d H:i:s');
        $params[fields][u_create] = $identity->user_code;


        $cat->saveGradeMaster($params);exit;
        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Grade Master","Save");

    	echo "'var data = 1';";
	   	exit;
    }
    public function savegroupAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();


        $params[fields][datetime] = date('Y-m-d H:i:s');
        $params[fields][u_create] = $identity->user_code;


        $cat->saveGroupMaster($params);
        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Group Master","Save");

    	echo "'var data = 1';";
	   	exit;
    }
    public function savelevelAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

		$params[fields][money] = base64_encode($params[fields][money]);
        $params[fields][datetime] = date('Y-m-d H:i:s');
        $params[fields][u_create] = $identity->user_code;


        $cat->saveLevelMaster($params);
        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Level Master","Save");

    	echo "'var data = 1';";
	   	exit;
    }
    public function levelshowAction(){
    	$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();

		$grade = $cat->getGradeMST2();
		$level = $cat->getLevelMST();
		$rows = $cat->getIncentive();
		$data[grade] = $grade;
		$data[level] = $level;
		$data[rows] = $rows;

		$data[headPage] = "Level By Grade Master Management";
		$data["keyword"] = $params["keyword"];
		$view->assign('', $data);
    	$view->output('levelshow.tpl');
    }
    public function levelAction(){
    	$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();

		$grade = $cat->getGradeById($params[id]);
		if($grade){
			$params[grade] = $grade[grade];
			$data[rows] = $cat->getLevelByGrade($params);
			$data[grade] = $params[grade];
			$data[grid] = $grade[gr_id];
		}
		$data[headPage] = "Level By Grade Master Management";
		$data["keyword"] = $params["keyword"];
		$view->assign('', $data);
    	$view->output('level.tpl');
    }
    public function levelfrmAction(){
    	$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $grade = $cat->getGradeById($params[grade]);

		if($params[save]){
			$params[fields][money] = base64_encode($params[fields][money]);
	        $params[fields][datetime] = date('Y-m-d H:i:s');
	        $params[fields][u_create] = $identity->user_code;
	        $params[fields][grade] = $grade[grade];

	        $cat->saveLevelMaster($params);
	        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Level Master","Save");

	        $pageUrl = "master/master/level/grade/".$grade[grade]."/id/".$grade[gr_id];
   			$this->_redirect($pageUrl);
		}
		if($params[id]){
			$rows = $cat->getLevelById($params);
			$data[rows] = $rows;
		}
		$grade = $cat->getGradeById($params[grade]);
		$data[mode] = $params[mode];
		$data[groupOp] = $cat->getGroupOp();
		$data[levelOp] = $cat->getLevelOp();
		$data[grade] = $grade[grade];
		$data[grid] = $grade[gr_id];
		$data[headPage] = "Level Master Management";
		$view->assign('', $data);
    	$view->output('levelfrm.tpl');
    }
    public function senddateAction(){
    	$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		$data["rows"] = $cat->getSendDate($params);
		$data["headPage"] = "Config Send Date Management";
		$data["keyword"] = $params["keyword"];
		$view->assign('', $data);
    	$view->output('senddate.tpl');
    }
    public function checkAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();

        $check = $cat->checkData($params);

		if($check)echo "'var data = 1';";

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
    		$cat->deleteMaster($params["table"],$params["filed_id"],$id_del);
    		$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Delete table ".$params["table"],"Delete");

    		echo "'var data = 1';";
    	}
	   	exit;
    }
    public function senddatefrmAction(){
    	$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

		if($params["save"]){
			$id_key = $params[fields][config_id];
			if(!$id_key)
	        	$params[fields][createdate] = date('Y-m-d H:i:s');

	        $params[fields][updatetime] = date('Y-m-d H:i:s');
	        $params[fields][user_create] = $identity->user_code;

	        $id = $cat->saveMaster('config_senddate','config_id',$id_key,$params);
	        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Config Send Date","Save");

	        echo "<script>window.location.href = '/".projectName."/master/master/senddate';</script>";
	        exit;
		}

		$data["rows"] = $cat->getSendDateById($params["id"]);
		$data["levelOp"] = $cat->getLevelOp();
		$data["headPage"] = "Config Send Date Management";

		$view->assign('', $data);
    	$view->output('senddatefrm.tpl');
    }

}
