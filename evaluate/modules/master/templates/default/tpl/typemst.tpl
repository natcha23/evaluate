{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_type" enctype="multipart/form-data">
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
				    			<tr height="25" >
					    			<td colspan="4" align="left" >
					    				<input id="btn_new" title=" Create New" class="btn_tools" onclick="openPageType('new','','{$mId}');" value= "Create New" type="button">
					    				<input id="btn_delete" title="Delete" class="btn_tools" onclick="deleteMultiLine('master','master_type','type_id');" value=" Delete" type="button">
					    			</td>
					    			<td colspan="3" align="right">
					    				<input type="text" name="keyword" id="keyword" value="{$keyword}" class="textfield_4c">
					    				<input id="btn_search" name="search" title="Search" class="btn_tools" onclick="jsSearch();"  value="Search" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="tdhead" align="center" width="3%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
				    				<td class="font11b" align="center" width="5%"> ลำดับ </td>
				    				<td class="font11b" align="center" width="10%"> Type </td>
				    				<td class="font11b" align="center" width="15%"> ชื่อเต็ม Type </td>
				    				<td class="font11b" align="center" width="30%"> หมายเหตุ </td>
				    				<td class="font11b" align="center" width="10%"> วันที่แก้ไข </td>
				    				<td class="font11b" align="center" width="8%"> แก้ไข </td>
				    			</tr>
				    			{assign var="loopH" value=1}
				    			{foreach from=$rows item=item key=key}
				    			<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}" id="tr_{$item.type_id}">
				    				<td align="center" ><input type='checkbox' class="border0" id="{$item.type_id}" value='{$item.type_id}'></td>
				    				<td align="center" class="font12">{$loopH}</td>
				    				<td align="center" class="font12" >{$item.type_name}</td>
				    				<td align="left" class="font12">&nbsp;{$item.type_fullname}</td>
				    				<td align="left" class="font12">&nbsp;{$item.type_desc}</td>
				    				<td align="center" class="font12">{$item.datetime|date_format:"%d-%m-%Y"}</td>
				    				<td align="center" class="font12" id="txt_link_user">
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="openPageType('edit','{$item.type_id}','{$mId}');" value="  Edit" type="button">
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
			                        <td>{*html_pagination url=$url total=$totalRecord page=$page perpage=$perpage*}</td>
			                        <td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuright.gif"/></td>
			                    </tr>
			                </tbody>
			            </table>
			            </td>
			        </tr>
			        <tr>
			            <td colspan="2">&nbsp;</td>
			        </tr>
			      </table>
			   </td>
	        <!-- end detail-->
	      	</tr>
    	</table>
    </td>
  </tr>
</table>
{add_script file="$_js/master.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>