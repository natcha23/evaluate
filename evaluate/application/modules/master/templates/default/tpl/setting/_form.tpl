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
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/setting/display');" value=" Back " type="button">
											&nbsp;
										</td>
									</tr>
									<tr >
										<td align="left" >
											<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >

										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Step Flow</td>
													<td class="font12">
														<select name="fields[hs_step]" id="hs_step" class="selectBox6cm" >
														{html_options options=$StepOp selected=$rows.hs_step}
														</select>
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Sender</td>
													<td class="font12">
														<select name="fields[hs_send]" id="hs_send" class="selectBox6cm" >
														<option value="">-- Please select --</option>
														{html_options options=$userHeader selected=$rows.hs_send}
														</select>
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Receiver</td>
													<td class="font12">
														<select name="fields[hs_recive]" id="hs_recive" class="selectBox6cm" >
														<option value="">-- Please select --</option>
														{html_options options=$userHeader selected=$rows.hs_recive}
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
											<input type="hidden" name="fields[hs_id]" value="{$rows.hs_id}" >
										</td>
									</tr>
									<tr ><td height="20"></td></tr>
									<tr bgcolor="#EBEBEB">
										<td align="right" >
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="submitForm('{$mode}');" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/setting/display');" value=" Back " type="button">
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
{add_script file="date,$_js/setting.js"}
{include file="$g_template/_footer.tpl"}