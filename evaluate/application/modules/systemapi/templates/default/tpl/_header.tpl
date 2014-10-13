{if !$_isAjax}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$_title}</title>
{render_stylesheets}
{render_jscore}
</head>
<body >
<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
	<tr >
   	 	<td colspan="2" valign="top">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center" id="mainTable"  ><!--style="margin-top: 10px;"-->
				<tr bgcolor="#31424A">
			   	 	<td valign="top">
			    		<table width="100%" border="0" cellspacing="0" cellpadding="0">
					      <tr>
					        <td width="198" rowspan="3" valign="top"><img src="{$g_image}/form/logo_01.gif" width="198" height="108" /></td>
					        <td width="176" align="left" valign="top"><img src="{$g_image}/form/logo_02.gif" width="176" height="53" />
					        </td>
					        <td>
						        <table width="40%" border="0" align="right" cellpadding="0" cellspacing="0">
						          <tr>
						            <td align="center"><img src="{$g_image}/form/per.gif" width="18" height="20" /></td>
						            <td align="left" class="style6">&nbsp;{if $_profile->user_code eq '1001'}-contact-{else}{$_profile->user_code}{/if} :: {$_profile->user_name} {$_profile->user_lname} </td>
						            <td width="28"><a href="javascript:checkOut();"><img src="{$g_image}/form/Logout-icon.gif" alt="Logout" width="28" height="28" border="0" /></a></td>
						            <td width="2%">&nbsp;</td>
						          </tr>
						          <tr height="20">
							          <td align="center" width="18"></td>
							          <td colspan="2" class="style6">&nbsp;{$_profile->position_name}</td>
							          <td colspan="2">&nbsp;</td>
						          </tr>
						          <tr height="20">
							          <td align="center" width="18"></td>
							          <td colspan="2" class="style6">&nbsp;วันที่ ::&nbsp;{$_profile->dateNow}</td>
							          <td colspan="2">&nbsp;</td>
						          </tr>
						        </table>
						    </td>
					      </tr>
					      
			    		</table>
			    	</td>
			  	</tr>
			    <tr>
			    	<td height="3" background="{$g_image}/form/bg_underline-link.gif"><img src="{$g_image}/form/bg_underline-link.gif" width="3" height="3" /></td><!-- background="{$g_image}/form/bg_underline-link.gif"-->
			  	</tr>
			</table>
		</td>
	</tr>
	<tr>
	     <td colspan="2"><div id="imenubar"></div></td>
	</tr>
	<tr>
         	<td valign="top" width="220">{include file="$g_template/_lmenu.tpl"}</td>
			<td valign="top" width="100%">
				<table width="100%" border="0" cellpadding="2"><!--class="box"-->
				    <tr>
				    	<td valign="top">
	<!--tr>
		<td valign="top"-->
{/if}
{add_script file="$g_js/jquery.fancybox-1.0.0.js,$g_js/shared.js,$g_js/utils.js,$g_js/ajaxcontent.js,$g_js/modal.js"}