<?php
class Workflow_Controller_Action extends System_Controller_Action {

	function init() {
		
        parent::init();
        
        if ($this->_output == "html") {
            if(Zend_Registry::isRegistered("view")) {
                $view = Zend_Registry::get("view");
                
            } else {
                $view = new Smarty_View();
            }
            
            $view->_smarty->unregister_function('html_treemenu');
            $view->_smarty->unregister_function('html_pagination');
            $view->_smarty->register_function('html_pagination', array($this,'html_pagination'));
            $view->_smarty->register_function("html_treemenu", array($this,"html_treemenu"));
            $view->_smarty->register_function("html_topmenu", array($this,"html_topmenu"));
            Zend_Registry :: set("view", $view);

        }
	}
	
	public function html_treemenu($params, &$smarty) {
		
        if(!$params['id']) $params['id'] = "__treemenu";
//        if(!$params['module']) {
            $front   = Zend_Registry :: get("front");
            $request = $front->getRequest();
            $moduleName= $request->getModuleName();
//        }
        	$_params = $request->getParams();

            $menuID = $_params["menu_id"];

        if(!$params['data']) {
            if(!class_exists("System_Menu"))
                Zend_Loader::loadClass("System_Menu");
            $_menu = null;
            $_menu = System_Menu::factory("Dbtree", array("tablename" => "menu_master"));
            System_Menu::setDefaultAdapter($_menu);

            $params['data'] = $this->getTree($menuID, 'tree', $_menu);
        }

        if(!class_exists("Workflow_Menu"))
            Zend_Loader::loadClass("Workflow_Menu");

        return Workflow_Menu::getHtmlTreeView($params, $smarty);
    }

    public function html_topmenu($params, &$smarty) {
    	
    	if(!$params['id']) $params['id'] = "_topmenu";

        if(!class_exists("System_Menu"))
            Zend_Loader::loadClass("System_Menu");
        $_menu = null;
        $_menu = System_Menu::factory("Dbtree", array("tablename" => "menu_master"));
        System_Menu::setDefaultAdapter($_menu);

        $data = $this->getMenuByLevel($_menu);

        if(!class_exists("Workflow_Menu"))
            Zend_Loader::loadClass("Workflow_Menu");

        $html = Workflow_Menu::topMenuFormat($data,$smarty);
        $html = preg_replace('{@id}',$params['id'],$html);
        
        return $html;
    }

    public function getTree($menuID = null, $format = "tree", & $menu) {
        Zend_Loader::loadClass("System_Menu_Format");
        return call_user_func(array("System_Menu_Format", 'tree'), $this->_getTree($menuID,$menu));
    }

    public function getMenuByLevel(&$menu) {
        $profile = $this->getProfile();
        if(!$profile->menu_name) return '';

        $config = $menu->getConfiguration();

        $sql = "SELECT * FROM ". $config["tablename"] ." ".
               "WHERE (section_level = 1) ";
              // "AND (section_id IN (SELECT m_id FROM lookup_menu WHERE lookup_name ='{$profile->menu_name}')) ";
        $adapter = $menu->getAdapter();
        $recordset = $adapter->db->Execute($sql);

        $dataArray = $recordset->toArray();
        return $dataArray;
    }

    protected function _getTree($menuID,&$menu) {
        $profile = $this->getProfile();
        $lookup_code = $profile->lookup_code;

        $condition = "";
        $config = $menu->getConfiguration();

//        if ( isset($menuID) && !empty($menuID) ) {
            $sql = "SELECT * FROM ". $config["tablename"] ." T0 ";
            $sql.=($lookup_code)?" INNER JOIN lookup_menu T1 ON T0.section_id = T1.m_id AND T1.lookup_code='$lookup_code' ":" ";
            $sql.= "WHERE ({$config["prefix"]}_id = '1' AND section_level = 0) ";
                   //"AND section_id IN (SELECT m_id FROM lookup_menu WHERE lookup_name ='{$profile->menu_name}') ";
//             echo $sql;
            $adapter = $menu->getAdapter();
            $recordset = $adapter->db->Execute($sql);

            if(!$recordset) return '';

            if ($item = $recordset->FetchRow()){
                $condition = array(
                    'and' => array(
                        "section_left >= ".(int)$item["{$config["prefix"]}_left"],
                        "section_right <= ". (int)$item["{$config["prefix"]}_right"],
                        "section_id IN (SELECT m_id FROM lookup_menu WHERE lookup_code ='{$lookup_code}')",
                        "section_status = 'Y' "
                    )
                );
            }
//        }

        $adapter->Full("*", $condition);
        if ( !empty($adapter->ERRORS_MES) ) {
            require_once "System/Menu/Exception.php";
            throw new System_Menu_Exception($adapter->ERRORS_MES);
        }
        return $adapter->res->toArray();
    }

	public function preDispatch() {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->viewRenderer = null;
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
    
}