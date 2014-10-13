<?php
class Accounts extends Zend_Db_Table {

    // Set table name
    protected function _setupTableName() {
		$this->_name= DBNAME_USER.".i_user";
		parent :: _setupTableName();
	}
}