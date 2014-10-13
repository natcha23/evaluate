{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_mstfrm" enctype="multipart/form-data"  onSubmit="">
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
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="chekSavemst();" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/index/menu_id/{$mId}');" value=" Back " type="button">
											&nbsp;
									</td>
								</tr>
				    			<tr>
									<td align="right" >
										<input type='hidden' name='save' id="save">
										<input type='hidden' name='mode' value="{$mode}">
										<input type="hidden" name="fields[mst_eva_level]" value="{$level}" >
										<input type="hidden" name="fields[mst_eva_id]" value="{$rows.mst_eva_id}" >
									</td>
								</tr>
								<tr>
									<td align="center">
										<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="98%" border="0" >
									    	<tr height="30">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">หัวข้อการประเมิน</td>
										    	<td class="font12"><input type="text" name="fields[mst_eva_name]" id="mst_eva_name" value="{$rows.mst_eva_name}" class="textfield_8c" maxLength=""></td>
									    	</tr>
									    	<tr height="30">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b" valign="top">รายละเอียดการประเมิน </td>
										    	<td>
										    		<TEXTAREA STYLE="width:300px; height:100px" name="fields[mst_eva_dsc]" id="mst_eva_dsc">{$rows.mst_eva_dsc}</TEXTAREA>
										    	</td>
									    	</tr>
									    	{if $level eq '1'}
									    	<tr  height="30">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">ประเภท </td>
										    	<td class="font12">
										    		<select name="fields[mst_eva_type]" id="mst_eva_type" class="selectBox10" >
														{html_options options=$typeOp selected=$rows.mst_eva_type}
													</select>
										    	</td>
									    	</tr>
											<tr height="30">
										    	<td width="2%">&nbsp;</td>
										    	<td align="left" width="15%" class="font11b">Order By</td>
										    	<td class="font12"><input type="text" name="fields[mst_eva_order]" id="mst_eva_order" value="{$rows.mst_eva_order}" class="textfield_2c" onKeyup="ckvNum(this);"></td>
									    	</tr>
									    	{/if}
									   </table>
									</td>
								</tr>
								<tr bgcolor="#EBEBEB">
									<td align="right" >
											{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="chekSavemst();" value=" Save " type="button">{/if}
											<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/index/menu_id/{$mId}');" value=" Back " type="button">
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
{add_script file="$_js/evaluate.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>