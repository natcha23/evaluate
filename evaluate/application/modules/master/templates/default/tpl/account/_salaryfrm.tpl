{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_gradefrm" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
			<!--detail-->
				<td valign="top" bgcolor="#FFFFFF">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
					    		<tr >
					                <td height="38" class="titlehead">&nbsp;{$headPage}</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>

			          <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#EBEBEB">
									<td colspan="2" align="right" >
										{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="submitSal();" value=" Save " type="button">{/if}
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/account/salary/user_code/{$user_code}');" value=" Back " type="button">
										&nbsp;
									</td>
								</tr>
				    			<tr>
									<td align="right" height="10">
										<input type='hidden' name='save' id="save">
										<input type='hidden' name='mode' value="{$mode}">
										<input type="hidden" name="fields[sal_id]" value="{$rows.sal_id}" >
										<input type="hidden" name="user_code" value="{$account.user_code}" >
									</td>
								</tr>
								<tr>
									<td align="center" >
										<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="98%" border="0" >

									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Employee Code</td>
										    	<td colspan="2" class="font12">{if $account.user_code eq '1001'}-contact-{else}{$account.user_code}{/if}</td>
									    	</tr>
									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Employee Name</td>
										    	<td colspan="2" class="font12">{$account.user_name}</td>
									    	</tr>
									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Position</td>
										    	<td colspan="2" class="font12">{$account.org_position_name_th}</td>
									    	</tr>
									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Salary</td>
										    	<td colspan="2" class="font12"><input type="text" name="fields[salary]" id="salary" value="{$rows.explode}" class="textfield_3c" onKeyup="isNumber(this);"></td>
									    	</tr>
									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Change Date</td>
										    	<td colspan="2" class="font12">
										    		{if $rows.date_upsalary eq '0000-00-00'}{assign var="stdate" value=""}{else}{assign var="stdate" value=$rows.date_upsalary}{/if}
													{html_input_date name="fields[date_upsalary]" id="date_upsalary" value="$stdate" size="15" readonly=true }
										    	</td>
									    	</tr>
											<tr >
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Remark</td>
										    	<td colspan="2" class="font12">
										    		<textarea name="fields[note]" rows="7" id="note" class="textfield_10c" >{$rows.note}</textarea>
										    	</td>
									    	</tr>
									    	<tr><td colspan="4" height="10" class="font12"></td></tr>
									   </table>
									</td>
								</tr>
								<tr bgcolor="#EBEBEB">
									<td colspan="2" align="right" >
										{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="submitSal();" value=" Save " type="button">{/if}
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/account/salary/user_code/{$user_code}');" value=" Back " type="button">
										&nbsp;
									</td>
								</tr>
				    		</table>
				    	</td>
				    </tr>
				  <tr align="right">
				   		<td >
							<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
						   	<tbody>
						       	<tr align="right">
						           	<td width="12"><img width="12" src="{$g_image}/buttonmenuleft.gif"/></td>
						            <td>&nbsp;</td>
						            <td width="12"><img width="12" src="{$g_image}/buttonmenuright.gif"/></td>
						        </tr>
						    </tbody>
				 	        </table>
					    </td>
					</tr>
			      </table>
			   </td>
	        <!-- end detail-->
	      	</tr>
    	</table>
    </td>
  </tr>
</table>
{add_script file="date,$_js/account.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>