<?php
/*
 * Created on Jan 16, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class Systemapi_Systemapi_Generic extends System_Db_Generic  {
	
	public function renderTopMenu($params) {
		$rs = System_Controller::getModel('menu','systemapi');
		$where = "menu_parent = '0' ";
		$result = $rs->getMenu($where);  

		return $result;
	}
	public function renderLeftMenu($params) {
		$rs = System_Controller::getModel('menu','systemapi');
		$where = "menu_parent != '0' ";
		$result = $rs->getMenu($where);  

		return $result;
	}	
	public function getGradeData(&$scollArr){
		$rs = System_Controller::getModel('master','systemapi');		
		$result = $rs->getGradeData(); 
		
		if($result){
			foreach($result as $item){
				$dataArr[$item['grade']] = $item['grade'];
				$scollArr[$item['grade']] = $item['start_scoll'].":".$item['end_scoll'];
			}
		}
		return $dataArr;
	}
	
	public function getSummaryBadge($date){
		$rs = System_Controller::getModel('evaluate','systemapi');
		$rows = $rs->getSummaryBadge($date);
		$results = array();
		if(!empty($rows)) {
			$results = $rows[0];
		}
		return $results;
		
	}
}