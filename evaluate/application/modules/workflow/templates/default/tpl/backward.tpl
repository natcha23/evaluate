{include file="$g_template/_header.tpl"}
<div id="content-container">
<form method="post" action="" id="_portal" enctype="multipart/form-data">
	<input type="hidden" name="backwardaction" id="backwardaction" value=""/>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
			<!--detail-->
				<td valign="top" bgcolor="#FFFFFF">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
				    	<td colspan="9" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" >
					    		<tr >
					                <td height="38" class="titlehead">&nbsp;Backward Process Approve</td>
				              	</tr>
				    		</table>
	        			</td>
					  </tr>
					  
					  <tr bgcolor="#EBEBEB" height="25">
					  
				    	<td class="font11b" colspan="3" align="left" >
				    		<input id="btn_back" title="ย้อนกลับ Process" class="btn_tools" onclick="backwardLine('delhis');" value="&nbsp;&nbsp;Backward" type="button">
						</td>
						
						<td class="font11" align="right" colspan="2" ><b>Department :</b>
							<select name="group" id="group" class="selectBox22" onchange="jsChange(this.value);" >
								<option value="">-- Show all --</option>
								{html_options options=$groupBUOp selected=$group}
							</select>&nbsp;&nbsp;
			   			 </td>
				    			
						<td class="font11" align="right" colspan="3" ><b>Month :</b>
	    					<select name="search[month]" id="month" class="selectBox10" >
								{html_options options=$monthOp selected=$month }
							</select>
									
							<select name="search[year]" id="year" class="selectBox7"  >
								{html_options options=$yearOp selected=$year}
							</select>
							<input type="button" id="btn_search" class="btn_tools" value="   Search" name="btt_search" onclick="jsSearch();">

	    				</td>
			   			
		 			</tr>
					 			
				    <tr>
				    	<td colspan="9" align="center">
				    		<table bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
				    			<tr bgcolor="#C6DCFF" height="30">
									<td class="font11b" width="3%" align="center" >
				    			 		<input type="checkbox" class="border0" name="checkId" onclick="selectChkAll(this);">
				    			 	</td>
									<td class="font11b" width="10%" align="center" >Type of flow</td>
									<td class="font11b" width="15%" align="center" >Form Month</td>
									<td class="font11b" width="15%" align="center" >User Owner</td>
									<td class="font11b" width="15%" align="center" >User Receive</td>
									<td class="font11b" width="15%" align="center" >Send Date</td>
									<td class="font11b" width="10%" align="center" >Status</td>
<!-- 									<td class="font11b" width="10%" align="center" >Action</td> -->
								</tr>
								{if $items}
								{assign var=loopH value=1}
								{foreach from=$items key=key item=data}
								<tr height="20" {if $data.mph_status eq 'C'}bgcolor="#FFE7F6" {else}bgcolor="{cycle values="#ffffff,#EBEBF5"}" {/if}id="tr_{$data.mph_id}">
									<td class="font12" align="center" >
										<input type='checkbox' class="border0" name="mph_id[]" id="{$data.mph_id}" value='{$data.mph_id}'>
									</td>
									<td class="font12" align="center" >{$data.mph_type}</td>
									<td class="font12" align="center" >{$data.mph_month}</td>
									<td class="font12" align="center" >{$data.user_name_owner}</td>
									<td class="font12" align="center" >{$data.user_name}</td>
									<td class="font12" align="center" >{$data.mph_datetime}</td>
									<td class="font12" align="center" >
									{if $data.mph_status eq 'C'}Create
									{elseif $data.mph_status eq 'P'}Process
									{elseif $data.mph_status eq 'F'}Finish
									{elseif $data.mph_status eq 'R'}Delay
									{/if}
									</td>
									<!-- td align="center" class="font12" id="txt_link_user">
										<input id="btn_back" title="backward" class="btn_tools" onclick="openPageEvaluate('{$data.mph_type}','{$data.mph_id}','{$data.mph_user}','{$data.mph_month}','B');" value="   backward" type="button">
									</td-->
								</tr {$loopH++}>
								{/foreach}
								{/if}
				    		</table>
				    	</td>
					<!--tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							<input id="btn_back" title="Back" class="btn_tools" onclick="openLinkMenu('workflow/evaluate/urecive');" value="   Back " type="button">
						</td>
					</tr-->
				  <tr align="right">
				   		<td colspan="9">
							<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#b9b9b9">
						   	<tbody>
						       	<tr align="right">
						           	<td width="12"><img width="12" src="{$g_image}/buttonmenuleft.gif"/></td>
						            <td>{*html_pagination url=$url total=$totalRecord page=$page perpage=$perpage*}&nbsp;</td>
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

<script type="text/javascript">
{literal}
function backwardLine(act){
 	var param_code = '';
 	var chk = '';
 	$(':checkbox',$('#content-container').get(0)).each(function() {
 		var reg = /([0-9a-zA-Z]+)$/i;
 		if( this.checked==true && this.id.match(reg)){
  	      chk = '1';
 		}
 	});
 	if(chk == '1'){
 		_confirm("Are you sure to backward process ?",function(){
 	 		$('#backwardaction').val('1');

 			document.forms[0].submit();

 			
// 	 		$(':checkbox',$('#content-container').get(0)).each(function() {
// 		 		var reg = /([0-9a-zA-Z]+)$/i;
// 		 		if( this.checked==true && this.id.match(reg)){
// 		  	       id = this.value;
// 		   	        var data = {
// 		  	    		'product' :this.value
// 		  	       }
// 		  	     if(param_code == "") param_code = data.product;
// 		 	     else param_code += ","+data.product;

// 		  	     $("#tr_"+id).remove();
// 		 		}
// 		 	});
// 	 		jsDeleteHis(param_code,act);
 		},{icon:'question'});
 	}else{
 		_alert('Please select data.');
 		return;
 	}
 }
{/literal}
</script>
</div>