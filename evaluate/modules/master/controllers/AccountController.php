<?php
if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');
class Master_AccountController extends Workflow_Controller_Flow_Action {
	protected $per_page = "20";
	public $headerOp = array('Y'=>' Header','N'=>' Other');
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
        
        
        //if($params["page"])$_POST["key_main"]=($_POST["key_main"])?$_POST["key_main"]:$_SESSION["Search"]["km"];
		if((!$_POST["keyword"] && !$_POST["status"]) && !$params["page"]){
	        unset($_SESSION["Search"]);
	    }
		$params["keyword"] = ($_POST["keyword"])?$_POST["keyword"]:$_SESSION["Search"]["kw"];
		$params["status"] = ($_POST["status"])?$_POST["status"]:$_SESSION["Search"]["ks"];

		if($params["keyword"])$_SESSION["Search"]["kw"] = $params["keyword"];
		if($params["status"])$_SESSION["Search"]["ks"] = $params["status"];
                            

        $data["headPage"] = "Account Authen Management";
   		$data["keyword"] = $params["keyword"];

//_print($_SESSION["Search"]);
//_print($params);
   		//if($params["status"])$_SESSION["status"] = $params["status"];else $_SESSION["status"] = $_SESSION["status"];
		if($params["status"])$params["status"] = $params["status"];else $params["status"] = 'Y';
		//$params["status"] = $_SESSION["status"];

		$rows = $cat->getAccount($params,$params["page"],$this->per_page);
		$data["rows"] = $rows["data"];
		$data["status"] = $params["status"];
   		$data["totalRecord"] = $rows["total"];
   		$data["statusOp"] = $this->statusOp;
        $data["perpage"]     = $this->per_page;
        $data["page"]  = $params["page"]?$params["page"]:1;
        
        $data["url"]  = $this->prepareUrl();
        $data["order_by"] = $this->SortTable();

        $view->assign('', $data);
    	$view->output('account/_list.tpl');
    }
    public function indexAction() {
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
        
        $data["headPage"] = "Account Salary Management";
   		$data["keyword"] = $params["keyword"];
		if($params["status"])$params["status"] = $params["status"];else $params["status"] = 'Y';

		$rows = $cat->getAccount($params,$params["page"],$this->per_page);
		$data["rows"] = $rows["data"];
		$data["status"] = $params["status"];
   		$data["totalRecord"] = $rows["total"];
   		$data["statusOp"] = $this->statusOp;
        $data["perpage"]     = $this->per_page;
        $data["page"]  = $params["page"]?$params["page"]:1;
        $data["url"]  = $this->prepareUrl();
        $data["order_by"] = $this->SortTable();
		$data["type"] = 'Sal';
        $view->assign('', $data);
    	$view->output('account/_list.tpl');
    }
    public function salaryAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        $data["headPage"] = "Account Salary Management";
   		$data["keyword"] = $params["keyword"];
		$data["account"] = $cat->getAccountByCode($params);

		$rows = $cat->getSalary($params,$params["page"],$this->per_page,$this->dataArr);
		$data["rows"] = $rows["data"];
		$data["dataArr"] = $this->dataArr;
 		$data["totalRecord"] = $rows["total"];
        $data["perpage"]     = $this->per_page;
        $data["page"]  = $params["page"]?$params["page"]:1;
        $data["url"]  = $this->prepareUrl();
		$data["type"] = 'Sal';
        $view->assign('', $data);
    	$view->output('account/_salary.tpl');
    }
    public function salfrmAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

    	if($params[save]){
   			$id_key = $params["fields"]["sal_id"];
   			if(!$id_key){
   				$params["fields"]["createdate"] = date('Y-m-d H:i:s');
   			}
   			$params["fields"]["user_code"] = $params["user_code"];
			$params["fields"]["salary"] = base64_encode($params["user_code"].":".$params["fields"]["salary"]);
	        $params["fields"]["updatetime"] = date('Y-m-d H:i:s');
	        $params["fields"]["user_create"] = $identity->user_code;

	        $id = $cat->saveMaster('acc_salary','sal_id',$id_key,$params["fields"]);
	        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Salary Management","Save");

			echo "<script>window.location.href = '/".projectName."/master/account/salary/user_code/".$params["fields"]["user_code"]."';</script>";
	        exit;
    	}
    	$data["headPage"] = "Account Salary Management";
    	$data["account"] = $cat->getAccountByCode($params);
    	$data["rows"] = $cat->getSalaryById($params);
    	$data["mode"] = $params["mode"];
    	$data["user_code"] = $params["user_code"];
    	$data["type"] = 'Sal';
        $view->assign('', $data);
    	$view->output('account/_salaryfrm.tpl');

    }
	public function accfrmAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
        $data['rand'] = rand(0,9999);
        
   		if($params[save]){
   			$id_key = $params["fields"]["user_id"];
  			if($identity->lookup_code == 'AM'){
	  			if(!$id_key){
		        	$params["fields"]["u_password"] = md5($params["fields"]["u_password"]);
		    	}else{
		    		if($params["u_password"]==$params["fields"]["u_password"]){
		    			$params["fields"]["u_password"] = $params["u_password"];
		    		}else{
		    			$params["fields"]["u_password"] = md5($params["fields"]["u_password"]);
		    		}
		    	}

				if(!$params["fields"]["user_header"])$params["fields"]["user_header"] = 'N';
				if(!$params["fields"]["incentive_active"])$params["fields"]["incentive_active"] = 'N';
	    	}
	        $params["fields"]["updatetime"] = date('Y-m-d H:i:s');
	        $params["fields"]["user_create"] = $identity->user_code;
	        if($params["position_old"]!=$params["fields"]["user_position"] || $params["dept_old"]!=$params["fields"]["user_sec_depart"] || $params["level_old"] != $params["level_new"]){
	        	$his["user_code"] = $params["fields"]["user_code"];
	        	$his["org_sec"] = $params["fields"]["user_sec_depart"];
	        	$his["position"] = $params["fields"]["user_position"];
	        	$his["level"] = $params["level_new"];
	        	$his["createdate"] = date('Y-m-d H:i:s');

	        	//_print($his);
	        	$cat->saveMaster('acc_history_level','id','',$his);
	        }
			//_print($params);exit;
	        $id = $cat->saveMaster('user','user_id',$id_key,$params["fields"]);

	        if($_FILES["picture"]["name"]){
		        if($params["picture_old"] && file_exists(UPLOAD_PATH."/account/".$params["picture_old"]))
					@unlink(UPLOAD_PATH."/account/".$params["picture_old"]);
				$picture_ext = strtolower(substr($_FILES['picture']['name'], strrpos($_FILES['picture']['name'],".")+1));
				if($params["fields"]["user_code"])
					$filename["images"]= "account_".$params["fields"]["user_code"].".".$picture_ext;
				else
					$filename["images"]= "account_c".$id.".".$picture_ext;
				if (!move_uploaded_file($_FILES["picture"]["tmp_name"], UPLOAD_PATH."/account/".$filename["images"])) die ('CANNOT MOVE UPLOAD PICTURE (S)');

				$data["images"]["user_image"] = $filename["images"];
				$cat->saveMaster('user','user_id',$id,$data["images"]);
		        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Account Management","Save");
	        }
			if($identity->lookup_code == 'AM') {
	        	echo "<script>window.location.href = '/".projectName."/master/account/display';</script>";
			}else{
	        	echo "<script>window.location.href = '/".projectName."/master/account/accfrm/id/".$id."/mode/edit';</script>";
			}
	        exit;
   		}

		if($identity->lookup_code != "AM") {
	   		if($params['id'] != $identity->user_id) {
	   			echo "<script>window.location.href = '/".projectName."/workflow/evaluate/errpermission';</script>";
	   			exit;
	   		}
   		}
        $data["headPage"] = "Account Management";
        $data["rows"] = $cat->getAccountById($params["id"]);
		if($data["rows"])$data["status"] = $data["rows"]["user_active"];else $data["status"] = 'Y';

   		$data["mode"] = $params['mode'];
   		$data["headerOp"] = $this->headerOp;
   		$data["statusOp"] = $this->statusOp;
   		$data["positionOp"] = $cat->getPositionOp();
   		$data["groupMenuOp"] = $cat->GetGroupMenuOp();
   		$data["departmentOp"] = $cat->getDepartmentOp();
		$data["UPLOAD_URL"] = UPLOAD_URL;
        $view->assign('', $data);
    	$view->output('account/_form.tpl');
    }
    public function getlevalAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$level = $cat->GetLevel($params[position]);
		echo $level[org_position_level];
		exit;
    }
    public function changepwdAction(){
    	$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

		if($params["save"]){
   			$id_key = $params["fields"]["user_id"];
			$params["fields"]["u_password"] = md5($params["fields"]["u_password"]);
			$params["fields"]["updatetime"] = date('Y-m-d H:i:s');
	        $params["fields"]["user_create"] = $identity->user_code;
	        $id = $cat->saveMaster('user','user_id',$id_key,$params["fields"]);

		    $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Change Password","Save");

	        echo "<script>window.location.href = '/".projectName."/master/account/changepwd';</script>";
	        exit;
		}

        $data["headPage"] = "Change Password";
        $data["rows"] = $cat->getAccountById($identity->user_id);

   		$data["mode"] = 'edit';
        $view->assign('', $data);
    	$view->output('account/_changepwd.tpl');
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
    		$cat->inactiveUser('user','user_id',$id_del);
    		$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Delete User","Delete");
    	}
		echo "'var data = 1';";
	   	exit;
    }

}
