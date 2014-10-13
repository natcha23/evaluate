{include file="$g_template/_header_popup.tpl"}
<form  method="post" action="" id="frmpopup" enctype="multipart/form-data">
	<table width="98%" bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="1" style="border:0px solid #cccccc;" align="center">
		<tr >
			<td align="center" height="25" style="font-size: 14px;" width="98%" ><b>{$headPage}<b></td>
		</tr>
		<tr>
			<td align="right" >
				{if $chk_code}
				<input id="btn_accept" title="Submit" class="btn_tools" type="button" value=" Submit " onclick="bttChkSubmit('{$pageview}','{$accept}','{$status}','{$head}');">
				{else}
				<input id="btn_accept" title="Submit" class="btn_tools" type="button" value=" Submit " onclick="chekSubmit('{$pageview}','{$accept}','{$status}','{$head}');">
				{/if}
				<input id="btn_close" title="Close" class="btn_tools" type="button" value=" Close " onclick="window.close();">&nbsp;
				<input type='hidden' name='search' id="search">
				<input type='hidden' name='search[month]' value="">
				<input type='hidden' name='search[year]' value="">
				<input type="hidden" name="pageview" value="{$pageview}">
				<input type="hidden" name="accept" value="{$accept}">
				<input type="hidden" name="status" value="{$status}">
				<input type="hidden" name="chk_code" id="chk_code" value="{$chk_code}">
			</td>
		</tr>
		<tr>
			<td align="center" >
				<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
			    	<tr bgcolor="#cccccc" height="25">
			   			<td class="font11" align="right" colspan="5" ><b>Department :</b>
							<select name="group" id="group" class="selectBox25" onchange="jsChange(this.value);" >
							<option value="all">-- Show all --</option>
								{html_options options=$groupBUOp selected=$group}
							</select>
							<input type='text' name="keyword" value='{$keyword}' size="20">
							<input type="button" id="btn_search" class="btn_tools" value="   Search" name="btt_search" onclick="jsSearch();">
			   			 	<!--&nbsp;<b>Position :</b>
							<select name="group" id="group" class="font12" onchange="jsChange(this.value);" >
							<option value="">-- Please Select --</option>
								{html_options options=$groupBUOp selected=$group}
							</select-->
			   			 </td>
		 			</tr>
		 			<tr bgcolor="#cccccc" height="25">
			   			<td class="font11b" align="center" width="4%">
			   			{if $pageview neq 'mi' && $pageview neq 'pi' && $head neq 'Y'}
			   			<input type='checkbox' name='checkId' value='checkId' onclick="selectChkAll(this);">
			   			{/if}
			   			</td>
			   			<td class="font11b" align="center" width="8%"> รหัสพนักงาน</td>
		 				<td class="font11b" align="center" width="25%"> ชื่อ - สกุล </td>
		 				{if $pageview neq 'mi' && $pageview neq 'pi' && $head neq 'Y'}
		 				<td class="font11b" align="center" width="7%"> Level </td>
		 				{/if}
		 				<td class="font11b" align="center" width="35%"> ตำแหน่ง </td>
		 			</tr>
	    			{assign var="loopH" value=1}
			    	{foreach from=$userEva item=user key=key}
			   		<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}">
		 				<td align="center" width="4%">
		 				{if $pageview == 'mi' || $pageview == 'pi' || $head == 'Y'}
		 				<input type='radio' name='checkId' id="{$user.user_code}" value='{$user.user_code}' title="{$user.user_name} {$user.user_lname}">
		 				{else}
		 				<input type='checkbox' name='uowner[{$user.user_code}][check]' id="{$user.user_code}" value='{$user.user_code}' title="{$user.user_name} {*$user.user_lname*}">
		 				{/if}
		 				</td>
			    		<td align="center" class="font12" width="8%">{if $user.user_code eq '1001'}-contact-{else}{$user.user_code}{/if} </td>
			    		<td align="left" class="font12" width="25%">&nbsp;{$user.user_name}&nbsp;&nbsp;{$user.user_lname}</td>
			    		{if $pageview neq 'mi' && $pageview neq 'pi' && $head neq 'Y'}
			    		<td align="center" class="font12" width="7%">{$user.org_position_level}</td>
			    		{/if}
			    		<td align="left" class="font12" width="35%">&nbsp;{$user.org_position_name_th}</td>
			    	</tr {$loopH++}>
				    {/foreach}
			   </table>
			</td>
		</tr>
		<tr align="right">
			<td colspan="2">
				<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
			    	<tbody>
			            <tr align="right">
			                <td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuleft.gif"/></td>
			                <td>{*html_pagination url=$url total=$totalRecord page=$page perpage=$perpage*}&nbsp;</td>
			                <td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuright.gif"/></td>
			            </tr>
			        </tbody>
			   </table>
			</td>
		</tr>
		<tr>
			<td align="right" >
				{if $chk_code}
				<input id="btn_accept" title="Submit" class="btn_tools" type="button" value=" Submit " onclick="bttChkSubmit('{$pageview}','{$accept}','{$status}','{$head}');">
				{else}
				<input id="btn_accept" title="Submit" class="btn_tools" type="button" value=" Submit " onclick="chekSubmit('{$pageview}','{$accept}','{$status}','{$head}');">
				{/if}
				<input id="btn_close" title="Close" class="btn_tools" type="button" value=" Close " onclick="window.close();">&nbsp;
			</td>
		</tr>
	</table>
</form>
{add_script file="$_js/evaluate.js"}
{include file="$g_template/_footer.tpl"}