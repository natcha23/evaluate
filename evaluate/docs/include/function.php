<?
function connect_db() {
	$host= 'localhost';
	$user= 'ple';	 $password = 'PLE'; $dbname = 'dev_officeone_shop' ;
	//$user= 'kintercont_user';	 $password = 'peter19'; $dbname = 'kintercont_kicdb' ;
	$db = mysql_connect($host,$user,$password)
		or die("ไม่สามารถสร้างการเชื่อมต่อไปยังดาต้าเบสเซิร์ฟเวอร์ได้");
	mysql_select_db($dbname,$db);
    #mysql_query ("SET NAMES UTF-8",$db);
    mysql_query("SET CHARACTER SET utf8",$db);
    mysql_query("SET collation_connection = 'utf8_unicode_ci'",$db);
	return $db;
}

function config_sys ($key) {
	$cn = connect_db();
	$sql = "SELECT * FROM config WHERE cfg_type='SYS' AND cfg_key='$key' ";
	$que = mysql_query ($sql);
	$nr = mysql_num_rows ($que);
	if ($nr>=1) {
		$arr = mysql_fetch_array ($que);
		return $arr['cfg_value'];
	} else {
		return false;
	}
	mysql_close($cn);
}

function config_mail ($key) {
	$cn = connect_db();
	$sql = "SELECT * FROM config WHERE cfg_type='MAIL' AND cfg_key='$key' ";
	$que = mysql_query ($sql);
	$nr = mysql_num_rows ($que);
	if ($nr>=1) {
		$arr = mysql_fetch_array ($que);
		return $arr['cfg_value'];
	} else {
		return false;
	}
	mysql_close($cn);
}

function config_txt_menu () {
	$cn = connect_db();
	$sql = "SELECT * FROM config WHERE cfg_type='FMENU' ";
	$que = mysql_query ($sql);
	$nr = mysql_num_rows ($que);
	if ($nr>=1) {
		$dsp_menu .= "<table cellpadding='5' cellspacing='0' border='0' align='center'>";
		$dsp_menu .= "<tr height='50'>";
		$i=1;
		while ($arr = mysql_fetch_array ($que)) {
			$dsp_menu .= "<td><A HREF='$_SERVER[PHP_SELF]?page=$arr[cfg_value]'>".$arr[cfg_key]."</A></td>";
			if ($i<$nr) {
				$dsp_menu .= "<td>|</td>";
				$i++;
			}
		}
		$dsp_menu .= "</tr>";
		$dsp_menu .= "</table>";
		return $dsp_menu;
	} else {
		return false;
	}
	mysql_close($cn);
}

function dsp_date($date) {
	$_year = substr($date,0,4);
	$_month = substr($date,4,2);
	$_day = substr($date,6,2);
	$dsp_date = $_day."/".$_month."/".$_year;
	return $dsp_date;
}

function get_product_head ($hprod) {
	connect_db();
	$sql="SELECT * FROM product_head WHERE phcode='$hprod' AND phstatus='Y' ";
	$que=mysql_query($sql);
	$nr = mysql_num_rows($que);
	if ($nr>=1) {
		$arr = mysql_fetch_array ($que);
		return $arr;
	} else {
		return false;
	}
}

function get_product_line ($lprod) {
	connect_db();
	$sql="SELECT * FROM product_line WHERE plcode='$lprod' AND plstatus='Y' ";
	$que=mysql_query($sql);
	$nr = mysql_num_rows($que);
	if ($nr>=1) {
		$arr = mysql_fetch_array ($que);
		return $arr;
	} else {
		return false;
	}
}

function get_category ($catid) {
	connect_db();
	$sql= "SELECT * FROM category WHERE catid=$catid";
	$que = mysql_query ($sql);
	$nr = mysql_num_rows($que);
	if ($nr>=1) {
		$arr = mysql_fetch_array($que);
		return $arr;
	} else {
		return false;
	}
}

function get_category_from_product ($pid) {
	connect_db();
	$sql= "SELECT * FROM category, category_item WHERE (catid=ci_category) AND ci_itemno=$pid";
	$que = mysql_query ($sql);
	$nr = mysql_num_rows($que);
	if ($nr>=1) {
		$arr = mysql_fetch_array($que);
		return $arr;
	} else {
		return false;
	}
}

function get_product_from_category ($catid) {
	connect_db();
	$sql= "SELECT * FROM category, category_item WHERE (catid=ci_category) AND ci_itemno=$pid";
	$que = mysql_query ($sql);
	$nr = mysql_num_rows($que);
	if ($nr>=1) {
		$arr = mysql_fetch_array($que);
		return $arr;
	} else {
		return false;
	}
}

function get_brand ($ctid) {
	connect_db();
	$sql= "SELECT * FROM content WHERE hp_seri=$ctid AND hp_type='PARTNER' ";
	$que = mysql_query ($sql);
	$nr = mysql_num_rows($que);
	if ($nr>=1) {
		$arr = mysql_fetch_array($que);
		return $arr;
	} else {
		return false;
	}
}

function get_content ($cid) {
	connect_db();
	$sql = "SELECT * FROM content WHERE hp_seri=$cid ";
	$que = mysql_query ($sql);
	$nr = mysql_num_rows($que);
	if ($nr>=1) {
		$arr = mysql_fetch_array($que);
		return $arr;
	} else {
		return false;
	}
}

function get_price ($itemno, $type) {
	connect_db();
	$sql = "SELECT * FROM product_price WHERE pl_itmno='$itemno' AND pl_type='$type' ";
	$que = mysql_query ($sql);
	$nr = mysql_num_rows($que);
	if ($nr>=1) {
		$arr = mysql_fetch_array($que);
		return number_format($arr[pl_price]);
	} else {
		return " Call ";
	}
}


function get_menu () {
	$cn = connect_db();
	$sql = "SELECT * FROM config WHERE cfg_type='FMENU' ";
	$que = mysql_query ($sql);
	$nr = mysql_num_rows ($que);
	if ($nr>=1) {
		while ($arr = mysql_fetch_array ($que)) {
			$arr_menu[$arr['cfg_key']] = $arr['cfg_value'];
		}
		return $arr_menu;
	} else {
		return false;
	}
	mysql_close($cn);
}

function productHeadImage ($imgfile,$size) {
	$imgFilePath = "productImage/productHead/".$imgfile.".jpg";
	//echo $imgFilePath;
	if (file_exists($imgFilePath)) {
		$_img .= "<span id='simg'>";
		$_img .=  "<img src='resize_jpg.php?w=$size&h=$size&img=$imgFilePath' vspace='0' hspace='5' border='0' align='center'>";
		$_img .= "</span>";
		return $_img;
	} else {
		return false;
	}
}

function productLineImage ($imgfile,$size) {
	$imgFilePath = "productImage/productLine/".$imgfile.".jpg";
	//echo $imgFilePath;
	if (file_exists($imgFilePath)) {
		$_img .= "<span id='simg'>";
		$_img .=  "<img src='resize_jpg.php?w=$size&h=$size&img=$imgFilePath' vspace='0' hspace='5' border='0' align='center'>";
		$_img .= "</span>";
		return $_img;
	} else {
		return false;
	}
}

function contentImage ($imgfile,$size) {
	$imgFilePath = "images/content/".$imgfile;
	//echo $imgFilePath;
	if (is_file($imgFilePath)) {
		$_img .= "<span id='simg'>";
		$_img .=  "<img src='resize_jpg.php?w=$size&h=$size&img=$imgFilePath' vspace='0' hspace='5' border='0' align='center'>";
		$_img .= "</span>";
		return $_img;
	} else {
		return false;
	}
}

function today () {
	return date('Ymd');
}

function get_mcategory ($mcat,$lang='th') {
	connect_db();
	$sql= "SELECT * FROM category_m WHERE mcatid='$mcat' ";
	$que = mysql_query ($sql);
	$arr = mysql_fetch_array ($que);
	if ($lang=='th') {
		return $arr[mcatnmt];
	} elseif ($lang=='en') {
		return $arr[mcatnme];
	}
}

function get_scategory ($scat,$lang='th') {
	connect_db();
	$sql= "SELECT * FROM category_s WHERE scatid='$scat' ";
	$que = mysql_query ($sql);
	$arr = mysql_fetch_array ($que);
	if ($lang=='th') {
		return $arr[scatnmt];
	} elseif ($lang=='en') {
		return $arr[scatnme];
	}
}

function product_navi_prod ($hprod) {
	connect_db();
	$sql= "SELECT * FROM category_product WHERE cc_product='$hprod' ";
	$que = mysql_query ($sql);
	$nr = mysql_num_rows($que);
	if ($nr>=1) {
		$arr=mysql_fetch_array($que);
		$navi = "<DIV id='txt_link'><A HREF='$_SERVER[PHP_SELF]'>Home</A>"." > "."<A HREF='$_SERVER[PHP_SELF]?page=product_mcat&mcat=$arr[cc_mcat]'>".get_mcategory($arr[cc_mcat])."</A>"." > "."<A HREF='$_SERVER[PHP_SELF]?page=product_scat&scat=$arr[cc_scat]'>".get_scategory($arr[cc_scat])."</A></DIV>";
		return $navi;
	} else {
		return false;
	}
}

function product_navi_scat ($scat) {
	connect_db();
	$sql= "SELECT DISTINCT cc_mcat FROM category_product WHERE cc_scat='$scat' ";
	$que = mysql_query ($sql);
	$nr = mysql_num_rows($que);
	if ($nr>=1) {
		$arr=mysql_fetch_array($que);
		$navi = "<DIV id='txt_link'><DIV id='txt_link'><A HREF='$_SERVER[PHP_SELF]'>Home</A>"." > "."<A HREF='$_SERVER[PHP_SELF]?page=product_mcat&mcat=$arr[cc_mcat]'>".get_mcategory($arr[cc_mcat])."</A>"." > "."<A HREF='$_SERVER[PHP_SELF]?page=product_scat&scat=$scat'>".get_scategory($scat)."</A></DIV>";
		return $navi;
	} else {
		return false;
	}
}

function product_navi_mcat ($mcat) {
	connect_db();
	$navi = "<DIV id='txt_link'><DIV id='txt_link'><A HREF='$_SERVER[PHP_SELF]'>Home</A>"." > "."<A HREF='$_SERVER[PHP_SELF]?page=product_mcat&mcat=$arr[cc_mcat]'>".get_mcategory($mcat)."</A></DIV>";
	return $navi;
}

function get_product_name ($hprod) {
	connect_db();
	$sql="SELECT * FROM product_head WHERE phcode='$hprod' AND phstatus='Y' ";
	$que=mysql_query($sql);
	$nr = mysql_num_rows($que);
	if ($nr>=1) {
		$arr = mysql_fetch_array ($que);
		return $arr[phname];
	} else {
		return false;
	}
}


?>