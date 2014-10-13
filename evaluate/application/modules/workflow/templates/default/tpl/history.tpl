{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_portal" enctype="multipart/form-data">
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
					                <td height="38" class="titlehead">&nbsp;History Send Form Active</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>
				    <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			{if $_profile->lookup_code eq 'AM'}
				    			<tr bgcolor="#C6DCFF" >
				    				<td class="font11b" colspan="9" align="left" >
				    					<input id="btn_delete" title="Delete" class="btn_tools" onclick="delMultiLine('delhis');" value="Delete" type="button">
									</td>
				    			</tr>
				    			{/if}
				    			<tr bgcolor="#C6DCFF" height="30">
				    			 {if $_profile->lookup_code eq 'AM'}
				    			 	<td class="font11b" width="3%" align="center" >
				    			 		<input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);">
				    			 	</td>
				    			 {/if}
									<td class="font11b" width="4%" align="center" >No.</td>
									<td class="font11b" width="10%" align="center" >Type of flow</td>
									<td class="font11b" width="15%" align="center" >Form Month</td>
									<td class="font11b" width="15%" align="center" >User Owner</td>
									<td class="font11b" width="15%" align="center" >User Receive</td>
									<td class="font11b" width="15%" align="center" >Send Date</td>
									<td class="font11b" width="10%" align="center" >Status</td>
									<td class="font11b" width="10%" align="center" >Action</td>
								</tr>
								{if $history}
								{assign var=loopH value=1}
								{foreach from=$history key=key item=data}
								<tr height="20" {if $data.mph_status eq 'C'}bgcolor="#FFE7F6" {else}bgcolor="{cycle values="#ffffff,#EBEBF5"}" {/if}id="tr_{$data.mph_id}">
									{if $_profile->lookup_code eq 'AM'}
									<td class="font12" align="center" >
										{*if $data.mph_status eq 'C'*}
										<input type='checkbox' class="border0" id="{$data.mph_id}" value='{$data.mph_id}'>
										{*/if*}
									</td>
									{/if}
									<td class="font12" align="center" >{$loopH}</td>
									<td class="font12" align="center" >{$data.mph_type}</td>
									<td class="font12" align="center" >{$data.mph_month}</td>
									<td class="font12" align="center" >{$data.user_name_owner}</td>
									<td class="font12" align="center" >{$data.user_name}</td>
									<td class="font12" align="center" >{$data.mph_datetime}</td>
									<td class="font12" align="center" >
									{if $data.mph_status eq 'C'}Create
									{elseif $data.mph_status eq 'P'}Process
									{elseif $data.mph_status eq 'F'}Finish
									{elseif $data.mph_status eq 'R'}Delay
									{/if}
									</td>
									<td align="center" class="font12" id="txt_link_user">
										<input id="btn_edit" title="Edit" class="btn_tools" onclick="openPageEvaluate('{$data.mph_type}','{$data.mph_id}','{$data.mph_user}','{$data.mph_month}','E');" value="   Edit" type="button">
									</td>
								</tr {$loopH++}>
								{/foreach}
								{/if}
				    		</table>
				    	</td>
					<!--tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<input id="btn_back" title="Back" class="btn_tools" onclick="openLinkMenu('workflow/evaluate/urecive');" value="   Back " type="button">
						</td>
					</tr-->
				  <tr align="right">
				   		<td >
							<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
						   	<tbody>
						       	<tr align="right">
						           	<td width="12"><img width="12" src="{$g_image}/buttonmenuleft.gif"/></td>
						            <td>{html_pagination url=$url total=$totalRecord page=$page perpage=$perpage}&nbsp;</td>
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