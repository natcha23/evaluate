<?php
  // System Config
  #set_time_limit(8);
  error_reporting(E_ALL &~E_NOTICE);

  // Root Path
  define("APP_DIR", dirname(dirname(__FILE__)));
//   echo '<pre>' . print_r(dirname(dirname(dirname(__FILE__))),1). '</pre>';
//   echo '<pre>' . print_r($_SERVER,1). '</pre>';exit;
  // Module Path
  define("APP_MOD", APP_DIR."/modules/");
  define('APP_HOME',"C:/AppServ/www");

  // Project URL
  $project = array_pop(explode(DIRECTORY_SEPARATOR,APP_DIR));
  define("projectName",$project);
  define("APP_URL", "http://".$_SERVER["HTTP_HOST"]."/".$project."/");
  define("IMG_URL", "http://".$_SERVER["HTTP_HOST"]."/".$project."/modules/systemapi/templates/default/images");
  define("UPLOAD_URL", "http://".$_SERVER["HTTP_HOST"]."/".$project."/uploads");
  define("UPLOAD_PATH", APP_HOME."/".$project."/uploads");
  // ICE Library
  define("SYSTEM_PATH",$_SERVER["DOCUMENT_ROOT"]."/iLibrary/trunk/");
  define('ROOTPATH', APP_HOME."/".$project);
  //define("SYSTEM_PATH",$_SERVER["DOCUMENT_ROOT"]."/iLibrary/");

  // Open Library
  define("LIBRARY_PATH",$_SERVER["DOCUMENT_ROOT"]."/openlib/");
//   define("LIBRARY_PATH",dirname(dirname(dirname(__FILE__)))."/openlib/");

  // Project library
//   define("PROJECT_LIBRARY_PATH",APP_DIR."/application/library/");
  define("PROJECT_LIBRARY_PATH",APP_DIR."/library/");

  // Set Include Path
  set_include_path(get_include_path().PATH_SEPARATOR.LIBRARY_PATH.PATH_SEPARATOR.SYSTEM_PATH.PATH_SEPARATOR.PROJECT_LIBRARY_PATH);
  # PATH_SEPARATOR.APP_MOD

  //amount line Catalog
  define("LINE_CATALOG",15);

  //Database use in project
  //define('DBNAME_USER','dev_sfa_db_dhas_ice');
//   define('DBNAME_USER','dev_ice_workflow');
  define('ROOT_DOC',$_SERVER["DOCUMENT_ROOT"]);
  define('BIZWARE_HOME',ROOT_DOC."/bizware");
  #define('SETHOST',"10.2.1.200");
  #define("SMS_PROXY","http://intranet.icesolution.com/sms-wf/send-workflow.php");
  //define('SMS_PROXY','http://10.3.2.4/sms-wf/send-workflow.php');
  
  // The Setup Script
  require_once(APP_DIR."/setup/helper.inc.php");
  require_once(APP_DIR."/setup/openlibs.inc.php");
  require_once(APP_DIR."/setup/setup.php");
  
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