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
					    				<input id="btn_new" title=" Create New" class="btn_tools" onclick="openPageEvalmst('new','','{$mId}','1');" value= "Create New" type="button">
					    				<input id="btn_delete" title="Delete" class="btn_tools" onclick="deleteMultiLine('evaluate','master_evaluate','mst_eva_id');" value=" Delete" type="button">
					    			</td>
					    			<td colspan="4" align="right">
					    				<input type="text" name="keyword" id="keyword" value="{$keyword}" class="textfield_4c">
					    				<input id="btn_search" name="search" title="Search" class="btn_tools" onclick="jsSearch();"  value="Search" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="tdhead" align="center" width="3%"><input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);"></td>
				    				<td class="font11b" align="center" width="4%"> ลำดับ </td>
				    				<td class="font11b" align="center" width="25%"> หัวข้อการประเมิน </td>
				    				<td class="font11b" align="center"> รายละเอียดการประเมิน </td>
				    				<td class="font11b" align="center" width="8%"> ประเภท </td>
				    				<td class="font11b" align="center" width="8%"> วันที่แก้ไข </td>
				    				<td class="font11b" align="center" width="10%"> Action </td>
				    			</tr>
				    			{assign var="loopH" value=1}
				    			{foreach from=$rows item=item key=key}
				    			<tr height="20" bgcolor="#EBEBEB" id="tr_{$item.mst_eva_id}">
				    				<td align="center" ><input type='checkbox' class="border0" id="{$item.mst_eva_id}" value='{$item.mst_eva_id}'></td>
				    				<td class="font11" align="center">{$loopH}</td>
				    				<td class="font11" align="left">&nbsp;{$item.mst_eva_name}</td>
				    				<td class="font11" align="left">&nbsp;{$item.mst_eva_dsc}</td>
				    				<td class="font11" align="center">{$item.mst_eva_type}</td>
				    				<td class="font11" align="center">{$item.datetime|date_format:"%d-%m-%Y"}</td>
				    				<td class="font11" align="center" nowrap>
				    					{if $item.mst_eva_type eq PI}
				    					<input id="btn_new" title="Add Sub" class="btn_tools" onclick="addSubEval('new','{$item.mst_eva_id}','{$item.mst_eva_type}','{$mId}');" value="  Add Sub" type="button">
				    					{else}
				    					<input id="btn_disabled_new" title="Add Sub" class="btn_tools" value="  Add Sub" type="button">
				    					{/if}
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="openPageEvalmst('edit','{$item.mst_eva_id}','{$mId}','{$item.mst_eva_level}');" value="  Edit" type="button">
									</td>
				    			</tr>
				    			{assign var="loopH" value=$loopH+1}
				    			{foreach from=$item.dataLine item=line key=keyL}
								<tr height="20" id="tr_{$line.mst_eva_id}">
								    	<td class="font11" align="right"></td>
								    	<td class="font11" align="right">-</td>
								    	<td class="font11" align="left">&nbsp;{$line.mst_eva_name}</td>
								    	<td class="font11" align="left">&nbsp;{$line.mst_eva_dsc}</td>
								    	<td class="font11" align="left">&nbsp;</td>
								    	<td class="font11" align="center">{$line.datetime|date_format:"%d-%m-%Y"}</td>
								    	<td class="font11" align="left">
								    		<input id="btn_edit" title="Edit" class="btn_tools" onclick="openPageEvalmst('edit','{$line.mst_eva_id}','{$mId}','{$line.mst_eva_level}');" value="  Edit" type="button">
								    		<input id="btn_delete" title="Dellete" class="btn_tools" onclick="DelRecord('{$line.mst_eva_id}');" value="  Delete" type="button">
					    		    	</td>
								 </tr>
								 {/foreach}
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
	        <!-- end detail-->
    	</table>
    </td>
  </tr>
</table>
{add_script file="$_js/evaluate.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>