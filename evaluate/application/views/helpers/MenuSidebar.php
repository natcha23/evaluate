<?php

class App_View_Helper_MenuSidebar extends Zend_View_Helper_Action
{
	protected $db;
	
	public function __construct()
	{
		$this->db = Zend_Registry::get("db");
	}
	
	public function menuSidebar()
	{
		$menus = $this->getTreeMenu();
		
		$html = '
                  <li class="sub-menu">
                      <a href="javascript:;">
                          <i class="fa fa-laptop"></i>
                          <span>Evaluation</span>
                      </a>
                      <ul class="sub">
                      
                          <li><a  href="boxed_page.html">Boxed Page</a></li>
                          <li><a  href="horizontal_menu.html">Horizontal Menu</a></li>
                          <li><a  href="language_switch_bar.html">Language Switch Bar</a></li>
                          <li><a  href="email_template.html" target="_blank">Email Template</a></li>
                      </ul>
                  </li>
				';
		
		
		return $html;
	}
	
	
	public function getLookup()
	{
		$auth = Zend_Auth::getInstance();
    	$identity = $auth->getIdentity();
    	
    	$db = $this->db;
		$select = $db->select()
						->from( array("lookup_menu" => "lm"), array("*") )
						->where("lookup_code = " . $lookup );
		
	}
	public function getTreeMenu()
	{
		$db = $this->db;
		
		$select = $db->select()
						->from(array("menu" => "menu_master"), array("*"))
						->where("menu.section_status = 'Y'");
		$rs = $select->query();
		$rows = $rs->fetchAll();
		
		$result = '';
		
		return $result;
	}
	
	
	 
}