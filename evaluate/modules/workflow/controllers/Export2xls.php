<?php
class Export2xls {
	public $m_FileName = "filename.xls";
    public function __construct() {}
    public function SetFileName($fileName){$this->m_FileName = $fileName.".xls";}
    public function SetHeader(){
    	header("Content-type: application/vnd.ms-excel");
	    header("Content-disposition: attachment; filename=".$this->m_FileName);
	    header("Expires: 0");
	    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
	    header("Pragma: public");

    }
    public function WriteFile(&$dataRecord,$colums,$delimiter="\t",$enclosure=" ") {
        $string = "";
	        if($colums){
	        	$data = array(0=>$colums);
	        }
	        $dataRecord = array($data,$dataRecord);

	        foreach($dataRecord as $line){
            $writeDelimiter = false;
            if ($string) unset($string);
	            foreach($line as $dataElement){
	            	$writeDelimiter = false;
            		if ($string) unset($string);
            		foreach($dataElement as $dataArr){
		            	$dataArr = iconv("UTF-8","TIS-620",$dataArr);
		                $dataArr=str_replace(array("\"",","), "\"\"", $dataArr);
		                if($writeDelimiter) $string .= $delimiter;
		                if(substr($dataArr,0,1)=="0" && $dataArr!=""){
		                	$dataArr = "'".$dataArr;
		                }
		                $string .= $enclosure .$dataArr. $enclosure;
		                $writeDelimiter = true;
	            	}
	            	$string .= "\r\n";
	            	echo "".$string."";
	            }
        	}
    }
    public function WriteFile2(&$dataRecord,$colums,$delimiter="\t",$enclosure=" ") {
        $string = "";
	        if($colums){
	        	$data = array(0=>$colums);
	        }
	        $dataRecord = array($data,$dataRecord);

	        foreach($dataRecord as $line){
            $writeDelimiter = false;
            if ($string) unset($string);
	            foreach($line as $dataElement){
	            	$writeDelimiter = false;
            		if ($string) unset($string);
            		foreach($dataElement as $dataArr){
		            	$dataArr = iconv("UTF-8","TIS-620",$dataArr);
		                $dataArr=str_replace(array("\"",","), "\"\"", $dataArr);
		                if($writeDelimiter) $string .= $delimiter;
		                if(substr($dataArr,0,1)=="0" && $dataArr!=""){
		                	//$dataArr = "'".$dataArr;
		                }
		                $string .= $enclosure .$dataArr. $enclosure;
		                $writeDelimiter = true;
	            	}
	            	$string .= "\r\n";
	            	echo "".$string."";
	            }
        	}
    }
}
?>
