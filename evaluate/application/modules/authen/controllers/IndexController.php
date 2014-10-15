<?php
include 'iauth.client.inc.php';
require_once (APP_MOD . "authen/models/datasource/accounts.php");
// include iAuthen.
require_once (APP_MOD . "authen/models/IAuthenAdapter.php");
/**
 *  This is the main controller of the Application. If the user enters
 *  the domain of the site, this is the controller they are routed to.
 **/
class Authen_IndexController extends Workflow_Controller_Action {
    protected $_output= "";

    public function indexAction() {
        // $request = $this->getRequest();
    	
        $this->_redirect("/default/index/index");
	}

	public function iauthAction() {
	
// 		define("IAUTH_URL","http://devioffice4.icesolution.com");
// 		define("CLIENT_ID","ievaluation");
// 		define("CLIENT_SECRET","ievaluation");
		$config = array(
				'iauth_url'     => IAUTH_URL,
				'client_id'     => CLIENT_ID,
				'client_secret' => CLIENT_SECRET
		);
		//Zend_Debug::Dump($config);
		$client = new iauth_client($config);
		if ($client->authentication()) {
	
			$token = $client->getResource('identity','token');
	
			$_SESSION['access_token'] = $token->data->access_token;
			$_SESSION['user_id'] = $token->data->user_id;
			//$_user = $client->getAuthUser();
			//$_pass = $client->getAuthPassword();
			$profile = $client->getResource('identity','profile');
			$_SESSION['profile'] = $profile->data;
				
			$dbAdapter= Zend_Registry :: get("db");
			$sql = 'SELECT * FROM user WHERE u_login = ?';
			$stmt = new Zend_Db_Statement_Mysqli($dbAdapter, $sql);
			$stmt->execute(array($_SESSION['user_id']));
			$stmt->setFetchMode(Zend_Db::FETCH_OBJ);
			$data = $stmt->fetch();
	
			$auth = Zend_Auth :: getInstance();
			$rs = System_Controller::getModel('level','systemapi');
			$row = $rs->getLevelByPosition($data->user_position);
			$data->level = $row[org_position_level];
			$data->position_name = $row[org_position_name_th];
			$data->level_name = $row[lv_shotname];
			// Set access log.
			$this->setSystemAccessLog($data);
			$auth->getStorage()->write($data);
			$baseUrl = $this->getRequest()->getBaseUrl();
			#$this->_redirect("/default/index/index");
			$this->_redirect("/workflow/evaluate/urecive");
			#echo "window.location.href = '/'+projectName+'/workflow/evaluate/urecive/';";
		} else {
			#TODO
		}
	}	
	public function loginAction() {
		if (strtolower($_SERVER["REQUEST_METHOD"]) == "post") {
			// collect the data from the user
			Zend_Loader :: loadClass("Zend_Filter_StripTags");
			$f = new Zend_Filter_StripTags();
			$username = $f->filter($this->_request->getPost("username"));
			$pwd = $f->filter($this->_request->getPost("password"));
			$password = md5($f->filter($this->_request->getPost("password")));
			$remember = $f->filter($this->_request->getPost("remember"));

			// setup Zend_Auth adapter for a database table;
			Zend_Loader :: loadClass("Zend_Auth_Adapter_DbTable");
			$dbAdapter= Zend_Registry :: get("db");

			$authAdapter= new Zend_Auth_Adapter_DbTable($dbAdapter);
			/*$authAdapter->setTableName(DBNAME_USER.".i_user");
			$authAdapter->setIdentityColumn("u_login");
			$authAdapter->setCredentialColumn("u_password");*/

			$authAdapter->setTableName("user");
			$authAdapter->setIdentityColumn("u_login");
			$authAdapter->setCredentialColumn("u_password");

			// Set the input credential values to authenticate against
			$authAdapter->setIdentity($username);
			$authAdapter->setCredential($password);

            // do the authentication
			$auth = Zend_Auth :: getInstance();

            // $auth->setStorage(new Zend_Auth_Storage_Session());

            $result = $auth->authenticate($authAdapter);
           
			if ($result->isValid()) {

				// success : store database row to auth"s storage system
				// (not the password though!)
				$data= $authAdapter->getResultRowObject(null, "u_password");

				$rs = System_Controller::getModel('level','systemapi');
        		$row = $rs->getLevelByPosition($data->user_position);
        		$data->level = $row[org_position_level];
        		$data->position_name = $row[org_position_name_th];
        		$data->level_name = $row[lv_shotname];
        		
        		// Set permission menu & access data.
        		$usercode = array($data->user_code);
        		$rs 	= System_Controller::getModel('organize','systemapi');
        		$where 	= "user_header IN (" . $data->user_code . ") AND org_sec_status='Y'";
        		$items 	= $rs->GetOrgByCode($where);
        		if(!empty($items)){
        			foreach($items as $item){
        				$dataArr .= ($dataArr)?",".$item["org_sec_code"]:$item["org_sec_code"];
        			}
        			$empArr	= $this->getUnderling($dataArr);
        			$usercode	= array_merge($usercode, $empArr);
        		}
        		$data->empAccess = $usercode;
        		$data->menuAccess = array();
		        
                // Set access log.
                $this->setSystemAccessLog($data);
				$auth->getStorage()->write($data);
				$baseUrl = $this->getRequest()->getBaseUrl();
				//echo $baseUrl;exit;
				/*if($remember=='Y'){

					setcookie("defCookie[user]",$username,time()+1296000,$baseUrl);//expire cookie 15 days
					setcookie("defCookie[pwd]",$pwd,time()+1296000,$baseUrl);//expire cookie 15 days
				}else{
					setcookie("defCookie[user]",$username,time()-1,$baseUrl);
					setcookie("defCookie[pwd]",$pwd,time()-1,$baseUrl);
				}*/

				//echo "_alert('ยินดีต้อนรับคุณ ".$data->user_name." เข้าสู่ระบบ');";
				//echo "'var data =1'";
				
				echo "window.location.href = '/workflow/evaluate/urecive/';";
			} else {
			    echo "_alert('Username และ password ไม่ถูกต้อง !');";
			    //echo "return;";
			}
		}

	}
	
	/*
	 * Login with iAuthen
	* close for test.
	*
	*/
	public function __loginAction() {
	
	
	
	
		if (strtolower($_SERVER["REQUEST_METHOD"]) == "post") {
			// collect the data from the user
			Zend_Loader :: loadClass("Zend_Filter_StripTags");
			$f= new Zend_Filter_StripTags();
			$username = $f->filter($this->_request->getPost("username"));
			$pwd = $f->filter($this->_request->getPost("password"));
			$password = md5($f->filter($this->_request->getPost("password")));
			$remember = $f->filter($this->_request->getPost("remember"));
			/*
	
			// setup Zend_Auth adapter for a database table;
			Zend_Loader :: loadClass("Zend_Auth_Adapter_DbTable");
			$dbAdapter= Zend_Registry :: get("db");
	
			$authAdapter= new Zend_Auth_Adapter_DbTable($dbAdapter);
			$authAdapter->setTableName("user");
			$authAdapter->setIdentityColumn("u_login");
			$authAdapter->setCredentialColumn("u_password");
			// Set the input credential values to authenticate against
			$authAdapter->setIdentity($username);
			$authAdapter->setCredential($password);
			*/
			/* iauth adapter */
			$authAdapter = new IAuthenAdapter($username,$pwd);
	
	
			// do the authentication
			$auth = Zend_Auth :: getInstance();
			$result = $auth->authenticate($authAdapter);
	
			if ($result->isValid()) {
				$account = System_Controller::getModel('account','systemapi');
	
				// success : store database row to auth"s storage system
				// (not the password though!)
				//$data= $authAdapter->getResultRowObject(null, "u_password");
	
				$where = "u_login = '{$username}' ";
				$start = 0;
				$perpage = 1;
				$status = 'Y';
				$account_rs = $account->getAccount($where,$start,$perpage,$status);
				if (!$account_rs['data'][0]) {
					echo "_alert('Plz. contact admin to access evaluation program ');";
					return false;
				}
				$data = (object) $account_rs['data'][0];
				$rs = System_Controller::getModel('level','systemapi');
				$row = $rs->getLevelByPosition($data->user_position);
				$data->level = $row[org_position_level];
				$data->position_name = $row[org_position_name_th];
				$data->level_name = $row[lv_shotname];
	
				// Set permission menu & access data.
				// Natcha - 17 June 2014
				$usercode = array($data->user_code);
				$rs 	= System_Controller::getModel('organize','systemapi');
				$where 	= "user_header IN (" . $data->user_code . ") AND org_sec_status='Y'";
				$items 	= $rs->GetOrgByCode($where);
				if(!empty($items)){
					foreach($items as $item){
						$dataArr .= ($dataArr)?",".$item["org_sec_code"]:$item["org_sec_code"];
					}
					$empArr	= $this->getUnderling($dataArr);
					$usercode	= array_merge($usercode, $empArr);
				}
				$data->empAccess = $usercode;
				$data->menuAccess = array();
	
				// Set access log.
				$this->setSystemAccessLog($data);
				$auth->getStorage()->write($data);
				$baseUrl = $this->getRequest()->getBaseUrl();
				//echo $baseUrl;exit;
				/*if($remember=='Y'){
	
				setcookie("defCookie[user]",$username,time()+1296000,$baseUrl);//expire cookie 15 days
				setcookie("defCookie[pwd]",$pwd,time()+1296000,$baseUrl);//expire cookie 15 days
				}else{
				setcookie("defCookie[user]",$username,time()-1,$baseUrl);
				setcookie("defCookie[pwd]",$pwd,time()-1,$baseUrl);
				}*/
	
				//echo "_alert('ยินดีต้อนรับคุณ ".$data->user_name." เข้าสู่ระบบ');";
				//echo "'var data =1'";
				echo "window.location.href = '/'+projectName+'/workflow/evaluate/urecive/';";
			} else {
				echo "_alert('Username และ password ไม่ถูกต้อง !');";
				//echo "return;";
			}
		}
	
	}
	

    private function setSystemAccessLog(&$data) {

        if (!$data->user_code OR $data->access_id) return;
		$data->dateNow = date("d-m-Y");
        Zend_Loader :: loadClass("System_Controller_Client");
        $client = System_Controller_Client::getInstance();
        $clientInfo = $client->getInfo();

        Zend_Loader :: loadClass("System_Generater");
        $access_id = System_Generater::get("id",array(10,true,false,false));

		unset($data->passhack);
        $row = array (
            "access_id" => $access_id,
            "acc_id"   => $data->user_code,
            "login_time"   => date("Y-m-d H:i:s"),
            "acc_ip"       => $clientInfo["ip"],
            "acc_agent"    => $clientInfo["ua"],
            "acc_browser"  => $clientInfo["long_name"],
            "acc_os"       => $clientInfo["os"]
        );

        $db = Zend_Registry :: get("db");
        $table = "sys_access";
        $rows_affected = $db->insert($table, $row);
        $data->access_id = $access_id;
    }

	public function logoutAction() {
		$auth = Zend_Auth :: getInstance();
        $data = $auth->getIdentity();
        $params = $this->getParams();
        //unset($_COOKIE["username"]);
// _print($data);exit;s
        if($data) {
	        $db = Zend_Registry :: get("db");
	        $set = array ("logout_time" => date("Y-m-d H:i:s"));
	        $table = "sys_access";
	        $id = $data->access_id;
	        $where = $db->quoteInto("access_id = ?", $id);
	        $rows_affected = $db->update($table, $set, $where);
	        $auth->clearIdentity();

        }

        echo "var data ='1'";
        exit;
	}
	
	public function getUnderling(&$data) {
		$rows = array();
		$rs = System_Controller::getModel('member','systemapi');
		if($data) {
			$where = "user_sec_depart IN (". $data .") ";
		}
		$where1 = null;
		$result = $rs->getUserAccept($where, $where1);
		
		if(!empty($result)) {
		
			foreach($result as $val) {
				$rows[] = $val['user_code'];
			}
		}
		 
		return $rows;
	}
	
	public function getMenuLookup($data) {
		$rows = array();
		$rs = System_Controller::getModel('menu','systemapi');
		if($data) {
			$where = "lookup_code = " . $data;
		}
		$where1 = null;
		$result = $rs->getLookupMenu($where);
	
		if(!empty($result)) {
	
			foreach($result as $val) {
				$rows[] = $val['user_code'];
			}
		}
			
		return $rows;
	}
	
	public function evalogoutAction()
	{
		$auth = Zend_Auth :: getInstance();
		$data = $auth->getIdentity();
		$params = $this->getParams();
		
// 		$_SESSION['access_token'] = $token->data->access_token;
// 		$_SESSION['user_id'] = $token->data->user_id;
// 		//$_user = $client->getAuthUser();
// 		//$_pass = $client->getAuthPassword();
// 		$profile = $client->getResource('identity','profile');
// 		$_SESSION['profile'] = $profile->data;
		
		if($_SESSION['user_id']) {
			
			unset($_SESSION['user_id']);
			unset($_SESSION['profile']);
			unset($_SESSION['access_token']);
		}
		
		echo "var data ='1'";
        exit;
	}
}