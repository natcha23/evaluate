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
				    		<table id="list-content"bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#EBEBEB" height="25">
						   			<td class="font11" align="left" colspan="4" ><b>Month :</b>
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
						   			<td class="font11" align="right" colspan="5" ><b>Department :</b>
										<select name="group" id="group" class="selectBox22" onchange="jsChange(this.value);" >
										<option value="">-- Show all --</option>
											{html_options options=$groupBUOp selected=$group}
										</select>&nbsp;&nbsp;
						   			 </td>
					 			</tr>
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" align="center" width="3%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
									<td class="font11b" width="8%" align="center" >Emp. Code</td>
									<td class="font11b" width="20%" align="center" >Emp. Name</td>
									<td class="font11b" align="center" >Position</td>
									<td class="font11b" width="5%" align="center" >Level</td>
									<td class="font11b" width="10%" align="center" >Diff Score</td>
									<td class="font11b" width="10%" align="center" >Score</td>
									<!-- natcharee close temporary -->
									{if $lookup_code == 'AM' || $_profile->level >= 11}
									<td class="font11b" width="10%" align="center" >Grade</td>
									<td class="font11b" width="10%" align="center" >Incentive</td>
									{/if}
								</tr>
								{if $rowsArr}
								{foreach from=$dataArr key=key item=depart}
									<tr height="20" bgcolor="#C6DCFF" >
										<td align="center" ><input type='checkbox' name="checkDep" class="border0" id="dep_{$key}" onclick="selectChkSub(this,'{$key}');"></td>
										<td colspan="8" align="left" class="font12">&nbsp;{$depart.department}</td>
									</tr>
									{foreach from=$depart.user key=key1 item=item}
									{assign var="diff_scolll" value=$rowsArr[$key][$key1].mph_totalscoll-$rowsArr[$key].total}
										<tr height="20" {if $rowsArr[$key][$key1].re_inc eq 'N'}bgcolor="#FFE7F6"{else}bgcolor="{cycle values="#ffffff,#EBEBF5"}"{/if} >
											<td align="center" ><input type='checkbox' name="check[{$item.user_code}][user_code]" class="border0" id="chk_{$key}_{$item.user_code}" value='{$rowsArr[$key][$key1].mph_id}' onclick="ChkHead(this,'{$key}');"></td>
											<td class="font11" align="center" >{if $item.user_code eq '1001'}-contact-{else}{$item.user_code}{/if}</td>
											<td align="left" class="font11" >
												{if $lookup_code == 'AM' || $_profile->level >= 9}
												<a href="#" onclick="openPageEvaluate('{$rowsArr[$key][$key1].mph_type}','{$rowsArr[$key][$key1].mph_id}','{$rowsArr[$key][$key1].mph_user}','{$rowsArr[$key][$key1].mph_month}','A');">{$item.user_name} {$item.user_lname}</a>
												{else}
												{$item.user_name} {$item.user_lname}
												{/if}
											</td>
											<td align="left" class="font11" >{$item.org_position_name_th}</td>
											<td align="center" class="font11" >{$item.org_position_level}</td>
											<!--td align="right" class="font11">{if $rowsArr[$key1].diff_scoll < '0'}<font color="red">{$rowsArr[$key1].diff_scoll|number_format:2}</font>{else}{$rowsArr[$key1].diff_scoll|number_format:2}{/if}&nbsp;</td-->
											<td align="right" class="font11">{if $diff_scolll < '0'}<font color="red">{$diff_scolll|number_format:2}</font>{else}{$diff_scolll|number_format:2}{/if}&nbsp;</td>
											<td align="right" class="font11">{if $rowsArr[$key][$key1].mph_grade eq 'A'}<font color="blue">{$rowsArr[$key][$key1].mph_totalscoll|number_format:2}</font>{else}{$rowsArr[$key][$key1].mph_totalscoll|number_format:2}{/if}&nbsp;</td>
											<!-- natcharee close temporary -->
												<input type='hidden' name="check[{$item.user_code}][user_code]" value='{$rowsArr[$key][$key1].mph_user}'>
												<input type='hidden' name="check[{$item.user_code}][grade]" value='{$rowsArr[$key][$key1].mph_grade}'>
												<input type='hidden' name="check[{$item.user_code}][mph_id]" value='{$rowsArr[$key][$key1].mph_id}'>
												<input type='hidden' name="check[{$item.user_code}][mph_column]" value='{$rowsArr[$key][$key1].mph_column}'>
												<input type='hidden' name="check[{$item.user_code}][mph_eflow]" value='{$rowsArr[$key][$key1].mph_eflow}'>
                                                <input type='hidden' name="check[{$item.user_code}][mph_level_now]" value='{$item.org_position_level}'>
                                                <input type='hidden' name="check[{$item.user_code}][mph_incentive]" value='{$rowsArr[$key][$key1].incentive}'>
                                                
                                                
											{if $lookup_code == 'AM' || $_profile->level >= 11}
											<td align="center" class="font11">{if $rowsArr[$key][$key1].mph_grade eq 'A'}<font color="blue">{$rowsArr[$key][$key1].mph_grade}</font>{else}{$rowsArr[$key][$key1].mph_grade}{/if}
<!-- 												<input type='hidden' name="check[{$item.user_code}][user_code]" value='{$rowsArr[$key][$key1].mph_user}'> -->
<!-- 												<input type='hidden' name="check[{$item.user_code}][grade]" value='{$rowsArr[$key][$key1].mph_grade}'> -->
<!-- 												<input type='hidden' name="check[{$item.user_code}][mph_id]" value='{$rowsArr[$key][$key1].mph_id}'> -->
<!-- 												<input type='hidden' name="check[{$item.user_code}][mph_column]" value='{$rowsArr[$key][$key1].mph_column}'> -->
<!-- 												<input type='hidden' name="check[{$item.user_code}][mph_eflow]" value='{$rowsArr[$key][$key1].mph_eflow}'> -->
<!--                                                 <input type='hidden' name="check[{$item.user_code}][mph_level_now]" value='{$item.org_position_level}'> -->
<!--                                                 <input type='hidden' name="check[{$item.user_code}][mph_incentive]" value='{$rowsArr[$key][$key1].incentive}'> -->
											</td>
											
											<td align="right" class="font11">{$rowsArr[$key][$key1].incentive|number_format:2}&nbsp;
<!-- 	                                            <input type='hidden' name="update[{$item.user_code}][mph_level_now]" value='{$item.org_position_level}'> -->
<!-- 	                                            <input type='hidden' name="update[{$item.user_code}][mph_incentive]" value='{$rowsArr[$key][$key1].incentive}'> -->
                                            </td>
                                            {/if}
                                            
                                            	<input type='hidden' name="update[{$item.user_code}][mph_level_now]" value='{$item.org_position_level}'>
	                                            <input type='hidden' name="update[{$item.user_code}][mph_incentive]" value='{$rowsArr[$key][$key1].incentive}'>
										</tr>
									{/foreach}
									<tr height="20" bgcolor="#b9b9b9">
										<td colspan="6" align="right" class="font12b">Average Score&nbsp;</td>
										<td align="right" class="font12">{$incArr[$key].average_scoll|number_format:2}&nbsp;</td>
										<!-- natcharee close temporary -->
										{if $lookup_code == 'AM' || $_profile->level >= 11}
										<td align="right" class="font12b" nowrap>Summary Total</td>
										<td align="right" class="font12">{$incArr[$key].sum_incentive|number_format:2}&nbsp;</td>
										{/if}
									</tr>
								{/foreach}
								<tr height="20" bgcolor="#b9b9b9">
									<td colspan="6" align="right" class="font12blue">Average Score&nbsp;</td>
									<td align="right" class="font12blue">{$totalArr.average_scoll|number_format:2}&nbsp;</td>
									<!-- natcharee close temporary -->
									{if $lookup_code == 'AM' || $_profile->level >= 11}
									<td align="right" class="font12blue" nowrap>Summary Total</td>
									<td align="right" class="font12blue">{$totalArr.sum_incentive|number_format:2}&nbsp;</td>
									{/if}
								</tr>
								{else}
								<tr height="20" bgcolor="#FFE7BA" >
									<td colspan="9" align="center" class="font12blue">Data Empty !!!!</td>
								</tr>
								{/if}
				    		</table>
				    	</td>
				    </tr>
			       <tr bgcolor="#EBEBEB">
						<td align="left" >หมายเหตุ : รายการแถวสีชมพู หมายถึง รายการที่ยังไม่ถึงกำหนดรับ incentive</td>
						<td align="right" >
						{if $rowsArr}
							{if $lookup_code == 'AM'}
								<input type='hidden' name="lookup_code" value='{$lookup_code}'>
								<input id="btn_list" title="Finish by detail (Please select data.)" class="btn_tools" onclick="approveDetail('pi');" value="  Finish by detail" type="button">
								<input id="btn_accept" title="Finish All" class="btn_tools" onclick="acceptDataToSave('F','pi');" value="  Finish All" type="button">
							{else}
								{if $_profile->level_name eq $endflow}
									<input id="btn_list" title="Approve by detail (Please select data.)" class="btn_tools" onclick="approveDetail('pi');" value="  Approve by detail" type="button">
									<input id="btn_accept" title="Approve All" class="btn_tools" onclick="acceptDataToSave('F','pi');" value="  Approve All" type="button">
								{else}
									{if $lookup_code != 'AM'}
										<input id="btn_list" title="Accept by detail (Please select data.)" class="btn_tools" onclick="approveDetail('pi');" value="  Accept by detail" type="button">						
										<input id="btn_sent" title="Send All" class="btn_tools" onclick="openPopup('workflow/evaluate/userpopup/pageview/pi/accept/Y');" value="  Send All " type="button">
										{if $level>11}
										<input id="btn_accept" title="Approve All" class="btn_tools" onclick="acceptDataToSave('F','pi');" value="  Approve All" type="button">
										{/if}
									{/if}
								{/if}
							{/if}
						{/if}
                           {* <input id="btn_list" title="Update Incentive" class="btn_tools" onclick="UpdateInc('pi','{$monthNow}');" value="  Update Incentive" type="button">*}
							<!--input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/portalpi/form_id/{$form_id}/form_type/{$form_type}');" value="  Back " type="button"-->
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
<input type="hidden" name="user_recive" id="user_recive" value="{$_profile->user_code}">
<input type="hidden" name="user_send" id="user_send" value="{$_profile->user_code}">
<input type="hidden" name="mph_month" id="mph_month" value="{$monthNow}">
<input type="hidden" name="update_mode" id="update_mode">

</table>
{add_script file="$_js/evaluate.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>
<script>
	var typeshow = '{$typenow}';
	{literal}
	jsShowTime(typeshow);

	// Toggle button approve all & finish all
	$('#list-content').find('input:checkbox').click(function(key, item) {

		$(this).each(function(key, item) {
			// Checked select box in list.
			if( $('input[type="checkbox"]:checked').length > 0 ) {
				// Disabled button.
				$('#btn_accept').attr('disabled', 'disabled');
			} else {
				// Enabled button.
				$('#btn_accept').attr('disabled', '');
			}
		});

	});

	
	{/literal}
</script>