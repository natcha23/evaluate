<?php
require_once "config/config.php";
require_once "function.php";
	connect_db();
	$sql = "SELECT mph_id,mph_user_flow,count(mph_user_flow) as summary,user_name,user_mobile " .
		   "FROM eva_mipi_head LEFT JOIN user ON user_code=mph_user_flow " .
		   "WHERE mph_status = 'C' GROUP BY mph_user_flow";
	$que = mysql_query($sql);
	$i = 0;
	while ($arr2 = mysql_fetch_array($que)) {
	$i++;
		if($arr2["user_mobile"]){
			//$mobile = "66".substr($arr2["user_mobile"],-9);
			$mobile = "66818657643";
			$message_sms = "วันนี้ คุณมีงานค้าง ในระบบประเมิน จำนวนทั้งหมด ".$arr2["summary"]." รายการ  กรุณา เข้าระบบประเมิน";
			$sender = "ICEs";
			//$this->sms($mobile,$message_sms,$sender);
		}
	  }
 exit;

?>