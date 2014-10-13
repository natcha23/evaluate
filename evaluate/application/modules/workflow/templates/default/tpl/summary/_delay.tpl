{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_portal" enctype="multipart/form-data" >
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
				    			<tr bgcolor="#EBEBEB" height="25">
				    				<td class="font11" align="left" colspan="3" ><b>Year :</b>
										<select name="search[year]" id="year" class="selectBox7"  >
											{html_options options=$yearOp selected=$year}
										</select>
										<input type="button" id="btn_search" class="btn_tools" value="   Search" name="btt_search" onclick="jsSearch();">
				    				</td>
						   			<td class="font11" align="right" colspan="13" ><b>Department :</b>
										<select name="group" id="group" class="selectBox25" {if $head_org}disabled{/if} onchange="jsChange(this.value);" >
										<option value="">-- Show all --</option>
											{html_options options=$groupBUOp selected=$group}
										</select>&nbsp;&nbsp;
						   			 </td>
					 			</tr>
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="6%" align="center" >รหัส</td>
									<td class="font11b" width="15%" align="center" >ชื่อ - สกุล</td>
									<td class="font11b" align="center" >ตำแหน่ง</td>
									<td class="font11b" width="4%" align="center" >Level</td>
									{foreach from=$monthOp key=keyM item=mName}
									<td class="font11b" align="center" {if $month eq $keyM}bgcolor="#DDFFA7"{/if}{if $typePage eq 'PI'}width="5%"{else}width="10%"{/if}>{$mName}</td>
									{/foreach}
								</tr>

								{if $dataArr}
								{foreach from=$dataArr key=key item=depart}
									<tr height="20" bgcolor="#FFE7BA" >
										<td colspan="16" align="left" class="font12">&nbsp;{$depart.department}</td>
									</tr>
									{foreach from=$depart.user key=key1 item=item}
										<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}">
											<td class="font11" align="center" >{if $item.user_code eq '1001'}-contact-{else}{$item.user_code}{/if}</td>
											<td align="left" class="font11" >{$item.user_name} {$item.user_lname}</td>
											<td align="left" class="font11" >{$item.org_position_name_th}</td>
											<td align="center" class="font11" >{$item.org_position_level}</td>
											{foreach from=$monthOp key=keyM item=mName}
											{assign var="monthYear" value=$keyM`$year`}
											<td align="center" class="font11">{if $rowsArr[$item.user_code][$monthYear].mph_status}<img src="{$g_image}/button/red13.jpg" border="0" >{/if}</td>
											{/foreach}
										</tr>
									{/foreach}

								{/foreach}

								{/if}
				    		</table>
				    	</td>
				    </tr>
			       <tr align="right">
				   		<td colspan="2">
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
<script>
	var typeshow = '{$typenow}';
	jsShowTime(typeshow);
</script>