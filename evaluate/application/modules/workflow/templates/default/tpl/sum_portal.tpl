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
					                <td height="38" class="titlehead">&nbsp;Work List</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>
			          <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="4%" rowspan="2" align="center" >No.</td>
									<td class="font11b" width="20%" rowspan="2" align="center" >Flow name</td>
									<td class="font11b" width="20%" rowspan="2" align="center" >Type of flow</td>
									<td class="font11b" width="20%" colspan="2" align="center" >Total Status</td>
									<!--td class="font11b" width="10%" rowspan="2" align="center" >Today</td>
									<td class="font11b" width="10%" rowspan="2" align="center" >Week</td-->
									<td class="font11b" width="15%" rowspan="2" align="center" >Action</td>
								</tr>
								<tr bgcolor="#B2B3B5" height="30">
									<td class="font11b" width="10%" align="center" >Create</td>
									<td class="font11b" width="10%" align="center" >Process</td>
								</tr>
								{if $worklist}
								{assign var=i value=1}
								{foreach from=$worklist key=key item=item}
								<tr height="20" bgcolor="#EBEBF5" >
									<td class="font12" align="center" >{$i}</td>
									<td class="font12" align="center" >Evaluate{*$item.name*}</td>
									<td class="font12" align="center" >{$item.data.mph_type}</td>
									<td class="font12" align="center" >{$item.C}</td>
									<td class="font12" align="center" >{$item.P}</td>
									<!--td class="font12" align="center" >{$item.name}</td>
									<td class="font12" align="center" >{$item.name}</td-->
									<td align="left" id="txt_link_user" nowrap>
									{if $level >= 9}
										{if $item.C}<input id="btn_view" title="View Create" class="btn_tools" onclick="openPageView('{$item.data.mph_type}','{$item.data.mph_user_flow}','C');" value="  View Create" type="button">{/if}
										{if $item.P}<input id="btn_view" title="View Accept" class="btn_tools" onclick="openPageAccept('{$item.data.mph_type}');" value="  Accept Process" type="button">{/if}
									{else}
										{if $item.C}<input id="btn_view" title="View Create" class="btn_tools" onclick="openPageView('{$item.data.mph_type}','{$item.data.mph_user_flow}','C');" value="   Create" type="button">{/if}
										{if $item.P}<input id="btn_view" title="View Process" class="btn_tools" onclick="openPageView('{$item.data.mph_type}','{$item.data.mph_user_flow}','P');" value="   Process" type="button">{/if}
									{/if}
									</td>

								</tr {$i++}>
								{/foreach}
								{/if}
				    		</table>
				    	</td>
				    </tr>
				    <tr align="right">
				   		<td >
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
				    <tr>
			            <td colspan="2"><br>&nbsp;</td>
			        </tr>
			        <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
					    		<tr >
					                <td height="38" class="titlehead">&nbsp;Activity List</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>
				     <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			{*<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="3%" align="center" >No.</td>
									<td class="font11b" width="20%" align="center" >Flow name</td>
									<td class="font11b" width="20%" align="center" >Type of flow</td>
									<td class="font11b" width="10%" align="center" >Total</td>
									<td class="font11b" width="10%" align="center" >Action</td>
								</tr>

								{if $activity}
								{assign var=loop value=1}
								{foreach from=$activity key=key item=act}
								<tr height="20" bgcolor="#EBEBF5" >
									<td class="font12" align="center" >{$loop}</td>
									<td class="font12" align="center" >Evaluate</td>
									<td class="font12" align="center" >{$act.mph_type}</td>
									<td class="font12" align="center" >{$act.total}</td>
									<td align="center" class="font12" id="txt_link_user">
										<input id="btn_view" title="View" class="btn_tools" onclick="openPageEvaluate('{$act.mph_type}','{$act.mph_id}','{$act.mph_user}','{$act.mph_month}','V');" value="   View" type="button">
										<!--onclick="openPageView('{$act.mph_type}','{$act.mph_user_flow}','P');"-->
									</td>

								</tr {$loop++}>
								{/foreach}
								{/if}*}



								<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="3%" align="center" >ลำดับ</td>
									<td class="font11b" width="20%" align="center" >Flow name</td>
									<td class="font11b" width="10%" align="center" >เดือนประเมิน</td>
									<td class="font11b" width="10%" align="center" >ประเภท</td>
									<td class="font11b" width="10%" align="center" >สถานะ</td>
									<td class="font11b" width="10%" align="center" >วันที่ส่ง</td>
									<td class="font11b" width="10%" align="center" >คนที่ส่ง</td>
									<td class="font11b" width="10%" align="center" >Action</td>
								</tr>
								{if $rowsArr}
								{assign var=i value=1}
								{foreach from=$rowsArr key=key item=item}
								<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}" >
									<td class="font12" align="center" >{$i}</td>
									<td class="font12" align="center" >Evaluate</td>
									<td class="font12" align="center" >{$item.mph_month}</td>
									<td class="font12" align="center" >{$item.mph_type}</td>
									<td class="font12" align="center" >
										{if $item.mph_status eq C}Create{elseif $item.mph_status eq P}Process{/if}
									</td>
									<td class="font12" align="center" >{if $item.mph_datetime neq '0000-00-00 00:00:00'}{$item.mph_datetime|date_format:"%d-%m-%Y"}{/if}</td>
									<td class="font12" align="center" >{$item.user_sendname}</td>
									<td align="center" id="txt_link_user">
										<input id="btn_view" title="View" class="btn_tools" onclick="openPageEvaluate('{$item.mph_type}','{$item.mph_id}','{$item.mph_user}','{$item.mph_month}','V');" value="   View" type="button">
									</td>
								</tr {$i++}>
								{/foreach}
								{/if}
				    		</table>
				    	</td>
				    </tr>
			       <tr align="right">
				   		<td >
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