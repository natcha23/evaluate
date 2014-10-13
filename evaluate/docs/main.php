<?
include "include/function.php";

if (!$page OR $page=='') {
	$page = "home";
	$pg_mod = $page;
} else {
	$ext_page = explode("_",$page);
	$pg_mod = $ext_page[0];
}

if ($pg_mod=="product") {

	if ($page=='product_item') {
		$_title = get_product_name ($hprod)." - ".config_sys ('company_en');
	} elseif ($page=='product_scat') {
		$_title = get_scategory ($scat)." - ".config_sys ('company_en');
	} elseif ($page=='product_mcat') {
		$_title = get_mcategory ($mcat)." - ".config_sys ('company_en');
	}

} else {
	$_title = config_sys ('company_en');
}




?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TITLE><?=$_title?></TITLE>
<?
include "include/style.css";
?>
</HEAD>

<BODY>

<TABLE cellpadding='0' cellspacing='0' border='0' width='800' align='center' id='mainTable' >
<tr>
<td>

	<TABLE cellpadding='5' cellspacing='0' border='0' width='100%'>
	<tr>
	<td><IMG SRC='images/logo.png' border='0'></td>
	<td width='300' align='right' valign='top'><? include "pages/shopcart_box.php"; 	?></td>
	</tr>
	</TABLE>

</td>
</tr>

<tr><td align='right'><? include "pages/product_search.php"; ?></td></tr>

<tr><td id='memberBar'>
<? include "pages/member_login.php"; ?>
</td></tr>
<tr><td><IMG SRC='images/banner/banner1.jpg' border='0'></td></tr>
 <tr height='30'>
<td id='naviBar' align='center'>
	<div id='txt_link'><A HREF=''>News & Event</A> | <A HREF=''>Promotion</A> | <A HREF=''>My Account</A> | <A HREF=''>MyCatalog</A> | <A HREF=''>MyQuotation</A> | <A HREF=''>About us</A> | <A HREF=''>Contact us</A></div>
</td>
</tr>
<!-- <tr bgcolor='#FFFFFF'><td><IMG SRC='images/spacer.gif' border='0' height='10'></td></tr>
 --></TABLE>

<TABLE cellpadding='0' cellspacing='0' border='0' width='800' align='center' id='mainTable' >
<tr valign='top'>
<td width='180'>

<? include ("pages/product_directory.php");?>

</td>
<td>

<?
$pagefile = "pages/".$page.".php";
if (file_exists($pagefile)) {
	include $pagefile;
} else {
	include "pagenotfound.php";
}
?>

</td>
</tr>

<tr height='20'>
<td></td>
<td></td>
</tr>

</TABLE>

<TABLE cellpadding='10' cellspacing='0' border='0' width='800' align='center'>
<tr valign='top'>
	<td><DIV id='txt_link'><A HREF=''>Term of Use</A> | <A HREF=''>Privacy Policy</A> | <A HREF=''>Contact us</A> </DIV><BR>
	บริษัืท ซี.ดับบริว.ดี. อินเตอร์เทรด จำกัด <BR>
	20/2 สุขุมวิทซอย4 แขวงคลองเตย เขตคลองเตย กรุงเทพฯ 10110<BR>
	Tel: 02 255 4747-50, 02 251 5422, 02 252 2257 <BR>
	Fax: 02 225 4752

	</td>
	<td align='right'>&copy; Copyright 2008 office-one v.2.0 by Ice Solution</td>
</tr>
</TABLE>



</BODY>
</HTML>
