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
					    			<td colspan="3" align="left" >
					    				<input id="btn_new" title=" Create New" class="btn_tools" onclick="pagePosition('','new');" value= "Create New" type="button">
					    				<input id="btn_delete" title="Delete" class="btn_tools" onclick="deleteMultiLine('position');" value=" Delete" type="button">
					    			</td>
					    			<td colspan="4" align="right">
					    				<span class="font11b">Status :</span>
					    				<select name="status" id="status" class="selectBox3cm" onchange="jsSearch();">
										<option value="">--Select All--</option>
										{html_options options=$statusOp selected=$status}
										</select>
					    				<input type="text" name="keyword" id="keyword" value="{$keyword}" class="textfield_4c">
					    				<input id="btn_search" name="search" title="Search" class="btn_tools" onclick="jsSearch();"  value="Search" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="font11b" align="center" width="3%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
				    				{*<td class="font11b" align="center" width="5%"> ลำดับ </td>*}
				    				<td class="font11b" align="center" width="10%" style="cursor:pointer" onClick="SortData('org_position_code');"> Code {$order_by.org_position_code}</td>
				    				<td class="font11b" align="center" width="30%" style="cursor:pointer" onClick="SortData('org_position_name_th');"> Position TH {$order_by.org_position_name_th}</td>
				    				<td class="font11b" align="center" width="30%" style="cursor:pointer" onClick="SortData('org_position_name_en');"> Position EN {$order_by.org_position_name_en}</td>
				    				<td class="font11b" align="center" width="10%" style="cursor:pointer" onClick="SortData('org_position_level');"> Position Level {$order_by.org_position_level}</td>
				    				<td class="font11b" align="center" width="10%"> Status </td>
				    				<td class="font11b" align="center" width="10%"> แก้ไข </td>
				    			</tr>
				    			{assign var="loopH" value=1}
				    			{foreach from=$rows item=item key=key}
				    			<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}" id="tr_{$item.org_position_id}">
				    				<td align="center" ><input type='checkbox' class="border0" id="{$item.org_position_id}" value="{$item.org_position_id}"></td>
				    				{*<td align="center" class="font12">{$loopH}</td>*}
				    				<td align="center" class="font12" >{$item.org_position_code}</td>
				    				<td align="left" class="font12" >{$item.org_position_name_th}</td>
				    				<td align="left" class="font12" >{$item.org_position_name_en}</td>
				    				<td align="center" class="font12">{$item.org_position_level}</td>
				    				<td align="center" class="font12" >{$statusOp[$item.org_position_status]}</td>
				    				<td align="center" class="font12" id="txt_link_user" nowrap>
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="pagePosition('{$item.org_position_id}','edit');" value="  Edit" type="button">
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
{add_script file="$_js/position.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>