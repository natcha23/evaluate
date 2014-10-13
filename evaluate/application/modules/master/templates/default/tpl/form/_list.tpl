{include file="$g_template/_header.tpl"}
<div id="mst_list2">
<form method="post" action="" id="_frm" enctype="multipart/form-data">
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
				    		<table id="mst_list" bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr height="25" >
					    			<td colspan="4" align="left" >
					    				<input id="btn_new" title=" Create New" class="btn_tools" onclick="pageFormEva('','new');" value= "Create New" type="button">
					    				<input id="btn_delete" title="Delete" class="btn_tools" onclick="deleteMultiLine('form');" value=" Delete" type="button">
					    			</td>
					    			<td colspan="7" align="right">
					    				<input type="text" name="keyword" id="keyword" value="{$keyword}" class="textfield_4c">
					    				<input id="btn_search" name="search" title="Search" class="btn_tools" onclick="jsSearch();"  value="Search" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="font11b" align="center" width="3%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
				    				<td class="font11b" align="center" width="5%"> ลำดับ </td>
				    				<td class="font11b" align="center" width="10%"> เลขที่ฟอร์ม </td>
				    				<td class="font11b" align="center" width="25%"> ชื่อฟอร์ม </td>
				    				<td class="font11b" align="center" width="10%"> วันเริ่มใช้ฟอร์ม </td>
				    				<td class="font11b" align="center" width="10%"> วันสิ้นสุดใช้ฟอร์ม </td>
				    				<td class="font11b" align="center" width="10%"> ประเภท </td>
				    				<td class="font11b" align="center" width="10%"> สถานะ </td>
				    				<td class="font11b" align="center" width="10%"> วันที่แก้ไขล่าสุด </td>
				    				<td class="font11b" align="center" width="13%"> แก้ไข </td>
				    			</tr>
				    			{assign var="loopH" value=1}
				    			{foreach from=$rows item=item key=key}
				    			<tr height="20" bgcolor="#F5F6F7" id="tr_{$item.form_id}">
				    				<td align="center" ><input type='checkbox' class="border0" id="{$item.form_id}" value='{$item.form_id}'></td>
				    				<td align="center" class="font12">{$loopH}</td>
				    				<td align="center" class="font12" >{$item.form_code}</td>
				    				<td align="left" class="font12" >{$item.form_name}</td>
				    				<td align="center" class="font12">{$item.form_stdate|date_format:"%d-%m-%Y"}</td>
				    				<td align="center" class="font12">{$item.form_enddate|date_format:"%d-%m-%Y"}</td>
				    				<td align="center" class="font12" >{$item.form_type}</td>
				    				<td align="center" class="font12" >{if $item.form_status eq Y}Active{else}Inactive{/if}</td>
				    				<td align="center" class="font12">{$item.updatetime|date_format:"%d-%m-%Y"}</td>
				    				<td align="center" class="font12" id="txt_link_user" nowrap>
				    					{if $item.create eq N}
				    					<input id="btn_disabled_new" title="Template" class="btn_tools" value="  Template" type="button">
				    					{else}
				    					<input id="btn_new" title="Template" class="btn_tools" onclick="pageFormCreate('{$item.form_id}','{$item.form_type}');" value="  Template" type="button">
				    					{/if}
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="pageFormEva('{$item.form_id}','edit');" value="  Edit" type="button">
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
			                        <td>{html_pagination url=$url total=$totalRecord page=$page perpage=$perpage}&nbsp;</td>
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
	      	<tr><td height="20" ></td></tr>
	      	<tr>
			<!--detail-->
				<td valign="top" bgcolor="#FFFFFF">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
					    		<tr >
					                <td height="38" class="titlehead">&nbsp;Draft Form Evaluate of Header</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>
			           <tr>
				    	<td colspan="2" align="center">
				    		<table id="mst_list1" bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr height="25" >
					    			<td colspan="9" align="left" >
					    				<input id="btn_delete" title="Delete" class="btn_tools" onclick="delDraftMultiLine('form');" value=" Delete" type="button">
					    				<input id="btn_sent" title="Send Data" class="btn_tools" onclick="sendMultiLine('form');" value=" Send Data" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="font11b" align="center" width="3%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
				    				<td class="font11b" align="center" width="5%"> ลำดับ </td>
				    				<td class="font11b" align="center" width="8%"> รหัสพนักงาน </td>
				    				<td class="font11b" align="center" width="20%"> คนรับคนแรก </td>
				    				<td class="font11b" align="center" width="5%"> ประเภท </td>
				    				<td class="font11b" align="center" width="8%"> ประเมินเดือน </td>
				    				<td class="font11b" align="center" > เจ้าของใบประเมิน </td>
				    				<td class="font11b" align="center" width="10%"> วันที่สร้าง </td>
				    				<td class="font11b" align="center" width="8%"> Group<br>Menu </td>
				    				<td class="font11b" align="center" width="8%" title="ผู้ใชัฟอร์มเริ่มต้น"> start flow </td>
				    				<td class="font11b" align="center" width="8%" title="ผู้ใช้ฟอร์มสิ้นสุด"> end flow </td>
				    				<td class="font11b" align="center" width="8%"> Action </td>
				    			</tr>
				    			{assign var="loopH" value=1}
				    			{foreach from=$copyArr item=item key=key}
				    			<tr height="20" bgcolor="{cycle values="#ffffff,#ECECED"}" id="trd_{$item.drf_id}">
				    				<td align="center" ><input type='checkbox' class="border0" id="{$item.drf_id}" value='{$item.drf_id}'></td>
				    				<td align="center" class="font11">{$loopH}</td>
				    				<td align="center" class="font11" >{$item.user_rec}</td>
				    				<td align="left" class="font11" >{$item.user_name} {$item.user_lname}</td>
				    				<td align="center" class="font11">{$item.mph_type}</td>
				    				<td align="center" class="font11">{$item.month}/{$item.year}</td>
				    				<td align="left" class="font11">{$item.user_eva}</td>
				    				<td align="center" class="font11">{$item.createdate}</td>
				    				<td align="center" class="font11">{$item.lookup_code}</td>
				    				<td align="center" class="font11">{$item.mph_sflow}</td>
				    				<td align="center" class="font11">{$item.mph_eflow}</td>
				    				<td align="center" class="font11" id="txt_link_user" nowrap>
				    					<input id="btn_view" title="View Draft" class="btn_tools" onclick="pageFormDraft('{$item.drf_id}','{$item.form_code}','{$item.mph_type}');" value="  View Draft" type="button">
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
			                        <td>&nbsp;</td>
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
{add_script file="$_js/form.js,$g_js/tinybox.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>