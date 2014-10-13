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
										{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="submitForm();" value=" Save " type="button">{/if}
										{if $_profile->lookup_code eq 'AM'}
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/account/display');" value=" Back " type="button">
										{else}
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/urecive');" value=" Back " type="button">
										{/if}
										&nbsp;
									</td>
								</tr>
				    			<tr>
									<td align="right" height="10">
										<input type='hidden' name='save' id="save">
										<input type='hidden' name='mode' value="{$mode}">
										<input type="hidden" name="fields[user_id]" value="{$rows.user_id}" >
									</td>
								</tr>
								<tr>
									<td align="center" >
										<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="98%" border="0" >
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Code :</td>
										    	<td class="font12" width="40%">
										    		{if $_profile->lookup_code eq 'AM'}
										    		<input type="text" name="fields[user_code]" id="user_code" value="{$rows.user_code}" {if $_profile->lookup_code neq 'AM'}readonly{/if} class="textfield_3c" onKeyup="ckvNum(this);" maxLength="7">
										    		{else}
										    		{*$rows.user_code*}
										    		<input type="text" name="fields[user_code]" readonly id="user_code" value="{$rows.user_code}" class="textfield_3c">
										    		{/if}
										    	</td>
									    		<td rowspan="8" >
									    			<table>
														<tr>
															<td>
																{if !$rows.user_image}
																	<img src="{$UPLOAD_URL}/default.gif" id="PreviewImage" width="100" height="134">
																{else}
																	<img src="{$UPLOAD_URL}/account/{$rows.user_image}?{$rand}" width="100" height="134" id="PreviewImage" class="border1">
																	<input type="hidden" name="picture_old" value="{$rows.user_image}" width="100" height="134">
																{/if}
																	<br>
																	<input type="file" name="picture" id="picture" onchange="CheckImageType(this);">
															</td>
														</tr>
													</table>
									    		</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Name :</td>
										    	<td colspan="2" class="font12">
										    		{if $_profile->lookup_code eq 'AM'}
										    		<input type="text" name="fields[user_name]" id="user_name" value="{$rows.user_name}" class="textfield_5c" {if $_profile->lookup_code neq 'AM'}readonly{/if}>
										    		{else}
										    		{$rows.user_name}
										    		{/if}
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Lastname :</td>
										    	<td colspan="2" class="font12">
										    		{if $_profile->lookup_code eq 'AM'}
										    		<input type="text" name="fields[user_lname]" id="user_lname" value="{$rows.user_lname}" class="textfield_5c" {if $_profile->lookup_code neq 'AM'}readonly{/if}>
										    		{else}
										    		{$rows.user_lname}
										    		{/if}
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">User Login :</td>
										    	<td colspan="2" class="font12">
										    		{if $_profile->lookup_code eq 'AM'}
											    	<input type="text" name="fields[u_login]" id="u_login" value="{$rows.u_login}" class="textfield_5c" {if $_profile->lookup_code neq 'AM'}readonly{/if}>
											    	{else}
										    		{$rows.u_login}
										    		{/if}
										    	</td>
									    	</tr>
									    	{if $_profile->lookup_code eq 'AM'}
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Password :</td>
										    	<td colspan="2" class="font12">
										    		<input type="password" name="fields[u_password]" id="u_password" value="{$rows.u_password}" class="textfield_5c" >
										    		<input id="btn_refresh" title="Clear" class="btn_tools" value=" Clear " type="button" onclick="$('#u_password').val('')">
										    		<input type="hidden" name="u_password" id="u_password_old" value="{$rows.u_password}" class="textfield_5c" >
										    	</td>
									    	</tr>
									    	{/if}
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">E-Mail :</td>
										    	<td colspan="2" class="font12">
										    		{if $_profile->lookup_code eq 'AM'}
										    		<input type="text" name="fields[user_email]" id="user_email" value="{$rows.user_email}" class="textfield_5c" {if $_profile->lookup_code neq 'AM'}readonly{/if}>
										    		{else}
										    		{$rows.user_email}
										    		{/if}
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Moblie :</td>
										    	<td colspan="2" class="font12">
										    		{if $_profile->lookup_code eq 'AM'}
										    		<input type="text" name="fields[user_mobile]" id="user_mobile" value="{$rows.user_mobile}" class="textfield_5c" onKeyup="isNumber(this);" {if $_profile->lookup_code neq 'AM'}readonly{/if}> Ex:- 081XXXXXXX
										    		{else}
										    		{$rows.user_mobile}
										    		{/if}
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Position :</td>
										    	<td colspan="2" class="font12">
										    		{if $_profile->lookup_code eq 'AM'}
										    		<select name="fields[user_position]" id="user_position" onchange="GetLevel(this);" class="selectBox6cm" {if $_profile->lookup_code neq 'AM'}readonly{/if}>
													<option value="">-- Please select --</option>
													{html_options options=$positionOp selected=$rows.user_position}
													</select>
                                                    <input type="hidden" name="position_old" value="{$rows.user_position}">
                                                    <input type="hidden" name="level_old" value="{$rows.org_position_level}">
                                                    <input type="hidden" name="level_new" id="level_new">
													{else}
										    		{$positionOp[$rows.user_position]}
                                                    <input type="hidden" name="level_new" id="level_new" value="{$rows.org_position_level}">
										    		{/if}
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Department :</td>
										    	<td colspan="2" class="font12">
										    		{if $_profile->lookup_code eq 'AM'}
										    		<select name="fields[user_sec_depart]" id="user_sec_depart" class="selectBox6cm" {if $_profile->lookup_code neq 'AM'}readonly{/if}>
													<option value="">-- Please select --</option>
													{html_options options=$departmentOp selected=$rows.user_sec_depart}
													</select>
                                                    <input type="hidden" name="dept_old" value="{$rows.user_sec_depart}">
													{else}
										    		{$departmentOp[$rows.user_sec_depart]}
										    		{/if}
										    	</td>
									    	</tr>
											{if $_profile->lookup_code eq 'AM'}
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">User Menu :</td>
										    	<td colspan="2" class="font12">
										    		<select name="fields[lookup_code]" id="lookup_code" class="selectBox6cm" >
													<option value="">-- Please select --</option>
													{html_options options=$groupMenuOp selected=$rows.lookup_code}
													</select>
										    	</td>
									    	</tr>
									    	{/if}
									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Start Date :</td>
										    	<td colspan="2" class="font12">
										    		{if $rows.user_start eq '0000-00-00'}{assign var="stdate" value=""}{else}{assign var="stdate" value=$rows.user_start}{/if}
													{if $_profile->lookup_code neq 'AM'}{$stdate}{else}
													{html_input_date name="fields[user_start]" id="user_start" value="$stdate" size="15" readonly=true }
													{/if}
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Header Active :</td>
										    	<td colspan="2" class="font12">
										    		<input {if $_profile->lookup_code neq 'AM'}disabled{/if} class="border0" type="checkbox" name="fields[user_header]" value="Y" {if $rows.user_header eq 'Y'}checked{/if}>
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b"> Active :</td>
										    	<td colspan="2" class="font12">
										    		<input {if $_profile->lookup_code neq 'AM'}disabled{/if} class="border0" type="checkbox" name="fields[incentive_active]" value="Y" {if $rows.incentive_active eq 'Y'}checked{/if}>
										    	</td>
									    	</tr>
									    	{if $_profile->lookup_code eq 'AM'}
									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Start MI :</td>
										    	<td colspan="2" class="font12">
										    		{if $rows.user_start_mi eq '0000-00-00'}{assign var="stdate_mi" value=""}{else}{assign var="stdate_mi" value=$rows.user_start_mi}{/if}
													{html_input_date name="fields[user_start_mi]" id="user_start_mi" value="$stdate_mi" size="15" readonly=true }
										    	</td>
									    	</tr>
									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Start PI :</td>
										    	<td colspan="2" class="font12">
										    		{if $rows.user_start_pi eq '0000-00-00'}{assign var="stdate_pi" value=""}{else}{assign var="stdate_pi" value=$rows.user_start_pi}{/if}
													{html_input_date name="fields[user_start_pi]" id="user_start_pi" value="$stdate_pi" size="15" readonly=true }
										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Emp. Active :</td>
										    	<td colspan="2" class="font12">
										    		{html_radios name="fields[user_active]" class="border0" id="user_active" options=$statusOp checked=$status}
										    	</td>
									    	</tr>
									    	{/if}
									    	<tr><td colspan="4" height="10" class="font12"></td></tr>
									   </table>
									</td>
								</tr>
								<tr bgcolor="#EBEBEB">
									<td colspan="2" align="right" >
										{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="submitForm();" value=" Save " type="button">{/if}
										{if $_profile->lookup_code eq 'AM'}
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/account/display');" value=" Back " type="button">
										{else}
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/urecive');" value=" Back " type="button">
										{/if}
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