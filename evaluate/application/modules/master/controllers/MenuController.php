<?php

if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');
class Master_MenuController extends  Workflow_Controller_Flow_Action
{
	protected $_menu;
	public function init()
	{
		parent::init();
		Zend_Loader::loadClass("System_Menu");
		$params = $this->getParams();

		$table = "menu_master";
		$this->_menu = System_Menu::factory("Dbtree", array("tablename" => $table));

		System_Menu::setDefaultAdapter($this->_menu);
		$this->modulename = $this->getRequest()->getParam("mod");
	}

	protected function _getModuleList()
	{
		$menuList = System_Menu::getModuleList();
		while (list(, $item) = each($menuList)){
			$tmp[$item["section_name"]] = $item["section_name"];
		}
		return $tmp;
	}
	protected function _getMenu($id=null){
	 	$menus = $this->_menu->get($this->modulename);
		 foreach($menus as $key=>$data){
		 	/*$section_name = unserialize($data[section_name]);
		 	$data[section_name] =$section_name[$_COOKIE[LANG]];*/
		 	$newmenu[$key] = $data;
		 }
		 return $newmenu;
	}


	public function indexAction()
	{
        $view = Zend_Registry :: get("view");
        // @todo: getMenu by module
        $view->assign("mod", $this->modulename);
		$view->assign("moduleList", $this->_getModuleList());
        $tree = $this->_menu->getTree($this->modulename);
		$view->assign("menuList", $tree);
//		Zend_Debug::dump($view->getEngine()->get_template_vars("menuList"));
		$view->output("menu/index.tpl");
	}

	public function listAction()
	{

		 $view = Zend_Registry :: get("view");
		 $params = $this->getParams();
		 $view->assign('_params',$params);
		 $view->assign("menuList",  $this->_getModuleList());
		 $view->assign("menus", $this->_getMenu());
		 $view->assign("mod", $this->modulename);

		 $view->output("menu/list.tpl");
	}

	public function formAction()
	{
		$view = Zend_Registry :: get("view");
		$id = $this->_request->getParam("id");
		$mode = $this->_request->getParam("mode");
		if ( "edit" == $mode )
		{
			$menu = $this->_menu->getRow($id);
			$view->assign("section", $menu);
		}

		$mod = $this->getRequest()->getParam("mod");
		$view->assign("mod", $mod);

		$tmp = $this->_getModuleList();
		$view->assign("menuList",$tmp);

		$view->assign("id", $id);
		$view->assign("mode", $mode);
		$view->assign("menus", $this->_getMenu());
		$view->assign("mod", $this->modulename);
		$params = $this->getParams();
		 $view->assign('_params',$params);
		$view->output("menu/form.tpl");
	}

	public function moveformAction()
	{
		$view = Zend_Registry :: get("view");
		$id = $this->_request->getParam("id");
		$menuBranch = $this->_menu->getBranch($id);
		if(is_array($menuBranch)){
			foreach($menuBranch as $key=>$data){
				/*$section_name=unserialize($data[section_name]);
				$data[section_name] = $data[section_name];*/
				$_menuBranch[$key] = $data;
			}
		}
		$menuBranch = $this->_menu->getAllBranch($id);
		if(is_array($menuBranch)){
			foreach($menuBranch as $key=>$data){
				/*$section_name=unserialize($data[section_name]);
				$data[section_name] = $data[section_name];*/
				$_menuBranch2[$key] = $data;
			}
		}
		$view->assign("branches", $_menuBranch);
		$view->assign("allbranches", $_menuBranch2);
        $view->assign("menuList",  $this->_getModuleList());
		$view->assign("menus", $this->_getMenu());
		$view->assign("id", $id);
		$view->assign("mod", $this->modulename);
        $view->assign("params", $this->getRequest()->getParams());
		$view->output("menu/moveform.tpl");
	}

	public function addAction()
	{
		$id = $this->_request->getParam("id");
		$data = $this->_request->getPost("section");
		$params = $this->getParams();
		//_print($params);exit;
		// @todo: validate input data
		//$data[section_name] = serialize($data[section_name]);
		$this->_menu->add($id, $data);
		$this->_redirect("master/menu/list/mod/{$this->modulename}/type/{$params[type]}");
	}

	public function editAction()
	{
		$id = $this->_request->getParam("id");
		$data = $this->_request->getPost("section");
		$params = $this->getParams();
		//$data[section_name] = serialize($data[section_name]);
		$this->_menu->edit($id, $data);
		$this->_redirect("master/menu/list/mod/{$this->modulename}/type/{$params[type]}");
	}

	public function deleteAction()
	{
		$id = $this->_request->getParam("id");
		$params = $this->getParams();
		$this->_menu->delete($id);
		$this->_redirect("master/menu/list/mod/{$this->modulename}/type/{$params[type]}");
	}

	public function removeAction()
	{

	}

	public function movebranchAction()
	{
		$sourceId = $this->_request->getParam("id");
		$destinationId = $this->_request->getPost("section2_id");
		$position = $this->_request->getPost("position");
		$params = $this->getParams();
		$this->_menu->changePositionAll($sourceId, $destinationId, $position);
		$this->_redirect("master/menu/list/mod/{$this->modulename}/type/{$params[type]}");
	}

	public function moveallbranchAction()
	{
		$sourceId = $this->_request->getParam("id");
		$destinationId = $this->_request->getPost("section2_id");
		$params = $this->getParams();
		$this->_menu->moveAll($sourceId, $destinationId);
		$this->_redirect("master/menu/list/mod/{$this->modulename}/type/{$params[type]}");
	}

	public function testAction()
	{
		echo __METHOD__;



	}

}