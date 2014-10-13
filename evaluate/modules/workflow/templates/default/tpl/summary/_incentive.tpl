{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_portal" enctype="multipart/form-data" >
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
				    			<tr bgcolor="#EBEBEB" height="25">
				    				<td class="font11" align="left" colspan="3" ><b>Month :</b>
				    					{if $typePage eq 'PI'}
				    					<select name="search[month]" id="month" class="selectBox10" >
											{html_options options=$monthOp selected=$month }
										</select>
										{else}
										<select name="search[quarter]" id="month" class="selectBox10">
											{html_options options=$quarterOp selected=$month }
										</select>
										{/if}
										<select name="search[year]" id="year" class="selectBox7"  >
											{html_options options=$yearOp selected=$year}
										</select>
										<input type="button" id="btn_search" class="btn_tools" value="   Search" name="btt_search" onclick="jsSearch();">

				    				</td>
						   			<td class="font11" align="right" colspan="5" >
						   				<b>Department :</b>
										<select name="group" id="group" {if $head_org}disabled{/if} class="selectBox25" onchange="jsChange(this.value);" >
										<option value="">-- Show all --</option>
											{html_options options=$groupBUOp selected=$group}
										</select>&nbsp;&nbsp;
						   			 </td>
					 			</tr>
					 			<tr bgcolor="#EBEBEB" height="25">
				    				<td class="font11" align="left" colspan="8">
				    					<table width="100%" border="0">
				    						<tr>
				    							{if $_profile->lookup_code eq 'AM'}
				    							<td align="left">
				    								{*<input type="button" id="btn_sync" class="btn_tools" value=" Sync" onclick="syncCurrentData('{$typePage}')" title="Sync data with current incentive & grade">*}
				    							</td>
				    							{/if}
				    							<td align="right">
				    							{if $dataArr}
												{if $_profile->lookup_code eq 'AM'}
												<input type="button" id="btn_export" class="btn_tools" value=" Export to Excel" onclick="jsExportExcel('{$typePage}')">
												<input type="button" id="btn_print" class="btn_tools" value=" Print Report" onclick="jsPrintReport('{$typePage}')">
												<input type="button" id="btn_export" class="btn_tools" value=" Export Average" onclick="jsExportExcel2('{$typePage}')">
												<!-- Add button export excel for hr format #natcha 10 Jun 2014 -->
												<!--input type="button" id="btn_export" class="btn_tools" value=" Export for payroll" onclick="exportHRSExcel('{$typePage}')"-->
												{*<input id="btn_list" title="Update Incentive" class="btn_tools" onclick="UpdateInc('pi','{$monthNow}');" value="  Update Incentive" type="button">*}
                                        		{/if}
				    							{/if}
				    							<!--input type="button" id="btn_analysis" class="btn_tools" value=" วิเคราะห์ข้อมูล" onclick="jsAnalysis('{$typePage}')"-->
				    							</td>
				    					
				    							
				    						</tr>
				    					</table>
				    				</td>
				    				
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="8%" align="center" >Emp. Code</td>
									<td class="font11b" width="20%" align="center" >Emp. Name</td>
									<td class="font11b" align="center" >Position</td>
									<td class="font11b" {if !$show}width="5%"{else}width="10%"{/if} align="center" >Level</td>
									{if !$show}
									<td class="font11b" width="10%" align="center" >Diff Score</td>
									<td class="font11b" width="10%" align="center" >Score</td>
									{/if}
									<td class="font11b" width="10%" align="center" >Grade</td>
									<td class="font11b" {if !$show}width="10%"{else}width="15%"{/if}align="center" >Incentive</td>
								</tr>

								{if $dataArr}
								{foreach from=$dataArr key=key item=depart}
									<tr height="20" bgcolor="#C6DCFF" >
										<td colspan="8" align="left" class="font12">&nbsp;{$depart.department}</td>
									</tr>
									{foreach from=$depart.user key=key1 item=item}
									{assign var="diff_scolll" value=$rowsArr[$key][$key1].mph_totalscoll-$rowsArr[$key].total}
										<tr height="20" {if $rowsArr[$key][$key1].re_inc eq 'N'}bgcolor="#FFE7F6"{else}bgcolor="{cycle values="#ffffff,#EBEBF5"}"{/if} >
											<td class="font11" align="center" >{if $item.user_code eq '1001'}-contact-{else}{$item.user_code}{/if}</td>
											<td align="left" class="font11" >
											{if $typePage eq 'MI'}
											<a href="javascript:app.gotoview('/workflow/evaluate/mifrm/user/{$item.user_code}/m/{$monthNow}/status/W');">{$item.user_name} {$item.user_lname}</a>
											{else}
											<a href="javascript:app.gotoview('/workflow/evaluate/pifrm/user/{$item.user_code}/m/{$monthNow}/status/W');">{$item.user_name} {$item.user_lname}</a>
											{/if}
											</td>
											<td align="left" class="font11" >{$item.org_position_name_th}</td>
											<td align="center" class="font11" >{$item.org_position_level}</td>
											{if !$show}
											<td align="right" class="font11">{if $diff_scolll < '0'}<font color="red">{$diff_scolll|number_format:2}</font>{else}{$diff_scolll|number_format:2}{/if}&nbsp;</td>
											<td align="right" class="font11">{if $rowsArr[$key][$key1].mph_grade eq 'A'}<font color="blue">{$rowsArr[$key][$key1].mph_totalscoll|number_format:2}</font>{else}{$rowsArr[$key][$key1].mph_totalscoll|number_format:2}{/if}&nbsp;</td>
											{/if}
											<td align="center" class="font11">{if $rowsArr[$key][$key1].mph_grade eq 'A'}<font color="blue">{$rowsArr[$key][$key1].mph_grade}</font>{else}{$rowsArr[$key][$key1].mph_grade}{/if}</td>
											<td align="right" class="font11">{$rowsArr[$key][$key1].incentive|number_format:2}&nbsp;</td>
										    <input type='hidden' name="update[{$item.user_code}][mph_level_now]" value='{$item.org_position_level}'>
                                            <input type='hidden' name="update[{$item.user_code}][mph_incentive]" value='{$rowsArr[$key][$key1].incentive}'>
                                        </tr>
									{/foreach}
									{if !$show}
									<tr height="20" bgcolor="#b9b9b9">
										<td colspan="5" align="right" class="font12b">Average Score&nbsp;</td>
										<td align="right" class="font12">{$incArr[$key].average_scoll|number_format:2}&nbsp;</td>
										<td align="right" class="font12b">Summary Total</td>
										<td align="right" class="font12">{$incArr[$key].sum_incentive|number_format:2}&nbsp;</td>
									</tr>
									{else}
									<tr height="20" bgcolor="#b9b9b9">
										<td colspan="5" align="right" class="font12b">Summary Total</td>
										<td align="right" class="font12">{$incArr[$key].sum_incentive|number_format:2}&nbsp;</td>
									</tr>
									{/if}
								{/foreach}
								{if !$show}
								<tr height="20" bgcolor="#b9b9b9">
									<td colspan="5" align="right" class="font12blue">Average Score&nbsp;</td>
									<td align="right" class="font12blue">{$totalArr.average_scoll|number_format:2}&nbsp;</td>
									<td align="right" class="font12blue" nowrap>Summary Total</td>
									<td align="right" class="font12blue">{$totalArr.sum_incentive|number_format:2}&nbsp;</td>
								</tr>
								{else}
								<tr height="20" bgcolor="#b9b9b9">
									<td colspan="5" align="right" class="font12blue">Summary Total</td>
									<td align="right" class="font12blue">{$totalArr.sum_incentive|number_format:2}&nbsp;</td>
								</tr>
								{/if}
								{/if}
				    		</table>
				    	</td>
				    </tr>
				    {if $dataArr}
					<tr bgcolor="#EBEBEB">
						<td align="left" >หมายเหตุ : รายการแถวสีชมพู หมายถึง รายการที่ยังไม่ถึงกำหนดรับ incentive</td>
						<td align="right" >
							{if $_profile->lookup_code eq 'AM'}
							
								<input type="button" id="btn_export" class="btn_tools" value=" Export to Excel" onclick="jsExportExcel('{$typePage}')">
								<input type="button" id="btn_print" class="btn_tools" value=" Print Report" onclick="jsPrintReport('{$typePage}')">
								<input type="button" id="btn_export" class="btn_tools" value=" Export Average" onclick="jsExportExcel2('{$typePage}')">
								<!-- Add button export excel for hr format #natcha 10 Jun 2014 -->
								<!--input type="button" id="btn_export" class="btn_tools" value=" Export for payroll" onclick="exportHRSExcel('{$typePage}')"-->
							
							{/if}
                            <input type="hidden" name="mph_month" value="{$monthNow}">
                            <input type="hidden" name="update_mode" id="update_mode">
				    	</td>
					</tr>
					{/if}
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
{add_script file="$_js/evaluate.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>