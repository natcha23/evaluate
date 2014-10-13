<?php
function connect_db() {
	$host= "192.168.10.99:3310";
	$user= "puk";	 $password = "puk"; $dbname = "dev_ice_workflow" ;
	//$host= "localhost:3310";
	//$user= "root";	 $password = ""; $dbname = "dev_ice_workflow" ;
	$db = mysql_connect($host,$user,$password)
		or die("Cannot connect database...");
	mysql_select_db($dbname,$db);
    #mysql_query ("SET NAMES UTF-8",$db);
    mysql_query("SET CHARACTER SET utf8",$db);
    mysql_query("SET collation_connection = 'utf8_unicode_ci'",$db);
	return $db;
}
?>