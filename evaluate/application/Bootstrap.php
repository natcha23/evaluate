<?php
/**
 *  The bootstrap is initiated before every request is proccessed. It is used
 *  to set up the zend environment in which the application will be executed
 *  Once the neccessary classes are loaded, it is set into the registry and you can get these classes from the registry by typing
 *  $varname = Zend_Registry::get("varname");
 */

function bootstrap()
{

	if(!class_exists("Zend_Loader"))
		require_once "Zend/Loader.php";

	Zend_Loader::registerAutoload();

	//Loading front controller and registry class
	Zend_Loader :: loadClass("Zend_Controller_Front");
	Zend_Loader :: loadClass("Zend_Registry");

	//Loading config into Zend Registry
	Zend_Loader :: loadClass("Zend_Config_Xml");
	$config = new Zend_Config_Xml(APP_DIR . "/config/config.xml", "staging");
	Zend_Registry :: set("config", $config);

	//Setting up the Zend_Db object to point to a specific connection
	//This is specified in the database
	//Also loads a Zend_Db_Table object for one table ACTIVE RECORD fetching
	Zend_Loader::loadClass("Zend_Db");
	Zend_Loader::loadClass("Zend_Db_Table");
	Zend_Loader::loadClass("Zend_Auth");

	$options = array (
			Zend_Db :: CASE_FOLDING => Zend_Db :: CASE_LOWER
	);

	$dbparams = array (
			"host" => $config->database->host,
			"port" => $config->database->port,
			"username" => $config->database->username,
			"password" => $config->database->password,
			"dbname" => $config->database->name,
			"options" => $options
	);

	$db = Zend_Db :: factory($config->database->type, $dbparams);

	$db->query("SET collation_connection = utf8_general_ci");
	$db->query("SET NAMES utf8");
	Zend_Registry :: set("db", $db);
	Zend_Db_Table :: setDefaultAdapter($db);

	//$dbparams['dbname'] = DBNAME_USER;
	$db1 = Zend_Db :: factory($config->database->type, $dbparams);
	Zend_Registry :: set("db1", $db1);

	//Initiate Logger so that error logs can be stored
	Zend_Loader::loadClass("Zend_Log");
	Zend_Loader::loadClass("Zend_Log_Writer_Stream");
	/*
	 $logpath = APP_DIR."/log/log_".date("Y-m-d").".log";
	$logwriter = new Zend_Log_Writer_Stream($logpath);
	$logger = new Zend_Log($logwriter);
	Zend_Registry::set("logger",$logger);
	*/

	//Setting up the front Controller for default controller paths
	//And setting up the Router so that the paths are known.
	Zend_Loader :: loadClass("Zend_Controller_Router_Route_Module");
	$front = Zend_Controller_Front :: getInstance();

	//Set the ControllerDirectories that is stored in the config.xml under
	//application folder
	$ctrlConfig = array ();
	foreach ($config->ControllerDirectories as $directory => $info) {
		$ctrlConfig[$info->name] = APP_DIR . "/application/modules/" . $info->path;
	}

	$front->setControllerDirectory($ctrlConfig);
	// get the router from frontcontroller.
	$router = $front->getRouter();

	$modules = $front->getControllerDirectory();
	/**
	 *     Loop through the modules in the controller and find a filename config.xml.
	 *     If it exists we grab the router configuration inside and set a router
	 *               to know the path towards that module.
	 *     REMINDER :: ALL THE MODULE class NAME must be named Module_ClassNameController
	 *     else Zend framework would not recongnize it
	**/
	foreach ($modules as $module) {
		$moduleDir = dirname($module);
		//set_include_path(get_include_path().PATH_SEPARATOR.$module);
		if (file_exists($moduleDir . "/config.xml")) {
			#$front->addModuleDirectory($moduleDir);
			$module_config = new Zend_Config_Xml($moduleDir . "/config.xml", "routing");
			$router->addConfig($module_config, "routes");
		}
	}

	Zend_Loader :: loadClass("Zend_Controller_Plugin_ErrorHandler");
	Zend_Loader :: loadClass("Zend_View_Exception");

	$front->registerPlugin(new Zend_Controller_Plugin_ErrorHandler(array(
			"module"     => "systemapi",
			"controller" => "error",
			"action"     => "error"
	)));

	Zend_Loader :: loadClass("System_Controller");
	Zend_Loader :: loadClass("System_Controller_Action");
	Zend_Loader :: loadClass("Workflow_Controller_Action");

	// cache db table setup
	if(strtoupper($config->useCache) == "Y") {
		
		Zend_Loader :: loadClass("Zend_Cache");
		Zend_Loader :: loadClass("Zend_Db_Table_Abstract");
		$frontendOptions = array("automatic_serialization" => true);
		
		if(!is_dir(APP_DIR."/cache/tables")) System_Controller::createDir("cache/tables");
		
		$backendOptions  = array("cache_dir"=> APP_DIR."/cache/tables");
		$cache = Zend_Cache::factory("Core", "File", $frontendOptions, $backendOptions);
		// Next, set the cache to be used with all table objects
		Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);
	}

	Zend_Loader::loadClass("Zend_Debug");
	// 	Zend_Loader::loadClass("System_Exception");

	Zend_Loader::loadClass("Zend_View");
	Zend_Loader::LoadClass("Zend_View_Helper_Action");
	
	// setup view helpers
	$view = new Zend_View();
	$view->addHelperPath('../application/views/helpers', 'App_View_Helper');
	$view->addScriptPath('../application/modules/workflow/views/scripts');
	$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
// 	_print($view);exit;
	$viewRenderer->setView($view);
	
	//make view renderer use the view we just configured
	Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
	
	Zend_Layout::startMvc( array('layoutPath' => APP_DIR . '/application/layouts') );

	// 	$front->setBaseUrl(APP_DIR);

	Zend_Registry :: set("front", $front);
}

