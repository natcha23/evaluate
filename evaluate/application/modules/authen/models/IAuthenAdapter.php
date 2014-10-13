<?php
require_once "Zend/Auth/Adapter/Interface.php";

require_once ('iauth.client.inc.php');

class IAuthenAdapter implements Zend_Auth_Adapter_Interface {
	private $username;
	private $password;
	private $dbAdapter;

	/**
	 * Sets username and password for authentication
	 *
	 * @return void
	 */

	public function __construct($username = "", $password ="") {
		$this->username= $username;
		$this->password= $password;

	}

	public function setDbAdapter($dbAdapter) {
		$this->_dbAdapter = $dbAdapter;
	}
	/**
	 * Performs an authentication attempt
	 *
	 * @throws Zend_Auth_Adapter_Exception If authentication cannot be performed
	 * @return Zend_Auth_Result
	 */
	public function authenticate() {

		$config = array(
				'iauth_url'     => IAUTH_URL,
				'client_id'     => CLIENT_ID,
				'client_secret' => CLIENT_SECRET
		);
// 		Zend_Debug::Dump($config);exit;

		$client = new iauth_client($config);
		$client->setVersion(1);
		#Zend_Debug::Dump($this->username);
		#Zend_Debug::Dump($this->password);
		$rs = $client->setAuthentication($this->username,$this->password);
		#Zend_Debug::Dump($rs);exit;

		$authResult= array (
		"code" => Zend_Auth_Result :: FAILURE,
		"identity" => $this->username,
		"messages" => array ()
		);

		if ($rs->error) {
			$authResult["code"]= Zend_Auth_Result :: FAILURE_IDENTITY_NOT_FOUND;
			$authResult["identity"]= "";
			$authResult["messages"][]= $rs->error_description;
		} else {
			$authResult["code"]= Zend_Auth_Result :: SUCCESS;
			$authResult["identity"]= $rs->user;
			$authResult["messages"][]= "login succesful";
		}
		return new Zend_Auth_Result($authResult["code"], $authResult["identity"], $authResult["messages"]);
		/*
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
		*/
	}
}