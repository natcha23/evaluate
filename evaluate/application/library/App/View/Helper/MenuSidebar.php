<?php

class App_View_Helper_MenuSidebar extends Zend_View_Helper_Action
{
	
	public function menuSidebar()
	{
		$menus = $this->getTreeMenu();
		
		$html = '
                  <li class="sub-menu">
                      <a href="javascript:;">
                          <i class="fa fa-laptop"></i>
                          <span>Layouts</span>
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
	
	
	public function getTreeMenu()
	{
		$result = '';
		
		return $result;
	}
	
	
	 
}