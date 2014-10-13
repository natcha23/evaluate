<?php
require_once "config/config.php";

// ini_set('display_errors', 'On');
// error_reporting(E_ALL);

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

$openlib= new OpenLibraries($libs_version);
$openlib->setIncludePath();

bootstrap();

Zend_Registry::set("openlib", $openlib);
Zend_Registry::set("public_urls", $public_urls);

$front = Zend_Registry :: get("front");

#$logger = Zend_Registry :: get("logger");
#$logger->info("========Start Application========");


// Route
// $router = $front->getRouter(); // returns a rewrite router by default

// $router->addRoute(
// 		'accfrm',
// 		new Zend_Controller_Router_Route('accfrm/:id',
// 				array('module' => 'master',
// 						'controller' => 'account',
// 						'action' => 'accfrm'))
// );
// $router->addRoute(
// // 		http://localhost/iceworkflow/master/account/accfrm/id/58/mode/edit/
// 		'pifrm',
// 		new Zend_Controller_Router_Route('pifrm',
// 				array('module' => 'workflow',
// 						'controller' => 'evaluate',
// 						'action' => 'pifrm'))
// ); 

// $router->addRoute(
// 		'error',
// 		new Zend_Controller_Router_Route('error',
// 				array('module' => 'systemapi',
// 						'controller' => 'error',
// 						'action' => 'error'))
// );

$front->dispatch();
// $libs_version = $openlib = $front = null;