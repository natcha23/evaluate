<?php
class iauth_client {
   
	protected $config;
	protected $access_token;
	protected $token_data;
	
	public function __construct($config) 
	{
		$this->config = array( 
				 'iauth_url'     => $config['iauth_url'],
				 'client_id'     => $config['client_id'],
				 'client_secret' => $config['client_secret'],
				 'state'         => ($config['state'])? $config['state']:'accesstoken'
		);

	}
	
	protected function getAuthorizeURL() {
		return $this->config['iauth_url']."/api/authorize";
	}
		
	protected function getTokenURL() {
		return $this->config['iauth_url']."/api/token";
	}
	
	protected function getResourceURL($method) {
		return $this->config['iauth_url']."/api/{$method}";
	}
		
	protected function encode($data,$key = null) {
		$key = (is_null($key))? $this->config['client_secret']:$key;
		$data = json_encode($data);
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $data, MCRYPT_MODE_CBC, md5(md5($key))));
	}
	
	protected function decode($data,$key = null) {
		$key = (is_null($key))? $this->config['client_secret']:$key;
		$data = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($data), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
		return json_decode($data);
	}
	
	protected function ExecUrl($url,$request = "",$authen_user = null,$authen_pwd = null) {
		#$authen_user = ($authen_user)?  $this->config['client_id']:$authen_user;
		#$authen_pwd  = ($authen_pwd)?  $this->config['client_secret']:$authen_pwd;
		if (!$request['access_token']) {
		   $authen_user = $this->config['client_id'];
		   $authen_pwd = $this->config['client_secret'];
		} 
		#var_dump($this->config['client_id']);echo "<br>==>".$authen_user;echo "<br>==>".$authen_pwd;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		$auth = "";
		if (!is_null($authen_user) && $authen_user)
			$auth = $authen_user;
		if (!is_null($authen_pwd) && $auth && $authen_pwd)
			$auth = "{$auth}:{$authen_pwd}";
		if ($auth)
			curl_setopt($ch, CURLOPT_USERPWD, "{$auth}");
		curl_setopt($ch, CURLOPT_POST, 1);
		if ($request) {
			$data = "";
			if (is_array($request)) {
				foreach ($request as $key => $value) {
					$posts[] = "{$key}=".urlencode($value);
				}
				$data = join("&",$posts);
			} else {
				$data = $request;
			}
			//echo "<br>==>".$data;
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		#curl_setopt($ch, CURLOPT_HEADER, (($isRequestHeader) ? 1 : 0));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		#if( is_array($exHeaderInfo) && !empty($exHeaderInfo) )
		#{
		#	curl_setopt($ch, CURLOPT_HTTPHEADER, $exHeaderInfo);
		#}
		$response = curl_exec($ch);
		//dump($response);exit;
		curl_close($ch);
		return $response;
	}
	
	protected function requestToken($grant_type,$params = array()) {
		if ($grant_type == 'password') {
			##curl -u testclient1:testclient1 -v http://iauth.localhost/api/token -d 'grant_type=password&username=sarum@icesolution.com&password=L1verp00L'
			if (!array_key_exists('username',$params)) {
				throw Exception('grant_type password request `username` on params');
			}			
		} elseif ($grant_type == 'authorization_code') {
			#curl -u testclient1:testclient1 http://ioffice.localhost/iauth/token.php -d 'grant_type=authorization_code&code=7dc585ce831e81fee1c731675001d75a02626c41'
			if (!array_key_exists('code',$params)) {
				throw Exception('grant_type authorization_code request `code` on params');
			}
			
		} elseif ($grant_type == 'client_credentials') {
			#curl -u testclient1:testclient1 http://ioffice.localhost/iauth/token.php -d 'grant_type=client_credentials'
			if (!array_key_exists('client_id',$this->config) || !$this->config[client_id]) {
				throw Exception('grant_type client_credentials request `client_id` on config');
			}
		} else {
			throw Exception("grant_type {$grant_type} can't support on iauth");			
		}

		$params['grant_type'] = $grant_type;
		$rs = json_decode($this->ExecUrl($this->getTokenUrl(),$params));
		return $rs;		   	
	}
	
	protected function requestResource($method,$params = array()) {
		$resource_url = $this->getResourceURL($method);
		$params['access_token'] = $this->access_token; 
		#echo $resource_url;
		#var_dump($params);exit;
		$rs = json_decode($this->ExecUrl($resource_url,$params));
		return $rs;
	}
	
	public function authentication() {
		$error = $_REQUEST["error"];
		if(!empty($error)) {
			#TODO
			echo "<pre>";
			print_r($_REQUEST);
			echo "</pre>";
			exit;
			throw Exception($_REQUEST["error"]);
		}
		$code = $_REQUEST["code"];
		if(empty($code)) {
			$authorize_url = $this->getAuthorizeURL() . "?response_type=code&client_id=". $this->config['client_id']."&state=". $this->config['state'];
			//echo $authorize_url;exit;
			header("location:" . $authorize_url);
			exit;
		}
		$state = $_REQUEST["state"];
		
		$rs = $this->requestToken('authorization_code',array('code' => $code));
		
		if ($rs->access_token) {
			setcookie($this->config['client_id'].'_access_token', $rs->access_token, time() + $rs->expires_in);
			$this->setAuthToken($rs->access_token);
			return true;
		} else {
			return false;
		}
	}	

	
	public function setAuthToken($token = null) 
	{
		$this->access_token = ($token)? $token:$this->access_token;
		$rs = $this->requestResource('iauthdata');
		$this->token_data = $rs->data;
		#$authdata = $this->decode($rs->data,$this->config['client_secret']);
		#var_dump($authdata);
	}

	public function getAuthUser()
	{
		$authdata = $this->decode($this->token_data,$this->config['client_secret']);
		return $authdata->username;
	}
	
	public function getAuthPassword()
	{
		$authdata = $this->decode($this->token_data,$this->config['client_secret']);
		return $authdata->password; 
	}
	
	public function logout()
	{
		header("location:" . $this->config['iauth_url']."/logout");
	}
		
	public function getResource($type,$method,$params = array()) {
		$params['access_token'] = $this->access_token;
		$rs = json_decode($this->ExecUrl($this->config['iauth_url']."/api/resource/{$type}/{$method}",$params));
		return $rs;
	}
	
}