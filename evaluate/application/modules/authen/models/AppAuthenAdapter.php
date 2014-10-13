<?php
require_once "Zend/Auth/Adapter/Interface.php";
require_once (APP_MOD . "authen/models/datasource/accounts.php");

class AppAuthAdapter implements Zend_Auth_Adapter_Interface {
	private $username;
	private $password;

	/**
	 * Sets username and password for authentication
	 *
	 * @return void
	 */

	public function __construct($username, $password) {
		$this->username= $username;
		$this->password= md5($password);

	}

	/**
	 * Performs an authentication attempt
	 *
	 * @throws Zend_Auth_Adapter_Exception If authentication cannot be performed
	 * @return Zend_Auth_Result
	 */
	public function authenticate() {
		$table= new Accounts();

		$where= $table->getAdapter()->quoteInto("user_name = ?", $this->username);
		$rowset= $table->fetchAll($where);
		$row = $rowset->current();

		$authResult= array (
			"code" => Zend_Auth_Result :: FAILURE,
			"identity" => $this->username,
			"messages" => array ()
		);

		if ($row->mem_password != $this->password) {
			$authResult["code"]= Zend_Auth_Result :: FAILURE_IDENTITY_NOT_FOUND;
			$authResult["messages"][]= "Login failed";
		} else {
			$authResult["code"]= Zend_Auth_Result :: SUCCESS;
			$authResult["messages"][]= "Login succesful";
		}

		return new Zend_Auth_Result($authResult["code"], $authResult["identity"], $authResult["messages"]);

	}
}