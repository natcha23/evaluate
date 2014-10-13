<?php
if(!class_exists('Workflow_Controller_Flow_Action')) Zend_Loader :: loadClass('Workflow_Controller_Flow_Action');
include PROJECT_LIBRARY_PATH.'Workflow/graph/jpgraph.php';
include PROJECT_LIBRARY_PATH.'Workflow/graph/jpgraph_line.php';
include PROJECT_LIBRARY_PATH.'Workflow/graph/jpgraph_bar.php';
include PROJECT_LIBRARY_PATH.'Workflow/graph/jpgraph_pie.php';

class Workflow_ReportController extends Workflow_Controller_Flow_Action {
	protected $monthOp = array('01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน',
							   '07'=>'กรกฎาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
	protected $monthShotOp = array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.',
							   	   'ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
	protected $gradeOp = array("A","B","C","F");
	//protected $org_arr = "931,932,940,941,942";
	//protected $org_arr = "400,411,413,421,422,431,432,441,442";
	protected $org_arr = "001,110,111,210,211,310,311,320,321,500,510,511,520,521,530,531,540,541";

	
	public function displayAction(){
		$Generic = $this->getGeneric();
		$params = $this->getParams();
		$view = $this->_getView();
		if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
		$auth = Zend_Auth :: getInstance();
		$identity = $auth->getIdentity();
	
		if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			if($identity->level == '11'){
				$org = $Generic->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params["head_org"] = $org;
			}else{
				$org = $Generic->GetOrgByCode($identity->user_code);
				$params["head_org"] = $org;
			}
		}
	
		if($params["search"]["month"])unset($params["month"]);
		if($params["search"]["month0"])unset($params["month0"]);
	
		if($params["month"]){
			$params["search"]["month"] = substr($params["month"],0,2);
			$params["search"]["year"] = substr($params["month"],-4);
		}
		if($params["month0"]){
			$params["search"]["month0"] = substr($params["month0"],0,2);
			$params["search"]["year0"] = substr($params["month0"],-4);
		}
	
		$yearPrev = date('Y')-1;
		$yearNow = date('Y');
		$yearNext = date('Y')+1;
		$data["yearOp"] = array($yearPrev=>$yearPrev,$yearNow=>$yearNow,$yearNext=>$yearNext);
		if($params["search"]["month"]){
			$data["month"] = $params["search"]["month"];
			$data["year"] = $params["search"]["year"];
			$m = $data["month"];
			$year = $data["year"];
		}else{
			$data["month"] = sprintf("%02d",date('m')-1);
			$data["year"] = $yearNow;
			$m = sprintf("%02d",date('m')-1);
			$year = $yearNow;
		}
	
		if($params["search"]["month0"]){
			$data["month0"] = $params["search"]["month0"];
			$data["year0"] = $params["search"]["year0"];
			$m0 = $data["month0"];
			$year0 = $data["year0"];
		}else{
			if($m == '1'){
				$m0 = '12';
				$year0 = $year-1;
			}else{
				$m0 = sprintf("%02d",$m-1);
				$year0 = $year;
			}
			$data["month0"] = $m0;
			$data["year0"] = $year0;
		}
		
		$mNow = $m.$year;
		$mPre = $m0.$year0;
		// Make compare array.
		$compareArr = array($mNow, $mPre);	
			
		// Generate data for render bar chart.
		$apiGeneric = System_Controller::getModel('grade','systemapi');
		$gradeOpt 	= array();
		$gradeOpt 	= $apiGeneric->getGradeMST2('DESC');
		$numGrade 	= count($gradeOpt);
		$datazero	= array(0,0,0,0,0,0,0,0,0,0,0,0);
			
		// Compare 2 months.
		foreach($compareArr as $num => $item) {
			$temp		= $Generic->GetSummaryGrade2014($item, $params["head_org"]);
			$datay[] 	= ($temp) ? $temp : $datazero;
		}
		foreach($gradeOpt as $key => $grade) {
			$gradeStr[]	= $grade['grade'];
			
			foreach($compareArr as $num => $item) {
				$alt[$key]	= number_format($datay[$num], 0);
				// script open detail graph.
 				#$targ[$key]	= "javascript:openDetail('$item','$key','0','')"; 
			}
			
		}
		
		$graph = new Graph(800,450,"auto");
		$graph->img->SetMargin(45,20,30,45);
		$graph->title->Set("กราฟเทียบระหว่าง ".$this->monthOp[$m0]." ปี ".$year0." กับใบประเมิน ".$this->monthOp[$m]." ปี ".$year);
		$graph->title->SetFont(FF_GARUDA,FS_BOLD);
		$graph->SetFrame(false);
		
		$graph->SetScale("textlin", 0, 60, 0, $numGrade);
		$graph->SetY2Scale("lin", 0, 60);
		
		$graph->ygrid->SetFill(true,'#BFDFFF@0.5','#FFFFFF@0.5');
		$graph->ygrid->SetLineStyle('dashed');
		$graph->ygrid->SetColor('gray');
		$graph->xgrid->Show();
		$graph->xgrid->SetLineStyle('dashed');
		$graph->xgrid->SetColor('gray');
		
		// Setup axis titles
		$datax = $gradeStr;
		$graph->xaxis->SetTickLabels($datax);
		$graph->xaxis->scale->ticks->Set(1);
		$graph->xaxis->title->SetFont(FF_COURIER,FS_NORMAL, 10);
		$graph->xaxis->title->Set("       "."ระดับเกรด");
		
		$graph->yaxis->scale->ticks->Set(10);
		$graph->yaxis->title->SetFont(FF_COURIER,FS_NORMAL, 10);
		$graph->yaxis->title->Set("จำนวนพนักงาน (คน)");
		$graph->y2axis->SetColor('darkred');
		
		$graph->legend->SetFont(FF_COURIER,FS_NORMAL,10);
		$graph->legend->Pos(0,0,'right','top');
		
		$colors = array('#FCCCB0', '#AEAECD');
		
		foreach($compareArr as $key => $item) {
			$barPlot[$key]	= new BarPlot($datay[$key]);
			$barPlot[$key]->SetLegend("ประเมิน ".$item);
			$barPlot[$key]->SetFillColor($colors[$key]);
			$barPlot[$key]->value->SetFormat( "%.0d");
			$barPlot[$key]->SetCSIMTargets($targ[$key],$alt[$key]);
			$barPlot[$key]->value->Show();
		}
		
		$ybplot = new GroupBarPlot($barPlot);
	
		$graph->Add($ybplot);
	
		if (file_exists(UPLOAD_PATH."/index.png")) {
			$imagePath = UPLOAD_PATH."/index.png";
			$imageUrl = UPLOAD_URL."/index.png";
		} else {
			$imagePath = UPLOAD_PATH."/index.png";
			$imageUrl = UPLOAD_URL."/index.png";
		}
		$graph->Stroke($imagePath);
	
		$data["graphmap"] = $graph->GetHTMLImageMap("myimagemap");
		$data["graph"] = "<img src=\"".$imageUrl."\" ISMAP USEMAP=\"#myimagemap\"  border=0>";
		$data["headPage"] = "กราฟแสดงระดับเกรดที่ได้รับ เทียบกับใบประเมินก่อนหน้า";
		$data["monthOp"] = $this->monthOp;
	
		$view->assign('', $data);
		$view->output('report/graph_grade.tpl');
	}
    public function _displayAction(){
    	$Generic = $this->getGeneric();
		$params = $this->getParams();
    	$view = $this->_getView();
    	if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

    	if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			if($identity->level == '11'){
				$org = $Generic->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params["head_org"] = $org;
			}else{
				$org = $Generic->GetOrgByCode($identity->user_code);
				$params["head_org"] = $org;
			}
		}

    	if($params["search"]["month"])unset($params["month"]);
    	if($params["search"]["month0"])unset($params["month0"]);

    	if($params["month"]){
    		$params["search"]["month"] = substr($params["month"],0,2);
    		$params["search"]["year"] = substr($params["month"],-4);
    	}
    	if($params["month0"]){
    		$params["search"]["month0"] = substr($params["month0"],0,2);
    		$params["search"]["year0"] = substr($params["month0"],-4);
    	}

        $yearPrev = date('Y')-1;
        $yearNow = date('Y');
        $yearNext = date('Y')+1;
        $data["yearOp"] = array($yearPrev=>$yearPrev,$yearNow=>$yearNow,$yearNext=>$yearNext);
        if($params["search"]["month"]){
        	$data["month"] = $params["search"]["month"];
        	$data["year"] = $params["search"]["year"];
        	$m = $data["month"];
        	$year = $data["year"];
        }else{
        	$data["month"] = sprintf("%02d",date('m')-1);
			$data["year"] = $yearNow;
			$m = sprintf("%02d",date('m')-1);
			$year = $yearNow;
        }

        if($params["search"]["month0"]){
        	$data["month0"] = $params["search"]["month0"];
        	$data["year0"] = $params["search"]["year0"];
        	$m0 = $data["month0"];
        	$year0 = $data["year0"];
        }else{
        	if($m == '1'){
				$m0 = '12';
				$year0 = $year-1;
			}else{
				$m0 = sprintf("%02d",$m-1);
				$year0 = $year;
			}
			$data["month0"] = $m0;
        	$data["year0"] = $year0;
        }

		$mNow = $m.$year;
		$mPre = $m0.$year0;
		$datay1 = $Generic->GetSummaryGrade($mNow,$params["head_org"]);
		$datay2 = $Generic->GetSummaryGrade($mPre,$params["head_org"]);

		$datazero=array(0,0,0,0,0,0,0,0,0,0,0,0);
		$datay1=($datay1)? $datay1:$datazero;
        $datay2=($datay2)? $datay2:$datazero;

        for ($loops=0;$loops<4;$loops++) {
           $showMonth=$loops+1;
           $targ[$loops]="javascript:openDetail('$mNow','$loops','','$mPre')";
           $alt[$loops]=number_format($datay1[$loops],0);
           $targ1[$loops]="javascript:openDetail('$mPre','$loops','1','$mNow')";
           $alt1[$loops]=number_format($datay2[$loops],0);
        }

		$graph = new Graph(800,450,"auto");
		$graph->img->SetMargin(45,20,30,45);
		$graph->title->Set("กราฟเทียบระหว่าง ".$this->monthOp[$m0]." ปี ".$year0." กับใบประเมิน ".$this->monthOp[$m]." ปี ".$year);
		$graph->title->SetFont(FF_GARUDA,FS_BOLD);
		$graph->SetFrame(false);

		$graph->SetScale("textlin",0,60,0,4);
        $graph->SetY2Scale("lin",0,60);

		$graph->ygrid->SetFill(true,'#BFDFFF@0.5','#FFFFFF@0.5');
		$graph->ygrid->SetLineStyle('dashed');
		$graph->ygrid->SetColor('gray');
		$graph->xgrid->Show();
		$graph->xgrid->SetLineStyle('dashed');
		$graph->xgrid->SetColor('gray');

		// Setup axis titles
		$datax = $this->gradeOp;
		$graph->xaxis->SetTickLabels($datax);
		$graph->xaxis->scale->ticks->Set(1);
		$graph->xaxis->title->SetFont(FF_COURIER,FS_NORMAL, 10);
		$graph->xaxis->title->Set("       "."ระดับเกรด");

        $graph->yaxis->scale->ticks->Set(10);
		$graph->yaxis->title->SetFont(FF_COURIER,FS_NORMAL, 10);
		$graph->yaxis->title->Set("จำนวนพนักงาน (คน)");
        $graph->y2axis->SetColor('darkred');

        $graph->legend->SetFont(FF_COURIER,FS_NORMAL,10);
        $graph->legend->Pos(0,0,'right','top');

        $bplotzero = new BarPlot($datazero);
		$barPlot1=new BarPlot($datay2); ;
		//$barPlot1->SetLegend(Lang::getLanguageString('lblfulfillyear')." : $yearBefore");
		$barPlot1->SetLegend("ประเมิน ".$mPre);
		$barPlot1->SetFillColor('#FCCCB0');
        $barPlot1->value->SetFormat( "%.0d");
        $barPlot1->SetCSIMTargets($targ1,$alt1);
        $barPlot1->value->Show();
        $y2bplot = new GroupBarPlot(array($barPlot1,$bplotzero));

		$barPlot=new BarPlot($datay1);
		//$barPlot->SetLegend(Lang::getLanguageString('lblfulfillyear')." : $yearNow	");
		$barPlot->SetLegend("ประเมิน ".$mNow);
		$barPlot->SetFillColor('#AEAECD');
        $barPlot->value->SetFormat( "%.0d");
        $barPlot->SetCSIMTargets($targ,$alt);
        $barPlot->value->Show();
        $ybplot = new GroupBarPlot(array($bplotzero,$barPlot));

        $graph->Add($ybplot);
        $graph->AddY2($y2bplot);

        if (file_exists(UPLOAD_PATH."/index.png")) {
		  $imagePath = UPLOAD_PATH."/index.png";
		  $imageUrl = UPLOAD_URL."/index.png";
		} else {
		  $imagePath = UPLOAD_PATH."/index.png";
		  $imageUrl = UPLOAD_URL."/index.png";
		}
		$graph->Stroke($imagePath);

		$data["graphmap"] = $graph->GetHTMLImageMap("myimagemap");
        $data["graph"] = "<img src=\"".$imageUrl."\" ISMAP USEMAP=\"#myimagemap\"  border=0>";
		$data["headPage"] = "กราฟแสดงระดับเกรดที่ได้รับ เทียบกับใบประเมินก่อนหน้า";
		$data["monthOp"] = $this->monthOp;

		$view->assign('', $data);
		$view->output('report/graph_grade.tpl');
    }
   
    public function detailAction(){
		$Generic = $this->getGeneric();
		$params = $this->getParams();
    	$view = $this->_getView();
    	if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

    	if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			if($identity->level == '11'){
				$org = $Generic->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params["head_org"] = $org;
			}else{
				$org = $Generic->GetOrgByCode($identity->user_code);
				$params["head_org"] = $org;
			}
		}
    	$rows = $Generic->GetDetailGrade($params,$params["head_org"],&$this->userArr);
    	if(count($rows)=='1'){
    		$rows_arr[0] = 0;
    		$rows_arr[1] = $rows[0];
    		$userArr[0] = "";
    		$userArr[1] = $this->userArr[0];
    		$targ[1] = "javascript:alert('".$userArr." :: ".$rows_arr[1]."')";
    	}else{
	        $rows_arr = $rows;
	        $userArr = $this->userArr;
	        foreach($rows_arr as $key=>$item){
	        	$targ[$key] = "javascript:alert('".$userArr[$key]." :: ".$item."')";
	        }
    	}
    	$graph = new Graph(1000,500,"auto");
        $graph->SetScale("textlin");
        $graph->img->SetMargin(40,20,30,90);
        $graph->title->Set("Data Information");
        $graph->title->SetFont(FF_GARUDA,FS_BOLD);
        $graph->SetFrame(false); //สีพื้นหลังกราฟ

        $graph->xaxis->SetFont(FF_COURIER,FS_NORMAL,8);
		$graph->xaxis->SetTickLabels($userArr);
		$graph->xaxis->SetLabelAngle(50);

        $graph->ygrid->SetFill(true,'#BFDFFF@0.5','#FFFFFF@0.5');
        $graph->ygrid->SetLineStyle('dashed');
        $graph->ygrid->SetColor('gray');
        $graph->xgrid->Show();
        $graph->xgrid->SetLineStyle('dashed');
        $graph->xgrid->SetColor('gray');

        $graph->legend->SetFont(FF_COURIER,FS_NORMAL,10);
        $graph->legend->Pos(0,0,'right','top');

    	$lplot = new LinePlot($rows_arr);
        $lplot->SetFillColor('#BFDFFF@0.5'); //purple - skyblue
        $lplot->SetColor('navy@0.7');
        $lplot->value->SetFormat( "%.2f");
        $lplot->value->Show();
        $graph->Add($lplot);

        // Setup axis titles
        $graph->yaxis->title->Set("User");
        $graph->yaxis->title->Set("Score");

        // Create the linear plot
        $lineplot=new LinePlot($rows_arr);
        $lineplot->mark->SetType(MARK_FILLEDCIRCLE);
        $lineplot->mark->SetWidth(5);
        $lineplot->mark->SetColor('black');
        $lineplot->mark->SetFillColor('#FF8206');
        $lineplot->SetLegend('Score');
        $lineplot->SetColor("blue");
        $lineplot->SetCSIMTargets($targ,$rows_arr);
        $graph->Add($lineplot);
        //$graph->Stroke('auto');
        if (file_exists(UPLOAD_PATH."/index.png")) {
		  $imagePath = UPLOAD_PATH."/index.png";
		  $imageUrl = UPLOAD_URL."/index.png";
		} else {
		  $imagePath = UPLOAD_PATH."/index.png";
		  $imageUrl = UPLOAD_URL."/index.png";
		}
		$graph->Stroke($imagePath);

		$data["graphmap"] = $graph->GetHTMLImageMap("myimagemap");
        $data["graph"] = "<img src=\"".$imageUrl."\" ISMAP USEMAP=\"#myimagemap\"  border=0>";
		$data["headPage"] = "กราฟแสดง พนักงานที่ได้ระดับเกรด ".$this->gradeOp[$params["grade"]]." ใบประเมิน ".$params["month"];
		if($params["t"]=='1'){
    		$data["month"] = $params["m1"];
    		$data["month0"] = $params["month"];
		}else{
			$data["month"] = $params["month"];
			$data["month0"] = $params["m1"];
		}

    	$view->assign('', $data);
		$view->output('report/grade_detail.tpl');
    }
    public function departmentAction(){
    	$Generic = $this->getGeneric();
		$params = $this->getParams();
    	$view = $this->_getView();
    	if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

    	if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			if($identity->level == '11'){
				$org = $Generic->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params["head_org"] = $org;
			}else{
				$org = $Generic->GetOrgByCode($identity->user_code);
				$params["head_org"] = $org;
			}
		}

    	$yearPrev = date('Y')-1;
        $yearNow = date('Y');
        $yearNext = date('Y')+1;
        $data["yearOp"] = array($yearPrev=>$yearPrev,$yearNow=>$yearNow,$yearNext=>$yearNext);
        $data["monthOp"] = $this->monthOp;
        if($params["head_org"])
        	$data["groupBUOp"] = $Generic->getGroupByHeader($params["head_org"]);
        else
        	$data["groupBUOp"] = $Generic->getGroupBUList();

        if($params["search"]){
        	$rows = $Generic->GetDetailDepart($params["search"],$params["head_org"],&$this->userArr);
			if($rows){
	        	if(count($rows)=='1'){
		    		$rows_arr[0] = 0;
		    		$rows_arr[1] = $rows[0];
		    		$userArr[0] = "";
		    		$userArr[1] = $this->userArr[0];
		    		$targ[1] = "javascript:alert('".$userArr." :: ".$rows_arr[1]."')";
		    	}else{
			        $rows_arr = $rows;
			        $userArr = $this->userArr;
			        foreach($rows_arr as $key=>$item){
			        	$targ[$key] = "javascript:alert('".$userArr[$key]." :: ".$item."')";
			        }
		    	}
	        	$graph = new Graph(1000,500,"auto");
		        $graph->SetScale("textlin");
		        $graph->img->SetMargin(40,20,30,90);
				$graph->img->SetAntiAliasing();
		        $graph->title->Set("Data Information");
		        $graph->title->SetFont(FF_GARUDA,FS_BOLD);
		        $graph->SetShadow();
		        $graph->SetFrame(false); //สีพื้นหลังกราฟ

				$graph->xaxis->SetFont(FF_COURIER,FS_NORMAL,8);
				$graph->xaxis->SetTickLabels($userArr);
				$graph->xaxis->SetLabelAngle(50);

		        $graph->ygrid->SetFill(true,'#BFDFFF@0.5','#FFFFFF@0.5');
		        $graph->ygrid->SetLineStyle('dashed');
		        $graph->ygrid->SetColor('gray');
		        $graph->xgrid->Show();
		        $graph->xgrid->SetLineStyle('dashed');
		        $graph->xgrid->SetColor('gray');


		        $graph->legend->SetFont(FF_COURIER,FS_NORMAL,10);
		        $graph->legend->Pos(0,0,'right','top');

		    	$lplot = new LinePlot($rows_arr);
		        $lplot->SetFillColor('#BFDFFF@0.5'); //purple - skyblue
		        $lplot->SetColor('navy@0.7');
		        $lplot->value->SetFormat( "%.2f");
		        $lplot->value->Show();
		        $graph->Add($lplot);

		        // Setup axis titles
		        $graph->yaxis->title->Set("User");
		        $graph->yaxis->title->Set("Score");

		        // Create the linear plot
		        $lineplot=new LinePlot($rows_arr);
		        $lineplot->mark->SetType(MARK_FILLEDCIRCLE);
		        $lineplot->mark->SetWidth(5);
		        $lineplot->mark->SetColor('black');
		        $lineplot->mark->SetFillColor('#FF8206');

		        $lineplot->SetLegend('Score');
		        $lineplot->SetCSIMTargets($targ,$rows_arr);
		        $lineplot->SetColor("blue");
				//$lineplot->SetCenter();
		        $graph->Add($lineplot);

		    	if (file_exists(UPLOAD_PATH."/index.png")) {
				  $imagePath = UPLOAD_PATH."/index.png";
				  $imageUrl = UPLOAD_URL."/index.png";
				} else {
				  $imagePath = UPLOAD_PATH."/index.png";
				  $imageUrl = UPLOAD_URL."/index.png";
				}
				$graph->Stroke($imagePath);
				$data["graphmap"] = $graph->GetHTMLImageMap("myimagemap");
		        $data["graph"] = "<img src=\"".$imageUrl."\" ISMAP USEMAP=\"#myimagemap\"  border=0>";
			}
        }
		$data["month"] = $params["search"]["month"];
		$data["year"] = $params["search"]["year"];
		$data["group"] = $params["search"]["group"];
		$data["headPage"] = "กราฟแสดง ระดับคะแนนของพนักงานในแผนก";
    	$view->assign('', $data);
		$view->output('report/graph_department.tpl');
    }
    public function empinyearAction(){
    	$Generic = $this->getGeneric();
		$params = $this->getParams();
    	$view = $this->_getView();
    	if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

    	if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			if($identity->level == '11'){
				$org = $Generic->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params["head_org"] = $org;
			}else{
				$org = $Generic->GetOrgByCode($identity->user_code);
				$params["head_org"] = $org;
			}
		}
    	$yearPrev = date('Y')-1;
        $yearNow = date('Y');
        $yearNext = date('Y')+1;
        $data["yearOp"] = array($yearPrev=>$yearPrev,$yearNow=>$yearNow,$yearNext=>$yearNext);
        $data["monthOp"] = $this->monthOp;
        if($params["year"]) $params["search"]["year"] = $params["year"];
        if($params["group"]) $params["search"]["group"] = $params["group"];

        if($params["search"]["year"])$data["year"] = $params["search"]["year"]; else $data["year"] = $yearNow;
        if($params["head_org"])
        	$data["groupBUOp"] = $Generic->getGroupByHeader($params["head_org"]);
        else
        	$data["groupBUOp"] = $Generic->getGroupBUList();
        $data["dataArr"] = $Generic->getEmpDataList($params["search"],$data["year"],$params["head_org"]);
        $data["rowsArr"] = $Generic->getDataGradeByType('PI',$data["year"],$params["head_org"]);

    	$data["headPage"] = "แสดงคะแนนการประเมินของพนักงานประจำปี";


		$data["group"] = $params["search"]["group"];
    	$view->assign('', $data);
		$view->output('report/sum_empinyear.tpl');
    }
    public function graphinyearAction(){
    	$Generic = $this->getGeneric();
		$params = $this->getParams();
    	$view = $this->_getView();
    	if($params["emp"]){
        	$rows = $Generic->GetDetailByEmp($params);
        	$employee = $Generic->GetEmployee($params);
        	$data["group"] = $employee["user_sec_depart"];
        	$data["employee"] = $employee["user_code"]."::".$employee["user_name"]." ".$employee["user_lname"]." (".$employee["org_position_name_th"].")";
			if($rows){
				if(count($rows)=='1'){
		    		$rows_arr[0] = 0;
		    		$rows_arr[1] = $rows[0];
		    		$userArr[0] = "";
		    		$userArr[1] = $this->monthShotOp[0];
		    		//$targ[1] = "javascript:alert('".$userArr." :: ".$rows_arr[1]."')";
		    	}else{
			        $rows_arr = $rows;
			        $userArr = $this->monthShotOp;
			        /*foreach($rows_arr as $key=>$item){
			        	$targ[$key] = "javascript:alert('".$userArr[$key]." :: ".$item."')";
			        }*/
		    	}

	        	$graph = new Graph(1000,500,"auto");
		        $graph->SetScale("textlin");
		        $graph->img->SetMargin(40,20,30,90);
				$graph->img->SetAntiAliasing();
		        $graph->title->Set("Data Information");
		        $graph->title->SetFont(FF_GARUDA,FS_BOLD);
		        $graph->SetShadow();
		        $graph->SetFrame(false); //สีพื้นหลังกราฟ

				$graph->xaxis->SetFont(FF_COURIER,FS_NORMAL,8);
				$graph->xaxis->SetTickLabels($userArr);
				$graph->xaxis->SetLabelAngle(50);

		        $graph->ygrid->SetFill(true,'#BFDFFF@0.5','#FFFFFF@0.5');
		        $graph->ygrid->SetLineStyle('dashed');
		        $graph->ygrid->SetColor('gray');
		        $graph->xgrid->Show();
		        $graph->xgrid->SetLineStyle('dashed');
		        $graph->xgrid->SetColor('gray');


		        $graph->legend->SetFont(FF_COURIER,FS_NORMAL,10);
		        $graph->legend->Pos(0,0,'right','top');

		    	$lplot = new LinePlot($rows_arr);
		        $lplot->SetFillColor('#BFDFFF@0.5'); //purple - skyblue
		        $lplot->SetColor('navy@0.7');
		        $lplot->value->SetFormat( "%.2f");
		        $lplot->value->Show();
		        $graph->Add($lplot);

		        // Setup axis titles
		        $graph->yaxis->title->Set("User");
		        $graph->yaxis->title->Set("Score");

		        // Create the linear plot
		        $lineplot=new LinePlot($rows_arr);
		        $lineplot->mark->SetType(MARK_FILLEDCIRCLE);
		        $lineplot->mark->SetWidth(5);
		        $lineplot->mark->SetColor('black');
		        $lineplot->mark->SetFillColor('#FF8206');

		        $lineplot->SetLegend('Score');
		        //$lineplot->SetCSIMTargets($targ,$rows);
		        $lineplot->SetColor("blue");
		        $graph->Add($lineplot);

		    	if (file_exists(UPLOAD_PATH."/index.png")) {
				  $imagePath = UPLOAD_PATH."/index.png";
				  $imageUrl = UPLOAD_URL."/index.png";
				} else {
				  $imagePath = UPLOAD_PATH."/index.png";
				  $imageUrl = UPLOAD_URL."/index.png";
				}
				$graph->Stroke($imagePath);
				$data["graphmap"] = $graph->GetHTMLImageMap("myimagemap");
		        $data["graph"] = "<img src=\"".$imageUrl."\" ISMAP USEMAP=\"#myimagemap\"  border=0>";
			}
        }

    	$data["headPage"] = "กราฟแสดง คะแนนการประเมินของพนักงานประจำปี";
    	$data["year"] = $params["year"];
    	$view->assign('', $data);
		$view->output('report/grade_detail.tpl');
    }
    public function positionAction(){
    	$Generic = $this->getGeneric();
		$params = $this->getParams();
    	$view = $this->_getView();
    	if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

    	if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			if($identity->level == '11'){
				$org = $Generic->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params["head_org"] = $org;
			}else{
				$org = $Generic->GetOrgByCode($identity->user_code);
				$params["head_org"] = $org;
			}
		}
    	$yearPrev = date('Y')-1;
        $yearNow = date('Y');
        $yearNext = date('Y')+1;
        $data["yearOp"] = array($yearPrev=>$yearPrev,$yearNow=>$yearNow,$yearNext=>$yearNext);
        $data["monthOp"] = $this->monthOp;
        if($params["head_org"])
        	$data["groupBUOp"] = $Generic->getPosition($params["head_org"]);
        else
        	$data["groupBUOp"] = $Generic->getPosition('');

        if($params["search"]){
        	$rows = $Generic->GetDetailPosition($params["search"],$params["head_org"],&$this->userArr);
			if($rows){
	        	if(count($rows)=='1'){
		    		$rows_arr[0] = 0;
		    		$rows_arr[1] = $rows[0];
		    		$userArr[0] = "";
		    		$userArr[1] = $this->userArr[0];
		    		$targ[1] = "javascript:alert('".$userArr." :: ".$rows_arr[1]."')";
		    	}else{
			        $rows_arr = $rows;
			        $userArr = $this->userArr;
			        foreach($rows_arr as $key=>$item){
			        	$targ[$key] = "javascript:alert('".$userArr[$key]." :: ".$item."')";
			        }
		    	}
	        	$graph = new Graph(1000,500,"auto");
		        $graph->SetScale("textlin");
		        $graph->img->SetMargin(40,20,30,90);
				$graph->img->SetAntiAliasing();
		        $graph->title->Set("Data Information");
		        $graph->title->SetFont(FF_GARUDA,FS_BOLD);
		        $graph->SetShadow();
		        $graph->SetFrame(false); //สีพื้นหลังกราฟ

				$graph->xaxis->SetFont(FF_COURIER,FS_NORMAL,8);
				$graph->xaxis->SetTickLabels($userArr);
				$graph->xaxis->SetLabelAngle(50);

		        $graph->ygrid->SetFill(true,'#BFDFFF@0.5','#FFFFFF@0.5');
		        $graph->ygrid->SetLineStyle('dashed');
		        $graph->ygrid->SetColor('gray');
		        $graph->xgrid->Show();
		        $graph->xgrid->SetLineStyle('dashed');
		        $graph->xgrid->SetColor('gray');


		        $graph->legend->SetFont(FF_COURIER,FS_NORMAL,10);
		        $graph->legend->Pos(0,0,'right','top');

		    	$lplot = new LinePlot($rows_arr);
		        $lplot->SetFillColor('#BFDFFF@0.5'); //purple - skyblue
		        $lplot->SetColor('navy@0.7');
		        $lplot->value->SetFormat( "%.2f");
		        $lplot->value->Show();
		        $graph->Add($lplot);

		        // Setup axis titles
		        $graph->yaxis->title->Set("User");
		        $graph->yaxis->title->Set("Score");

		        // Create the linear plot
		        $lineplot=new LinePlot($rows_arr);
		        $lineplot->mark->SetType(MARK_FILLEDCIRCLE);
		        $lineplot->mark->SetWidth(5);
		        $lineplot->mark->SetColor('black');
		        $lineplot->mark->SetFillColor('#FF8206');

		        $lineplot->SetLegend('Score');
		        $lineplot->SetCSIMTargets($targ,$rows_arr);
		        $lineplot->SetColor("blue");
				//$lineplot->SetCenter();
		        $graph->Add($lineplot);

		    	if (file_exists(UPLOAD_PATH."/index.png")) {
				  $imagePath = UPLOAD_PATH."/index.png";
				  $imageUrl = UPLOAD_URL."/index.png";
				} else {
				  $imagePath = UPLOAD_PATH."/index.png";
				  $imageUrl = UPLOAD_URL."/index.png";
				}
				$graph->Stroke($imagePath);
				$data["graphmap"] = $graph->GetHTMLImageMap("myimagemap");
		        $data["graph"] = "<img src=\"".$imageUrl."\" ISMAP USEMAP=\"#myimagemap\"  border=0>";
			}
        }
		$data["month"] = $params["search"]["month"];
		$data["year"] = $params["search"]["year"];
		$data["group"] = $params["search"]["group"];
		$data["headPage"] = "กราฟแสดง ระดับคะแนนของพนักงานในแต่ละตำแหน่งงาน";
    	$view->assign('', $data);
		$view->output('report/graph_position.tpl');
    }
    
    public function cpginyearAction(){
    	$Generic = $this->getGeneric();
    	$params = $this->getParams();
    	$view = $this->_getView();
    	if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
    	$auth = Zend_Auth :: getInstance();
    	$identity = $auth->getIdentity();
    
    	if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
    		if($identity->level == '11'){
    			$org = $Generic->GetOrgByCode($identity->user_code);
    			$org .= ($org)?",".$this->org_arr:$org;
    			$params["head_org"] = $org;
    		}else{
    			$org = $Generic->GetOrgByCode($identity->user_code);
    			$params["head_org"] = $org;
    		}
    	}
    
    	$yearPrev = date('Y')-2;
    	$yearNow = date('Y')-1;
    	$yearNext = date('Y');
    	#$data["yearOp"] = array($yearPrev=>$yearPrev,$yearNow=>$yearNow,$yearNext=>$yearNext);
    	$data["yearOp"] = $Generic->getYearOptions();
    	
    	if($params["search"]["year"])$data["year"] = $params["search"]["year"]; else $data["year"] = $yearNext;

    
    	$graph = new Graph(1000,500,"auto");
    	$graph->img->SetMargin(40,80,30,40);
    	$graph->title->Set("กราฟเปรียบเทียบจำนวนพนักงานตามระดับเกรด ในแต่ละเดือนของปี ".$data["year"]);
    	$graph->title->SetFont(FF_GARUDA,FS_BOLD);
    	$graph->title->SetColor('black');
    	$graph->SetFrame(false);
    	$graph->SetScale("textlin",0,50);
    
    	$graph->ygrid->SetFill(true,'#BFDFFF@0.5','#FFFFFF@0.5');
    	$graph->ygrid->SetLineStyle('dashed');
    	$graph->ygrid->SetColor('gray');
    	$graph->xgrid->Show();
    	$graph->xgrid->SetLineStyle('dashed');
    	$graph->xgrid->SetColor('gray');
    
    	// Adjust the position of the legend box
    	$graph->legend->SetFont(FF_COURIER,FS_NORMAL,10);
    	$graph->legend->Pos(0,0,'right','top');
    
    	// Get localised version of the month names
    	$graph->xaxis->SetTickLabels($this->monthShotOp);
    	$graph->xaxis->SetLabelAngle(50);
    
    	// Set axis titles and fonts
    	$graph->xaxis->title->Set('เดือนในปี '.$data["year"]);
    	$graph->xaxis->title->SetFont(FF_GARUDA,FS_NORMAL,10);
    	$graph->xaxis->title->SetColor('black');
    	$graph->xaxis->SetFont(FF_GARUDA,FS_NORMAL,10);
    	$graph->xaxis->SetColor('black');
    
    	$graph->yaxis->title->Set('จำนวนพนักงาน (คน)');
    	$graph->yaxis->title->SetFont(FF_GARUDA,FS_NORMAL,10);
    	$graph->yaxis->title->SetColor('black');
    	$graph->yaxis->SetFont(FF_GARUDA,FS_NORMAL,10);
    	$graph->yaxis->SetColor('black');
    
    	//$graph->ygrid->Show(false);
    	$graph->ygrid->SetColor('black@0.5');
    
    	// Some extra margin (from the top)
    	$graph->title->SetMargin(3);
    	//$graph->title->SetFont(FF_COURIER,FS_NORMAL,10);
    	
    	// Generate data for render bar chart.
    	$apiGeneric = System_Controller::getModel('grade','systemapi');
    	$gradeOpt 	= array();
    	$gradeOpt 	= $apiGeneric->getGradeMST2('DESC');
    	$numData 	= count($gradeOpt);
    	$datazero	= array(0,0,0,0,0,0,0,0,0,0,0,0);
    	
    	foreach($gradeOpt as $key => $grade) {
    		$items 		= $Generic->GetSummaryGradeInYear2014($data['year'], $grade['grade'], $params['head_org']);
    		$datay[]	= ($items)? $items : $datazero;
    		$gradeStr[]	= $grade['grade'];
    	}
    	
    	$color = array(
    			'yellow@0.3',
    			'orange@0.3',
    			'darkgreen@0.3',
    			'blue@0.3',
    			'violet@0.3',
    			'brown@0.3'
    	);
    	// Create the var series we will combine
    	$bplot = array();
    	foreach($datay as $key => $val) {
    		$bplot[$key] = new BarPlot($val);
    		// Setup the colors with 40% transparency (alpha channel)
    		$bplot[$key]->SetFillColor($color[$key]);
    		// Setup legends
    		$bplot[$key]->SetLegend('Grade ' . $gradeStr[$key]);
    		// Setup each bar with a shadow of 50% transparency
    		$bplot[$key]->SetShadow('black@0.4');
    		$bplot[$key]->value->SetFormat( "%.0d");
    		$bplot[$key]->value->Show();
    	}
    
    	$gbarplot = new GroupBarPlot($bplot);
    	$gbarplot->SetWidth(0.6);
    	$graph->Add($gbarplot);
    
    	if (file_exists(UPLOAD_PATH."/index.png")) {
    		$imagePath = UPLOAD_PATH."/index.png";
    		$imageUrl = UPLOAD_URL."/index.png";
    	} else {
    		$imagePath = UPLOAD_PATH."/index.png";
    		$imageUrl = UPLOAD_URL."/index.png";
    	}
    	$graph->Stroke($imagePath);
    	$data["graphmap"] = $graph->GetHTMLImageMap("myimagemap");
    	$data["graph"] = "<img src=\"".$imageUrl."\" ISMAP USEMAP=\"#myimagemap\"  border=0>";
    
    	//$graph->Stroke();
    	$data["headPage"] = "กราฟ เปรียบเทียบจำนวนพนักงานตามระดับเกรดในแต่ละเดือนของปี ".$data["year"];
    	$view->assign('', $data);
//     	_print($data);exit;
    	$view->output('report/graph_cpginyear.tpl');
    }
/*     public function cpginyearAction(){
    	$Generic = $this->getGeneric();
		$params = $this->getParams();
    	$view = $this->_getView();
    	if(!class_exists('Zend_Auth')) Zend_loader :: loadClass('Zend_Auth');
        $auth = Zend_Auth :: getInstance();
        $identity = $auth->getIdentity();

    	if($identity->user_header =='Y' && $identity->lookup_code != 'AM' && $identity->level < 12){
			if($identity->level == '11'){
				$org = $Generic->GetOrgByCode($identity->user_code);
				$org .= ($org)?",".$this->org_arr:$org;
				$params["head_org"] = $org;
			}else{
				$org = $Generic->GetOrgByCode($identity->user_code);
				$params["head_org"] = $org;
			}
		}

    	$yearPrev = date('Y')-2;
        $yearNow = date('Y')-1;
        $yearNext = date('Y');
        $data["yearOp"] = array($yearPrev=>$yearPrev,$yearNow=>$yearNow,$yearNext=>$yearNext);
        if($params["search"]["year"])$data["year"] = $params["search"]["year"]; else $data["year"] = $yearNext;

    	// Some data
		$datay1 = $Generic->GetSummaryGradeInYear($data["year"],"A",$params["head_org"]);
		$datay2 = $Generic->GetSummaryGradeInYear($data["year"],"B",$params["head_org"]);
		$datay3 = $Generic->GetSummaryGradeInYear($data["year"],"C",$params["head_org"]);
		$datay4 = $Generic->GetSummaryGradeInYear($data["year"],"F",$params["head_org"]);

		$datazero=array(0,0,0,0,0,0,0,0,0,0,0,0);
		$datay1=($datay1)? $datay1:$datazero;
        $datay2=($datay2)? $datay2:$datazero;
        $datay3=($datay3)? $datay3:$datazero;
        $datay4=($datay4)? $datay4:$datazero;


		$graph = new Graph(1000,500,"auto");
		$graph->img->SetMargin(40,80,30,40);
		$graph->title->Set("กราฟเปรียบเทียบจำนวนพนักงานตามระดับเกรด ในแต่ละเดือนของปี ".$data["year"]);
		$graph->title->SetFont(FF_GARUDA,FS_BOLD);
		$graph->title->SetColor('black');
		$graph->SetFrame(false);
		$graph->SetScale("textlin",0,50);

		$graph->ygrid->SetFill(true,'#BFDFFF@0.5','#FFFFFF@0.5');
		$graph->ygrid->SetLineStyle('dashed');
		$graph->ygrid->SetColor('gray');
		$graph->xgrid->Show();
		$graph->xgrid->SetLineStyle('dashed');
		$graph->xgrid->SetColor('gray');

		// Adjust the position of the legend box
		$graph->legend->SetFont(FF_COURIER,FS_NORMAL,10);
        $graph->legend->Pos(0,0,'right','top');

		// Get localised version of the month names
		$graph->xaxis->SetTickLabels($this->monthShotOp);
		$graph->xaxis->SetLabelAngle(50);

		// Set axis titles and fonts
		$graph->xaxis->title->Set('เดือนในปี '.$data["year"]);
		$graph->xaxis->title->SetFont(FF_GARUDA,FS_NORMAL,10);
		$graph->xaxis->title->SetColor('black');
		$graph->xaxis->SetFont(FF_GARUDA,FS_NORMAL,10);
		$graph->xaxis->SetColor('black');

		$graph->yaxis->title->Set('จำนวนพนักงาน (คน)');
		$graph->yaxis->title->SetFont(FF_GARUDA,FS_NORMAL,10);
		$graph->yaxis->title->SetColor('black');
		$graph->yaxis->SetFont(FF_GARUDA,FS_NORMAL,10);
		$graph->yaxis->SetColor('black');

		//$graph->ygrid->Show(false);
		$graph->ygrid->SetColor('black@0.5');

		// Some extra margin (from the top)
		$graph->title->SetMargin(3);
		//$graph->title->SetFont(FF_COURIER,FS_NORMAL,10);

		// Create the three var series we will combine
		$bplot1 = new BarPlot($datay1);
		$bplot2 = new BarPlot($datay2);
		$bplot3 = new BarPlot($datay3);
		$bplot4 = new BarPlot($datay4);

		// Setup the colors with 40% transparency (alpha channel)
		$bplot1->SetFillColor('darkgreen@0.3');
		$bplot2->SetFillColor('orange@0.3');
		$bplot3->SetFillColor('pink@0.3');
		$bplot4->SetFillColor('brown@0.3');


		// Setup legends
		$bplot1->SetLegend('Grade A');
		$bplot2->SetLegend('Grade B');
		$bplot3->SetLegend('Grade C');
		$bplot4->SetLegend('Grade F');

		// Setup each bar with a shadow of 50% transparency
		$bplot1->SetShadow('black@0.4');
		$bplot2->SetShadow('black@0.4');
		$bplot3->SetShadow('black@0.4');
		$bplot4->SetShadow('black@0.4');


		$bplot1->value->SetFormat( "%.0d");
		$bplot2->value->SetFormat( "%.0d");
		$bplot3->value->SetFormat( "%.0d");
		$bplot4->value->SetFormat( "%.0d");

        $bplot1->value->Show();
        $bplot2->value->Show();
        $bplot3->value->Show();
        $bplot4->value->Show();

		$gbarplot = new GroupBarPlot(array($bplot1,$bplot2,$bplot3,$bplot4));
		$gbarplot->SetWidth(0.6);
		$graph->Add($gbarplot);

		if (file_exists(UPLOAD_PATH."/index.png")) {
			$imagePath = UPLOAD_PATH."/index.png";
			$imageUrl = UPLOAD_URL."/index.png";
		} else {
			$imagePath = UPLOAD_PATH."/index.png";
			$imageUrl = UPLOAD_URL."/index.png";
		}
		$graph->Stroke($imagePath);
		$data["graphmap"] = $graph->GetHTMLImageMap("myimagemap");
		$data["graph"] = "<img src=\"".$imageUrl."\" ISMAP USEMAP=\"#myimagemap\"  border=0>";

		//$graph->Stroke();
		$data["headPage"] = "กราฟ เปรียบเทียบจำนวนพนักงานตามระดับเกรดในแต่ละเดือนของปี ".$data["year"];
    	$view->assign('', $data);
		$view->output('report/graph_cpginyear.tpl');
    } */
    public function piegradeAction(){
    	$Generic = $this->getGeneric();
		$params = $this->getParams();
    	$view = $this->_getView();

    	/*$data = array(40,60,21,33);
		$graph = new PieGraph(300,200,"auto");
		$graph->SetShadow();

		$graph->title->Set("A simple Pie plot");
		$graph->title->SetFont(FF_GARUDA,FS_BOLD);

		$p1 = new PiePlot($data);
		$p1->SetLegends($this->grade);
		$p1->SetCenter(0.4);

		$graph->Add($p1);
		if (file_exists(UPLOAD_PATH."/index.png")) {
			$imagePath = UPLOAD_PATH."/index.png";
			$imageUrl = UPLOAD_URL."/index.png";
		} else {
			$imagePath = UPLOAD_PATH."/index.png";
			$imageUrl = UPLOAD_URL."/index.png";
		}
		$graph->Stroke($imagePath);
		$data["graphmap"] = $graph->GetHTMLImageMap("myimagemap");
		$data["graph"] = "<img src=\"".$imageUrl."\" ISMAP USEMAP=\"#myimagemap\"  border=0>";*/
		$data["headPage"] = "กราฟ เปรียบเทียบจำนวนพนักงานตามระดับเกรดในแต่ละเดือนของปี ".$data["year"];
    	$view->assign('', $data);
    	$view->output('report/graph_cpginyear.tpl');
    }
    
}