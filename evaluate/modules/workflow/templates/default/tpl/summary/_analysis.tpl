{include file="$g_template/_header_popup.tpl"}
<form  method="post" action="" id="frmpopup" enctype="multipart/form-data">
	<table width="98%" bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="1" style="border:0px solid #cccccc;" align="center">
		<tr >
			<td align="center" height="30" style="font-size: 15px;" width="98%" ><b>{$headPage}<b></td>
		</tr>
		<tr>
			<td align="right" >
				<input id="btn_close" title="Close" class="btn_tools" type="button" value=" Close " onclick="window.close();">&nbsp;
			</td>
		</tr>
		<tr>
			<td align="center" >
				<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
		 			<tr bgcolor="#cccccc" height="25">
			   			<td colspan="2" class="font11b" align="center" >สรุปคะแนนสูงสุด - ต่ำสุด </td>
		 			</tr>
		 			<tr bgcolor="#EBEBF5" height="25">
			   			<td class="font11b" align="center" width="15%">คะแนนสูงสุด </td>
		 				<td class="font11b" align="center" ></td>
		 			</tr>
		 			<tr bgcolor="#EBEBF5" height="25">
			   			<td class="font11b" align="center" width="15%">คะแนนต่ำสุด </td>
		 				<td class="font11b" align="center" ></td>
		 			</tr>
		 			<tr bgcolor="#cccccc" height="25">
			   			<td colspan="2" class="font11b" align="center" >สรุปคะแนนเฉลี่ยรวม </td>
		 			</tr>
		 			<tr bgcolor="#EBEBF5" height="25">
			   			<td class="font11b" align="center" width="25%">จำนวนคนที่ได้คะแนนสูงกว่า คะแนนเฉลี่ยรวม </td>
		 				<td class="font11b" align="center" ></td>
		 			</tr>
		 			<tr bgcolor="#EBEBF5" height="25">
			   			<td class="font11b" align="center" width="25%">จำนวนคนที่ได้คะแนนต่ำกว่า คะแนนเฉลี่ยรวม  </td>
		 				<td class="font11b" align="center" ></td>
		 			</tr>
	    			<tr bgcolor="#cccccc" height="25">
			   			<td colspan="2" class="font11b" align="center">สรุปคะแนนเฉลี่ยแผนก </td>
		 			</tr>
		 			<tr bgcolor="#EBEBF5" height="25">
			   			<td class="font11b" align="center" width="25%">คะแนนสูงสุด </td>
		 				<td class="font11b" align="center" ></td>
		 			</tr>
		 			<tr bgcolor="#EBEBF5" height="25">
			   			<td class="font11b" align="center" width="25%">คะแนนต่ำสุด </td>
		 				<td class="font11b" align="center" ></td>
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
			                <td>&nbsp;</td>
			                <td width="12"><img width="12" height="19" src="{$g_image}/buttonmenuright.gif"/></td>
			            </tr>
			        </tbody>
			   </table>
			</td>
		</tr>
		<tr>
			<td align="right" >
				<input id="btn_close" title="Close" class="btn_tools" type="button" value=" Close " onclick="window.close();">&nbsp;
			</td>
		</tr>
	</table>
</form>
{add_script file="$_js/evaluate.js"}
{$graphmap}
{include file="$g_template/_footer.tpl"}