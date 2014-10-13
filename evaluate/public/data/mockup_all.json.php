<?php

include 'mockup_data.json.php';
// echo '<pre>' . print_r($items, 1) . '</pre>';
// echo '<pre>' . print_r($_GET, 1) . '</pre>';//exit;

if($_GET['pageName'] == "receive") {

	if(!empty($items)) {
		
		$imgArr = array(
				"product1.jpg",
				"product2.png",
				"product3.png"
		);
		$temp = $items;
		$items = array();

		foreach($temp as $key => $item) {
			
			$ranProgess = mt_rand(0,100);
			$progressbar = '<div class="panel-body inew-row"><div class="progress progress-sm">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="'.$ranProgess.'" aria-valuemin="0" aria-valuemax="100" style="width: '.mt_rand(0,100).'%">
                                      <span class="sr-only">' .$ranProgess. '% Complete (success)</span>
                                  </div>
                       		</div></div>';
			
			$randImg = $imgArr[array_rand($imgArr, 1)];
			$thumbObj = "<a class=\"pull-left thumb news-thumb\"><img src=\"/img/" .$randImg. "\" data-toggle=\"modal\" href=\"#displayModal\"></a>";
			
			$objArr = array($progressbar, $thumbObj);
			$desc 	= $item[2] . " " . $item[3] . " " . $item[4];
			
			$randDisplay = $objArr[array_rand($objArr, 1)];
			
			$item[0] = "<td class=\"inbox-small-cells\"><input type=\"checkbox\" class=\"mail-checkbox\"></td>";
// 			$item[1] = "<a class=\"pull-left thumb news-thumb\"><img src=\"/img/" .$randImg. "\" data-toggle=\"modal\" href=\"#displayModal\"></a>";
			$item[1] = $randDisplay;
			$item[2] = "<b>" . $desc . "</b><br>" . "Description : " . $item[5];
			$item[3] = "<td><div class=\"inews-icon\">
							<a data-toggle=\"modal\" href=\"#commentModal\"><i class=\"fa fa-comment text-info tooltips\" data-original-title=\"No comment\" data-placement=\"top\"></i></a>
							<a><i class=\"fa fa-file-text text-muted tooltips\" data-html=\"true\" data-original-title=\"File: filename.ext <br>Size: 256MB\" data-placement=\"top\"></i></a>
							<a><i class=\"fa fa-user text-primary tooltips\" data-original-title=\"Sender: admin\" data-placement=\"top\"></i></a>
							<a><i class=\"fa fa-gears text-warning tooltips\" data-toggle=\"modal-popover\" data-target=\"#popupDemo\" data-placement=\"top\"></i></a>
						</div></td>";
			$item[4] = $datetime = date('Y-m-d H:i:s', strtotime( '+'.mt_rand(0,30).' days'));
			$item[5] = "<td>
								<button class=\"btn btn-success btn-xs tooltips\" data-toggle=\"modal\" href=\"#downloadModal\" data-original-title=\"Download via Aspera\"><i class=\"fa fa-cloud-download\"></i></button>
								<button class=\"btn btn-primary btn-xs tooltips\" data-toggle=\"modal\" href=\"#downloadModal\" data-original-title=\"Download news media file\"><i class=\"fa fa-download\"></i></button>
								<button class=\"btn btn-warning btn-xs tooltips\" data-toggle=\"modal\" href=\"#downloadModal\" data-original-title=\"Download news detail\"><i class=\"fa fa-caret-square-o-down\"></i></button>
								<button class=\"btn btn-danger btn-xs tooltips\" data-id=\"3\" data-toggle=\"modal\" href=\"/data/mockup_form.json.php?del=1&key=". $key ."\" data-target=\"#confirmModal\" id=\"modal-confirm\" data-original-title=\"Delete this file\" data-placement=\"left\">
									<i class=\"fa fa-trash-o\"></i></button>
								<!--button class=\"btn btn-muted btn-xs\" data-toggle=\"modal-popover\" data-target=\"#popupDemo\" data-placement=\"top\" ><i class=\"fa fa-gears\"></i></button-->
						</td>";
			unset($item[6]);
			
			$newArr = array();
				
			foreach($item as $val) {
				$newArr[] = $val;
			}
				
			$items[] = $newArr;
		}
	}
}

// echo '<pre>' . print_r($items, 1) . '</pre>';exit;
if($_GET['pageName'] == "group") {
	
	if(!empty($items)) {
		
		$temp = $items;
		$items = array();
		
		foreach($temp as $item) {
			
			unset($item[1]);
			unset($item[2]);
			unset($item[3]);
			$newArr = array();
			
			foreach($item as $val) {
				$newArr[] = $val;
			}
			
			$items[] = $newArr;
		}
	}

}

$Col = array("category" ,"geography");

if (in_array($_GET['pageName'], $Col)) {
	
	if(!empty($items)) {
	
		$temp = $items;
		$items = array();
	
		foreach($temp as $item) {
			unset($item[0]);
			unset($item[1]);
			unset($item[2]);
			unset($item[3]);
			$newArr = array();
				
			foreach($item as $val) {
				$newArr[] = $val;
			}
				
			$items[] = $newArr;
		}
	}
	
}


if($_GET['pageName'] == "province") {

	if(!empty($items)) {

		$temp = $items;
		$items = array();

		foreach($temp as $item) {
				
			unset($item[0]);
			unset($item[2]);
			unset($item[3]);
			$newArr = array();
				
			foreach($item as $val) {
				$newArr[] = $val;
			}
				
			$items[] = $newArr;
		}
	}

}

if($_GET['pageName'] == "report-log") {

	if(!empty($items)) {

		$temp = $items;
		$items = array();

		foreach($temp as $item) {
				
			unset($item[0]);
			unset($item[6]);
			$newArr = array();
				
			foreach($item as $val) {
				$newArr[] = $val;
			}
				
			$items[] = $newArr;
		}
	}

}

// echo '<pre>' . print_r($items, 1) . '</pre>';
/*
 * Ordering
*/
// $sOrder = "";
// if ( isset( $_GET['iSortCol_0'] ) )
// {
// 	$sOrder = "ORDER BY  ";
// 	for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
// 	{
// 		if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
// 		{
// 			$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
// 					($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
// 		}
// 		echo $_GET['sSortDir_'.$i];
// 	}
	
// 	$sOrder = substr_replace( $sOrder, "", -2 );
	
// 	if ( $sOrder == "ORDER BY" )
// 	{
// 		$sOrder = "";
// 	}
// }

if ( isset( $_GET['iSortCol_0'] ) ) {

	for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ) {
	
		if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ) {
			
			if($_GET['sSortDir_'.$i]==='asc') {
				//'asc'
				sort($items);
			} else {
				//: 'desc');
				rsort($items);
			}

		}
	}

}


/*
 * Filtering
* NOTE this does not match the built-in DataTables filtering which does it
* word by word on any field. It's possible to do here, but concerned about efficiency
* on very large tables, and MySQL's regex functionality is very limited
*/
// $sWhere = "";
// if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
// {
// 	$sWhere = "WHERE (";
// 	for ( $i=0 ; $i<count($aColumns) ; $i++ )
// 	{
// 		$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
// 	}
// 	$sWhere = substr_replace( $sWhere, "", -3 );
// 	$sWhere .= ')';
// }
if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
	
	foreach($items as $key => $item) {
		
		$res = array_search($_GET['sSearch'], $item);
	}
	
	$items[] = $res;
	
// 	array_search(strtolower($_GET['sSearch']),array_map('strtolower',$array));
}

/*
 * Paging
*/
// $sLimit = "";
// if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
// {
// 	$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
// 			intval( $_GET['iDisplayLength'] );
// }
$totalItems 	= count($items);
$paging = $_GET['iDisplayStart']+$_GET['iDisplayLength'];
if($paging > $totalItems) {
	$paging = $totalItems;
}
for($p=$_GET['iDisplayStart'];$p<$paging; $p++){
	$rows[] = $items[$p];
}

$result['sEcho'] 				= intval($_GET['sEcho']);
$result['iTotalRecords'] 		= $totalItems;
$result['iTotalDisplayRecords'] = $totalItems;
$result['aaData']				= $rows;

// echo '<pre>' . print_r($result, 1) . '</pre>';
echo json_encode($result);



