<?php
class SendSMS {
    public function __construct() {}
    public function sms($mobile,$message,$sender){
        $ch = curl_init();
        $message = iconv("UTF-8","TIS-620",$message);
        //$url = "http://intranet.icesolution.com/sms-wf/send-workflow.php";
        $url = SMS_PROXY;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST,1);
        $POSTFIELDS = array("message"=>$message,"mobile"=>$mobile,"sender"=>$sender);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDS);
        curl_exec($ch);
	    curl_close($ch);
    }
}
?>
