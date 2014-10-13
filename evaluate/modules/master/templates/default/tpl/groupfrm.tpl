{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_groupfrm" enctype="multipart/form-data">
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
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="chekSubmitGroup();" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/master/group');" value=" Back " type="button">
											&nbsp;
									</td>
								</tr>
				    			<tr>
									<td align="right" >
										<input type='hidden' name='save' id="save">
										<input type='hidden' name='mode' value="{$mode}">
										<input type="hidden" name="fields[l_id]" value="{$rows.l_id}" >
									</td>
								</tr>
								<tr>
									<td align="center" >
										<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">ชื่อย่อ Group</td>
										    	<td class="font12"><input type="text" name="fields[l_shotname]" id="l_shotname" value="{$rows.l_shotname}" class="textfield_3c" maxLength="10"></td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">ชื่อเต็ม Group</td>
										    	<td class="font12"><input type="text" name="fields[l_fullname]" id="l_fullname" value="{$rows.l_fullname}" class="textfield_10c" ></td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">หมายเหตุ</td>
										    	<td class="font12"><textarea name="fields[g_desc]" id="g_desc" rows="5" class="textfield_10c">{$rows.g_desc}</textarea></td>
									    	</tr>
                                            <tr>
                                                <td width="2%">&nbsp;</td>
                                                <td align="left" width="15%" class="font11b">Order by</td>
                                                <td class="font12"><input type="text" name="fields[l_order]" id="l_order" value="{$rows.l_order}" class="textfield_3c" onKeyup="ckvNum(this);" maxLength="2"></td>
                                            </tr>

									   </table>
									</td>
								</tr>
								<tr bgcolor="#EBEBEB">
									<td align="right" >
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="chekSubmitGroup();" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/master/group');" value=" Back " type="button">
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