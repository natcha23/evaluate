{include file="$g_template/_header_popup.tpl"}

<table width="100%"  border="0" cellspacing="0" cellpadding="2" style="border:1px solid #cccccc;" align="center">
	    <tr>
	    	<td align="center" bgcolor="#AEAECD" height="25" class="font12">
	    	<B><font color="#3333CC">Generate PI</font></B>
			</td>
		</tr>
		<tr>
			<td>

				<form name="maintanCredit" method="post" action="" id="maintanCredit" enctype="multipart/form-data">
				 <table width="100%"  border="0" cellspacing="0" cellpadding="2" style="border:1px solid #cccccc;">
		
					<tr height="25" valign="top" bgcolor="#C2D5FC">
						<td width="20%" align="right" class="font11"><b>User Receive (1st): </b>&nbsp;</td>
						<td align="left" class="font11">
							<textarea name="qhquono" id="" cols="60" rows="7" readonly>{$rows.uname}</textarea>
							<input type="hidden" name="fields[uid]" size="7" value="{$rows.uid}" >
							<input type="hidden" name="fields[sid]" size="7" value="{$sid}" >
						</td>
					</tr>
					<tr height="25" valign="top" bgcolor="#C2D5FC">
						<td width="20%" align="right" class="font11"><b>PI of Month (old): </b>&nbsp;</td>
						<td align="left" class="font11">
							<input type="text" name="month_old" size="13" readonly value="{$rows.month}" >
						</td>
					</tr>
					<tr height="25" valign="top" bgcolor="#C2D5FC">
						<td width="20%" align="right" class="font11"><b>PI of Month: </b>&nbsp;</td>
						<td align="left" class="font11">
							<select name="fields[month]" id="month" style="width:95px"  >
							<option value="">-- Select --</option>
								{html_options options=$MonthOp selected=$rows.month}
							</select>
							* เลือกเพื่อเปลี่ยนเดือนประเมิน PI
						</td>
					</tr>
					

			</table>
			<input type="hidden" id="i"  size="5" >
			<table width="100%"  border="0" cellspacing="2" cellpadding="2" bgcolor="#dddddd">				
				<tr bgcolor="#EBEBEB">
					<td align="right" >
						<input id="btn_save" title="Save" class="btn_tools" value=" Generate PI " onclick="submitForm();" type="button">
						<input id="btn_close" title="Close" class="btn_tools" onclick="window.parent.TINY.box.hide();" value=" Close " type="button">
						&nbsp;
					</td>
				</tr>				
			</table>
		</form>
		</td>
	   </tr>
	  </table>

<script>
var reload = '{$reload}';
{literal}
function submitForm(){
	if(confirm('Do you want to generate pi ?')){
		document.forms[0].submit();
	}	
}
{/literal}
</script>
{if $reload eq 1}
<script>
{literal}
	window.parent.location.reload();
	window.parent.TINY.box.hide();
{/literal}
</script>
{/if}