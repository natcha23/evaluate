<?php

Zend_Loader::loadClass("Zend_Debug");
if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');
class Master_MTmenuController extends Workflow_Controller_Flow_Action {
    protected $per_page = "15";
    protected $_name = "mtmenu";

    public function displayAction() {
        $generic = System_Controller::getGeneric(ucfirst($this->_name));
        $params   = $this->getParams();

		$data["dataArray"]   = $generic->getDataListByPage($params["start"],$this->per_page,$params["keyword"],$params["_sort"]);
        $data["header"]      = array("lookup_name"=>"menu_name","lookup_date"=>"create_date");//($data["dataArray"][0])?array_keys($data["dataArray"][0]):array();
        $data["totalRecord"] = $generic->getRecordCount();
        $data["perpage"]     = $this->per_page;
        $data["params"]      = $params;
        $data["name"]        = $this->_name;
		$lbl["confirm_save"] = System_Controller::translate("confirm_save");
		$lbl["confirm_del"] = System_Controller::translate("confirm_del");

        $view  = Zend_Registry :: get("view");
        $view->assign("", $data);
        $view->assign("lbl",$lbl);
        $view->assign("menuName","list_menu_name_master");

        if(array_key_exists("_sort", $params))
            $view->output("mtmenu/_sort.tpl");
        else
            $view->output("mtmenu/display.tpl");
    }

	public function formAction() {
		$menu='';
        $generic = System_Controller::getGeneric(ucfirst($this->_name));
        $params   = $this->getParams();
        $view  = Zend_Registry :: get("view");
		Zend_loader :: loadClass('System_Menu');

		if($params[_m]=='view'){
			$view->assign("readonly","readonly");
			$this->disabled = "disabled='disabled'";
		}
        $this->_menu = System_Menu::factory("Dbtree", array("tablename" => "menu_master"));
        $this->getLookMenu(&$look_menu);
        $view->assign("look_menu",$look_menu);
        $tree = $this->RenderMenuList();
        $view->assign("MenuTree",$tree);
		$view->assign("mode",$params[_m]);
		$view->output("mtmenu/form.tpl");
    }

    public function saveAction() {
    	$generic = System_Controller::getGeneric(ucfirst($this->_name));
        $params = $this->getParams();
        if($params[_m] == "edit")
        	$generic->deleteMenu($params['lookup_code']);
        $rs = $generic->saveMenu($params);
        $this->_redirect("/master/mtmenu/display");
    }

    public function deleteAction() {
        $params = $this->getParams();
     	$generic = System_Controller::getGeneric(ucfirst($this->_name));

    	if($params[delID]){
     		$idArray = explode(",",$params[delID]);
    		foreach($idArray as $item){
    			$id_del .=($id_del)?",'".$item."'":"'".$item."'";
    		}
    		$generic->deleteMaster('lookup_menu','lookup_code',$id_del);
    		$this->_redirect("/master/mtmenu/display");
    	}
    }

    public function checkmenuAction(){
		$generic = System_Controller::getGeneric(ucfirst($this->_name));
		$params   = $this->getParams();
		$chkDup = $generic->checkCode($params);
		if($chkDup)
			echo $chkDup;
    }

    public function RenderMenuList(){

        $sHTML = "";
        $this->RenderMenu($sHTML);
    	return $sHTML;
    }

    protected function getLookMenu(&$lookup_menu){
    	$params   = $this->getParams();
    	if(!$params['code'])return;
    	$generic = System_Controller::getGeneric(ucfirst($this->_name));
    	$dataArr = $generic->getDataMenu($params['code']);
    	if($dataArr)
    	foreach($dataArr as $item){
			$lookup_menu['lookup_code'] = $item['lookup_code'];
			$lookup_menu['lookup_name'] = $item['lookup_name'];
			$this->menuAuth[$item['m_id']] =$item['m_id'];
    	}
    }

    public function RenderMenu(& $sHTML) {
        $section_id="1";
        $menuAuth = $this->menuAuth;
        $generic = System_Controller::getGeneric(ucfirst($this->_name));
        $m_MenuItem = $generic->getMenu("menu_master","1");
        if (!is_array($m_MenuItem)) return;
        $sHTML .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\"  >";
        //$sHTML .= "<tbody id='treeMenu_tbody' Highlighted='treeMenu_data_1' SelectedRow='1'>\n";
        $sHTML .= "<thead>";
        $sHTML .= "<tr height=25>";
        $sHTML .= "<td bgcolor=\"#C6DCFF\"  class='tdhead' align=center><b>Menu Name</b></td>";
        $sHTML .= "</td></tr></thead><tbody id=\"menu_list\">";
        $i=0;
        foreach ($m_MenuItem as $menuItem) {
        	if($i%2==0)$class_row = "rowodd"; else $class_row="roweven";
        	$menuLavel = $menuItem[section_level];
        	$section_id=$menuItem[section_id];
         	$menuItem["section_name"]=$menuItem["section_name"];
        	$checked=($menuAuth[$section_id])?"checked=checked":"";
        	$sHTML .= "<tr bgcolor=\"#b9b9b9\" >\n";//onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'
            $sHTML .= "<td bgcolor=\"$bgcolor\" class=cell height=\"25\">&nbsp;&nbsp;&nbsp;";
            $sHTML .= "<input class=\"border0\" type=\"checkbox\"  ".$this->disabled." name=\"section_id[]\" id=\"$section_id\" value=\"$section_id\" $checked onclick=\"openTag('$section_id',this);\">&nbsp;";
            $sHTML .= $menuItem["section_name"];
            $sHTML .= "</td>";
            $sHTML .= "</tr>\n";
            $i++;
            $sHTML .= $this->RenderSubMenu($menuItem,$menuLavel,$section_id,&$i);
        }
        $sHTML .= "</tbody></table>\n";
        return $sHTML;
    }

    protected function RenderSubMenu($_menuItem,$_menuLavel,$section_id,&$i) {
        if (!$_menuItem) return;
        $menuAuth = $this->menuAuth;
        $m_MenuItem = $this->_getTreeBranch($_menuItem[section_id],$_menuItem[section_level]+1);
        $_menuLavel = $_menuLavel+1;
        $_html = "";
        if ($m_MenuItem) {
            foreach ($m_MenuItem as $menuItem) {
            	if($i%2==0)$class_row = "#ffffff"; else $class_row="#EBEBF5";
            	$menuLavel2 = $menuItem[section_level];
            	$_section_id = $menuItem[section_id];
            	$menuItem["section_name"]=$menuItem["section_name"];
            	$menu_id = $section_id."_".$_section_id;
            	$checked=($menuAuth[$_section_id])?"checked=checked":"";
            	if($menuLavel2 == $_menuLavel){
	            	$_html .= "<tr bgcolor=\"#EBEBEB\" >\n";//onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'
		            $_html .= "<td bgcolor=\"$bgcolor\" class=cell height=\"25\">&nbsp;&nbsp;&nbsp;";
		            $_html .= str_repeat("&nbsp;", 10 * $menuItem["section_level"]) . "<input class=\"border0\" type=\"checkbox\" ".$this->disabled."  name=\"section_id[]\" id=\"$menu_id\" value=\"$_section_id\" $checked onclick=\"openTag('$menu_id',this);\">&nbsp;";
		            $_html .= $menuItem["section_name"];
		            $_html .= "</td>";
		            $_html .= "</tr>\n";
		            $i++;
		            $_html .= $this->RenderSubMenu1($menuItem,$menuLavel2,$menu_id,&$i);
            	}
            }
        }
        return $_html;
    }
    protected function RenderSubMenu1($_menuItem,$_menuLavel,$section_id,&$i) {
        if (!$_menuItem) return;
        $menuAuth = $this->menuAuth;
        $m_MenuItem = $this->_getTreeBranch($_menuItem[section_id],$_menuItem[section_level]+1);
        $_menuLavel = $_menuLavel+1;
        $_html = "";
        if ($m_MenuItem) {
            foreach ($m_MenuItem as $menuItem) {
            	if($i%2==0)$class_row = "#ffffff"; else $class_row="#EBEBF5";
            	$menuLavel2 = $menuItem[section_level];
            	$_section_id = $menuItem[section_id];
            	$menuItem["section_name"]=$menuItem["section_name"];
            	$menu_id = $section_id."_".$_section_id;
            	$checked=($menuAuth[$_section_id])?"checked=checked":"";
            	if($menuLavel2 == $_menuLavel){
	            	$_html .= "<tr class=\"$class_row\" >\n";//onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'
		            $_html .= "<td bgcolor=\"$bgcolor\" class=cell height=\"25\">&nbsp;&nbsp;&nbsp;";
		            $_html .= str_repeat("&nbsp;", 10 * $menuItem["section_level"]) . "<input class=\"border0\" type=\"checkbox\" ".$this->disabled."  name=\"section_id[]\" id=\"$menu_id\" value=\"$_section_id\" $checked onclick=\"openTag('$menu_id',this);\">&nbsp;";
		            $_html .= $menuItem["section_name"];
		            $_html .= "</td>";
		            $_html .= "</tr>\n";
		            $i++;
            	}
            }
        }

        return $_html;
    }

    protected function _getTreeBranch($menuID,$menuLV) {
        if(!class_exists("System_Menu"))
                Zend_Loader::loadClass("System_Menu");
            $_menu = null;
            $_menu = System_Menu::factory("Dbtree", array("tablename" => "menu_master"));
            System_Menu::setDefaultAdapter($_menu);
        $profile = $this->getProfile();

        $condition = "";
        $config = $_menu->getConfiguration();

        if ( isset($menuID) && !empty($menuID) ) {
            $sql = "SELECT * FROM ". $config["tablename"] ." ".
                   "WHERE ({$config["prefix"]}_id = '$menuID') ";
                   //"AND section_id IN (SELECT m_id FROM lookup_menu WHERE lookup_name ='{$profile->menu_name}') ";
            $adapter = $_menu->getAdapter();
            $recordset = $adapter->db->Execute($sql);

            if(!$recordset) return '';

            if ($item = $recordset->FetchRow()){
                $condition = array(
                    'and' => array(
                        "section_left >= ".(int)$item["{$config["prefix"]}_left"],
                        "section_right <= ". (int)$item["{$config["prefix"]}_right"]
                    )
                );
            }
        }

        if(!$condition)return;

        $adapter->Full("*", $condition);
        if ( !empty($adapter->ERRORS_MES) ) {
            require_once "System/Menu/Exception.php";
            throw new System_Menu_Exception($adapter->ERRORS_MES);
        }
        return $adapter->res->toArray();
    }

}

?>