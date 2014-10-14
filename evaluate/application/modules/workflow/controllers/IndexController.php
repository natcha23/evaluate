<?php

if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');

class Workflow_IndexController extends Workflow_Controller_Flow_Action {
	
	
	private function prepareUrl(){
		return $this->getRequest()->getRequestUri();
	}
	
	public function portalAction() {
// 		echo 'workflow/index/index';exit;
// 		$cat	= $this->getGeneric();
		$view 	= $this->_getView();
// 		$view	= new Zend_View();
		$params = $this->getParams();
// 		_print($view);exit;
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
		$auth = Zend_Auth :: getInstance();
		$identity = $auth->getIdentity();
		
		$data[headPage] = "Evaluate Master";
// 		$data["rows"] = $cat->getEvaluateMST($params,$params["page"], $this->per_page);
		
		$data["keyword"] = $params["keyword"];
		$data[mId] = $params['menu_id'];
		
		$this->render();
	}
	
}