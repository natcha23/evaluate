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
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="submitForm();" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/form/display');" value=" Back " type="button">
											&nbsp;
										</td>
									</tr>
									<tr >
										<td align="left" >
											<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >

										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Form No.</td>
													<td class="font12">
														<input type="text" name="fields[form_code]" id="form_code" value="{$rows.form_code}" class="textfield_5c" >
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Form Name</td>
													<td class="font12">
														<input type="text" name="fields[form_name]" id="form_name" value="{$rows.form_name}" class="textfield_5c" >
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Objective</td>
													<td class="font12">
														<textarea name="fields[form_objective]" rows="7" id="form_objective" class="textfield_10c" >{$rows.form_objective}</textarea>
													</td>
										    	</tr>
										    	<tr height="30">
													<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Start Date</td>
													<td class="font12" nowrap>
														 {if $rows.form_stdate eq '0000-00-00'}{assign var="stdate" value=""}{else}{assign var="stdate" value=$rows.form_stdate}{/if}
														 {html_input_date name="fields[form_stdate]" id="form_stdate" value="$stdate" size="15" readonly=true }
													</td>
												</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
											    	<td align="left" width="150px" class="font11b" nowrap>End Date</td>
											    	<td class="font12" nowrap>
											    		{if $rows.form_enddate eq '0000-00-00'}{assign var="enddate" value=""}{else}{assign var="enddate" value=$rows.form_enddate}{/if}
											    		{html_input_date name="fields[form_enddate]" id="form_enddate" value="$enddate" size="15" readonly=true }
											    	</td>
												</tr>
												<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Form Type</td>
													<td class="font12">
														<select name="fields[form_type]" id="form_type" class="selectBox3cm" >
														<option value="">-- Please select --</option>
														{html_options options=$typeOp selected=$rows.form_type}
														</select>
													</td>
										    	</tr>
										    	<tr height="30">
											    	<td width="15px">&nbsp;</td>
													<td align="left" width="150px" class="font11b" nowrap>Form Active</td>
													<td class="font12">
											    		{html_radios name="fields[form_status]" class="border0" id="form_status" options=$statusOp checked=$status}
											    	</td>
									    		</tr>
										   </table>
										</td>
									</tr>
					    			<tr>
										<td align="right" height="20">
											<input type='hidden' name='save' id="save">
											<input type='hidden' name='mode' value="{$mode}">
											<input type="hidden" name="fields[form_id]" value="{$rows.form_id}" >
										</td>
									</tr>
									<tr ><td height="20"></td></tr>
									<tr bgcolor="#EBEBEB">
										<td align="right" >
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="submitForm();" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/form/display');" value=" Back " type="button">
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
{add_script file="date,$_js/form.js"}
{include file="$g_template/_footer.tpl"}