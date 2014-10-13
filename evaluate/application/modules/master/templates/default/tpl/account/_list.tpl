{include file="$g_template/_header.tpl"}
<div id="mst_list">
<form method="post" action="" id="_frm" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<input type="hidden" name="fields_sort" id="fields_sort" value="{$smarty.post.fields_sort}">
<input type="hidden" name="order" id="order" value="{$smarty.post.order}">
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
				    			<tr height="25" >
					    			<td colspan="5" align="left" >
					    				{if $type neq Sal}
					    				<input id="btn_new" title=" Create New" class="btn_tools" onclick="pageAccount('','new');" value= "Create New" type="button">
					    				<input id="btn_delete" title="Delete" class="btn_tools" onclick="deleteMultiLine('account');" value=" Delete" type="button">
					    				{/if}
					    			</td>
					    			<td colspan="8" align="right">
					    				<select name="status" id="status" class="selectBox3cm" onchange="jsSearch();">
										{html_options options=$statusOp selected=$status}
										</select>
					    				<input type="text" name="keyword" id="keyword" value="{$keyword}" class="textfield_4c">
					    				<input id="btn_search" name="search" title="Search" class="btn_tools" onclick="jsSearch();"  value="Search" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				{if $type neq Sal}
				    				<td class="font11b" align="center" width="2%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
				    				{/if}
				    				<td class="font11b" align="center" width="3%"> No. </td>
				    				<td class="font11b" align="center" width="7%" onClick="SortData('user_code');">Emp.Code {$order_by.user_code}</td>
				    				<td class="font11b" align="center" width="20%" onClick="SortData('user_name');"> Emp. Name {$order_by.user_name}</td>
				    				<td class="font11b" align="center" width="15%" onClick="SortData('user_email');"> E-mail {$order_by.user_email}</td>
				    				<td class="font11b" align="center" width="9%" onClick="SortData('user_mobile');"> Mobile {$order_by.user_mobile}</td>
				    				<td class="font11b" align="center" width="15%" onClick="SortData('org_position_name_th');"> Position {$order_by.org_position_name_th}</td>
				    				<td class="font11b" align="center" width="5%" onClick="SortData('org_position_level');"> Level {$order_by.org_position_level}</td>
				    				<td class="font11b" align="center" width="5%"> Group Menu </td>
				    				<td class="font11b" align="center" width="5%"> Header </td>
				    				<td class="font11b" align="center" width="7%"> Status </td>
				    				<td class="font11b" align="center" width="10%"> Time update </td>
				    				<td class="font11b" align="center" width="7%"> Action </td>
				    			</tr>
				    			{assign var="loopH" value=1}
				    			{foreach from=$rows item=item key=key}
				    			<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}" id="tr_{$item.user_id}">
				    				{if $type neq Sal}
				    				<td align="center" ><input type='checkbox' class="border0" id="{$item.user_id}" value='{$item.user_id}'></td>
				    				{/if}
				    				<td align="center" class="font11">{$loopH}</td>
				    				<td align="center" class="font11" width="7%">{if $item.user_code eq '1001'}-contact-{else}{$item.user_code}{/if}</td>
				    				<td align="left" class="font11" >{$item.user_name} {$item.user_lname}</td>
				    				<td align="left" class="font11" >{$item.user_email}</td>
				    				<td align="center" class="font11" >{$item.user_mobile}</td>
				    				<td align="left" class="font11">{$item.org_position_name_th}</td>
				    				<td align="center" class="font11" >{$item.org_position_level}</td>
				    				<td align="center" class="font11" >{$item.lookup_code}</td>
				    				<td align="center" class="font11" >{$item.user_header}</td>
				    				<td align="center" class="font11" >{if $item.user_active eq Y}Active{else}Inactive{/if}</td>
				    				<td align="center" class="font11">{$item.updatetime|date_format:"%d-%m-%Y"}</td>
				    				<td align="center" class="font11" id="txt_link_user" nowrap>
				    					{if $type neq Sal}
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="pageAccount('{$item.user_id}','edit');" value="  Edit" type="button">
				    					{else}
				    					<input id="btn_view" title="Salary" class="btn_tools" onclick="pageSalary('{$item.user_code}');" value="  Salary" type="button">
				    					{/if}
				    				</td>
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
			                        <td>{html_pagination url=$url total=$totalRecord page=$page perpage=$perpage}</td>
			                        <td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuright.gif"/></td>
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
{add_script file="$_js/account.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>