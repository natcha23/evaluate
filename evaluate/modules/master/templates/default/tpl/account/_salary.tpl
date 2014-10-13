{include file="$g_template/_header.tpl"}
<div id="mst_list">
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
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr height="25" >
					    			<td colspan="2" align="left" >
					    				<input id="btn_new" title=" Create New" class="btn_tools" onclick="openSalary('','{$account.user_code}','new');" value= "Create New" type="button">
					    			</td>
					    			<td colspan="4" align="right">
					    				<input type="text" name="keyword" id="keyword" value="{$keyword}" class="textfield_4c">
					    				<input id="btn_search" name="search" title="Search" class="btn_tools" onclick="jsSearch();"  value="Search" type="button">
					    			</td>
				    			</tr>
				    			<tr bgcolor="#EBEBEB" height="25">
									<td colspan="6" align="left" class="font12b">
										&nbsp;{if $account.user_code eq '1001'}-contact-{else}{$account.user_code}{/if} :: {$account.user_name} &nbsp;[{$account.org_position_name_th}]
									</td>
								</tr>
				    			<tr bgcolor="#C6DCFF" height="25">
				    				<td class="font11b" align="center" width="4%"> ลำดับ </td>
				    				<td class="font11b" align="center" width="10%"> วันที่เปลี่ยนแปลง </td>
				    				<td class="font11b" align="center" width="12%"> เงินเดือน </td>
				    				<td class="font11b" align="center" > หมายเหตุ </td>
				    				<td class="font11b" align="center" width="10%"> Time update </td>
				    				<td class="font11b" align="center" width="7%"> Action </td>
				    			</tr>
				    			{assign var="loopH" value=1}
				    			{foreach from=$rows item=item key=key}
				    			<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}" id="tr_{$item.sal_id}">
				    				<td align="center" class="font11">{$loopH}</td>
				    				<td align="center" class="font11" >{$item.date_upsalary}</td>
				    				<td align="right" class="font11" >{$dataArr[$key][$item.user_code]|number_format:2}&nbsp;</td>
				    				<td align="left" class="font11" >&nbsp;{$item.note}</td>
				    				<td align="center" class="font11">{$item.updatetime|date_format:"%d-%m-%Y"}</td>
				    				<td align="center" class="font11" id="txt_link_user" nowrap>
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="openSalary('{$item.sal_id}','{$item.user_code}','edit');" value="  Edit" type="button">
				    				</td>
				    			</tr {$loopH++}>
					    		{/foreach}
					    		<tr bgcolor="#EBEBEB">
									<td colspan="6" align="right" >
										<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('master/account/index');" value=" Back " type="button">
										&nbsp;
									</td>
								</tr>
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