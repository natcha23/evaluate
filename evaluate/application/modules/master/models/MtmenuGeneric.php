<?php
class Master_Mtmenu_Generic extends System_Db_Generic {
	protected static $_recordCount = 0;

	public function getRecordCount() {
        return self::$_recordCount;
    }

	public function getDataListByPage($start=0,$perpage=15,$keyword="", $sort = ""){
	$db = Zend_Registry :: get("db");
        $where = "";
        if($keyword) {
        	$where = " AND (lookup_code LIKE '%$keyword%' OR lookup_name LIKE '%$keyword%') ";
        }

        $select  = $db->select()
                       ->from("lookup_menu",array("lookup_code","lookup_name","lookup_date"))
                       ->where(" 1 $where ")
                       ->group("lookup_code")
            		   ->limitPage($start,$perpage);
        $select2 = $db->fetchAll("SELECT DISTINCT lookup_code FROM lookup_menu WHERE 1 $where ORDER BY lookup_code ASC");

        $stmt2 = count($select2);
        if ( $sort ) {
        	$tmp = explode("_", $sort);
        	$sortOrder = array_pop($tmp);
        	$sortName = implode("_", $tmp);
        	$select->order("{$sortName} {$sortOrder}");
        }
        //$stmt2 = $select2->query();
        self::$_recordCount = $stmt2;

        $stmt = $select->query();
        return $stmt->fetchAll();

	}

	public function getDataMenu($code){
		$db = Zend_Registry :: get("db");
		if($code){
			return $db->fetchAll("SELECT * FROM lookup_menu WHERE lookup_code='$code' ");
		}
	}

	public function getMenu($table,$m_id){
		if(!$table)return;
		$db = Zend_Registry :: get("db");
		if($m_id){
			return $db->fetchAll("SELECT * FROM $table WHERE section_id='$m_id' ");
		}
	}

	public function checkCode($params=""){
		$db = Zend_Registry :: get("db");
		$where="";
		if($params[lookup_code])
			$where .=" AND lookup_code = '".$params[lookup_code]."'";
		if($params[lookup_name])
			$where.= " AND lookup_name = '".$params[lookup_name]."'";
			#_print("SELECT COUNT(*) FROM lookup_menu WHERE 1 $where ");
		$rs = $db->fetchOne("SELECT COUNT(*) FROM lookup_menu WHERE 1 $where ");
		return ($rs>0)?'true':'';
	}

	public function deleteMaster($table,$field,$id_key){
		$db = Zend_Registry :: get("db");
  		$sql ="DELETE FROM $table WHERE $field IN ($id_key) ";
  		$db->query($sql);
	}

	/*
	 * Modified by natcha
	 * 05 June 2014
	 */
	public function saveMenu($params){
		if(!$params)return;
		$db = Zend_Registry :: get("db");
	
		foreach($params['section_id'] as $key => $val){
			$date = date("Y-m-d H:i:s");
			$code = $params['lookup_code'];
			$name = $params['lookup_name'];
			$item = array(
					'm_id' 			=> $val,
					'lookup_code' 	=> $code,
					'lookup_name'	=> $name,
					'lookup_date'	=> $date
			);
				
			$inserted = $db->insert('lookup_menu', $item);
		}
	}

	/* public function saveMenu($params){
		if(!$params)return;
		$db = Zend_Registry :: get("db");
		foreach($params['section_id'] as $key => $val){
			$date = date("Y-m-d H:i:s");
			$code = htmlspecialchars($params['lookup_code']);
			$name = htmlspecialchars($params['lookup_name']);
			$db->query("INSERT INTO lookup_menu (m_id,lookup_code,lookup_name,lookup_date) VALUES ('$val','$code','$name','$date')");
		}
	} */

	public function deleteMenu($code=''){
	  $db = Zend_Registry :: get("db");
		if($code){
			$db->query(" DELETE FROM lookup_menu WHERE lookup_code='$code' ");
		}
	}


}
?>