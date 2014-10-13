<?php
if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');
class Master_OrganizeController extends Workflow_Controller_Flow_Action {
	protected $per_page = "20";
	public $statusOp = array('Y'=>'Active','N'=>'Inactive');
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

		if((!$_POST["keyword"] && !$_POST["status"]) && !$params["page"]){
	        unset($_SESSION["Search"]);
	    }
        $params["keyword"] = ($_POST["keyword"])?$_POST["keyword"]:$_SESSION["Search"]["kw"];
		$params["status"] = ($_POST["status"])?$_POST["status"]:$_SESSION["Search"]["ks"];

		if($params["keyword"])$_SESSION["Search"]["kw"] = $params["keyword"];
		if($params["status"])$_SESSION["Search"]["ks"] = $params["status"];
 
        
        $data["headPage"] = "Organize Management";
        if($params["status"])$params["status"] = $params["status"];else $params["status"] = 'Y';
        
        $rows = $cat->getOrganize($params,$params["page"],$this->per_page);
		$data["keyword"] = $params["keyword"];
   		$data["rows"] = $rows["data"];
   		$data["totalRecord"] = $rows["total"];
        $data["perpage"]     = $this->per_page;
        $data["page"]  = $params["page"]?$params["page"]:1;
        $data["url"]  = $this->prepareUrl();

        $data["userOp"] = $cat->getAccountOp();
        $data["statusOp"] = $this->statusOp;
        $data["status"] = $params["status"];

        $view->assign('', $data);
    	$view->output('organize/_list.tpl');
    }
    public function frmAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
		if($params[save]){
   			$id_key = $params["fields"]["org_sec_id"];

	        $id = $cat->saveMaster('org_sec','org_sec_id',$id_key,$params["fields"]);
	        if($params["org_sec_code_old"] && $params["org_sec_code_old"] == $params["fields"]["org_sec_code"]){
   				$uArr["user_sec_depart"] = $params["fields"]["org_sec_code"];
   				$cat->saveMaster('user','user_sec_depart',$params["org_sec_code_old"],$uArr);
   			}
   			$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Organize Management","Save");
	        echo "<script>window.location.href = '/".projectName."/master/organize/display';</script>";
	        exit;
		}

        $data["headPage"] = "Organize Management";
		$data["rows"] = $cat->getOrganizeById($params["id"]);
		$data["statusOp"] = $this->statusOp;
		$data["mode"] = $params["mode"];

        $view->assign('', $data);
    	$view->output('organize/_form.tpl');
    }
    public function checkAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
    	$rows = $cat->checkCode($params["chk"]);
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
     		$cat->deleteMaster("org_sec","org_sec_id",$id_del);
     		$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Delete Organize Management","Delete");
    	}
		echo "'var data = 1';";
	   	exit;
    }



}
