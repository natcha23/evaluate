<?php
class Workflow_Controller_Flow_Action extends Workflow_Controller_Action {
    /**
     * Default action
     * @var string
     */
	protected $_defaultAction = 'index';

    /**
     * Default controller
     * @var string
     */
    protected $_defaultController = 'account';

    /**
     * Default module
     * @var string
     */
    protected $_defaultModule = 'account';

    protected $_vat = 0;

    function init() {
    	
        parent::init();
        
        $public_urls = Zend_Registry::get("public_urls");
        $data["params"] = $this->_request->getParams();
//         echo '<pre>' .debug_print_backtrace() . '</pre>';
//         echo '<pre>' . print_r($this->_request,1).'</pre>';exit;
        $profile = $this->getProfile();
      
		if(empty($profile->user_code) && $data['params']['module']!="account" 
										&& $data['params']['module']!="controller" 
										&& $data['params']['action']!="index") {
			
			// Go to login page.
// 			$this->_redirect("/account/account/index/");
			$this->_redirect("/workflow/evaluate/urecive/");
			
		} else {

			// Login success.
			if(!empty($profile)) {
			
				if( $profile->lookup_code != 'AM' && $profile->level < '7'){
					if( ($profile->user_code != $data['params']['user']) && $data['params']['status'] =='W'){				
						$this->_redirect("/workflow/evaluate/urecive/");
					}
				}		
				if($profile->lookup_code !='AM' && ($profile->level < '7' && $data['params']['controller']=="summary")){
					
					$this->_redirect("/workflow/evaluate/urecive/");
				}
			
			}
		
		}
		
// 		$api = new System_Controller;
// 		$api::getGeneric("systemapi", "systemapi");
		
	    $api = System_Controller::getGeneric("systemapi", "systemapi");
// 		$api = getGeneric("systemapi", "systemapi");
	    
	    $controller = $this->getRequest()->getControllerName();
	    $moduleName= $this->getRequest()->getModuleName();
	    $action = $this->getRequest()->getActionName();
	    
// 	    Zend_Debug::dump($controller);
// 	    Zend_Debug::dump($action);

	    if(!$this->isAjax()) {
	        $view = Zend_Registry :: get("view");
	        
	       	$data["_title"] = "::.Responsive Evaluation System .::";
	       	$data["UPLOAD_URL"] = UPLOAD_URL;
	       	$data["UPLOAD_PATH"] = UPLOAD_PATH;
	       	$data["_menuLeft"] = $api->renderLeftMenu($data["params"]);
	       	$data["_menuTop"] = $api->renderTopMenu($data["params"]);

	       	$data["_monthPIOp"] = array('01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน',
						   			    '07'=>'กรกฎาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');

	       	//$data["_monthMIOp"] = array('01'=>'มกราคม','04'=>'เมษายน','07'=>'กรกฎาคม','10'=>'ตุลาคม');
	       	$data["_monthMIOp"] = array('Q1'=>'Quarter 1','Q2'=>'Quarter 2','Q3'=>'Quarter 3','Q4'=>'Quarter 4');
	        $data["_gradeOption"] = $api->getGradeData(&$scollArr);
	        $data["_scollOption"] = $scollArr;
	        
	        // Summary Evaluation Status #natcha 16 Jun 2014.
	        if(!empty($data['params']['search'])) {
	        	
		        $data['curMonth'] 	= $data['params']['search']['month'];
		        $data['curYear'] 	= $data['params']['search']['year'];
		        if(empty($data['curYear']) && empty($data['curMonth'])) {
		        	$data['curYear']	= date('Y');
		        	$data['curMonth']	= date('m');
		        }
		        
		        $badge 	= $api->getSummaryBadge($data['curMonth'].$data['curYear']);
		        $data['yearOpt'] 	= $this->genYearOption();
		        $data['badge'] 		= $badge;
	        }
	        
	        // Assign global vars.
	        //$view->assign("",$data);
	        $view->data = $data;

	        // Save view object.
	        Zend_Registry :: set("view",$view);
        }

        if ($this->_output == "html") {
            if(Zend_Registry::isRegistered("view")) {
                $view = Zend_Registry::get("view");
            } else {
                $view = new Smarty_View();
            }
            //$view->_smarty->register_function("html_topmenu", array($this,"html_topmenu"));
            Zend_Registry :: set("view", $view);
        }

    }
    
    function __init() {
    	 
    	parent::init();
    
    	$profile = $this->getProfile();
    
    	$data["params"] = $this->_request->getParams();
    
    	$public_urls = Zend_Registry :: get("public_urls");
    
    	if(!$profile->user_code && $data[params][module]!="account"
    			&& $data[params][module]!="controller"
    					&& $data[params][action]!="index"){
    			
    		$this->_redirect("/account/account/index/");
    	}
    
    	if($profile->lookup_code !='AM' && $profile->level < '7'){
    		if( ($profile->user_code != $data['params']['user']) && $data['params']['status'] =='W'){
    			$this->_redirect("/workflow/evaluate/urecive/");
    		}
    	}
    	if($profile->lookup_code !='AM' && ($profile->level < '7' && $data['params']['controller']=="summary")){
    			
    		$this->_redirect("/workflow/evaluate/urecive/");
    	}
    	$api = System_Controller::getGeneric("systemapi","systemapi");
    	 
    	$controller = $this->getRequest()->getControllerName();
    	$moduleName= $this->getRequest()->getModuleName();
    	$action = $this->getRequest()->getActionName();
    	 
    	// 	    Zend_Debug::dump($controller);
    	// 	    Zend_Debug::dump($action);
    
    	if(!$this->isAjax()) {
    		$view = Zend_Registry :: get("view");
    		 
    		$data["_title"] = "::.Responsive Evaluation System .::";
    		$data["UPLOAD_URL"] = UPLOAD_URL;
    		$data["UPLOAD_PATH"] = UPLOAD_PATH;
    		$data["_menuLeft"] = $api->renderLeftMenu($data["params"]);
    		$data["_menuTop"] = $api->renderTopMenu($data["params"]);
    
    		$data["_monthPIOp"] = array('01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน',
    				'07'=>'กรกฎาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
    
    		//$data["_monthMIOp"] = array('01'=>'มกราคม','04'=>'เมษายน','07'=>'กรกฎาคม','10'=>'ตุลาคม');
    		$data["_monthMIOp"] = array('Q1'=>'Quarter 1','Q2'=>'Quarter 2','Q3'=>'Quarter 3','Q4'=>'Quarter 4');
    		$data["_gradeOption"] = $api->getGradeData(&$scollArr);
    		$data["_scollOption"] = $scollArr;
    		 
    		// Summary Evaluation Status #natcha 16 Jun 2014.
    		$data['curMonth'] 	= $data['params']['search']['month'];
    		$data['curYear'] 	= $data['params']['search']['year'];
    		if(empty($data['curYear']) && empty($data['curMonth'])) {
    			$data['curYear']	= date('Y');
    			$data['curMonth']	= date('m');
    		}
    		$badge 	= $api->getSummaryBadge($data['curMonth'].$data['curYear']);
    		$data['yearOpt'] 	= $this->genYearOption();
    		$data['badge'] 		= $badge;
    		 
    		 
    		// Assign global vars.
    		$view->assign("",$data);
    
    		// Save view object.
    		Zend_Registry :: set("view",$view);
    	}
    
    	if ($this->_output == "html") {
    		if(Zend_Registry::isRegistered("view")) {
    			$view = Zend_Registry::get("view");
    		} else {
    			$view = new Smarty_View();
    		}
    		$view->_smarty->register_function("html_topmenu", array($this,"html_topmenu"));
    		Zend_Registry :: set("view", $view);
    	}
    
    }
    
    public function html_topmenu($params, &$smarty) {
    	if(!$params['table']) $params['table'] = "menu_master";
        if(!class_exists("System_Menu"))
            Zend_Loader::loadClass("System_Menu");
        $_menu = null;
        $_menu = System_Menu::factory("Dbtree", array("tablename" => $params['table']));
        System_Menu::setDefaultAdapter($_menu);
        $data = $this->getMenuByLevel($_menu);
        if(!class_exists("Workflow_Menu"))
            Zend_Loader::loadClass("Workflow_Menu");

        $html = Workflow_Menu::topMenuFormat($data,$smarty);
        //$html = preg_replace('{@id}',$params['id'],$html);
        return $html;
    }
    public function getMenuByLevel(&$menu) {
        //$profile = $this->getProfile();
        //if(!$profile->menu_name) return '';
        $config = $menu->getConfiguration();
        $sql = "SELECT * FROM ". $config["tablename"] ." WHERE section_level>0 ORDER BY section_left";
               //"AND (section_id IN (SELECT m_id FROM mdt_lookup_menu WHERE lookup_name ='{$profile->menu_name}')) ";
        #echo $sql;
        $adapter = $menu->getAdapter();
        $recordset = $adapter->db->Execute($sql);
        
        $dataArray = $recordset->toArray();
        return $dataArray;
    }
    public function html_pagination($params, &$smarty) {
        $params['page'] = $params['page']?$params['page']:1;
        $params['url']  = preg_replace('/\/page\/[0-9]+/i','',$params['url']);
        // genPagination($base_url, $num_items, $per_page, $start_item, $add_prevnext_text=true, $flag=null)
        $html = genPagination($params['url'],$params['total'],$params['perpage'],$params['page']);
        $image_path = $image_path = $smarty->_tpl_vars['g_image'];
        $html = str_replace('[image-path]',$image_path,$html);
        return $html;
    }
    public function GetSysLogInfo($table,$user,$page,$type){
    	$con = Zend_Registry :: get("db");
		$db = $con->getConnection();
		$insert_field = "user_code,page_url,action_type,datetime";
		$insert_value = "'".$user."','".$page."','".$type."','".date('Y-m-d H:i:s')."'";
		$sql ="INSERT INTO $table ($insert_field) VALUES ($insert_value) ";
		$db->query($sql);
    }
    public function SortTable(){
		if($_POST[order]==="asc")
			$images[$_POST[fields_sort]] = "<img src='".IMG_URL."/arrow_up.gif'>";
		else
			$images[$_POST[fields_sort]] = "<img src='".IMG_URL."/arrow_down.gif'>";
		return $images;
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
   	
   
}