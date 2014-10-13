<?php
if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');
class Workflow_SummaryController extends Workflow_Controller_Flow_Action {
	protected $monthOp = array('01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน',
							   '07'=>'กรกฎาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
	protected $monthShotOp = array('01'=>'ม.ค.','02'=>'ก.พ.','03'=>'มี.ค.','04'=>'เม.ย.','05'=>'พ.ค.','06'=>'มิ.ย.',
							   '07'=>'ก.ค.','08'=>'ส.ค.','09'=>'ก.ย.','10'=>'ต.ค.','11'=>'พ.ย.','12'=>'ธ.ค.');

	protected $quarterOp = array('Q1'=>'Quarter 1','Q2'=>'Quarter 2','Q3'=>'Quarter 3','Q4'=>'Quarter 4');
	protected $column;
	protected $sumIncentive;
	protected $user_col;
	//protected $org_arr = "931,932,940,941,942";
	//protected $org_arr = "400,410,411,412,413,420,421,422,430,431,432,440,441,442";
	protected $org_arr = "001,110,111,210,211,310,311,320,321,500,510,511,520,521,530,531,540,541";

    public function incentiveAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
    	$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
        
		$yearPrev2 = date('Y')-2;
		$yearPrev = date('Y')-1;
        $yearNow = date('Y');
        $yearNext = date('Y')+1;
        $data["yearOp"] = array($yearPrev2=>$yearPrev2,$yearPrev=>$yearPrev,$yearNow=>$yearNow,$yearNext=>$yearNext);

		$m = date("m");
		if($m >= '01' && $m <= '03'){
			$mQuarter = 'Q1';
		}elseif($m >= '04' && $m <= '06'){
			$mQuarter = 'Q2';
		}elseif($m >= '07' && $m <= '09'){
			$mQuarter = 'Q3';
		}elseif($m >= '10' && $m <= '12'){
			$mQuarter = 'Q4';
		}

		if($params["search"]["year"]){
			$year = $params["search"]["year"];
		}else{
			if($params["my"]){
				$year = substr($params["my"],-4);
			}else{
				$year = date("Y");
			}
		}
		if($params["type"] == 'PI'){
			if($params["search"]["month"]){
				$month = sprintf("%02d",$params["search"]["month"]);
			}else{
				if($params["my"]){
					$month = substr($params["my"],0,2);
				}else{
					if(date("m")=='1') $month = '12'; else $month = sprintf("%02d",date("m")-1);
				}
			}
			$data["month_name"] = $this->monthOp[$month]." ปี ".$year;
		}else{
			if($params["search"]["quarter"]){
				$month = $params["search"]["quarter"];
			}else{
				$month = $mQuarter;
			}
			$data["month_name"] = $this->quarterOp[$month]." ปี ".$year;
		}

		if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			$data["head_org"] = "Y";
			if($identity->level == '11'){// || $identity->level == '10'
				$org = $cat->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params[head_org]	 = $org;
			}else{
				
				$org = $cat->GetOrgByCode($identity->user_code);
				$_year = $params['search']['month']."".$params['search']['year'];
				if(!$_year) $_year = $month.$year;
				$first_recive = $cat->GetUserByFirstRecive($identity->user_code,$_year);
				$params[head_org] = $org;
				$params[first_recive] = $first_recive;
			}

			$params["not_user"] = $identity->user_code;
			$data["group"] = $identity->user_sec_depart;
		}else{
			$data["group"] = $params["group"];
		}
		
		// Sync
		if($params['process']=='sync'){
			// 			_print($params);
			$this->syncEvaWithCurrentData($params);
		}
		
		//_print($params);
		$data["dataArr"] = $cat->getUserAccept($params);
// _print($data['dataArr']);
		$data["monthNow"]= $month.$year;
		$data["month"] = $month;
		$data["year"] = $year;
        $data["headPage"] = "สรุปการประเมิน ".$params["type"]." ประจำเดือน  ".$data["month_name"];
    	$data["groupBUOp"] = $cat->getGroupBUList();
    	$data["quarterOp"] = $this->quarterOp;
    	$data["monthOp"] = $this->monthOp;
		$data["typePage"] = $params["type"];
		
		if($params["type"]=='PI') {
			$rowsArr = $cat->getAcceptIncentivePI($params["group"],$data["monthNow"],$data["typePage"],"F",$this->sumIncentive,$this->countAll,$params[head_org],$params["not_user"],$params[first_recive]);
			
		} else {
			$rowsArr = $cat->getAcceptIncentive($params["group"],$data["monthNow"],$data["typePage"],"F",$this->sumIncentive,$this->countAll,$params[head_org],$params["not_user"]);
		}
		
//_print($data["dataArr"]);
		$data["incArr"] = $this->sumIncentive;
		$data["rowsArr"] = $rowsArr["data"];
		$data["endflow"] = $rowsArr["endflow"];

		if($data["incArr"]){
			foreach($data["incArr"] as $item){
				$totalArr["count_user"] = $this->countAll;
				$totalArr["sum_incentive"] += $item["sum_incentive"];
				$totalArr["sum_scoll"] += $item["sum_scoll"];
				if($this->countAll)
					$totalArr["average_scoll"] += $item["sum_scoll"]/$this->countAll;
			}
		}
// _print($data["incArr"]);
		$data["totalArr"] = $totalArr;
		if($identity->lookup_code =='ACC' || $identity->lookup_code =='HR')
			$data["show"] = "Y";
		
        $view->assign('', $data);
		$view->output('summary/_incentive.tpl');
    }
	public function delayAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
    	$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

    	$yearPrev = date('Y')-1;
        $yearNow = date('Y');
        $yearNext = date('Y')+1;
        $data["yearOp"] = array($yearPrev=>$yearPrev,$yearNow=>$yearNow,$yearNext=>$yearNext);
		if($params["search"]["year"]){
			$year = $params["search"]["year"];
		}else{
			$year = date("Y");
		}
		$m = date("m");
		if($m >= '01' && $m <= '03'){
			$mQuarter = 'Q1';
		}elseif($m >= '04' && $m <= '06'){
			$mQuarter = 'Q2';
		}elseif($m >= '07' && $m <= '09'){
			$mQuarter = 'Q3';
		}elseif($m >= '10' && $m <= '12'){
			$mQuarter = 'Q4';
		}

		if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			$data["head_org"] = "Y";
			if($identity->level == '11'){// || $identity->level == '10'
				$org = $cat->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params[head_org] = $org;
			}else{
				$org = $cat->GetOrgByCode($identity->user_code);
				$params[head_org] = $org;
			}
			$params["not_user"] = $identity->user_code;
			$data["group"] = $identity->user_sec_depart;
		}else{
			$data["group"] = $params["group"];
		}

		$data["year"] = $year;
        $data["headPage"] = "สรุปการประเมิน ".$params["type"]." ล่าช้า ";
    	$data["groupBUOp"] = $cat->getGroupBUList();
    	if($params["type"] == 'MI'){
    		$data["monthOp"] = $this->quarterOp;
    		$month = $mQuarter;
    	}else{
    		$data["monthOp"] = $this->monthShotOp;
    		$month = sprintf("%02d",date("m"));
    	}
		$data["month"] = $month;
		$data["dataArr"] = $cat->getUserAccept($params);
		$data["typePage"] = $params["type"];
		$rowsArr = $cat->getSendDelay($year,$params["group"],$params["type"],"R",$params["head_org"]);
		$data["rowsArr"] = $rowsArr;
        $view->assign('', $data);
		$view->output('summary/_delay.tpl');
	}
	public function empAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
    	$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
		//_print($params);

		if($params["type"]=='PI'){$month_name = "Month";}else{$month_name = "Quarter";}
		if($params[type]=='PI'){
			$n = 1;
			for($i=0;$i<6;$i++){
				$m = date("m")-5;
				$y = date("Y");
				if($m <= 12){
					$num = $m+$i;
					$year = $y;
					$m++;
					if($num > 12) {
						$num = $n;
						$year = $y+1;
						$n++;
					}
					$l = 12+$num;
					if($num < 1) {
						$num = $l;
						$year = $y-1;
						$l--;
					}
				}
				$yearN = sprintf("%02d",$year);
				$numM = sprintf("%02d",$num);
				$key = $numM."".$yearN;
				$month[$key] = $this->monthOp[$numM]." : ".$yearN;
			}
			$data[typePage]= "PI";
			if(date("m")=='1') $data[month] = '12';else $data[month] = sprintf("%02d",date("m")-1);
		}else{
			$m = date("m");
			if($m >= '01' && $m <= '03'){
				$mN = 'Q1';
				$mOp = array("Q2"=>"2","Q3"=>"3","Q4"=>"4","Q1"=>"1");
			}elseif($m >= '04' && $m <= '06'){
				$mN = 'Q2';
				$mOp = array("Q3"=>"3","Q4"=>"4","Q1"=>"1","Q2"=>"2");
			}elseif($m >= '07' && $m <= '09'){
				$mN = 'Q3';
				$mOp = array("Q4"=>"4","Q1"=>"1","Q2"=>"2","Q3"=>"3");
			}elseif($m >= '10' && $m <= '12'){
				$mN = 'Q4';
				$mOp = array("Q1"=>"1","Q2"=>"2","Q3"=>"3","Q4"=>"4");
			}
			$year = date("Y");
			foreach($mOp as $key=>$data2){
				if($mN =='Q1'){
					if($key =='Q1')$y = $year; else $y = $year-1;
				}
				if($mN =='Q2'){
					if($key =='Q1' || $key =='Q2')$y = $year; else $y = $year-1;
				}
				if($mN =='Q3'){
					if($key =='Q1' || $key =='Q2' || $key =='Q3')$y = $year; else $y = $year-1;
				}
				if($mN =='Q4')$y = $year;

				$yearN = sprintf("%02d",$y);
				$numM = sprintf("%02d",$key);
				$key_new = $key."".$yearN;
				$month[$key_new] = $this->quarterOp[$key]." : ".$yearN;
				$key_old = $key;
			}

			$data[typePage]= "MI";
			$data[month] = $mN;
		}
		if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			$data["head_org"] = "Y";
			if($identity->level == '11'){// || $identity->level == '10'
				$org = $cat->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params[head_org] = $org;
			}else{
				$org = $cat->GetOrgByCode($identity->user_code);
				$_year = $params['search']['month']."".$params['search']['year'];
				if(!$_year) $_year = $month.$year;
				$first_recive = $cat->GetUserByFirstRecive($identity->user_code,'');
				$params[head_org] = $org;
				$params[first_recive] = $first_recive;
			}

			$params["not_user"] = $identity->user_code;
			$data["group"] = $identity->user_sec_depart;
		}else{
			$data["group"] = $params["group"];
		}

		/*if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			$data["head_org"] = "Y";
			if($identity->level == '11'){// || $identity->level == '10'
				$org = $cat->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params[head_org] = $org;
			}else{
				$org = $cat->GetOrgByCode($identity->user_code);
				$params[head_org] = $org;
			}
			$params["not_user"] = $identity->user_code;
			$data["group"] = $identity->user_sec_depart;
		}else{
			$data["group"] = $params["group"];
		}*/
		$data["monthNow"]= $data[month].$year;
		$data["groupBUOp"] = $cat->getGroupBUList();
		$data["dataArr"] = $cat->getUserAccept($params);
		$data["rowsArr"] = $cat->getEmpByType($data["typePage"]);
		$data["typePage"] = $params["type"];
		$data["monthOp"]= $month;
		$data["headPage"] = "สรุปการประเมิน ".$params["type"]." พนักงาน By ".$month_name;
        $view->assign('', $data);
		$view->output('summary/_emptype.tpl');
	}
	public function exporttoxlsAction() {
		$cat = $this->getGeneric();
		$params = $this->getParams();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        //include('Export2xls.php');
        //$csvObj = new Export2xls();
        $month = sprintf("%02d",$params["month"]);
        $name = $params["type"].$month.$params["year"];

		$dataArr = $cat->getUserAccept($params);
		//_print($dataArr);exit;
		if($params["type"]=='PI')
			$dataSub = $cat->getAcceptIncentivePI($params["group"],$month.$params["year"],$params["type"],"F",$this->sumIncentive,$this->countAll,$params[head_org],$params["not_user"],"");
		else
			$dataSub = $cat->getAcceptIncentive($params["group"],$month.$params["year"],$params["type"],"F",$this->sumIncentive,$this->countAll,$params[head_org],$params["not_user"]);
		$columRecord = array('Org_Code','Code','Name','Position','Level','Grade','Incentive');

 	   // $fname = "report_".$name.date("Ymd_His");
 	    $fname = "report_".$name;
  	    //$csvObj->SetFileName($fname);
  	    //$csvObj->SetHeader();

		if($dataArr){
			foreach($dataArr as $key1 =>$item){
				//$dataRecord[] = $item[department];
				$lineArr["Org_Code"] = $item[department];
				$lineArr["Code"] = "";
				$lineArr["Name"] = "";
				$lineArr["Position"] = "";
				$lineArr["Level"] = "";
				$lineArr["Grade"] = "";
				$lineArr["Incentive"] = "";
				$dataRecord[] = $lineArr;
				$lineArr="";
				if($item[user]){
					foreach($item[user] as $key=>$subRow){
						$lineArr["Org_Code"] = "";
						
						$lineArr["Code"] = $subRow["user_code"];
						if($subRow["user_code"]=='1001') {
							
							if(empty($params['format'])) {
								$lineArr["Code"] = "-contact-";
							}
						}
						
						$lineArr["Name"] = $subRow["user_name"]." ".$subRow["user_lname"];
						$lineArr["Position"] = $subRow["org_position_name_th"];
						$lineArr["Level"] = $subRow["org_position_level"];
						$lineArr["Grade"] = $dataSub["data"][$key1][$key]["mph_grade"];
						$lineArr["Incentive"] = $dataSub["data"][$key1][$key]["incentive"];
						
						$dataRecord[] = $lineArr;
					}
				}
			}
			$colums = array_keys($columRecord);
		}
  	    //$csvObj->WriteFile($dataRecord,$columRecord,"\t","\"");
        //exit;
        
		// Add format for hr.
		// 10 Jun 2014 #natcha
		if(!empty($params['format']) && $params['format'] == 'hr') {
			$this->exportSalaryXls($dataRecord, $name);
		}else{
			$this->exportObjXls($dataRecord,$name);
		}
    }
	public function exportObjXls($data,$name) {
        ob_clean();
        require_once LIBRARY_PATH.'PHPExcel/1.7.0/Classes/PHPExcel.php';
        /** PHPExcel_IOFactory */
        require_once LIBRARY_PATH.'PHPExcel/1.7.0/Classes/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();

        //set Properties

        $objPHPExcel->getProperties()->setCreator("PI System 2011 (v 2.2.0)");
        $objPHPExcel->getProperties()->setLastModifiedBy("PI System");
        $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX PI System Document");
        $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX PI System Document");
        $objPHPExcel->getProperties()->setDescription("Generated using PHP classes.");
        $objPHPExcel->getProperties()->setKeywords("office 2007 php");
        $objPHPExcel->getProperties()->setCategory("Transfer");

        //Add DefaultStyle
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getDefaultStyle()->getFont()->getColor()->setARGB("00000000");

        $ActiveSheet = $objPHPExcel->getActiveSheet();
        //Add Style

        $ActiveSheet->getColumnDimension('A')->setWidth(25);
        $ActiveSheet->getColumnDimension('B')->setWidth(10);
        $ActiveSheet->getColumnDimension('C')->setWidth(25);
        $ActiveSheet->getColumnDimension('D')->setWidth(25);
        $ActiveSheet->getColumnDimension('E')->setWidth(10);
        $ActiveSheet->getColumnDimension('F')->setWidth(15);
        $ActiveSheet->getColumnDimension('G')->setWidth(15);


        //Add dataTitle
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getDefaultStyle()->getFont()->getColor()->setARGB("FF000000");
        if (isset($data) && $data) {
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );



            $ActiveSheet->getStyle("A1:G1")->applyFromArray($styleArray);
            $ActiveSheet->getStyle("A1:G1")->getFont()->setBold(true);
            $ActiveSheet->getStyle("A1:G1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            $ActiveSheet->setCellValue("A1", "Org Code");
            $ActiveSheet->setCellValue("B1", "Code");
            $ActiveSheet->setCellValue("C1", "Name");
            $ActiveSheet->setCellValue("D1", "Position");
            $ActiveSheet->setCellValue("E1", "Level");
            $ActiveSheet->setCellValue("F1", "Grade");
            $ActiveSheet->setCellValue("G1", "Incentive");


            $line = 2;
            foreach ($data as $row) {

                $row["Org_Code"] = iconv("UTF-8","TIS-620",$row["Org_Code"]);
                $row["Position"] = iconv("UTF-8","TIS-620",$row["Position"]);
                $row["Name"] = iconv("UTF-8","TIS-620",$row["Name"]);

                $ActiveSheet->getStyle("A" . $line . ":G" . $line)->applyFromArray($styleArray);
     			$ActiveSheet->getStyle("A" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $ActiveSheet->setCellValue("A" . $line, $row["Org_Code"]);
                $ActiveSheet->getStyle("B" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                $ActiveSheet->setCellValue("B" . $line, $row["Code"]);
                $ActiveSheet->getStyle("C" . $line . ":D" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $ActiveSheet->setCellValue("C" . $line, $row["Name"]);
                $ActiveSheet->setCellValue("D" . $line, $row["Position"]);
                $ActiveSheet->getStyle("E" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                $ActiveSheet->setCellValue("E" . $line, $row["Level"]);
                $ActiveSheet->getStyle("F" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                $row["Grade"] = (!empty($row["Grade"]))? $row['Grade'] : " "; 
                $ActiveSheet->setCellValue("F" . $line, $row["Grade"]);
                $ActiveSheet->getStyle("G" . $line)->getNumberFormat()->setFormatCode('#,##0.00');
                $ActiveSheet->setCellValue("G" . $line, $row["Incentive"]);


                $line++;
            }


        }
        //$objPHPExcel->getActiveSheet()->setTitle('Summary Report '.$Y);
        // Save Excel
        if (!file_exists(UPLOAD_PATH . "/export")) {
            mkdir(UPLOAD_PATH . "/export", 0777);
        }
        $file = UPLOAD_PATH . "/export/report_" . $name ."_". date("YmdHis") . ".xlsx";
        //$filename = substr($file, 8);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($file);

        
        header("Location: " . UPLOAD_URL . "/export/" . basename($file));
        //$this->downloadfile($file);
    }



    public function exporttoxls2Action() {
		$cat = $this->getGeneric();
		$params = $this->getParams();

		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

        //include('Export2xls.php');
        //$csvObj = new Export2xls();
        $month = sprintf("%02d",$params["month"]);
        $name = $params["type"].$month.$params["year"];

		$dataArr = $cat->getUserAccept($params);
		//_print($dataArr);exit;
		if($params["type"]=='PI')
			$dataSub = $cat->getAcceptIncentivePI_AVG($params["group"],$month.$params["year"],$params["type"],"F",$this->sumIncentive,$this->countAll,$params[head_org],$params["not_user"],"");
		$columRecord = array('Org_Code','Code','Name','Position','Level','Goal','Job_Descriptoin','Personality',
						     'การบริหารเป้าหมายงานตามกลุ่มที่ได้รับผิดชอบ','การดูแลการพัฒนา Product iSFA','การปรับปรุงกระบวนการทำงานของหน่วยงาน',
						     'การจัดการงาน POC Product','การบริหารจัดการงาน Implementation','การบริหารการจัดการงาน Support & HelpDesk',
						     'การดำเนินการตามแผนงานด้านการตลาด','การดำเนินการตามแผนงานด้าน Channel','สามารถสร้างกลุ่มบริการ (PS/IMP)มาตรฐาน',
						     'ปรับปรุง ICES Operation เป็น ICES Automation','เลขางานสำนักงาน','เลขาส่วนบุคคล','งานโครงการ','การบริหารและปรับปรุงกระบวนการของทีมงาน',
						     'การพัฒนาบุคลากรตามโครงสร้างที่กำหนด','การบริหารจัดการผลิตภัณฑ์','การบริหารจัดการลูกค้า','การบริหารจัดการงานและทีมงาน',
						     'งานด้านบุคคล','งานด้านธุรการ','การบริหารจัดการทีมงานตามเป้าหมาย');

  	    $fname = "report_avg_".$name;
  	    //$csvObj->SetFileName($fname);
  	    //$csvObj->SetHeader();

		if($dataArr){
			foreach($dataArr as $key1 =>$item){
				//$dataRecord[] = $item[department];
				$lineArr["Org_Code"] = $item[department];
				$lineArr["Code"] = "";
				$lineArr["Name"] = "";
				$lineArr["Position"] = "";
				$lineArr["Level"] = "";
				$lineArr["Goal"] = "";
				$lineArr["Job_Descriptoin"] = "";
				$lineArr["Personality"] = "";
				$dataRecord[] = $lineArr;
				$lineArr="";
				if($item[user]){
					foreach($item[user] as $key=>$subRow){
						$lineArr["Org_Code"] = "";

						if($subRow["user_code"]=='1001')
							$lineArr["Code"] = "-contact-";
						else
							$lineArr["Code"] = $subRow["user_code"];
						$lineArr["Name"] = $subRow["user_name"]." ".$subRow["user_lname"];
						$lineArr["Position"] = $subRow["org_position_name_th"];
						$lineArr["Level"] = $subRow["org_position_level"];

						$lineArr["Goal"] = ($dataSub[$key1][$key]["การประเมินผลตามเป้าแผนก"]/10)*1;
						$lineArr["Job_Descriptoin"] = ($dataSub[$key1][$key]["Job Description"]/10)*1;
						$lineArr["Personality"] = ($dataSub[$key1][$key]["Personality"]/10)*1;
						$lineArr["การบริหารเป้าหมายงานตามกลุ่มที่ได้รับผิดชอบ"] = ($dataSub[$key1][$key]["การบริหารเป้าหมายงานตามกลุ่มที่ได้รับผิดชอบ"]/10)*1;
						$lineArr["การดูแลการพัฒนา Product iSFA"] = ($dataSub[$key1][$key]["การดูแลการพัฒนา Product iSFA"]/10)*1;
						$lineArr["การปรับปรุงกระบวนการทำงานของหน่วยงาน"] = ($dataSub[$key1][$key]["การปรับปรุงกระบวนการทำงานของหน่วยงาน"]/10)*1;

						$lineArr["การจัดการงาน POC Product"] = ($dataSub[$key1][$key]["การจัดการงาน POC Product"]/10)*1;
						$lineArr["การบริหารจัดการงาน Implementation"] = ($dataSub[$key1][$key]["การบริหารจัดการงาน Implementation"]/10)*1;
						$lineArr["การบริหารการจัดการงาน Support & HelpDesk"] = ($dataSub[$key1][$key]["การบริหารการจัดการงาน Support & HelpDesk"]/10)*1;
						$lineArr["การดำเนินการตามแผนงานด้านการตลาด"] = ($dataSub[$key1][$key]["การดำเนินการตามแผนงานด้านการตลาด"]/10)*1;
						$lineArr["การดำเนินการตามแผนงานด้าน Channel"] = ($dataSub[$key1][$key]["การดำเนินการตามแผนงานด้าน Channel"]/10)*1;

						$lineArr["สามารถสร้างกลุ่มบริการ (PS/IMP)มาตรฐาน"] = ($dataSub[$key1][$key]["สามารถสร้างกลุ่มบริการ (PS/IMP)มาตรฐาน"]/10)*1;
						$lineArr["ปรับปรุง ICES Operation เป็น ICES Automation"] = ($dataSub[$key1][$key]["ปรับปรุง ICES Operation เป็น ICES Automation"]/10)*1;
						$lineArr["เลขางานสำนักงาน"] = ($dataSub[$key1][$key]["เลขางานสำนักงาน"]/10)*1;
						$lineArr["เลขาส่วนบุคคล"] = ($dataSub[$key1][$key]["เลขาส่วนบุคคล"]/10)*1;
						$lineArr["งานโครงการ"] = ($dataSub[$key1][$key]["งานโครงการ"]/10)*1;

						$lineArr["การบริหารและปรับปรุงกระบวนการของทีมงาน"] = ($dataSub[$key1][$key]["การบริหารและปรับปรุงกระบวนการของทีมงาน"]/10)*1;
						$lineArr["การพัฒนาบุคลากรตามโครงสร้างที่กำหนด"] = ($dataSub[$key1][$key]["การพัฒนาบุคลากรตามโครงสร้างที่กำหนด"]/10)*1;
						$lineArr["การบริหารจัดการผลิตภัณฑ์"] = ($dataSub[$key1][$key]["การบริหารจัดการผลิตภัณฑ์"]/10)*1;

						$lineArr["การบริหารจัดการลูกค้า"] = ($dataSub[$key1][$key]["การบริหารจัดการลูกค้า"]/10)*1;
						$lineArr["การบริหารจัดการงานและทีมงาน"] = ($dataSub[$key1][$key]["การบริหารจัดการงานและทีมงาน"]/10)*1;
						$lineArr["งานด้านบุคคล"] = ($dataSub[$key1][$key]["งานด้านบุคคล"]/10)*1;
						$lineArr["งานด้านธุรการ"] = ($dataSub[$key1][$key]["งานด้านธุรการ"]/10)*1;
						$lineArr["การบริหารจัดการทีมงานตามเป้าหมาย"] = ($dataSub[$key1][$key]["การบริหารจัดการทีมงานตามเป้าหมาย"]/10)*1;

						$dataRecord[] = $lineArr;

					}
				}
			}
			$colums = array_keys($columRecord);
		}
  	   //$csvObj->WriteFile2($dataRecord,$columRecord,"\t","\"");
       //exit;

		$this->exportObjXls2($dataRecord,$name);
    }
    public function exportObjXls2($data,$name) {
        ob_clean();
        require_once LIBRARY_PATH.'PHPExcel/1.7.0/Classes/PHPExcel.php';
        /** PHPExcel_IOFactory */
        require_once LIBRARY_PATH.'PHPExcel/1.7.0/Classes/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();

        //set Properties

        $objPHPExcel->getProperties()->setCreator("PI System 2011 (v 2.2.0)");
        $objPHPExcel->getProperties()->setLastModifiedBy("PI System");
        $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX PI System Document");
        $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX PI System Document");
        $objPHPExcel->getProperties()->setDescription("Generated using PHP classes.");
        $objPHPExcel->getProperties()->setKeywords("office 2007 php");
        $objPHPExcel->getProperties()->setCategory("Transfer");

        //Add DefaultStyle
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getDefaultStyle()->getFont()->getColor()->setARGB("00000000");

        $ActiveSheet = $objPHPExcel->getActiveSheet();
        //Add Style

        $ActiveSheet->getColumnDimension('A')->setWidth(25);
        $ActiveSheet->getColumnDimension('B')->setWidth(10);
        $ActiveSheet->getColumnDimension('C')->setWidth(25);
        $ActiveSheet->getColumnDimension('D')->setWidth(25);
        $ActiveSheet->getColumnDimension('E')->setWidth(10);
        $ActiveSheet->getColumnDimension('F')->setWidth(10);
        $ActiveSheet->getColumnDimension('G')->setWidth(10);
        $ActiveSheet->getColumnDimension('H')->setWidth(10);
        $ActiveSheet->getColumnDimension('I')->setWidth(15);
        $ActiveSheet->getColumnDimension('J')->setWidth(15);
        $ActiveSheet->getColumnDimension('K')->setWidth(15);
        $ActiveSheet->getColumnDimension('L')->setWidth(15);
        $ActiveSheet->getColumnDimension('M')->setWidth(15);
        $ActiveSheet->getColumnDimension('N')->setWidth(15);
        $ActiveSheet->getColumnDimension('O')->setWidth(15);
        $ActiveSheet->getColumnDimension('P')->setWidth(15);
        $ActiveSheet->getColumnDimension('Q')->setWidth(15);
        $ActiveSheet->getColumnDimension('R')->setWidth(15);
        $ActiveSheet->getColumnDimension('S')->setWidth(15);

        $ActiveSheet->getColumnDimension('T')->setWidth(15);
        $ActiveSheet->getColumnDimension('U')->setWidth(15);
        $ActiveSheet->getColumnDimension('V')->setWidth(15);
        $ActiveSheet->getColumnDimension('W')->setWidth(15);
        $ActiveSheet->getColumnDimension('X')->setWidth(15);
        $ActiveSheet->getColumnDimension('Y')->setWidth(15);
        $ActiveSheet->getColumnDimension('Z')->setWidth(15);
        $ActiveSheet->getColumnDimension('AA')->setWidth(15);
        $ActiveSheet->getColumnDimension('AB')->setWidth(15);
        $ActiveSheet->getColumnDimension('AC')->setWidth(15);

        //Add dataTitle
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getDefaultStyle()->getFont()->getColor()->setARGB("FF000000");
        if (isset($data) && $data) {
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );




            $ActiveSheet->getStyle("A1:S1")->applyFromArray($styleArray);
            $ActiveSheet->getStyle("A1:S1")->getFont()->setBold(true);
            $ActiveSheet->getStyle("A1:S1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            $ActiveSheet->setCellValue("A1", "Org Code");
            $ActiveSheet->setCellValue("B1", "Code");
            $ActiveSheet->setCellValue("C1", "Name");
            $ActiveSheet->setCellValue("D1", "Position");
            $ActiveSheet->setCellValue("E1", "Level");
            $ActiveSheet->setCellValue("F1", "Goal");
            $ActiveSheet->setCellValue("G1", "Job Descriptoin");
            $ActiveSheet->setCellValue("H1", "Personality");
            $ActiveSheet->setCellValue("I1", "การบริหารเป้าหมายงานตามกลุ่มที่ได้รับผิดชอบ");
            $ActiveSheet->setCellValue("J1", "การดูแลการพัฒนา Product iSFA");
            $ActiveSheet->setCellValue("K1", "การปรับปรุงกระบวนการทำงานของหน่วยงาน");
            $ActiveSheet->setCellValue("L1", "การจัดการงาน POC Product");
            $ActiveSheet->setCellValue("M1", "การบริหารจัดการงาน Implementation");
            $ActiveSheet->setCellValue("N1", "การบริหารการจัดการงาน Support & HelpDesk");
            $ActiveSheet->setCellValue("O1", "การดำเนินการตามแผนงานด้านการตลาด");
            $ActiveSheet->setCellValue("P1", "การดำเนินการตามแผนงานด้าน Channel");
            $ActiveSheet->setCellValue("Q1", "สามารถสร้างกลุ่มบริการ (PS/IMP)มาตรฐาน");
            $ActiveSheet->setCellValue("R1", "ปรับปรุง ICES Operation เป็น ICES Automation");
            $ActiveSheet->setCellValue("S1", "เลขางานสำนักงาน");

            $ActiveSheet->setCellValue("T1", "เลขาส่วนบุคคล");
            $ActiveSheet->setCellValue("U1", "งานโครงการ");
            $ActiveSheet->setCellValue("V1", "การบริหารและปรับปรุงกระบวนการของทีมงาน");
            $ActiveSheet->setCellValue("W1", "การพัฒนาบุคลากรตามโครงสร้างที่กำหนด");

            $ActiveSheet->setCellValue("X1", "การบริหารจัดการผลิตภัณฑ์");
            $ActiveSheet->setCellValue("Y1", "การบริหารจัดการลูกค้า");
            $ActiveSheet->setCellValue("Z1", "การบริหารจัดการงานและทีมงาน");
            $ActiveSheet->setCellValue("AA1", "งานด้านบุคคล");
            $ActiveSheet->setCellValue("AB1", "งานด้านธุรการ");
            $ActiveSheet->setCellValue("AC1", "การบริหารจัดการทีมงานตามเป้าหมาย");

            $line = 2;
            foreach ($data as $row) {

                $row["Org_Code"] = iconv("UTF-8","TIS-620",$row["Org_Code"]);
                $row["Position"] = iconv("UTF-8","TIS-620",$row["Position"]);
                $row["Name"] = iconv("UTF-8","TIS-620",$row["Name"]);

                $ActiveSheet->getStyle("A" . $line . ":AC" . $line)->applyFromArray($styleArray);
     			$ActiveSheet->getStyle("A" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $ActiveSheet->setCellValue("A" . $line, $row["Org_Code"]);
                $ActiveSheet->getStyle("B" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                $ActiveSheet->setCellValue("B" . $line, $row["Code"]);
                $ActiveSheet->getStyle("C" . $line . ":D" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $ActiveSheet->setCellValue("C" . $line, $row["Name"]);
                $ActiveSheet->setCellValue("D" . $line, $row["Position"]);
                $ActiveSheet->getStyle("E" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                $ActiveSheet->setCellValue("E" . $line, $row["Level"]);
                $ActiveSheet->getStyle("F" . $line . ":R" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $ActiveSheet->setCellValue("F" . $line, $row["Goal"]);
                $ActiveSheet->setCellValue("G" . $line, $row["Job_Descriptoin"]);
                $ActiveSheet->setCellValue("H" . $line, $row["Personality"]);

                $ActiveSheet->setCellValue("I" . $line, $row["การบริหารเป้าหมายงานตามกลุ่มที่ได้รับผิดชอบ"]);
                $ActiveSheet->setCellValue("J" . $line, $row["การดูแลการพัฒนา Product iSFA"]);
                $ActiveSheet->setCellValue("K" . $line, $row["การปรับปรุงกระบวนการทำงานของหน่วยงาน"]);
                $ActiveSheet->setCellValue("L" . $line, $row["การจัดการงาน POC Product"]);
                $ActiveSheet->setCellValue("M" . $line, $row["การบริหารจัดการงาน Implementation"]);
                $ActiveSheet->setCellValue("N" . $line, $row["การบริหารการจัดการงาน Support & HelpDesk"]);
                $ActiveSheet->setCellValue("O" . $line, $row["การดำเนินการตามแผนงานด้านการตลาด"]);
                $ActiveSheet->setCellValue("P" . $line, $row["การดำเนินการตามแผนงานด้าน Channel"]);
                $ActiveSheet->setCellValue("Q" . $line, $row["สามารถสร้างกลุ่มบริการ (PS/IMP)มาตรฐาน"]);

                $ActiveSheet->setCellValue("R" . $line, $row["ปรับปรุง ICES Operation เป็น ICES Automation"]);
                $ActiveSheet->setCellValue("S" . $line, $row["เลขางานสำนักงาน"]);
                $ActiveSheet->setCellValue("T" . $line, $row["เลขาส่วนบุคคล"]);
                $ActiveSheet->setCellValue("U" . $line, $row["งานโครงการ"]);
                $ActiveSheet->setCellValue("V" . $line, $row["การบริหารและปรับปรุงกระบวนการของทีมงาน"]);
                $ActiveSheet->setCellValue("W" . $line, $row["การพัฒนาบุคลากรตามโครงสร้างที่กำหนด"]);

                $ActiveSheet->setCellValue("X" . $line, $row["การบริหารจัดการผลิตภัณฑ์"]);
                $ActiveSheet->setCellValue("Y" . $line, $row["การบริหารจัดการลูกค้า"]);
                $ActiveSheet->setCellValue("Z" . $line, $row["การบริหารจัดการงานและทีมงาน"]);
                $ActiveSheet->setCellValue("AA" . $line, $row["งานด้านบุคคล"]);
                $ActiveSheet->setCellValue("AB" . $line, $row["งานด้านธุรการ"]);
                $ActiveSheet->setCellValue("AC" . $line, $row["การบริหารจัดการทีมงานตามเป้าหมาย"]);



                $line++;
            }


        }
        //$objPHPExcel->getActiveSheet()->setTitle('Summary Report '.$Y);
        // Save Excel
        if (!file_exists(UPLOAD_PATH . "/export")) {
            mkdir(UPLOAD_PATH . "/export", 0777);
        }
        $file = UPLOAD_PATH . "/export/report_avg_" . $name ."_". date("YmdHis") . ".xlsx";
        //$filename = substr($file, 8);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($file);

        header("Location: " . UPLOAD_URL . "/export/" . basename($file));
       // $this->downloadfile($file);
    }


    public function exporttoxls3Action() {
		$cat = $this->getGeneric();
		$params = $this->getParams();
		//$view = $this->_getView();

//		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
//        $auth = Zend_Auth :: getInstance();
//        $identity = $auth->getIdentity();

        //include('Export2xls.php');
        //$csvObj = new Export2xls();
        //$month = sprintf("%02d",$params["month"]);
        //$name = "summary_".$params["year"];

		$dataArr = $cat->getUserAccept($params);
		//_print($dataArr);exit;
		$params["type"] = "PI";
		$dataSub = $cat->getSumIncentivePI($params["group"],$params["year"],$params["type"],"F",$this->sumIncentive,$this->countAll,$params[head_org],$params["not_user"]);

		$columRecord = array('Org_Code','Code','Name','Position','Level','January','February','March','April','May',
							 'June','July','August','September','October','November','December','Average_Point','Grade');

 	   // $fname = "report_".$name.date("Ymd_His");
 	    //$fname = "report_".$name;
  	    //$csvObj->SetFileName($fname);
  	    //$csvObj->SetHeader();
		$Y = $params["year"];
		if($dataArr){
			foreach($dataArr as $key1 =>$item){
				$lineArr["Org_Code"] = $item[department];
				$lineArr["Code"] = "";
				$lineArr["Name"] = "";
				$lineArr["Position"] = "";
				$lineArr["Level"] = "";
				$lineArr["January"] = "";
				$lineArr["February"] = "";
				$lineArr["March"] = "";
				$lineArr["April"] = "";
				$lineArr["May"] = "";
				$lineArr["June"] = "";
				$lineArr["July"] = "";
				$lineArr["August"] = "";
				$lineArr["September"] = "";
				$lineArr["October"] = "";
				$lineArr["November"] = "";
				$lineArr["December"] = "";
				$lineArr["Average_Point"] = "";
				$lineArr["Grade"] = "";
				$dataRecord[] = $lineArr;
				$lineArr="";
				if($item[user]){
					foreach($item[user] as $key=>$subRow){
						$lineArr["Org_Code"] = "";
						if($subRow["user_code"]=='1001')
							$lineArr["Code"] = "-contact-";
						else
							$lineArr["Code"] = $subRow["user_code"];
						$lineArr["Name"] = $subRow["user_name"]." ".$subRow["user_lname"];
						$lineArr["Position"] = $subRow["org_position_name_th"];
						$lineArr["Level"] = $subRow["org_position_level"];

						$lineArr["January"] = $dataSub["data"][$key1][$key]["01".$Y];
						$lineArr["February"] = $dataSub["data"][$key1][$key]["02".$Y];
						$lineArr["March"] = $dataSub["data"][$key1][$key]["03".$Y];
						$lineArr["April"] = $dataSub["data"][$key1][$key]["04".$Y];
						$lineArr["May"] = $dataSub["data"][$key1][$key]["05".$Y];
						$lineArr["June"] = $dataSub["data"][$key1][$key]["06".$Y];
						$lineArr["July"] = $dataSub["data"][$key1][$key]["07".$Y];
						$lineArr["August"] = $dataSub["data"][$key1][$key]["08".$Y];
						$lineArr["September"] = $dataSub["data"][$key1][$key]["09".$Y];
						$lineArr["October"] = $dataSub["data"][$key1][$key]["10".$Y];
						$lineArr["November"] = $dataSub["data"][$key1][$key]["11".$Y];
						$lineArr["December"] = $dataSub["data"][$key1][$key]["12".$Y];

						if($dataSub["data"][$key1][$key]["num"])$avg_score = $dataSub["data"][$key1][$key]["total"]/$dataSub["data"][$key1][$key]["num"];
						$sum_grade = $cat->getGradeByScoll($avg_score);

						$lineArr["Average_Point"] = $avg_score;
						$lineArr["Grade"] = $sum_grade;
						$dataRecord[] = $lineArr;

					}
				}
			}
			//$colums = array_keys($columRecord);
		}
  	    //$csvObj->WriteFile($dataRecord,$columRecord,"\t","\"");
  	    //exit;

		$this->exportObjXls3($dataRecord,$Y);

    }


    public function exportObjXls3($data,$Y) {
        ob_clean();
        require_once LIBRARY_PATH.'PHPExcel/1.7.0/Classes/PHPExcel.php';
        /** PHPExcel_IOFactory */
        require_once LIBRARY_PATH.'PHPExcel/1.7.0/Classes/PHPExcel/IOFactory.php';
        $objPHPExcel = new PHPExcel();

        //set Properties

        $objPHPExcel->getProperties()->setCreator("PI System 2011 (v 2.2.0)");
        $objPHPExcel->getProperties()->setLastModifiedBy("PI System");
        //$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX PI System Document");
        //$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX PI System Document");
        //$objPHPExcel->getProperties()->setDescription("Generated using PHP classes.");
        //$objPHPExcel->getProperties()->setKeywords("office 2007 php");
        //$objPHPExcel->getProperties()->setCategory("Transfer");

        //Add DefaultStyle
        //$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        //$objPHPExcel->getDefaultStyle()->getFont()->getColor()->setARGB("00000000");

        $ActiveSheet = $objPHPExcel->getActiveSheet();
        //Add Style

        $ActiveSheet->getColumnDimension('A')->setWidth(25);
        $ActiveSheet->getColumnDimension('B')->setWidth(10);
        $ActiveSheet->getColumnDimension('C')->setWidth(25);
        $ActiveSheet->getColumnDimension('D')->setWidth(25);
        $ActiveSheet->getColumnDimension('E')->setWidth(10);
        $ActiveSheet->getColumnDimension('F')->setWidth(10);
        $ActiveSheet->getColumnDimension('G')->setWidth(10);
        $ActiveSheet->getColumnDimension('H')->setWidth(10);
        $ActiveSheet->getColumnDimension('I')->setWidth(10);
        $ActiveSheet->getColumnDimension('J')->setWidth(10);
        $ActiveSheet->getColumnDimension('K')->setWidth(10);
        $ActiveSheet->getColumnDimension('L')->setWidth(10);
        $ActiveSheet->getColumnDimension('M')->setWidth(10);
        $ActiveSheet->getColumnDimension('N')->setWidth(13);
        $ActiveSheet->getColumnDimension('O')->setWidth(13);
        $ActiveSheet->getColumnDimension('P')->setWidth(13);
        $ActiveSheet->getColumnDimension('Q')->setWidth(13);
        $ActiveSheet->getColumnDimension('R')->setWidth(15);
        $ActiveSheet->getColumnDimension('S')->setWidth(10);

        //Add dataTitle
        //$objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getDefaultStyle()->getFont()->getColor()->setARGB("FF000000");
        if (isset($data) && $data) {
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
                'bold' => true
            );

            $ActiveSheet->getStyle("A1:S1")->applyFromArray($styleArray);
            //$ActiveSheet->getStyle("A1:S1")->getFont()->setBold(true);
            $ActiveSheet->getStyle("A1:S1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
            $ActiveSheet->setCellValue("A1", "Org Code");
            $ActiveSheet->setCellValue("B1", "Code");
            $ActiveSheet->setCellValue("C1", "Name");
            $ActiveSheet->setCellValue("D1", "Position");
            $ActiveSheet->setCellValue("E1", "Level");
            $ActiveSheet->setCellValue("F1", "January");
            $ActiveSheet->setCellValue("G1", "February");
            $ActiveSheet->setCellValue("H1", "March");
            $ActiveSheet->setCellValue("I1", "April");
            $ActiveSheet->setCellValue("J1", "May");
            $ActiveSheet->setCellValue("K1", "June");
            $ActiveSheet->setCellValue("L1", "July");
            $ActiveSheet->setCellValue("M1", "August");
            $ActiveSheet->setCellValue("N1", "September");
            $ActiveSheet->setCellValue("O1", "October");
            $ActiveSheet->setCellValue("P1", "November");
            $ActiveSheet->setCellValue("Q1", "December");
            $ActiveSheet->setCellValue("R1", "Average Point");
            $ActiveSheet->setCellValue("S1", "Grade");

            $line = 2;
            foreach ($data as $row) {

                $row["Org_Code"] = iconv("UTF-8", "TIS-620", $row["Org_Code"]);
                $row["Position"] = iconv("UTF-8", "TIS-620", $row["Position"]);
                $row["Name"]     = iconv("UTF-8", "TIS-620", $row["Name"]);

                $ActiveSheet->getStyle("A" . $line . ":S" . $line)->applyFromArray($styleArray);
     			$ActiveSheet->getStyle("A" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $ActiveSheet->setCellValue("A" . $line, $row["Org_Code"]);
                $ActiveSheet->getStyle("B" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                $ActiveSheet->setCellValue("B" . $line, $row["Code"]);
                $ActiveSheet->getStyle("C" . $line . ":D" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $ActiveSheet->setCellValue("C" . $line, $row["Name"]);
                $ActiveSheet->setCellValue("D" . $line, $row["Position"]);
                $ActiveSheet->getStyle("E" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                $ActiveSheet->setCellValue("E" . $line, $row["Level"]);
                $ActiveSheet->getStyle("F" . $line . ":R" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $ActiveSheet->setCellValue("F" . $line, $row["January"]);
                $ActiveSheet->setCellValue("G" . $line, $row["February"]);
                $ActiveSheet->setCellValue("H" . $line, $row["March"]);
                $ActiveSheet->setCellValue("I" . $line, $row["April"]);
                $ActiveSheet->setCellValue("J" . $line, $row["May"]);
                $ActiveSheet->setCellValue("K" . $line, $row["June"]);
                $ActiveSheet->setCellValue("L" . $line, $row["July"]);
                $ActiveSheet->setCellValue("M" . $line, $row["August"]);
                $ActiveSheet->setCellValue("N" . $line, $row["September"]);
                $ActiveSheet->setCellValue("O" . $line, $row["October"]);
                $ActiveSheet->setCellValue("P" . $line, $row["November"]);
                $ActiveSheet->setCellValue("Q" . $line, $row["December"]);

                $ActiveSheet->getStyle("R" . $line)->getNumberFormat()->setFormatCode('#,##0.00');
                $ActiveSheet->setCellValue("R" . $line, $row["Average_Point"]);
                $ActiveSheet->getStyle("S" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
                $ActiveSheet->setCellValue("S" . $line, $row["Grade"]);

                $line++;
            }
        }
        //$objPHPExcel->getActiveSheet()->setTitle('Summary Report '.$Y);
        // Save Excel
        if (!file_exists(UPLOAD_PATH . "/export")) {
            mkdir(UPLOAD_PATH . "/export", 0777);
        }
        $file = UPLOAD_PATH . "/export/report_" . $Y ."_". date("YmdHis") . ".xlsx";
        //$filename = substr($file, 8);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($file);

        header("Location: " . UPLOAD_URL . "/export/" . basename($file));
        //$this->downloadfile($file);
    }

	public function downloadfile($file) {
        // Download Headers

		header("Content-Disposition: attachment; filename=" . urlencode(basename($file)));
        header("Content-Type: application/force-download");
        //header("Content-Type: application/vnd.ms-excel");
        header("Content-Length: " . filesize($file));
        flush(); // this doesn't really matter.

//        $fp = fopen($file, "r");
//        while (!feof($fp)) {
//            echo fread($fp, 65536);
//            flush(); // this is essential for large downloads
//        }
//        fclose($fp);
        echo file_get_contents($file);
        flush(); // this doesn't really matter.
        //unlink($file);
    }

    //////////////////////////////////////export excel end////////////////////////////


    public function printpdfAction(){
		$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
        $month = sprintf("%02d",$params["month"]);
        if($params["type"] =='MI')
        	$month_name = $this->quarterOp[$month]." : ".$params["year"];
        if($params["type"] =='PI')
        	$month_name = $this->monthOp[$month]." : ".$params["year"];
        $name = $params["type"].$month.$params["year"];
        $data["headPage"] = "รายงานสรุปการประเมิน ".$params["type"]." พนักงาน ประจำ ".$month_name;

		$dataArr = $cat->getUserAccept($params);
		$gradeOp = $cat->getGradeData();

		if($params["type"]=='PI')
			$dataSub = $cat->getAcceptIncentivePI($params["group"],$month.$params["year"],$params["type"],"F",$this->sumIncentive,$this->countAll,$params[head_org],$params["not_user"]);
		else
			$dataSub = $cat->getAcceptIncentive($params["group"],$month.$params["year"],$params["type"],"F",$this->sumIncentive,$this->countAll,$params[head_org],$params["not_user"]);

		$data["incArr"] = $this->sumIncentive;

		$data["dataArr"] = $dataArr;
		$data["gradeOp"] = $gradeOp;
		$data["rowsArr"] = $dataSub["data"];
		if($data["incArr"]){
			foreach($data["incArr"] as $item){
				$totalArr["count_user"] = $this->countAll;
				$totalArr["sum_incentive"] += $item["sum_incentive"];
				$totalArr["sum_scoll"] += $item["sum_scoll"];
				$totalArr["average_scoll"] += $item["sum_scoll"]/$this->countAll;
			}
		}
		if($dataSub){
			foreach($dataSub["data"] as $sec_code){
				foreach($sec_code as $line){
					$gradeArr[$line["mph_grade"]] += count($line["mph_id"]);
				}
			}
		}
		$data["date_now"] = date("d-m-Y");
		$data["totalArr"] = $totalArr;
		$data["gradeArr"] = $gradeArr;

        $view->assign('', $data);
		$view->output('summary/_printhtml.tpl');
    }
    public function analysisAction(){
    	$cat = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();
        $month = sprintf("%02d",$params["month"]);
        if($params["type"] =='MI')
        	$month_name = $this->quarterOp[$month]." : ".$params["year"];
        if($params["type"] =='PI')
        	$month_name = $this->monthOp[$month]." : ".$params["year"];
        $name = $params["type"].$month.$params["year"];

//_print($params);
        $data["headPage"] = "วิเคราะห์รายงานสรุปผลการประเมิน ".$params["type"]." พนักงาน ประจำ ".$month_name;
        $view->assign('', $data);
		$view->output('summary/_analysis.tpl');
    }
    
    /*
     * Add Export excel function for input salary system.
     * #natcha
     * 10 Jun 2014
     */
    public function exportSalaryXls($data, $name) {
//     	_print($data);exit;
    	ob_clean();
    	require_once LIBRARY_PATH.'PHPExcel/1.7.0/Classes/PHPExcel.php';
    	/** PHPExcel_IOFactory */
    	require_once LIBRARY_PATH.'PHPExcel/1.7.0/Classes/PHPExcel/IOFactory.php';
    	$objPHPExcel = new PHPExcel();
    
    	//set Properties
    
    	$objPHPExcel->getProperties()->setCreator("PI System 2011 (v 2.2.0)");
    	$objPHPExcel->getProperties()->setLastModifiedBy("PI System");
    	$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX PI System Document");
    	$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX PI System Document");
    	$objPHPExcel->getProperties()->setDescription("Generated using PHP classes.");
    	$objPHPExcel->getProperties()->setKeywords("office 2007 php");
    	$objPHPExcel->getProperties()->setCategory("Transfer");
    
    	//Add DefaultStyle
    	$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
    	$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
    	$objPHPExcel->getDefaultStyle()->getFont()->getColor()->setARGB("00000000");
    
    	$ActiveSheet = $objPHPExcel->getActiveSheet();
    	//Add Style
    
    	$ActiveSheet->getColumnDimension('A')->setWidth(20);
    	$ActiveSheet->getColumnDimension('B')->setWidth(25);
    	$ActiveSheet->getColumnDimension('C')->setWidth(20);
    	$ActiveSheet->getColumnDimension('D')->setWidth(20);
    	$ActiveSheet->getColumnDimension('E')->setWidth(20);
    	$ActiveSheet->getColumnDimension('F')->setWidth(20);
    
    	//Add dataTitle
    	$objPHPExcel->setActiveSheetIndex(0);
    	$objPHPExcel->getDefaultStyle()->getFont()->getColor()->setARGB("FF000000");
    	if (isset($data) && $data) {
    		$styleArray = array(
    				'borders' => array(
    						'allborders' => array(
    								'style' => PHPExcel_Style_Border::BORDER_THIN
    						)
    				)
    		);
    
    		$ActiveSheet->getStyle("A1:F1")->applyFromArray($styleArray);
    		$ActiveSheet->getStyle("A1:F1")->getFont()->setBold(true);
    		$ActiveSheet->getStyle("A1:F1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
    		$ActiveSheet->setCellValue("A1", "รหัสพนักงาน");
    		$ActiveSheet->setCellValue("B1", "รหัสรายได้ - รายหัก");
    		$ActiveSheet->setCellValue("C1", "จำนวน");
    		$ActiveSheet->setCellValue("D1", "รายได้ (บาท)");
    		$ActiveSheet->setCellValue("E1", "รายหัก (บาท)");
    		$ActiveSheet->setCellValue("F1", "รหัสงาน");
    
    
    		$line = 2;
    		foreach ($data as $row) {
				if(!empty($row['Code'])) {    
	    			$ActiveSheet->getStyle("A" . $line . ":F" . $line)->applyFromArray($styleArray);
	    			$ActiveSheet->getStyle("A" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
	    			$ActiveSheet->setCellValue("A" . $line, $row["Code"]);
	    			$ActiveSheet->getStyle("B" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
	    			$ActiveSheet->setCellValue("B" . $line, "IN-010");
	    			$ActiveSheet->getStyle("C" . $line . ":D" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	    			$ActiveSheet->setCellValue("C" . $line, 1);
	    			$ActiveSheet->getStyle("D" . $line)->getNumberFormat()->setFormatCode('#,##0.00');
	    			$ActiveSheet->setCellValue("D" . $line, $row["Incentive"]);
	    			$ActiveSheet->getStyle("E" . $line)->getNumberFormat()->setFormatCode('#,##0.00');
	    			$ActiveSheet->setCellValue("E" . $line, null);
	    			$ActiveSheet->getStyle("F" . $line)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
	    			$ActiveSheet->setCellValue("F" . $line, null);
	    
	    			$line++;
				}
    		}
    
    	}
    	//$objPHPExcel->getActiveSheet()->setTitle('Summary Report '.$Y);
    	// Save Excel
    	if (!file_exists(UPLOAD_PATH . "/export")) {
    		mkdir(UPLOAD_PATH . "/export", 0777);
    	}
    	$file = UPLOAD_PATH . "/export/report_tohrs_" . $name ."_". date("YmdHis") . ".xls";
    	//$filename = substr($file, 8);
    	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    	$objWriter->save($file);
    
    	header("Location: " . UPLOAD_URL . "/export/" . basename($file));
    	//$this->downloadfile($file);
    }
    
    /*
     * Sync incentive or grade on current data master.
     * natcha 
     * Version 1.2 on 11 June 2014
     */
    public function syncEvaWithCurrentData($params) {
    	$cat = $this->getGeneric();
    	// get current grade master.
    	$apiGeneric = System_Controller::getModel('grade','systemapi');
    	$gradeArr 	= $apiGeneric->getGradeMST2('DESC');
    	// get current incentive each grade
    	$incGeneric = System_Controller::getModel('evaluate','systemapi');
    	$incArr 	= $incGeneric->getIncentive();
    	// get all user evaluate on current month, year
    	$dataArr = $cat->getAllEvaByMonth($params);
    	
    	if(!empty($dataArr)) {
    		foreach($dataArr as $empkey => $empval) {
    			$item[$empkey]['mph_id'] 		= $empval['mph_id'];
    			$item[$empkey]['mph_grade']		= "Z";
    	
    			// Mapping grade
    			foreach($gradeArr as $gkey => $gval) {
    				if($empval['mph_totalscoll'] >= $gval['start_scoll'] && $empval['mph_totalscoll'] <= $gval['end_scoll']) {
    					$item[$empkey]['mph_grade']	= $gval['grade'];
    				}
    			}
    			// Mapping incentive
    			$item[$empkey]['mph_incentive'] = $incArr[$item[$empkey]['mph_grade']][$empval['mph_level_now']];
    	
    		}
    		// Send to update eva_mipi_head table.
    		$cat->updateSyncEvaluation($item);
    	}
    	return true;
    }
}