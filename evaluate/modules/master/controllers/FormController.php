<?php
require(BIZWARE_HOME."/libs/phpmailer/class.phpmailer.php");
if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');
class Master_FormController extends Workflow_Controller_Flow_Action {
	protected $per_page = "15";
	public $statusOp = array('Y'=>'Active','N'=>'Inactive');
	private function prepareUrl() {
    	return $this->getRequest()->getRequestUri();
    }
	public function displayAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        
        $data["headPage"] = "Form Evaluate List";
        $rows = $cat->getFormEvaluate($params,$params["page"],$this->per_page);
        $copyArr = $cat->getDraftFormEvaluate($params);

		$data["keyword"] = $params["keyword"];
   		$data["rows"] = $rows["data"];
   		$data["copyArr"] = $copyArr;
   		$data["totalRecord"] = $rows["total"];
        $data["perpage"]     = $this->per_page;
        $data["page"]  = $params["page"]?$params["page"]:1;
        $data["url"]  = $this->prepareUrl();
        $view->assign('', $data);
    	$view->output('form/_list.tpl');
    }
    public function evafrmAction() {
		$cat = $this->getGeneric();
		$view = $this->_getView();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
		if($params[save]){
   			$id_key = $params["fields"]["form_id"];
	    	if(!$id_key){
	        	$params["fields"]["createdate"] = date('Y-m-d H:i:s');
	    	}
	        $params["fields"]["updatetime"] = date('Y-m-d H:i:s');
	        $params["fields"]["user_id"] = $identity->user_code;

	        $id = $cat->saveMaster('mst_evaluateform','form_id',$id_key,$params["fields"]);
	        $this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Form Evaluate","Save");
	        echo "<script>window.location.href = '/".projectName."/master/form/display';</script>";
	        exit;
		}

        $data["headPage"] = "Form Evaluate Detail";
        $data["typeOp"] = $cat->getTypeEvaOption();
		$data["rows"] = $cat->getFormEvaluateById($params["id"]);
		$data["statusOp"] = $this->statusOp;
		if($data["rows"])$data["status"] = $data["rows"]["form_status"];else $data["status"] = 'Y';

        $view->assign('', $data);
    	$view->output('form/_form.tpl');
    }
    public function deleteAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
		if($params["delID"]){
		$idArray = explode(",",$params["delID"]);
    		foreach($idArray as $item){
    			$id_del .=($id_del)?",'".$item."'":"'".$item."'";
    		}
    		$cat->deleteMaster("mst_evaluateform","form_id",$id_del);
    		$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Form Evaluate","Delete");
    	}
		echo "'var data = 1';";
	   	exit;
    }
    public function deldraftAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
		if($params["delID"]){
		$idArray = explode(",",$params["delID"]);
    		foreach($idArray as $item){
    			$id_del .=($id_del)?",'".$item."'":"'".$item."'";
    		}
    		$cat->deleteMaster("draft_evaluateform","drf_id",$id_del);
    	}
		echo "'var data = 1';";
	   	exit;
    }
    
	public function popupAction() {

		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
		
       
		if($params["fields"]){						
			if($params["fields"]['month']){								
				$cat->SendAuto($params["fields"],$identity->user_code);
				$cat->UpdateDraft($params["fields"]);				
				$this->GetSysLogInfo("sys_loginfo",$identity->user_code,"Create Evaluate PI","Save");  
			}
			
			
			/*send mail first user receive*/
			$eForm["email"] = $identity->user_email;
			$eForm["name"]  = $identity->user_name ." ".$identity->user_lname;
			$rec_arr = $cat->GetUser($params["fields"]['uid']);
			$owner = $cat->GetDraftOwner($params["fields"]["sid"]);
			$mph_month = $params["fields"]['month'];
			if($rec_arr){
				foreach($rec_arr as $val){
					$mail_to = $val["user_email"];
					if($mail_to){
						$subject  = "การประเมิน PI ประจำเดือน ".$mph_month." จากฝ่ายบุคคล";
						$message  = "<font size=2>เรียน  คุณ ".$val["user_name"]." ".$val["user_lname"]."<br>" ;	
						$message .= "ฝ่ายบุคคลได้สร้างใบประเมิน PI ประจำเดือน ".$mph_month." ของพนักงาน ดังรายชื่อต่อไปนี้ <br><br>" ;						
						foreach($owner[$val["user_code"]]['owner'] as $key=>$item){
							$i = $key+1;
							$message .= "&nbsp;&nbsp;&nbsp;".$i.". ".$item['user_name']." ".$item['user_lname']."&nbsp; รหัส  &nbsp;".$item['user_code']."<br>";
						}
						$message .= "<br>มาถึงคุณเรียบร้อยแล้ว<br>";
						$message .= "กรุณาเข้าระบบประเมิน <a href='http://sfa.icesolution.com/iceworkflow'>http://sfa.icesolution.com/iceworkflow</a> เพื่อทำการใส่ข้อมูลรายการประเมิน<br><br>";
						$message .= "มีปัญหา ในการใช้งานแจ้ง Admin ระบบ</font>";
						$this->sendMail($message,$subject,$mail_to,$eForm);
					}					
				}
			}
			$data['reload'] = '1';
			//echo "<script>window.opener.location.reload();</script>";		
		}
		$params["sid"] = ($params["sid"])?$params["sid"]:$params["fields"]["sid"];
		$rows = $cat->GetDraft($params["sid"]);
		
		
		$data['MonthOp'] = $this->MonthOp($rows['month']);
		$data['sid'] = $params["sid"];
		$data['rows'] = $rows;
		$view->assign('', $data);
		$view->output('form/_popdate.tpl');
	}
	function MonthOp($str){		
		$data = explode("/",$str);
		
		$val1 = $data[0].'/'.$data[1];	
		if($data[0]=='12'){
			$val2 = '01/'.$data[1]+1;			
		}else{			
			$m = sprintf("%02d",($data[0]*1)+1);
			$val2 = $m.'/'.$data[1];
		}
		$data_arr = array($val1 => $val1,$val2 => $val2);
		return $data_arr;
	}

	public function sendMail($body,$subject,$eMail,$eForm){

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = SETHOST;
		$mail->SMTPAuth = false;
		$mail->CharSet = "utf-8";
		//$mail->Username = "siriphan@icesolution.com";
		//$mail->Password = "siriphan";

		$mail->From = $eForm["email"];
		$mail->FromName = $eForm["name"];

		$mail->AddAddress($eMail);// $eMail
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $body;

		$mail->Send();
	}

}
