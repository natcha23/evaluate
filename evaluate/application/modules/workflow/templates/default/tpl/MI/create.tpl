{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_create" enctype="multipart/form-data">
<input type='hidden' name='mode' id="mode">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        {*include file="$g_template/_menuleft.tpl"*}

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
					  <tr bgcolor="#EBEBEB">
							<td colspan="2" align="right" >
								{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="chkSaveSubmit('MI','{$frmRow.form_id}');" value=" Save " type="button">{/if}
								<input id="btn_refresh" title="Clear" class="btn_tools" value=" Clear " type="reset">
								<input id="btn_list" title="Portal" class="btn_tools" onclick="openPage('workflow/evaluate/portalmi/form_id/{$frmRow.form_id}/form_type/MI');" value=" Portal " type="button">
								<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/form/display');" value=" Back " type="button">
								&nbsp;
							</td>
					  </tr>
			          <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr height="20" valign="top" >
				    				<td class="font11b" align="left" width="15%">&nbsp; เลขที่แบบประเมิน </td>
				    				<td class="font12b" align="left" >{$frmRow.form_code}
				    				</td>
				    			</tr>
				    			<tr height="25">
				    				<td class="font11b" align="left" width="15%">&nbsp; ใบประเมินประจำเดือน </td>
				    				<td class="font11b" align="left" >
				    					<select name="fields[month]" id="month" class="selectBox10"  >
				    					<option value="">- Select -</option>
											{html_options options=$_monthMIOp selected=$monthNow1}
										</select>
										&nbsp;&nbsp; ปี &nbsp;
										<select name="fields[year]" id="year" class="selectBox7"  >
											{html_options options=$yearOp selected=$yearNow}
										</select>
									</td>
				    			</tr>
				    			<tr height="20" valign="top" >
				    				<td class="font11b" align="left" width="15%">&nbsp; Evaluate Objective </td>
				    				<td class="font11b" align="left" >
				    					<input type="hidden" name="fields[form_code]" value="{$frmRow.form_code}">
				    					<textarea name="fields[mph_objective]" rows="7" readonly id="mph_objective" class="textfield_10c" >{$frmRow.form_objective}</textarea>
				    				</td>
				    			</tr>
				    			<tr height="20" valign="top" bgcolor="#F2F2F2" >
				    				<td class="font11b" align="left" colspan="2" width="15%">&nbsp; กำหนดหัวข้อการประเมิน </td>
				    			</tr>
				    			<tr height="25" valign="top" id="_show1">
				    				<td class="font11b" align="left" width="15%"></td>
				    				<td class="font11b" align="left" >
				    					<table valign="top" cellpadding="0" cellspacing="1" width="98%" border="0">
				    						<tr height="25" class="font11b"><td colspan="2">เลือกรายการประเมิน</td></tr>
				    						<tr height="20">
				    						{assign var=i value=0}
				    						{foreach from=$evaluate item=item key=key}
				    						{assign var=i value=$i+1}
				    							<td align="center" width="2%"><input type='checkbox' name='fields[subject][{$item.mst_eva_id}]' id="{$item.mst_eva_id}" value='{$item.mst_eva_name}'></td>
				    							<td align="left" width="22%">
					    							{$item.mst_eva_name}
				    							</td>
				    						{if $i%4 eq 0}<tr><td ></td></tr>{/if}
				    						{/foreach}
				    						</tr>
				    					</table>
				    				</td>
				    			</tr>
				    			<tr height="20" valign="top" bgcolor="#F2F2F2" >
				    				<td class="font11b" align="left" colspan="2" width="15%">&nbsp; กำหนดผู้ใช้ฟอร์มประเมิน </td>
				    			</tr>
				    			<tr height="25" valign="top" id="_show2">
				    				<td class="font11b" align="left" width="15%"></td>
				    				<td class="font11b" align="left" >
				    					<table valign="top" cellpadding="0" cellspacing="1" width="98%" border="0">
				    						<tr height="25" class="font11b"><td colspan="2"><input type="button" name="add" value=" เลือกผู้ใช้ฟอร์มประเมิน " onclick="openPopup('workflow/evaluate/userpopup');"></td></tr>
				    						<tr>
				    							<td>
				    								<textarea name="user_eva" rows="7" id="user_name" class="textfield_10c" readonly></textarea>
				    								<input type='hidden' name='fields[user_code]' id="user_code">
												</td>
				    						</tr>

				    					</table>
				    				</td>
				    			</tr>
				    			<tr height="20" valign="top" bgcolor="#F2F2F2" >
				    				<td class="font11b" align="left" width="15%">&nbsp; ผู้ใช้ฟอร์ม เริ่มต้น </td>
				    				<td class="font11b" align="left" >

				    					<select name="fields[mph_sflow]" id="mph_sflow" class="selectBox7"  >
				    					<option value="">-Select-</option>
											{html_options options=$levelOp selected=$yearNow}
										</select>
										&nbsp;&nbsp; ผู้ใช้ฟอร์มสิ้นสุด &nbsp;
										<select name="fields[mph_eflow]" id="mph_eflow" class="selectBox7"  >
										<option value="">-Select-</option>
											{html_options options=$levelOp selected=$yearNow}
										</select>
				    			</tr>
				    			<tr height="20" valign="top" bgcolor="#F2F2F2" >
				    				<td class="font11b" align="left" colspan="2" width="15%">&nbsp; กำหนดผู้รับใบประเมิน </td>
				    			</tr>
				    			<tr height="25" valign="top" id="_show3">
				    				<td class="font11b" align="left" width="15%"></td>
				    				<td class="font11b" align="left" >
				    					<table valign="top" cellpadding="0" cellspacing="1" width="98%" border="0">
				    						<tr height="25" class="font11b"><td colspan="2">เลือกผู้รับใบประเมิน</td></tr>
				    						<tr height="20">
				    							<td colspan="2" class="font12">
										    		<select name="fields[user_rec]" id="user_rec" class="selectBox6cm" >
													<option value="">-- Please select --</option>
													{html_options options=$userRecive selected=$rows.user_rec}
													</select>
										    	</td>
				    						{*{assign var=r value=0}
				    						{foreach from=$userRecive item=row key=key}
				    						{assign var=r value=$r+1}
				    							<td align="center" width="2%"><input type='radio' name='fields[user_rec]' id="{$row.user_code}" value='{$row.user_code}'></td>
				    							<td align="left" width="22%">{$row.user_name}</td>
				    						{if $r%4 eq 0}<tr><td ></td></tr>{/if}
				    						{/foreach}*}
				    						</tr>
				    					</table>
				    				</td>
				    			</tr>
				    			<tr ><td colspan="2"height="20"></td></tr>
							    <tr bgcolor="#EBEBEB">
									<td colspan="2" align="right" >
										{if $mode neq 'view'}<input id="btn_save" title="Save" class="btn_tools" onclick="chkSaveSubmit('MI','{$frmRow.form_id}');" value=" Save " type="button">{/if}
										<input id="btn_refresh" title="Clear" class="btn_tools" value=" Clear " type="reset">
										<input id="btn_list" title="Portal" class="btn_tools" onclick="openPage('workflow/evaluate/portalmi/form_id/{$frmRow.form_id}/form_type/MI');" value=" Portal " type="button">
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
{add_script file="$_js/evaluate.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>