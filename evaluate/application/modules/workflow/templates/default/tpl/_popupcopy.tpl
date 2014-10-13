{include file="$g_template/_header_popup.tpl"}
<form  method="post" action="" id="frmpopup" enctype="multipart/form-data">
	<table width="98%" bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="1" style="border:0px solid #cccccc;" align="center">
		<tr >
			<td align="center" height="30" style="font-size: 14px;" width="98%" ><b>{$headPage}<b></td>
		</tr>
		<tr>
			<td align="right" >
				<input id="btn_accept" title="Submit" class="btn_tools" type="button" value=" Submit " onclick="copyData('{$copy_from}','{$type}');">
				<input id="btn_close" title="Close" class="btn_tools" type="button" value=" Close " onclick="window.close();">&nbsp;
				<input type="hidden" name="type" value="{$type}">
				<input type="hidden" name="copy_from" value="{$copy_from}">
				<input type="hidden" name="month_now" value="{$month_now}">
				<input type="hidden" name="user_owner" value="{$user_owner}">
			</td>
		</tr>
		<tr>
			<td align="center" >
				<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">

		 			<tr bgcolor="#cccccc" height="25">
			   			<td class="font11b" align="center" width="5%"></td>
			   			<td class="font11b" align="center" width="15%"> ใบประเมินประจำเดือน </td>
		 				<td class="font11b" align="center" width="20%"> วันที่สร้างใบประเมิน </td>
		 			</tr>
	    			{assign var="loopH" value=1}
			    	{foreach from=$rows item=item key=key}
			   		<tr height="20" bgcolor="{cycle values="#ffffff,#EBEBF5"}">
		 				<td align="center" width="5%">
		 					<input type='radio' name='checkId' id="{$item.mph_id}" value='{$item.mph_id}'>
		 				</td>
			    		<td align="center" width="15%">&nbsp;{$item.mph_month}</td>
			    		<td align="center" width="20%">&nbsp;{$item.mph_createdate}</td>
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
		<tr>
			<td align="right" >
				<input id="btn_accept" title="Submit" class="btn_tools" type="button" value=" Submit " onclick="copyData('{$copy_from}','{$type}');">
				<input id="btn_close" title="Close" class="btn_tools" type="button" value=" Close " onclick="window.close();">&nbsp;
			</td>
		</tr>
	</table>
</form>
{add_script file="$_js/evaluate.js"}
{include file="$g_template/_footer.tpl"}