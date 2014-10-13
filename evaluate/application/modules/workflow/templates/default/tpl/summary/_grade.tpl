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
			         {if $typePage eq 'MI'}
			          <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#cccccc" height="25">
						   			<td class="font11" align="left" colspan="3" ><b>Select : </b>
										<select name="typeEva" id="type" class="selectBox7" onchange="jsChange(this.value);" >
											{html_options options=$typeOp selected=$typePage}
										</select>
										<!--input type="button" class="button" value="Search" name="btt_search" onclick="jsSearch();"-->
						   			 </td>
						   			<td class="font11" align="right" colspan="10" ><b>Department :</b>
										<select name="group" id="group" {if $head_org}disabled{/if} class="font12" onchange="jsChange(this.value);" >
										<option value="">-- Show all --</option>
											{html_options options=$groupBUOp selected=$group}
										</select>
						   			 </td>
					 			</tr>
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="5%" rowspan="2" align="center" >รหัส</td>
									<td class="font11b" width="15%" rowspan="2" align="center" >ชื่อ - สกุล</td>
									<td class="font11b" width="15%" rowspan="2" align="center" >Position</td>
									<td class="font11b" width="4%" rowspan="2" align="center" >Level</td>
									{foreach from=$monthOp key=keyM item=mName}
									<td class="font11b" colspan="2" {if $monthNow eq $keyM}bgcolor="#DDFFA7"{/if} align="center" >{$mName}</td>
									{/foreach}
								</tr>
								<tr height="20" bgcolor="#B2B3B5">
									{foreach from=$monthOp item=mName}
									<td align="center" class="font11b" width="5%">เกรด</td>
									<td align="center" class="font11b" width="6%">คะแนน</td>
									{/foreach}
								</tr>
								{if $dataArr}
								{foreach from=$dataArr key=key item=depart}
								<tr height="20" bgcolor="#FFE7BA" >
									<td colspan="12" align="left" class="font12">&nbsp;{$depart.department}</td>
								</tr>
								{foreach from=$depart.user key=key item=item}
								<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}" >
									<td class="font12" align="center" >{$item.user_code}</td>
									<td align="left" class="font12" >&nbsp;{$item.user_name} {*$item.user_lname*}</td>
									<td class="font11" align="left" >&nbsp;{$item.org_position_name_th}</td>
									<td class="font11" align="center" >{$item.org_position_level}</td>
									{foreach from=$monthOp key=keyM item=mName}
									{assign var="mph_grade" value=$rowsArr[$item.user_code][$keyM].mph_grade}
									<td align="center" >
										{if $mph_grade eq 'A'}
										<div class="font12BL">{$rowsArr[$item.user_code][$keyM].mph_grade}</div>
										{elseif $mph_grade eq 'F'}
										<div class="font12R">{$rowsArr[$item.user_code][$keyM].mph_grade}</div>
										{else}
										<div class="font12">{$rowsArr[$item.user_code][$keyM].mph_grade}</div>
										{/if}
									</td>
									<td align="right" >
										{if $mph_grade eq 'A'}
										<div class="font12BL">{$rowsArr[$item.user_code][$keyM].mph_totalscoll|number_format:2}&nbsp;</div>
										{elseif $mph_grade eq 'F'}
										<div class="font12R">{$rowsArr[$item.user_code][$keyM].mph_totalscoll|number_format:2}&nbsp;</div>
										{else}
										<div class="font12">{$rowsArr[$item.user_code][$keyM].mph_totalscoll|number_format:2}&nbsp;</div>
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
				    {else}
				    <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#cccccc" height="25">
						   			<td class="font11" align="left" colspan="3" ><b>Select : </b>
										<select name="typeEva" id="type" class="selectBox7" onchange="jsChange(this.value);" >
											{html_options options=$typeOp selected=$typePage}
										</select>
										<!--input type="button" class="button" value="Search" name="btt_search" onclick="jsSearch();"-->
						   			 </td>
						   			<td class="font11" align="right" colspan="11" ><b>Department :</b>
										<select name="group" id="group" {if $head_org}disabled{/if} class="font12" onchange="jsChange(this.value);" >
										<option value="">-- Show all --</option>
											{html_options options=$groupBUOp selected=$group}
										</select>
						   			 </td>
					 			</tr>
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="5%" rowspan="2" align="center" >รหัส</td>
									<td class="font11b" width="15%" rowspan="2" align="center" >ชื่อ - สกุล</td>
									<td class="font11b" width="15%" rowspan="2" align="center" >Position</td>
									<td class="font11b" width="4%" rowspan="2" align="center" >Level</td>
									{foreach from=$monthOp key=keyM item=mName}
									<td class="font11b" colspan="2" {if $monthNow eq $keyM}bgcolor="#DDFFA7"{/if} align="center" >{$mName}</td>
									{/foreach}
								</tr>
								<tr height="20" bgcolor="#B2B3B5">
									{foreach from=$monthOp item=mName}
									<td align="center" class="font11b" width="5%">เกรด</td>
									<td align="center" class="font11b" width="5%">คะแนน</td>
									{/foreach}
								</tr>
								{if $dataArr}
								{foreach from=$dataArr key=key item=depart}
								<tr height="20" bgcolor="#FFE7BA" >
									<td colspan="14" align="left" class="font12">&nbsp;{$depart.department}</td>
								</tr>
								{foreach from=$depart.user key=key item=item}
								<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}" >
									<td class="font12" align="center" >{if $item.user_code eq '1001'}-contact-{else}{$item.user_code}{/if}</td>
									<td align="left" class="font12" >&nbsp;{$item.user_name}</td>
									<td class="font11" align="left" >&nbsp;{$item.org_position_name_th}</td>
									<td class="font11" align="center" >{$item.org_position_level}</td>
									{foreach from=$monthOp key=keyM item=mName}
									{assign var="mph_grade" value=$rowsArr[$item.user_code][$keyM].mph_grade}
									<td align="center" >
										{if $mph_grade eq 'A'}
										<div class="font12BL">{$rowsArr[$item.user_code][$keyM].mph_grade}</div>
										{elseif $mph_grade eq 'F'}
										<div class="font12R">{$rowsArr[$item.user_code][$keyM].mph_grade}</div>
										{else}
										<div class="font12">{$rowsArr[$item.user_code][$keyM].mph_grade}</div>
										{/if}
									</td>
									<td align="right" >
										{if $mph_grade eq 'A'}
										<div class="font12BL">{$rowsArr[$item.user_code][$keyM].mph_totalscoll|number_format:2}&nbsp;</div>
										{elseif $mph_grade eq 'F'}
										<div class="font12R">{$rowsArr[$item.user_code][$keyM].mph_totalscoll|number_format:2}&nbsp;</div>
										{else}
										<div class="font12">{$rowsArr[$item.user_code][$keyM].mph_totalscoll|number_format:2}&nbsp;</div>
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