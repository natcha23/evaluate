{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_mstform" enctype="multipart/form-data">
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
										<td align="right" >
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="submitForm('{$mode}');" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/organize/display');" value=" Back " type="button">
											&nbsp;
										</td>
									</tr>
									<tr >
										<td align="left" >
											<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >

										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Organize Code</td>
													<td class="font12">
														<input type="text" name="fields[org_sec_code]" id="org_sec_code" value="{$rows.org_sec_code}" class="textfield_2c" >
														<input type="hidden" name="org_sec_code_old" value="{$rows.org_sec_code}" class="textfield_2c" >
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Organize Name TH</td>
													<td class="font12">
														<input type="text" name="fields[org_sec_name_th]" id="org_sec_name_th" value="{$rows.org_sec_name_th}" class="textfield_7c" >
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Organize Name EN</td>
													<td class="font12">
														<input type="text" name="fields[org_sec_name_en]" id="org_sec_name_en" value="{$rows.org_sec_name_en}" class="textfield_7c" >
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Header</td>
													<td class="font12">
														<input type="text" name="header" id="header_name" value="{$rows.user_name} {$rows.user_lname}" readonly class="textfield_7c" >
														<input type="hidden" name="fields[user_header]" id="user_header" value="{$rows.user_header}" class="textfield_2c" >
														<input type='button' id="btn_accept" class="btn_tools" value="view" onclick="openPopup('workflow/evaluate/userpopup/head/Y');">
														<input id="btn_refresh" title="Clear" class="btn_tools" value=" Clear " type="button" onclick="$('#header_name').val('');$('#user_header').val('')">
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Status</td>
													<td class="font12">
														<select name="fields[org_sec_status]" id="org_sec_status" class="selectBox3cm" >
															{html_options options=$statusOp selected=$rows.org_sec_status}
														</select>
													</td>
										    	</tr>
										    	
										    	
										   </table>
										</td>
									</tr>
					    			<tr>
										<td align="right" height="20">
											<input type='hidden' name='save' id="save">
											<input type='hidden' name='mode' value="{$mode}">
											<input type="hidden" name="fields[org_sec_id]" value="{$rows.org_sec_id}" >
										</td>
									</tr>
									<tr ><td height="20"></td></tr>
									<tr bgcolor="#EBEBEB">
										<td align="right" >
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="submitForm('{$mode}');" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/organize/display');" value=" Back " type="button">
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
</form>
</div>
{add_script file="date,$_js/organize.js"}
{include file="$g_template/_footer.tpl"}