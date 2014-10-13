{include file="$g_template/_header.tpl"}

<div id="content-container">
<form method="post" action="" id="_portal" enctype="multipart/form-data" >
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        {*include file="$g_template/_menuleft.tpl"*}
			<!--td width="3" background="{$g_image}/form/line.jpg"><img src="{$g_image}/form/line.jpg" width="3" height="6" /></td-->
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
						   			<td class="font11" align="left" colspan="4" >&nbsp;<b>Select : </b>
										<select name="fields[type]" id="type" class="selectBox7" onchange="jsShowTime(this.value)" >
											{html_options options=$typeOp selected=$typenow}
										</select>
										<select name="fields[month]" id="month" class="selectBox10" >
											{html_options options=$monthOp selected=$monthNow }
										</select>
										<select name="fields[quarter]" id="quarter" class="selectBox10" style="display:none">
											{html_options options=$quarterOp selected=$monthNow }
										</select>
										<select name="fields[year]" id="year" class="selectBox7"  >
											{html_options options=$yearOp selected=$yearNow}
										</select>
										<input type="button" id="btn_search" class="btn_tools" value="   Search" name="btt_search" onclick="jsSearch();">
						   			 </td>
						   			<td class="font11" align="right" colspan="8" ><b>Department :</b>
										<select name="group" id="group" {if $head_org}disabled{/if} class="selectBox25" onchange="jsChange(this.value);" >
										<option value="">-- Show all --</option>
											{html_options options=$groupBUOp selected=$group}
										</select>
										&nbsp;&nbsp;
						   			 </td>
					 			</tr>
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="6%" align="center" >รหัส</td>
									<td class="font11b" width="15%" align="center" >ชื่อ - สกุล</td>
									<td class="font11b" width="15%" align="center" >Position</td>
									<td class="font11b" width="4%" align="center" >Level</td>
									{foreach from=$levelOp item=mName}
									<td class="font11b" align="center" width="5%">{$mName}</td>
									{/foreach}

								</tr>
								{if $dataArr}
								{foreach from=$dataArr key=key item=depart}
								<tr height="20" bgcolor="#FFE7BA" >
									<td colspan="12" align="left" class="font12">&nbsp;{$depart.department}</td>
								</tr>
								{foreach from=$depart.user key=key item=item}
								<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}" >
									<td class="font11" align="center" >{if $item.user_code eq '1001'}-contact-{else}{$item.user_code}{/if}</td>
									<td align="left" class="font11" id="txt_link_user"><!--a href="javascript:openEvaluate('MI','{$item.user_code}');"-->&nbsp;{$item.user_name} {$item.user_lname}<!--/a--></td>
									<td class="font11" align="left" >&nbsp;{$item.org_position_name_th}</td>
									<td class="font11" align="center" >{$item.org_position_level}</td>
									{foreach from=$levelOp key=keyM item=mName}
									<td align="center" >
									{if $mName eq $stepArr[$item.user_code].level_name}
										{if $stepArr[$item.user_code].mph_status eq 'C'}<img src="{$g_image}/button/blue13.jpg" border="0"  title="{$stepArr[$item.user_code].name_user_flow}">{/if}
										{if $stepArr[$item.user_code].mph_status eq 'P'}<img src="{$g_image}/button/pink13.jpg" border="0" title="{$stepArr[$item.user_code].name_user_flow}">{/if}
										{if $stepArr[$item.user_code].mph_status eq 'R'}<img src="{$g_image}/button/red13.jpg" border="0"  title="{$stepArr[$item.user_code].name_user_flow}">{/if}
										{if $stepArr[$item.user_code].mph_status eq 'F'}<img src="{$g_image}/button/green13.jpg" border="0" title="{$stepArr[$item.user_code].name_user_flow}">{/if}
									{/if}
									</td>
									{/foreach}
								</tr>
								{/foreach}
								{/foreach}
								{/if}
				    		</table>
				    	</td>
				    </tr>
			       <tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							{if $form_type eq 'MI'}
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/portalmi/form_id/{$form_id}/form_type/{$form_type}');" value="   Back " type="button">
							{elseif $form_type eq 'PI'}
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/portalpi/form_id/{$form_id}/form_type/{$form_type}');" value="   Back " type="button">
							{/if}
							&nbsp;
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
{add_script file="$_js/evaluate.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>
<script>
	var typeshow = '{$typenow}';
	jsShowTime(typeshow);

</script>