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
										{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="changePwd();" value=" Save " type="button">{/if}
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/urecive');" value=" Back " type="button">
										&nbsp;
									</td>
								</tr>
				    			<tr>
									<td align="right" height="10">
										<input type='hidden' name='save' id="save">
										<input type='hidden' name='mode' value="{$mode}">
										<input type="hidden" name="fields[user_id]" value="{$rows.user_id}" >
										<input type="hidden" name="pwd" id="pwd" value="{$rows.u_password}" >
									</td>
								</tr>
								<tr>
									<td align="center" >
										<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="98%" border="0" >
									    	<tr height="25">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">User Login</td>
										    	<td colspan="2" class="font12"><input type="text" name="fields[u_login]" id="u_login" value="{$rows.u_login}" class="textfield_5c" ></td>
									    	</tr>
									    	<tr height="25">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Password New</td>
										    	<td colspan="2" class="font12">
										    		<input type="password" name="fields[u_password]" id="u_password" value="" class="textfield_5c" >
										    		<input id="btn_refresh" title="Clear" class="btn_tools" value=" Clear " type="button" onclick="$('#u_password').val('')">
										   		</td>
									    	</tr>
									    	<tr height="25">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Confirm Password</td>
										    	<td class="font12"><input type="password" name="pwd_con" id="pwd_con" value="" class="textfield_5c" ></td>
									    	</tr>

									    	<tr><td colspan="4" height="10" class="font12"></td></tr>
									   </table>
									</td>
								</tr>
								<tr bgcolor="#EBEBEB">
									<td colspan="2" align="right" >
										{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="changePwd();" value=" Save " type="button">{/if}
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/urecive');" value=" Back " type="button">
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