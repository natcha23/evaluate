<?php
/**
 *  This is the main controller of the Application. If the user enters
 *  the domain of the site, this is the controller they are routed to.
 **/
if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');
class Account_AccountController extends Workflow_Controller_Flow_Action {

	public function indexAction() {
    	 
//     	$this->_redirect("/authen/index/iauth");
    
    	 
    	#echo "<pre>";echo get_include_path();exit;
    	$cat = $this->getGeneric();
    	$view = $this->_getView();
    
    	if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
    	$auth = Zend_Auth :: getInstance();
    	$identity = $auth->getIdentity();
    	//_print($identity);
    
    	$view->output('account/login.tpl');
    }
    
    

}