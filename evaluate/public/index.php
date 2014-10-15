<?php

/**
 * @file index.php
 * @desc Appliation index file
 * rathasit coding
 */
/* 
define('DS', DIRECTORY_SEPARATOR);

// Define path to application directory
defined('APPLICATION_PATH') ||
define('APPLICATION_PATH', getenv('APPLICATION_PATH') ?
getenv('APPLICATION_PATH') :
realpath(dirname(__FILE__) . '/../application')
);

// Define application environment
// development, test, production, staging and all
defined('APPLICATION_ENV') ||
define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?
getenv('APPLICATION_ENV') :
'production'
		);

defined('APPLICATION_HOST') ||
define('APPLICATION_HOST', getenv('APPLICATION_HOST') ?
getenv('APPLICATION_HOST') :
'http://inews.localhost.com'
		);

// Define iZend directory
defined('IZEND_PATH')
|| define('IZEND_PATH', (getenv('IZEND_PATH') ? getenv('IZEND_PATH') : APPLICATION_PATH . DIRECTORY_SEPARATOR . 'library'));

// To make configuration with YAML file
// @see symfony's yaml component
$defaultModule = 'app';
require_once APPLICATION_PATH . '/modules/' . $defaultModule . '/configs/ProjectConfiguration.php';
$config = new ProjectConfiguration(
		APPLICATION_ENV,
		APPLICATION_PATH . '/modules/' . $defaultModule . '/configs/application.yml'
);

// header('content-type:text/plain');
// var_dump($config->toArray());
// exit;


// Zend Application
// use `context` instead natural bootstrap
// @see symfony's dependency-injection component
require_once 'Zend/Application.php';
$application = new Zend_Application($config->getEnvironment(), $config->toArray());

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set("display_errors", 1);
Zend_Session::start();

// var_dump(E_ALL & ~E_NOTICE);
// exit;

$application
->bootstrap()
->run(); */

/*
 * end 
 */


define('DS', DIRECTORY_SEPARATOR);

// Define path to application directory
defined('APPLICATION_PATH') ||
define('APPLICATION_PATH', getenv('APPLICATION_PATH') ?
getenv('APPLICATION_PATH') :
realpath(dirname(__FILE__) . '/../application')
);

// Define application environment
// development, test, production, staging and all
defined('APPLICATION_ENV') ||
define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?
getenv('APPLICATION_ENV') :
'production'
		);

defined('APPLICATION_HOST') ||
define('APPLICATION_HOST', getenv('APPLICATION_HOST') ?
getenv('APPLICATION_HOST') :
'http://pi.localhost.com'
		);

// Root Path
define("ROOT_DIR", dirname(dirname(dirname(__FILE__))));
define("APP_DIR", dirname(dirname(__FILE__)));

// Module Path
define("APP_MOD", APPLICATION_PATH."/modules/");
define('APP_HOME',"C:/AppServ/www");

// Project URL
$project = array_pop(explode(DIRECTORY_SEPARATOR, APP_DIR));

define("projectName", $project);

define("APP_URL", "http://".$_SERVER["HTTP_HOST"]."/".$project."/");
define("IMG_URL", "http://".$_SERVER["HTTP_HOST"]."/".$project."/modules/systemapi/templates/default/images");
define("UPLOAD_URL", "http://".$_SERVER["HTTP_HOST"]."/".$project."/uploads");
define("UPLOAD_PATH", ROOT_DIR."/".$project."/uploads");

// ICE Library
define("SYSTEM_PATH", APP_HOME . "/iLibrary/trunk/");
define('ROOTPATH', ROOT_DIR."/".$project);

// Open Library
define("LIBRARY_PATH", APP_HOME . "/openlib/");

// Project library
define("PROJECT_LIBRARY_PATH", APP_DIR . "/library/");

// Set Include Path
set_include_path(get_include_path().PATH_SEPARATOR.LIBRARY_PATH.PATH_SEPARATOR.SYSTEM_PATH.PATH_SEPARATOR.PROJECT_LIBRARY_PATH.PATH_SEPARATOR.APPLICATION_PATH);
# PATH_SEPARATOR.APP_MOD

//amount line Catalog
define("LINE_CATALOG", 15);

//echo realpath(dirname(__FILE__)); //====> C:\AppServ\www\rsEvaluation\public 

//Database use in project
//define('DBNAME_USER','dev_sfa_db_dhas_ice');
//   define('DBNAME_USER','dev_ice_workflow');
define('ROOT_DOC',$_SERVER["DOCUMENT_ROOT"]);
// define('BIZWARE_HOME',ROOT_DOC."/bizware");
define('BIZWARE_HOME', APP_HOME . "/bizware");
#define('SETHOST',"10.2.1.200");
#define("SMS_PROXY","http://intranet.icesolution.com/sms-wf/send-workflow.php");
//define('SMS_PROXY','http://10.3.2.4/sms-wf/send-workflow.php');

// The Setup Script
require_once(APP_DIR . "/setup/helper.inc.php");
require_once(APP_DIR . "/setup/openlibs.inc.php");
require_once(APPLICATION_PATH . "/Bootstrap.php");

// Define iAuthen.
define("IAUTH_URL","http://devioffice4.icesolution.com");
define("CLIENT_ID","ievaluation");
define("CLIENT_SECRET","ievaluation");

$public_urls = array( "/workflow/evaluate/urecive"
		,"/master/account/accfrm"
		,"/workflow/evaluate/pifrm"
		,"/workflow/evaluate/mifrm"
		,"/authen/index/iauth"
		,"/account/account/index"
);

error_reporting(E_ALL|E_STRICT);
// error_reporting(E_ALL &~E_NOTICE); // Using in old version. 

ini_set('display error', 1);
date_default_timezone_set('Asia/Bangkok');

/**
 * Setup open library path
 */
$libs_version= array (
		"zend" => "1.5.0",
		"smarty" => "2.6.19",
		"dbtree" => "2005-09-23",
		"nusoap" => "0.7.3",
		"phpsniff" => "2.1.3"
);

$openlib = new OpenLibraries($libs_version);
$openlib->setIncludePath();

set_include_path( '.' 
				. PATH_SEPARATOR . '../library/'
				. PATH_SEPARATOR . '../application/models'
				. PATH_SEPARATOR . get_include_path() );

if(!class_exists("Zend_Loader")) {
		require_once "Zend/Loader.php";
}

Zend_Loader::registerAutoload();

Zend_Registry :: set("openlib", $openlib);
Zend_Registry :: set("public_urls", $public_urls);

// bootstrap in /Bootstrap.php
bootstrap();

$frontController = Zend_Registry::get("front");


$frontController->dispatch();

/* // Setup Controllers
$frontController = Zend_Controller_Front::getInstance();
$frontController->throwExceptions(true);
// $frontController->setControllerDirectory('../application/controllers');

Zend_Layout::startMvc( array('layoutPath' => '../application/layouts') );
// echo '<pre>' . print_r($frontController,1). '</pre>';exit;

// run
$frontController->dispatch();
 */
