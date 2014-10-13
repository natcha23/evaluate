{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_levelfrm" enctype="multipart/form-data">
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
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="chekSubmitLevel('{$grid}');" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openLevelGrade('{$grade}','{$grid}');" value=" Back " type="button">
											&nbsp;
									</td>
								</tr>
				    			<tr>
									<td align="right" >
										<input type='hidden' name='save' id="save">
										<input type='hidden' name='mode' value="{$mode}">
										<input type="hidden" name="grade" value="{$grid}" >
										<input type="hidden" name="fields[lv_id]" value="{$rows.lv_id}" >
									</td>
								</tr>
				    			<tr>
									<td align="center" >
										<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">เกรด</td>
										    	<td class="font12">{$grade}</td>
									    	</tr>


									    	<tr height="20">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">กลุ่มพนักงาน</td>
										    	<td class="font12">
										    	{html_radios name="fields[lv_shotname]" id="lv_shotname" options=$groupOp checked=$rows.lv_shotname}

										    	</td>
									    	</tr>
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Code ระดับ</td>
										    	<td class="font12">
											    	<!--input type="text" name="fields[lv_code]" id="lv_code" value="{$rows.lv_code}" class="textfield_2c" maxLength="2" onKeyup="ckvNum(this);"-->
											    	<select name="fields[lv_code]" id="lv_code" class="selectBox7"  >
											    	<option value="">- Select -</option>
														{html_options options=$levelOp selected=$rows.lv_code}
													</select>
										    	</td>
									    	</tr>
									    	<!--tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">ชื่อเต็ม</td>
										    	<td class="font12"><input type="text" name="fields[lv_fullname]" id="lv_fullname" value="{$rows.lv_fullname}" class="textfield_5c" ></td>
									    	</tr-->
									    	<tr>
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">รายได้ (บาท)</td>
										    	<td class="font12"><input type="text" name="fields[money]" id="money" value="{$rows.money}" class="textfield_5c" onKeyup="ckvNum(this);"></td>
									    	</tr>

									   </table>
									</td>
								</tr>
								<tr bgcolor="#EBEBEB">
									<td align="right" >
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="chekSubmitLevel('{$grid}');" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openLevelGrade('{$grade}','{$grid}');" value=" Back " type="button">
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