<div id="mst_list">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    		<tr>
    			<td bgcolor="#EBEBEB">
					<table width="100%">
    					<tr>
    						<td>
                            	<input id="btn_new" title="Create New" class="btn_tools" onclick="app.gotoview('/master/mtmenu/form/_m/new')" value="&nbsp;Create New" type="button">
                                <input id="btn_delete" title="Delete" class="btn_tools" onclick="deleteMultiLine();" value="&nbsp;Delete" type="button">

                            </td>
                            <td align="right">
                              	<input type="text" name="keyword" id="keyword" value="{$params.keyword}" >
			    				<input id="btn_search" title="Search" class="btn_tools" onclick="document.forms[0].submit();"  value=" Search" type="button">
                             </td>
						</tr>
					</table>
    			</td>
    		</tr>
	      <tr>
			<!--detail-->
				<td valign="top" bgcolor="#FFFFFF">
					<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
			          <tr>
				    	<td colspan="2" align="center">
				    		<table cellpadding="0" cellspacing="0" width="100%" border="0"  >
				    			<tr bgcolor="#C6DCFF" height="25" align="right">
				    				<td class="font12b" align="center" width="3%"><input class="border0" type="checkbox" name="checkId" onclick="selectChkAll(this);"></td>
				    				<td class="font12b" align="center" width="8%">Code </td>
				    				<td class="font12b" align="center" width="15%"> Name </td>
				    				<td class="font12b" align="center" width="15%"> Last Update </td>
				    				<td class="font12b" align="center" width="15%"> Action </td>
				    			</tr>
				    			{assign var="loopH" value=1}
				    			{foreach from=$dataArray item=item key=key}
				    			<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}" id="tr_{$item.lookup_code}">
				    				<td align="center" class="font12"><input class="border0" type='checkbox' id="{$item.lookup_code}" value='{$item.lookup_code}'></td>
				    				<td align="center" class="font12" >{$item.lookup_code}</td>
				    				<td align="left" class="font12">{$item.lookup_name}</td>
				    				<td align="center" class="font12">{$item.lookup_date|date_format:"%d-%m-%Y %H:%M:%S"}</td>
				    				<td align="center" class="font12" id="txt_link_user">
				    					<input id="btn_edit" title="Edit" class="btn_tools" onclick="editmenu('{$item.lookup_code}');" value="&nbsp;Edit" type="button">
                                    	<input id="btn_view" title="View" class="btn_tools" onclick="viewmenu('{$item.lookup_code}');" value="&nbsp;View" type="button">
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
			                        <td>&nbsp;{*html_pagination url=$base_url total=$totalRecord page=$page perpage=$perpage*}</td>
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
</div>