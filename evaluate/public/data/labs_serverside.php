<?php

include 'configs.php';


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array( 'thumbnail', 'company', 'description', 'profit', 'status' );
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "id";
	
	/* DB table to use */
	$sTable = "labsdata";
	
	/* Database connection information */
	$gaSql['user']       = "root";
	$gaSql['password']   = "root";
	$gaSql['db']         = "flatlab_db";
	$gaSql['server']     = "127.0.0.1";
	
	/* REMOVE THIS LINE (it just includes my SQL connection user/pass) */
// 	include( $_SERVER['DOCUMENT_ROOT']."/datatables/mysql.php" );
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * MySQL connection
	 */
	$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		die( 'Could not open connection to server' );
	
	mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
		die( 'Could not select database '. $gaSql['db'] );
	
	
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
			intval( $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
					($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
// 	echo '<pre>' . print_r($_GET, 1) . '</pre>';exit;
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}

	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";
	
	$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
// 	echo '<pre>' . print_r($sQuery, 1) . '</pre>';exit;
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(`".$sIndexColumn."`)
		FROM   $sTable
	";
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	

	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	$labelArr = array("due" => "warning", "paid" => "success");
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}
			else if ( $aColumns[$i] == 'status')
			{
				$row[] = '<span class="label label-'. $labelArr[$aRow[ $aColumns[$i] ] ] . ' label-mini">' . $aRow[ $aColumns[$i] ] . '</span>';
				
			}
			else if ( $aColumns[$i] == 'thumbnail')
			{
				$row[] = '<a class="pull-left thumb p-thumb"><img src="' . $aRow[ $aColumns[$i] ] . '"></a>';
			
			}
			else if ( $aColumns[$i] == 'profit')
			{
				$row[] = $aRow[ $aColumns[$i] ] . "$";
					
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			}
			
		}
		
		$row[] = '<td><button class="btn btn-success btn-xs" id="modal-link" data-toggle="modal" href="' . APPLICATION_HOST . '"/data/labs_serverside_form.php?profit='. $aRow['profit'] . '" data-target="#myModal"><i class="fa fa-check"></i></button>
                 <a href="labs_form.html"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                 <button class="btn btn-danger btn-xs" data-toggle="modal" href="#myModal2"><i class="fa fa-trash-o "></i></button>
            	</td>';
		
		$output['aaData'][] = $row;
	}
// 	echo '<pre>' . print_r($output, 1) . '</pre>';exit;
	echo json_encode( $output );
?>