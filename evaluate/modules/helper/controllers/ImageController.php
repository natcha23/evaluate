<?php
/**
 *  This is the main controller of the Application. If the user enters
 *  the domain of the site, this is the controller they are routed to.
 **/
if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');

class Helper_ImageController extends Workflow_Controller_Flow_Action {

    public function indexAction() {
		/**
		 * Retrieve the view from zend registry. This view belong to the
		 * App_View_Smarty class. It contains the override functions
		 * for smarty and every function of smarty can be called here.
		 * */
	}

	public function resizeAction() {
	    $params = $this->getParams();
	    $image  = APP_DIR."/docs/productImage/productHead/".$params['img'].".jpg";
	    list($w,$h) = explode('x',$params['size']);
	    if(!class_exists('Workflow_Services_Image'))
	        Zend_Loader :: loadClass('Workflow_Services_Image');
	    Workflow_Services_Image::resizeJpg(array('image'=>$image,'width'=>$w,'height'=>$h));
	    exit;
	}
}