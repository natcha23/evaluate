{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_portal" enctype="multipart/form-data">
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
					  <tr bgcolor="#EBEBEB" height="25">
			   			<td class="font11" align="right" colspan="4" ><b>Department :</b>
							<select name="group" id="group" {if $head_org}disabled{/if} class="selectBox22" onchange="jsChange(this.value);" >
							<option value="">-- Show all --</option>
								{html_options options=$groupBUOp selected=$group}
							</select>
							&nbsp;&nbsp;
			   			 </td>
		 			</tr>
			         {if $typePage eq 'MI'}
			          <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="7%" rowspan="2" align="center" >รหัส</td>
									<td class="font11b" width="15%" rowspan="2" align="center" >ชื่อ - สกุล </td>
									<!--td class="font11b" width="15%" rowspan="2" align="center" >Position</td-->
									<td class="font11b" width="4%" rowspan="2" align="center" >Level</td>
									{foreach from=$monthOp key=keyM item=mName}
									<td class="font11b" align="center" {if $monthNow eq $keyM}bgcolor="#DDFFA7"{/if} colspan="4">{$mName}</td>
									{/foreach}
								</tr>
								<tr height="20" bgcolor="#B2B3B5">
									{foreach from=$monthOp item=mName}
									<td align="center" class="font11b" width="5%">Create</td>
									<td align="center" class="font11b" width="5%">Process</td>
									<td align="center" class="font11b" width="5%">Delay</td>
									<td align="center" class="font11b" width="5%">Finish</td>
									{/foreach}
								</tr><!--bgcolor="{cycle values="#ffffff,#F5F6F7"}"-->
								{if $dataArr}
								{foreach from=$dataArr key=key item=depart}
								<tr height="20" bgcolor="#FFE7BA" >
									<td colspan="20" align="left" class="font12">&nbsp;{$depart.department}</td>
								</tr>
								{foreach from=$depart.user key=key item=item}
								<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}" >
									<td class="font11" align="center" >{if $item.user_code eq '1001'}-contact-{else}{$item.user_code}{/if}</td>
									<!--td align="left" class="font11" id="txt_link_user"><a href="javascript:openEvaluate('MI','{$item.user_code}');">&nbsp;{$item.user_name}</a></td-->
									<td align="left" class="font11" >&nbsp;{$item.user_name} {*$item.user_lname*}</td>
									<!--td class="font11" align="left" >&nbsp;{$item.org_position_name_th}</td-->
									<td class="font11" align="center" >{$item.org_position_level}</td>
									{foreach from=$monthOp key=keyM item=mName}
									{assign var=mph_user_flow value=$rowsArr[$item.user_code][$keyM].mph_user_flow}
									<td align="center" >{if $rowsArr[$item.user_code][$keyM].mph_status eq 'C'}<img src="{$g_image}/button/blue13.jpg" border="0" title="{$userOp[$mph_user_flow].user_name}">{/if}</td>
									<td align="center" >{if $rowsArr[$item.user_code][$keyM].mph_status eq 'P'}<img src="{$g_image}/button/pink13.jpg" border="0" title="{$userOp[$mph_user_flow].user_name}">{/if}</td>
									<td align="center" >{if $rowsArr[$item.user_code][$keyM].mph_status eq 'R'}<img src="{$g_image}/button/red13.jpg" border="0" title="{$userOp[$mph_user_flow].user_name}">{/if}</td>
									<td align="center" >{if $rowsArr[$item.user_code][$keyM].mph_status eq 'F'}<img src="{$g_image}/button/green13.jpg" border="0" title="{$userOp[$mph_user_flow].user_name}">{/if}</td>
									{/foreach}
								</tr>
								{/foreach}
								{/foreach}
								{/if}
				    		</table>
				    	</td>
				    </tr>
				    {else}
				    <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="7%" rowspan="2" align="center" >รหัส</td>
									<td class="font11b" width="15%" rowspan="2" align="center" >ชื่อ - สกุล</td>
									<!--td class="font11b" width="15%" rowspan="2" align="center" >Position</td-->
									<td class="font11b" width="4%" rowspan="2" align="center" >Level</td>
									{foreach from=$monthOp key=keyM item=mName}
									<td class="font11b" align="center" {if $monthNow eq $keyM}bgcolor="#DDFFA7"{/if} colspan="4">{$mName}</td>
									{/foreach}
								</tr>
								<tr height="20" bgcolor="#B2B3B5">
									{foreach from=$monthOp item=mName}
									<td align="center" class="font11b" width="5%">Create</td>
									<td align="center" class="font11b" width="5%">Process</td>
									<td align="center" class="font11b" width="5%">Delay</td>
									<td align="center" class="font11b" width="5%">Finish</td>
									{/foreach}
								</tr><!--bgcolor="{cycle values="#ffffff,#F5F6F7"}"-->
								{if $dataArr}
								{foreach from=$dataArr key=key item=depart}
								<tr height="20" bgcolor="#FFE7BA" >
									<td colspan="20" align="left" class="font12">&nbsp;{$depart.department}</td>
								</tr>
								{foreach from=$depart.user key=key item=item}
								<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}" >
									<td class="font11" align="center" >{if $item.user_code eq '0'}-contact-{else}{$item.user_code}{/if}</td>
									<!--td align="left" class="font11" id="txt_link_user"><a href="javascript:openEvaluate('PI','{$item.user_code}');">&nbsp;{$item.user_name}</a></td-->
									<td align="left" class="font11">&nbsp;{$item.user_name} {*$item.user_lname*}</td>
									<!--td class="font11" align="left" >&nbsp;{$item.org_position_name_th}</td-->
									<td class="font11" align="center" >{$item.org_position_level}</td>
									{foreach from=$monthOp key=keyM item=mName}
									{assign var=mph_user_flow value=$rowsArr[$item.user_code][$keyM].mph_user_flow}
									<td align="center" >{if $rowsArr[$item.user_code][$keyM].mph_status eq 'C'}<img src="{$g_image}/button/blue13.jpg" border="0" title="{$userOp[$mph_user_flow].user_name}">{/if}</td>
									<td align="center" >{if $rowsArr[$item.user_code][$keyM].mph_status eq 'P'}<img src="{$g_image}/button/pink13.jpg" border="0" title="{$userOp[$mph_user_flow].user_name}">{/if}</td>
									<td align="center" >{if $rowsArr[$item.user_code][$keyM].mph_status eq 'R'}<img src="{$g_image}/button/red13.jpg" border="0" title="{$userOp[$mph_user_flow].user_name}">{/if}</td>
									<td align="center" >{if $rowsArr[$item.user_code][$keyM].mph_status eq 'F'}<img src="{$g_image}/button/green13.jpg" border="0" title="{$userOp[$mph_user_flow].user_name}">{/if}</td>
									{/foreach}
								</tr>
								{/foreach}
								{/foreach}
								{/if}
				    		</table>
				    	</td>
				    </tr>
				    {/if}
					<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							{if !$show eq 'N'}
								<input id="btn_list" title="View" class="btn_tools" onclick="openPage('workflow/evaluate/portal/form_id/{$form_id}/form_type/{$form_type}');" value=" Process " type="button">
								{if $form_type eq MI}
								<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/createmi/form_id/{$form_id}/form_type/{$form_type}');" value="  Back " type="button">
								{else}
								<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/createpi/form_id/{$form_id}/form_type/{$form_type}');" value="  Back " type="button">
								{/if}
							{/if}<input type="hidden" name="show" value="{$show}">
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