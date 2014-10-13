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
					                <td height="38" class="titlehead">&nbsp;View Evaluate Work List</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>
				    <tr>
				    	<td colspan="2" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="3%" align="center" >ลำดับ</td>
									<td class="font11b" width="20%" align="center" >ชื่อ - สกุล</td>
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
									<td class="font12" align="left" >&nbsp;{$item.user_name} {$item.user_lname}</td>
									<td class="font12" align="center" >{$item.mph_month}</td>
									<td class="font12" align="center" >{$item.mph_type}</td>
									<td class="font12" align="center" >
										{if $item.mph_status eq C}Create{elseif $item.mph_status eq P}Process{/if}
									</td>
									<td class="font12" align="center" >{if $item.mph_datetime neq '0000-00-00 00:00:00'}{$item.mph_datetime|date_format:"%d-%m-%Y"}{/if}</td>
									<td class="font12" align="center" >{$item.user_sendname}</td>
									<td align="center" id="txt_link_user">
										<input id="btn_view" title="View" class="btn_tools" onclick="openPageEvaluate('{$item.mph_type}','{$item.mph_id}','{$item.mph_user}','{$item.mph_month}','{$status}');" value="   View" type="button">
									</td>
								</tr {$i++}>
								{/foreach}
								{/if}
				    		</table>
				    	</td>
					<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<input id="btn_back" title="Back" class="btn_tools" onclick="openLinkMenu('workflow/evaluate/urecive');" value="   Back " type="button">
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