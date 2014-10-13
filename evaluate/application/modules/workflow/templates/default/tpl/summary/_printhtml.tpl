{php}
        header("Content-Type: text/html; charset=utf-8");
{/php}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>-:: Print Report Data ::-</title>
</head>
<body>
<div id="content-container">
	<form method="post" action="" id="_portal" enctype="multipart/form-data" >
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td valign="top" bgcolor="#FFFFFF">
					<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr><td colspan="2" height="38" align="center">&nbsp;</td></tr>
						<tr>
					    	<td colspan="2" align="center">
					    		<table cellpadding="0" cellspacing="1" width="100%" border="0" >
						    		<tr align="center" >
						                <td style="font-size: 14px;" height="38" ><b>{$headPage}</b></td>
					              	</tr>
					    		</table>
		        			</td>
						 </tr>
						 <tr bgcolor="#EBEBEB" id="print">
							<td colspan="2" align="right" >
								<input type="button" id="btn_print" class="btn_tools" value="Print Report" onclick="jsPrint();">
								<input type="button" id="btn_colse" class="btn_tools" value="Close" onclick="window.close();">
							</td>
						</tr>
						<tr>
					    	<td colspan="2" align="center">
					    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
									<tr bgcolor="#CFCFCF" height="30">
										<td style="font-size: 12px;" width="10%" align="center" ><b>Emp. Code</b></td>
										<td style="font-size: 12px;" width="20%" align="center" ><b>Emp. Name</b></td>
										<td style="font-size: 12px;" align="center" ><b>Position</b></td>
										<td style="font-size: 12px;" width="10%" align="center" ><b>Level</b></td>
										<td style="font-size: 12px;" width="10%" align="center" ><b>Grade</b></td>
										<td style="font-size: 12px;" width="15%" align="center" ><b>Incentive</b></td>
									</tr>
									{if $dataArr}
									{foreach from=$dataArr key=key item=depart}
									<tr height="20" bgcolor="#FFE7BA" >
										<td colspan="6" align="left" style="font-size: 12px;">&nbsp;<b>{$depart.department}</b></td>
									</tr>
										{foreach from=$depart.user key=key1 item=item}
										<tr height="20" bgcolor="{cycle values="#ffffff,#E8E8E8"}" >
											<td style="font-size: 11px;" align="center" >{if $item.user_code eq '1001'}-contact-{else}{$item.user_code}{/if}</td>
											<td align="left" style="font-size: 11px;" >{$item.user_name} {$item.user_lname}</td>
											<td align="left" style="font-size: 11px;" >{$item.org_position_name_th}</td>
											<td align="center" style="font-size: 11px;" >{$item.org_position_level}</td>
											<td align="center" style="font-size: 11px;">{$rowsArr[$key][$key1].mph_grade}</td>
											<td align="right" style="font-size: 11px;">{$rowsArr[$key][$key1].incentive|number_format:2}&nbsp;</td>
										</tr>
										{/foreach}
										<tr height="20" bgcolor="#b9b9b9">
											<td colspan="5" align="right" style="font-size: 12px;"><b>Summary Total</b></td>
											<td align="right" style="font-size: 12px;">{$incArr[$key].sum_incentive|number_format:2}&nbsp;</td>
										</tr>
									{/foreach}
									<tr height="20" bgcolor="#b9b9b9">
										<td colspan="5" align="right" style="font-size: 12px;"><b>Summary Total All</b></td>
										<td align="right" style="font-size: 12px;">{$totalArr.sum_incentive|number_format:2}&nbsp;</td>
									</tr>
									{/if}

								</table>
		        			</td>
						</tr>
						<tr><td colspan="2" height="20" align="center">&nbsp;</td></tr>
						<tr>
					    	<td colspan="2" align="left">
					    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="40%" border="0" style="border:1px solid #B9B9B9;">
									<tr style="font-size: 13px;" ><td><b>Total Grade</b></td></tr>
									<tr >
										<td>
											<table cellpadding="0" cellspacing="1" width="100%" >
												<tr height="20"  >
												{foreach from=$gradeOp key=key item=item}
													<td bgcolor="#b9b9b9" style="font-size: 12px;" width="10%" align="center" ><b>{$item}</b></td>
												{/foreach}
												</tr>
												<tr height="20"  >
												{foreach from=$gradeOp key=key item=item}
													<td style="font-size: 12px;" width="10%" align="center" ><b>{$gradeArr[$item]}</b></td>
												{/foreach}
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr bgcolor="#EBEBEB" id="print1">
							<td colspan="2" align="right" >
								<input type="button" id="btn_print" class="btn_tools" value="Print Report" onclick="jsPrint();">
								<input type="button" id="btn_colse" class="btn_tools" value="Close" onclick="window.close();">
							</td>
						</tr>


					</table>
				</td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>
<DIV style="page-break-after:always"></DIV>
<script language="javascript">
{literal}
 function jsPrint(){
 	document.getElementById('print').style.display='none';
 	document.getElementById('print1').style.display='none';
 	window.print();
 	window.location.reload();
 }
 {/literal}
</script>