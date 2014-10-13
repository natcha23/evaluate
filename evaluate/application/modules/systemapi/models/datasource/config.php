<?php
class Systemapi_Config_Table extends Zend_Db_Table {
    protected $_name= "config";

    // config_sys
    public function getSystemConfig($key="") {
        Zend_Loader::loadClass("System_Controller");
        $cache = System_Controller::getCache();
        if(!$result = $cache->load('system_config')) {
            $select = $this->_db->select();
	        $select->from($this->_name, $this->_cols, $this->_schema);
	        $where = array();
	        $where = "cfg_type = 'SYS'";
	        if($key) $where .= " AND cfg_key = '$key'";
            $select->where($where);
	        $stmt = $select->query();
	        $result = $stmt->fetchAll();
            $cache->save($result, 'system_config');
        }
        return $result;
    }

	public function getEmailConfig ($key) {
		// $sql = "SELECT * FROM config WHERE cfg_type='MAIL' AND cfg_key='$key' ";
		Zend_Loader::loadClass("System_Controller");
        $cache = System_Controller::getCache();
        if(!$result = $cache->load('email_config')) {
            $select = $this->_db->select();
	        $select->from($this->_name, $this->_cols, $this->_schema);
	        $where = array();
	        $where = "cfg_type = 'MAIL'";
	        if($key) $where = " AND cfg_key = '$key'";
            $select->where($where);
	        $stmt = $select->query();
	        $result = $stmt->fetchAll();
            $cache->save($result, 'email_config');
        }
        return $result;
	}
	public function getConfigVAT() {
        Zend_Loader::loadClass("System_Controller");
            $where = "cfg_type = 'TAX'";
            $select = $this->_db->select()
                  ->from($this->_name, array('*'))
                  ->where($where);       
	        $stmt = $select->query();
	        $result = $stmt->fetchAll();            
        return $result[0];
    }
    public function getConfigBank() {
        Zend_Loader::loadClass("System_Controller");
            $where = "cfg_type = 'BANK'";
            $select = $this->_db->select()
                  ->from($this->_name, array('*'))
                  ->where($where);       
	        $stmt = $select->query();
	        $result = $stmt->fetchAll();            
        return $result;
    }
    public function getConfigType($type) {
        Zend_Loader::loadClass("System_Controller");
            $where = "cfg_type = '$type'";
            $select = $this->_db->select()
                  ->from($this->_name, array('*'))
                  ->where($where);       
	        $stmt = $select->query();
	        $result = $stmt->fetchAll();            
        return $result;
    }
    public function getConfigCompany($type) {
        Zend_Loader::loadClass("System_Controller");
            $where = "cfg_type = '$type' AND (cfg_key like 'address_th%' OR cfg_key = 'phone' " .
            		 "OR cfg_key = 'fax' OR cfg_key = 'company_th') ";
            $select = $this->_db->select()
                  ->from($this->_name, array('*'))
                  ->where($where);       
	        $stmt = $select->query();
	        $result = $stmt->fetchAll();            
        return $result;
    }
/*
	public function config_txt_menu () {
		$cn = connect_db();
		$sql = "SELECT * FROM config WHERE cfg_type='FMENU' ";
		$que = mysql_query ($sql);
		$nr = mysql_num_rows ($que);
		if ($nr>=1) {
			$dsp_menu .= "<table cellpadding='5' cellspacing='0' border='0' align='center'>";
			$dsp_menu .= "<tr height='50'>";
			$i=1;
			while ($arr = mysql_fetch_array ($que)) {
				$dsp_menu .= "<td><A HREF='$_SERVER[PHP_SELF]?page=$arr[cfg_value]'>".$arr[cfg_key]."</A></td>";
				if ($i<$nr) {
					$dsp_menu .= "<td>|</td>";
					$i++;
				}
			}
			$dsp_menu .= "</tr>";
			$dsp_menu .= "</table>";
			return $dsp_menu;
		} else {
			return false;
		}
		mysql_close($cn);
	}
*/
}