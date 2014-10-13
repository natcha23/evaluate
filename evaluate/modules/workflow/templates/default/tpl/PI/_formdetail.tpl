{include file="$g_template/_header.tpl"}
<script>
	var IMG_URL = '{$IMG_URL}';
	var user_code = '{$_profile->user_code}';
	var stpage = '{$status}';

{literal}
function ChkInt(obj) {
	if (ckvNumeric(obj.value) == false){
 			alert('pleases input number only.');
 			obj.value = '';
 			obj.focus();
 			return false;
 	}
}
function ckvNumeric(sText) {
	   var ValidChars = '0123456789.';
	   var IsNumber=true;
	   var Char;
	   var Dot=0;
	   for (i = 0; i < sText.length && IsNumber == true; i++){
		      Char = sText.charAt(i);

		      if (ValidChars.indexOf(Char) == -1){
		         	IsNumber = false;
		      }
	   }
	   return IsNumber;
}
function ChkVal(elm){
	if(elm.value > 10){
		alert('You input point more than 10,Please check again.');
		$('#'+elm.id).val('');
		return false;
	}
}
function _SumT(k,i){
	var sum_tscoll = 0;	
	var wscoll = $('#wscoll_'+i).val().replace(/[\,]/g,'')*1;
	var rscoll = $('#rscoll_'+i).val().replace(/[\,]/g,'')*1;

	if(rscoll > 10){
		alert('You input point more than 10,Please check again.');
		$('#rscoll_'+i).val('');
		return false;
	}else{	
		var tscoll = wscoll * rscoll;
		$('#tscoll_'+i).val(tscoll)		
		var sum_wscoll = 0;
		$('input[@id^=tscoll_'+k+'\_]').each(function(){
			sum_tscoll += $(this).val().replace(/[\,]/g,'')*1;
		});
		$('#point_total_'+k).html(sum_tscoll);	
	
		var params = '_output=json&key='+k+'&total='+sum_tscoll;
		var baseUrl = '/'+projectName+'/workflow/evaluate/calgrade/';
		AjaxContent.init({
			proxy : baseUrl,
		    container : 'content-container',
		    overlay : true,
		    showLoadding: false,
		    htmlTemplate: null
		});
		AjaxContent.send(params,function(returnText){
		  	 if(returnText){
	    		eval(returnText);
	      		var sum_total ;
	       	 }
	   	});		
	}
}
function _SumW(){
	var sum_wscoll = 0;
	$('input[@id^=wscoll\_]').each(function(){
		sum_wscoll += $(this).val().replace(/[\,]/g,'')*1;
	});
	$('#weight').html(sum_wscoll);
	$('#sum_weight').val(sum_wscoll);
}

{/literal}
</script>
<div id="content-container">
<form method="post" action="" id="_pifrm" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td width="3" background="{$g_image}/form/line.jpg"><img src="{$g_image}/form/line.jpg" width="3" height="6" /></td>
			<!--detail-->
				<td valign="top" bgcolor="#FFFFFF">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr bgcolor="#EBEBEB">
						<td colspan="2" align="right">
						
							{*<input id="btn_save" title="Save" class="btn_tools" onclick="bttFinish('{$headArr.mph_status}','pi','{$status}','save');" value="   Save" type="button">*}						
							<input id="btn_list" title="Send to approve" class="btn_tools" value="  Send to approve" onclick="bttSendTo('workflow/evaluate/userpopup/pageview/pi/code/{$key_chk}/status/{$status}');" type="button">
							{if $lookup_code == 'AM'}
							<input id="btn_accept" title="Approve" class="btn_tools" onclick="bttFinish('F','pi_admin','{$status}','finish');" value="  Approve" type="button">
							{else}
							<input id="btn_accept" title="Approve" class="btn_tools" onclick="bttFinish('F','pi','{$status}','finish');" value="  Approve" type="button">
							{/if}
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/accept/type/PI');"  value="  Back" type="button">
							
						</td>
					  </tr>
					  {foreach from=$headRows key=keyH item=headArr}						  				  
					  <tr><td height="3"></td></tr>
			          <tr>
			            <td>			            	
			            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
				              <tr>
				                <td width="40"><img src="{$g_image}/form/Arrow-Left.gif" width="40" height="40" /></td>				                
				              	<td >&nbsp;&nbsp;&nbsp;<span class="style15">{$TabName} ของคุณ {$headArr.user_name} {$headArr.user_lname} ({if $headArr.mph_user eq '1001'}-contact-{else}{$headArr.mph_user}{/if}) </span></td>
				              </tr>
			            	</table>
			            </td>
			          </tr>
			          
			          <tr>
			            <td>
							<table id="table_list" bgcolor="#ffffff" cellpadding="0" cellspacing="1" width="100%" border="0" style="border:1px solid #B9B9B9;">
									<tr bgcolor="#C6DCFF" height="30">
										<td class="font11b" width="3%" align="center" >ลำดับ</td>
								    	<td class="font11b" align="center" width="250">หัวข้อของการประเมิน</td>
								    	<td class="font11b" width="7%" align="center" >น้ำหนักคะแนน</td>								  
								    	{assign var=i value=1}
								    	{section name=col loop=$column.$keyH}
								    	<td class="font11" width="6%" align="center" style="cursor: pointer;" title="{$userColumn.$keyH[$i]}"><b>ครั้ง {$i}</b><br>{$userColumn.$keyH[$i]}</td {$i++}>
								    	{/section}
										{if $headArr.mph_status neq 'R'}
								    	<td class="font11b" width="7%" align="center" >คะแนนที่ได้ <br/>(เต็ม 10)</td>
								    	{/if}
								    	<td class="font11b" width="7%" align="center" >คะแนนรวม</td>
								    	{if $headArr.mph_status eq 'C' || $change}
								    	<td class="font11b" width="5%" align="center" >Action</td>
								    	{/if}
									</tr>
									{if $dataRows.$keyH}
									{assign var=i value=0}
									{foreach from=$dataRows.$keyH item=head2}
										{foreach from=$head2 item=head key=key}
											{if $key eq 'subject'}
											<tr bgcolor="#DAECF4" id="main_{$keyH}_{$i}" height="20" >
												<td class="font11" align="center" width="3%">{$i+1}</td>
												<td class="font11" align="left" >{$head.mpl_subject|replace:"||":"'"}
													<input type="hidden" name="detail[{$keyH}][{$i}][mpl_id]" id="id_{$keyH}_{$i}" size="10" value="{$head.mpl_id}">
													<input type="hidden" name="detail[{$keyH}][{$i}][mpl_type]" id="type_{$keyH}_{$i}" size="10" value="{$head.mpl_type}">
													<input type="hidden" name="detail[{$keyH}][{$i}][mpl_status]" id="status_{$keyH}_{$i}" size="10" value="{$head.mpl_status}">
													<input type="hidden" name="detail[{$keyH}][{$i}][mpl_subject]" id="subject_{$keyH}_{$i}" size="20" value="{$head.mpl_subject|replace:"||":"'"}">
												</td>
												<td class="font11b" align="center" >
													{$head.mpl_weight|number_format:0}
													<input type="hidden" name="detail[{$keyH}][{$i}][mpl_weight]" size="5" readonly id="mwscoll_{$keyH}_{$i}" value="{$head.mpl_weight|number_format:0}">										
												</td>
												{assign var=i2 value=1}
									    		{section name=col loop=$column.$keyH}
												<td class="font11" align="left" ></td>
												{/section}
												{if $headArr.mph_status neq 'R'}
												<td class="font11" align="left" ></td>
												{/if}
												<td class="font11" align="left" ></td>
												{if $headArr.mph_status eq 'C' || $change}
												<td class="font11" align="center" >												
													<a href="javascript:void(0)" onClick="AddRowsParent('{$i}');">
														<img src="{$g_image}/add.gif" border="0" >
													</a>												
												</td>
												{/if}
											</tr>										
											{elseif $key eq 'detail'}
												{assign var=ii value=1}
												{foreach from=$head item=item}
												<tr id="sub_{$keyH}_{$i}_{$ii}" height="20" bgcolor="{cycle values="#ffffff,#F9FAFB"}">
													<td class="font11" align="left" width="3%">&nbsp;</td>
													<td class="font11" align="left" >
														{$item.mpl_subject|replace:"||":"'"}
														<input type="hidden" name="detail[{$keyH}][{$i}][line][{$ii}][mpl_subject]" id="subject_{$keyH}_{$i}_{$ii}" size="20" value="{$item.mpl_subject|replace:"||":"'"}">
													
														<input type="hidden" name="detail[{$keyH}][{$i}][line][{$ii}][mpl_id]" id="id_{$keyH}_{$i}_{$ii}" size="10" value="{$item.mpl_id}">
														<input type="hidden" name="detail[{$keyH}][{$i}][line][{$ii}][mpl_type]" id="type_{$keyH}_{$i}_{$ii}" size="10" value="D">
														<input type="hidden" name="detail[{$keyH}][{$i}][line][{$ii}][mpl_status]" id="status_{$keyH}_{$i}_{$ii}" size="10" value="N">
													</td>
													<td class="font11" align="center" >
														{if $item.mpl_weight>0}{$item.mpl_weight|number_format:0}{/if}
														<input type="hidden" name="detail[{$keyH}][{$i}][line][{$ii}][mpl_weight]" id="wscoll_{$keyH}_{$i}_{$ii}" size="5" readonly value="{if $item.mpl_weight>0}{$item.mpl_weight|number_format:0}{/if}">																									
													</td>
													{assign var=i2 value=0}
										    		{section name=col loop=$column.$keyH}
													<td class="font11" align="center" >
														{$item.subCol.$i2.sl_point|number_format:0}
													</td {$i2++}>
													{/section}
													{if $headArr.mph_status neq 'R'}
													<td class="font11" align="center" >
														{if $headArr.mph_status eq 'F'}
															{if $item.mpl_point>0}{$item.mpl_point|number_format:0}{/if}
														{elseif $headArr.mph_status neq 'C'}
														<input type="text" name="detail[{$keyH}][{$i}][line][{$ii}][mpl_point]" id="rscoll_{$keyH}_{$i}_{$ii}" size="5" onKeyup="ChkInt(this);_SumT('{$keyH}','{$keyH}_{$i}_{$ii}');" value="{if $item.mpl_point>0}{$item.mpl_point|number_format:0}{/if}">
														{/if}
													</td>
													{/if}
													<td class="font11" align="center" >
														<input type="text" id="tscoll_{$keyH}_{$i}_{$ii}" size="5" readonly value="{if $item.mpl_weight*$item.mpl_point>0}{$item.mpl_weight*$item.mpl_point|number_format:0}{/if}">
													</td>
													{if $headArr.mph_status eq 'C' || $change}
													<td class="font11" align="center" >
														<a href="javascript:void(0)" onClick="DelRowParent('{$i}','{$ii}');">
															<img src="{$g_image}/deletep.gif" border="0" >
														</a>
													</td>
													{/if}
												</tr {$ii++}>
												{/foreach}												
											{/if}											
										{/foreach}
										<tbody id="show_parant{$i}"></tbody>
									{assign var=i value=$i+1}
									{/foreach}
									{/if}
									<tbody id="show_main"></tbody>									
									<tr height="20" bgcolor="#CCCCCC">
								    	<td colspan="2" align="right" class="font11b">คะแนนรวม &nbsp;</td>
								    	<td align="center" ><span id="weight_{$keyH}">{$headArr.sum_weight|number_format:0}</span></td>
								     	{assign var=t value=1}
								     	{section name=col loop=$column.$keyH}
								     	<td align="center">{$totalLine.$keyH[$t].grade}:{$totalLine.$keyH[$t].scoll|number_format:2}</td {$t++}>
								     	{/section}
								     	{if $headArr.mph_status neq 'R'}
								    	<td align="center" ><span id="point_{$keyH}"></span></td>
								    	{/if}
								    	<td align="center" ><span id="point_grade_{$keyH}">{if $headArr.mph_grade}{$headArr.mph_grade}:{/if}</span><span id="point_total_{$keyH}">{if $headArr.sum_point}{$headArr.sum_point|number_format:2}{/if}</span></td>
								    	{if $headArr.mph_status eq 'C' || $change}
								    	<td align="center" ></td>
								    	{/if}
									</tr>
							</table>
						</td>
			          </tr>
			          
			        <tr>
			             <td valign="top">
				            <table valign="top" width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				               <tr valign="top">
						             <td width="65%" valign="top">
						              	<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							                <tr>
								                <td valign="top" align="left" class="font12">&nbsp; Remark : (ประเมินตนเองคะแนนมากกว่า 8 กรุณาใส่รายละเอียดเพิ่มเติม)</td>
								            </tr>
							                <tr>
								                <td valign="top" align="left" class="font12">&nbsp;
								                    <textarea name="head[{$keyH}][mph_desc]" id="detail" rows="7" class="textfield_10c">{$headArr.mph_desc|replace:"||":"'"}</textarea>
								            	</td>
								            </tr>
							            </table>
				            		</td>
				            		<td valign="top">
					            		<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
					            			<tr height="30">
						            			<td nowrap>
						            			{if $dataRows}
							            			<img src="{$g_image}/form/start.png" border="0" title="[ ฝ่ายบุคคล ]">
							            			<img src="{$g_image}/form/next.gif" border="0" ><img src="{$g_image}/form/user.png" title="[ {$headArr.first_recive} ]" border="0" width="20" height="20">
							            			{if $headArr.mph_status eq 'P' || $headArr.mph_status eq 'R' || $headArr.mph_status eq 'F'}
														{assign var=u value=1}
									    				{section name=col loop=$column.$keyH}
								            				<img src="{$g_image}/form/next.gif" border="0" ><img src="{$g_image}/form/user.png" title="[ {$userColumn.$keyH[$u]} ]" border="0" width="20" height="20">
							            				{assign var=u value=$u+1}
							            				{/section}
						            					{if $headArr.mph_status eq 'P'}
							            					<img src="{$g_image}/form/next.gif" border="0" ><img src="{$g_image}/form/pink.png" title="[ {$user_flow} ]" border="0" width="16" height="16">
							            				{/if}
						            				{/if}
						            				{if $headArr.mph_status eq 'F'}
						            				<img src="{$g_image}/form/next.gif" border="0" ><img src="{$g_image}/form/end.gif" title="[ การเงิน ]" border="0" >
						            				{/if}
						            			{/if}
						            			</td>
					            			</tr>
					            		</table>
				            		</td>
				                </tr>
				            </table>
			             </td>
			        </tr>
			        
			        <input type="hidden" name="sum_weight[{$keyH}]" id="sum_weight" value="{$headArr.sum_weight|number_format:0}">
					<input type="hidden" name="loopCol[{$keyH}]" id="loopCol" value="{$column.$keyH}">
					<input type="hidden" name="receive_old[{$keyH}]" id="receive_old" value="{$headArr.mph_user_flow}">
					<input type="hidden" name="user_recive[{$keyH}]" id="user_recive" value="{$headArr.mph_user_flow}">
					<input type="hidden" name="user_send[{$keyH}]" id="user_send" value="{$user_send}">
					<input type="hidden" name="mode[{$keyH}]" id="mode">
					<input type="hidden" name="checksend[{$keyH}]" id="checksend">
					<input type="hidden" name="change[{$keyH}]" id="change" value="{$change}">
					<input type="hidden" name="page_status[{$keyH}]" id="page_status" value="{$status}">
					<input type="hidden" name="copy_to[{$keyH}]" value="{$copy_to}">
					<input type="hidden" name="level_user[{$keyH}]" value="{$headArr.org_position_level}">
					<input type="hidden" name="head[{$keyH}][mph_id]" value="{$headArr.mph_id}">
					<input type="hidden" name="head[{$keyH}][mph_month]" value="{$headArr.mph_month}">
					<input type="hidden" name="head[{$keyH}][mph_status]" id="status" value="{$headArr.mph_status}">
					<input type="hidden" name="head[{$keyH}][mph_user]" value="{$headArr.mph_user}">
					<input type="hidden" name="old_status[{$keyH}]" id="old_status" value="{$headArr.mph_status}">
					{/foreach}
			        
			        <tr ><td colspan="2"height="20"></td></tr>
			    	<tr bgcolor="#EBEBEB">
						<td colspan="2" align="right" >
							{*<input id="btn_save" title="Save" class="btn_tools" onclick="bttFinish('{$headArr.mph_status}','pi','{$status}','save');" value="   Save" type="button">*}						
							<input id="btn_list" title="Send to approve" class="btn_tools" value="  Send to approve" onclick="bttSendTo('workflow/evaluate/userpopup/pageview/pi/code/{$key_chk}/status/{$status}');" type="button">
							{if $lookup_code == 'AM'}
							<input id="btn_accept" title="Approve" class="btn_tools" onclick="bttFinish('F','pi_admin','{$status}','finish');" value="  Approve" type="button">
							{else}
							<input id="btn_accept" title="Approve" class="btn_tools" onclick="bttFinish('F','pi','{$status}','finish');" value="  Approve" type="button">
							{/if}
							<input id="btn_back" title="Back" class="btn_tools" onclick="openPage('workflow/evaluate/accept/type/PI');"  value="  Back" type="button">
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
<input type="hidden" name="key_chk" id="key_chk" value="{$key_chk}">
<input type="hidden" name="user_recive_popup" id="user_recive_popup" >

</table>
{add_script file="$_js/evaluate.js,$_js/action.js,$_js/_pi.js"}
{include file="$g_template/_footer.tpl"}
</form>
</div>