<?php
if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');
class Master_SettingController extends Workflow_Controller_Flow_Action {
	protected $per_page = "20";
	public $StepOp = array('P'=>'Process');
	private function prepareUrl() {
    	return $this->getRequest()->getRequestUri();
    }
	public function displayAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $data["headPage"] = "Header Setting Management";
        $rows = $cat->getDataList($params,$params["page"],$this->per_page);
		$data["keyword"] = $params["keyword"];
   		$data["rows"] = $rows["data"];
   		$data["totalRecord"] = $rows["total"];
        $data["perpage"]     = $this->per_page;
        $data["page"]  = $params["page"]?$params["page"]:1;
        $data["order_by"] = $this->SortTable();
        $data["url"]  = $this->prepareUrl();
        $data["StepOp"] = $this->StepOp;

        $view->assign('', $data);
    	$view->output('setting/_list.tpl');
    }
    public function frmAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
		if($params[save]){
   			$id_key = $params["fields"]["hs_id"];
   			if(!$id_key){
   				$params["fields"]["createdate"] = date('Y-m-d H:i:s');
   			}
	        $params["fields"]["updatetime"] = date('Y-m-d H:i:s');
	        $params["fields"]["user_create"] = $identity->user_code;

	        $id = $cat->saveMaster('head_setting','hs_id',$id_key,$params["fields"]);
   			$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Header Setting Management","Save");
	        echo "<script>window.location.href = '/".projectName."/master/setting/display';</script>";
	        exit;
		}

        $data["headPage"] = "Header Setting Management";
		$data["rows"] = $cat->getDataById($params["id"]);
		$data["StepOp"] = $this->StepOp;
		$data["userHeader"] = $cat->getUserHeader();
		$data["mode"] = $params["mode"];

        $view->assign('', $data);
    	$view->output('setting/_form.tpl');
    }
    public function checkAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
    	$rows = $cat->checkCode($params);
    	if($rows){echo "'var data = 1';";exit;}
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
     		$cat->deleteMaster("head_setting","hs_id",$id_del);
     		$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Delete Header Setting Management","Delete");
    	}
		echo "'var data = 1';";
	   	exit;
    }



}
