{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_typemstfrm" enctype="multipart/form-data">
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
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="chekSubmitType();" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/master/typemst/menu_id/{$mId}');" value=" Back " type="button">
											&nbsp;
									</td>
								</tr>
				    			<tr>
									<td align="right" >
										<input type='hidden' name='save' id="save">
										<input type='hidden' name='mode' value="{$mode}">
										<input type="hidden" name="fields[type_id]" value="{$rows.type_id}" >
									</td>
								</tr>
								<tr>
									<td align="center" >
										<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="98%" border="0" >
									    	<tr height="30">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">ชื่อย่อ Type</td>
										    	<td class="font12"><input type="text" name="fields[type_name]" id="type_name" value="{$rows.type_name}" class="textfield_3c" maxLength="10"></td>
									    	</tr>
									    	<tr height="30">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">ชื่อเต็ม Type</td>
										    	<td class="font12"><input type="text" name="fields[type_fullname]" id="type_fullname" value="{$rows.type_fullname}" class="textfield_10c" ></td>
									    	</tr>
									    	<tr height="30">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">หมายเหตุ</td>
										    	<td class="font12"><textarea name="fields[type_desc]" id="type_desc" rows="5" class="textfield_10c">{$rows.type_desc}</textarea></td>
									    	</tr>

									   </table>
									</td>
								</tr>
								<tr bgcolor="#EBEBEB">
									<td align="right" >
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="chekSubmitType();" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/master/typemst/menu_id/{$mId}');" value=" Back " type="button">
											&nbsp;
									</td>
								</tr>
				    		</table>
				    	</td>
				    </tr>
					<tr align="right">
							<td colspan="2">
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
{add_script file="$_js/master.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>